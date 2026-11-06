<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth');
        }
        $this->load->model('Admin_model');
    }

    public function index() {
        $data['role'] = $this->session->userdata('role');
        $data['dashboard_url'] = base_url($data['role'] . '/dashboard');
        $data['layanan'] = $this->Admin_model->get_all('services');
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/layanan', $data);
        $this->load->view('admin/templates/footer');
    }

    public function add() {
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'icon' => $this->input->post('icon')
        );
        $this->Admin_model->insert('services', $data);
        $this->Admin_model->log_activity('Menambahkan layanan baru: ' . $data['title']);
        $this->session->set_flashdata('success', 'Layanan berhasil ditambahkan!');
        redirect('admin/layanan');
    }

    public function edit() {
        $id = $this->input->post('id');
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'icon' => $this->input->post('icon')
        );
        $this->Admin_model->update('services', $id, $data);
        $this->Admin_model->log_activity('Mengubah data layanan: ' . $data['title']);
        $this->session->set_flashdata('success', 'Layanan berhasil diupdate!');
        redirect('admin/layanan');
    }

    public function delete($id) {
        $layanan = $this->Admin_model->get_by_id('services', $id);
        $this->Admin_model->delete('services', $id);
        $this->Admin_model->log_activity('Menghapus layanan: ' . ($layanan['title'] ?? 'ID ' . $id));
        $this->session->set_flashdata('success', 'Layanan berhasil dihapus!');
        redirect('admin/layanan');
    }
}
