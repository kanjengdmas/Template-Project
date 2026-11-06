<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) redirect('auth');
        $this->load->model('Admin_model');
        $this->role = $this->session->userdata('role');
    }

    public function index() {
        $data['role'] = $this->role;
        $data['dashboard_url'] = base_url($this->role . '/dashboard');
        
        $data['total_revenue'] = $this->db->select_sum('total_amount')->get_where('orders', array('status' => 'completed'))->row()->total_amount;
        $data['total_transactions'] = $this->db->count_all_results('orders');
        
        $data['top_products'] = $this->db->select('products.name, SUM(order_items.quantity) as total_sold')
                                         ->from('order_items')
                                         ->join('products', 'products.id = order_items.product_id')
                                         ->group_by('product_id')
                                         ->order_by('total_sold', 'DESC')
                                         ->limit(5)
                                         ->get()->result_array();

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/laporan', $data);
        $this->load->view('admin/templates/footer');
    }
}
