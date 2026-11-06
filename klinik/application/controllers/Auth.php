<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function login() {
        if ($this->session->userdata('role')) {
            redirect($this->session->userdata('role'));
        }

        $lockout_time = $this->session->userdata('lockout_time');
        $attempts = $this->session->userdata('login_attempts') ?: 0;
        $current_time = time();
        $lockout_duration = 15; // 15 seconds

        $remaining_lockout = 0;
        if ($lockout_time) {
            if ($current_time - $lockout_time < $lockout_duration) {
                $remaining_lockout = $lockout_duration - ($current_time - $lockout_time);
            } else {
                // Lockout has expired, reset attempts
                $this->session->unset_userdata('lockout_time');
                $this->session->unset_userdata('login_attempts');
                $attempts = 0;
            }
        }

        $this->form_validation->set_rules('login', 'Username atau Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['remaining_lockout'] = $remaining_lockout;
            $this->load->view('auth/login', $data);
        } else {
            // Check if still locked out
            if ($remaining_lockout > 0) {
                $this->session->set_flashdata('error', 'Form login sedang dikunci! Tunggu ' . $remaining_lockout . ' detik.');
                redirect('auth/login');
            }

            $login = $this->input->post('login');
            $password = $this->input->post('password');

            $user = $this->User_model->get_by_email_or_username($login);

            if ($user && password_verify($password, $user->password)) {
                // Reset attempts on success
                $this->session->unset_userdata('login_attempts');
                $this->session->unset_userdata('lockout_time');

                $data = [
                    'id' => $user->id,
                    'email' => $user->email,
                    'role' => $user->role,
                    'nama' => $user->nama,
                    'foto' => $user->foto
                ];
                $this->session->set_userdata($data);
                
                $this->session->set_flashdata('success', 'Selamat datang ' . $user->nama);
                redirect($user->role);
            } else {
                // Increment attempts on failure
                $attempts++;
                $this->session->set_userdata('login_attempts', $attempts);

                if ($attempts >= 3) {
                    $this->session->set_userdata('lockout_time', time());
                    $this->session->set_flashdata('error', 'Terlalu banyak percobaan salah! Form login dikunci selama 15 detik.');
                } else {
                    $this->session->set_flashdata('error', 'Username/Email atau Password salah! (Sisa percobaan: ' . (3 - $attempts) . ')');
                }
                redirect('auth/login');
            }
        }
    }

    public function register() {
        if ($this->session->userdata('role')) {
            redirect($this->session->userdata('role'));
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]', [
            'is_unique' => 'Username ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]', [
            'min_length' => 'Password minimal 6 karakter!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => 'pasien' // Default role for public registration
            ];

            $this->User_model->insert($data);
            $this->session->set_flashdata('success', 'Akun berhasil dibuat! Silakan login.');
            redirect('auth/login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('foto');

        $this->session->set_flashdata('success', 'Anda telah berhasil logout!');
        redirect('auth/login');
    }
}
