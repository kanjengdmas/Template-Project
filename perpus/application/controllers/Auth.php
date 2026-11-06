<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_User');
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            if ($this->session->userdata('role') == 'admin') {
                redirect('admin');
            } else {
                redirect('anggota');
            }
        }
        
        $data = [];
        $lockout_time = $this->session->userdata('lockout_time');
        if ($lockout_time) {
            $remaining = $lockout_time - time();
            if ($remaining > 0) {
                $data['lockout_remaining'] = $remaining;
            } else {
                $this->session->unset_userdata('lockout_time');
                $this->session->set_userdata('login_attempts', 0);
            }
        }
        
        $this->load->view('auth/login', $data);
    }

    public function process() {
        // Cek apakah sedang dalam masa lockout
        $lockout_time = $this->session->userdata('lockout_time');
        if ($lockout_time) {
            $remaining = $lockout_time - time();
            if ($remaining > 0) {
                echo json_encode(['status' => 'lockout', 'remaining' => $remaining]);
                return;
            } else {
                $this->session->unset_userdata('lockout_time');
                $this->session->set_userdata('login_attempts', 0);
            }
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->M_User->login($username);

        if ($user && password_verify($password, $user->password)) {
            // Reset attempt jika login berhasil
            $this->session->unset_userdata('login_attempts');
            $this->session->unset_userdata('lockout_time');

            $session_data = array(
                'id_user'   => $user->id_user,
                'username'  => $user->username,
                'nama'      => $user->nama,
                'role'      => $user->role,
                'foto'      => $user->foto,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);

            echo json_encode(['status' => 'success', 'role' => $user->role]);
        } else {
            // Tambah hitungan percobaan login gagal
            $attempts = $this->session->userdata('login_attempts') ? $this->session->userdata('login_attempts') : 0;
            $attempts++;
            
            if ($attempts >= 3) {
                $lockout_time = time() + 15; // Kunci 15 detik
                $this->session->set_userdata('lockout_time', $lockout_time);
                $this->session->set_userdata('login_attempts', $attempts);
                echo json_encode([
                    'status' => 'lockout', 
                    'remaining' => 15,
                    'message' => 'Anda telah salah memasukkan password atau username sebanyak 3 kali. Akun dikunci selama 15 detik!'
                ]);
            } else {
                $this->session->set_userdata('login_attempts', $attempts);
                $sisa = 3 - $attempts;
                echo json_encode([
                    'status' => 'error', 
                    'message' => "Username atau Password salah! Sisa percobaan: $sisa kali lagi."
                ]);
            }
        }
    }

    public function register() {
        if ($this->session->userdata('logged_in')) {
            if ($this->session->userdata('role') == 'admin') {
                redirect('admin');
            } else {
                redirect('anggota');
            }
        }
        $this->load->view('auth/register');
    }

    public function process_register() {
        $username = $this->input->post('username', TRUE);
        
        // Cek username apakah sudah ada
        $this->db->where('username', $username);
        $cek = $this->db->get('users')->num_rows();

        if ($cek > 0) {
            echo json_encode(['status' => 'error', 'message' => 'Username sudah digunakan!']);
            return;
        }

        $email = $this->input->post('email', TRUE);
        // Cek email apakah sudah ada
        $this->db->where('email', $email);
        $cek_email = $this->db->get('users')->num_rows();

        if ($cek_email > 0) {
            echo json_encode(['status' => 'error', 'message' => 'Email sudah digunakan!']);
            return;
        }

        $data = [
            'nama' => $this->input->post('nama', TRUE),
            'username' => $username,
            'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
            'email' => $this->input->post('email', TRUE),
            'telepon' => $this->input->post('telepon', TRUE),
            'alamat' => $this->input->post('alamat', TRUE),
            'role' => 'anggota'
        ];

        if ($this->M_User->insert_anggota($data)) {
            echo json_encode(['status' => 'success', 'message' => 'Registrasi berhasil! Silakan login.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan sistem saat registrasi.']);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
