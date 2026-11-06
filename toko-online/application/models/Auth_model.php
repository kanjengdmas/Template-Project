<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function register_user($data) {
        return $this->db->insert('users', $data);
    }

    public function check_login($identity, $password) {
        $this->db->group_start();
        $this->db->where('username', $identity);
        $this->db->or_where('email', $identity);
        $this->db->group_end();
        $query = $this->db->get('users');
        
        if ($query->num_rows() === 1) {
            $user = $query->row_array();
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return FALSE;
    }
}
