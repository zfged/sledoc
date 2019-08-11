<?php
/**
 * Класс XML экспорта
 *
 * Данные о товарах экспортируются согласно требованиям от Hotline UA - http://hotline.ua/about/pricelists_specs_xml/
 */

class ControllerFeedHotlineUa extends Controller {
	private $shop = array();
	private $currencies = array();
	private $categories = array();
	private $offers = array();
	private $from_charset = 'utf-8';
	private $eol = "\n";

    protected function explodeLines($lines){
        $res = array();
        foreach(explode("\n",trim($lines)) as $line ){
            if( trim($line) != "")
                $res[] = trim($line);
        }
        return $res;
    }
    protected function prepareUrl($url){
        $result = $url;
        // часть версий опенкарта отдает урл сразу с энкодингом, а часть - без энкодинга. Надо уравнять вывод для всех версий
        $result = str_replace("&amp;","&",$result);
        $result = str_replace("&","&amp;",$result);
        return $result;
    }

	public function index() {
		if ($this->config->get('hotline_ua_status') ) {


			if (!($allowed_categories = $this->config->get('hotline_ua_categories'))) exit();


			$this->load->model('export/hotline_ua');
			$this->load->model('localisation/currency');
			$this->load->model('tool/image');

            $ipList = $this->explodeLines($this->config->get("hotline_ua_ip_list"));
            if(count($ipList) > 0 ) {
                $denied = true;
                foreach($ipList as $ip){
                    if( $ip == $_SERVER["REMOTE_ADDR"]){
                        $denied = false;
                        break;
                    }
                }
                if( $denied )
                    exit();
            }

			// Магазин
			$this->setShop('date', date("Y-m-d H:i:s"));
			$this->setShop('firmName', $this->config->get('hotline_ua_shopname'));
			$this->setShop('firmId', $this->config->get('hotline_ua_company'));

			// Валюты
			$offers_currency = $this->config->get('hotline_ua_currency');
			if (!$this->currency->has($offers_currency)) exit();

			$decimal_place = $this->currency->getDecimalPlace($offers_currency);
            if( !$decimal_place )
                $decimal_place = 0;

			$shop_currency = $this->config->get('config_currency');

			$this->setCurrency($offers_currency, 1);

			$currencies = $this->model_localisation_currency->getCurrencies();

			$supported_currencies = array('UAH');

			$currencies = array_intersect_key($currencies, array_flip($supported_currencies));

			foreach ($currencies as $currency) {
				if ($currency['code'] != $offers_currency && $currency['status'] == 1) {
					$this->setCurrency($currency['code'], number_format(1/$this->currency->convert($currency['value'], $offers_currency, $shop_currency), 4, '.', ''));
				}
			}

			// Категории
			$categories = $this->model_export_hotline_ua->getCategory();

			foreach ($categories as $category) {
				$this->setCategory($category['name'], $category['category_id'], $category['parent_id']);
			}

			// Товарные предложения
			$in_stock_id = $this->config->get('hotline_ua_in_stock'); // id статуса товара "В наличии"
			$out_of_stock_id = $this->config->get('hotline_ua_out_of_stock'); // id статуса товара "Нет на складе"
			$vendor_required = false; // true - только товары у которых задан производитель, необходимо для 'vendor.model' 
			$products = $this->model_export_hotline_ua->getProduct($allowed_categories, $out_of_stock_id, $vendor_required);

			foreach ($products as $product) {
				if($product['quantity'] > 0 || $product['stock_status_id'] == $in_stock_id) {
					$data = array();
					
					$data['id'] = $product['product_id'];
					$data['categoryId'] = $product['category_id'];
					$data['code'] = $product['model'];
					$data['name'] = $product['name'];
					$data['description'] = $product['description'];
                    $data['vendor'] = $product['manufacturer'];
                    $data['url'] = $this->url->link('product/product', 'path=' . $this->getPath($product['category_id']) . '&product_id=' . $product['product_id']);
					if ($product['image']) {
						$data['image'] = $this->model_tool_image->resize($product['image'],
                                $this->config->get("hotline_ua_image_width"),
                            $this->config->get("hotline_ua_image_height") );
					}
	
					// Параметры товарного предложения
					$data['priceRUAH'] = number_format($this->currency->convert($this->tax->calculate($product['price'], $product['tax_class_id']), $shop_currency, $offers_currency), $decimal_place, '.', '');
					$data['stock'] = ( $product['quantity'] > 0 ? 'В наличии' : 'Ожидайте 2-3 дня' );
					$data['guarantee'] = $this->config->get("hotline_ua_warranty");
	
					$this->setOffer($data);
				}
			}

			$this->categories = array_filter($this->categories, array($this, "filterCategory"));

			$this->response->addHeader('Content-Type: application/xml');
			$this->response->setOutput($this->getXml());
		}
	}

