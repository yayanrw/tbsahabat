<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class EventsModel extends CI_Model
{
	private $tableName = 't_events';

	public function __construct()
	{
		parent::__construct();
	}

	public function GetAll()
	{
		$data = $this->db->get_where($this->tableName)->result();
		return $data;
	}

	public function Get($id)
	{
		$data = $this->db->get_where($this->tableName, ['id' => $id])->row();
		return $data;
	}

	public function Insert($data)
	{
		$helper = Helper::getInstance();

		$insert = array(
			'event' => $helper->NullSafety($data['event']),
			'slug' => $helper->NullSafety($data['slug']),
			'banner_file' => $helper->NullSafety($data['banner_file']),
			'created_by' => $this->session->userdata('user_id'),
		);
		$this->db->insert($this->tableName, $insert);
	}

	public function Update($data)
	{
		$helper = Helper::getInstance();
		$update = array(
			'role_name' => $helper->NullSafety($data['role_name']),
			'role_status' => $helper->NullSafety($data['role_status']),
			'redirect_to' => $helper->NullSafety($data['redirect_to']),
		);
		$this->db->where('id', $data['id']);
		$this->db->update($this->tableName, $update);
	}

	public function UpdateActive($id, $is_active)
	{
		$helper = Helper::getInstance();
		$update = array(
			'is_active' => $helper->NullSafety($is_active, 0),
		);
		$this->db->where('id', $id);
		$this->db->update($this->tableName, $update);
	}

	public function Delete($id)
	{
		return $this->db->delete($this->tableName, ['id' => $id]);
	}

	public function Upload($data)
	{
		$helper = Helper::getInstance();
		$banner = $helper->UploadImage('banner_file', './uploads/banner/', 10240, true);

		if (!empty($banner['error'])) {
			$upload['error'] = $banner['error'];
		}
		$upload['banner'] = $banner['upload'];
		return $upload;
	}
}

/* End of file filename.php */
