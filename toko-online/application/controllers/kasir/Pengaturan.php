<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') !== 'kasir') {
            redirect('auth');
        }
        $this->load->model('Admin_model');
    }

    public function index() {
        $data['role'] = 'kasir';
        $data['dashboard_url'] = base_url('kasir/dashboard');
        
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->Admin_model->get_by_id('users', $user_id);
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/pengaturan', $data);
        $this->load->view('admin/templates/footer');
    }

    public function edit_profile() {
        $user_id = $this->session->userdata('user_id');
        
        $data = array(
            'fullname' => $this->input->post('fullname'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address')
        );
        
        $this->Admin_model->update('users', $user_id, $data);
        
        // Update session
        $this->session->set_userdata('fullname', $data['fullname']);
        $this->session->set_userdata('username', $data['username']);
        
        $this->Admin_model->log_activity('Memperbarui profil akun');
        $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
        redirect('kasir/pengaturan');
    }

    public function upload_avatar() {
        $user_id = $this->session->userdata('user_id');
        
        $config['upload_path']   = './assets/uploads/avatars/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 2048; // 2MB
        $config['file_name']     = 'avatar_' . $user_id . '_' . time();
        
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }
        
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('avatar')) {
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            
            $old_user = $this->Admin_model->get_by_id('users', $user_id);
            if (!empty($old_user['image']) && file_exists('./assets/uploads/avatars/' . $old_user['image'])) {
                @unlink('./assets/uploads/avatars/' . $old_user['image']);
            }
            
            $this->Admin_model->update('users', $user_id, array('image' => $file_name));
            $this->session->set_userdata('user_image', $file_name);
            
            $this->Admin_model->log_activity('Mengubah foto profil');
            $this->session->set_flashdata('success', 'Foto profil berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengunggah foto: ' . $this->upload->display_errors('', ''));
        }
        
        redirect('kasir/pengaturan');
    }

    public function change_password() {
        $user_id = $this->session->userdata('user_id');
        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');
        
        $user = $this->Admin_model->get_by_id('users', $user_id);
        
        if (!password_verify($old_password, $user['password'])) {
            $this->session->set_flashdata('error', 'Password lama tidak sesuai!');
            redirect('kasir/pengaturan');
            return;
        }
        
        if (strlen($new_password) < 8) {
            $this->session->set_flashdata('error', 'Password baru minimal harus 8 karakter!');
            redirect('kasir/pengaturan');
            return;
        }
        
        if ($new_password !== $confirm_password) {
            $this->session->set_flashdata('error', 'Konfirmasi password baru tidak cocok!');
            redirect('kasir/pengaturan');
            return;
        }
        
        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $this->Admin_model->update('users', $user_id, array('password' => $hashed));
        
        $this->Admin_model->log_activity('Mengubah password akun');
        $this->session->set_flashdata('success', 'Password berhasil diubah!');
        redirect('kasir/pengaturan');
    }
}
