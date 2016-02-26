<?php
class ControllerModuleXocTwitterupdate extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->language->load('module/xoc_twitterupdate');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('extension/module');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('xoc_twitterupdate', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');		
		
		$data['entry_user'] = $this->language->get('entry_user');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_consumer_key'] = $this->language->get('entry_consumer_key');
		$data['entry_consumer_secret'] = $this->language->get('entry_consumer_secret');
		$data['entry_access_token'] = $this->language->get('entry_access_token');
		$data['entry_access_token_secret'] = $this->language->get('entry_access_token_secret');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_profile'] = $this->language->get('entry_profile');
		$data['entry_follow'] = $this->language->get('entry_follow');
		$data['entry_time'] = $this->language->get('entry_time');
		$data['entry_status'] = $this->language->get('entry_status');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/banner', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/xoc_twitterupdate', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);			
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/xoc_twitterupdate', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/xoc_twitterupdate', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}
   		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}	
			
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
		$consumer_key 			= "diqJlQnUitiOrqoJTGOK8Q";
		$consumer_secret 		= "RZ8U79iAAooscyd0fZjzAoqBfdrgLNehm0QJMabA";
		$access_token 			= "859121024-nayLlfxEnETi0bbM1tPjrm3WWkrxHIk5a6WpppxJ";
		$access_token_secret	= "9aEuTIDHnohxVcv7UFzctQYOwDSOgcx1GKq9ELAnI";
		$data_t = array(
			'consumer_key' 	=> $consumer_key,
			'consumer_secret' 	=> $consumer_secret,
			'access_token' 	=> $access_token,
			'access_token_secret' 	=> $access_token_secret,
			'username' 	=> 'bossthemes1'
		);
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		//module
		$data['module'] = array();
		
		if (isset($this->request->post['xoc_twitterupdate_module'])) {
			$data['module'] = $this->request->post['xoc_twitterupdate_module'];
		} elseif (!empty($module_info)) { 
			$data['module'] = $module_info['xoc_twitterupdate_module'];
		}else{
			$data['module'] = array();
		}
		
		if (isset($this->request->post['xoc_twitterupdate_authen'])) {
			$data['xoc_twitterupdate_authen'] = $this->request->post['xoc_twitterupdate_authen'];
		} elseif (!empty($module_info)) { 
			$data['xoc_twitterupdate_authen'] = $module_info['xoc_twitterupdate_authen'];
		}else{
			$data['xoc_twitterupdate_authen'] = $data_t;
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/xoc_twitterupdate.tpl', $data));					
		
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/xoc_twitterupdate')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		if (isset($this->request->post['xoc_twitterupdate_authen'])) {
			$value = array();
			$value = $this->request->post['xoc_twitterupdate_authen'];
			if (!$value['username']) {
				$this->error['username'] = $this->language->get('error_authen');
				$this->error['warning'] = $this->language->get('error_authen');
			}
			if (!$value['consumer_key']) {
				$this->error['consumer_key'] = $this->language->get('error_authen');
				$this->error['warning'] = $this->language->get('error_authen');
			}
			if (!$value['consumer_secret']) {
				$this->error['consumer_secret'] = $this->language->get('error_authen');
				$this->error['warning'] = $this->language->get('error_authen');
			}
			if (!$value['access_token']) {
				$this->error['access_token'] = $this->language->get('error_authen');
				$this->error['warning'] = $this->language->get('error_authen');
			}
			if (!$value['access_token_secret']) {
				$this->error['access_token_secret'] = $this->language->get('error_authen');
				$this->error['warning'] = $this->language->get('error_authen');
			}
		}
		
		return !$this->error;	
	}
}
?>