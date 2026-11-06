<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth');
        }
        $this->load->model('Admin_model');
    }

    public function index() {
        $data['role'] = $this->session->userdata('role');
        $data['dashboard_url'] = base_url($data['role'] . '/dashboard');
        
        $orders = $this->Admin_model->get_orders_with_user();
        foreach ($orders as &$o) {
            $o['items'] = $this->Admin_model->get_order_details($o['id']);
        }
        
        $data['orders'] = $orders;
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/transaksi', $data);
        $this->load->view('admin/templates/footer');
    }

    public function delete($id) {
        $this->Admin_model->delete('orders', $id);
        $this->Admin_model->log_activity('Menghapus data transaksi ID #' . $id);
        $this->session->set_flashdata('success', 'Transaksi berhasil dihapus!');
        redirect('admin/transaksi');
    }

    public function print($id) {
        $data['order'] = $this->Admin_model->get_by_id('orders', $id);
        $data['items'] = $this->Admin_model->get_order_details($id);
        $data['store'] = $this->db->get_where('store_info', array('id' => 1))->row_array();
        
        $this->load->view('admin/print_transaksi', $data);
    }
}
