<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class Roles extends CI_Controller
{
    private $titleName = 'Master Roles';
    private $tableName = 'm_role';
    private $viewName = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('RolesModel');
    }

    public function index()
    {
        $helper = new Helper();
        $helper->IsLoggedIn();
        $content['titleName'] = $this->titleName;
        $content['js'] = 'js/RolesJs';

        $this->load->view('Layout/HeaderView', $content);
        $this->load->view('RolesView', $content);
        $this->load->view('Layout/FooterView', $content);
    }

    public function Datatable()
    {
        $helper = new Helper();
        $table = $this->tableName;
        $column_order = array('role_name', 'redirect_to', 'role_status');
        $column_search = array('role_name', 'redirect_to', 'role_status');
        $orderby = array('role_name' => 'asc');
        $where = null;
        $list = $helper->get_datatables($table, $column_order, $column_search, $orderby, $where);
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $key) {
            $row = array();
            $row[] = ++$no;

            $row[] = $key->role_name;
            $row[] = $key->redirect_to;

            if ($key->role_status == '1') {
                $row[] = '<span class="badge badge-success">Active</span>';
            } else {
                $row[] = '<span class="badge badge-danger">Inactive</span>';
            }

            $row[] = '
            <div class="text-center">
                <button type="button" title="View Detail" class="btn btn-primary btn-icon btn-sm " onclick="btnView(\'' . $key->role_id . '\')"><i class="fa-solid fa-eye"></i></button>
                <button type="button" title="Edit" class="btn btn-warning btn-icon btn-sm " onclick="btnEdit(\'' . $key->role_id . '\')"><i class="fa-solid fa-pen-to-square"></i></button>
                <button type="button" title="Delete" class="btn btn-danger btn-icon btn-sm " onclick="btnDelete(\'' . $key->role_id . '\')"><i class="fa-solid fa-trash-can"></i></button>
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
            $data = $this->RolesModel->GetAll();
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
            $data = $this->RolesModel->Get($id);
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
            $this->RolesModel->Insert($data);
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
            $this->RolesModel->Update($data);
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
            $this->RolesModel->Delete($id);
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
