<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

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
        $data['orders'] = $this->Admin_model->get_orders_with_user();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/pesanan', $data);
        $this->load->view('admin/templates/footer');
    }

    public function confirm($id) {
        $data = array('status' => 'confirmed');
        $this->Admin_model->update('orders', $id, $data);
        $this->Admin_model->log_activity('Mengonfirmasi pesanan ID #' . $id);
        $this->session->set_flashdata('success', 'Pesanan berhasil dikonfirmasi!');
        redirect($this->session->userdata('role') . '/pesanan');
    }

    public function update_status() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        // Get current order status to prevent double stock deduction/restoration
        $order = $this->Admin_model->get_by_id('orders', $id);
        $old_status = $order['status'];
        
        if ($old_status === 'cancelled') {
            $this->session->set_flashdata('error', 'Pesanan yang telah dibatalkan oleh customer tidak dapat diubah statusnya.');
            redirect($this->session->userdata('role') . '/pesanan');
            return;
        }
        
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

        $data = array('status' => $status);
        $this->Admin_model->update('orders', $id, $data);
        
        $msg_suffix = '';
        if ($should_reduce) {
            $msg_suffix = ' (Stok dikurangi)';
        } elseif ($should_restore) {
            $msg_suffix = ' (Stok dikembalikan sebagai barang masuk)';
        }

        $this->Admin_model->log_activity('Mengubah status pesanan ID #' . $id . ' menjadi ' . $status . $msg_suffix);
        $this->session->set_flashdata('success', 'Status pesanan berhasil diupdate menjadi ' . strtoupper($status) . '!' . ($should_reduce ? ' Stok telah disesuaikan.' : ($should_restore ? ' Stok telah dikembalikan.' : '')));
        redirect($this->session->userdata('role') . '/pesanan');
    }

    public function complete($id) {
        // Get current order status to prevent double stock deduction
        $order = $this->Admin_model->get_by_id('orders', $id);
        $old_status = $order['status'];
        
        if ($old_status === 'cancelled') {
            $this->session->set_flashdata('error', 'Pesanan yang telah dibatalkan oleh customer tidak dapat diselesaikan.');
            redirect($this->session->userdata('role') . '/pesanan');
            return;
        }
        
        $cancelled_statuses = array('cancelled', 'batal', 'failed');
        $is_old_cancelled = in_array(strtolower($old_status), $cancelled_statuses);
        
        // If moving from a cancelled status back to completed, we should reduce stock.
        // Otherwise, it was already reduced at checkout, so do not reduce again.
        $should_reduce = $is_old_cancelled;
        
        if ($should_reduce) {
            $this->Admin_model->reduce_stock($id, 'Pesanan Selesai (Order ID: #' . $id . ')');
        }

        $data = array('status' => 'completed');
        $this->Admin_model->update('orders', $id, $data);
        $this->Admin_model->log_activity('Menyelesaikan pesanan ID #' . $id . ($should_reduce ? ' (Stok dikurangi)' : ''));
        $this->session->set_flashdata('success', 'Pesanan ditandai sebagai selesai!' . ($should_reduce ? ' Stok telah disesuaikan.' : ''));
        redirect($this->session->userdata('role') . '/pesanan');
    }

    public function delete($id) {
        $order = $this->Admin_model->get_by_id('orders', $id);
        if ($order) {
            $cancelled_statuses = array('cancelled', 'batal', 'failed');
            if (!in_array(strtolower($order['status']), $cancelled_statuses)) {
                $this->Admin_model->restore_stock($id, 'Penghapusan Pesanan (Order ID: #' . $id . ')');
            }
        }

        $this->Admin_model->delete('orders', $id);
        $this->Admin_model->log_activity('Menghapus pesanan ID #' . $id);
        $this->session->set_flashdata('success', 'Pesanan berhasil dihapus!');
        redirect($this->session->userdata('role') . '/pesanan');
    }

    public function detail($id) {
        $items = $this->Admin_model->get_order_details($id);
        echo json_encode($items);
    }
}
