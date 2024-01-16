<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class Product extends CI_Controller
{
	private $titleName = 'Product';
	private $tableName = 'm_product';
	private $viewName = 'v_product';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ProductModel');
	}

	public function index()
	{
		$helper = Helper::getInstance();
		$helper->IsLoggedIn();
		$content['titleName'] = $this->titleName;
		$content['js'] = 'js/ProductJs';

		$this->load->view('Layout/HeaderView', $content);
		$this->load->view('ProductView', $content);
		$this->load->view('Layout/FooterView', $content);
	}

	public function Datatable()
	{
		$helper = Helper::getInstance();
		$table = $this->tableName;
		$column_order = array('sku', 'name', 'brand', 'category', 'is_active');
		$column_search = array('sku', 'name', 'brand', 'category', 'is_active');
		$orderby = array('sku' => 'asc');
		$where = null;
		$list = $helper->get_datatables($table, $column_order, $column_search, $orderby, $where);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $key) {
			$row = array();
			$row[] = ++$no;
			$row[] = $key->sku;
			$row[] = $key->name;
			$row[] = $key->brand;
			$row[] = $key->category;

			if ($key->is_active == '1') {
				$row[] = '<span class="badge badge-success">Active</span>';
			} else {
				$row[] = '<span class="badge badge-danger">Inactive</span>';
			}

			$action = '
            <div class="text-center">
                <button type="button" title="View Detail" class="btn btn-primary btn-icon btn-sm " onclick="btnView(\'' . $key->id . '\')"><i class="fa-solid fa-eye"></i></button> ';
			$action .= '<a href="' . base_url("uploads/products/$key->img_url") . '"  target="_blank" title="Preview" class="btn btn-info btn-icon btn-sm "><i class="fa-solid fa-image"></i></a> ';
			$action .= '<button type="button" title="Edit" class="btn btn-warning btn-icon btn-sm " onclick="btnEdit(\'' . $key->id . '\')"><i class="fa-solid fa-pen-to-square"></i></button> ';
			if ($key->is_active == '0') {
				$action .= '<button type="button" title="Active/Inactive" class="btn btn-dark btn-icon btn-sm " onclick="btnActive(\'' . $key->id . '\', 1)"><i class="fa-solid fa-toggle-off"></i></button> ';
			} else {
				$action .= '<button type="button" title="Active/Inactive" class="btn btn-light btn-icon btn-sm " onclick="btnActive(\'' . $key->id . '\', 0)"><i class="fa-solid fa-toggle-on"></i></button> ';
			}
			$action .= '<button type="button" title="Delete" class="btn btn-danger btn-icon btn-sm " onclick="btnDelete(\'' . $key->id . '\')"><i class="fa-solid fa-trash-can"></i></button>';
			$action .= '</div>';

			$row[] = $action;
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
			$data = $this->ProductModel->GetAll();
			echo json_encode(['status' => true, 'message' => 'Success', 'data' => $data]);
		} catch (\Throwable $th) {
			$helper = Helper::getInstance();
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
			$data = $this->ProductModel->Get($id);
			echo json_encode(['status' => true, 'message' => 'Success', 'data' => $data]);
		} catch (\Throwable $th) {
			$helper = Helper::getInstance();
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

			$upload = $this->ProductModel->Upload($data);

			if (!empty($upload['error'])) {
				echo json_encode(['status' => false, 'message' => $upload['error']]);
				return;
			}

			$data['img_url'] = $upload['product']['upload_data']['file_name'];
			$this->ProductModel->Insert($data);

			echo json_encode(['status' => true, 'message' => 'Success']);
		} catch (\Throwable $th) {
			$helper = Helper::getInstance();
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

			$upload = $this->ProductModel->Upload($data);

			if (!empty($upload['error'])) {
				echo json_encode(['status' => false, 'message' => $upload['error']]);
				return;
			}

			if (!empty($upload['product'])) {
				$data['img_url'] = $upload['product']['upload_data']['file_name'];
			}

			$this->ProductModel->Update($data);
			echo json_encode(['status' => true, 'message' => 'Success']);
		} catch (\Throwable $th) {
			$helper = Helper::getInstance();
			$data = array(
				'log_error_controller' => $this->router->fetch_class(),
				'log_error_method' => $this->router->fetch_method(),
				'log_error_desc' => $th->getMessage()
			);
			$helper->CreateLog($data);
			echo json_encode(['status' => false, 'message' => $th->getMessage()]);
		}
	}

	public function UpdateActive($id, $is_active)
	{
		try {
			$this->ProductModel->UpdateActive($id, $is_active);
			echo json_encode(['status' => true, 'message' => 'Success']);
		} catch (\Throwable $th) {
			$helper = Helper::getInstance();
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
			$this->ProductModel->Delete($id);
			echo json_encode(['status' => true, 'message' => 'Success']);
		} catch (\Throwable $th) {
			$helper = Helper::getInstance();
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
