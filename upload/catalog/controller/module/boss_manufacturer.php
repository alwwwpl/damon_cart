<?php
class ControllerModuleBossManufacturer extends Controller {
	public function index($setting) {
		static $module = 0;
		
		if (isset($setting['module_description'][$this->config->get('config_language_id')])) {
			$data['heading_title'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['title'], ENT_QUOTES, 'UTF-8');
		
		
		$this->load->model('catalog/manufacturer');

		$data['manufacturers'] = array();

		$results = $this->model_catalog_manufacturer->getManufacturers();

		foreach ($results as $result) {
			$data['manufacturers'][] = array(
				'manufacturer_id' => $result['manufacturer_id'],
				'name'            => $result['name'],
				'href'            => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $result['manufacturer_id'])
			);
		}
		
		$data['module'] = $module++;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/boss_manufacturer.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/boss_manufacturer.tpl', $data);
		} else {
			return $this->load->view('default/template/module/boss_manufacturer.tpl', $data);
		}
		}
	}
}
?>