<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{
    public function AuthUser($data)
    {
        $user = $this->db->select('user_id, role_id, user_name, user_email, user_fullname, role_name, redirect_to, pc_name')
            ->from('v_users')
            ->where('user_password', hash('sha256', md5($data['user_password'])))
            ->group_start()
            ->where('user_name', $data['user_id'])
            ->or_where('user_email', $data['user_id'])
            ->group_end()
            ->get()->row_array();

        if (empty($user)) {
            $this->output->set_output(json_encode(array(
                'status' => FALSE,
                'messages' => 'Username/Email or Password is invalid'
            )));
            return;
        }

        if ($user['user_name'] === $data['user_id'] || $user['user_email'] === $data['user_id']) {
            $user['logged_in'] = TRUE;
            $this->session->set_userdata($user);
            $this->output->set_output(json_encode(array(
                'status' => TRUE,
                'redirect_to' => base_url($user['redirect_to']),
                'messages' => 'Login Successfully'
            )));
        } else {
            $this->output->set_output(json_encode(array(
                'status' => FALSE,
                'messages' => 'Username/Email or Password is invalid'
            )));
        }
    }
}

/* End of file filename.php */
