<?php
//class popup Ajax login 
// author by Phatoa 
// http://MMOSolution.com
class ControllerModuleMmosLogin extends Controller {

    private $error = array();

    public function index() {
        $this->load->model('account/customer');

        $this->load->language('account/login');


        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            // Default Shipping Address
            $this->load->model('account/address');

            $address_info = $this->model_account_address->getAddress($this->customer->getAddressId());

            if ($address_info) {
                if ($this->config->get('config_tax_customer') == 'shipping') {
                    $this->session->data['shipping_country_id'] = $address_info['country_id'];
                    $this->session->data['shipping_zone_id'] = $address_info['zone_id'];
                    $this->session->data['shipping_postcode'] = $address_info['postcode'];
                }

                if ($this->config->get('config_tax_customer') == 'payment') {
                    $this->session->data['payment_country_id'] = $address_info['country_id'];
                    $this->session->data['payment_zone_id'] = $address_info['zone_id'];
                }
            } else {
                unset($this->session->data['shipping_country_id']);
                unset($this->session->data['shipping_zone_id']);
                unset($this->session->data['shipping_postcode']);
                unset($this->session->data['payment_country_id']);
                unset($this->session->data['payment_zone_id']);
            }

            $test = array('login2price_statuslogin' => '1');

            echo json_encode($test);
        } else {
            $test = array('login2price_statuslogin' => '0', 'error' => $this->error['warning']);

            echo json_encode($test);
        }
    }

    protected function validate() {


        if (!$this->customer->login($this->request->post['email'], $this->request->post['password'])) {
            $this->error['warning'] = $this->language->get('error_login');
        }

        $customer_info = $this->model_account_customer->getCustomerByEmail($this->request->post['email']);

        if ($customer_info && !$customer_info['approved']) {
            $this->error['warning'] = $this->language->get('error_approved');
        }
        
        return !$this->error;
    }

}

?>