	/**
	 * Формирование массива для элемента shop описывающего магазин
	 *
	 * @param string $name - Название элемента
	 * @param string $value - Значение элемента
	 */
	private function setShop($name, $value) {
		$allowed = array('date', 'firmName', 'firmId');
		if (in_array($name, $allowed)) {
			$this->shop[$name] = $this->prepareField($value);
		}
	}

	/**
	 * Валюты
	 *
	 * @param string $id - код валюты (UAH)
	 * @param float|string $rate - курс этой валюты к валюте, взятой за единицу.
	 *	Параметр rate может иметь так же следующие значения:
	 *		CBRF - курс по Центральному банку РФ.
	 *		NBU - курс по Национальному банку Украины.
	 *		NBK - курс по Национальному банку Казахстана.
	 *		СВ - курс по банку той страны, к которой относится интернет-магазин
	 * 		по Своему региону, указанному в Партнерском интерфейсе Яндекс.Маркета.
	 * @param float $plus - используется только в случае rate = CBRF, NBU, NBK или СВ
	 *		и означает на сколько увеличить курс в процентах от курса выбранного банка
	 * @return bool
	 */
	private function setCurrency($id, $rate = 'CBRF', $plus = 0) {
		$allow_id = array('UAH');
		if (!in_array($id, $allow_id)) {
			return false;
		}
		$allow_rate = array('CBRF', 'NBU', 'NBK', 'CB');
		if (in_array($rate, $allow_rate)) {
			$plus = str_replace(',', '.', $plus);
			if (is_numeric($plus) && $plus > 0) {
				$this->currencies[] = array(
					'id'=>$this->prepareField(strtoupper($id)),
					'rate'=>$rate,
					'plus'=>(float)$plus
				);
			} else {
				$this->currencies[] = array(
					'id'=>$this->prepareField(strtoupper($id)),
					'rate'=>$rate
				);
			}
		} else {
			$rate = str_replace(',', '.', $rate);
			if (!(is_numeric($rate) && $rate > 0)) {
				return false;
			}
			$this->currencies[] = array(
				'id'=>$this->prepareField(strtoupper($id)),
				'rate'=>(float)$rate
			);
		}

		return true;
	}

	/**
	 * Категории товаров
	 *
	 * @param string $name - название рубрики
	 * @param int $id - id рубрики
	 * @param int $parent_id - id родительской рубрики
	 * @return bool
	 */
	private function setCategory($name, $id, $parent_id = 0) {
		$id = (int)$id;
		if ($id < 1 || trim($name) == '') {
			return false;
		}
		if ((int)$parent_id > 0) {
			$this->categories[$id] = array(
				'id'=>$id,
				'parentId'=>(int)$parent_id,
				'name'=>$this->prepareField($name)
			);
		} else {
			$this->categories[$id] = array(
				'id'=>$id,
				'name'=>$this->prepareField($name)
			);
		}

		return true;
	}

	/**
	 * Товарные предложения
	 *
	 * @param array $data - массив параметров товарного предложения
	 */
	private function setOffer($data) {

		$offer = $data;

        $offer['name']        = $this->prepareField($data['name']);
		$offer['code']        = $this->prepareField($data['code']);
		$offer['stock']       = $this->prepareField($data['stock']);
        $offer['description'] = $this->prepareField($data['description']);
        $offer['vendor']      = $this->prepareField($data['vendor']);
        $offer['url']         = $this->prepareUrl($data['url']);

		$this->offers[] = $offer;
	}

