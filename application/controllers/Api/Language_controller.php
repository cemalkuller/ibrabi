<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all languages
     */
    public function languages()
    {
        header('Content-Type: application/json;charset=utf-8');
        $languages = $this->language_model->get_languages();
        echo json_encode($languages);
    }
}
