<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class Users extends CI_Controller
{
    private $titleName = 'Master Users';
    private $tableName = 'm_user';
    private $viewName = 'v_users';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UsersModel');
    }

    public function index()
    {
        $helper = new Helper();
        $helper->IsLoggedIn();
        $content['titleName'] = $this->titleName;
        $content['js'] = 'js/UsersJs';

        $this->load->view('Layout/HeaderView', $content);
        $this->load->view('UsersView', $content);
        $this->load->view('Layout/FooterView', $content);
    }

    public function Datatable()
    {
        $helper = new Helper();
        $table = $this->viewName;
        $column_order = array('user_name', 'user_email', 'user_fullname', 'role_name', 'user_status');
        $column_search = array('user_name', 'user_email', 'user_fullname', 'role_name', 'user_status');
        $orderby = array('user_name' => 'asc');
        $where = array();
        $list = $helper->get_datatables($table, $column_order, $column_search, $orderby, $where);
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $key) {
            $row = array();
            $row[] = ++$no;

            $row[] = $key->user_name;
            $row[] = $key->user_email;
            $row[] = $key->user_fullname;

            if ($key->role_id == 1)
                $row[] = '<span class="shadow-none badge badge-success badge-style-bordered">' . $key->role_name . '</span>';
            else
                $row[] = '<span class="shadow-none badge badge-warning badge-style-bordered">' . $key->role_name . '</span>';


            if ($key->user_status == 1)
                $row[] = '<span class="shadow-none badge badge-success">Active</span>';
            else
                $row[] = '<span class="shadow-none badge badge-warning">Inactive</span>';

            $row[] = '
                <div class="text-center">
                    <button type="button" title="View Detail" class="btn btn-primary btn-icon btn-sm " onclick="btnView(\'' . $key->user_id . '\')"><i class="fa-solid fa-eye"></i></button>
                    <button type="button" title="Edit" class="btn btn-warning btn-icon btn-sm " onclick="btnEdit(\'' . $key->user_id . '\')"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button type="button" title="Delete" class="btn btn-danger btn-icon btn-sm " onclick="btnDelete(\'' . $key->user_id . '\')"><i class="fa-solid fa-trash-can"></i></button>
                </div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $helper->count_all($table),
            "recordsFiltered" => $helper->count_filtered($table, $column_order, $column_search, $orderby, $where),
            "data" => $data,
        );
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($output, JSON_PRETTY_PRINT);
    }

    public function GetAll()
    {
        try {
            $data = $this->UsersModel->GetAll();
            echo json_encode(['status' => true, 'message' => 'Success', 'data' => $data]);
        } catch (\Throwable $th) {
            $helper = new Helper();
            $data = array(
                'log_error_controller' => $this->router->fetch_class(),
                'log_error_method' => $this->router->fetch_method(),
                'log_error_desc' => $th->getMessage()
            );
            $helper->CreateLog($data);
            echo json_encode(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function Get($id)
    {
        try {
            $data = $this->UsersModel->Get($id);
            echo json_encode(['status' => true, 'message' => 'Success', 'data' => $data]);
        } catch (\Throwable $th) {
            $helper = new Helper();
            $data = array(
                'log_error_controller' => $this->router->fetch_class(),
                'log_error_method' => $this->router->fetch_method(),
                'log_error_desc' => $th->getMessage()
            );
            $helper->CreateLog($data);
            echo json_encode(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function Insert()
    {
        try {
            $data = $this->input->post();
            $this->UsersModel->Insert($data);
            echo json_encode(['status' => true, 'message' => 'Success']);
        } catch (\Throwable $th) {
            $helper = new Helper();
            $data = array(
                'log_error_controller' => $this->router->fetch_class(),
                'log_error_method' => $this->router->fetch_method(),
                'log_error_desc' => $th->getMessage()
            );
            $helper->CreateLog($data);
            echo json_encode(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function Update()
    {
        try {
            $data = $this->input->post();
            $this->UsersModel->Update($data);
            echo json_encode(['status' => true, 'message' => 'Success']);
        } catch (\Throwable $th) {
            $helper = new Helper();
            $data = array(
                'log_error_controller' => $this->router->fetch_class(),
                'log_error_method' => $this->router->fetch_method(),
                'log_error_desc' => $th->getMessage()
            );
            $helper->CreateLog($data);
            echo json_encode(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function Delete($id)
    {
        try {
            $this->UsersModel->Delete($id);
            echo json_encode(['status' => true, 'message' => 'Success']);
        } catch (\Throwable $th) {
            $helper = new Helper();
            $data = array(
                'log_error_controller' => $this->router->fetch_class(),
                'log_error_method' => $this->router->fetch_method(),
                'log_error_desc' => $th->getMessage()
            );
            $helper->CreateLog($data);
            echo json_encode(['status' => false, 'message' => $th->getMessage()]);
        }
    }
}

/* End of file filename.php */
