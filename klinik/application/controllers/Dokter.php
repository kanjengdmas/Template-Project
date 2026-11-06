<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends CI_Controller {

    private $dokter_id;

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') !== 'dokter') {
            $this->session->set_flashdata('error', 'Akses ditolak!');
            redirect('auth/login');
        }
        $this->load->model('User_model');
        $this->load->model('Dokter_model');
        $this->load->model('Pemeriksaan_model');
        $this->load->model('Obat_model');

        // Get dokter_id for this user
        $dokter_data = $this->Dokter_model->get_by_user_id($this->session->userdata('id'));
        if ($dokter_data) {
            $this->dokter_id = $dokter_data->id;
        } else {
            $this->session->set_flashdata('error', 'Data dokter Anda belum diatur oleh Admin.');
            redirect('auth/login');
        }
    }

    public function index() {
        $data['title'] = 'Dashboard Dokter';
        $pemeriksaan = $this->Pemeriksaan_model->get_by_status_and_dokter_id('Diproses', $this->session->userdata('id'));
        $data['pasien_hari_ini'] = count($pemeriksaan);
        
        $selesai = $this->Pemeriksaan_model->get_by_dokter_id($this->session->userdata('id'));
        $count_selesai = 0;
        foreach($selesai as $s) {
            if ($s->status == 'Selesai') $count_selesai++;
        }
        $data['pemeriksaan_selesai'] = $count_selesai;

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('dokter/dashboard', $data);
        $this->load->view('layout/footer');
    }

    public function pemeriksaan() {
        $data['title'] = 'Pemeriksaan Pasien (Menunggu)';
        // Tampilkan yang status = 'Diproses' (dari petugas) dan sesuai dokter
        $data['pemeriksaan'] = $this->Pemeriksaan_model->get_by_status_and_dokter_id('Diproses', $this->session->userdata('id'));

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('dokter/pemeriksaan', $data);
        $this->load->view('layout/footer');
    }

    public function periksa($id) {
        $data['title'] = 'Form Diagnosis Pasien';
        $data['p'] = $this->Pemeriksaan_model->get_by_id($id);
        $data['obat'] = $this->Obat_model->get_all();

        // Check if status is correct
        if ($data['p']->status != 'Diproses') {
            $this->session->set_flashdata('error', 'Pemeriksaan ini tidak sedang dalam proses.');
            redirect('dokter/pemeriksaan');
        }

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('dokter/periksa', $data);
        $this->load->view('layout/footer');
    }

    public function simpan_periksa() {
        $id = $this->input->post('pemeriksaan_id');
        
        $update_data = [
            'diagnosis' => $this->input->post('diagnosis'),
            'saran' => $this->input->post('saran'),
            'status' => 'Selesai'
        ];

        $this->Pemeriksaan_model->update($id, $update_data);

        // Process Resep Obat
        $obat_ids = $this->input->post('obat_id');
        $jumlahs = $this->input->post('jumlah');
        $aturan = $this->input->post('aturan_pakai');

        if (!empty($obat_ids)) {
            for ($i = 0; $i < count($obat_ids); $i++) {
                if (!empty($obat_ids[$i]) && !empty($aturan[$i]) && !empty($jumlahs[$i])) {
                    $qty = (int)$jumlahs[$i];
                    $resep_data = [
                        'pemeriksaan_id' => $id,
                        'obat_id' => $obat_ids[$i],
                        'jumlah' => $qty,
                        'aturan_pakai' => $aturan[$i]
                    ];
                    $this->Pemeriksaan_model->insert_resep($resep_data);
                    
                    // Reduce Stock
                    $obat = $this->Obat_model->get_by_id($obat_ids[$i]);
                    $new_stok = $obat->stok - $qty;
                    // Ensure stock doesn't go below 0
                    if ($new_stok < 0) $new_stok = 0;
                    $this->Obat_model->update($obat_ids[$i], ['stok' => $new_stok]);
                }
            }
        }

        $this->session->set_flashdata('success', 'Pemeriksaan selesai. Diagnosis dan resep telah disimpan.');
        redirect('dokter/riwayat');
    }

    public function riwayat() {
        $data['title'] = 'Riwayat Pemeriksaan (Selesai)';
        // Only show completed ones handled by this doctor
        $all_riwayat = $this->Pemeriksaan_model->get_by_dokter_id($this->session->userdata('id'));
        $data['riwayat'] = [];
        foreach($all_riwayat as $r) {
            if ($r->status == 'Selesai') {
                $r->resep = $this->Pemeriksaan_model->get_resep_by_pemeriksaan($r->id);
                $data['riwayat'][] = $r;
            }
        }

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
        $this->load->view('dokter/riwayat', $data);
        $this->load->view('layout/footer');
    }

    public function hapus_riwayat($id) {
        // Hapus resep terkait terlebih dahulu
        $this->Pemeriksaan_model->delete_resep_by_pemeriksaan($id);
        // Hapus data pemeriksaan
        $this->Pemeriksaan_model->delete($id);

        $this->session->set_flashdata('success', 'Riwayat pemeriksaan berhasil dihapus.');
        redirect('dokter/riwayat');
    }
}
