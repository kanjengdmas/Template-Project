<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'Akses ditolak!');
            redirect('auth/login');
        }
        $this->load->model('User_model');
        $this->load->model('Dokter_model');
        $this->load->model('Obat_model');
        $this->load->model('Pemeriksaan_model');
    }

    public function index() {
        $data['title'] = 'Dashboard Admin';
        $data['total_user'] = $this->User_model->count_users();
        $data['total_dokter'] = $this->Dokter_model->count_dokter();
        $data['total_obat'] = $this->Obat_model->count_obat();
        $data['total_pemeriksaan'] = $this->Pemeriksaan_model->count_pemeriksaan();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('layout/footer');
    }

    // CRUD User
    public function user() {
        $data['title'] = 'Data User';
        $data['users'] = $this->User_model->get_all_except_dokter();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('admin/user', $data);
        $this->load->view('layout/footer');
    }

    public function user_add() {
        $data = [
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role' => $this->input->post('role')
        ];
        $this->User_model->insert($data);
        $this->session->set_flashdata('success', 'User berhasil ditambahkan!');
        redirect('admin/user');
    }

    public function user_edit() {
        $id = $this->input->post('id');
        $data = [
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'role' => $this->input->post('role')
        ];
        if ($this->input->post('password')) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }
        $this->User_model->update($id, $data);
        $this->session->set_flashdata('success', 'User berhasil diupdate!');
        redirect('admin/user');
    }

    public function user_delete($id) {
        $this->User_model->delete($id);
        $this->session->set_flashdata('success', 'User berhasil dihapus!');
        redirect('admin/user');
    }

    // CRUD Dokter
    public function dokter() {
        $data['title'] = 'Data Dokter';
        $data['dokter'] = $this->Dokter_model->get_all();
        $data['users_dokter'] = $this->User_model->get_by_role('dokter');

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('admin/dokter', $data);
        $this->load->view('layout/footer');
    }

    public function dokter_add() {
        // Insert into users table first
        $user_data = [
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role' => 'dokter'
        ];
        $user_id = $this->User_model->insert($user_data);

        $dokter_data = [
            'user_id' => $user_id,
            'spesialis' => $this->input->post('spesialis'),
            'no_telp' => $this->input->post('no_telp'),
            'alamat' => $this->input->post('alamat')
        ];
        $this->Dokter_model->insert($dokter_data);
        $this->session->set_flashdata('success', 'Dokter beserta Akun berhasil ditambahkan!');
        redirect('admin/dokter');
    }

    public function dokter_edit() {
        $id = $this->input->post('id');
        $user_id = $this->input->post('user_id');

        $user_data = [
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email')
        ];
        if ($this->input->post('password')) {
            $user_data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }
        $this->User_model->update($user_id, $user_data);

        $dokter_data = [
            'spesialis' => $this->input->post('spesialis'),
            'no_telp' => $this->input->post('no_telp'),
            'alamat' => $this->input->post('alamat')
        ];
        $this->Dokter_model->update($id, $dokter_data);
        $this->session->set_flashdata('success', 'Data Dokter berhasil diupdate!');
        redirect('admin/dokter');
    }

    public function dokter_delete($id) {
        $dokter = $this->Dokter_model->get_by_id($id);
        if ($dokter) {
            $this->User_model->delete($dokter->user_id); // Deleting user will cascade to dokter table
        }
        $this->session->set_flashdata('success', 'Dokter beserta akunnya berhasil dihapus!');
        redirect('admin/dokter');
    }

    // CRUD Obat
    public function obat() {
        $data['title'] = 'Data Obat';
        $data['obat'] = $this->Obat_model->get_all();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('admin/obat', $data);
        $this->load->view('layout/footer');
    }

    public function obat_add() {
        $data = [
            'nama_obat' => $this->input->post('nama_obat'),
            'jenis_obat' => $this->input->post('jenis_obat'),
            'stok' => $this->input->post('stok'),
            'deskripsi_obat' => $this->input->post('deskripsi_obat')
        ];
        $this->Obat_model->insert($data);
        $this->session->set_flashdata('success', 'Obat berhasil ditambahkan!');
        redirect('admin/obat');
    }

    public function obat_edit() {
        $id = $this->input->post('id');
        $data = [
            'nama_obat' => $this->input->post('nama_obat'),
            'jenis_obat' => $this->input->post('jenis_obat'),
            'stok' => $this->input->post('stok'),
            'deskripsi_obat' => $this->input->post('deskripsi_obat')
        ];
        $this->Obat_model->update($id, $data);
        $this->session->set_flashdata('success', 'Obat berhasil diupdate!');
        redirect('admin/obat');
    }

    public function obat_delete($id) {
        $this->Obat_model->delete($id);
        $this->session->set_flashdata('success', 'Obat berhasil dihapus!');
        redirect('admin/obat');
    }

    // Laporan
    public function laporan() {
        $data['title'] = 'Laporan Pemeriksaan';
        $data['pemeriksaan'] = $this->Pemeriksaan_model->get_all();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('admin/laporan', $data);
        $this->load->view('layout/footer');
    }

    public function laporan_print() {
        $data['title'] = 'Cetak Laporan Pemeriksaan';
        $data['pemeriksaan'] = $this->Pemeriksaan_model->get_all();

        $this->load->view('admin/laporan_print', $data);
    }
}
