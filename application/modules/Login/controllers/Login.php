<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class Login extends CI_Controller
{
    private $titleName = 'Login';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel');
        $this->load->library('Helper');
    }

    public function index()
    {
        $helper = new Helper();
        $helper->IsLoggedIn('login');
        $content['titleName'] = $this->titleName;
        $this->load->view('LoginView', $content);
    }

    public function Logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('login/user'));
    }

    public function AuthUser()
    {
        try {
            $data = $this->input->post();
            $this->LoginModel->AuthUser($data);
        } catch (\Throwable $th) {
            $helper = new Helper();
            $data = array(
                'log_error_controller' => $this->router->fetch_class(),
                'log_error_method' => $this->router->fetch_method(),
                'log_error_desc' => $th->getMessage()
            );
            $helper->CreateLog($data);
            $this->output->set_output(json_encode(array(
                'status' => FALSE,
                'messages' => ERROR_WHILE_PROCESSING
            )));
        }
    }
}

/* End of file Login.php */
