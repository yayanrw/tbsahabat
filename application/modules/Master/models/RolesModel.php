<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class RolesModel extends CI_Model
{
    private $tableName = 'm_role';

    public function __construct()
    {
        parent::__construct();
    }

    public function GetAll()
    {
        $data = $this->db->get_where($this->tableName, ['role_status' => 1])->result();
        return $data;
    }

    public function Get($id)
    {
        $data = $this->db->get_where($this->tableName, ['role_id' => $id])->row();
        return $data;
    }

    public function Insert($data)
    {
        $helper = Helper::getInstance();

        $insert = array(
            'role_name' => $helper->NullSafety($data['role_name']),
            'role_status' => $helper->NullSafety($data['role_status']),
            'redirect_to' => $helper->NullSafety($data['redirect_to']),
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
        $this->db->where('role_id', $data['role_id']);
        $this->db->update($this->tableName, $update);
    }

    public function Delete($id)
    {
        return $this->db->delete($this->tableName, ['role_id' => $id]);
    }
}

/* End of file filename.php */
