<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    // Generic CRUD
    public function get_all($table) {
        return $this->db->get($table)->result_array();
    }

    public function get_by_id($table, $id) {
        return $this->db->get_where($table, array('id' => $id))->row_array();
    }

    public function insert($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function log_activity($activity) {
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'user_fullname' => $this->session->userdata('fullname'),
            'activity' => $activity
        );
        return $this->db->insert('activity_logs', $data);
    }

    public function update($table, $id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($table, $data);
    }

    public function delete($table, $id) {
        $this->db->where('id', $id);
        return $this->db->delete($table);
    }

    // Specialized queries
    public function get_orders_with_user($limit = null) {
        $this->db->select('orders.*, users.fullname, products.name as product_name, products.image as product_image');
        $this->db->from('orders');
        $this->db->join('users', 'users.id = orders.user_id');
        $this->db->join('order_items', 'order_items.order_id = orders.id', 'left');
        $this->db->join('products', 'products.id = order_items.product_id', 'left');
        $this->db->group_by('orders.id');
        $this->db->order_by('orders.order_date', 'DESC');
        if ($limit) {
            $this->db->limit($limit);
        }
        return $this->db->get()->result_array();
    }

    public function get_order_details($order_id) {
        $this->db->select('order_items.*, products.name as product_name');
        $this->db->from('order_items');
        $this->db->join('products', 'products.id = order_items.product_id');
        $this->db->where('order_id', $order_id);
        return $this->db->get()->result_array();
    }

    public function reduce_stock($order_id, $description = null) {
        $items = $this->get_order_details($order_id);
        foreach ($items as $item) {
            $product_id = $item['product_id'];
            $qty = $item['quantity'];
            
            // Decrease stock
            $this->db->set('stock', 'stock - ' . $qty, FALSE);
            $this->db->where('id', $product_id);
            $this->db->update('products');
            
            // Log Stock Activity
            $log_data = array(
                'product_id' => $product_id,
                'type' => 'keluar',
                'quantity' => $qty,
                'description' => $description ? $description : 'Pesanan Selesai/Dikirim (Order ID: #' . $order_id . ')'
            );
            $this->db->insert('stock_logs', $log_data);
        }
    }

    public function restore_stock($order_id, $description = null) {
        $items = $this->get_order_details($order_id);
        foreach ($items as $item) {
            $product_id = $item['product_id'];
            $qty = $item['quantity'];
            
            // Increase stock
            $this->db->set('stock', 'stock + ' . $qty, FALSE);
            $this->db->where('id', $product_id);
            $this->db->update('products');
            
            // Log Stock Activity
            $log_data = array(
                'product_id' => $product_id,
                'type' => 'masuk',
                'quantity' => $qty,
                'description' => $description ? $description : 'Pembatalan/Restorasi Pesanan (Order ID: #' . $order_id . ')'
            );
            $this->db->insert('stock_logs', $log_data);
        }
    }
}
