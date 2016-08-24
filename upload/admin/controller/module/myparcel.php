<?php
class ControllerModuleMyParcel extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('module/myparcel');

        $this->document->setTitle($this->language->get('heading_title'));
        //$this->document->addScript('view/javascript/openbay/faq.js');
        //$this->document->addStyle('view/stylesheet/openbay.css');

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('myparcel', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->cache->delete('myparcel');

            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_add_module'] = $this->language->get('button_add_module');
        $data['button_remove'] = $this->language->get('button_remove');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['image'])) {
            $data['error_image'] = $this->error['image'];
        } else {
            $data['error_image'] = array();
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
            //'separator' => false
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_module'),
            'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            //'separator' => ' :: '
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('module/myparcel', 'token=' . $this->session->data['token'], 'SSL'),
            //'separator' => ' :: '
        );

        $data['action'] = $this->url->link('module/myparcel', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
        $data['token'] = $this->session->data['token'];


        $data['modules'] = array();

        if (isset($this->request->post['myparcel_module'])) {
            $data['modules'] = $this->request->post['myparcel_module'];
        } elseif ($this->config->get('myparcel_module')) {
            $data['modules'] = $this->config->get('myparcel_module');
        }else{
            $data['modules'] = array();
        }
        if (isset($this->request->post['myparcel_module_username'])) {
            $data['myparcel_module_username'] = $this->request->post['myparcel_module_username'];
        } elseif ($this->config->get('myparcel_module_username')) {
            $data['myparcel_module_username'] = $this->config->get('myparcel_module_username');
        }else{
            $data['myparcel_module_username'] = '';
        }
        if (isset($this->request->post['myparcel_module_api_key'])) {
            $data['myparcel_module_api_key'] = $this->request->post['myparcel_module_api_key'];
        } elseif ($this->config->get('myparcel_module_api_key')) {
            $data['myparcel_module_api_key'] = $this->config->get('myparcel_module_api_key');
        }else{
            $data['myparcel_module_api_key'] = '';
        }
        if (isset($this->request->post['myparcel_module_frontend'])) {
            $data['myparcel_module_frontend'] = $this->request->post['myparcel_module_frontend'];
        } elseif ($this->config->get('myparcel_module_frontend')) {
            $data['myparcel_module_frontend'] = $this->config->get('myparcel_module_frontend');
        }else{
            $data['myparcel_module_frontend'] = 0;
        }

        $this->load->model('design/layout');

        $data['layouts'] = $this->model_design_layout->getLayouts();

        /*$this->template = 'module/myparcel.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );*/

        //$this->response->setOutput($this->render());
        
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/myparcel.tpl', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'module/myparcel')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        /*if (!$this->error) {
            return true;
        } else {
            return false;
        }*/
        return !$this->error;
    }
}
?>