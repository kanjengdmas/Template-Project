<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') !== 'pasien') {
            $this->session->set_flashdata('error', 'Akses ditolak!');
            redirect('auth/login');
        }
        $this->load->model('User_model');
        $this->load->model('Pemeriksaan_model');
        $this->load->model('Dokter_model');
    }

    public function index() {
        $data['title'] = 'Dashboard Pasien';
        $pasien_id = $this->session->userdata('id');
        
        $pemeriksaan = $this->Pemeriksaan_model->get_by_pasien_id($pasien_id);
        
        $data['total_pemeriksaan'] = count($pemeriksaan);
        $data['pemeriksaan_selesai'] = 0;
        $data['pemeriksaan_menunggu'] = 0;
        
        foreach ($pemeriksaan as $p) {
            if ($p->status == 'Selesai') $data['pemeriksaan_selesai']++;
            if ($p->status == 'Menunggu') $data['pemeriksaan_menunggu']++;
        }

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('pasien/dashboard', $data);
        $this->load->view('layout/footer');
    }

    public function pemeriksaan() {
        $data['title'] = 'Buat Pemeriksaan Baru';
        $data['dokters'] = $this->Dokter_model->get_all();

        $this->form_validation->set_rules('dokter_id', 'Dokter Tujuan', 'required');
        $this->form_validation->set_rules('umur', 'Umur', 'required|numeric');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_telp', 'No Telepon', 'required');
        $this->form_validation->set_rules('keluhan', 'Keluhan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('layout/sidebar');
            $this->load->view('layout/topbar');
            $this->load->view('pasien/pemeriksaan', $data);
            $this->load->view('layout/footer');
        } else {
            $insert_data = [
                'pasien_id' => $this->session->userdata('id'),
                'dokter_id' => $this->input->post('dokter_id'),
                'umur' => $this->input->post('umur'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('no_telp'),
                'berat_badan' => $this->input->post('berat_badan'),
                'tinggi_badan' => $this->input->post('tinggi_badan'),
                'tekanan_darah' => $this->input->post('tekanan_darah'),
                'gula_darah' => $this->input->post('gula_darah'),
                'riwayat_penyakit' => $this->input->post('riwayat_penyakit'),
                'riwayat_alergi' => $this->input->post('riwayat_alergi'),
                'keluhan' => $this->input->post('keluhan'),
                'tanggal' => date('Y-m-d'),
                'status' => 'Menunggu'
            ];

            $this->Pemeriksaan_model->insert($insert_data);
            $this->session->set_flashdata('success', 'Permintaan pemeriksaan berhasil dikirim! Menunggu konfirmasi petugas.');
            redirect('pasien/riwayat');
        }
    }

    public function riwayat() {
        $data['title'] = 'Riwayat Pemeriksaan';
        $pasien_id = $this->session->userdata('id');
        $data['riwayat'] = $this->Pemeriksaan_model->get_by_pasien_id($pasien_id);
        
        // Get resep for each pemeriksaan
        foreach ($data['riwayat'] as $r) {
            $r->resep = $this->Pemeriksaan_model->get_resep_by_pemeriksaan($r->id);
        }

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('pasien/riwayat', $data);
        $this->load->view('layout/footer');
    }

    public function hapus_riwayat($id) {
        // Cek apakah data pemeriksaan ini milik pasien yang sedang login
        $pemeriksaan = $this->Pemeriksaan_model->get_by_id($id);
        if ($pemeriksaan && $pemeriksaan->pasien_id == $this->session->userdata('id')) {
            // Hapus resep terkait terlebih dahulu
            $this->Pemeriksaan_model->delete_resep_by_pemeriksaan($id);
            // Hapus data pemeriksaan
            $this->Pemeriksaan_model->delete($id);
            $this->session->set_flashdata('success', 'Riwayat pemeriksaan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Akses ditolak atau data tidak ditemukan.');
        }
        redirect('pasien/riwayat');
    }
}
