<?php
class ControllerAccountRegister extends Controller {
    private $error = array();

    public function index() {
        if ($this->customer->isLogged()) {
            $this->response->redirect($this->url->link('account/account', '', 'SSL'));
        }
        if (isset($this->request->get['code']))
        {

                $code = $this->request->get['code'];
                if(!$code){
                    $this->session->data['error'] = '没有邀请码不能注册';
                    $this->response->redirect($this->url->link('common/home', '', 'SSL'));
                }

                $agent_id = hexdec($code)-100000;
                $this->request->post['agent_id'] = $agent_id;
            
            $this->load->language('account/register');

            $this->document->setTitle($this->language->get('heading_title'));

            $this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
            $this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
            $this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

            $this->load->model('account/customer');

            if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
                $this->model_account_customer->addCustomer($this->request->post);

                // Clear any previous login attempts for unregistered accounts.
                $this->model_account_customer->deleteLoginAttempts($this->request->post['email']);

                $this->customer->login($this->request->post['email'], $this->request->post['password']);

                unset($this->session->data['guest']);

                // Add to activity log
                $this->load->model('account/activity');

                $activity_data = array(
                    'customer_id' => $this->customer->getId(),
                    'name'        => $this->request->post['firstname'] . ' ' . $this->request->post['lastname']
                );

                $this->model_account_activity->addActivity('register', $activity_data);

                $this->response->redirect($this->url->link('account/success'));
            }

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
                'text' => $this->language->get('text_register'),
                'href' => $this->url->link('account/register&code='.$this->request->get['code'], '', 'SSL')
            );

            $data['heading_title'] = $this->language->get('heading_title');

            $data['text_account_already'] = sprintf($this->language->get('text_account_already'), $this->url->link('account/login', '', 'SSL'));
            $data['text_your_details'] = $this->language->get('text_your_details');
            $data['text_your_address'] = $this->language->get('text_your_address');
            $data['text_your_password'] = $this->language->get('text_your_password');
            $data['text_newsletter'] = $this->language->get('text_newsletter');
            $data['text_yes'] = $this->language->get('text_yes');
            $data['text_no'] = $this->language->get('text_no');
            $data['text_select'] = $this->language->get('text_select');
            $data['text_none'] = $this->language->get('text_none');
            $data['text_loading'] = $this->language->get('text_loading');

            $data['entry_customer_group'] = $this->language->get('entry_customer_group');
            $data['entry_firstname'] = $this->language->get('entry_firstname');
            $data['entry_lastname'] = $this->language->get('entry_lastname');
            $data['entry_email'] = $this->language->get('entry_email');
            $data['entry_telephone'] = $this->language->get('entry_telephone');
            $data['entry_fax'] = $this->language->get('entry_fax');
            $data['entry_company'] = $this->language->get('entry_company');
            $data['entry_address_1'] = $this->language->get('entry_address_1');
            $data['entry_address_2'] = $this->language->get('entry_address_2');
            $data['entry_postcode'] = $this->language->get('entry_postcode');
            $data['entry_city'] = $this->language->get('entry_city');
            $data['entry_country'] = $this->language->get('entry_country');
            $data['entry_zone'] = $this->language->get('entry_zone');
            $data['entry_newsletter'] = $this->language->get('entry_newsletter');
            $data['entry_password'] = $this->language->get('entry_password');
            $data['entry_confirm'] = $this->language->get('entry_confirm');

            $data['button_continue'] = $this->language->get('button_continue');
            $data['button_upload'] = $this->language->get('button_upload');

