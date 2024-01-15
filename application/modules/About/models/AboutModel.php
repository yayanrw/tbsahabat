<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class AboutModel extends CI_Model
{
	private $tableName = 'm_about';

	public function __construct()
	{
		parent::__construct();
	}

	public function Get($id)
	{
		$data = $this->db->get_where($this->tableName, ['id' => $id])->row();
		return $data;
	}

	public function Update($data)
	{
		$helper = Helper::getInstance();

		if (empty($data['img_url'])) {
			$update = array(
				'name' => $helper->NullSafety($data['name']),
				'address' => $helper->NullSafety($data['address']),
				'phone' => $helper->NullSafety($data['phone']),
				'whatsapp' => $helper->NullSafety($data['whatsapp']),
				'description' => $helper->NullSafety($data['description']),
				'updated_by' => $this->session->userdata('user_id'),
			);
		} else {
			$update = array(
				'name' => $helper->NullSafety($data['name']),
				'address' => $helper->NullSafety($data['address']),
				'phone' => $helper->NullSafety($data['phone']),
				'whatsapp' => $helper->NullSafety($data['whatsapp']),
				'img_url' => $helper->NullSafety($data['img_url']),
				'description' => $helper->NullSafety($data['description']),
				'updated_by' => $this->session->userdata('user_id'),
			);
		}
		$this->db->where('id', $data['id']);
		$this->db->update($this->tableName, $update);
	}

	public function Upload($data)
	{
		$helper = Helper::getInstance();
		$about = $helper->UploadImage('img_url', './uploads/abouts/', 10240, false);

		if (!empty($about['error'])) {
			$upload['error'] = $about['error'];
		}
		$upload['about'] = $about['upload'];
		return $upload;
	}
}

/* End of file filename.php */
