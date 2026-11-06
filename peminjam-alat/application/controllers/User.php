<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 'Admin') {
            redirect('dashboard');
        }
    }

    public function index() {
        $data['title'] = 'Manajemen User';
        $data['users'] = $this->User_model->get_all_users();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('layout/footer');
    }

    public function simpan() {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'username' => htmlspecialchars($this->input->post('username', true)),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role' => $this->input->post('role'),
            'nim_nik' => htmlspecialchars($this->input->post('nim_nik', true)),
            'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true))
        ];
        
        $cek_username = $this->User_model->get_user_by_username_or_email($data['username']);
        if ($cek_username) {
            $this->session->set_flashdata('error', 'Username sudah digunakan!');
        } else {
            $this->User_model->insert_user($data);
            $this->session->set_flashdata('success', 'User berhasil ditambahkan!');
        }
        redirect('user');
    }

    public function edit() {
        $id = $this->input->post('id');
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'role' => $this->input->post('role'),
            'nim_nik' => htmlspecialchars($this->input->post('nim_nik', true)),
            'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true))
        ];

        // Ganti password jika diisi
        $password = $this->input->post('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->User_model->update_user($id, $data);
        $this->session->set_flashdata('success', 'Data user berhasil diperbarui!');
        redirect('user');
    }

    public function hapus($id) {
        $this->User_model->delete_user($id);
        $this->session->set_flashdata('success', 'User berhasil dihapus!');
        redirect('user');
    }
}
