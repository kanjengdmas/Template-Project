<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat_model extends CI_Model {

    public function get_all() {
        return $this->db->get('obat')->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('obat', ['id' => $id])->row();
    }

    public function insert($data) {
        $this->db->insert('obat', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('obat', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('obat');
    }

    public function count_obat() {
        return $this->db->count_all('obat');
    }
}
