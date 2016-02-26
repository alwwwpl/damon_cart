<?php
class ControllerAccountBankcard extends Controller {
    public function index() {
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('account/bankcard', '', 'SSL');

            $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        }

        $this->load->language('account/bankcard');

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

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_bankcard'),
            'href' => $this->url->link('account/bankcard', '', 'SSL')
        );

        $this->load->model('account/bankcard');

        $data['heading_title'] = $this->language->get('heading_title');

        $data['column_create_time'] = $this->language->get('column_create_time');
        $data['column_username'] = $this->language->get('column_username');
        $data['column_card_number'] = $this->language->get('column_card_number');
        $data['column_bank'] = $this->language->get('column_bank');
        $data['column_bank_card_id'] = $this->language->get('column_bank_card_id');

        $data['text_total'] = $this->language->get('text_total');
        $data['text_empty'] = $this->language->get('text_empty');

        $data['button_continue'] = $this->language->get('button_continue');

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $data['bankcards'] = array();

        $filter_data = array(
            'sort'  => 'create_time',
            'order' => 'DESC',
            'start' => ($page - 1) * 10,
            'limit' => 10
        );

        $reward_total = $this->model_account_bankcard->getTotalBankcards();

        $results = $this->model_account_bankcard->getBankcards($filter_data);

        foreach ($results as $result) {
            $data['bankcards'][] = array(
                'bank_card_id'  => $result['bank_card_id'],
                'customer_id'   => $result['customer_id'],
                'username'      => $result['username'],
                'card_number'   => $result['card_number'],
                'bank'          => $result['bank'],
                'create_time'   => date($this->language->get('date_format_short'), strtotime($result['create_time'])),
                'href'          => $this->url->link('account/bankcard/edit', 'bank_card_id=' . $result['bank_card_id'], 'SSL')
            );
        }

        $pagination = new Pagination();
        $pagination->total = $reward_total;
        $pagination->page = $page;
        $pagination->limit = 10;
        $pagination->url = $this->url->link('account/bankcard', 'page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['lastname'] = $this->customer->getLastName();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($reward_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($reward_total - 10)) ? $reward_total : ((($page - 1) * 10) + 10), $reward_total, ceil($reward_total / 10));

        $data['total'] = (int)$this->customer->getRewardPoints();

        $data['continue'] = $this->url->link('account/account', '', 'SSL');

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/bankcard.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/bankcard.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/account/bankcard.tpl', $data));
        }
    }


    public function addcard() {

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->load->model('account/bankcard');

            $bankcard_id = $this->model_account_bankcard->addBankcard($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            if ($bankcard_id)
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
        if ((utf8_strlen(trim($this->request->post['bank'])) < 1) || (utf8_strlen(trim($this->request->post['bank'])) > 255)) {
            $this->error['bank'] = '请选择正确的发卡银行';
        }

        if ((utf8_strlen(trim($this->request->post['card_number'])) < 1) || (utf8_strlen(trim($this->request->post['card_number'])) > 100)) {
            $this->error['card_number'] = '银行卡号输入不正确';
        }

        if ((utf8_strlen(trim($this->request->post['username'])) < 1) || (utf8_strlen(trim($this->request->post['username'])) > 100)) {
            $this->error['username'] = '用户姓名不正确';
        }

        return !$this->error;
    }




}