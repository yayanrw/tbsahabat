<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class ProductGroup extends CI_Controller
{
	private $titleName = 'Product Group';
	private $tableName = 'm_product_group';
	private $viewName = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ProductGroupModel');
	}

	public function Show($product_sub_category_id)
	{
		$helper = Helper::getInstance();
		$helper->IsLoggedIn();
		$content['titleName'] = $this->titleName;
		$content['js'] = 'js/ProductGroupJs';

		$content['product_sub_category_id'] = $product_sub_category_id;

		$this->load->view('Layout/HeaderView', $content);
		$this->load->view('ProductGroupView', $content);
		$this->load->view('Layout/FooterView', $content);
	}

	public function Datatable()
	{
		$helper = Helper::getInstance();
		$table = $this->tableName;
		$column_order = array('group', 'is_active');
		$column_search = array('group', 'is_active');
		$orderby = array('group' => 'asc');
		$where = [
			'product_sub_category_id' => $_POST['product_sub_category_id'],
		];
		$list = $helper->get_datatables($table, $column_order, $column_search, $orderby, $where);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $key) {
			$row = array();
			$row[] = ++$no;
			$row[] = $key->group;

			if ($key->is_active == '1') {
				$row[] = '<span class="badge badge-success">Active</span>';
			} else {
				$row[] = '<span class="badge badge-danger">Inactive</span>';
			}

			$action = '
            <div class="text-center">';
			$action .= '<a href="' . base_url("uploads/group/$key->img_url") . '"  target="_blank" title="Preview" class="btn btn-info btn-icon btn-sm "><i class="fa-solid fa-image"></i></a> ';
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
			$data = $this->ProductGroupModel->GetAll();
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
			$data = $this->ProductGroupModel->Get($id);
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

			$upload = $this->ProductGroupModel->Upload($data);

			if (!empty($upload['error'])) {
				echo json_encode(['status' => false, 'message' => $upload['error']]);
				return;
			}

			$data['img_url'] = $upload['sub_category']['upload_data']['file_name'];
			$this->ProductGroupModel->Insert($data);

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

			$upload = $this->ProductGroupModel->Upload($data);

			if (!empty($upload['error'])) {
				echo json_encode(['status' => false, 'message' => $upload['error']]);
				return;
			}

			if (!empty($upload['sub_category'])) {
				$data['img_url'] = $upload['sub_category']['upload_data']['file_name'];
			}

			$this->ProductGroupModel->Update($data);
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
			$this->ProductGroupModel->UpdateActive($id, $is_active);
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
			$this->ProductGroupModel->Delete($id);
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
