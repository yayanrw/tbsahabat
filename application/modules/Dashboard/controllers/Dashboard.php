<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';
class Dashboard extends CI_Controller
{
    private $titleName = 'Welcome to ' . APPS_NAME;

    public function index()
    {
        $helper = Helper::getInstance();
        $helper->IsLoggedIn();
        $content['titleName'] = $this->titleName;

        $this->load->view('Layout/HeaderView', $content);
        $this->load->view('DashboardView', $content);
        $this->load->view('Layout/FooterView');
    }
}
