<?php
class ModelPaymentTonglianpay extends Model {
    public function getMethod($address) {
        $this->load->language('payment/tonglianpay');

        if ($this->config->get('tonglianpay_status')) {
            $status = TRUE;
        } else {
            $status = FALSE;
        }

        $method_data = array();

        if ($status) {
            $method_data = array(
                'code'       => 'tonglianpay',
                'title'      => $this->language->get('text_title'),
                'terms'      => '',
                'sort_order' => $this->config->get('tonglianpay_sort_order')
            );
        }

        return $method_data;
    }
}