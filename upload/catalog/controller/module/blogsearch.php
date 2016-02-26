<?php
class ControllerModuleBlogSearch extends Controller {
	public function index($setting) {
		if(empty($setting)) return;
		$this->load->model('bossblog/article');		
		if(!$this->model_bossblog_article->checkModule('bossblog')){
			return;
		}
		$this->load->language('module/blogsearch');

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_search'] = $this->language->get('text_search');

		if (isset($this->request->get['search'])) {
			$data['search'] = $this->request->get['search'];
		} else {
			$data['search'] = '';
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/blogsearch.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/blogsearch.tpl', $data);
		} else {
			return $this->load->view('default/template/module/blogsearch.tpl', $data);
		}
	}
}