<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class BrandModel extends CI_Model
{
	private $tableName = 'm_brand';

	public function __construct()
	{
		parent::__construct();
	}

	public function GetAll()
	{
		$data = $this->db->get_where($this->tableName, ['is_active' => 1])->result();
		return $data;
	}

	public function Get($id)
	{
		$data = $this->db->get_where($this->tableName, ['id' => $id])->row();
		return $data;
	}

	public function Insert($data)
	{
		$helper = new Helper();

		$insert = array(
			'brand' => $helper->NullSafety($data['brand']),
			'img_url' => $helper->NullSafety($data['img_url']),
			'is_active' => $helper->NullSafety($data['is_active']),
			'created_by' => $this->session->userdata('user_id'),
		);
		$this->db->insert($this->tableName, $insert);
	}

	public function Update($data)
	{
		$helper = new Helper();
		$update = array(
			'brand' => $helper->NullSafety($data['brand']),
			'img_url' => $helper->NullSafety($data['img_url']),
			'is_active' => $helper->NullSafety($data['is_active']),
		);
		$this->db->where('id', $data['id']);
		$this->db->update($this->tableName, $update);
	}

	public function UpdateActive($id, $is_active)
	{
		$update = array(
			'is_active' => $is_active,
		);
		$this->db->where('id', $id);
		$this->db->update($this->tableName, $update);
	}

	public function Delete($id)
	{
		return $this->db->delete($this->tableName, ['id' => $id]);
	}
}

/* End of file filename.php */
