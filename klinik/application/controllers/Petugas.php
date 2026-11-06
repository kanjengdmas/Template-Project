<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') !== 'petugas') {
            $this->session->set_flashdata('error', 'Akses ditolak!');
            redirect('auth/login');
        }
        $this->load->model('User_model');
        $this->load->model('Pemeriksaan_model');
    }

    public function index() {
        $data['title'] = 'Dashboard Petugas';
        
        $data['pemeriksaan_baru'] = $this->Pemeriksaan_model->count_by_status('Menunggu');
        $data['diproses_dokter'] = $this->Pemeriksaan_model->count_by_status('Diproses');
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('petugas/dashboard', $data);
        $this->load->view('layout/footer');
    }

    public function pemeriksaan() {
        $data['title'] = 'Data Semua Pemeriksaan';
        $data['pemeriksaan'] = $this->Pemeriksaan_model->get_all();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('petugas/pemeriksaan', $data);
        $this->load->view('layout/footer');
    }

    public function konfirmasi() {
        $data['title'] = 'Konfirmasi Pemeriksaan';
        $data['pemeriksaan'] = $this->Pemeriksaan_model->get_by_status('Menunggu');

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('petugas/konfirmasi', $data);
        $this->load->view('layout/footer');
    }

    public function ubah_status($id) {
        $status = $this->input->post('status');
        $data = ['status' => $status];
        
        $this->Pemeriksaan_model->update($id, $data);
        $this->session->set_flashdata('success', 'Status pemeriksaan berhasil diubah menjadi ' . $status);
        
        if ($this->input->post('redirect') == 'konfirmasi') {
            redirect('petugas/konfirmasi');
        } else {
            redirect('petugas/pemeriksaan');
        }
    }
}
