<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->auth_user->id;
        header('Content-Type: application/json;charset=utf-8');
    }

    /**
     * Get Sub Categories By Parent Id
     */
    public function get_subcategories_by_parent_id($parent_id, $lang_id)
    {
        $categories = $this->category_model->get_subcategories_by_parent_id_by_lang($parent_id, $lang_id);
        echo json_encode($categories);
    }
}
