<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denda_model extends CI_Model {

    public function get_all_denda() {
        $this->db->select('denda.*, users.nama as nama_peminjam, peminjaman.kode_peminjaman, alat.nama_alat');
        $this->db->from('denda');
        $this->db->join('pengembalian', 'pengembalian.id = denda.pengembalian_id');
        $this->db->join('peminjaman', 'peminjaman.id = pengembalian.peminjaman_id');
        $this->db->join('users', 'users.id = peminjaman.peminjam_id');
        $this->db->join('detail_peminjaman', 'detail_peminjaman.peminjaman_id = peminjaman.id');
        $this->db->join('alat', 'alat.id = detail_peminjaman.alat_id');
        $this->db->order_by('denda.created_at', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_denda_by_user($user_id) {
        $this->db->select('denda.*, peminjaman.kode_peminjaman, alat.nama_alat');
        $this->db->from('denda');
        $this->db->join('pengembalian', 'pengembalian.id = denda.pengembalian_id');
        $this->db->join('peminjaman', 'peminjaman.id = pengembalian.peminjaman_id');
        $this->db->join('detail_peminjaman', 'detail_peminjaman.peminjaman_id = peminjaman.id');
        $this->db->join('alat', 'alat.id = detail_peminjaman.alat_id');
        $this->db->where('peminjaman.peminjam_id', $user_id);
        return $this->db->get()->result_array();
    }

    public function insert_denda($data) {
        return $this->db->insert('denda', $data);
    }

    public function update_denda($id, $data) {
        return $this->db->where('id', $id)->update('denda', $data);
    }

    public function get_total_unpaid_denda() {
        $this->db->select_sum('nominal_denda');
        $this->db->where('status_pembayaran', 'Belum Dibayar');
        return $this->db->get('denda')->row()->nominal_denda ?? 0;
    }

    public function get_laporan_denda($tgl_awal, $tgl_akhir) {
        $this->db->select('denda.*, users.nama as nama_peminjam, peminjaman.kode_peminjaman, alat.nama_alat');
        $this->db->from('denda');
        $this->db->join('pengembalian', 'pengembalian.id = denda.pengembalian_id');
        $this->db->join('peminjaman', 'peminjaman.id = pengembalian.peminjaman_id');
        $this->db->join('users', 'users.id = peminjaman.peminjam_id');
        $this->db->join('detail_peminjaman', 'detail_peminjaman.peminjaman_id = peminjaman.id');
        $this->db->join('alat', 'alat.id = detail_peminjaman.alat_id');
        
        if ($tgl_awal && $tgl_akhir) {
            $this->db->where('DATE(denda.created_at) >=', $tgl_awal);
            $this->db->where('DATE(denda.created_at) <=', $tgl_akhir);
        }
        return $this->db->get()->result_array();
    }
}
