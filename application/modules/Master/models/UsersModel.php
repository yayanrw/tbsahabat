<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Helper.php';

class UsersModel extends CI_Model
{
    private $tableName = 'm_user';
    private $viewName = 'v_users';

    public function __construct()
    {
        parent::__construct();
    }

    public function GetAll()
    {
        $data = $this->db->get_where($this->tableName, ['user_status' => 1])->result();
        return $data;
    }

    public function Get($id)
    {
        $data = $this->db->get_where($this->viewName, ['user_id' => $id])->row();
        return $data;
    }

    public function Insert($data)
    {
        $helper = new Helper();

        $insert = array(
            'user_name' => $helper->NullSafety($data['user_name']),
            'user_email' => $helper->NullSafety($data['user_email']),
            'user_fullname' => $helper->NullSafety($data['user_fullname']),
            'user_password' => $helper->NullSafety(hash('sha256', md5($data['user_password'])), hash('sha256', md5('juragan99'))),
            'role_id' => $helper->NullSafety($data['role_id']),
            'user_status' => $helper->NullSafety($data['user_status']),
        );
        $this->db->insert($this->tableName, $insert);
    }

    public function Update($data)
    {
        $helper = new Helper();
        $update = array(
            'user_name' => $helper->NullSafety($data['user_name']),
            'user_email' => $helper->NullSafety($data['user_email']),
            'user_fullname' => $helper->NullSafety($data['user_fullname']),
            'user_password' => $helper->NullSafety(hash('sha256', md5($data['user_password'])), hash('sha256', md5('juragan99'))),
            'role_id' => $helper->NullSafety($data['role_id']),
            'user_status' => $helper->NullSafety($data['user_status']),
        );
        $this->db->where('user_id', $data['user_id']);
        $this->db->update($this->tableName, $update);
    }

    public function Delete($id)
    {
        return $this->db->delete($this->tableName, ['user_id' => $id]);
    }
}

/* End of file filename.php */
