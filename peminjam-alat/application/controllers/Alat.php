<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alat extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!in_array($this->session->userdata('role'), ['Admin', 'Petugas'])) {
            redirect('dashboard');
        }
    }

    public function index() {
        $data['title'] = 'Data Alat';
        
        $data['alat'] = $this->Alat_model->get_all_alat();
        $data['kategori'] = $this->Kategori_model->get_all_kategori();
        $data['next_kode'] = $this->Alat_model->generate_kode_alat();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('alat/index', $data);
        $this->load->view('layout/footer');
    }

    public function simpan() {
        $kode_alat = htmlspecialchars($this->input->post('kode_alat', true));
        $nama_alat = htmlspecialchars($this->input->post('nama_alat', true));
        $kategori_id = $this->input->post('kategori_id');
        $stok = $this->input->post('stok');
        $kondisi = $this->input->post('kondisi');
        $lokasi = htmlspecialchars($this->input->post('lokasi_penyimpanan', true));
        $status = $this->input->post('status_ketersediaan');

        // Validasi duplikasi kode_alat
        $cek_alat = $this->db->get_where('alat', ['kode_alat' => $kode_alat])->row_array();
        if ($cek_alat) {
            $this->session->set_flashdata('error', 'Kode alat sudah digunakan!');
            redirect('alat');
        }

        $foto = 'default.png';
        if (!empty($_FILES['foto_alat']['name'])) {
            $config['upload_path'] = './assets/img/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['file_name'] = time() . '_' . $_FILES['foto_alat']['name'];
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto_alat')) {
                $foto = $this->upload->data('file_name');
            }
        }

        $data = [
            'kode_alat' => $kode_alat,
            'nama_alat' => $nama_alat,
            'kategori_id' => $kategori_id,
            'stok' => $stok,
            'kondisi' => $kondisi,
            'lokasi_penyimpanan' => $lokasi,
            'foto_alat' => $foto,
            'status_ketersediaan' => $status
        ];

        $this->Alat_model->insert_alat($data);
        $this->session->set_flashdata('success', 'Data alat berhasil ditambahkan!');
        redirect('alat');
    }

    public function edit() {
        $id = $this->input->post('id');
        
        $data = [
            'nama_alat' => htmlspecialchars($this->input->post('nama_alat', true)),
            'kategori_id' => $this->input->post('kategori_id'),
            'stok' => $this->input->post('stok'),
            'kondisi' => $this->input->post('kondisi'),
            'lokasi_penyimpanan' => htmlspecialchars($this->input->post('lokasi_penyimpanan', true)),
            'status_ketersediaan' => $this->input->post('status_ketersediaan')
        ];

        if (!empty($_FILES['foto_alat']['name'])) {
            $config['upload_path'] = './assets/img/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['file_name'] = time() . '_' . $_FILES['foto_alat']['name'];
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto_alat')) {
                $data['foto_alat'] = $this->upload->data('file_name');
                
                // Hapus foto lama jika bukan default
                $alat_lama = $this->Alat_model->get_alat_by_id($id);
                if ($alat_lama['foto_alat'] != 'default.png' && file_exists('./assets/img/'.$alat_lama['foto_alat'])) {
                    unlink('./assets/img/'.$alat_lama['foto_alat']);
                }
            }
        }

        $this->Alat_model->update_alat($id, $data);
        $this->session->set_flashdata('success', 'Data alat berhasil diperbarui!');
        redirect('alat');
    }

    public function hapus($id) {
        $alat = $this->Alat_model->get_alat_by_id($id);
        if ($alat) {
            if ($alat['foto_alat'] != 'default.png' && file_exists('./assets/img/'.$alat['foto_alat'])) {
                unlink('./assets/img/'.$alat['foto_alat']);
            }
            $this->Alat_model->delete_alat($id);
            $this->session->set_flashdata('success', 'Data alat berhasil dihapus!');
        }
        redirect('alat');
    }
}
