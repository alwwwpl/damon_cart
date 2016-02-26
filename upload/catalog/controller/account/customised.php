<?php
/**
 * Created by PhpStorm.
 * User: sucjun
 * Date: 15/10/9
 * Time: 上午10:15
 */
class ControllerAccountCustomised extends Controller {
    private $error = array();
    public function index() {
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('account/customised', '', 'SSL');

            $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        }

        $this->load->language('account/customised');

        $this->document->setTitle($this->language->get('heading_title'));

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_account'),
            'href' => $this->url->link('account/account', '', 'SSL')
        );

        $url = '';

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('account/customised', $url, 'SSL')
        );

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_empty'] = $this->language->get('text_empty');

        $data['column_customised_id'] = $this->language->get('column_customised_id');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_date_added'] = $this->language->get('column_date_added');
        $data['column_action'] = $this->language->get('column_action');
        $data['column_model'] = $this->language->get('column_model');
        $data['column_name'] = $this->language->get('column_name');
        $data['column_image'] = $this->language->get('column_image');
        $data['column_quantity'] = $this->language->get('column_quantity');
        $data['column_brand'] = $this->language->get('column_brand');

        $data['button_view'] = $this->language->get('button_view');
        $data['button_continue'] = $this->language->get('button_continue');

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $data['customiseds'] = array();

        $this->load->model('account/customised');

        $customised_total = $this->model_account_customised->getTotalcustomiseds();

        $results = $this->model_account_customised->getCustomiseds(($page - 1) * 10, 10);

        foreach ($results as $result) {

            $data['customiseds'][] = array(
                'customised_id' => $result['customised_id'],
                'name'          => $result['product_name'],
                'product_type'  => $result['product_type'],
                'status'        => $result['status'],
                'image'         => $result['image'],
                'number'        => $result['number'],
                'product_brand' => $result['product_brand'],
                'date_added'    => date($this->language->get('date_format_short'), strtotime($result['datetime'])),
                'href'          => $this->url->link('account/customised/info', 'customised_id=' . $result['customised_id'], 'SSL'),
            );
        }

        $pagination = new Pagination();
        $pagination->total = $customised_total;
        $pagination->page = $page;
        $pagination->limit = 10;
        $pagination->url = $this->url->link('account/customised', 'page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

//        $data['results'] = sprintf($this->language->get('text_pagination'), ($customised_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($order_total - 10)) ? $order_total : ((($page - 1) * 10) + 10), $order_total, ceil($order_total / 10));

        $data['continue'] = $this->url->link('account/account', '', 'SSL');

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/customised_list.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/customised_list.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/account/customised_list.tpl', $data));
        }
    }

    public function info() {

        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('account/customised', '', 'SSL');

            $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        }

        $this->load->language('account/customised');

        $this->document->setTitle($this->language->get('heading_title'));

        $customised_id = $this->request->get['customised_id'];

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_account'),
            'href' => $this->url->link('account/account', '', 'SSL')
        );

        $url = '';

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('account/customised', $url, 'SSL')
        );

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_empty'] = $this->language->get('text_empty');

        $data['add_customised_name'] = $this->language->get('add_customised_name');
        $data['add_customised_type'] = $this->language->get('add_customised_type');
        $data['add_customised_brand'] = $this->language->get('add_customised_brand');
        $data['add_customised_number'] = $this->language->get('add_customised_number');
        $data['add_customised_image'] = $this->language->get('add_customised_image');
        $data['add_customised_desc'] = $this->language->get('add_customised_desc');
        $data['add_customised_up'] = $this->language->get('add_customised_up');
        $data['add_customised_sumbit'] = $this->language->get('add_customised_sumbit');
        $data['text_add'] = $this->language->get('text_add');
        $data['action'] = './index.php?route=account/customised/add';

        $data['button_view'] = $this->language->get('button_view');
        $data['button_continue'] = $this->language->get('button_continue');

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $data['customiseds'] = array();

        $this->load->model('account/customised');

        $this->load->model('account/message');

        $result = $this->model_account_customised->getCustomised($customised_id);

        $data['customiseds'] = array(
            'customised_id' => $result['customised_id'],
            'product_name'          => $result['product_name'],
            'product_type'  => $result['product_type'],
            'status'        => $result['status'],
            'image'         => $result['image'],
            'number'        => $result['number'],
            'product_brand' => $result['product_brand'],
            'description'   => $result['description'],
            'date_added'    => date($this->language->get('date_format_short'), strtotime($result['datetime'])),
            'href'          => $this->url->link('account/customised/info', 'customised_id=' . $result['customised_id'], 'SSL'),
        );

        $messages = $this->model_account_message->getMessages($customised_id);
        if (!empty($messages))
        {
            foreach ($messages as $message)
            {
                $data['messages'][] = array(
                    'customised_id' => $message['customised_id'],
                    'title'         => $message['title'],
                    'content'       => $message['content'],
                    'datetime'      => $message['datetime'],
                );
            }
        }

        $data['customised_id'] = $customised_id;
        $data['continue'] = $this->url->link('account/account', '', 'SSL');

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/customised_info.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/customised_info.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/account/customised_info.tpl', $data));
        }

    }


    public function add() {

        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('account/customised', '', 'SSL');

            $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        }

        $this->load->language('account/customised');

        $this->document->setTitle($this->language->get('heading_title'));

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_account'),
            'href' => $this->url->link('account/account', '', 'SSL')
        );

        $url = '';

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('account/customised', $url, 'SSL')
        );

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_empty'] = $this->language->get('text_empty');

        $data['add_customised_name'] = $this->language->get('add_customised_name');
        $data['add_customised_type'] = $this->language->get('add_customised_type');
        $data['add_customised_brand'] = $this->language->get('add_customised_brand');
        $data['add_customised_number'] = $this->language->get('add_customised_number');
        $data['add_customised_image'] = $this->language->get('add_customised_image');
        $data['add_customised_desc'] = $this->language->get('add_customised_desc');
        $data['add_customised_up'] = $this->language->get('add_customised_up');
        $data['add_customised_sumbit'] = $this->language->get('add_customised_sumbit');
        $data['text_add'] = $this->language->get('text_add');
        $data['action'] = './index.php?route=account/customised/add';

        $data['button_view'] = $this->language->get('button_view');
        $data['button_continue'] = $this->language->get('button_continue');

        $data['customiseds'] = array();

        $this->load->model('account/customised');

        $data['continue'] = $this->url->link('account/account', '', 'SSL');

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/customised_form.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/customised_form.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/account/customised_form.tpl', $data));
        }
    }


    public function insert() {

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->load->language('account/customised');

            $this->load->model('account/customised');

            $customised_id = $this->model_account_customised->addCustomised($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            // Add to activity log
            $this->load->model('account/activity');

            $activity_data = array(
                'customer_id' => $this->customer->getId(),
                'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
            );

            $this->model_account_activity->addActivity('customised_add', $activity_data);

            if ($customised_id)
            {
                echo json_encode(array('status'=>'success'));
            }
        }
        else
        {
            $this->error['status'] = 'error';
            echo json_encode($this->error);
        }
    }

    public function insertmessage() {
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateFormMessage()) {

            $this->load->language('account/customised');

            $this->load->model('account/message');

            $message_id = $this->model_account_message->addMessage($this->request->post);

            $this->session->data['success'] = '操作成功!';

            // Add to activity log
            $this->load->model('account/activity');

            $activity_data = array(
                'customer_id' => $this->customer->getId(),
                'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
            );

            $this->model_account_activity->addActivity('message_add', $activity_data);

            if ($message_id)
            {
                echo json_encode(array('status'=>'success'));
            }
        }
        else
        {
            $this->error['status'] = 'error';
            echo json_encode($this->error);
        }
    }

    protected function validateForm() {
        if ((utf8_strlen(trim($this->request->post['product_name'])) < 1) || (utf8_strlen(trim($this->request->post['product_name'])) > 255)) {
            $this->error['product_name'] = '商品名称输入不正确';
        }

        if ((utf8_strlen(trim($this->request->post['product_type'])) < 1) || (utf8_strlen(trim($this->request->post['product_type'])) > 100)) {
            $this->error['product_type'] = '商品类型输入不正确';
        }

        if ((utf8_strlen(trim($this->request->post['product_brand'])) < 1) || (utf8_strlen(trim($this->request->post['product_brand'])) > 100)) {
            $this->error['product_brand'] = '商品品牌输入不正确';
        }

        if (ctype_digit(trim($this->request->post['number'])) == false) {
            $this->error['number'] = '采购数量输入不正确';
        }

        if ((utf8_strlen(trim($this->request->post['image'])) < 10) || (utf8_strlen(trim($this->request->post['product_brand'])) > 255)) {
            $this->error['product_brand'] = '商品品牌输入不正确';
        }

        if ((utf8_strlen(trim($this->request->post['desc'])) < 1)) {
            $this->error['desc'] = '商品描述输入不正确';
        }

        return !$this->error;
    }

    protected function validateFormMessage() {
        if ((utf8_strlen(trim($this->request->post['title'])) < 1) || (utf8_strlen(trim($this->request->post['title'])) > 255)) {
            $this->error['title'] = '请输入留言标题';
        }

        if (utf8_strlen(trim($this->request->post['content'])) < 10) {
            $this->error['content'] = '留言内容太短了';
        }

        return !$this->error;
    }
}