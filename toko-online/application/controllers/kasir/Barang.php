<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') !== 'admin' && $this->session->userdata('role') !== 'kasir') {
            redirect('auth');
        }
        $this->load->model('Admin_model');
    }

    public function index() {
        $data['role'] = $this->session->userdata('role');
        $data['dashboard_url'] = base_url($data['role'] . '/dashboard');
        $data['barang'] = $this->Admin_model->get_all('products');
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/barang', $data);
        $this->load->view('admin/templates/footer');
    }

    public function add() {
        $data = array(
            'name' => $this->input->post('name'),
            'category' => $this->input->post('category'),
            'price' => $this->input->post('price'),
            'stock' => $this->input->post('stock'),
            'description' => $this->input->post('description')
        );

        $config['upload_path']   = './assets/img/';
        $config['allowed_types'] = 'gif|jpg|png|webp|jpeg';
        $config['encrypt_name']  = TRUE;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $data['image'] = $this->upload->data('file_name');
        } else {
            $data['image'] = 'default.png'; 
        }

        $product_id = $this->Admin_model->insert('products', $data);
        
        // Log Barang Masuk
        $log_data = array(
            'product_id' => $product_id,
            'type' => 'masuk',
            'quantity' => $data['stock'],
            'description' => 'Penambahan barang baru: ' . $data['name']
        );
        $this->db->insert('stock_logs', $log_data);
        
        $this->Admin_model->log_activity('Menambahkan barang baru: ' . $data['name']);

        $this->session->set_flashdata('success', 'Barang berhasil ditambahkan!');
        redirect($this->session->userdata('role') . '/barang');
    }

    public function edit() {
        $id = $this->input->post('id');
        $data = array(
            'name' => $this->input->post('name'),
            'category' => $this->input->post('category'),
            'price' => $this->input->post('price'),
            'stock' => $this->input->post('stock'),
            'description' => $this->input->post('description')
        );

        $config['upload_path']   = './assets/img/';
        $config['allowed_types'] = 'gif|jpg|png|webp|jpeg';
        $config['encrypt_name']  = TRUE;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $data['image'] = $this->upload->data('file_name');
        }

        // Fetch old product data to get the old stock
        $old_product = $this->Admin_model->get_by_id('products', $id);
        $old_stock = isset($old_product['stock']) ? (int)$old_product['stock'] : 0;
        $new_stock = (int)$data['stock'];

        $this->Admin_model->update('products', $id, $data);
        
        // Log stock differences if modified
        if ($new_stock !== $old_stock) {
            $diff = abs($new_stock - $old_stock);
            $type = ($new_stock > $old_stock) ? 'masuk' : 'keluar';
            $description = 'Stok diubah dari ' . $old_stock . ' menjadi ' . $new_stock . ' (Penyesuaian ' . ($type === 'masuk' ? 'Masuk' : 'Keluar') . ')';
            
            $log_data = array(
                'product_id' => $id,
                'type' => $type,
                'quantity' => $diff,
                'description' => $description
            );
            $this->db->insert('stock_logs', $log_data);
        }
        
        $this->Admin_model->log_activity('Mengubah data barang: ' . $data['name']);

        $this->session->set_flashdata('success', 'Barang berhasil diupdate!');
        redirect($this->session->userdata('role') . '/barang');
    }

    public function delete($id) {
        $barang = $this->Admin_model->get_by_id('products', $id);
        $this->Admin_model->delete('products', $id);
        
        $this->Admin_model->log_activity('Menghapus barang: ' . ($barang['name'] ?? 'ID '.$id));

        $this->session->set_flashdata('success', 'Barang berhasil dihapus!');
        redirect($this->session->userdata('role') . '/barang');
    }

    public function print() {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth');
        }
        $data['barang'] = $this->Admin_model->get_all('products');
        $data['store'] = $this->db->get_where('store_info', array('id' => 1))->row_array();
        $this->load->view('admin/print_barang', $data);
    }
}
