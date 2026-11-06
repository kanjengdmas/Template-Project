<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tim extends CI_Controller {

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
        $data['team'] = $this->Admin_model->get_all('team');
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/tim', $data);
        $this->load->view('admin/templates/footer');
    }

    public function add() {
        $data = array(
            'name' => $this->input->post('name'),
            'position' => $this->input->post('position')
        );

        $config['upload_path']   = './assets/img/';
        $config['allowed_types'] = 'gif|jpg|png|webp|jpeg';
        $config['encrypt_name']  = TRUE;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('photo')) {
            $data['photo'] = $this->upload->data('file_name');
        } else {
            $data['photo'] = 'default.png'; 
        }

        $this->Admin_model->insert('team', $data);
        $this->Admin_model->log_activity('Menambahkan anggota tim baru: ' . $data['name']);
        $this->session->set_flashdata('success', 'Anggota tim berhasil ditambahkan!');
        redirect('admin/tim');
    }

    public function edit() {
        $id = $this->input->post('id');
        $data = array(
            'name' => $this->input->post('name'),
            'position' => $this->input->post('position')
        );

        $config['upload_path']   = './assets/img/';
        $config['allowed_types'] = 'gif|jpg|png|webp|jpeg';
        $config['encrypt_name']  = TRUE;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('photo')) {
            $data['photo'] = $this->upload->data('file_name');
        }

        $this->Admin_model->update('team', $id, $data);
        $this->Admin_model->log_activity('Mengubah data anggota tim: ' . $data['name']);
        $this->session->set_flashdata('success', 'Anggota tim berhasil diupdate!');
        redirect('admin/tim');
    }

    public function delete($id) {
        $member = $this->Admin_model->get_by_id('team', $id);
        $this->Admin_model->delete('team', $id);
        $this->Admin_model->log_activity('Menghapus anggota tim: ' . ($member['name'] ?? 'ID ' . $id));
        $this->session->set_flashdata('success', 'Anggota tim berhasil dihapus!');
        redirect('admin/tim');
    }
}
