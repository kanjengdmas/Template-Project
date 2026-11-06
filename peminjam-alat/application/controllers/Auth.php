<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {
        if ($this->session->userdata('id')) {
            redirect('dashboard');
        }
        $data['title'] = 'Login Sipanja';
        $this->load->view('auth/login', $data);
    }

    public function process_login() {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        // Cari user berdasarkan username ATAU email
        $user = $this->User_model->get_user_by_username_or_email($username);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'nama' => $user['nama'],
                    'role' => $user['role']
                ];
                $this->session->set_userdata($data);
                $this->session->set_flashdata('success', 'Selamat datang ' . $user['nama']);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Password salah!');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('error', 'Username atau Email tidak ditemukan!');
            redirect('auth');
        }
    }

    public function register() {
        if ($this->session->userdata('id')) {
            redirect('dashboard');
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email sudah terdaftar!',
            'valid_email' => 'Format email tidak valid!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]', [
            'is_unique' => 'Username sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]', [
            'min_length' => 'Password minimal 5 karakter!'
        ]);
        $this->form_validation->set_rules('nim_nik', 'NIM/NIK', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Register Sipanja';
            $this->load->view('auth/register', $data);
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => 'Peminjam',
                'nim_nik' => htmlspecialchars($this->input->post('nim_nik', true)),
                'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true))
            ];

            $this->User_model->insert_user($data);
            $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
            redirect('auth');
        }
    }

    public function check_username() {
        $username = $this->input->post('username', true);
        if (!$username) {
            echo json_encode(['status' => 'empty', 'message' => 'Username tidak boleh kosong']);
            return;
        }

        $user = $this->db->get_where('users', ['username' => $username])->row_array();
        if ($user) {
            echo json_encode(['status' => 'taken', 'message' => 'Username sudah digunakan']);
        } else {
            echo json_encode(['status' => 'available', 'message' => 'Username tersedia']);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }

    public function profil() {
        if (!$this->session->userdata('id')) {
            redirect('auth');
        }
        $role = $this->session->userdata('role');
        if ($role == 'Peminjam') {
            redirect('peminjam/profil');
        } elseif ($role == 'Admin') {
            redirect('admin/pengaturan');
        } elseif ($role == 'Petugas') {
            redirect('petugas/profil');
        }
    }
}
