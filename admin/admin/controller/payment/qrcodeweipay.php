<?php 
class ControllerPaymentQrcodeweipay extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('payment/qrcodeweipay');

		$this->document->settitle($this->language->get('heading_title'));
		
		if (isset($this->error['qrcodeweipay_appid'])) {
			$data['error_appid'] = $this->error['qrcodeweipay_appid'];
		} else {
			$data['error_appid'] = '';
		}

		if (isset($this->error['qrcodeweipay_mchid'])) {
			$data['error_mchid'] = $this->error['qrcodeweipay_mchid'];
		} else {
			$data['error_mchid'] = '';
		}

		if (isset($this->error['qrcodeweipay_appsecret'])) {
			$data['error_appsecret'] = $this->error['qrcodeweipay_appsecret'];
		} else {
			$data['error_appsecret'] = '';
		}

		if (isset($this->error['qrcodeweipay_key'])) {
			$data['error_key'] = $this->error['qrcodeweipay_key'];
		} else {
			$data['error_key'] = '';
		}
		
   		$data['breadcrumbs']  = array();

   		$data['breadcrumbs'][] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=common/home&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

   		$data['breadcrumbs'][] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('text_payment'),
      		'separator' =>' > '
   		);

   		$data['breadcrumbs'][] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=payment/qrcodeweipay&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('heading_title'),
      		'separator' =>' > '
   		);
   		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('qrcodeweipay', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		
		$data['entry_order_finish_status'] = $this->language->get('entry_order_finish_status');	
		$data['entry_order_status'] = $this->language->get('entry_order_status');	
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_key'] = $this->language->get('entry_key');
		$data['entry_appid'] = $this->language->get('entry_appid');
		$data['entry_mchid'] = $this->language->get('entry_mchid');
		$data['entry_appsecret'] = $this->language->get('entry_appsecret');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
 		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}


		$data['action'] = HTTPS_SERVER . 'index.php?route=payment/qrcodeweipay&token=' . $this->session->data['token'];
		
		$data['cancel'] =  HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token'];
		
		
		if (isset($this->request->post['qrcodeweipay_appid'])) {
			$data['qrcodeweipay_appid'] = $this->request->post['qrcodeweipay_appid'];
		} else {
			$data['qrcodeweipay_appid'] = $this->config->get('qrcodeweipay_appid');
		}

		if (isset($this->request->post['qrcodeweipay_mchid'])) {
			$data['qrcodeweipay_mchid'] = $this->request->post['qrcodeweipay_mchid'];
		} else {
			$data['qrcodeweipay_mchid'] = $this->config->get('qrcodeweipay_mchid');
		}

		if (isset($this->request->post['qrcodeweipay_appsecret'])) {
			$data['qrcodeweipay_appsecret'] = $this->request->post['qrcodeweipay_appsecret'];
		} else {
			$data['qrcodeweipay_appsecret'] = $this->config->get('qrcodeweipay_appsecret');
		}

		if (isset($this->request->post['qrcodeweipay_key'])) {
			$data['qrcodeweipay_key'] = $this->request->post['qrcodeweipay_key'];
		} else {
			$data['qrcodeweipay_key'] = $this->config->get('qrcodeweipay_key');
		}
		
		if (isset($this->request->post['qrcodeweipay_order_status_id'])) {
			$data['qrcodeweipay_order_status_id'] = $this->request->post['qrcodeweipay_order_status_id'];
		} else {
			$data['qrcodeweipay_order_status_id'] = $this->config->get('qrcodeweipay_order_status_id'); 
		} 

		if (isset($this->request->post['qrcodeweipay_order_finish_status_id'])) {
			$data['qrcodeweipay_order_finish_status_id'] = $this->request->post['qrcodeweipay_order_finish_status_id'];
		} else {
			$data['qrcodeweipay_order_finish_status_id'] = $this->config->get('qrcodeweipay_order_finish_status_id'); 
		} 

		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
			
		$this->load->model('localisation/geo_zone');
										
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['qrcodeweipay_status'])) {
			$data['qrcodeweipay_status'] = $this->request->post['qrcodeweipay_status'];
		} else {
			$data['qrcodeweipay_status'] = $this->config->get('qrcodeweipay_status');
		}
		
		if (isset($this->request->post['qrcodeweipay_sort_order'])) {
			$data['qrcodeweipay_sort_order'] = $this->request->post['qrcodeweipay_sort_order'];
		} else {
			$data['qrcodeweipay_sort_order'] = $this->config->get('qrcodeweipay_sort_order');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('payment/qrcodeweipay.tpl', $data));
	}


	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/qrcodeweipay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
	
		if (!$this->request->post['qrcodeweipay_appid']) {
			$this->error['qrcodeweipay_appid'] = $this->language->get('error_appid');
		}

		if (!$this->request->post['qrcodeweipay_mchid']) {
			$this->error['qrcodeweipay_mchid'] = $this->language->get('error_mchid');
		}

		if (!$this->request->post['qrcodeweipay_appsecret']) {
			$this->error['qrcodeweipay_appsecret'] = $this->language->get('error_appsecret');
		}

		if (!$this->request->post['qrcodeweipay_key']) {
			$this->error['qrcodeweipay_key'] = $this->language->get('qrcodeweipay_key');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}
?>