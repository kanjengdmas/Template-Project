<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
        
        // Fetch only Admin and Kasir
        $this->db->where_in('role', ['admin', 'kasir']);
        $data['users'] = $this->db->get('users')->result_array();
        
        $data['title'] = 'Manajemen Staff (Admin & Kasir)';
        $data['page_type'] = 'staff';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/users', $data);
        $this->load->view('admin/templates/footer');
    }

    public function customers() {
        $data['role'] = $this->session->userdata('role');
        $data['dashboard_url'] = base_url($data['role'] . '/dashboard');
        
        // Fetch only Customers
        $this->db->where('role', 'customer');
        $data['users'] = $this->db->get('users')->result_array();
        
        $data['title'] = 'Manajemen Customer Terdaftar';
        $data['page_type'] = 'customer';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/users', $data);
        $this->load->view('admin/templates/footer');
    }

    public function add() {
        $role = $this->input->post('role');
        $data = array(
            'username' => $this->input->post('username'),
            'fullname' => $this->input->post('fullname'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role' => $role
        );
        $this->Admin_model->insert('users', $data);
        $this->Admin_model->log_activity('Menambahkan user baru: ' . $data['username']);
        $this->session->set_flashdata('success', 'User berhasil ditambahkan!');
        
        if ($role === 'customer') {
            redirect('admin/users/customers');
        } else {
            redirect('admin/users');
        }
    }

    public function edit() {
        $id = $this->input->post('id');
        $role = $this->input->post('role');
        $data = array(
            'username' => $this->input->post('username'),
            'fullname' => $this->input->post('fullname'),
            'role' => $role
        );
        if ($this->input->post('password')) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }
        $this->Admin_model->update('users', $id, $data);
        $this->Admin_model->log_activity('Mengubah data user: ' . $data['username']);
        $this->session->set_flashdata('success', 'User berhasil diupdate!');
        
        if ($role === 'customer') {
            redirect('admin/users/customers');
        } else {
            redirect('admin/users');
        }
    }

    public function delete($id) {
        $user = $this->Admin_model->get_by_id('users', $id);
        $role = $user['role'] ?? 'admin';
        $this->Admin_model->delete('users', $id);
        $this->Admin_model->log_activity('Menghapus user: ' . ($user['username'] ?? 'ID ' . $id));
        $this->session->set_flashdata('success', 'User berhasil dihapus!');
        
        if ($role === 'customer') {
            redirect('admin/users/customers');
        } else {
            redirect('admin/users');
        }
    }
}
