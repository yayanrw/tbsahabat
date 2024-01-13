<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class VoucherModel extends CI_Model
{
	private $tableName = 't_voucher';

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
			'event_id' => $helper->NullSafety($data['event_id']),
			'voucher_code' => $helper->NullSafety($data['voucher_code']),
			'market_place_id' => $helper->NullSafety($data['market_place_id']),
			'created_by' => $this->session->userdata('user_id'),
		);
		$this->db->insert($this->tableName, $insert);
	}

	public function Update($data)
	{
		$helper = Helper::getInstance();
		$update = array(
			'voucher_code' => $helper->NullSafety($data['voucher_code']),
			'market_place_id' => $helper->NullSafety($data['market_place_id']),
			'updated_by' => $this->session->userdata('user_id'),
		);
		$this->db->where('id', $data['id']);
		$this->db->update($this->tableName, $update);
	}

	public function Delete($id)
	{
		return $this->db->delete($this->tableName, ['id' => $id]);
	}
}

/* End of file filename.php */
