<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_controller extends Home_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->auth_user->id;
        header('Content-Type: application/json;charset=utf-8');
    }

    /**
     * Orders
     */
    public function orders()
    {
        $orders = $this->order_model->get_completed_orders_by_user($this->user_id);
        echo json_encode($orders);
    }

    /**
     * Order
     */
    public function order($id)
    {
        $orders = $this->order_model->get_order_by_order_number($id);
        echo json_encode($orders);
    }

    /**
     * Order Products
     */
    public function order_products($order_id)
    {
        $order_products = $this->order_model->get_order_products($order_id);
        echo json_encode($order_products);
    }

    /**
     * Completed Orders
     */
    public function completed_orders()
    {
        $completed_orders = $this->api_model->get_completed_orders($this->user_id);
        echo json_encode($completed_orders);
    }
}