	/**
	 * Формирование XML файла
	 *
	 * @return string
	 */
	private function getXml() {
		$result  = '<?xml version="1.0" encoding="windows-1251"?>' . $this->eol;
		$result .= '<price>' . $this->eol;

		// информация о магазине
		$result .= $this->array2Tag($this->shop);

		// категории
		$result .= '<categories>' . $this->eol;
		foreach ($this->categories as $category) {
			unset($category['export']);
			$tags = $this->array2Tag($category);
			$result .= $this->getElement(array(), 'category', $tags);
		}
		$result .= '</categories>' . $this->eol;

		// товарные предложения
		$result .= '<items>' . $this->eol;
		foreach ($this->offers as $offer) {
			$tags = $this->array2Tag($offer);
			$result .= $this->getElement(array(), 'item', $tags);
		}
		$result .= '</items>' . $this->eol;

		$result .= '</price>';

		return $result;
	}

	/**
	 * Фрмирование элемента
	 *
	 * @param array $attributes
	 * @param string $element_name
	 * @param string $element_value
	 * @return string
	 */
	private function getElement($attributes, $element_name, $element_value = '') {
		$retval = '<' . $element_name . ' ';
		foreach ($attributes as $key => $value) {
			$retval .= $key . '="' . $value . '" ';
		}
		$retval .= $element_value ? '>' . $this->eol . $element_value . '</' . $element_name . '>' : '/>';
		$retval .= $this->eol;

		return $retval;
	}

	/**
	 * Преобразование массива в теги
	 *
	 * @param array $tags
	 * @return string
	 */
	private function array2Tag($tags) {
		$result = '';
		foreach ($tags as $key => $value) {
			$result .= '<' . $key . '>' . $value . '</' . $key . '>' . $this->eol;
		}

		return $result;
	}

	/**
	 * Преобразование массива в теги параметров
	 *
	 * @param array $params
	 * @return string
	 */
	private function array2Param($params) {
		$retval = '';
		foreach ($params as $param) {
			$retval .= '<param name="' . $this->prepareField($param['name']);
			if (isset($param['unit'])) {
				$retval .= '" unit="' . $this->prepareField($param['unit']);
			}
			$retval .= '">' . $this->prepareField($param['value']) . '</param>' . $this->eol;
		}

		return $retval;
	}

	/**
	 * Подготовка текстового поля в соответствии с требованиями Яндекса
	 * Запрещаем любые html-тэги, стандарт XML не допускает использования в текстовых данных
	 * непечатаемых символов с ASCII-кодами в диапазоне значений от 0 до 31 (за исключением
	 * символов с кодами 9, 10, 13 - табуляция, перевод строки, возврат каретки). Также этот
	 * стандарт требует обязательной замены некоторых символов на их символьные примитивы.
	 * @param string $text
	 * @return string
	 */
	private function prepareField($field) {
		$field = htmlspecialchars_decode($field);
		$field = strip_tags($field);
		$from = array('"', '&', '>', '<', '\'');
		$to = array('&quot;', '&amp;', '&gt;', '&lt;', '&apos;');
		$field = str_replace($from, $to, $field);
		if ($this->from_charset != 'windows-1251') {
			$field = iconv($this->from_charset, 'windows-1251//IGNORE', $field);
		}
		$field = preg_replace('#[\x00-\x08\x0B-\x0C\x0E-\x1F]+#is', ' ', $field);

		return trim($field);
	}

	protected function getPath($category_id, $current_path = '') {
		if (isset($this->categories[$category_id])) {
			$this->categories[$category_id]['export'] = 1;

			if (!$current_path) {
				$new_path = $this->categories[$category_id]['id'];
			} else {
				$new_path = $this->categories[$category_id]['id'] . '_' . $current_path;
			}	

			if (isset($this->categories[$category_id]['parentId'])) {
				return $this->getPath($this->categories[$category_id]['parentId'], $new_path);
			} else {
				return $new_path;
			}

		}
	}

	function filterCategory($category) {
		return isset($category['export']);
	}
}
?>