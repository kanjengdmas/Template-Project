<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_all_users() {
        return $this->db->get('users')->result_array();
    }

    public function get_user_by_id($id) {
        return $this->db->get_where('users', ['id' => $id])->row_array();
    }

    public function get_user_by_username_or_email($username) {
        $this->db->group_start();
        $this->db->where('username', $username);
        $this->db->or_where('email', $username);
        $this->db->group_end();
        return $this->db->get('users')->row_array();
    }

    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    public function update_user($id, $data) {
        return $this->db->where('id', $id)->update('users', $data);
    }

    public function delete_user($id) {
        return $this->db->where('id', $id)->delete('users');
    }

    public function count_by_role($role) {
        return $this->db->where('role', $role)->count_all_results('users');
    }
}
