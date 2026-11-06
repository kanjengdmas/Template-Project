<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemeriksaan_model extends CI_Model {

    public function get_all() {
        $this->db->select('pemeriksaan.*, p.nama as nama_pasien, d.nama as nama_dokter');
        $this->db->from('pemeriksaan');
        $this->db->join('users p', 'p.id = pemeriksaan.pasien_id');
        $this->db->join('users d', 'd.id = pemeriksaan.dokter_id', 'left');
        $this->db->order_by('pemeriksaan.tanggal', 'DESC');
        $this->db->order_by('pemeriksaan.id', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->select('pemeriksaan.*, p.nama as nama_pasien, d.nama as nama_dokter');
        $this->db->from('pemeriksaan');
        $this->db->join('users p', 'p.id = pemeriksaan.pasien_id');
        $this->db->join('users d', 'd.id = pemeriksaan.dokter_id', 'left');
        $this->db->where('pemeriksaan.id', $id);
        return $this->db->get()->row();
    }

    public function get_by_pasien_id($pasien_id) {
        $this->db->select('pemeriksaan.*, d.nama as nama_dokter');
        $this->db->from('pemeriksaan');
        $this->db->join('users d', 'd.id = pemeriksaan.dokter_id', 'left');
        $this->db->where('pasien_id', $pasien_id);
        $this->db->order_by('tanggal', 'DESC');
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();
    }
    
    public function get_by_dokter_id($dokter_id) {
        $this->db->select('pemeriksaan.*, p.nama as nama_pasien');
        $this->db->from('pemeriksaan');
        $this->db->join('users p', 'p.id = pemeriksaan.pasien_id');
        $this->db->where('dokter_id', $dokter_id);
        $this->db->order_by('tanggal', 'DESC');
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();
    }
    
    public function get_by_status($status) {
        $this->db->select('pemeriksaan.*, p.nama as nama_pasien, d.nama as nama_dokter, dok.spesialis');
        $this->db->from('pemeriksaan');
        $this->db->join('users p', 'p.id = pemeriksaan.pasien_id');
        $this->db->join('users d', 'd.id = pemeriksaan.dokter_id', 'left');
        $this->db->join('dokter dok', 'dok.user_id = d.id', 'left');
        $this->db->where('status', $status);
        $this->db->order_by('tanggal', 'DESC');
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_status_and_dokter_id($status, $dokter_id) {
        $this->db->select('pemeriksaan.*, p.nama as nama_pasien');
        $this->db->from('pemeriksaan');
        $this->db->join('users p', 'p.id = pemeriksaan.pasien_id');
        $this->db->where('status', $status);
        $this->db->where('dokter_id', $dokter_id);
        $this->db->order_by('tanggal', 'DESC');
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();
    }

    public function insert($data) {
        $this->db->insert('pemeriksaan', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('pemeriksaan', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('pemeriksaan');
    }
    
    public function get_resep_by_pemeriksaan($pemeriksaan_id) {
        $this->db->select('resep_obat.*, obat.nama_obat, obat.jenis_obat');
        $this->db->from('resep_obat');
        $this->db->join('obat', 'obat.id = resep_obat.obat_id');
        $this->db->where('pemeriksaan_id', $pemeriksaan_id);
        return $this->db->get()->result();
    }

    public function insert_resep($data) {
        $this->db->insert('resep_obat', $data);
        return $this->db->insert_id();
    }

    public function delete_resep_by_pemeriksaan($pemeriksaan_id) {
        $this->db->where('pemeriksaan_id', $pemeriksaan_id);
        return $this->db->delete('resep_obat');
    }

    public function count_pemeriksaan() {
        return $this->db->count_all('pemeriksaan');
    }
    
    public function count_by_status($status) {
        $this->db->where('status', $status);
        return $this->db->count_all_results('pemeriksaan');
    }

    public function count_by_status_and_dokter_id($status, $dokter_id) {
        $this->db->where('status', $status);
        $this->db->where('dokter_id', $dokter_id);
        return $this->db->count_all_results('pemeriksaan');
    }
}
