<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_model extends CI_Model {

    public function get_all_peminjaman() {
        $this->db->select('peminjaman.*, users.nama as nama_peminjam, alat.nama_alat, detail_peminjaman.jumlah');
        $this->db->from('peminjaman');
        $this->db->join('users', 'users.id = peminjaman.peminjam_id');
        $this->db->join('detail_peminjaman', 'detail_peminjaman.peminjaman_id = peminjaman.id');
        $this->db->join('alat', 'alat.id = detail_peminjaman.alat_id');
        $this->db->order_by('peminjaman.tanggal_pengajuan', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_peminjaman_for_pengembalian() {
        $this->db->select('peminjaman.*, users.nama as nama_peminjam, alat.nama_alat, alat.id as alat_id, detail_peminjaman.jumlah, 
            pengembalian.tanggal_dikembalikan, pengembalian.kondisi_alat_kembali, pengembalian.catatan, 
            denda.nominal_denda, denda.status_pembayaran');
        $this->db->from('peminjaman');
        $this->db->join('users', 'users.id = peminjaman.peminjam_id');
        $this->db->join('detail_peminjaman', 'detail_peminjaman.peminjaman_id = peminjaman.id');
        $this->db->join('alat', 'alat.id = detail_peminjaman.alat_id');
        $this->db->join('pengembalian', 'pengembalian.peminjaman_id = peminjaman.id', 'left');
        $this->db->join('denda', 'denda.pengembalian_id = pengembalian.id', 'left');
        $this->db->where_in('peminjaman.status', ['Dipinjam', 'Selesai']);
        $this->db->order_by('peminjaman.tanggal_pinjam', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_peminjaman_by_user($user_id) {
        $this->db->select('peminjaman.*, alat.nama_alat, detail_peminjaman.jumlah');
        $this->db->from('peminjaman');
        $this->db->join('detail_peminjaman', 'detail_peminjaman.peminjaman_id = peminjaman.id');
        $this->db->join('alat', 'alat.id = detail_peminjaman.alat_id');
        $this->db->where('peminjaman.peminjam_id', $user_id);
        $this->db->order_by('peminjaman.tanggal_pengajuan', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_peminjaman_by_user_limit($user_id, $limit) {
        $this->db->select('peminjaman.*, alat.nama_alat, detail_peminjaman.jumlah');
        $this->db->from('peminjaman');
        $this->db->join('detail_peminjaman', 'detail_peminjaman.peminjaman_id = peminjaman.id');
        $this->db->join('alat', 'alat.id = detail_peminjaman.alat_id');
        $this->db->where('peminjaman.peminjam_id', $user_id);
        $this->db->order_by('peminjaman.tanggal_pengajuan', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    public function get_peminjaman_by_id($id) {
        return $this->db->get_where('peminjaman', ['id' => $id])->row_array();
    }

    public function insert_peminjaman($data) {
        $this->db->insert('peminjaman', $data);
        return $this->db->insert_id();
    }

    public function insert_detail_peminjaman($data) {
        return $this->db->insert('detail_peminjaman', $data);
    }

    public function update_peminjaman($id, $data) {
        return $this->db->where('id', $id)->update('peminjaman', $data);
    }

    public function delete_peminjaman($id) {
        return $this->db->where('id', $id)->delete('peminjaman');
    }

    public function get_detail_peminjaman_by_peminjaman_id($peminjaman_id) {
        return $this->db->get_where('detail_peminjaman', ['peminjaman_id' => $peminjaman_id])->row_array();
    }

    public function insert_pengembalian($data) {
        $this->db->insert('pengembalian', $data);
        return $this->db->insert_id();
    }

    // counts for stats
    public function count_by_status($status, $user_id = null) {
        if ($user_id !== null) {
            $this->db->where('peminjam_id', $user_id);
        }
        $this->db->where('status', $status);
        return $this->db->count_all_results('peminjaman');
    }

    public function count_all_peminjaman($user_id = null) {
        if ($user_id !== null) {
            $this->db->where('peminjam_id', $user_id);
        }
        return $this->db->count_all_results('peminjaman');
    }

    public function count_by_status_and_date($status, $date = null) {
        $this->db->where('status', $status);
        if ($date !== null) {
            $this->db->where('tanggal_kembali_rencana', $date);
        }
        return $this->db->count_all_results('peminjaman');
    }

    public function get_recent_submissions($limit = 5) {
        $this->db->select('peminjaman.*, users.nama as nama_peminjam, alat.nama_alat, detail_peminjaman.jumlah');
        $this->db->from('peminjaman');
        $this->db->join('users', 'users.id = peminjaman.peminjam_id');
        $this->db->join('detail_peminjaman', 'detail_peminjaman.peminjaman_id = peminjaman.id');
        $this->db->join('alat', 'alat.id = detail_peminjaman.alat_id');
        $this->db->order_by('peminjaman.tanggal_pengajuan', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    public function get_recent_submissions_waiting($limit = 3) {
        $this->db->select('peminjaman.*, users.nama as nama_peminjam, users.nim_nik, alat.nama_alat, detail_peminjaman.jumlah');
        $this->db->from('peminjaman');
        $this->db->join('users', 'users.id = peminjaman.peminjam_id');
        $this->db->join('detail_peminjaman', 'detail_peminjaman.peminjaman_id = peminjaman.id');
        $this->db->join('alat', 'alat.id = detail_peminjaman.alat_id');
        $this->db->where('peminjaman.status', 'Menunggu Persetujuan');
        $this->db->order_by('peminjaman.tanggal_pengajuan', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    public function get_overdue_or_today_returns($limit = 2) {
        $this->db->select('peminjaman.*, users.nama as nama_peminjam, users.nim_nik, alat.nama_alat, detail_peminjaman.jumlah');
        $this->db->from('peminjaman');
        $this->db->join('users', 'users.id = peminjaman.peminjam_id');
        $this->db->join('detail_peminjaman', 'detail_peminjaman.peminjaman_id = peminjaman.id');
        $this->db->join('alat', 'alat.id = detail_peminjaman.alat_id');
        $this->db->where('peminjaman.status', 'Dipinjam');
        $this->db->where('peminjaman.tanggal_kembali_rencana <=', date('Y-m-d'));
        $this->db->order_by('peminjaman.tanggal_kembali_rencana', 'ASC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    public function get_laporan_peminjaman($tgl_awal, $tgl_akhir, $status = null) {
        $this->db->select('peminjaman.*, users.nama as nama_peminjam, alat.nama_alat, detail_peminjaman.jumlah');
        $this->db->from('peminjaman');
        $this->db->join('users', 'users.id = peminjaman.peminjam_id');
        $this->db->join('detail_peminjaman', 'detail_peminjaman.peminjaman_id = peminjaman.id');
        $this->db->join('alat', 'alat.id = detail_peminjaman.alat_id');
        
        if ($tgl_awal && $tgl_akhir) {
            $this->db->where('DATE(peminjaman.tanggal_pengajuan) >=', $tgl_awal);
            $this->db->where('DATE(peminjaman.tanggal_pengajuan) <=', $tgl_akhir);
        }
        
        if ($status !== null) {
            $this->db->where('peminjaman.status', $status);
        }

        return $this->db->get()->result_array();
    }

    public function get_recent_activities($limit = 5) {
        $sql = "
            (SELECT u.nama AS nama_user, a.nama_alat, 'pengajuan' AS tipe, p.tanggal_pengajuan AS tanggal, p.status, NULL AS nominal
             FROM peminjaman p
             JOIN users u ON u.id = p.peminjam_id
             JOIN detail_peminjaman dp ON dp.peminjaman_id = p.id
             JOIN alat a ON a.id = dp.alat_id)
            UNION ALL
            (SELECT u.nama AS nama_user, a.nama_alat, 'peminjaman' AS tipe, p.tanggal_pinjam AS tanggal, p.status, NULL AS nominal
             FROM peminjaman p
             JOIN users u ON u.id = p.peminjam_id
             JOIN detail_peminjaman dp ON dp.peminjaman_id = p.id
             JOIN alat a ON a.id = dp.alat_id
             WHERE p.tanggal_pinjam IS NOT NULL)
            UNION ALL
            (SELECT u.nama AS nama_user, a.nama_alat, 'pengembalian' AS tipe, pb.tanggal_dikembalikan AS tanggal, NULL AS status, NULL AS nominal
             FROM pengembalian pb
             JOIN peminjaman p ON p.id = pb.peminjaman_id
             JOIN users u ON u.id = p.peminjam_id
             JOIN detail_peminjaman dp ON dp.peminjaman_id = p.id
             JOIN alat a ON a.id = dp.alat_id)
            UNION ALL
            (SELECT u.nama AS nama_user, a.nama_alat, 'denda' AS tipe, d.created_at AS tanggal, d.status_pembayaran AS status, d.nominal_denda AS nominal
             FROM denda d
             JOIN pengembalian pb ON pb.id = d.pengembalian_id
             JOIN peminjaman p ON p.id = pb.peminjaman_id
             JOIN users u ON u.id = p.peminjam_id
             JOIN detail_peminjaman dp ON dp.peminjaman_id = p.id
             JOIN alat a ON a.id = dp.alat_id)
            ORDER BY tanggal DESC
            LIMIT ?
        ";
        return $this->db->query($sql, [$limit])->result_array();
    }
}
