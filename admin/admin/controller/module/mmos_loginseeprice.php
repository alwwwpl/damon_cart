<?php
class ControllerModuleMmosloginseeprice extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('module/mmos_loginseeprice');

        $this->document->setTitle($this->language->get('heading_title1'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('mmos_loginseeprice', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');
			
			   if (!isset($this->request->get['stay'])) {
                $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'] , 'SSL'));
            } else {

                $this->response->redirect($this->url->link('module/mmos_loginseeprice', 'token=' . $this->session->data['token'], 'SSL'));
            }
        }

        $this->document->addStyle('./view/javascript/colorpicker/css/colorpicker.css');
        $this->document->addScript('./view/javascript/colorpicker/js/bootstrap-colorpicker.js');

        $data['heading_title'] = $this->language->get('heading_title1');
        //WWw.MMOsolution.com config data -- DO NOT REMOVE--- 
        $data['MMOS_version'] = '4.0';
        $data['MMOS_code_id'] = 'MMOSOC125';
        $data['tab_setting'] = $this->language->get('tab_setting');
        $data['tab_support'] = $this->language->get('tab_support');
		$data['text_edit'] = $this->language->get('text_edit');
        $data['text_mmos_loginseeprice'] = $this->language->get('text_mmos_loginseeprice');
        $data['text_color'] = $this->language->get('text_color');
        $data['text_login2price_status'] = $this->language->get('text_login2price_status');
        $data['text_disable'] = $this->language->get('text_disable');
        $data['text_enable'] = $this->language->get('text_enable');
        $data['text_edit_login2see'] = $this->language->get('text_edit_login2see');
        $data['text_module_setting'] = $this->language->get('text_module_setting');
        $data['text_support'] = $this->language->get('text_support');
        $data['text_language'] = $this->language->get('text_language');
        $data['button_save_stay'] = $this->language->get('button_save_stay');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

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

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title1'),
            'href' => $this->url->link('module/mmos_loginseeprice', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('module/mmos_loginseeprice', 'token=' . $this->session->data['token'], 'SSL');

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        $data['token'] = $this->session->data['token'];

        if ((isset($this->request->post['mmos_loginseeprice_status'])) && !isset($this->error['warning'])) {
            $data['mmos_loginseeprice_status'] = $this->request->post['mmos_loginseeprice_status'];
        } else {
            $data['mmos_loginseeprice_status'] = $this->config->get('mmos_loginseeprice_status');
        }
        
        if ((isset($this->request->post['mmos_loginseeprice_color'])) && !isset($this->error['warning'])) {
            $data['mmos_loginseeprice_color'] = $this->request->post['mmos_loginseeprice_color'];
        } else {
            $data['mmos_loginseeprice_color'] = $this->config->get('mmos_loginseeprice_color');
        }
        
        if (isset($this->request->post['mmos_loginseeprice_language']) && !isset($this->error['warning'])) {
            $data['mmos_loginseeprice_language'] = $this->request->post['mmos_loginseeprice_language'];
        } else {
            $data['mmos_loginseeprice_language'] = $this->config->get('mmos_loginseeprice_language');
        }

        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/mmos_loginseeprice.tpl', $data));
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'module/mmos_loginseeprice')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function uninstall() {
        if ($this->validate()) {
            $this->load->model('setting/setting');
            $this->model_setting_setting->deleteSetting('mmos_loginseeprice');
			$this->vqmod_protect('MMOSolution_ajax_login.xml','MMOSolution_ajax_login.xml_mmosolution');
			$this->vqmod_protect('MMOSolution_mmos_loginseeprice.xml','MMOSolution_mmos_loginseeprice.xml_mmosolution');
           }
    }

    public function install() {
        if ($this->validate()) {
			$this->vqmod_protect('MMOSolution_ajax_login.xml_mmosolution','MMOSolution_ajax_login.xml');
			$this->vqmod_protect('MMOSolution_mmos_loginseeprice.xml_mmosolution','MMOSolution_mmos_loginseeprice.xml');
            $this->response->redirect($this->url->link('module/mmos_loginseeprice', 'token=' . $this->session->data['token'], 'SSL'));
        }
    }
	 protected function vqmod_protect($source_file, $destination_file) {
        if ($this->validate()) {
			$MMOS_ROOT_DIR = substr(DIR_APPLICATION, 0, strrpos(DIR_APPLICATION, '/', -2)) . '/vqmod/xml/'; 
            if (is_file($MMOS_ROOT_DIR . $source_file)) {
                rename($MMOS_ROOT_DIR . $source_file, $MMOS_ROOT_DIR . $destination_file);
            }
        }
    }
	
}

?>