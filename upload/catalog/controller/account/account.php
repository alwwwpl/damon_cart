<?php
class ControllerAccountAccount extends Controller {

	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->load->language('account/account');

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

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_my_account'] = $this->language->get('text_my_account');
		$data['text_my_orders'] = $this->language->get('text_my_orders');
		$data['text_my_newsletter'] = $this->language->get('text_my_newsletter');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_password'] = $this->language->get('text_password');
		$data['text_address'] = $this->language->get('text_address');
		$data['text_wishlist'] = $this->language->get('text_wishlist');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_reward'] = $this->language->get('text_reward');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_newsletter'] = $this->language->get('text_newsletter');
		$data['text_recurring'] = $this->language->get('text_recurring');

        $data['parent'] = $this->customer->getParentId();

		$data['edit'] = $this->url->link('account/edit', '', 'SSL');
		$data['password'] = $this->url->link('account/password', '', 'SSL');
		$data['address'] = $this->url->link('account/address', '', 'SSL');
		$data['wishlist'] = $this->url->link('account/wishlist');
		$data['order'] = $this->url->link('account/order', '', 'SSL');
		$data['download'] = $this->url->link('account/download', '', 'SSL');
		$data['return'] = $this->url->link('account/return', '', 'SSL');
		$data['transaction'] = $this->url->link('account/transaction', '', 'SSL');
		$data['newsletter'] = $this->url->link('account/newsletter', '', 'SSL');
		$data['recurring'] = $this->url->link('account/recurring', '', 'SSL');

		if ($this->config->get('reward_status')) {
			$data['reward'] = $this->url->link('account/reward', '', 'SSL');
		} else {
			$data['reward'] = '';
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/account.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/account.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/account/account.tpl', $data));
		}
	}

	public function country() {
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}


    public function citys() {

        if (isset($this->request->post['province_id']))
        {
            $json = array();

            $this->load->model('localisation/area');

            $citys_info = $this->model_localisation_area->getCitysByProvince($this->request->post['province_id']);

            if ($citys_info) {
                $json = array(
                    'status' => 'success',
                    'citys'  => $citys_info
                );
            }

            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
        }

    }


    public function activation() {

        if (isset($this->request->get['code']))
        {
            $code = hexdec($this->request->get['code']) - 100000;

            $this->load->model('account/customer');

            $this->model_account_customer->updateApproved($code);

            $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        }

    }



    public function sendMessage()
    {
        if(isset($this->request->post['phone'])){

            $phone = $this->request->post['phone'];
//          $phone = '13916749985';

            $code = rand(1000,9999);

            $datas = array($code,'10');

            $temp = 50271;

            $result = $this->sendTemplateSMS($phone, $datas, $temp);
            if($result == NULL ) {
                echo json_encode(array('status' => 'error'));
            }
            else {
                if ($result->statusCode != 0) {
                    echo json_encode(array('status' => 'error'));
                }
                else {
                    echo json_encode(array('status' => 'success','code' => $code));
                }
            }
            /**
             * 发送模板短信
             * @param to 手机号码集合,用英文逗号分开
             * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
             * @param $tempId 模板Id
             */
        }
    }

    function sendTemplateSMS($to,$datas,$tempId)
    {
        require ('./restsdk/CCPRestSDK.php');

        //主帐号
        $accountSid = 'aaf98f89506fc2f001507e08f7de0ab8';

        //主帐号Token
        $accountToken = '4bf16fef5d80423cbef177c54ce3a37e';

        //应用Id
        $appId = 'aaf98f89510df96101510e03e3fd0027';

        //请求地址，格式如下，不需要写https://
        $serverIP = 'app.cloopen.com';

        //请求端口
        $serverPort='8883';

        //REST版本号
        $softVersion='2013-12-26';

        // 初始化REST SDK

//        global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
        $rest = new REST($serverIP,$serverPort,$softVersion);
        $rest->setAccount($accountSid,$accountToken);
        $rest->setAppId($appId);

        // 发送模板短信
//        echo "Sending TemplateSMS to $to <br/>";
        $result = $rest->sendTemplateSMS($to,$datas,$tempId);

        return $result;
    }
}