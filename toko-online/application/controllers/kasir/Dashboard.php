<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') !== 'kasir') {
            redirect('auth');
        }
        $this->load->model('Admin_model');
    }

    public function index() {
        $data['role'] = $this->session->userdata('role');
        $data['dashboard_url'] = base_url($data['role'] . '/dashboard');
        
        // Stats
        $data['total_products'] = $this->db->count_all('products');
        $data['total_users'] = $this->db->where('role', 'customer')->count_all_results('users');
        $data['total_orders'] = $this->db->count_all('orders');
        $data['total_services'] = $this->db->count_all('services');
        
        // Recent Orders
        $data['recent_orders'] = $this->Admin_model->get_orders_with_user(5);

        // Top Products
        $data['top_products'] = $this->db->select('products.name, products.price, products.image, SUM(order_items.quantity) as total_sold')
                                         ->from('order_items')
                                         ->join('products', 'products.id = order_items.product_id')
                                         ->group_by('product_id')
                                         ->order_by('total_sold', 'DESC')
                                         ->limit(4)
                                         ->get()->result_array();

        // Recent Activity
        $data['recent_activities'] = $this->db->order_by('created_at', 'DESC')
                                               ->limit(15)
                                               ->get('activity_logs')->result_array();

        // Popular Categories
        $data['popular_categories'] = $this->db->select('category as name, COUNT(*) as total')
                                               ->from('products')
                                               ->group_by('category')
                                               ->order_by('total', 'DESC')
                                               ->limit(3)
                                               ->get()->result_array();

        // Monthly Sales Data (Detail Grafik)
        $monthly_sales = $this->db->query("
            SELECT MONTH(order_date) as month, SUM(total_amount) as total 
            FROM orders 
            WHERE YEAR(order_date) = YEAR(CURDATE()) AND status = 'completed'
            GROUP BY MONTH(order_date)
        ")->result_array();

        $sales_data = array_fill(1, 12, 0);
        foreach ($monthly_sales as $ms) {
            $sales_data[(int)$ms['month']] = (float)$ms['total'];
        }
        $data['monthly_sales'] = array_values($sales_data);

        // Stock Logs (Barang Masuk/Keluar)
        $data['stock_logs'] = $this->db->select('stock_logs.*, products.name as product_name')
                                      ->from('stock_logs')
                                      ->join('products', 'products.id = stock_logs.product_id')
                                      ->order_by('stock_logs.created_at', 'DESC')
                                      ->limit(10)
                                      ->get()->result_array();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/templates/footer');
    }
}
