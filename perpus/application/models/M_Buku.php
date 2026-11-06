<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Buku extends CI_Model {

    public function get_all() {
        $this->db->select('buku.*, kategori.nama_kategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->select('buku.*, kategori.nama_kategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left');
        $this->db->where('buku.id_buku', $id);
        return $this->db->get()->row();
    }

    public function insert($data) {
        return $this->db->insert('buku', $data);
    }

    public function update($id, $data) {
        $this->db->where('id_buku', $id);
        return $this->db->update('buku', $data);
    }

    public function delete($id) {
        $this->db->where('id_buku', $id);
        return $this->db->delete('buku');
    }

    public function count_buku() {
        return $this->db->count_all_results('buku');
    }

    public function count_buku_tersedia() {
        $this->db->where('stok >', 0);
        return $this->db->count_all_results('buku');
    }

    public function get_buku_terbaru($limit = 6) {
        $this->db->select('buku.*, kategori.nama_kategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left');
        $this->db->order_by('id_buku', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function get_buku_populer($limit = 5) {
        // Query to get books most frequently borrowed
        $this->db->select('buku.id_buku, buku.judul, buku.penulis, buku.cover, COUNT(peminjaman.id_pinjam) as total_pinjam');
        $this->db->from('buku');
        $this->db->join('peminjaman', 'peminjaman.id_buku = buku.id_buku', 'left');
        $this->db->group_by('buku.id_buku');
        $this->db->order_by('total_pinjam', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
}
