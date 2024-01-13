<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class Events extends CI_Controller
{
	private $titleName = 'Events';
	private $tableName = 't_events';
	private $viewName = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('EventsModel');
	}

	public function index()
	{
		$helper = Helper::getInstance();
		$helper->IsLoggedIn();
		$content['titleName'] = $this->titleName;
		$content['js'] = 'js/EventsJs';

		$this->load->view('Layout/HeaderView', $content);
		$this->load->view('EventsView', $content);
		$this->load->view('Layout/FooterView', $content);
	}

	public function Detail($id)
	{
		$helper = Helper::getInstance();
		$helper->IsLoggedIn();
		$content['event'] = $this->EventsModel->Get($id);
		$content['titleName'] = 'Voucher';
		$content['js'] = 'js/VoucherJs';

		$this->load->view('Layout/HeaderView', $content);
		$this->load->view('VoucherView', $content);
		$this->load->view('Layout/FooterView', $content);
	}

	public function Datatable()
	{
		$helper = Helper::getInstance();
		$table = $this->tableName;
		$column_order = array('event', 'slug', 'is_active');
		$column_search = array('event', 'slug', 'is_active');
		$orderby = array('created_at' => 'desc');
		$where = null;
		$list = $helper->get_datatables($table, $column_order, $column_search, $orderby, $where);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $key) {
			$row = array();
			$row[] = ++$no;

			$row[] = $key->event;
			$row[] = $key->slug;

			if ($key->is_active == '1') {
				$row[] = '<span class="badge badge-success">Active</span>';
			} else {
				$row[] = '<span class="badge badge-danger">Inactive</span>';
			}

			$action = '
            <div class="text-center">
                <button type="button" title="View Detail" class="btn btn-primary btn-icon btn-sm " onclick="btnView(\'' . $key->id . '\')"><i class="fa-solid fa-eye"></i></button> ';

			if ($key->is_active == '0') {
				$action .= '<button type="button" title="Acive/Inactive" class="btn btn-dark btn-icon btn-sm " onclick="btnActive(\'' . $key->id . '\', 1)"><i class="fa-solid fa-toggle-off"></i></button> ';
			} else {
				$action .= '<button type="button" title="Acive/Inactive" class="btn btn-light btn-icon btn-sm " onclick="btnActive(\'' . $key->id . '\', 0)"><i class="fa-solid fa-toggle-on"></i></button> ';
			}

			$action .= '<a href="' . base_url("e/$key->slug") . '"  target="_blank" title="Preview" class="btn btn-warning btn-icon btn-sm "><i class="fa-solid fa-link"></i></a>';

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
			$data = $this->EventsModel->GetAll();
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
			$data = $this->EventsModel->Get($id);
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

			$upload = $this->EventsModel->Upload($data);

			if (!empty($upload['error'])) {
				echo json_encode(['status' => false, 'message' => $upload['error']]);
				return;
			}

			$data['banner_file'] = $upload['banner']['upload_data']['file_name'];
			$this->EventsModel->Insert($data);

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
			$this->EventsModel->Update($data);
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
			$this->EventsModel->UpdateActive($id, $is_active);
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
			$this->EventsModel->Delete($id);
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
