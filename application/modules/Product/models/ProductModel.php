<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class ProductModel extends CI_Model
{
	private $tableName = 'm_product';

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
			'product_group_id' => $helper->NullSafety($data['product_group_id'], 0),
			'brand_id' => $helper->NullSafety($data['brand_id'], 0),
			'sku' => $helper->NullSafety($data['sku']),
			'name' => $helper->NullSafety($data['name']),
			'img_url' => $helper->NullSafety($data['img_url']),
			'price' => $helper->NullSafety($data['price']),
			'specification' => $helper->NullSafety($data['specification']),
			'description' => $helper->NullSafety($data['description']),
			'is_active' => $helper->NullSafety($data['is_active'], 1),
			'created_by' => $this->session->userdata('user_id'),
		);
		$this->db->insert($this->tableName, $insert);
	}

	public function Update($data)
	{
		$helper = Helper::getInstance();

		if (empty($data['img_url'])) {
			$update = array(
				'product_group_id' => $helper->NullSafety($data['product_group_id'], 0),
				'brand_id' => $helper->NullSafety($data['brand_id'], 0),
				'sku' => $helper->NullSafety($data['sku']),
				'name' => $helper->NullSafety($data['name']),
				'price' => $helper->NullSafety($data['price']),
				'specification' => $helper->NullSafety($data['specification']),
				'description' => $helper->NullSafety($data['description']),
				'is_active' => $helper->NullSafety($data['is_active'], 1),
				'updated_by' => $this->session->userdata('user_id'),
			);
		} else {
			$update = array(
				'product_group_id' => $helper->NullSafety($data['product_group_id'], 0),
				'brand_id' => $helper->NullSafety($data['brand_id'], 0),
				'sku' => $helper->NullSafety($data['sku']),
				'name' => $helper->NullSafety($data['name']),
				'img_url' => $helper->NullSafety($data['img_url']),
				'price' => $helper->NullSafety($data['price']),
				'specification' => $helper->NullSafety($data['specification']),
				'description' => $helper->NullSafety($data['description']),
				'is_active' => $helper->NullSafety($data['is_active'], 1),
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
		$product = $helper->UploadImage('img_url', './uploads/products/', 10240, false);

		if (!empty($product['error'])) {
			$upload['error'] = $product['error'];
		}
		$upload['product'] = $product['upload'];
		return $upload;
	}
}

/* End of file filename.php */
