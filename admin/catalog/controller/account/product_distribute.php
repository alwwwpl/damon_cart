<?php
class ControllerAccountProductDistribute extends Controller {
    public $error = array();

    public function index() {
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('account/order', '', 'SSL');

            $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        }

        $this->load->language('account/product_distribute');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('account/product_distribute');
        $this->load->model('account/customer');

        $this->load->model('tool/image');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_account'),
            'href' => $this->url->link('account/account', '', 'SSL')
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('account/product_distribute', '', 'SSL')
        );

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_empty'] = $this->language->get('text_empty');
        $data['text_description'] = sprintf($this->language->get('text_description'), $this->config->get('config_name'));
        $data['text_share_url'] = $this->language->get('text_share_url');

        $data['entry_code'] = $this->language->get('entry_code');
        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_price'] = $this->language->get('entry_price');
        $data['entry_store_name'] = $this->language->get('entry_store_name');
        $data['entry_store_logo'] = $this->language->get('entry_store_logo');

        $customer = $this->model_account_customer->getCustomer($this->customer->getId());
        $data['store_name'] = $customer['store_name'];
        if($customer['store_logo']){
            $image = $this->model_tool_image->resize($customer['store_logo'], 100, 100);
            $data['store_logo'] = $image;
        }else{
            $data['store_logo'] = '';
        }

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_account_product_distribute->addProductDistribute($this->request->post);

            $this->session->data['success'] = $this->language->get('text_add');

            // Add to activity log
            $this->load->model('account/activity');

            $activity_data = array(
                'customer_id' => $this->customer->getId(),
                'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
            );

            $this->model_account_activity->addActivity('product_distribute_add', $activity_data);

            $this->response->redirect($this->url->link('account/product_distribute', '', 'SSL'));
        }

        $data['product_distributes'] = array();
        $results = $this->model_account_product_distribute->getProductDistributes();
        foreach ($results as $result) {
            $data['product_distributes'][] = array(
                'product_distribute_id' => $result['product_distribute_id'],
                'name' => $result['name'],
                'price' => isset($result['supplier_price']) ? $result['supplier_price'] : $result['price'],
                'distribute_price' => $result['distribute_price'],
                'link'     => $this->url->link('product/product', 'product_id=' . $result['product_id'], 'SSL'),
                'edit'     => $this->url->link('account/product_distribute/edit', 'product_distribute_id=' . $result['product_distribute_id'], 'SSL'),
                'delete'     => $this->url->link('account/product_distribute/delete', 'product_distribute_id=' . $result['product_distribute_id'], 'SSL')
            );
        }

        $data['action'] = $this->url->link('account/product_distribute', '', 'SSL');
        $data['update_store_action'] = $this->url->link('account/product_distribute/update_store', '', 'SSL');
        $data['share_url'] = $this->url->link('product/product_distribute', 'id='. $this->customer->getId());

        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_submit'] = $this->language->get('button_submit');

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/product_distribute.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/product_distribute.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/account/product_distribute.tpl', $data));
        }
    }

    public function validateForm() {
        if (intval($this->request->post['product_id']) < 1) {
            $this->error['product_id'] = $this->language->get('error_product');
        }

        if ((floatval($this->request->post['price'])) < 0) {
            $this->error['price'] = $this->language->get('error_price');
        }

        return !$this->error;
    }

    public function autocomplete() {
        $json = array();

        if (isset($this->request->get['filter_name'])) {
            $this->load->model('catalog/product');

            $filter_data = array(
                'filter_name' => $this->request->get['filter_name'],
                'start'       => 0,
                'limit'       => 5
            );

            $results = $this->model_catalog_product->getProducts($filter_data);

            foreach ($results as $result) {
                $json[] = array(
                    'name' => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
                    'id' => $result['product_id'],
                    'price' => $result['price'],
                );
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function delete() {
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('account/product_distribute', '', 'SSL');

            $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        }

        $this->load->language('account/product_distribute');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('account/product_distribute');

        if (isset($this->request->get['product_distribute_id']) && $this->validateDelete()) {
            $this->model_account_product_distribute->deleteProductDistribute($this->request->get['product_distribute_id']);
            $this->session->data['success'] = $this->language->get('text_delete');

            // Add to activity log
            $this->load->model('account/activity');

            $activity_data = array(
                'customer_id' => $this->customer->getId(),
                'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
            );

            $this->model_account_activity->addActivity('product_distribute_delete', $activity_data);

            $this->response->redirect($this->url->link('account/product_distribute', '', 'SSL'));
        }
    }

    public function update_store() {
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('account/product_distribute', '', 'SSL');

            $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        }

        $this->load->language('account/product_distribute');
        $this->load->model('account/customer');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('account/product_distribute');

        if (isset($this->request->post['store_name'])) {
            $customer = $this->model_account_customer->getCustomer($this->customer->getId());
            $customer['store_name'] = $this->request->post['store_name'];
            $old_store_logo = $customer['store_logo'];
            if($this->request->files['store_logo']['tmp_name']){
                @ mkdir(DIR_IMAGE . 'catalog/store/', 0777, true);
                $filename = uniqid() . '.jpg';

                move_uploaded_file($this->request->files['store_logo']['tmp_name'], DIR_IMAGE . 'catalog/store/' . $filename);

                $store_logo = 'catalog/store/' . $filename;
                $customer['store_logo'] = $store_logo;
            }

            $this->model_account_customer->editCustomerStore($customer);

            if($this->request->files['store_logo']['tmp_name'] && $old_store_logo){
                @ unlink(DIR_IMAGE . $old_store_logo);
            }

            $this->model_account_product_distribute->deleteProductDistribute($this->request->get['product_distribute_id']);

            $this->session->data['success'] = $this->language->get('text_success');

            // Add to activity log
            $this->load->model('account/activity');

            $activity_data = array(
                'customer_id' => $this->customer->getId(),
                'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
            );

            $this->model_account_activity->addActivity('customer.update_store', $activity_data);
        }

        $this->response->redirect($this->url->link('account/product_distribute', '', 'SSL'));
    }

    public function validateDelete(){
        return true;
    }

    public function edit() {
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->load->model('account/product_distribute');

            $this->model_account_product_distribute->editProductDistribute($this->request->post['product_id'],$this->request->post);

            $this->session->data['success'] = '操作成功!';

            // Add to activity log
            $this->load->model('account/activity');

            $activity_data = array(
                'customer_id' => $this->customer->getId(),
                'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
            );

            $this->model_account_activity->addActivity('product_distribute_update', $activity_data);

            echo 'success';
        }
        else
        {
            echo 'error';
        }
    }

    public function add() {
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->load->model('account/product_distribute');

            $product_distribute_id = $this->model_account_product_distribute->addProductDistribute($this->request->post);

            $this->session->data['success'] = '操作成功!';

            // Add to activity log
            $this->load->model('account/activity');

            $activity_data = array(
                'customer_id' => $this->customer->getId(),
                'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
            );

            $this->model_account_activity->addActivity('product_distribute_add', $activity_data);

            if ($product_distribute_id)
            {
                echo json_encode(array('status'=>'success'));
            }
            else
            {
                echo json_encode(array('status'=>'repeat'));
            }

        }
        else
        {
            $this->error['status'] = 'error';
            echo json_encode($this->error);
        }
    }
}