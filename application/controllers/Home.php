<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Buku');
    }

    public function index() {
        $data['buku_terbaru'] = $this->M_Buku->get_buku_terbaru();
        $data['buku_populer'] = $this->M_Buku->get_buku_populer();
        $data['total_buku'] = $this->M_Buku->count_buku();
        
        $this->load->model('M_User');
        $data['total_anggota'] = $this->M_User->count_anggota();
        
        $this->load->model('M_Peminjaman');
        $data['buku_dipinjam'] = $this->M_Peminjaman->count_buku_dipinjam();
        $data['buku_dikembalikan'] = $this->M_Peminjaman->count_buku_dikembalikan();
        
        $this->load->model('M_Kategori');
        $data['kategori'] = $this->M_Kategori->get_all();
        $data['total_kategori'] = $this->M_Kategori->count_kategori();

        $this->load->view('landing_page', $data);
    }
}
