<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alat_model extends CI_Model {

    public function get_all_alat() {
        $this->db->select('alat.*, kategori.nama_kategori');
        $this->db->from('alat');
        $this->db->join('kategori', 'kategori.id = alat.kategori_id');
        return $this->db->get()->result_array();
    }

    public function get_available_alat() {
        $this->db->select('alat.*, kategori.nama_kategori');
        $this->db->from('alat');
        $this->db->join('kategori', 'kategori.id = alat.kategori_id');
        $this->db->where('stok >', 0);
        $this->db->where('status_ketersediaan', 'Tersedia');
        return $this->db->get()->result_array();
    }

    public function get_alat_by_id($id) {
        return $this->db->get_where('alat', ['id' => $id])->row_array();
    }

    public function insert_alat($data) {
        return $this->db->insert('alat', $data);
    }

    public function update_alat($id, $data) {
        return $this->db->where('id', $id)->update('alat', $data);
    }

    public function delete_alat($id) {
        return $this->db->where('id', $id)->delete('alat');
    }

    public function get_popular_alat($limit = 5) {
        $this->db->select('alat.nama_alat, alat.foto_alat, kategori.nama_kategori, COUNT(detail_peminjaman.alat_id) as total_pinjam');
        $this->db->from('detail_peminjaman');
        $this->db->join('alat', 'alat.id = detail_peminjaman.alat_id');
        $this->db->join('kategori', 'kategori.id = alat.kategori_id');
        $this->db->group_by('detail_peminjaman.alat_id, alat.nama_alat, alat.foto_alat, kategori.nama_kategori');
        $this->db->order_by('total_pinjam', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    public function count_all() {
        return $this->db->count_all('alat');
    }

    public function get_currently_borrowed_alat($limit = 4) {
        $this->db->select('alat.nama_alat, alat.foto_alat, alat.stok, SUM(detail_peminjaman.jumlah) as jumlah_dipinjam');
        $this->db->from('detail_peminjaman');
        $this->db->join('alat', 'alat.id = detail_peminjaman.alat_id');
        $this->db->join('peminjaman', 'peminjaman.id = detail_peminjaman.peminjaman_id');
        $this->db->where('peminjaman.status', 'Dipinjam');
        $this->db->group_by('detail_peminjaman.alat_id, alat.nama_alat, alat.foto_alat, alat.stok');
        $this->db->order_by('jumlah_dipinjam', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    public function generate_kode_alat() {
        $this->db->select('kode_alat');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('alat');
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $last_kode = $row['kode_alat'];
            preg_match('/\d+/', $last_kode, $matches);
            if (!empty($matches)) {
                $num = (int)$matches[0];
                $next_num = $num + 1;
                $prefix = preg_replace('/\d+/', '', $last_kode);
                return $prefix . sprintf("%03d", $next_num);
            }
        }
        return 'ALT-001';
    }
}
