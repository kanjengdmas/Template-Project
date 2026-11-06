<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') !== 'anggota') {
            redirect('auth');
        }
        $this->load->model(['M_Buku', 'M_Kategori', 'M_User', 'M_Peminjaman']);
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');
        $data['active_borrows'] = $this->M_Peminjaman->get_active_user_borrows($id_user);
        $data['riwayat'] = $this->M_Peminjaman->get_by_user($id_user);

        $this->load->view('anggota/layout/header', $data);
        $this->load->view('anggota/layout/sidebar');
        $this->load->view('anggota/dashboard', $data);
        $this->load->view('anggota/layout/footer');
    }

    // --- KATALOG ---
    public function katalog() {
        $data['buku'] = $this->M_Buku->get_all();
        $data['kategori'] = $this->M_Kategori->get_all();

        $this->load->view('anggota/layout/header', $data);
        $this->load->view('anggota/layout/sidebar');
        $this->load->view('anggota/katalog', $data);
        $this->load->view('anggota/layout/footer');
    }

    public function pinjam() {
        $id_user = $this->session->userdata('id_user');
        $id_buku = $this->input->post('id_buku');

        // Check active borrows max 3
        $active = $this->M_Peminjaman->get_active_user_borrows($id_user);
        if ($active >= 3) {
            echo json_encode(['status' => 'error', 'message' => 'Anda telah mencapai batas maksimal peminjaman (3 buku).']);
            return;
        }

        // Check stock
        $buku = $this->M_Buku->get_by_id($id_buku);
        if ($buku->stok <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Stok buku habis.']);
            return;
        }

        $tanggal_pinjam = date('Y-m-d');
        $batas_kembali = date('Y-m-d', strtotime('+7 days'));

        $data = [
            'id_user' => $id_user,
            'id_buku' => $id_buku,
            'tanggal_pinjam' => $tanggal_pinjam,
            'batas_kembali' => $batas_kembali,
            'status' => 'Dipinjam'
        ];

        $this->db->trans_start();
        // Insert peminjaman
        $this->M_Peminjaman->insert($data);
        
        // Kurangi stok
        $this->M_Buku->update($id_buku, ['stok' => $buku->stok - 1]);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan sistem.']);
        } else {
            echo json_encode(['status' => 'success', 'message' => 'Buku berhasil dipinjam. Batas kembali: ' . date('d M Y', strtotime($batas_kembali))]);
        }
    }

    // --- BUKU DIPINJAM ---
    public function dipinjam() {
        $id_user = $this->session->userdata('id_user');
        $data['peminjaman'] = $this->M_Peminjaman->get_by_user_active($id_user);

        $this->load->view('anggota/layout/header', $data);
        $this->load->view('anggota/layout/sidebar');
        $this->load->view('anggota/dipinjam', $data);
        $this->load->view('anggota/layout/footer');
    }

    public function kembalikan() {
        $id_pinjam = $this->input->post('id_pinjam');
        $peminjaman = $this->M_Peminjaman->get_by_id($id_pinjam);

        if ($peminjaman && $peminjaman->id_user == $this->session->userdata('id_user') && $peminjaman->status == 'Dipinjam') {
            $this->M_Peminjaman->update($id_pinjam, ['status' => 'Menunggu Verifikasi']);
            echo json_encode(['status' => 'success', 'message' => 'Pengembalian diajukan. Menunggu verifikasi admin.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid atau sudah diverifikasi.']);
        }
    }

    // --- RIWAYAT ---
    public function riwayat() {
        $id_user = $this->session->userdata('id_user');
        $data['riwayat'] = $this->M_Peminjaman->get_by_user($id_user);

        $this->load->view('anggota/layout/header', $data);
        $this->load->view('anggota/layout/sidebar');
        $this->load->view('anggota/riwayat', $data);
        $this->load->view('anggota/layout/footer');
    }

    // --- PROFIL ---
    public function profil() {
        $id_user = $this->session->userdata('id_user');
        $data['user'] = $this->M_User->get_user_by_id($id_user);

        $this->load->view('anggota/layout/header', $data);
        $this->load->view('anggota/layout/sidebar');
        $this->load->view('anggota/profil', $data);
        $this->load->view('anggota/layout/footer');
    }

    public function update_profil() {
        $id_user = $this->session->userdata('id_user');
        $username = $this->input->post('username', TRUE);
        $email = $this->input->post('email', TRUE);

        // Check if username is already taken by another user
        $this->db->where('username', $username);
        $this->db->where('id_user !=', $id_user);
        $cek_username = $this->db->get('users')->num_rows();
        if ($cek_username > 0) {
            echo json_encode(['status' => 'error', 'message' => 'Username sudah digunakan oleh orang lain!']);
            return;
        }

        // Check if email is already taken by another user
        $this->db->where('email', $email);
        $this->db->where('id_user !=', $id_user);
        $cek_email = $this->db->get('users')->num_rows();
        if ($cek_email > 0) {
            echo json_encode(['status' => 'error', 'message' => 'Email sudah digunakan oleh orang lain!']);
            return;
        }

        $data = [
            'nama' => $this->input->post('nama'),
            'username' => $username,
            'email' => $email,
            'telepon' => $this->input->post('telepon'),
            'alamat' => $this->input->post('alamat')
        ];

        if ($this->input->post('password')) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path'] = './assets/img/users/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048; // 2MB
            $config['file_name'] = time() . '_' . $_FILES['foto']['name'];
            
            $this->load->library('upload');
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('foto')) {
                $upload_data = $this->upload->data();
                $data['foto'] = $upload_data['file_name'];
                $this->session->set_userdata('foto', $data['foto']);
            } else {
                $error = $this->upload->display_errors('', '');
                echo json_encode(['status' => 'error', 'message' => 'Gagal upload foto: ' . $error]);
                return;
            }
        }

        $this->M_User->update_anggota($id_user, $data);
        $this->session->set_userdata('nama', $data['nama']);
        $this->session->set_userdata('username', $data['username']);

        echo json_encode(['status' => 'success', 'message' => 'Profil berhasil diupdate']);
    }
}
