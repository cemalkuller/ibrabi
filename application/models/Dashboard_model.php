<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
	//get orders
    public function get_orders($user_id)
    {
        //$user_id = clean_number($user_id);
        $this->db->join('order_products', 'order_products.order_id = orders.id');
        $this->db->select('orders.*');
        $this->db->group_by('orders.id');
        $this->db->where('order_products.seller_id', $user_id);
        $this->db->where('order_products.order_status !=', 'completed');
        $this->db->order_by('orders.created_at', 'DESC');
        $query = $this->db->get('orders');
        return $query->result();
    }

    //get completed orders
    public function get_completed_orders($user_id)
    {
        //$user_id = clean_number($user_id);
        $this->db->join('order_products', 'order_products.order_id = orders.id');
        $this->db->select('orders.*');
        $this->db->group_by('orders.id');
        $this->db->where('order_products.seller_id', $user_id);
        $this->db->where('order_products.order_status', 'completed');
        $this->db->order_by('orders.created_at', 'DESC');
        $query = $this->db->get('orders');
        return $query->result();
    }

    //get completed orders
    public function get_canceled_orders($user_id)
    {
        //$user_id = clean_number($user_id);
        $this->db->join('order_products', 'order_products.order_id = orders.id');
        $this->db->select('orders.*');
        $this->db->group_by('orders.id');
        $this->db->where('order_products.seller_id', $user_id);
        $this->db->where('orders.status', 2);
        $this->db->order_by('orders.created_at', 'DESC');
        $query = $this->db->get('orders');
        return $query->result();
    }

    //update shop settings
    public function update_shop_settings()
    {
        $user_id = $this->auth_user->id;
        $data = array(
            'shop_name' => remove_special_characters($this->input->post('shop_name', true)),
            'about_me' => $this->input->post('about_me', true),
            'store_category' => $this->input->post('store_category', true),
            'email' => $this->input->post('email', true),
            'phone_number' => $this->input->post('phone_number', true),
            'first_name' => $this->input->post('first_name', true),
            'last_name' => $this->input->post('last_name', true),
            'address' => $this->input->post('address', true)
        );

        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }

    //get paginated user reviews
    public function get_user_reviews_orders()
    {
        $user_id = $this->auth_user->id;
        $this->db->join('users', 'users.id = reviews.user_id');
        $this->db->join('products', 'products.id = reviews.product_id');
        $this->db->select('reviews.*, users.username as user_username, users.slug as user_slug');
        $this->db->where('products.user_id', clean_number($user_id));
        $this->db->order_by('reviews.created_at', 'DESC');
        $query = $this->db->get('reviews');
        return $query->result();
    }

    //get campaigns
    public function get_campaigns()
    {
        
    }

    //get trendyol products
    public function get_trendyol_products()
    {
        $user_id = $this->auth_user->id;
        $this->db->where('user_id', $user_id);
        $this->db->where('code is NOT NULL', NULL, FALSE);
        $query = $this->db->get('products');
        return $query->result();
    }

    //get count Trendyol products
    public function get_count_trendyol_products()
    {
        $user_id = $this->auth_user->id;
        $this->db->where('user_id', $user_id);
        $this->db->where('code is NOT NULL', NULL, FALSE);
        $query = $this->db->get('products');
        return count($query->result());
    }

    //Get Trendyol Information
    public function trendyol()
    {
        $user_id = $this->auth_user->id;
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        return $query->row();
    }

    //update shop settings
    public function trendyol_post()
    {
        $user_id = $this->auth_user->id;
        $data = array(
            'trendyol_api_key' => $this->input->post('trendyol_api_key', true),
            'trendyol_api_secret' => $this->input->post('trendyol_api_secret', true),
            'supplier_id' => $this->input->post('supplier_id', true)
        );

        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }

    //get orders count
    public function get_vendor_orders_count($user_id)
    {
        $user_id = clean_number($user_id);
        $this->db->join('order_products', 'order_products.order_id = orders.id');
        $this->db->where('seller_id', $user_id);
        $this->db->where('status', 0);
        $query = $this->db->get('orders');
        return $query->num_rows();
    }

    //get completed orders count
    public function get_vendor_completed_orders_count($user_id)
    {
        $user_id = clean_number($user_id);
        $this->db->join('order_products', 'order_products.order_id = orders.id');
        $this->db->where('seller_id', $user_id);
        $this->db->where('status', 1);
        $query = $this->db->get('orders');
        return $query->num_rows();
    }

}
