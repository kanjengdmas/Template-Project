<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter_model extends CI_Model {

    public function get_all() {
        $this->db->select('dokter.*, users.nama, users.username, users.email');
        $this->db->from('dokter');
        $this->db->join('users', 'users.id = dokter.user_id');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->select('dokter.*, users.nama, users.username, users.email');
        $this->db->from('dokter');
        $this->db->join('users', 'users.id = dokter.user_id');
        $this->db->where('dokter.id', $id);
        return $this->db->get()->row();
    }

    public function get_by_user_id($user_id) {
        return $this->db->get_where('dokter', ['user_id' => $user_id])->row();
    }

    public function insert($data) {
        $this->db->insert('dokter', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('dokter', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('dokter');
    }

    public function count_dokter() {
        return $this->db->count_all('dokter');
    }
}
