<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Kategori extends CI_Model {

    public function get_all() {
        return $this->db->get('kategori')->result();
    }

    public function get_by_id($id) {
        $this->db->where('id_kategori', $id);
        return $this->db->get('kategori')->row();
    }

    public function insert($data) {
        return $this->db->insert('kategori', $data);
    }

    public function update($id, $data) {
        $this->db->where('id_kategori', $id);
        return $this->db->update('kategori', $data);
    }

    public function delete($id) {
        $this->db->where('id_kategori', $id);
        return $this->db->delete('kategori');
    }

    public function count_kategori() {
        return $this->db->count_all_results('kategori');
    }
}
