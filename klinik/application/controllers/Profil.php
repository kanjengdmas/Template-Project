<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cek apakah user sudah login
        if (!$this->session->userdata('id')) {
            redirect('auth/login');
        }
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->User_model->get_by_id($this->session->userdata('id'));

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar', $data);
        $this->load->view('profil/index', $data);
        $this->load->view('layout/footer');
    }

    public function update() {
        $user_id = $this->session->userdata('id');
        $user = $this->User_model->get_by_id($user_id);

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        
        // Cek jika password diisi
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]');
            $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'trim|matches[password]');
        }

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');

            // Cek email duplikat selain milik sendiri
            $existing_user = $this->User_model->get_by_email($email);
            if ($existing_user && $existing_user->id != $user_id) {
                $this->session->set_flashdata('error', 'Email sudah digunakan oleh akun lain!');
                redirect('profil');
                return;
            }

            // Data untuk diupdate
            $update_data = [
                'nama' => $nama,
                'email' => $email
            ];

            // Update password jika ada
            if ($this->input->post('password')) {
                $update_data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            // Handle upload foto
            $upload_image = $_FILES['foto']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']      = '2048'; // 2MB
                $config['upload_path']   = './assets/img/profile/';
                $config['file_name']     = 'user_' . $user_id . '_' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {
                    // Hapus foto lama jika bukan default
                    $old_image = $user->foto;
                    if ($old_image != 'default.jpg' && file_exists(FCPATH . 'assets/img/profile/' . $old_image)) {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $update_data['foto'] = $new_image;
                    
                    // Update session foto
                    $this->session->set_userdata('foto', $new_image);
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('profil');
                    return;
                }
            }

            // Update database
            $this->User_model->update($user_id, $update_data);
            
            // Update session nama
            $this->session->set_userdata('nama', $nama);

            $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
            redirect('profil');
        }
    }
}
