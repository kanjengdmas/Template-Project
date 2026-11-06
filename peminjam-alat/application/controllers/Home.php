<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function index() {
        $data['title'] = 'Sipanja - Sistem Peminjaman Alat';
        
        // Dapatkan data alat untuk landing page
        $data['alat'] = $this->Alat_model->get_all_alat();

        // Dapatkan statistik
        $data['total_alat'] = $this->Alat_model->count_all();
        $data['total_peminjam'] = $this->User_model->count_by_role('Peminjam');
        $data['total_transaksi'] = $this->Peminjaman_model->count_all_peminjaman();

        // Dapatkan alat populer
        $data['alat_populer'] = $this->Alat_model->get_popular_alat(3);

        $this->load->view('landing/index', $data);
    }
}
