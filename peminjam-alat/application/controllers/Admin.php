<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 'Admin') {
            redirect('dashboard');
        }
    }

    public function pengaturan() {
        $data['title'] = 'Pengaturan Akun';
        $user_id = $this->session->userdata('id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('admin/pengaturan', $data);
        $this->load->view('layout/footer');
    }

    public function update_pengaturan() {
        $user_id = $this->session->userdata('id');

        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
        ];

        // Jika password diisi, maka update password
        if (!empty($this->input->post('password'))) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        // Proses upload foto profil
        if (!empty($_FILES['foto_profile']['name'])) {
            $upload_path = './assets/uploads/profile/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048; // 2MB
            $config['file_name']     = 'profile_' . $user_id . '_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_profile')) {
                // Hapus foto lama jika ada dan bukan default
                $old_user = $this->User_model->get_user_by_id($user_id);
                if ($old_user['foto_profile'] && $old_user['foto_profile'] !== 'default_user.png') {
                    @unlink($upload_path . $old_user['foto_profile']);
                }

                $upload_data = $this->upload->data();
                $data['foto_profile'] = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Gagal upload foto: ' . $this->upload->display_errors('', ''));
                redirect('admin/pengaturan');
            }
        }

        $this->User_model->update_user($user_id, $data);
        $this->session->set_flashdata('success', 'Pengaturan akun berhasil diperbarui!');
        
        $this->session->set_userdata('nama', $data['nama']);
        
        redirect('admin/pengaturan');
    }
}
