<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('landing_model');
        $this->_clean_db();
    }

    private function _clean_db() {
        if ($this->db->table_exists('users') && $this->db->field_exists('fullname', 'users')) {
            $this->db->query("UPDATE users SET fullname = 'Customer' WHERE fullname LIKE '%dimas%rizqi%akbar%' OR fullname LIKE '%akbar%dimas%rizqi%'");
        }
        if ($this->db->table_exists('orders') && $this->db->field_exists('recipient_name', 'orders')) {
            $this->db->query("UPDATE orders SET recipient_name = 'Customer' WHERE recipient_name LIKE '%dimas%rizqi%akbar%' OR recipient_name LIKE '%akbar%dimas%rizqi%'");
        }
        if ($this->db->table_exists('activity_logs')) {
            if ($this->db->field_exists('user_fullname', 'activity_logs')) {
                $this->db->query("UPDATE activity_logs SET user_fullname = 'Customer' WHERE user_fullname LIKE '%dimas%rizqi%akbar%' OR user_fullname LIKE '%akbar%dimas%rizqi%'");
            }
            if ($this->db->field_exists('activity', 'activity_logs')) {
                $this->db->query("UPDATE activity_logs SET activity = REPLACE(REPLACE(activity, 'dimas rizqi akbar', 'Customer'), 'akbar dimas rizqi', 'Customer') WHERE activity LIKE '%dimas%rizqi%akbar%' OR activity LIKE '%akbar%dimas%rizqi%'");
            }
        }
        if ($this->db->table_exists('stock_logs') && $this->db->field_exists('description', 'stock_logs')) {
            $this->db->query("UPDATE stock_logs SET description = REPLACE(REPLACE(description, 'dimas rizqi akbar', 'Customer'), 'akbar dimas rizqi', 'Customer') WHERE description LIKE '%dimas%rizqi%akbar%' OR description LIKE '%akbar%dimas%rizqi%'");
        }
    }

    public function index() {
        $data['services'] = $this->landing_model->get_services();
        $data['products'] = $this->landing_model->get_products();
        $data['team'] = $this->landing_model->get_team();
        $data['store'] = $this->landing_model->get_store_info();
        
        $data['cart_count'] = $this->get_cart_count();
        
        $this->load->view('v_landing/index', $data);
    }

    public function produk() {
        $data['products'] = $this->landing_model->get_products();
        $data['store'] = $this->landing_model->get_store_info();
        $data['cart_count'] = $this->get_cart_count();
        $this->load->view('v_landing/produk_page', $data);
    }

    public function detail_produk($id) {
        $data['product'] = $this->db->get_where('products', array('id' => $id))->row_array();
        if (!$data['product']) redirect('landing');
        
        $data['store'] = $this->landing_model->get_store_info();
        $data['cart_count'] = $this->get_cart_count();
        $this->load->view('v_landing/detail_produk', $data);
    }

    public function layanan() {
        $data['services'] = $this->landing_model->get_services();
        $data['store'] = $this->landing_model->get_store_info();
        $data['cart_count'] = $this->get_cart_count();
        $this->load->view('v_landing/layanan_page', $data);
    }

    public function tim() {
        $data['team'] = $this->landing_model->get_team();
        $data['store'] = $this->landing_model->get_store_info();
        $data['cart_count'] = $this->get_cart_count();
        $this->load->view('v_landing/tim_page', $data);
    }

    public function kontak() {
        $data['store'] = $this->landing_model->get_store_info();
        $data['cart_count'] = $this->get_cart_count();
        $this->load->view('v_landing/kontak_page', $data);
    }

    public function tentang() {
        $data['store'] = $this->landing_model->get_store_info();
        $data['cart_count'] = $this->get_cart_count();
        $this->load->view('v_landing/tentang_page', $data);
    }

    // Cart Methods
    public function add_to_cart($product_id) {
        $product = $this->db->get_where('products', array('id' => $product_id))->row_array();
        if (!$product) redirect('landing');

        $cart = $this->session->userdata('cart') ? $this->session->userdata('cart') : array();
        
        if (isset($cart[$product_id])) {
            $cart[$product_id]['qty']++;
        } else {
            $cart[$product_id] = array(
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'qty' => 1
            );
        }

        $this->session->set_userdata('cart', $cart);
        $this->session->set_flashdata('success', 'Produk berhasil ditambah ke keranjang!');
        
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url('landing');
        redirect($referer);
    }

    public function buy_now($product_id) {
        $product = $this->db->get_where('products', array('id' => $product_id))->row_array();
        if (!$product) redirect('landing');

        // Clear cart and add only this item
        $cart = array();
        $cart[$product_id] = array(
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'image' => $product['image'],
            'qty' => 1
        );
        $this->session->set_userdata('cart', $cart);
        redirect('landing/checkout');
    }

    public function update_cart() {
        $cart = $this->session->userdata('cart');
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');

        if (isset($cart[$id])) {
            if ($qty <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['qty'] = $qty;
            }
        }
        $this->session->set_userdata('cart', $cart);
        redirect('landing/cart_view');
    }

    public function cart_view() {
        $data['cart'] = $this->session->userdata('cart') ? $this->session->userdata('cart') : array();
        $data['store'] = $this->landing_model->get_store_info();
        $this->load->view('v_landing/cart', $data);
    }

    public function checkout() {
        if (!$this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu untuk checkout.');
            redirect('auth');
        }

        $data['cart'] = $this->session->userdata('cart');
        if (empty($data['cart'])) redirect('landing');

        // Fetch user info for auto-filling shipping fields
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('users', array('id' => $user_id))->row_array();

        $data['store'] = $this->landing_model->get_store_info();
        $this->load->view('v_landing/checkout', $data);
    }

    public function process_checkout() {
        $user_id = $this->session->userdata('user_id');
        $cart = $this->session->userdata('cart');
        
        $recipient_name = $this->input->post('recipient_name');
        $phone_number = $this->input->post('phone_number');
        $address = $this->input->post('address');
        $payment_method = $this->input->post('payment_method');
        
        $payment_detail = '';
        if ($payment_method === 'transfer') {
            $payment_detail = $this->input->post('bank_name') . ' (' . $this->input->post('sender_account') . ')';
        } elseif ($payment_method === 'ewallet') {
            $payment_detail = $this->input->post('wallet_name') . ' (' . $this->input->post('sender_wallet') . ')';
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $order_data = array(
            'user_id' => $user_id,
            'recipient_name' => $recipient_name,
            'phone_number' => $phone_number,
            'address' => $address,
            'total_amount' => $total,
            'payment_method' => $payment_method,
            'payment_detail' => $payment_detail,
            'status' => 'pending'
        );

        $order_id = $this->landing_model->create_order($order_data);

        foreach ($cart as $item) {
            $item_data = array(
                'order_id' => $order_id,
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price']
            );
            $this->landing_model->insert_order_item($item_data);
        }

        // Reduce stock immediately from products table & log stock activity
        $this->load->model('Admin_model');
        $this->Admin_model->reduce_stock($order_id, 'Penjualan ke ' . $recipient_name . ' (Order ID: #' . $order_id . ')');

        $this->db->insert('activity_logs', [
            'user_id' => $user_id,
            'user_fullname' => $recipient_name,
            'activity' => 'Melakukan pesanan baru: Rp ' . number_format($total, 0, ',', '.')
        ]);

        $this->session->unset_userdata('cart');
        $this->session->set_flashdata('success', 'Pesanan berhasil dibuat! Silakan tunggu konfirmasi kasir.');
        redirect('landing/pesanan');
    }

    public function profil() {
        if (!$this->session->userdata('user_id')) redirect('auth');
        
        if ($this->input->post()) {
            $id = $this->session->userdata('user_id');
            $fullname = $this->input->post('fullname');
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');
            $password = $this->input->post('password');
            
            $update_data = array(
                'fullname' => $fullname,
                'username' => $username,
                'email' => $email,
                'phone' => $phone,
                'address' => $address
            );
            
            if (!empty($password)) {
                $update_data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
            
            // Update session userdata
            $this->session->set_userdata('fullname', $fullname);
            $this->session->set_userdata('username', $username);
            
            $this->db->where('id', $id);
            $this->db->update('users', $update_data);
            
            $this->session->set_flashdata('success', 'Profil Anda berhasil diperbarui!');
            redirect('landing/profil');
        }
        
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('users', array('id' => $user_id))->row_array();
        $data['store'] = $this->landing_model->get_store_info();
        $data['cart_count'] = $this->get_cart_count();
        
        $orders = $this->landing_model->get_user_orders($user_id);
        foreach ($orders as &$o) {
            $o['items'] = $this->db->select('order_items.*, products.name, products.image')
                                   ->from('order_items')
                                   ->join('products', 'products.id = order_items.product_id')
                                   ->where('order_id', $o['id'])
                                   ->get()->result_array();
        }
        $data['orders'] = $orders;
        $this->load->view('v_landing/profil', $data);
    }

    public function pesanan() {
        if (!$this->session->userdata('user_id')) redirect('auth');
        $orders = $this->landing_model->get_user_orders($this->session->userdata('user_id'));
        
        foreach ($orders as &$o) {
            $o['items'] = $this->db->select('order_items.*, products.name, products.image')
                                   ->from('order_items')
                                   ->join('products', 'products.id = order_items.product_id')
                                   ->where('order_id', $o['id'])
                                   ->get()->result_array();
        }
        
        $data['orders'] = $orders;
        $data['store'] = $this->landing_model->get_store_info();
        $data['cart_count'] = $this->get_cart_count();
        $this->load->view('v_landing/pesanan', $data);
    }

    public function nota($id) {
        $data['order'] = $this->landing_model->get_order_by_id($id);
        if ($data['order']['user_id'] != $this->session->userdata('user_id')) redirect('landing');
        
        $data['items'] = $this->db->select('order_items.*, products.name')
                                 ->from('order_items')
                                 ->join('products', 'products.id = order_items.product_id')
                                 ->where('order_id', $id)
                                 ->get()->result_array();
        $data['store'] = $this->landing_model->get_store_info();
        $this->load->view('v_landing/nota', $data);
    }

    public function upload_avatar() {
        if (!$this->session->userdata('user_id')) redirect('auth');
        
        $config['upload_path']   = './assets/uploads/avatars/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 2048; // 2MB
        $config['file_name']     = 'avatar_' . $this->session->userdata('user_id') . '_' . time();
        
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }
        
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('avatar')) {
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            
            // Delete old avatar if exists
            $user_id = $this->session->userdata('user_id');
            $old_user = $this->db->get_where('users', array('id' => $user_id))->row_array();
            if (!empty($old_user['image']) && file_exists('./assets/uploads/avatars/' . $old_user['image'])) {
                @unlink('./assets/uploads/avatars/' . $old_user['image']);
            }
            
            // Save new avatar to db
            $this->db->where('id', $user_id);
            $this->db->update('users', array('image' => $file_name));
            
            // Save avatar to session
            $this->session->set_userdata('user_image', $file_name);
            
            $this->session->set_flashdata('success', 'Foto profil berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengunggah foto: ' . $this->upload->display_errors('', ''));
        }
        
        redirect('landing/profil');
    }

    public function cancel_order($id = null) {
        if (!$this->session->userdata('user_id')) redirect('auth');
        
        $order_id = $id ? $id : $this->input->post('order_id');
        if (!$order_id) {
            $this->session->set_flashdata('error', 'ID Pesanan tidak valid.');
            redirect('landing/pesanan');
        }
        
        $order = $this->landing_model->get_order_by_id($order_id);
        if (!$order) {
            $this->session->set_flashdata('error', 'Pesanan tidak ditemukan.');
            redirect('landing/pesanan');
        }
        
        // Ensure the order belongs to the logged-in user
        if ($order['user_id'] != $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Akses ditolak.');
            redirect('landing/pesanan');
        }
        
        // Only pending orders can be cancelled
        if (strtolower($order['status']) !== 'pending') {
            $this->session->set_flashdata('error', 'Hanya pesanan pending yang dapat dibatalkan.');
            redirect('landing/pesanan');
        }
        
        // Retrieve cancellation reason
        $reason = $this->input->post('reason');
        if ($reason === 'Lainnya') {
            $reason = $this->input->post('custom_reason');
        }
        if (empty($reason)) {
            $reason = 'Tidak disebutkan';
        }
        
        // Update order status to cancelled
        $this->db->where('id', $order_id);
        $this->db->update('orders', array('status' => 'cancelled'));
        
        // Restore stock immediately and log activity
        $this->load->model('Admin_model');
        $this->Admin_model->restore_stock($order_id, 'Pembatalan Pesanan #' . $order_id . ' (Alasan: ' . $reason . ')');
        
        // Log user activity
        $this->db->insert('activity_logs', [
            'user_id' => $this->session->userdata('user_id'),
            'user_fullname' => $this->session->userdata('fullname'),
            'activity' => 'Membatalkan pesanan #' . $order_id . ' (Alasan: ' . $reason . ')'
        ]);
        
        $this->session->set_flashdata('success', 'Pesanan berhasil dibatalkan.');
        redirect('landing/pesanan');
    }

    private function get_cart_count() {
        $cart = $this->session->userdata('cart');
        if (!$cart) return 0;
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['qty'];
        }
        return $count;
    }
}
