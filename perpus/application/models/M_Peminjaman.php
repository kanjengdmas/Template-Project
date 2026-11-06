<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Peminjaman extends CI_Model {

    public function get_all() {
        $this->db->select('peminjaman.*, users.nama as nama_anggota, buku.judul as judul_buku, buku.cover');
        $this->db->from('peminjaman');
        $this->db->join('users', 'users.id_user = peminjaman.id_user', 'left');
        $this->db->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left');
        $this->db->order_by('id_pinjam', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_user($id_user) {
        $this->db->select('peminjaman.*, buku.judul as judul_buku, buku.cover, buku.penulis');
        $this->db->from('peminjaman');
        $this->db->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left');
        $this->db->where('peminjaman.id_user', $id_user);
        $this->db->order_by('id_pinjam', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_user_active($id_user) {
        $this->db->select('peminjaman.*, buku.judul as judul_buku, buku.cover, buku.penulis');
        $this->db->from('peminjaman');
        $this->db->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left');
        $this->db->where('peminjaman.id_user', $id_user);
        $this->db->where_in('peminjaman.status', ['Dipinjam', 'Menunggu Verifikasi']);
        $this->db->order_by('id_pinjam', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->select('peminjaman.*, users.nama as nama_anggota, buku.judul as judul_buku, buku.cover');
        $this->db->from('peminjaman');
        $this->db->join('users', 'users.id_user = peminjaman.id_user', 'left');
        $this->db->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left');
        $this->db->where('id_pinjam', $id);
        return $this->db->get()->row();
    }

    public function insert($data) {
        return $this->db->insert('peminjaman', $data);
    }

    public function update($id, $data) {
        $this->db->where('id_pinjam', $id);
        return $this->db->update('peminjaman', $data);
    }

    public function count_peminjaman() {
        return $this->db->count_all_results('peminjaman');
    }

    public function count_buku_dipinjam() {
        $this->db->where('status', 'Dipinjam');
        return $this->db->count_all_results('peminjaman');
    }

    public function count_menunggu_verifikasi() {
        $this->db->where('status', 'Menunggu Verifikasi');
        return $this->db->count_all_results('peminjaman');
    }

    public function count_buku_dikembalikan() {
        $this->db->where('status', 'Dikembalikan');
        return $this->db->count_all_results('peminjaman');
    }

    // Check how many active books a user has (Dipinjam or Menunggu Verifikasi)
    public function get_active_user_borrows($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->where_in('status', ['Dipinjam', 'Menunggu Verifikasi']);
        return $this->db->count_all_results('peminjaman');
    }
}
