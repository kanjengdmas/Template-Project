<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            redirect('auth');
        }
    }

    public function index() {
        $role = $this->session->userdata('role');
        $data['title'] = 'Dashboard ' . $role;

        if ($role == 'Admin') {
            $data['total_alat'] = $this->Alat_model->count_all();
            $data['total_peminjam'] = $this->User_model->count_by_role('Peminjam');
            $data['total_petugas'] = $this->User_model->count_by_role('Petugas');
            $data['total_transaksi'] = $this->Peminjaman_model->count_all_peminjaman();
            $data['total_denda'] = $this->Denda_model->get_total_unpaid_denda();

            // Trend Mock Data (karena tidak ada tabel histori stat khusus)
            $data['trend_alat'] = 8;
            $data['trend_transaksi'] = 12;
            $data['trend_peminjam'] = 5;
            $data['trend_denda'] = 50000;

            // Grafik Peminjaman & Pengembalian (Mock Data 6 Bulan Terakhir)
            $months = [];
            $peminjaman_data = [];
            $pengembalian_data = [];
            for($i = 5; $i >= 0; $i--) {
                $months[] = date('M Y', strtotime("-$i months"));
                $peminjaman_data[] = rand(20, 50); // mock
                $pengembalian_data[] = rand(15, 45); // mock
            }
            $data['chart_labels'] = json_encode($months);
            $data['chart_peminjaman'] = json_encode($peminjaman_data);
            $data['chart_pengembalian'] = json_encode($pengembalian_data);

            // Distribusi Status Peminjaman
            $status_counts = [
                'Menunggu' => $this->Peminjaman_model->count_by_status('Menunggu Persetujuan'),
                'Dipinjam' => $this->Peminjaman_model->count_by_status('Dipinjam'),
                'Ditolak' => $this->Peminjaman_model->count_by_status('Ditolak'),
                'Selesai' => $this->Peminjaman_model->count_by_status('Selesai')
            ];
            $data['status_dist'] = json_encode(array_values($status_counts));

            // Pengajuan Terbaru (5 data)
            $data['pengajuan_terbaru'] = $this->Peminjaman_model->get_recent_submissions(5);

            // Alat Populer (5 data)
            $data['alat_populer'] = $this->Alat_model->get_popular_alat(5);

            // Info Sistem
            $data['db_version'] = $this->db->version();

            // Aktivitas Terbaru (15 data)
            $data['recent_activities'] = $this->Peminjaman_model->get_recent_activities(15);

            $this->load->view('layout/header', $data);
            $this->load->view('layout/sidebar', $data);
            $this->load->view('layout/topbar', $data);
            $this->load->view('admin/dashboard', $data);
            $this->load->view('layout/footer');
            
        } elseif ($role == 'Petugas') {
            $data['menunggu'] = $this->Peminjaman_model->count_by_status('Menunggu Persetujuan');
            $data['dipinjam'] = $this->Peminjaman_model->count_by_status('Dipinjam');
            $data['kembali_hari_ini'] = $this->Peminjaman_model->count_by_status_and_date('Dipinjam', date('Y-m-d'));
            $data['selesai'] = $this->Peminjaman_model->count_by_status('Selesai');
            
            // Mock Trends
            $data['trend_menunggu'] = 1;
            $data['trend_dipinjam'] = 2;
            $data['trend_kembali'] = -1;
            $data['trend_selesai'] = 5;

            // Grafik (Mock Data 6 Bulan Terakhir)
            $months = [];
            $peminjaman_data = [];
            $pengembalian_data = [];
            for($i = 5; $i >= 0; $i--) {
                $months[] = date('M Y', strtotime("-$i months"));
                $peminjaman_data[] = rand(15, 45); // mock
                $pengembalian_data[] = rand(10, 40); // mock
            }
            $data['chart_labels'] = json_encode($months);
            $data['chart_peminjaman'] = json_encode($peminjaman_data);
            $data['chart_pengembalian'] = json_encode($pengembalian_data);

            // Pengajuan Peminjaman Terbaru
            $data['pengajuan_terbaru'] = $this->Peminjaman_model->get_recent_submissions_waiting(3);

            // Pengembalian Hari Ini
            $data['pengembalian_hari_ini'] = $this->Peminjaman_model->get_overdue_or_today_returns(2);

            // Alat Sedang Dipinjam
            $data['alat_dipinjam'] = $this->Alat_model->get_currently_borrowed_alat(4);

            $this->load->view('layout/header', $data);
            $this->load->view('layout/sidebar', $data);
            $this->load->view('layout/topbar', $data);
            $this->load->view('petugas/dashboard', $data);
            $this->load->view('layout/footer');

        } else { // Peminjam
            $user_id = $this->session->userdata('id');
            $data['total_pengajuan'] = $this->Peminjaman_model->count_all_peminjaman($user_id);
            $data['menunggu'] = $this->Peminjaman_model->count_by_status('Menunggu Persetujuan', $user_id);
            $data['dipinjam'] = $this->Peminjaman_model->count_by_status('Dipinjam', $user_id);
            
            // Mock Trends
            $data['trend_pengajuan'] = 1;
            $data['trend_menunggu'] = 0;
            $data['trend_dipinjam'] = 0;

            // Distribusi Status Peminjaman User
            $status_counts = [
                'Selesai' => $this->Peminjaman_model->count_by_status('Selesai', $user_id),
                'Dipinjam' => $data['dipinjam'],
                'Menunggu' => $data['menunggu'],
                'Ditolak' => $this->Peminjaman_model->count_by_status('Ditolak', $user_id)
            ];
            $data['status_dist'] = json_encode(array_values($status_counts));

            // Riwayat Terbaru
            $data['riwayat_terbaru'] = $this->Peminjaman_model->get_peminjaman_by_user_limit($user_id, 3);

            // Alat Populer (5 data)
            $data['alat_populer'] = $this->Alat_model->get_popular_alat(5);

            $this->load->view('layout/header', $data);
            $this->load->view('layout/sidebar', $data);
            $this->load->view('layout/topbar', $data);
            $this->load->view('peminjam/dashboard', $data);
            $this->load->view('layout/footer');
        }
    }
}
