<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class About extends CI_Controller
{
	private $titleName = 'About';
	private $tableName = 'm_about';
	private $viewName = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AboutModel');
	}

	public function index()
	{
		$helper = Helper::getInstance();
		$helper->IsLoggedIn();
		$content['titleName'] = $this->titleName;
		$content['js'] = 'js/AboutJs';

		$this->load->view('Layout/HeaderView', $content);
		$this->load->view('AboutView', $content);
		$this->load->view('Layout/FooterView', $content);
	}

	public function Get($id)
	{
		try {
			$data = $this->AboutModel->Get($id);
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

	public function Update()
	{
		try {
			$data = $this->input->post();

			$upload = $this->AboutModel->Upload($data);

			if (!empty($upload['error'])) {
				echo json_encode(['status' => false, 'message' => $upload['error']]);
				return;
			}

			if (!empty($upload['about'])) {
				$data['img_url'] = $upload['about']['upload_data']['file_name'];
			}

			$this->AboutModel->Update($data);
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