            if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
            } else {
                $data['error_warning'] = '';
            }

            if (isset($this->error['firstname'])) {
                $data['error_firstname'] = $this->error['firstname'];
            } else {
                $data['error_firstname'] = '';
            }

            if (isset($this->error['lastname'])) {
                $data['error_lastname'] = $this->error['lastname'];
            } else {
                $data['error_lastname'] = '';
            }

            if (isset($this->error['email'])) {
                $data['error_email'] = $this->error['email'];
            } else {
                $data['error_email'] = '';
            }

            if (isset($this->error['telephone'])) {
                $data['error_telephone'] = $this->error['telephone'];
            } else {
                $data['error_telephone'] = '';
            }

            if (isset($this->error['address_1'])) {
                $data['error_address_1'] = $this->error['address_1'];
            } else {
                $data['error_address_1'] = '';
            }

            if (isset($this->error['city'])) {
                $data['error_city'] = $this->error['city'];
            } else {
                $data['error_city'] = '';
            }

            if (isset($this->error['postcode'])) {
                $data['error_postcode'] = $this->error['postcode'];
            } else {
                $data['error_postcode'] = '';
            }

            if (isset($this->error['country'])) {
                $data['error_country'] = $this->error['country'];
            } else {
                $data['error_country'] = '';
            }

            if (isset($this->error['zone'])) {
                $data['error_zone'] = $this->error['zone'];
            } else {
                $data['error_zone'] = '';
            }

            if (isset($this->error['custom_field'])) {
                $data['error_custom_field'] = $this->error['custom_field'];
            } else {
                $data['error_custom_field'] = array();
            }

            if (isset($this->error['password'])) {
                $data['error_password'] = $this->error['password'];
            } else {
                $data['error_password'] = '';
            }

            if (isset($this->error['confirm'])) {
                $data['error_confirm'] = $this->error['confirm'];
            } else {
                $data['error_confirm'] = '';
            }


            $agent = '';
            $extensioner_id = '';
            if (isset($this->request->get['agent_id'])){
                $agent = "&agent_id=".$this->request->get['agent_id'];

                $this->load->model('account/agent');

                if (is_numeric(base64_decode($this->request->get['code'])) && base64_decode($this->request->get['code']) - 888888 > 0)
                {
                    $extensioner_id = base64_decode($this->request->get['code']) - 888888;

                    $data['agent_city'] = $this->model_account_agent->getExtensionerCity($extensioner_id);

                    $data['agent_provice'] = $this->model_account_agent->getExtensionerProvince($extensioner_id);
                }
                else
                {
                    $data['agent_city'] = $this->model_account_agent->getAgentCity($this->request->get['agent_id']);

                    $data['agent_provice'] = $this->model_account_agent->getAgentProvince($this->request->get['agent_id']);
                }
            }

            $data['action'] = $this->url->link('account/register'.$agent.'&code='.$this->request->get['code'], '', 'SSL');

            $data['customer_groups'] = array();

//		if (is_array($this->config->get('config_customer_group_display'))) {
            $this->load->model('account/customer_group');

            $customer_groups = $this->model_account_customer_group->getCustomerGroups();

            foreach ($customer_groups as $customer_group) {
//				if (in_array($customer_group['customer_group_id'], $this->config->get('config_customer_group_display'))) {
                $data['customer_groups'][] = $customer_group;
            }
