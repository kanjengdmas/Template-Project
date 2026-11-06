<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denda extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!in_array($this->session->userdata('role'), ['Admin', 'Petugas'])) {
            redirect('dashboard');
        }
    }

    public function index() {
        $data['title'] = 'Data Denda';
        
        $data['denda'] = $this->Denda_model->get_all_denda();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('denda/index', $data);
        $this->load->view('layout/footer');
    }

    public function bayar($id) {
        $this->Denda_model->update_denda($id, ['status_pembayaran' => 'Sudah Dibayar']);
        $this->session->set_flashdata('success', 'Pembayaran denda berhasil diverifikasi!');
        redirect('denda');
    }
}
