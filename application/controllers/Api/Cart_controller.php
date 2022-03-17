<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_controller extends Home_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->auth_user->id;
        header('Content-Type: application/json;charset=utf-8');
    }

    /**
     * Cart
     */
    public function cart()
    {
        //$data['cart_items'] = $this->cart_model->get_sess_cart_items();
        //$data['cart_total'] = $this->cart_model->get_sess_cart_total();
        //$data['cart_has_physical_product'] = $this->cart_model->check_cart_has_physical_product();
        
        $cart_items = $this->cart_model->get_sess_cart_items();
        echo json_encode($cart_items);
    }

    /**
     * Add to Cart
     */
    public function add_to_cart($product_id)
    {
        $product = $this->product_model->get_product_by_id($product_id);
        $this->cart_model->add_to_cart($product);
        //get cart items
        $cart_items = $this->cart_model->get_sess_cart_items();
        echo json_encode($cart_items);
        echo 'Başarıyla sepete eklenmiştir.';
    }

    /**
     * Remove from Cart
     */
    public function remove_from_cart($cart_item_id)
    {
        $cart_item_id = $this->input->post('cart_item_id', true);
        $this->cart_model->remove_from_cart($cart_item_id);
        echo 'Ürün başarıyla sepetten çıkarılmıştır.';
    }
}