//		}


            if (isset($this->request->post['customer_group_id'])) {
                $data['customer_group_id'] = $this->request->post['customer_group_id'];
            } elseif (isset($this->request->get['agent_id'])) {
                $data['customer_group_id'] = '2';
            } else {
//			$data['customer_group_id'] = $this->config->get('config_customer_group_id');
                $data['customer_group_id'] = '5';
            }

            if (isset($this->request->get['agent_id'])) {
                $data['agent_id'] = $this->request->get['agent_id'];
            } else {
                $data['agent_id'] = '';
            }

            if (isset($this->request->post['firstname'])) {
                $data['firstname'] = $this->request->post['firstname'];
            } else {
                $data['firstname'] = '';
            }

            if ($extensioner_id) {
                $data['extensioner_id'] = $extensioner_id;
            }else {
                $data['extensioner_id'] = '';
            }

            if (isset($this->request->post['parent'])) {
                $data['parent'] = $this->request->post['parent'];
            } else {
                $data['parent'] = '0';
            }

            if (isset($this->request->post['lastname'])) {
                $data['lastname'] = $this->request->post['lastname'];
            } else {
                $data['lastname'] = '';
            }

            if (isset($this->request->post['email'])) {
                $data['email'] = $this->request->post['email'];
            } else {
                $data['email'] = '';
            }

            if (isset($this->request->post['telephone'])) {
                $data['telephone'] = $this->request->post['telephone'];
            } else {
                $data['telephone'] = '';
            }

            if (isset($this->request->post['fax'])) {
                $data['fax'] = $this->request->post['fax'];
            } else {
                $data['fax'] = '';
            }

            if (isset($this->request->post['company'])) {
                $data['company'] = $this->request->post['company'];
            } else {
                $data['company'] = '';
            }

            if (isset($this->request->post['address_1'])) {
                $data['address_1'] = $this->request->post['address_1'];
            } else {
                $data['address_1'] = '';
            }

            if (isset($this->request->post['address_2'])) {
                $data['address_2'] = $this->request->post['address_2'];
            } else {
                $data['address_2'] = '';
            }

            if (isset($this->request->post['id_number'])) {
                $data['id_number'] = $this->request->post['id_number'];
            } else {
                $data['id_number'] = '';
            }

            if (isset($this->request->post['company_name'])) {
                $data['company_name'] = $this->request->post['company_name'];
            } else {
                $data['company_name'] = '';
            }

            if (isset($this->request->post['company_short'])) {
                $data['company_short'] = $this->request->post['company_short'];
            } else {
                $data['company_short'] = '';
            }

            if (isset($this->request->post['company_number'])) {
                $data['company_number'] = $this->request->post['company_number'];
            } else {
                $data['company_number'] = '';
            }

            if (isset($this->request->post['id_files'])) {
                $data['id_files'] = $this->request->post['id_files'];
            } else {
                $data['id_files'] = '';
            }

            if (isset($this->request->post['company_files'])) {
                $data['company_files'] = $this->request->post['company_files'];
            } else {
                $data['company_files'] = '';
            }

            if (isset($this->request->post['postcode'])) {
                $data['postcode'] = $this->request->post['postcode'];
            } elseif (isset($this->session->data['shipping_address']['postcode'])) {
                $data['postcode'] = $this->session->data['shipping_address']['postcode'];
            } else {
                $data['postcode'] = '';
            }

            if (isset($this->request->post['city'])) {
                $data['city'] = $this->request->post['city'];
            } else {
                $data['city'] = '';
            }

            if (isset($this->request->post['country_id'])) {
                $data['country_id'] = $this->request->post['country_id'];
            } elseif (isset($this->session->data['shipping_address']['country_id'])) {
                $data['country_id'] = $this->session->data['shipping_address']['country_id'];
            } else {
                $data['country_id'] = $this->config->get('config_country_id');
            }

            if (isset($this->request->post['zone_id'])) {
                $data['zone_id'] = $this->request->post['zone_id'];
            } elseif (isset($this->session->data['shipping_address']['zone_id'])) {
                $data['zone_id'] = $this->session->data['shipping_address']['zone_id'];
            } else {
                $data['zone_id'] = '';
            }

            $this->load->model('localisation/country');

            $data['countries'] = $this->model_localisation_country->getCountries();

            $this->load->model('localisation/area');

            $data['provinces'] = $this->model_localisation_area->getProvinces();

            // Custom Fields
            $this->load->model('account/custom_field');

            $data['custom_fields'] = $this->model_account_custom_field->getCustomFields();

            if (isset($this->request->post['custom_field'])) {
                if (isset($this->request->post['custom_field']['account'])) {
                    $account_custom_field = $this->request->post['custom_field']['account'];
                } else {
                    $account_custom_field = array();
                }

                if (isset($this->request->post['custom_field']['address'])) {
                    $address_custom_field = $this->request->post['custom_field']['address'];
                } else {
                    $address_custom_field = array();
                }

                $data['register_custom_field'] = $account_custom_field + $address_custom_field;
            } else {
                $data['register_custom_field'] = array();
            }

            if (isset($this->request->post['password'])) {
                $data['password'] = $this->request->post['password'];
            } else {
                $data['password'] = '';
            }

            if (isset($this->request->post['confirm'])) {
                $data['confirm'] = $this->request->post['confirm'];
            } else {
                $data['confirm'] = '';
            }

            if (isset($this->request->post['newsletter'])) {
                $data['newsletter'] = $this->request->post['newsletter'];
            } else {
                $data['newsletter'] = '';
            }

            if ($this->config->get('config_account_id')) {
                $this->load->model('catalog/information');

                $information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

                if ($information_info) {
                    $data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information/agree', 'information_id=' . $this->config->get('config_account_id'), 'SSL'), $information_info['title'], $information_info['title']);
                } else {
                    $data['text_agree'] = '';
                }
            } else {
                $data['text_agree'] = '';
            }

            if (isset($this->request->post['agree'])) {
                $data['agree'] = $this->request->post['agree'];
            } else {
                $data['agree'] = false;
            }

            $data['column_left'] = $this->load->controller('common/column_left');
            $data['column_right'] = $this->load->controller('common/column_right');
            $data['content_top'] = $this->load->controller('common/content_top');
            $data['content_bottom'] = $this->load->controller('common/content_bottom');
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');

            if (isset($this->request->get['agent_id'])) {
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/register_c.tpl')) {
                    $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/register_c.tpl', $data));
                } else {
                    $this->response->setOutput($this->load->view('default/template/account/register_c.tpl', $data));
                }
            }
            else {
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/register.tpl')) {
                    $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/register.tpl', $data));
                } else {
                    $this->response->setOutput($this->load->view('default/template/account/register.tpl', $data));
                }
            }
        }
        else
        {
            $this->document->setTitle('用户注册');

            $data['heading_title'] = '用户注册';

            $data['text_error'] = '非法注册链接';

            $data['button_continue'] = $this->language->get('button_continue');

            $data['breadcrumbs'] = array();

            $data['continue'] = $this->url->link('common/home', '', 'SSL');

            $data['column_left'] = $this->load->controller('common/column_left');
            $data['column_right'] = $this->load->controller('common/column_right');
            $data['content_top'] = $this->load->controller('common/content_top');
            $data['content_bottom'] = $this->load->controller('common/content_bottom');
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
            }
        }

    }

    public function protocol() {
        $data['text'] = '<p><style>@font-face {  font-family: "微软雅黑";}@font-face {  font-family: "微软雅黑";}@font-face {  font-family: "@微软雅黑";}@font-face {  font-family: "Calibri";}@font-face {  font-family: "微软雅黑";}@font-face {  font-family: "@微软雅黑";}p.MsoNormal, li.MsoNormal, div.MsoNormal { margin: 0cm 0cm 0.0001pt; text-align: justify; font-size: 10.5pt; font-family: Calibri; }.MsoChpDefault { font-size: 10.5pt; font-family: Calibri; }div.WordSection1 { page: WordSection1; }</style></p>
<p class="MsoNormal" style="text-align:center" align="center">网站会员注册协议</p>
<p class="MsoNormal" style="text-indent:28.0pt;mso-char-indent-count:2.0">在您注册成为本网站的会员之前，请您认真阅读本会员注册协议。您必须完全同意以下所有条款，方能成为本网站的会员。&nbsp; </p>
<p class="MsoNormal" style="text-indent:30.3pt;mso-char-indent-count:2.0">第一条 会员服务条款的确认和接纳</p>
<p class="MsoNormal" style="text-indent:21.0pt">&nbsp; “本网站”在线服务涉及的本网站在线产品的所有权以及相关软件的知识产权归本网站所有。本服务条款的效力范围及于本网站的一切产品和服务，用户在享受本网站任何单项服务时，应当受本服务条款的约束。用户通过进入注册程序并点击“我接受”按钮，即表示用户与本网站已达成协议，自愿接受本服务条款的所有内容。&nbsp; </p>
<p class="MsoNormal" style="text-indent:21.0pt">当用户使用本网站各单项服务时，用户的使用行为视为其对该单项服务的服务条款以及本网站在该单项服务中发出的各类公告表示同意。&nbsp; </p>
<p class="MsoNormal" style="text-indent:30.15pt;mso-char-indent-count:1.99">第二条 网站服务简介&nbsp; </p>
<p class="MsoNormal" style="text-indent:28.0pt;mso-char-indent-count:2.0">本网站运用自己的操作系统通过国际互联网为用户提供各项服务。用户必须： </p>
<p class="MsoNormal" style="text-indent:21.0pt">（1）提供设备，包括个人计算机、调制解调器等上网装置。 </p>
<p class="MsoNormal" style="text-indent:21.0pt">（2）个人承担个人上网而产生的通讯费用。 </p>
<p class="MsoNormal" style="text-indent:21.0pt">考虑到本网站产品服务的重要性，用户同意： </p>
<p class="MsoNormal" style="text-indent:21.0pt">（1）提供及时、详尽及准确的个人资料。&nbsp; </p>
<p class="MsoNormal" style="text-indent:21.0pt">（2）不断更新注册资料，符合及时、详尽准确的要求。所有原始键入的资料将引用为注册资料。&nbsp; </p>
<p class="MsoNormal" style="text-indent:28.0pt;mso-char-indent-count:2.0">另外，本网站不能擅自公开用户的姓名、住址、出件地址、电子邮箱、账号。除非： </p>
<p class="MsoNormal" style="text-indent:21.0pt">（1）用户要求本网站或授权某人通过电子邮件服务透露这些信息。 </p>
<p class="MsoNormal" style="text-indent:21.0pt">（2）用户个人在本网站论坛或者其他公共媒体自主发布或者透露这些信息。 </p>
<p class="MsoNormal" style="text-indent:21.0pt;mso-char-indent-count:1.5">（3）相应的法律、法规要求及程序服务需要本网站提供用户的个人资料。</p>
<p class="MsoNormal" style="text-indent:28.0pt;mso-char-indent-count:2.0">&nbsp; 如果用户提供的资料不准确、不真实、不合法有效，本网站保留结束用户使用本网站各项服务的权利。&nbsp; 用户在享用本网站各项服务的同时，同意接受本网站提供的各类信息服务。</p>
<p class="MsoNormal" style="text-indent:28.0pt;mso-char-indent-count:2.0">&nbsp;第三条 会员条款的修改&nbsp; </p>
<p class="MsoNormal" style="text-indent:35.0pt;mso-char-indent-count:2.5">本网站有权在必要时修改本会员条款以及各单项服务的相关条款。用户在享受单项服务时，应当及时查阅了解修改的内容，并自觉遵守本服务条款以及该单项服务的相关条款。</p>
<p class="MsoNormal" style="text-indent:30.3pt;mso-char-indent-count:2.0">第四条 服务修订&nbsp; </p>
<p class="MsoNormal" style="text-indent:28.0pt;mso-char-indent-count:2.0">本网站保留随时修改或中断服务而不需通知用户的权利。用户接受本网站行使修改或中断服务的权利，本网站不需对用户或第三方负责。&nbsp; </p>
<p class="MsoNormal" style="text-indent:30.3pt;mso-char-indent-count:2.0">第五条 用户隐私制度&nbsp; </p>
<p class="MsoNormal" style="text-indent:28.0pt;mso-char-indent-count:2.0">我们承诺：对您的个人信息的隐私和安全将给予特别保护。访问这些个人信息的权限仅限于需要进行此类访问以完成其工作的人员。&nbsp; 在未经访问者授权同意的情况下，本网站不会将访问者的个人资料泄露给第三方。但以下情况除外，且本网站不承担任何法律责任：&nbsp; </p>
<p class="MsoNormal" style="text-indent:28.0pt;mso-char-indent-count:2.0">（1）根据执法单位之要求或为公共之目的向相关单位提供个人资料。&nbsp; </p>
<p class="MsoNormal" style="text-indent:28.0pt;mso-char-indent-count:2.0">（2）由于您将用户密码告知他人或与他人共享注册账户，由此导致的任何个人资料泄露。&nbsp; </p>
<p class="MsoNormal" style="text-indent:28.0pt;mso-char-indent-count:2.0">（3）由于计算机2000年问题、黑客攻击、计算机病毒侵入或发作、因政府管制而造成的暂时性关闭等影响网络正常经营之不可抗力而造成的个人资料泄露、丢失、被盗用或被篡改等。&nbsp; </p>
<p class="MsoNormal" style="text-indent:28.0pt;mso-char-indent-count:2.0">（4）由于与本网站链接的其他网站造成之个人资料泄露及由此而导致的任何法律争议</p>
<p class="MsoNormal">和后果。&nbsp; </p>
<p class="MsoNormal" style="text-indent:28.0pt;mso-char-indent-count:2.0">（5）为免除访问者在生命、身体或财产方面之急迫危险。&nbsp; </p>
<p class="MsoNormal" style="text-indent:28.0pt;mso-char-indent-count:2.0">（6）本网站会与其他网站链接，但不对其他网站的隐私政策及内容负责。&nbsp; </p>
<p class="MsoNormal">此外，用户同意若发现任何非法使用用户账号或安全漏洞的情况，立即通告本网站。</p>
<p class="MsoNormal" style="text-indent:30.3pt;mso-char-indent-count:2.0">&nbsp;第六条 拒绝提供担保和免责声明</p>
<p class="MsoNormal" style="text-indent:35.0pt;mso-char-indent-count:2.5">用户明确同意使用本网站服务的风险由用户个人承担。本网站明确表示不提供任何类型的担保，不论是明确的或隐含的，但是对商业性的隐含担保，特定目的和不违反规定的适当担保除外。本网站不担保服务一定能满足用户的要求，也不担保服务不会中断，对服务的及时性、安全性、真实性、出错发生都不做担保。本网站拒绝提供任何担保，包括信息能否准确、及时、顺利地传送。用户理解并接受下载或通过本网站产品服务取得的任何信息资料取决于用户自己，并由其承担系统受损、资料丢失以及其他任何风险。&nbsp; </p>
<p class="MsoNormal" style="text-indent:30.3pt;mso-char-indent-count:2.0">第七条 有限责任&nbsp; </p>
<p class="MsoNormal" style="text-indent:28.0pt;mso-char-indent-count:2.0">本网站对直接、间接、偶然、特殊及继起的损害不负责任，这些损害来自：不正当使用产品服务，在网上购买商品或类似服务，在网上进行交易，非法使用服务或用户传送的信息有所变动。这些损害会导致本网站形象受损，所以本网站早已提出这种损害的可能性。&nbsp; </p>
<p class="MsoNormal" style="text-indent:30.3pt;mso-char-indent-count:2.0">第八条 本网站论坛信息的储存及限制&nbsp; </p>
<p class="MsoNormal" style="text-indent:28.0pt;mso-char-indent-count:2.0">本网站不对用户所发布信息的删除或储存失败负责。本网站保留判定用户的行为是否符合本网站服务条款的要求和精神的权利，如果用户违背了服务条款的规定，则本网站可以中断服务账号。在本网站论坛内，无论是用户原创或是用户得到著作权人授权转载的作品，用户上载的行为即意味着用户或用户代理的著作权人授权本网站对上载作品享有不可撤销的永久的使用权和收益权，同时本网站对用户上传的资料的知识产权问题引发的任何不良后果不承担责任，由用户个人负责。</p>
<p class="MsoNormal" style="text-indent: 28pt; text-align: left;">&nbsp;</p>
<p class="MsoNormal" style="text-indent: 28pt; text-align: right;"> 安徽达蒙狗科技有限公司</p>
<p class="MsoNormal" style="text-indent: 28pt; text-align: right;">2015-10-10</p>';
        $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/protocol.tpl', $data));
    }

    public function validate() {
        if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
            $this->error['firstname'] = $this->language->get('error_firstname');
        }

        if ((utf8_strlen(trim($this->request->post['lastname'])) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {
            $this->error['lastname'] = $this->language->get('error_lastname');
        }

        if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email']) || (utf8_strlen($this->request->post['email']) < 6)) {
            $this->error['email'] = $this->language->get('error_email');
        }

        $this->load->model('account/customer');
        if ($this->model_account_customer->getCustomerByEmail($this->request->post['email'])){
            $this->error['email'] = $this->language->get('此邮箱已被注册！');
        }

        if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
            $this->error['warning'] = $this->language->get('error_exists');
        }

        if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
            $this->error['telephone'] = $this->language->get('error_telephone');
        }

        if ($this->model_account_customer->getCustomerByPhone($this->request->post['telephone'])){
            $this->error['telephone'] = $this->language->get('此联系电话已被注册！');
        }

        if ((utf8_strlen(trim($this->request->post['address_1'])) < 3) || (utf8_strlen(trim($this->request->post['address_1'])) > 128)) {
            $this->error['address_1'] = $this->language->get('error_address_1');
        }

        if ((utf8_strlen(trim($this->request->post['city'])) < 2) || (utf8_strlen(trim($this->request->post['city'])) > 128)) {
            $this->error['city'] = $this->language->get('error_city');
        }

        $this->load->model('localisation/country');

        $country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

        if ($country_info && $country_info['postcode_required'] && (utf8_strlen(trim($this->request->post['postcode'])) < 2 || utf8_strlen(trim($this->request->post['postcode'])) > 10)) {
            $this->error['postcode'] = $this->language->get('error_postcode');
        }

        if ($this->request->post['country_id'] == '') {
            $this->error['country'] = $this->language->get('error_country');
        }

        if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '') {
            $this->error['zone'] = $this->language->get('error_zone');
        }

        // Customer Group
        if (isset($this->request->post['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->post['customer_group_id'], $this->config->get('config_customer_group_display'))) {
            $customer_group_id = $this->request->post['customer_group_id'];
        } else {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }

        // Custom field validation
        $this->load->model('account/custom_field');

        $custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

        foreach ($custom_fields as $custom_field) {
            if ($custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']])) {
                $this->error['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
            }
        }

        if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
            $this->error['password'] = $this->language->get('error_password');
        }

        if ($this->request->post['confirm'] != $this->request->post['password']) {
            $this->error['confirm'] = $this->language->get('error_confirm');
        }

        // Agree to terms
        if ($this->config->get('config_account_id')) {
            $this->load->model('catalog/information');

            $information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

            if ($information_info && !isset($this->request->post['agree'])) {
                $this->error['warning'] = sprintf($this->language->get('error_agree'), $information_info['title']);
            }
        }

        return !$this->error;
    }

    public function customfield() {
        $json = array();

        $this->load->model('account/custom_field');

        // Customer Group
        if (isset($this->request->get['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->get['customer_group_id'], $this->config->get('config_customer_group_display'))) {
            $customer_group_id = $this->request->get['customer_group_id'];
        } else {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }

        $custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

        foreach ($custom_fields as $custom_field) {
            $json[] = array(
                'custom_field_id' => $custom_field['custom_field_id'],
                'required'        => $custom_field['required']
            );
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}