<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class BannerModel extends CI_Model
{
	private $tableName = 'm_banner';

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
		$helper = Helper::getInstance();

		$insert = array(
			'title' => $helper->NullSafety($data['title']),
			'sub_title' => $helper->NullSafety($data['sub_title']),
			'description' => $helper->NullSafety($data['description']),
			'img_url' => $helper->NullSafety($data['img_url']),
			'is_active' => $helper->NullSafety($data['is_active']),
			'created_by' => $this->session->userdata('user_id'),
		);
		$this->db->insert($this->tableName, $insert);
	}

	public function Update($data)
	{
		$helper = Helper::getInstance();

		if (empty($data['img_url'])) {
			$update = array(
				'title' => $helper->NullSafety($data['title']),
				'sub_title' => $helper->NullSafety($data['sub_title']),
				'description' => $helper->NullSafety($data['description']),
				'is_active' => $helper->NullSafety($data['is_active']),
				'updated_by' => $this->session->userdata('user_id'),
			);
		} else {
			$update = array(
				'title' => $helper->NullSafety($data['title']),
				'sub_title' => $helper->NullSafety($data['sub_title']),
				'description' => $helper->NullSafety($data['description']),
				'img_url' => $helper->NullSafety($data['img_url']),
				'is_active' => $helper->NullSafety($data['is_active']),
				'updated_by' => $this->session->userdata('user_id'),
			);
		}
		$this->db->where('id', $data['id']);
		$this->db->update($this->tableName, $update);
	}

	public function UpdateActive($id, $is_active)
	{
		$update = array(
			'is_active' => $is_active,
			'updated_by' => $this->session->userdata('user_id'),
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
		$banner = $helper->UploadImage('img_url', './uploads/banners/', 10240, false);

		if (!empty($banner['error'])) {
			$upload['error'] = $banner['error'];
		}
		$upload['banner'] = $banner['upload'];
		return $upload;
	}
}

/* End of file filename.php */
