<?php
class ControllerFeedHotlineUa extends Controller {

	private $error = array();

    protected function initBreadcrumbs($items) {
        $newItems = array_merge($items, array(array("common/home","text_home")));

        $this->data['breadcrumbs'] = array();

        foreach( $newItems as $item ){
            $this->data['breadcrumbs'][] = array(
                'href'      => $this->url->link($item[0], 'token=' . $this->session->data['token'], 'SSL'),
                'text'      => $this->language->get($item[1]),
                'separator' => (count($this->data['breadcrumbs']) ==0 ? FALSE : ' :: ')
            );
        }
    }

    protected function initParams($items) {
        foreach( $items as $item ){
            $name = $item[0];
            if (isset($this->request->post[$name])) {
                $this->data[$name] = $this->request->post[$name];
            } else if ($this->config->get($name)) {
                $this->data[$name] = $this->config->get($name);
            } else if(isset($item[1])){
                $this->data[$name] = $item[1]; // default value
            }
        }

    }

    protected function initLaguage($module) {
        $this->data = array_merge( $this->data, $this->language->load($module) );
    }

	public function index() {
        $this->initLaguage('feed/hotline_ua');



		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			if (isset($this->request->post['hotline_ua_categories'])) {
				$this->request->post['hotline_ua_categories'] = implode(',', $this->request->post['hotline_ua_categories']);
			}

			$this->model_setting_setting->editSetting('hotline_ua', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL'));
		}

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

        $this->initBreadcrumbs(array(
            array("extension/feed","text_feed"),
            array("feed/hotline_ua","heading_title")
        ));

		$this->data['action'] = $this->url->link('feed/hotline_ua', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL');

        $this->initParams(array(
            array( "hotline_ua_status", "1" ),
            array( "hotline_ua_shopname", $this->config->get("config_name") ),
            array( "hotline_ua_company" ),
            array( "hotline_ua_currency", "UAH" ),
            array( "hotline_ua_in_stock", 7 ),
            array( "hotline_ua_out_of_stock", 5 ),
            array( "hotline_ua_image_width", 600 ),
            array( "hotline_ua_image_height", 600 ),
            array( "hotline_ua_warranty", "12" ),
            array( "hotline_ua_ip_list", "" )
        ));


		$this->load->model('localisation/stock_status');

		$this->data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();

		$this->load->model('catalog/category');

		$this->data['categories'] = $this->model_catalog_category->getCategories(0);

		if (isset($this->request->post['hotline_ua_categories'])) {
			$this->data['hotline_ua_categories'] = $this->request->post['hotline_ua_categories'];
		} elseif ($this->config->get('hotline_ua_categories') != '') {
			$this->data['hotline_ua_categories'] = explode(',', $this->config->get('hotline_ua_categories'));
		} else {
			$this->data['hotline_ua_categories'] = array();
		}

		$this->load->model('localisation/currency');
		$currencies = $this->model_localisation_currency->getCurrencies();
		$allowed_currencies = array_flip(array('UAH'));
		$this->data['currencies'] = array_intersect_key($currencies, $allowed_currencies);
        $this->data['data_feed'] = HTTP_CATALOG . 'index.php?route=feed/hotline_ua';

		$this->template = 'feed/hotline_ua.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render(), $this->config->get('config_compression'));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'feed/hotline_ua')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>
