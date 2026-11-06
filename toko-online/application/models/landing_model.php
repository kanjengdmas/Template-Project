<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing_model extends CI_Model {

    public function get_services() {
        return $this->db->get('services')->result_array();
    }

    public function get_products() {
        return $this->db->get('products')->result_array();
    }

    public function get_team() {
        return $this->db->get('team')->result_array();
    }

    public function get_store_info() {
        return $this->db->get_where('store_info', array('id' => 1))->row_array();
    }

    public function create_order($data) {
        $this->db->insert('orders', $data);
        return $this->db->insert_id();
    }

    public function insert_order_item($data) {
        return $this->db->insert('order_items', $data);
    }

    public function get_user_orders($user_id) {
        $this->db->select('orders.*, products.image as product_image');
        $this->db->from('orders');
        $this->db->join('order_items', 'order_items.order_id = orders.id', 'left');
        $this->db->join('products', 'products.id = order_items.product_id', 'left');
        $this->db->where('orders.user_id', $user_id);
        $this->db->group_by('orders.id');
        $this->db->order_by('order_date', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_order_by_id($id) {
        return $this->db->get_where('orders', array('id' => $id))->row_array();
    }
}
