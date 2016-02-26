<?php
class ControllerCheckoutCoupons extends Controller {

    public function text()
    {
        $this->load->model('checkout/coupons');
        $coupons_info = $this->model_checkout_coupons->getCoupons('MHHJPV2P');
        var_dump($coupons_info);
    }

    public function index() {
        if ($this->config->get('coupon_status')) {
            $this->load->language('checkout/coupons');

            $data['heading_title'] = $this->language->get('heading_title');

            $data['text_loading'] = $this->language->get('text_loading');

            $data['entry_coupons'] = $this->language->get('entry_coupons');

            $data['button_coupons'] = $this->language->get('heading_title');

            if (isset($this->session->data['coupons'])) {
                $data['coupons'] = $this->session->data['coupons'];
            } else {
                $data['coupons'] = '';
            }

            if (isset($this->request->get['redirect']) && !empty($this->request->get['redirect'])) {
                $data['redirect'] = $this->request->get['redirect'];
            } else {
                $data['redirect'] = $this->url->link('checkout/cart');
            }

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/coupons.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/checkout/coupons.tpl', $data);
            } else {
                return $this->load->view('default/template/checkout/coupons.tpl', $data);
            }
        }
    }

    public function coupons() {
        $this->load->language('checkout/coupons');

        $json = array();

        $this->load->model('checkout/coupons');

        if (isset($this->request->post['coupons'])) {
            $coupons = $this->request->post['coupons'];
        } else {
            $coupons = '';
        }

        $coupons_info = $this->model_checkout_coupons->getCoupons($coupons);

        if (empty($this->request->post['coupons'])) {
            $json['error'] = $this->language->get('error_empty');
        } elseif ($coupons_info) {
            $this->session->data['coupons'] = $this->request->post['coupons'];

            $this->session->data['success'] = $this->language->get('text_success');

            $json['redirect'] = $this->url->link('checkout/cart');
        } else {
            $json['error'] = $this->language->get('error_coupons');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}