<?php
class Controllerpaymentchinapay extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('payment/chinapay');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('chinapay', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_all_zones'] = $this->language->get('text_all_zones');

        $data['entry_chinapay_account'] = $this->language->get('entry_chinapay_account');

        $data['entry_chinapay_md5key'] = $this->language->get('entry_chinapay_md5key');

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
            'href' => $this->url->link('payment/chinapay', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('payment/chinapay', 'token=' . $this->session->data['token'], 'SSL');

        $data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

        if (isset($this->error['error_chinapay_account'])) {
            $data['error_chinapay_account'] = $this->error['error_chinapay_account'];
        } else {
            $data['error_chinapay_account'] = '';
        }

        //商户号
        if (isset($this->request->post['chinapay_account'])) {
            $data['chinapay_account'] = $this->request->post['chinapay_account'];
        } else {
            $data['chinapay_account'] = $this->config->get('chinapay_account');
        }

        //成功支付后的订单状态
        if (isset($this->request->post['chinapay_order_status_id'])) {
            $data['chinapay_order_status_id'] = $this->request->post['chinapay_order_status_id'];
        } else {
            $data['chinapay_order_status_id'] = $this->config->get('chinapay_order_status_id');
        }

        $this->load->model('localisation/order_status');

        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();


        //状态
        if (isset($this->request->post['chinapay_status'])) {
            $data['chinapay_status'] = $this->request->post['chinapay_status'];
        } else {
            $data['chinapay_status'] = $this->config->get('chinapay_status');
        }

        //排序
        if (isset($this->request->post['chinapay_sort_order'])) {
            $data['chinapay_sort_order'] = $this->request->post['chinapay_sort_order'];
        } else {
            $data['chinapay_sort_order'] = $this->config->get('chinapay_sort_order');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('payment/chinapay.tpl', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'payment/chinapay')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        //收款支付账号
        if (!$this->request->post['chinapay_account']) {
            $this->error['chinapay_account'] = $this->language->get('chinapay_account');
        }

        return !$this->error;
    }
}
