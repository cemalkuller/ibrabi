<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_admin_controller extends Admin_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        //check user
        if (!is_admin()) {
            redirect(admin_url() . 'login');
        }
    }

    /**
     * Brands
     */
    public function brands()
    {
        $data['title'] = 'Markalar';
        $data['brands'] = $this->brand_model->get_brands();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/brands/brands', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Brand Post
     */
    public function add_brand_post()
    {
        if ($this->brand_model->add_brand()) { 
            $this->session->set_flashdata('success_form', trans("msg_slider_added"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error_form', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Update Brand
     */
    public function update_brand($id)
    {
        $data['title'] = 'Marka Düzenle';
        //get brand
        $data['item'] = $this->brand_model->get_brand_item($id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/brands/update_brand', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Slider Item Post
     */
    public function update_brand_post()
    {
        //item id
        $id = $this->input->post('id', true);
        if ($this->brand_model->update_brand($id)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Delete Slider Item Post
     */
    public function delete_brand_post()
    {
        $id = $this->input->post('id', true);
        if ($this->banner_model->delete_brand_post($id)) {
            $this->session->set_flashdata('success', 'Marka başarıyla silindi.');
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }
}
