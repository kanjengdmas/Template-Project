<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_User extends CI_Model {

    public function login($identity) {
        $this->db->group_start();
        $this->db->where('username', $identity);
        $this->db->or_where('email', $identity);
        $this->db->group_end();
        return $this->db->get('users')->row();
    }

    public function get_all_anggota() {
        $this->db->where('role', 'anggota');
        return $this->db->get('users')->result();
    }

    public function get_anggota_by_id($id) {
        $this->db->where('id_user', $id);
        $this->db->where('role', 'anggota');
        return $this->db->get('users')->row();
    }

    public function get_user_by_id($id) {
        $this->db->where('id_user', $id);
        return $this->db->get('users')->row();
    }

    public function insert_anggota($data) {
        return $this->db->insert('users', $data);
    }

    public function update_anggota($id, $data) {
        $this->db->where('id_user', $id);
        return $this->db->update('users', $data);
    }

    public function delete_anggota($id) {
        $this->db->where('id_user', $id);
        return $this->db->delete('users');
    }

    public function count_anggota() {
        $this->db->where('role', 'anggota');
        return $this->db->count_all_results('users');
    }
}
