<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) redirect('auth');
        $this->load->model('Admin_model');
        $this->role = $this->session->userdata('role');
    }

    public function index() {
        $data['role'] = $this->role;
        $data['dashboard_url'] = base_url($this->role . '/dashboard');
        
        $this->db->select('orders.*, users.fullname as customer_name, products.name as product_name, products.image as product_image');
        $this->db->from('orders');
        $this->db->join('users', 'users.id = orders.user_id', 'left');
        $this->db->join('order_items', 'order_items.order_id = orders.id', 'left');
        $this->db->join('products', 'products.id = order_items.product_id', 'left');
        $this->db->group_by('orders.id');
        $this->db->order_by('order_date', 'DESC');
        $data['sales'] = $this->db->get()->result_array();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/penjualan', $data);
        $this->load->view('admin/templates/footer');
    }

    public function detail($id) {
        $order = $this->db->select('orders.*, users.fullname, users.email')
                                 ->from('orders')
                                 ->join('users', 'users.id = orders.user_id')
                                 ->where('orders.id', $id)
                                 ->get()->row_array();
                                 
        $items = $this->db->select('order_items.*, products.name, products.image')
                                 ->from('order_items')
                                 ->join('products', 'products.id = order_items.product_id')
                                 ->where('order_id', $id)
                                 ->get()->result_array();

        $response = array(
            'order' => $order,
            'items' => $items
        );

        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
    }

    public function update_status() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        // Get current order status to prevent double stock deduction/restoration
        $order = $this->Admin_model->get_by_id('orders', $id);
        $old_status = $order['status'];
        
        $cancelled_statuses = array('cancelled', 'batal', 'failed');
        $is_old_cancelled = in_array(strtolower($old_status), $cancelled_statuses);
        $is_new_cancelled = in_array(strtolower($status), $cancelled_statuses);
        
        // If moving from active to cancelled status, restore stock
        $should_restore = $is_new_cancelled && !$is_old_cancelled;
        
        // If moving from cancelled status back to active, reduce stock again
        $should_reduce = !$is_new_cancelled && $is_old_cancelled;

        if ($should_reduce) {
            $this->Admin_model->reduce_stock($id, 'Perubahan Status Pesanan ke Aktif (Order ID: #' . $id . ')');
        } elseif ($should_restore) {
            $this->Admin_model->restore_stock($id, 'Perubahan Status Pesanan ke Batal (Order ID: #' . $id . ')');
        }

        $this->Admin_model->update('orders', $id, array('status' => $status));
        
        $msg_suffix = '';
        if ($should_reduce) {
            $msg_suffix = ' (Stok dikurangi)';
        } elseif ($should_restore) {
            $msg_suffix = ' (Stok dikembalikan sebagai barang masuk)';
        }
        
        $this->Admin_model->log_activity('Mengubah status pesanan ID #' . $id . ' menjadi ' . $status . $msg_suffix);
        $this->session->set_flashdata('success', 'Status transaksi berhasil diperbarui!' . ($should_reduce ? ' Stok telah dikurangi.' : ($should_restore ? ' Stok telah dikembalikan.' : '')));
        redirect($this->role . '/penjualan');
    }

    public function print_invoice($id) {
        $data['order'] = $this->Admin_model->get_by_id('orders', $id);
        $data['items'] = $this->Admin_model->get_order_details($id);
        $data['store'] = $this->db->get_where('store_info', array('id' => 1))->row_array();
        
        $this->load->view('admin/print_transaksi', $data);
    }
}
