<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!in_array($this->session->userdata('role'), ['Admin', 'Petugas'])) {
            redirect('dashboard');
        }
    }

    public function index() {
        $data['title'] = 'Laporan Sistem Peminjaman Alat';

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('layout/footer');
    }

    public function cetak() {
        $jenis = $this->input->post('jenis_laporan');
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $format = $this->input->post('format'); // print atau excel

        $data['title'] = 'Laporan ' . ucfirst($jenis);
        $data['tgl_awal'] = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;

        if ($jenis == 'peminjaman' || $jenis == 'pengembalian') {
            $status = ($jenis == 'pengembalian') ? 'Selesai' : null;
            $data['laporan'] = $this->Peminjaman_model->get_laporan_peminjaman($tgl_awal, $tgl_akhir, $status);
            $view = 'laporan/cetak_transaksi';
            
        } elseif ($jenis == 'denda') {
            $data['laporan'] = $this->Denda_model->get_laporan_denda($tgl_awal, $tgl_akhir);
            $view = 'laporan/cetak_denda';
            
        } elseif ($jenis == 'alat') {
            $data['laporan'] = $this->Alat_model->get_all_alat();
            $view = 'laporan/cetak_alat';
        }

        if ($format == 'excel') {
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan_".$jenis.".xls");
        }

        $this->load->view($view, $data);
    }
}
