<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!in_array($this->session->userdata('role'), ['Admin', 'Petugas'])) {
            redirect('dashboard');
        }
    }

    public function pengajuan() {
        $data['title'] = 'Data Pengajuan Peminjaman';
        
        $data['pengajuan'] = $this->Peminjaman_model->get_all_peminjaman();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('transaksi/pengajuan', $data);
        $this->load->view('layout/footer');
    }

    public function proses_pengajuan($id, $status) {
        if ($this->session->userdata('role') == 'Admin') {
            $this->session->set_flashdata('error', 'Akses ditolak: Administrator tidak dapat memproses transaksi!');
            redirect('transaksi/pengajuan');
        }
        $pem = $this->Peminjaman_model->get_peminjaman_by_id($id);
        if ($pem && in_array($pem['status'], ['Menunggu Persetujuan', 'Disetujui'])) {
            $data = [
                'status' => $status,
                'petugas_id_acc' => $this->session->userdata('id')
            ];

            if ($status == 'Dipinjam') {
                $data['tanggal_pinjam'] = date('Y-m-d H:i:s');
            } elseif ($status == 'Ditolak') {
                // Kembalikan stok alat
                $detail = $this->Peminjaman_model->get_detail_peminjaman_by_peminjaman_id($id);
                $alat = $this->Alat_model->get_alat_by_id($detail['alat_id']);
                $this->Alat_model->update_alat($alat['id'], ['stok' => $alat['stok'] + $detail['jumlah']]);
            }

            $this->Peminjaman_model->update_peminjaman($id, $data);
            $this->session->set_flashdata('success', 'Status pengajuan berhasil diubah menjadi ' . $status);
        }
        redirect('transaksi/pengajuan');
    }

    public function pengembalian() {
        $data['title'] = 'Data Pengembalian Alat';
        
        $data['peminjaman'] = $this->Peminjaman_model->get_peminjaman_for_pengembalian();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('transaksi/pengembalian', $data);
        $this->load->view('layout/footer');
    }

    public function proses_kembali() {
        if ($this->session->userdata('role') == 'Admin') {
            $this->session->set_flashdata('error', 'Akses ditolak: Administrator tidak dapat memproses transaksi!');
            redirect('transaksi/pengembalian');
        }
        $peminjaman_id = $this->input->post('peminjaman_id');
        $alat_id = $this->input->post('alat_id');
        $jumlah = $this->input->post('jumlah');
        $kondisi = $this->input->post('kondisi_alat_kembali');
        $catatan = htmlspecialchars($this->input->post('catatan', true));
        $denda = $this->input->post('nominal_denda');

        $this->db->trans_start();

        // Update status peminjaman
        $this->Peminjaman_model->update_peminjaman($peminjaman_id, ['status' => 'Selesai']);

        // Insert tabel pengembalian
        $data_pengembalian = [
            'peminjaman_id' => $peminjaman_id,
            'petugas_id_kembali' => $this->session->userdata('id'),
            'kondisi_alat_kembali' => $kondisi,
            'catatan' => $catatan
        ];
        $pengembalian_id = $this->Peminjaman_model->insert_pengembalian($data_pengembalian);

        // Kembalikan stok
        if ($kondisi != 'Hilang') {
            $alat = $this->Alat_model->get_alat_by_id($alat_id);
            // Jika kondisi rusak, mungkin status alat diubah atau stok tetap dikembalikan. 
            // Kita kembalikan stoknya, tapi admin bisa ubah kondisinya nanti jika rusak berat dsb.
            $this->Alat_model->update_alat($alat_id, ['stok' => $alat['stok'] + $jumlah]);
        }

        // Insert Denda jika ada
        if ($kondisi != 'Baik' && $denda > 0) {
            $nomor_denda = 'DN-' . date('Ymd') . '-' . rand(100, 999);
            $data_denda = [
                'nomor_denda' => $nomor_denda,
                'pengembalian_id' => $pengembalian_id,
                'jenis_kerusakan' => $kondisi,
                'nominal_denda' => $denda,
                'keterangan' => 'Denda atas kondisi alat: ' . $kondisi,
                'status_pembayaran' => 'Belum Dibayar'
            ];
            $this->Denda_model->insert_denda($data_denda);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('error', 'Gagal memproses pengembalian!');
        } else {
            $this->session->set_flashdata('success', 'Alat berhasil dikembalikan.');
        }

        redirect('transaksi/pengembalian');
    }
}
