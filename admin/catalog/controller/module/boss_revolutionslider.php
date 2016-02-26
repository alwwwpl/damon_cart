<?php  
class ControllerModuleBossRevolutionSlider extends Controller {
	public function index($setting) {
		static $module = 0;
		//$this->language->load('module/boss_revolutionslider');
		
		$this->load->model('bossthemes/boss_revolutionslider');
		
		$this->document->addStyle('catalog/view/theme/'.$this->config->get('config_template').'/stylesheet/bossthemes/boss_revolutionslider/css/settings.css');
		$this->document->addScript('catalog/view/javascript/bossthemes/jquery.tools.min.js');
		$this->document->addScript('catalog/view/javascript/bossthemes/jquery.revolution.min.js');
		
		$slides = array();
		
		$slides = $this->model_bossthemes_boss_revolutionslider->getSlides($setting['slider_id']);
		
		$slider = array();
		
		$slider = $this->model_bossthemes_boss_revolutionslider->getSlider($setting['slider_id']);
		
		if(!empty($slider )){
			$data['slidersetting'] = json_decode($slider['setting'], true);
		}else{
			$data['slidersetting'] = array();
		}
		
		$data['slides'] = array();
		
		if(!empty($slides)){
			foreach($slides as $slide){
				$data['slides'][] = array(
					'slide_id' => $slide['id'],
					'slider_id' => $slide['slider_id'],
					'status'	=> $slide['status'],
					'sort_order' => $slide['sort_order'],
					'slideset' => json_decode($slide['slideset'], true),
					'captions' => json_decode($slide['caption'], true)
				);
			}
		
		
			$data['module'] = $module++;
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/boss_revolutionslider.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/boss_revolutionslider.tpl', $data);
			} else {
				return $this->load->view('default/template/module/boss_revolutionslider.tpl', $data);
			}
		
		}
	}
}
?>