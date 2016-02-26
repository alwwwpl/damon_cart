<?php
class Controllerpaymentalipaydirect extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/alipay_direct');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			$this->model_setting_setting->editSetting('alipay_direct', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		
		$data['entry_hezuozhe_id_help'] = $this->language->get('entry_hezuozhe_id_help');
		$data['entry_hezuozhe_id'] = $this->language->get('entry_hezuozhe_id');
		
		$data['entry_zhifubao_account'] = $this->language->get('entry_zhifubao_account');
		

		$data['entry_order_status'] = $this->language->get('entry_order_status');
		
		
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['entry_cod'] = $this->language->get('entry_cod');
		$data['entry_cod_help'] = $this->language->get('entry_cod_help');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_payment'),
			'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('payment/alipay_direct', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('payment/alipay_direct', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->error['alipay_direct_hezuozhe_id'])) {
			$data['error_alipay_direct_hezuozhe_id'] = $this->error['alipay_direct_hezuozhe_id'];
		} else {
			$data['error_alipay_direct_hezuozhe_id'] = '';
		}	
		
		
		if (isset($this->error['alipay_direct_zhifubao_account'])) {
			$data['error_alipay_direct_zhifubao_account'] = $this->error['alipay_direct_zhifubao_account'];
		} else {
			$data['error_alipay_direct_zhifubao_account'] = '';
		}	
		
		
		if (isset($this->error['alipay_direct_cod'])) {
			$data['error_alipay_direct_cod'] = $this->error['alipay_direct_cod'];
		} else {
			$data['error_alipay_direct_cod'] = '';
		}	
		
		
		//合作身份者id
		if (isset($this->request->post['alipay_direct_hezuozhe_id'])) {
			$data['alipay_direct_hezuozhe_id'] = $this->request->post['alipay_direct_hezuozhe_id'];
		} else {
			$data['alipay_direct_hezuozhe_id'] = $this->config->get('alipay_direct_hezuozhe_id');
		}
		
		//收款支付宝账号
		if (isset($this->request->post['alipay_direct_zhifubao_account'])) {
			$data['alipay_direct_zhifubao_account'] = $this->request->post['alipay_direct_zhifubao_account'];
		} else {
			$data['alipay_direct_zhifubao_account'] = $this->config->get('alipay_direct_zhifubao_account');
		}
		
		//安全检验码
		if (isset($this->request->post['alipay_direct_cod'])) {
			$data['alipay_direct_cod'] = $this->request->post['alipay_direct_cod'];
		} else {
			$data['alipay_direct_cod'] = $this->config->get('alipay_direct_cod');
		}
		
		//成功支付后的订单状态
		if (isset($this->request->post['alipay_direct_order_status_id'])) {
			$data['alipay_direct_order_status_id'] = $this->request->post['alipay_direct_order_status_id'];
		} else {
			$data['alipay_direct_order_status_id'] = $this->config->get('alipay_direct_order_status_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		
		//状态
		if (isset($this->request->post['alipay_direct_status'])) {
			$data['alipay_direct_status'] = $this->request->post['alipay_direct_status'];
		} else {
			$data['alipay_direct_status'] = $this->config->get('alipay_direct_status');
		}
		
		//排序
		if (isset($this->request->post['alipay_direct_sort_order'])) {
			$data['alipay_direct_sort_order'] = $this->request->post['alipay_direct_sort_order'];
		} else {
			$data['alipay_direct_sort_order'] = $this->config->get('alipay_direct_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/alipay_direct.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/alipay_direct')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		//合作身份者id
		if (!$this->request->post['alipay_direct_hezuozhe_id']) {
			$this->error['alipay_direct_hezuozhe_id'] = $this->language->get('error_alipay_direct_hezuozhe_id');
		}
		
		//收款支付宝账号
		if (!$this->request->post['alipay_direct_zhifubao_account']) {
			$this->error['alipay_direct_zhifubao_account'] = $this->language->get('error_alipay_direct_zhifubao_account');
		}
		
		//安全检验码
		if (!$this->request->post['alipay_direct_cod']) {
			$this->error['alipay_direct_cod'] = $this->language->get('error_alipay_direct_cod');
		}

		return !$this->error;
	}
}