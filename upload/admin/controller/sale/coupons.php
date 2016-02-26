<?php
class ControllerSaleCoupons extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('sale/coupons');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/coupons');

        $this->getList();
    }

    public function add() {
        $this->load->language('sale/coupons');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/coupons');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_sale_coupons->addCoupons($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

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

            $this->response->redirect($this->url->link('sale/coupons', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('sale/coupons');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/coupons');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_sale_coupons->editCoupons($this->request->get['coupons_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

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

            $this->response->redirect($this->url->link('sale/coupons', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('marketing/coupon');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('marketing/coupon');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $coupon_id) {
                $this->model_marketing_coupon->deleteCoupon($coupon_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

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

            $this->response->redirect($this->url->link('marketing/coupon', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    protected function getList() {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'coupons_name';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
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
            'href' => $this->url->link('sale/coupons', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        $data['add'] = $this->url->link('sale/coupons/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('sale/coupons/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $data['couponses'] = array();

        $filter_data = array(
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $coupons_total = $this->model_sale_coupons->getTotalCouponses();

        $results = $this->model_sale_coupons->getCouponses($filter_data);

        foreach ($results as $result) {
            $data['couponses'][] = array(
                'coupons_id'     => $result['coupons_id'],
                'coupons_name'   => $result['coupons_name'],
                'agent_id'       => $result['agent_id'],
                'agent_name'     => $result['agent_name'],
                'condition'      => $result['condition'],
                'discount'       => $result['discount'],
                'agent_percent'  => $result['agent_percent'],
                'system_percent' => $result['system_percent'],
                'start_time'     => date($this->language->get('date_format_short'), strtotime($result['start_time'])),
                'over_time'      => date($this->language->get('date_format_short'), strtotime($result['over_time'])),
                'edit'           => $this->url->link('sale/coupons/edit', 'token=' . $this->session->data['token'] . '&coupons_id=' . $result['coupons_id'] . $url, 'SSL'),
                'info'           => $this->url->link('sale/coupons/info', 'token=' . $this->session->data['token'] . '&coupons_id=' . $result['coupons_id'] . $url, 'SSL')
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');

        $data['column_name'] = $this->language->get('column_name');
        $data['column_code'] = $this->language->get('column_code');
        $data['column_discount'] = $this->language->get('column_discount');
        $data['column_date_start'] = $this->language->get('column_date_start');
        $data['column_date_end'] = $this->language->get('column_date_end');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_action'] = $this->language->get('column_action');

        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');

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

        $data['sort_coupons_name'] = $this->url->link('sale/coupons', 'token=' . $this->session->data['token'] . '&sort=coupons_name' . $url, 'SSL');
        $data['sort_agent_name'] = $this->url->link('sale/coupons', 'token=' . $this->session->data['token'] . '&sort=agent_name' . $url, 'SSL');
        $data['sort_condition'] = $this->url->link('sale/coupons', 'token=' . $this->session->data['token'] . '&sort=condition' . $url, 'SSL');
        $data['sort_discount'] = $this->url->link('sale/coupons', 'token=' . $this->session->data['token'] . '&sort=discount' . $url, 'SSL');
        $data['sort_agent_percent'] = $this->url->link('sale/coupons', 'token=' . $this->session->data['token'] . '&sort=agent_percent' . $url, 'SSL');
        $data['sort_system_percent'] = $this->url->link('sale/coupons', 'token=' . $this->session->data['token'] . '&sort=system_percent' . $url, 'SSL');
        $data['sort_start_time'] = $this->url->link('sale/coupons', 'token=' . $this->session->data['token'] . '&sort=start_time' . $url, 'SSL');
        $data['sort_over_time'] = $this->url->link('sale/coupons', 'token=' . $this->session->data['token'] . '&sort=over_time' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $coupons_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('sale/coupons', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($coupons_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($coupons_total - $this->config->get('config_limit_admin'))) ? $coupons_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $coupons_total, ceil($coupons_total / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('sale/coupons_list.tpl', $data));
    }

    protected function getForm() {
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_form'] = !isset($this->request->get['coupon_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_percent'] = $this->language->get('text_percent');
        $data['text_amount'] = $this->language->get('text_amount');

        $data['entry_coupons_name'] = $this->language->get('entry_coupons_name');
        $data['entry_coupons_id'] = $this->language->get('entry_coupons_id');
        $data['entry_code'] = $this->language->get('entry_code');
        $data['entry_discount'] = $this->language->get('entry_discount');
        $data['entry_agent_id'] = $this->language->get('entry_agent_id');
        $data['entry_product_category'] = $this->language->get('entry_product_category');
        $data['entry_condition'] = $this->language->get('entry_condition');
        $data['entry_discount'] = $this->language->get('entry_discount');
        $data['entry_agent_percent'] = $this->language->get('entry_agent_percent');
        $data['entry_system_percent'] = $this->language->get('entry_system_percent');
        $data['entry_start_time'] = $this->language->get('entry_start_time');
        $data['entry_over_time'] = $this->language->get('entry_over_time');


        $data['help_code'] = $this->language->get('help_code');
        $data['help_type'] = $this->language->get('help_type');
        $data['help_logged'] = $this->language->get('help_logged');
        $data['help_total'] = $this->language->get('help_total');
        $data['help_category'] = $this->language->get('help_category');
        $data['help_product'] = $this->language->get('help_product');
        $data['help_uses_total'] = $this->language->get('help_uses_total');
        $data['help_uses_customer'] = $this->language->get('help_uses_customer');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['tab_general'] = $this->language->get('tab_general');
        $data['tab_history'] = $this->language->get('tab_history');

        $data['token'] = $this->session->data['token'];

        if (isset($this->request->get['coupons_id'])) {

            $data['coupons_id'] = $this->request->get['coupons_id'];

            $data['coupons_codes'] = $this->model_sale_coupons->getCouponsCodes($data['coupons_id']);

        } else {
            $data['coupons_id'] = 0;

            $data['coupons_codes'] = 0;
        }


        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['coupons_name'])) {
            $data['error_coupons_name'] = $this->error['coupons_name'];
        } else {
            $data['error_coupons_name'] = '';
        }

        if (isset($this->error['agent_id'])) {
            $data['error_agent_id'] = $this->error['agent_id'];
        } else {
            $data['error_agent_id'] = '';
        }

        if (isset($this->error['product_category'])) {
            $data['error_product_category'] = $this->error['product_category'];
        } else {
            $data['error_product_category'] = '';
        }

        if (isset($this->error['code'])) {
            $data['error_code'] = $this->error['code'];
        } else {
            $data['error_code'] = '';
        }

        if (isset($this->error['condition'])) {
            $data['error_condition'] = $this->error['condition'];
        } else {
            $data['error_condition'] = '';
        }

        if (isset($this->error['discount'])) {
            $data['error_discount'] = $this->error['discount'];
        } else {
            $data['error_discount'] = '';
        }

        if (isset($this->error['agent_percent'])) {
            $data['error_agent_percent'] = $this->error['agent_percent'];
        } else {
            $data['error_agent_percent'] = '';
        }

        if (isset($this->error['start_time'])) {
            $data['error_start_time'] = $this->error['start_time'];
        } else {
            $data['error_start_time'] = '';
        }

        if (isset($this->error['system_percent'])) {
            $data['error_system_percent'] = $this->error['system_percent'];
        } else {
            $data['error_system_percent'] = '';
        }

        if (isset($this->error['over_time'])) {
            $data['error_over_time'] = $this->error['over_time'];
        } else {
            $data['error_over_time'] = '';
        }

        $url = '';

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('sale/coupons', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        if (!isset($this->request->get['coupons_id'])) {
            $data['action'] = $this->url->link('sale/coupons/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('sale/coupons/edit', 'token=' . $this->session->data['token'] . '&coupons_id=' . $this->request->get['coupons_id'] . $url, 'SSL');
        }

        $data['cancel'] = $this->url->link('sale/coupons', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['coupons_id']) && (!$this->request->server['REQUEST_METHOD'] != 'POST')) {
            $coupons_info = $this->model_sale_coupons->getCoupons($this->request->get['coupons_id']);
        }

        if (isset($this->request->post['coupons_name'])) {
            $data['coupons_name'] = $this->request->post['coupons_name'];
        } elseif (!empty($coupons_info)) {
            $data['coupons_name'] = $coupons_info['coupons_name'];
        } else {
            $data['coupons_name'] = '';
        }

        if (isset($this->request->post['agent_id'])) {
            $data['agent_id'] = $this->request->post['agent_id'];
        } elseif (!empty($coupons_info)) {
            $data['agent_id'] = $coupons_info['agent_id'];
        } else {
            $data['agent_id'] = '';
        }

        if (isset($this->request->post['discount'])) {
            $data['discount'] = $this->request->post['discount'];
        } elseif (!empty($coupons_info)) {
            $data['discount'] = $coupons_info['discount'];
        } else {
            $data['discount'] = '';
        }

        if (isset($this->request->post['condition'])) {
            $data['condition'] = $this->request->post['condition'];
        } elseif (!empty($coupons_info)) {
            $data['condition'] = $coupons_info['condition'];
        } else {
            $data['condition'] = '';
        }

        // Agent
        $this->load->model('sale/agent');

        $data['agents'] = $this->model_sale_agent->getAgents();

        // Categories
        $this->load->model('catalog/category');

        if (isset($this->request->post['product_category'])) {
            $categories = $this->request->post['product_category'];
        } elseif (isset($this->request->get['coupons_id'])) {
            $categories = $this->model_sale_coupons->getProductCategories($this->request->get['coupons_id']);
        } else {
            $categories = array();
        }

        $data['product_categories'] = array();

        foreach ($categories as $category_id) {
            $category_info = $this->model_catalog_category->getCategory($category_id);

            if ($category_info) {
                $data['product_categories'][] = array(
                    'category_id' => $category_info['category_id'],
                    'name' => ($category_info['path']) ? $category_info['path'] . ' &gt; ' . $category_info['name'] : $category_info['name']
                );
            }
        }



        if (isset($this->request->post['agent_percent'])) {
            $data['agent_percent'] = $this->request->post['agent_percent'];
        } elseif (!empty($coupons_info)) {
            $data['agent_percent'] = $coupons_info['agent_percent'];
        } else {
            $data['agent_percent'] = '';
        }

        if (isset($this->request->post['system_percent'])) {
            $data['system_percent'] = $this->request->post['system_percent'];
        } elseif (!empty($coupons_info)) {
            $data['system_percent'] = $coupons_info['system_percent'];
        } else {
            $data['system_percent'] = '';
        }

        if (isset($this->request->post['start_time'])) {
            $data['start_time'] = $this->request->post['start_time'];
        } elseif (!empty($coupons_info)) {
            $data['start_time'] = ($coupons_info['start_time'] != '0000-00-00' ? $coupons_info['start_time'] : '');
        } else {
            $data['start_time'] = date('Y-m-d', time());
        }

        if (isset($this->request->post['over_time'])) {
            $data['over_time'] = $this->request->post['over_time'];
        } elseif (!empty($coupons_info)) {
            $data['over_time'] = ($coupons_info['over_time'] != '0000-00-00' ? $coupons_info['over_time'] : '');
        } else {
            $data['over_time'] = date('Y-m-d', strtotime('+1 month'));
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('sale/coupons_form.tpl', $data));
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'sale/coupons')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['coupons_name']) < 3) || (utf8_strlen($this->request->post['coupons_name']) > 128)) {
            $this->error['coupons_name'] = $this->language->get('error_coupons_name');
        }



        return !$this->error;
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'marketing/coupon')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function history() {
        $this->load->language('marketing/coupon');

        $this->load->model('marketing/coupon');

        $data['text_no_results'] = $this->language->get('text_no_results');

        $data['column_order_id'] = $this->language->get('column_order_id');
        $data['column_customer'] = $this->language->get('column_customer');
        $data['column_amount'] = $this->language->get('column_amount');
        $data['column_date_added'] = $this->language->get('column_date_added');

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $data['histories'] = array();

        $results = $this->model_marketing_coupon->getCouponHistories($this->request->get['coupon_id'], ($page - 1) * 10, 10);

        foreach ($results as $result) {
            $data['histories'][] = array(
                'order_id'   => $result['order_id'],
                'customer'   => $result['customer'],
                'amount'     => $result['amount'],
                'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
            );
        }

        $history_total = $this->model_marketing_coupon->getTotalCouponHistories($this->request->get['coupon_id']);

        $pagination = new Pagination();
        $pagination->total = $history_total;
        $pagination->page = $page;
        $pagination->limit = 10;
        $pagination->url = $this->url->link('marketing/coupon/history', 'token=' . $this->session->data['token'] . '&coupon_id=' . $this->request->get['coupon_id'] . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($history_total - 10)) ? $history_total : ((($page - 1) * 10) + 10), $history_total, ceil($history_total / 10));

        $this->response->setOutput($this->load->view('marketing/coupon_history.tpl', $data));
    }

    public function createCoupons() {
        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            $coupons_id = $this->request->post['coupons_id'];

            $total = 50;

            $this->load->model('sale/coupons');

            if ($this->model_sale_coupons->createCoupons($coupons_id,$total)) {
                echo 'success';
            }
            else {
                echo 'error';
            }

        }
        else {
            echo 'error';
        }
    }



}
