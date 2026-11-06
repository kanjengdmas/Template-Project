<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index() {
        if ($this->session->userdata('user_id')) {
            $this->redirect_by_role($this->session->userdata('role'));
        }
        $this->load->view('auth/login');
    }

    public function login() {
        $identity = $this->input->post('identity');
        $password = $this->input->post('password');

        // Check if currently locked out
        $lockout_time = $this->session->userdata('lockout_time');
        if ($lockout_time && time() < $lockout_time) {
            $remaining = $lockout_time - time();
            $this->session->set_flashdata('error', "Terlalu banyak percobaan. Coba lagi dalam $remaining detik.");
            redirect('auth');
            return;
        }
        // Validate Gmail if identity is an email
        if (filter_var($identity, FILTER_VALIDATE_EMAIL)) {
            if (!preg_match('/@gmail\.com$/', $identity)) {
                $this->session->set_flashdata('error', 'Hanya alamat email @gmail.com yang diperbolehkan!');
                redirect('auth');
                return;
            }
        }

        $user = $this->Auth_model->check_login($identity, $password);

        if ($user) {
            // Reset attempts on success
            $this->session->unset_userdata('login_attempts');
            $this->session->unset_userdata('lockout_time');

            $session_data = array(
                'user_id' => $user['id'],
                'username' => $user['username'],
                'fullname' => $user['fullname'],
                'role' => $user['role'],
                'user_image' => $user['image']
            );
            $this->session->set_userdata($session_data);
            $this->redirect_by_role($user['role']);
        } else {
            // Increment attempts
            $attempts = $this->session->userdata('login_attempts') ?: 0;
            $attempts++;
            $this->session->set_userdata('login_attempts', $attempts);

            if ($attempts >= 3) {
                $this->session->set_userdata('lockout_time', time() + 15);
                $this->session->set_flashdata('error', 'Terlalu banyak percobaan salah. Akun dikunci selama 15 detik.');
            } else {
                $this->session->set_flashdata('error', 'Username/Email atau Password salah! Percobaan: ' . $attempts . '/3');
            }
            redirect('auth');
        }
    }

    public function register() {
        if ($this->session->userdata('user_id')) {
            redirect('landing');
        }
        $this->load->view('auth/register');
    }

    public function process_register() {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');
        $fullname = $this->input->post('fullname');

        if ($password !== $confirm_password) {
            $this->session->set_flashdata('error', 'Konfirmasi password tidak cocok!');
            redirect('auth/register');
            return;
        }

        // Validate Gmail
        if (!preg_match('/@gmail\.com$/', $email)) {
            $this->session->set_flashdata('error', 'Registrasi wajib menggunakan alamat @gmail.com!');
            redirect('auth/register');
            return;
        }

        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'fullname' => $fullname,
            'role' => 'customer'
        );

        if ($this->Auth_model->register_user($data)) {
            $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
            redirect('auth');
        } else {
            $this->session->set_flashdata('error', 'Registrasi gagal! Username atau Email mungkin sudah terdaftar.');
            redirect('auth/register');
        }
    }

    private function redirect_by_role($role) {
        if ($role === 'admin') {
            redirect('admin/dashboard');
        } elseif ($role === 'kasir') {
            redirect('kasir/dashboard');
        } else {
            redirect('landing');
        }
    }

    public function logout() {
        $role = $this->session->userdata('role');
        $this->session->sess_destroy();
        
        if ($role === 'admin' || $role === 'kasir') {
            redirect('auth');
        } else {
            redirect('landing');
        }
    }
}
