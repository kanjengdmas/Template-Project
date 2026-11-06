<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tentang extends CI_Controller {

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
        $this->load->view('admin/tentang', $data);
        $this->load->view('admin/templates/footer');
    }

    public function update() {
        $id = 1;
        $data = array(
            'about_title' => $this->input->post('about_title'),
            'about_subtitle' => $this->input->post('about_subtitle'),
            'about_content' => $this->input->post('about_content')
        );

        $config['upload_path']   = './assets/img/';
        $config['allowed_types'] = 'gif|jpg|png|webp|jpeg';
        $config['encrypt_name']  = TRUE;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('about_image')) {
            $data['about_image'] = $this->upload->data('file_name');
        }

        $this->Admin_model->update('store_info', $id, $data);
        $this->Admin_model->log_activity('Memperbarui informasi Tentang Kami');
        $this->session->set_flashdata('success', 'Informasi Tentang Kami berhasil diupdate!');
        redirect('admin/tentang');
    }
}
