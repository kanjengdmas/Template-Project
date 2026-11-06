<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 'Admin') {
            redirect('dashboard');
        }
    }

    public function index() {
        $data['title'] = 'Data Kategori Alat';
        $data['kategori'] = $this->Kategori_model->get_all_kategori();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('kategori/index', $data);
        $this->load->view('layout/footer');
    }

    public function simpan() {
        $data = ['nama_kategori' => htmlspecialchars($this->input->post('nama_kategori', true))];
        $this->Kategori_model->insert_kategori($data);
        $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan!');
        redirect('kategori');
    }

    public function edit() {
        $id = $this->input->post('id');
        $data = ['nama_kategori' => htmlspecialchars($this->input->post('nama_kategori', true))];
        $this->Kategori_model->update_kategori($id, $data);
        $this->session->set_flashdata('success', 'Kategori berhasil diperbarui!');
        redirect('kategori');
    }

    public function hapus($id) {
        $this->Kategori_model->delete_kategori($id);
        $this->session->set_flashdata('success', 'Kategori berhasil dihapus!');
        redirect('kategori');
    }
}
