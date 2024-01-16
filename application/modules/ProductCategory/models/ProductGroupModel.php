<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class ProductGroupModel extends CI_Model
{
	private $tableName = 'm_product_group';

	public function __construct()
	{
		parent::__construct();
	}

	public function GetAll()
	{
		$product_sub_category_id = $this->input->get('product_sub_category_id');

		if (!empty($product_sub_category_id)) {
			return $this->db->get_where($this->tableName, ['is_active' => 1, 'product_sub_category_id' => $product_sub_category_id])->result();
		}
		return $this->db->get_where($this->tableName, ['is_active' => 1])->result();
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
			'product_sub_category_id' => $helper->NullSafety($data['product_sub_category_id'], 0),
			'group' => $helper->NullSafety($data['group']),
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
				'group' => $helper->NullSafety($data['group']),
				'is_active' => $helper->NullSafety($data['is_active']),
				'updated_by' => $this->session->userdata('user_id'),
			);
		} else {
			$update = array(
				'group' => $helper->NullSafety($data['group']),
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
		$group = $helper->UploadImage('img_url', './uploads/group/', 10240, false);

		if (!empty($group['error'])) {
			$upload['error'] = $group['error'];
		}
		$upload['group'] = $group['upload'];
		return $upload;
	}
}

/* End of file filename.php */
