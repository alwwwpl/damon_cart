<?php  
class ControllerModuleXocTwitterupdate extends Controller {
	public function index($setting) {
		
    	$data['heading_title'] = $setting['xoc_twitterupdate_module']['title'][$this->config->get('config_language_id')];
		$data['limit'] = $setting['xoc_twitterupdate_module']['limit'];
		$data['show_profile'] = $setting['xoc_twitterupdate_module']['profile'];
		$data['show_follow'] = $setting['xoc_twitterupdate_module']['follow'];
		$data['show_time'] = $setting['xoc_twitterupdate_module']['time'];
    	
		$authenItem = array();
		$authenItem = $setting['xoc_twitterupdate_authen'];
		
		$data['username'] = $authenItem['username'];
		$data['consumer_key'] = $authenItem['consumer_key'];
		$data['consumer_secret'] = $authenItem['consumer_secret'];
		$data['access_token'] = $authenItem['access_token'];
		$data['access_token_secret'] = $authenItem['access_token_secret'];
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/xoc_twitterupdate.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/xoc_twitterupdate.tpl';
			return $this->load->view($this->config->get('config_template') . '/template/module/xoc_twitterupdate.tpl', $data);
		} else {
			return $this->load->view('default/template/module/xoc_twitterupdate.tpl', $data);
		}
	}
}
?>