<?php
class ControllerAccountTransaction extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/transaction', '', 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->load->language('account/transaction');

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
			'text' => $this->language->get('text_transaction'),
			'href' => $this->url->link('account/transaction', '', 'SSL')
		);

		$this->load->model('account/transaction');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_description'] = $this->language->get('column_description');
		$data['column_amount'] = sprintf($this->language->get('column_amount'), $this->config->get('config_currency'));

		$data['text_total'] = $this->language->get('text_total');
		$data['text_empty'] = $this->language->get('text_empty');

		$data['button_continue'] = $this->language->get('button_continue');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['transactions'] = array();

		$filter_data = array(
			'sort'  => 'date_added',
			'order' => 'DESC',
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$transaction_total = $this->model_account_transaction->getTotalTransactions();

		$results = $this->model_account_transaction->getTransactions($filter_data);

		foreach ($results as $result) {
			$data['transactions'][] = array(
				'amount'      => $this->currency->format($result['amount'], $this->config->get('config_currency')),
				'description' => $result['description'],
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

        $data['cards'] = array();

        $this->load->model('account/bankcard');

        $cardsData = $this->model_account_bankcard->getBankcards();

        foreach ($cardsData as $card)
        {
            $data['cards'][] = array(
                'username' => $card['username'],
                'bank_card_id' => $card['bank_card_id'],
                'card_number' => $card['card_number'],
                'bank' => $card['bank'],
            );
        }

        $data['withdraw'] = $this->customer->getPaymentPassword();

		$pagination = new Pagination();
		$pagination->total = $transaction_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('account/transaction', 'page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($transaction_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($transaction_total - 10)) ? $transaction_total : ((($page - 1) * 10) + 10), $transaction_total, ceil($transaction_total / 10));

		$data['total'] = $this->currency->format($this->customer->getBalance());
		$data['cash'] = $this->currency->format($this->model_account_transaction->getTotalCash());

		$data['continue'] = $this->url->link('account/account', '', 'SSL');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/transaction.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/transaction.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/account/transaction.tpl', $data));
		}
	}


    public function addcashrecord() {
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->load->model('account/bankcard');

            $cashrecord_id = $this->model_account_bankcard->addCashRecord($this->request->post);

            if ($cashrecord_id)
            {
                $this->session->data['success'] = '提现成功，等待管理员审核';

                echo json_encode(array('status' => 'success'));
            }
            else
            {
                echo json_encode(array('status' => 'payment_password'));
            }
        }
        else
        {
            echo json_encode(array('status' => 'error'));
        }
    }


    protected function validateForm() {
        if ((utf8_strlen(trim($this->request->post['bank_card'])) < 1) || (utf8_strlen(trim($this->request->post['bank_card'])) > 15)) {
            $this->error['bank_card'] = '请选择正确的发卡银行';
        }

        if ((utf8_strlen(trim($this->request->post['amount'])) < 1) || (utf8_strlen(trim($this->request->post['amount'])) > 100)) {
            $this->error['amount'] = '银行卡号输入不正确';
        }

        if ((utf8_strlen(trim($this->request->post['payment_password'])) < 1) || (utf8_strlen(trim($this->request->post['payment_password'])) > 100)) {
            $this->error['payment_password'] = '提现密码不正确';
        }

        return !$this->error;
    }

    public function iswithdraw()
    {
        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

            if (!$this->customer->getPaymentPassword())
            {
                $this->session->data['error_warning'] = '请先设置提现密码!';

                echo json_encode(array('status' => 'error'));
            }
            else
            {
                echo json_encode(array('status' => 'success'));
            }
        }
        else
        {
            echo json_encode(array('status' => 'success'));
        }
    }



}