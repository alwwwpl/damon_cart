<?php
class ControllerSaleGold extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('sale/order');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/gold');

        $this->getList();
    }

    public function add() {
        $this->load->language('sale/customer');

        $this->document->setTitle('添加金价数据');

        $this->load->model('sale/gold');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_sale_gold->addGold($this->request->post);

            $this->session->data['success'] = '添加金价数据成功！';

            $url = '';

            $this->response->redirect($this->url->link('sale/gold', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function edit() {

        $this->load->language('sale/customer');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/gold');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_sale_gold->editGold($this->request->get['gold_id'], $this->request->post);

            $this->session->data['success'] = '更新金价数据成功！';

            $url = '';

            $this->response->redirect($this->url->link('sale/gold', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();

    }

    public function delete() {
        $this->load->language('sale/order');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/gold');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $gold_id) {
                $this->model_sale_gold->deleteGold($gold_id);
            }

            $this->session->data['success'] = '删除成功！';

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('sale/gold', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        elseif (isset($this->request->get['gold_id']) && !empty($this->request->get['gold_id']))
        {
            $this->model_sale_gold->deleteGold($this->request->get['gold_id']);
        }

        $this->getList();
    }

    protected function getList() {

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'o.gold_id';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';


        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('sale/gold', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        $data['add'] = $this->url->link('sale/gold/add', 'token=' . $this->session->data['token'], 'SSL');
        $data['delete'] = $this->url->link('sale/gold/delete', 'token=' . $this->session->data['token'], 'SSL');

        $data['golds'] = array();

        $filter_data = array(
            'sort'                 => $sort,
            'order'                => $order,
            'start'                => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit'                => $this->config->get('config_limit_admin')
        );

        $gold_total = $this->model_sale_gold->getTotalGolds();

        $results = $this->model_sale_gold->getGolds($filter_data);

        foreach ($results as $result) {
            $data['golds'][] = array(
                'gold_id'           => $result['gold_id'],
                'gold_category'     => $result['gold_category'],
                'latest'            => $result['latest'],
                'opening'           => $result['opening'],
                'highest'           => $result['highest'],
                'lowest'            => $result['lowest'],
                'yesterday'         => $result['yesterday'],
                'upsdowns'          => $result['upsdowns'],
                'datetime'          => date('Y-m-d', strtotime($result['datetime'])),
                'edit'              => $this->url->link('sale/gold/edit', 'token=' . $this->session->data['token'] . '&gold_id=' . $result['gold_id'] . $url, 'SSL'),
                'delete'            => $this->url->link('sale/gold/delete', 'token=' . $this->session->data['token'] . '&gold_id=' . $result['gold_id'] . $url, 'SSL')
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');


        $data['token'] = $this->session->data['token'];

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $url = '';

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_gold'] = $this->url->link('sale/gold', 'token=' . $this->session->data['token'] . '&sort=g.gold_id' . $url, 'SSL');
        $data['sort_gold_category_id'] = $this->url->link('sale/gold', 'token=' . $this->session->data['token'] . '&sort=g.gold_category_id' . $url, 'SSL');
        $data['sort_latest'] = $this->url->link('sale/gold', 'token=' . $this->session->data['token'] . '&sort=g.latest' . $url, 'SSL');
        $data['sort_opening'] = $this->url->link('sale/gold', 'token=' . $this->session->data['token'] . '&sort=g.opening' . $url, 'SSL');
        $data['sort_highest'] = $this->url->link('sale/gold', 'token=' . $this->session->data['token'] . '&sort=g.highest' . $url, 'SSL');
        $data['sort_lowest'] = $this->url->link('sale/gold', 'token=' . $this->session->data['token'] . '&sort=g.lowest' . $url, 'SSL');
        $data['sort_yesterday'] = $this->url->link('sale/gold', 'token=' . $this->session->data['token'] . '&sort=g.yesterday' . $url, 'SSL');
        $data['sort_upsdowns'] = $this->url->link('sale/gold', 'token=' . $this->session->data['token'] . '&sort=g.upsdowns' . $url, 'SSL');
        $data['sort_datetime'] = $this->url->link('sale/gold', 'token=' . $this->session->data['token'] . '&sort=g.datetime' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $gold_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('sale/gold', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($gold_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($gold_total - $this->config->get('config_limit_admin'))) ? $gold_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $gold_total, ceil($gold_total / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('sale/gold_list.tpl', $data));
    }

    protected function getForm() {
        $data['heading_title'] = '金价设置';

        $data['text_form'] = !isset($this->request->get['gold_id']) ? '添加金价' : '修改金价';
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_select'] = $this->language->get('text_select');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_loading'] = $this->language->get('text_loading');
        $data['text_add_ban_ip'] = $this->language->get('text_add_ban_ip');
        $data['text_remove_ban_ip'] = $this->language->get('text_remove_ban_ip');

        $data['entry_customer_group'] = $this->language->get('entry_customer_group');
        $data['entry_firstname'] = $this->language->get('entry_firstname');
        $data['entry_lastname'] = $this->language->get('entry_lastname');
        $data['entry_email'] = $this->language->get('entry_email');
        $data['entry_telephone'] = $this->language->get('entry_telephone');
        $data['entry_fax'] = $this->language->get('entry_fax');
        $data['entry_password'] = $this->language->get('entry_password');
        $data['entry_confirm'] = $this->language->get('entry_confirm');
        $data['entry_newsletter'] = $this->language->get('entry_newsletter');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_approved'] = $this->language->get('entry_approved');
        $data['entry_safe'] = $this->language->get('entry_safe');
        $data['entry_company'] = $this->language->get('entry_company');
        $data['entry_address_1'] = $this->language->get('entry_address_1');
        $data['entry_address_2'] = $this->language->get('entry_address_2');
        $data['entry_city'] = $this->language->get('entry_city');
        $data['entry_postcode'] = $this->language->get('entry_postcode');
        $data['entry_zone'] = $this->language->get('entry_zone');
        $data['entry_country'] = $this->language->get('entry_country');
        $data['entry_default'] = $this->language->get('entry_default');
        $data['entry_comment'] = $this->language->get('entry_comment');
        $data['entry_description'] = $this->language->get('entry_description');
        $data['entry_amount'] = $this->language->get('entry_amount');
        $data['entry_points'] = $this->language->get('entry_points');

        $data['help_safe'] = $this->language->get('help_safe');
        $data['help_points'] = $this->language->get('help_points');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_address_add'] = $this->language->get('button_address_add');
        $data['button_history_add'] = $this->language->get('button_history_add');
        $data['button_transaction_add'] = $this->language->get('button_transaction_add');
        $data['button_reward_add'] = $this->language->get('button_reward_add');
        $data['button_remove'] = $this->language->get('button_remove');
        $data['button_upload'] = $this->language->get('button_upload');

        $data['tab_general'] = $this->language->get('tab_general');
        $data['tab_address'] = $this->language->get('tab_address');
        $data['tab_history'] = $this->language->get('tab_history');
        $data['tab_transaction'] = $this->language->get('tab_transaction');
        $data['tab_reward'] = $this->language->get('tab_reward');
        $data['tab_ip'] = $this->language->get('tab_ip');

        $data['token'] = $this->session->data['token'];

        if (isset($this->request->get['gold_id'])) {
            $data['gold_id'] = $this->request->get['gold_id'];
        } else {
            $data['gold_id'] = 0;
        }
        $url = '';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('sale/gold', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        if (!isset($this->request->get['gold_id'])) {
            $data['action'] = $this->url->link('sale/gold/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('sale/gold/edit', 'token=' . $this->session->data['token'] . '&gold_id=' . $this->request->get['gold_id'] . $url, 'SSL');
        }

        $data['cancel'] = $this->url->link('sale/gold', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['gold_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $gold_info = $this->model_sale_gold->getGold($this->request->get['gold_id']);
        }

        if (!empty($gold_info['gold_category'])){
            $data['gold_category'] = $gold_info['gold_category'];
        }
        else{
            $data['gold_category'] = '';
        }

        if (!empty($gold_info['gold_category_id'])){
            $data['gold_category_id'] = $gold_info['gold_category_id'];
        }
        else{
            $data['gold_category_id'] = '';
        }

        if (!empty($gold_info['latest'])){
            $data['latest'] = $gold_info['latest'];
        }
        else{
            $data['latest'] = '';
        }

        if (!empty($gold_info['opening'])){
            $data['opening'] = $gold_info['opening'];
        }
        else{
            $data['opening'] = '';
        }

        if (!empty($gold_info['highest'])){
            $data['highest'] = $gold_info['highest'];
        }
        else{
            $data['highest'] = '';
        }

        if (!empty($gold_info['lowest'])){
            $data['lowest'] = $gold_info['lowest'];
        }
        else{
            $data['lowest'] = '';
        }

        if (!empty($gold_info['yesterday'])){
            $data['yesterday'] = $gold_info['yesterday'];
        }
        else{
            $data['yesterday'] = '';
        }

        if (!empty($gold_info['upsdowns'])){
            $data['upsdowns'] = $gold_info['upsdowns'];
        }
        else{
            $data['upsdowns'] = '';
        }

        if (!empty($gold_info['datetime'])){
            $data['datetime'] = $gold_info['datetime'];
        }
        else{
            $data['datetime'] = '';
        }

        $data['gold_categorys'] = $this->model_sale_gold->getGoldCategory();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('sale/gold_form.tpl', $data));
    }

    protected function validateForm() {

        if (!is_numeric($this->request->post['latest'])) {
            $this->error['latest'] = '最新价格式不正确！';
        }

        if (!is_numeric($this->request->post['opening'])) {
            $this->error['opening'] = '开盘价格式不正确！';
        }

        if (!is_numeric($this->request->post['highest'])) {
            $this->error['highest'] = '开盘价格式不正确！';
        }

        if (!is_numeric($this->request->post['lowest'])) {
            $this->error['lowest'] = '最底价格式不正确！';
        }

        if (!is_numeric($this->request->post['yesterday'])) {
            $this->error['yesterday'] = '昨收价格式不正确！';
        }

        if ((utf8_strlen($this->request->post['upsdowns']) < 1) || (utf8_strlen(trim($this->request->post['upsdowns'])) > 32)) {
            $this->error['upsdowns'] = '涨跌幅格式不正确！';
        }

        if (!$this->isdate($this->request->post['datetime'])) {
            $this->error['datetime'] = '日期格式不正确！';
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'sale/gold')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    protected function isdate($days) {
        $k = explode('-',$days);
        if(checkdate($k[1],$k[2],$k[0]))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}