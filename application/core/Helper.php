<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '../system/core/Model.php';

class Helper extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('image_lib');
	}
	// Start Datatable
	public function _get_datatables_query($table, $column_order, $column_search, $orderby, $where = null)
	{
		$this->db->from($table);

		if (!empty($where)) {
			$this->db->where($where);
		}

		$i = 0;

		foreach ($column_search as $item) // loop column 
		{
			if ($_POST['search']['value']) // if datatable send POST for search
			{

				if ($i === 0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if (isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column_order[$_POST['order']['0']['column'] - 1], $_POST['order']['0']['dir']);
		} else if (isset($orderby)) {
			$order = $orderby;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_datatables($table, $column_order, $column_search, $orderby, $where = null)
	{
		$this->_get_datatables_query($table, $column_order, $column_search, $orderby, $where);
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered($table, $column_order, $column_search, $orderby, $where = null)
	{
		$this->_get_datatables_query($table, $column_order, $column_search, $orderby, $where);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($table, $where = null)
	{
		if (!empty($where)) {
			$this->db->where($where);
		}
		$this->db->from($table);
		return $this->db->count_all_results();
	}
	// End Datatable
	public function IsLoggedIn($page = null)
	{
		if ($page == 'login') {
			if (!empty($this->session->has_userdata('logged_in'))) {
				$redirect_to = $this->session->userdata('redirect_to');
				redirect($redirect_to, 'refresh');
			}
		} else {
			if (empty($this->session->has_userdata('logged_in'))) {
				redirect('login/user', 'refresh');
			}
		}
	}

	public function CreateLog($data)
	{
		$insert = array(
			'log_error_controller' => $data['log_error_controller'],
			'log_error_method' => $data['log_error_method'],
			'log_error_desc' => $data['log_error_desc'],
			'created_by' => $this->session->userdata('user_id')
		);
		$this->db->insert('t_log_error', $insert);
	}

	public function NullSafety($data, $null_desc = null)
	{
		if (isset($data)) {
			return $data;
		} else {
			if (isset($null_desc)) {
				return $null_desc;
			} else {
				return "N/A";
			}
		}
	}

	public function NullSafetyDate($data, $null_desc = null)
	{
		if (isset($data)) {
			return $data;
		} else {
			if (isset($null_desc)) {
				return $null_desc;
			} else {
				return date("Y-m-d H:i:s");
			}
		}
	}

	public function GenerateRandomString($length = 10)
	{
		return substr(str_shuffle(str_repeat($x = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
	}

	public function UploadImage($field_name, $path, $max_size = 10240, $is_required = false)
	{
		$config = array(
			// 'upload_path'   => './uploads/customer_service/bukti_pembelian/',
			'upload_path'   => $path,
			'allowed_types' => 'png|jpg|jpeg|jfif',
			// 'max_size'      => 10240,
			'max_size'      => $max_size,
			'encrypt_name'  => TRUE
		);

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($is_required) {
			if (!$this->upload->do_upload($field_name)) {
				$error[$field_name] = $this->upload->display_errors();
			} else {
				$upload[$field_name] = array('upload_data' => $this->upload->data());
				$configer = array(
					'image_library' => 'gd2',
					'source_image' => $upload[$field_name]['upload_data']['full_path'],
					'create_thumb' => FALSE, //tell the CI do not create thumbnail on image
					'maintain_ratio' => TRUE,
					'quality' => '80%', //tell CI to reduce the image quality and affect the image size
					'width' => 1000, //new size of image
					'height' => 1000, //new size of image
				);
				$this->image_lib->clear();
				$this->image_lib->initialize($configer);
				$this->image_lib->resize();
			}
		} else {
			if ($this->upload->do_upload($field_name)) {
				$upload[$field_name] = array('upload_data' => $this->upload->data());
				$configer = array(
					'image_library' => 'gd2',
					'source_image' => $upload[$field_name]['upload_data']['full_path'],
					'create_thumb' => FALSE, //tell the CI do not create thumbnail on image
					'maintain_ratio' => TRUE,
					'quality' => '80%', //tell CI to reduce the image quality and affect the image size
					'width' => 1000, //new size of image
					'height' => 1000, //new size of image
				);
				$this->image_lib->clear();
				$this->image_lib->initialize($configer);
				$this->image_lib->resize();
			}
		}

		$data = array(
			'error' => isset($error[$field_name]) ? $error[$field_name] : "",
			'upload' => isset($upload[$field_name]) ? $upload[$field_name] : ""
		);

		return $data;
	}

	public function SoftDelete($table, $id) //soft delete
	{
		$data = array(
			'is_deleted'    => 1,
			'deleted_at'    => date('Y-m-d H:i:s'),
			'deleted_by'    => $this->session->userdata('username')
		);
		$this->db->where('id', $id);
		$this->db->update($table, $data);
	}

	public function ConvertDate($date, $formatFrom = 'd-m-Y', $formatTo = 'Y-m-d')
	{
		$date = DateTime::createFromFormat($formatFrom, $date);
		return $date->format($formatTo);
	}

	public function toRupiah($number)
	{
		return 'Rp ' . number_format($number, 0, ',', '.');
	}
}

/* End of file filename.php */
