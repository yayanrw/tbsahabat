<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class Voucher extends CI_Controller
{
	private $titleName = 'Voucher';
	private $tableName = 't_voucher';
	private $viewName = 'v_voucher';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('VoucherModel');
	}

	public function index()
	{
		$helper = Helper::getInstance();
		$helper->IsLoggedIn();
		$content['titleName'] = $this->titleName;
		$content['js'] = 'js/VoucherJs';

		$this->load->view('Layout/HeaderView', $content);
		$this->load->view('VoucherView', $content);
		$this->load->view('Layout/FooterView', $content);
	}

	public function Datatable()
	{
		$helper = Helper::getInstance();
		$table = $this->viewName;
		$column_order = array('voucher_code', 'market_place',);
		$column_search = array('voucher_code', 'market_place',);
		$orderby = array('voucher_code' => 'asc');
		$where = array('event_id' => $this->input->post('event_id'));
		$list = $helper->get_datatables($table, $column_order, $column_search, $orderby, $where);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $key) {
			$row = array();
			$row[] = ++$no;

			$row[] = $key->voucher_code;
			$row[] = $key->market_place;

			$row[] = '
            <div class="text-center">
                <button type="button" title="View Detail" class="btn btn-primary btn-icon btn-sm " onclick="btnView(\'' . $key->id . '\')"><i class="fa-solid fa-eye"></i></button>
                <button type="button" title="Edit" class="btn btn-warning btn-icon btn-sm " onclick="btnEdit(\'' . $key->id . '\')"><i class="fa-solid fa-pen-to-square"></i></button>
                <button type="button" title="Delete" class="btn btn-danger btn-icon btn-sm " onclick="btnDelete(\'' . $key->id . '\')"><i class="fa-solid fa-trash-can"></i></button>
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
			$data = $this->VoucherModel->GetAll();
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
			$data = $this->VoucherModel->Get($id);
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
			$this->VoucherModel->Insert($data);
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
			$this->VoucherModel->Update($data);
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
			$this->VoucherModel->Delete($id);
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
