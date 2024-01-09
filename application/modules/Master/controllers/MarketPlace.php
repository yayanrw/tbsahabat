<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class MarketPlace extends CI_Controller
{
	private $titleName = 'Master Market Place';
	private $tableName = 'm_market_place';
	private $viewName = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MarketPlaceModel');
	}

	public function index()
	{
		$helper = new Helper();
		$helper->IsLoggedIn();
		$content['titleName'] = $this->titleName;
		$content['js'] = 'js/MarketPlaceJs';

		$this->load->view('Layout/HeaderView', $content);
		$this->load->view('MarketPlaceView', $content);
		$this->load->view('Layout/FooterView', $content);
	}

	public function Datatable()
	{
		$helper = new Helper();
		$table = $this->tableName;
		$column_order = array('market_place', 'is_active');
		$column_search = array('market_place', 'is_active');
		$orderby = array('market_place' => 'asc');
		$where = null;
		$list = $helper->get_datatables($table, $column_order, $column_search, $orderby, $where);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $key) {
			$row = array();
			$row[] = ++$no;
			$row[] = $key->market_place;

			if ($key->is_active == '1') {
				$row[] = '<span class="badge badge-success">Active</span>';
			} else {
				$row[] = '<span class="badge badge-danger">Inactive</span>';
			}

			$action = '
            <div class="text-center">';

			if ($key->is_active == '0') {
				$action .= '<button type="button" title="Acive/Inactive" class="btn btn-dark btn-icon btn-sm " onclick="btnActive(\'' . $key->id . '\', 1)"><i class="fa-solid fa-toggle-off"></i></button>';
			} else {
				$action .= '<button type="button" title="Acive/Inactive" class="btn btn-light btn-icon btn-sm " onclick="btnActive(\'' . $key->id . '\', 0)"><i class="fa-solid fa-toggle-on"></i></button>';
			}
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
			$data = $this->MarketPlaceModel->GetAll();
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
			$data = $this->MarketPlaceModel->Get($id);
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
			$this->MarketPlaceModel->Insert($data);
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
			$this->MarketPlaceModel->Update($data);
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

	public function UpdateActive($id, $is_active)
	{
		try {
			$this->MarketPlaceModel->UpdateActive($id, $is_active);
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
			$this->MarketPlaceModel->Delete($id);
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
