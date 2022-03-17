<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Main banner
     */
    public function main_banners()
    {
        header('Content-Type: application/json;charset=utf-8');
        $main_banners = $this->banner_model->get_banner_items(1);
        echo json_encode($main_banners);
    }

    /*
    * Sidebar Banner
    */
    public function sidebar_banners()
    {
        header('Content-Type: application/json;charset=utf-8');
        $sidebar_banners = $this->banner_model->get_banner_items(2);
        echo json_encode($sidebar_banners);
    }

    /**
     * Brands
     */
    public function brands()
    {
        header('Content-Type: application/json;charset=utf-8');
        $brands = $this->banner_model->get_banner_items(3);
        echo json_encode($brands);
    }

    /**
     * Brand
     */
    public function brand($id)
    {
        header('Content-Type: application/json;charset=utf-8');
        $brand = $this->banner_model->get_banner_item($id);
        echo json_encode($brand);
    }
}
