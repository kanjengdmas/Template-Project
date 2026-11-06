<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth');
        }
        $this->load->model(['M_Buku', 'M_Kategori', 'M_User', 'M_Peminjaman']);
    }

    public function index() {
        $data['total_buku'] = $this->M_Buku->count_buku();
        $data['total_anggota'] = $this->M_User->count_anggota();
        $data['total_peminjaman'] = $this->M_Peminjaman->count_peminjaman();
        $data['buku_dipinjam'] = $this->M_Peminjaman->count_buku_dipinjam();
        $data['menunggu_verifikasi'] = $this->M_Peminjaman->count_menunggu_verifikasi();
        $data['buku_dikembalikan'] = $this->M_Peminjaman->count_buku_dikembalikan();
        
        $data['buku_terpopuler'] = $this->M_Buku->get_buku_populer(5);
        $data['peminjaman_terbaru'] = $this->M_Peminjaman->get_all();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/layout/footer');
    }

    // --- BUKU ---
    public function data_buku() {
        $data['buku'] = $this->M_Buku->get_all();
        $data['kategori'] = $this->M_Kategori->get_all();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/buku', $data);
        $this->load->view('admin/layout/footer');
    }

    public function get_buku($id) {
        $data = $this->M_Buku->get_by_id($id);
        echo json_encode($data);
    }

    public function save_buku() {
        $id = $this->input->post('id_buku');
        $data = [
            'id_kategori' => $this->input->post('id_kategori'),
            'judul' => $this->input->post('judul'),
            'penulis' => $this->input->post('penulis'),
            'penerbit' => $this->input->post('penerbit'),
            'tahun_terbit' => $this->input->post('tahun_terbit'),
            'stok' => $this->input->post('stok'),
            'deskripsi' => $this->input->post('deskripsi')
        ];

        // Handle File Upload (Cover)
        if (!empty($_FILES['cover']['name'])) {
            $config['upload_path'] = './assets/img/buku/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name'] = time() . '_' . $_FILES['cover']['name'];
            
            $this->load->library('upload');
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('cover')) {
                $upload_data = $this->upload->data();
                $data['cover'] = $upload_data['file_name'];
            }
        }

        if ($id) {
            $this->M_Buku->update($id, $data);
            echo json_encode(['status' => 'success', 'message' => 'Data buku berhasil diupdate']);
        } else {
            $this->M_Buku->insert($data);
            echo json_encode(['status' => 'success', 'message' => 'Data buku berhasil ditambahkan']);
        }
    }

    public function delete_buku($id) {
        $this->M_Buku->delete($id);
        echo json_encode(['status' => 'success']);
    }

    // --- KATEGORI ---
    public function kategori() {
        $data['kategori'] = $this->M_Kategori->get_all();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/kategori', $data);
        $this->load->view('admin/layout/footer');
    }

    public function get_kategori($id) {
        echo json_encode($this->M_Kategori->get_by_id($id));
    }

    public function save_kategori() {
        $id = $this->input->post('id_kategori');
        $data = ['nama_kategori' => $this->input->post('nama_kategori')];

        if ($id) {
            $this->M_Kategori->update($id, $data);
            echo json_encode(['status' => 'success', 'message' => 'Kategori berhasil diupdate']);
        } else {
            $this->M_Kategori->insert($data);
            echo json_encode(['status' => 'success', 'message' => 'Kategori berhasil ditambahkan']);
        }
    }

    public function delete_kategori($id) {
        $this->M_Kategori->delete($id);
        echo json_encode(['status' => 'success']);
    }

    // --- ANGGOTA ---
    public function data_anggota() {
        $data['anggota'] = $this->M_User->get_all_anggota();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/anggota', $data);
        $this->load->view('admin/layout/footer');
    }

    public function get_anggota($id) {
        echo json_encode($this->M_User->get_anggota_by_id($id));
    }

    public function save_anggota() {
        $id = $this->input->post('id_user');
        $data = [
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'alamat' => $this->input->post('alamat'),
            'role' => 'anggota'
        ];

        if ($this->input->post('password')) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        if ($id) {
            $this->M_User->update_anggota($id, $data);
            echo json_encode(['status' => 'success', 'message' => 'Anggota berhasil diupdate']);
        } else {
            // Must have password for new insert
            if(empty($data['password'])){
                $data['password'] = password_hash('123456', PASSWORD_DEFAULT);
            }
            $this->M_User->insert_anggota($data);
            echo json_encode(['status' => 'success', 'message' => 'Anggota berhasil ditambahkan']);
        }
    }

    public function delete_anggota($id) {
        // Hapus riwayat peminjaman terlebih dahulu untuk menghindari error foreign key
        $this->db->where('id_user', $id);
        $this->db->delete('peminjaman');

        $this->M_User->delete_anggota($id);
        echo json_encode(['status' => 'success']);
    }

    // --- PEMINJAMAN ---
    public function data_peminjaman() {
        $data['peminjaman'] = $this->M_Peminjaman->get_all();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/peminjaman', $data);
        $this->load->view('admin/layout/footer');
    }

    public function verifikasi_pengembalian($id) {
        $peminjaman = $this->M_Peminjaman->get_by_id($id);
        if ($peminjaman && $peminjaman->status == 'Menunggu Verifikasi') {
            // Update status
            $this->M_Peminjaman->update($id, [
                'status' => 'Dikembalikan',
                'tanggal_pengembalian' => date('Y-m-d')
            ]);
            
            // Tambah stok buku
            $buku = $this->M_Buku->get_by_id($peminjaman->id_buku);
            $this->M_Buku->update($peminjaman->id_buku, ['stok' => $buku->stok + 1]);

            echo json_encode(['status' => 'success', 'message' => 'Pengembalian berhasil diverifikasi. Stok buku bertambah.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid.']);
        }
    }

    // --- LAPORAN ---
    public function laporan() {
        $data['peminjaman'] = $this->M_Peminjaman->get_all();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/laporan', $data);
        $this->load->view('admin/layout/footer');
    }

    // --- PENGATURAN AKUN ---
    public function pengaturan() {
        $id_user = $this->session->userdata('id_user');
        $data['user'] = $this->M_User->get_user_by_id($id_user);

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/pengaturan', $data);
        $this->load->view('admin/layout/footer');
    }

    public function update_profile() {
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
            'nama' => $this->input->post('nama', TRUE),
            'username' => $username,
            'email' => $email,
            'telepon' => $this->input->post('telepon', TRUE),
            'alamat' => $this->input->post('alamat', TRUE)
        ];

        // Handle profile photo upload
        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path'] = './assets/img/users/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB
            $config['file_name'] = time() . '_' . $_FILES['foto']['name'];
            
            $this->load->library('upload');
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('foto')) {
                $upload_data = $this->upload->data();
                $data['foto'] = $upload_data['file_name'];
                
                // Update session
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

        echo json_encode(['status' => 'success', 'message' => 'Profil berhasil diperbarui.']);
    }

    public function change_password() {
        $id_user = $this->session->userdata('id_user');
        $password_lama = $this->input->post('password_lama', TRUE);
        $password_baru = $this->input->post('password_baru', TRUE);
        $konfirmasi_password = $this->input->post('konfirmasi_password', TRUE);

        // Validasi input
        if (strlen($password_baru) < 8) {
            echo json_encode(['status' => 'error', 'message' => 'Password baru minimal harus 8 karakter!']);
            return;
        }

        if ($password_baru !== $konfirmasi_password) {
            echo json_encode(['status' => 'error', 'message' => 'Konfirmasi password baru tidak cocok!']);
            return;
        }

        // Get user data
        $user = $this->M_User->get_user_by_id($id_user);

        // Verify old password
        if (!password_verify($password_lama, $user->password)) {
            echo json_encode(['status' => 'error', 'message' => 'Password lama tidak sesuai!']);
            return;
        }

        // Update password
        $data = [
            'password' => password_hash($password_baru, PASSWORD_DEFAULT)
        ];
        $this->M_User->update_anggota($id_user, $data);

        echo json_encode(['status' => 'success', 'message' => 'Password berhasil diubah.']);
    }
}
