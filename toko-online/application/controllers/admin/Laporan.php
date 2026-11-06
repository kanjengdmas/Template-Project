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
        
        // Statistics
        $data['total_revenue'] = $this->db->select_sum('total_amount')->get_where('orders', array('status' => 'completed'))->row()->total_amount;
        $data['total_transactions'] = $this->db->count_all_results('orders');
        
        // Top Products
        $data['top_products'] = $this->db->select('products.name, SUM(order_items.quantity) as total_sold')
                                         ->from('order_items')
                                         ->join('products', 'products.id = order_items.product_id')
                                         ->group_by('product_id')
                                         ->order_by('total_sold', 'DESC')
                                         ->limit(5)
                                         ->get()->result_array();

        // Sales Data for Chart (Monthly for Current Year)
        $data['chart_data'] = $this->db->select('MONTH(order_date) as month, SUM(total_amount) as total')
                                       ->from('orders')
                                       ->where('status', 'completed')
                                       ->where('YEAR(order_date)', date('Y'))
                                       ->group_by('month')
                                       ->order_by('month', 'ASC')
                                       ->get()->result_array();

        // Process data to ensure all 12 months are present
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $final_chart_data = [];
        foreach ($months as $key => $name) {
            $month_num = $key + 1;
            $found = false;
            foreach ($data['chart_data'] as $row) {
                if ($row['month'] == $month_num) {
                    $final_chart_data[] = ['label' => $name, 'total' => (int)$row['total']];
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $final_chart_data[] = ['label' => $name, 'total' => 0];
            }
        }
        $data['chart_data'] = $final_chart_data;

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/laporan', $data);
        $this->load->view('admin/templates/footer');
    }
}
