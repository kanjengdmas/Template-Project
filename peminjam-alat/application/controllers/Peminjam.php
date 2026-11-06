<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjam extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 'Peminjam') {
            redirect('dashboard');
        }
    }

    // Menampilkan daftar alat untuk dipinjam
    public function alat() {
        $data['title'] = 'Daftar Alat';
        
        $data['alat'] = $this->Alat_model->get_available_alat();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('peminjam/alat_list', $data);
        $this->load->view('layout/footer');
    }

    // Proses pengajuan peminjaman
    public function ajukan() {
        $alat_id = $this->input->post('alat_id');
        $jumlah = $this->input->post('jumlah');
        $tgl_kembali = $this->input->post('tanggal_kembali_rencana');
        $keterangan = htmlspecialchars($this->input->post('keterangan', true));

        $alat = $this->Alat_model->get_alat_by_id($alat_id);
        if ($alat['stok'] < $jumlah) {
            $this->session->set_flashdata('error', 'Stok alat tidak mencukupi!');
            redirect('peminjam/alat');
        }

        // Generate Kode Peminjaman (PJ-YYYYMMDD-Rand)
        $kode_peminjaman = 'PJ-' . date('Ymd') . '-' . strtoupper(substr(md5(rand()), 0, 4));

        $data_peminjaman = [
            'kode_peminjaman' => $kode_peminjaman,
            'peminjam_id' => $this->session->userdata('id'),
            'tanggal_kembali_rencana' => $tgl_kembali,
            'keterangan' => $keterangan,
            'status' => 'Menunggu Persetujuan'
        ];

        $this->db->trans_start();
        $peminjaman_id = $this->Peminjaman_model->insert_peminjaman($data_peminjaman);

        $data_detail = [
            'peminjaman_id' => $peminjaman_id,
            'alat_id' => $alat_id,
            'jumlah' => $jumlah
        ];
        $this->Peminjaman_model->insert_detail_peminjaman($data_detail);

        // Kurangi stok alat
        $this->Alat_model->update_alat($alat_id, ['stok' => $alat['stok'] - $jumlah]);
        
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('error', 'Gagal mengajukan peminjaman!');
        } else {
            $this->session->set_flashdata('success', 'Peminjaman berhasil diajukan, menunggu persetujuan petugas.');
        }

        redirect('peminjam/riwayat');
    }

    // Riwayat peminjaman
    public function riwayat() {
        $data['title'] = 'Riwayat Peminjaman';
        $user_id = $this->session->userdata('id');

        $data['riwayat'] = $this->Peminjaman_model->get_peminjaman_by_user($user_id);

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('peminjam/riwayat', $data);
        $this->load->view('layout/footer');
    }

    public function batalkan($id) {
        $pem = $this->Peminjaman_model->get_peminjaman_by_id($id);
        if ($pem && $pem['peminjam_id'] == $this->session->userdata('id') && $pem['status'] == 'Menunggu Persetujuan') {
            // Kembalikan stok
            $detail = $this->Peminjaman_model->get_detail_peminjaman_by_peminjaman_id($id);
            $alat = $this->Alat_model->get_alat_by_id($detail['alat_id']);
            $this->Alat_model->update_alat($alat['id'], ['stok' => $alat['stok'] + $detail['jumlah']]);

            // Hapus peminjaman
            $this->Peminjaman_model->delete_peminjaman($id);
            $this->session->set_flashdata('success', 'Pengajuan peminjaman berhasil dibatalkan.');
        }
        redirect('peminjam/riwayat');
    }

    public function denda() {
        $data['title'] = 'Data Denda Anda';
        $user_id = $this->session->userdata('id');

        $data['denda'] = $this->Denda_model->get_denda_by_user($user_id);

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('peminjam/denda', $data);
        $this->load->view('layout/footer');
    }
        
    public function profil() {
        $data['title'] = 'Profil Saya';
        $user_id = $this->session->userdata('id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('peminjam/profil', $data);
        $this->load->view('layout/footer');
    }

    public function update_profil() {
        $user_id = $this->session->userdata('id');
        $username = htmlspecialchars($this->input->post('username', true));

        // Cek keunikan username
        $existing_user = $this->db->get_where('users', ['username' => $username])->row_array();
        if ($existing_user && $existing_user['id'] != $user_id) {
            $this->session->set_flashdata('error', 'Username sudah digunakan oleh pengguna lain!');
            redirect('peminjam/profil');
        }

        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'username' => $username,
            'nim_nik' => htmlspecialchars($this->input->post('nim_nik', true)),
            'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
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
                redirect('peminjam/profil');
            }
        }

        $this->User_model->update_user($user_id, $data);
        $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
        
        // Update session nama & username jika berubah
        $this->session->set_userdata('nama', $data['nama']);
        $this->session->set_userdata('username', $data['username']);
        
        redirect('peminjam/profil');
    }
}
