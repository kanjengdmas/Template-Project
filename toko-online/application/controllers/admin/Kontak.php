<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {

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
        $data['store'] = $this->Admin_model->get_by_id('store_info', 1);
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/store_info', $data);
        $this->load->view('admin/templates/footer');
    }

    public function update() {
        $id = 1;
        $data = array(
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'email' => $this->input->post('email'),
            'whatsapp' => $this->input->post('whatsapp'),
            'hours' => $this->input->post('hours'),
            'maps_link' => $this->input->post('maps_link')
        );
        $this->Admin_model->update('store_info', $id, $data);
        $this->Admin_model->log_activity('Memperbarui informasi kontak toko');
        $this->session->set_flashdata('success', 'Informasi Toko berhasil diupdate!');
        redirect('admin/kontak');
    }
}
