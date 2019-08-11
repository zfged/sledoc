<?php
class ControllerModuleCategoryList extends Controller {
	protected function index($setting) {

		$this->data['heading_title'] = $setting['title'];

		$this->load->model('module/categorylist');

		$this->load->model('tool/image');

		$this->data['categories'] = array();

		$results = $this->model_module_categorylist->getCategories($setting['limit']);

		foreach($results as $result) {
			if($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], $setting['image_width'], $setting['image_height']);
			} else {
				$image = false;
			}

			$this->data['categories'][] = array(
				'name'  => $result['name'],
				'href'  => $this->url->link('product/category', 'path=' . $result['category_id']),
				'thumb' => $image,
			);
		}

		if(file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/categorylist.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/categorylist.tpl';
		} else {
			$this->template = 'default/template/module/categorylist.tpl';
		}

		$this->render();
	}
}

?>