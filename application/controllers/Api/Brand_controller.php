<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_controller extends Home_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->auth_user->id;
        header('Content-Type: application/json;charset=utf-8');
    }

    /**
     * Brands
     */
    public function brands()
    {
        $brands = $this->brand_model->get_brands();
        echo json_encode($brands);
    }

    /**
     * Get Brand Products
     */
    public function get_brand_products($brand_id)
    {
        $brands = $this->brand_model->get_brand_products($brand_id);
        echo json_encode($brands);
    }

}