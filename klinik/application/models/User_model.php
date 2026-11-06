<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_all() {
        return $this->db->get('users')->result();
    }

    public function get_all_except_dokter() {
        $this->db->where('role !=', 'dokter');
        return $this->db->get('users')->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    public function get_by_email($email) {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    public function get_by_email_or_username($login) {
        $this->db->where('email', $login);
        $this->db->or_where('username', $login);
        return $this->db->get('users')->row();
    }

    public function get_by_role($role) {
        return $this->db->get_where('users', ['role' => $role])->result();
    }

    public function insert($data) {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    public function count_users() {
        return $this->db->count_all('users');
    }
}
