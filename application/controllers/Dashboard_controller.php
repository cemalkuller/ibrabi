<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends Home_Core_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->auth_check) {
            redirect(lang_base_url());
        }
        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }
        $this->user_id = $this->auth_user->id;
        $this->earnings_per_page = 15;
    }

    /**
     * Dashboard
     */
    public function dashboard()
    {
        
        $data['active_sales_count'] = $this->order_admin_model->get_active_sales_count_by_seller($this->auth_user->id);
        $data['completed_sales_count'] = $this->order_admin_model->get_completed_sales_count_by_seller($this->auth_user->id);
        $data['total_sales_count'] = $data['active_sales_count'] + $data['completed_sales_count'];
        

        $data["user"] = $this->auth_model->get_user($this->auth_user->id);

        $this->load->view('dashboard/partials/_header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('dashboard/partials/_footer');
    }

    /**
     * Products
     */
    public function products()
    {
        $data['products'] = $this->product_model->get_user_products_all();
        $this->load->view('dashboard/partials/_header', $data);
        $this->load->view('dashboard/products', $data);
        $this->load->view('dashboard/partials/_footer');
    }

    /**
     * Products
     */
    public function add_product()
    {
        //check auth
        if (!$this->auth_check) {
            redirect(lang_base_url());
        }
        if (!is_user_vendor()) {
            redirect(generate_url("start_selling"));
        }
        if ($this->general_settings->email_verification == 1 && $this->auth_user->email_status != 1) {
            $this->session->set_flashdata('error', trans("msg_confirmed_required"));
            redirect(generate_url("settings", "update_profile"));
        }

        $data['title'] = trans("sell_now");
        $data['description'] = trans("sell_now") . " - " . $this->app_name;
        $data['keywords'] = trans("sell_now") . "," . $this->app_name;

        $data['modesy_images'] = $this->file_model->get_sess_product_images_array();
        $data["file_manager_images"] = $this->file_model->get_user_file_manager_images();
        //$data["active_product_system_array"] = $this->get_activated_product_system();
        $data['index_settings'] = $this->settings_model->get_index_settings();

        $this->load->view('dashboard/partials/_header', $data);
        $this->load->view('dashboard/add_product', $data);
        $this->load->view('dashboard/partials/_footer');
    }

     /**
     * Products
     */
    public function edit_product($id)
    {
        //check auth
        if (!$this->auth_check) {
            redirect(lang_base_url());
        }
        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }
        $data["product"] = $this->product_admin_model->get_product($id);
        if (empty($data["product"])) {
            redirect($this->agent->referrer());
        }
        if ($data["product"]->is_deleted == 1) {
            if ($this->auth_user->role != "admin") {
                redirect($this->agent->referrer());
            }
        }
        if ($data["product"]->user_id != $this->auth_user->id && $this->auth_user->role != "admin") {
            redirect($this->agent->referrer());
        }

        $data['category'] = $this->category_model->get_category($data["product"]->category_id);
        $data['parent_categories_array'] = $this->category_model->get_parent_categories_array_by_category_id($data["product"]->category_id);
        $data['modesy_images'] = $this->file_model->get_product_images_uncached($data["product"]->id);
        $data['all_categories'] = $this->category_model->get_categories_ordered_by_name();
        $data["file_manager_images"] = $this->file_model->get_user_file_manager_images();
        //$data["active_product_system_array"] = $this->get_activated_product_system();
        $data['index_settings'] = $this->settings_model->get_index_settings();

        $this->load->view('dashboard/partials/_header', $data);
        $this->load->view('dashboard/edit_product', $data);
        $this->load->view('dashboard/partials/_footer');
    }


    /**
     * Edit Product Post
     */
    public function edit_product_post()
    {
        //check auth
        if (!$this->auth_check) {
            redirect(lang_base_url());
        }
        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }
        
        //validate inputs
        $this->form_validation->set_rules('title', trans("title"), 'required|xss_clean|max_length[500]');

        
        if ($this->form_validation->run() === false) {
            
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            
            //product id
            $product_id = $this->input->post('id', true);
            //user id
            $user_id = 0;
            $product = $this->product_admin_model->get_product($product_id);
            if (!empty($product)) {
                $user_id = $product->user_id;
            }
            if ($product->user_id != $this->auth_user->id && $this->auth_user->role != "admin") {
                redirect($this->agent->referrer());
            }

            if ($this->product_model->edit_product($product)) {
                //edit slug
                $this->product_model->update_slug($product_id);

                if ($product->is_draft == 1) {
                    redirect(generate_url("sell_now", "product_details") . '/' . $product_id);
                } else {
                    //reset cache
                    reset_cache_data_on_change();
                    reset_user_cache_data($user_id);
                    reset_product_img_cache_data($product_id);

                    $this->session->set_flashdata('success', trans("msg_updated"));
                    redirect($this->agent->referrer());
                }
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Edit Product Details
     */
    public function edit_product_details($id)
    {
        //check auth
        if (!$this->auth_check) {
            redirect(lang_base_url());
        }
        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }
        if ($this->general_settings->email_verification == 1 && $this->auth_user->email_status != 1) {
            $this->session->set_flashdata('error', trans("msg_confirmed_required"));
            redirect(generate_url("settings", "update_profile"));
        }

        $data['product'] = $this->product_admin_model->get_product($id);
        if (empty($data['product'])) {
            redirect($this->agent->referrer());
        }
        if ($this->auth_user->role != 'admin' && $this->auth_user->id != $data['product']->user_id) {
            redirect($this->agent->referrer());
            exit();
        }

        if ($data['product']->is_draft == 1) {
            $data['title'] = trans("sell_now");
            $data['description'] = trans("sell_now") . " - " . $this->app_name;
            $data['keywords'] = trans("sell_now") . "," . $this->app_name;
        } else {
            $data['title'] = trans("edit_product");
            $data['description'] = trans("edit_product") . " - " . $this->app_name;
            $data['keywords'] = trans("edit_product") . "," . $this->app_name;
        }

        if ($data["product"]->country_id == 0) {
            $data["states"] = $this->location_model->get_states_by_country($this->auth_user->country_id);
        } else {
            $data["states"] = $this->location_model->get_states_by_country($data["product"]->country_id);
        }
        if ($data["product"]->country_id == 0) {
            $data["cities"] = $this->location_model->get_cities_by_state($this->auth_user->state_id);
        } else {
            $data["cities"] = $this->location_model->get_cities_by_state($data["product"]->state_id);
        }

        $data["custom_field_array"] = $this->field_model->generate_custom_fields_array($data["product"]->category_id, $data["product"]->id);
        $data["product_variations"] = $this->variation_model->get_product_variations($data["product"]->id);
        $data["user_variations"] = $this->variation_model->get_variation_by_user_id($data["product"]->user_id);
        $data['form_settings'] = $this->settings_model->get_form_settings();
        $data['license_keys'] = $this->product_model->get_license_keys($data["product"]->id);
        $data['brands'] = $this->brand_model->get_brands();

        $this->load->view('dashboard/partials/_header', $data);
        $this->load->view('dashboard/edit_product_details');
        $this->load->view('dashboard/partials/_footer');
    }

    /**
     * Edit Product Details Post
     */
    public function edit_product_details_post()
    {
        //check auth
        if (!$this->auth_check) {
            redirect(lang_base_url());
        }
        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }
        $product_id = $this->input->post('id', true);
        $product = $this->product_admin_model->get_product($product_id);
        if (empty($product)) {
            redirect($this->agent->referrer());
            exit();
        }
        if ($this->auth_user->role != 'admin' && $this->auth_user->id != $product->user_id) {
            redirect($this->agent->referrer());
            exit();
        }

        if ($this->product_model->edit_product_details($product_id)) {
            //edit custom fields
            $this->product_model->update_product_custom_fields($product_id);

            //reset cache
            reset_cache_data_on_change();
            reset_user_cache_data($this->auth_user->id);

            if ($product->is_draft != 1) {
                $this->session->set_flashdata('success', trans("msg_updated"));
                redirect($this->agent->referrer());
            } else {
                //send email
                if ($this->general_settings->send_email_new_product == 1) {
                    $email_data = array(
                        'email_type' => 'new_product',
                        'product_id' => $product->id
                    );
                    $this->session->set_userdata('mds_send_email_data', json_encode($email_data));
                }

                //if draft
                if ($this->input->post('submit', true) == 'save_as_draft') {
                    redirect(generate_url("drafts"));
                    exit();
                }
                if ($this->general_settings->promoted_products == 1) {
                    redirect(generate_url("promote_product", "pricing") . "/" . $product_id . "?type=new");
                } else {
                    redirect(generate_product_url($product));
                }
            }
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Orders
     */
    public function orders()
    {
        $data['title'] = 'DEVAM EDEN SİPARİŞLER';
        $data['description'] = trans("sales") . " - " . $this->app_name;
        $data['keywords'] = trans("sales") . "," . $this->app_name;
        $data["active_tab"] = "active_sales";
        $data['orders'] = $this->dashboard_model->get_orders($this->user_id);
        $data['index_settings'] = $this->settings_model->get_index_settings();

        $this->load->view('dashboard/partials/_header', $data);
        $this->load->view('dashboard/orders', $data);
        $this->load->view('dashboard/partials/_footer');
    }


     /**
     * Orders
     */
    public function completed_orders()
    {
        $data['title'] = 'TAMAMLANAN SİPARİŞLER';
        $data['description'] = trans("sales") . " - " . $this->app_name;
        $data['keywords'] = trans("sales") . "," . $this->app_name;
        $data["active_tab"] = "active_sales";
        $data['orders'] = $this->dashboard_model->get_completed_orders($this->user_id);
        $data['index_settings'] = $this->settings_model->get_index_settings();

        $this->load->view('dashboard/partials/_header', $data);
        $this->load->view('dashboard/completed_orders', $data);
        $this->load->view('dashboard/partials/_footer');
    }

    /**
     * Orders
     */
    public function canceled_orders()
    {
        $data['title'] = 'İPTAL EDİLEN SİPARİŞLER';
        $data['description'] = trans("sales") . " - " . $this->app_name;
        $data['keywords'] = trans("sales") . "," . $this->app_name;
        $data["active_tab"] = "active_sales";
        $data['orders'] = $this->dashboard_model->get_canceled_orders($this->user_id);
        $data['index_settings'] = $this->settings_model->get_index_settings();

        $this->load->view('dashboard/partials/_header', $data);
        $this->load->view('dashboard/canceled_orders', $data);
        $this->load->view('dashboard/partials/_footer');
    }

    /**
     * Order Details
     */
    public function order_details($order_number)
    {
        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }

        $data['title'] = trans("sales");
        $data['description'] = trans("sales") . " - " . $this->app_name;
        $data['keywords'] = trans("sales") . "," . $this->app_name;
        $data["active_tab"] = "";
        $data["order"] = $this->order_model->get_order_by_order_number($order_number);
        if (empty($data["order"])) {
            //redirect(lang_base_url());
        }
        if (!$this->order_model->check_order_seller($data["order"]->id)) {
            //redirect(lang_base_url());
        }
        $data["order_products"] = $this->order_model->get_order_products($data["order"]->id);
        $data['index_settings'] = $this->settings_model->get_index_settings();

        $this->load->view('dashboard/partials/_header', $data);
        $this->load->view('dashboard/order_details', $data);
        $this->load->view('dashboard/partials/_footer');
    }


    /**
     * Upload Product
     */
    public function upload_product()
    {
        $this->load->view('dashboard/partials/_header', $data);
        $this->load->view('dashboard/upload_product', $data);
        $this->load->view('dashboard/partials/_footer');
    }

    /**
     * Bulk product upload
     */
    public function bulk_product_upload()
	{
        $path = 'uploads/';
        $this->load->library('Excel');
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->load->model('import_model');
        $this->upload->initialize($config);

        if ($this->upload->do_upload('uploadFile'))
        {
            $data = array('upload_data' => $this->upload->data());
            if (!empty($data['upload_data']['file_name']))
            {
                $import_xls_file = $data['upload_data']['file_name'];
            }else{
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;
            try
            {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
                $i=0;
                foreach ($allDataInSheet as $value) {
                    if($flag){
                        $flag = false;
                        continue;
                    }
                    $inserdata['title'] = $value['A'];
                    $inserdata['description'] = $value['B'];
                    $inserdata['price'] = $value['C'];
                    $inserdata['currency'] = $value['D'];
                    $inserdata['stock'] = $value['E'];
                    $inserdata['barcode'] = $value['F'];
                    $inserdata['code'] = $value['G'];
                    $inserdata['image'] = $value['H'];
                    $product_id = $this->import_model->import_data($inserdata);
                    $i++;
                    $this->upload_product_image_by_link($inserdata['image'], $product_id);
                }
            } catch (Exception $e)
            {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME). '": ' .$e->getMessage());
            }
            }
        /*$this->load->view('dashboard/partials/_header', $data);
        $this->load->view('dashboard/upload_product_preview', $data);
        $this->load->view('dashboard/partials/_footer');*/
        $this->session->set_flashdata('success', 'Ürünler başarıyla içe aktarıldı.');
        redirect(generate_url("dashboard", "/products"));
    }

    /**
     * Bulk product upload preview
     */
    public function bulk_product_upload_preview()
    {

    }

    /**
     * Upload product image
     */
    public function upload_product_image_by_link($url, $product_id)
    {
        $url = explode(',', $url);
        $i = 0;
        foreach($url as $value)
        {
            //echo $value.'<br>';
            // Resim Yolu(Kayıt yolu)
            $new_name = 'img_x500_' . generate_unique_id() . '.jpg';
            $img = 'uploads/images/'. $new_name;
            // Resmi Kaydet 
            $ch = curl_init($value);
            $fp = fopen($img, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);

            if($i == 0){
                $data['is_main'] = 1;
            }else{
                $data['is_main'] = 0;
            }
            $data['product_id'] = $product_id;
            $data['image_default'] = $new_name;
            $data['image_big'] = $new_name;
            $data['image_small'] = $new_name;
            $this->db->insert('images', $data);
            $i++;
        }
    }

    /**
     * Shop Settings
     */
    public function shop_settings()
    {
        $data["user"] = $this->auth_user;
        $this->load->view('dashboard/partials/_header', $data);
        $this->load->view('dashboard/shop_settings', $data);
        $this->load->view('dashboard/partials/_footer');
    }

    /**
     * Shop Settings Post
     */
    public function shop_settings_post()
    {
        //check user
        if (!$this->auth_check) {
            redirect(lang_base_url());
        }
        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }
        if ($this->dashboard_model->update_shop_settings()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Earnings
     */
    public function earnings()
    {
        $data["user"] = $this->auth_user;
        $pagination = $this->paginate(generate_url("earnings"), $this->earnings_model->get_earnings_count($this->user_id), $this->earnings_per_page);
        $data['earnings'] = $this->earnings_model->get_paginated_earnings($this->user_id, $pagination['per_page'], $pagination['offset']);
        
        $this->load->view('dashboard/partials/_header', $data);
        $this->load->view('dashboard/earnings', $data);
        $this->load->view('dashboard/partials/_footer');
    }

    /**
     * Set Payout Account
     */
    public function set_payout_account()
    {
        $data['title'] = trans("set_payout_account");
        $data['user'] = $this->auth_user;
        $data['current_user_session'] = get_user_session();
        $data['user_payout'] = $this->earnings_model->get_user_payout_account($data['user']->id);

        if (empty($this->session->flashdata('msg_payout'))) {
            $this->session->set_flashdata('msg_payout', "iban");
        }

        $this->load->view('dashboard/partials/_header', $data);
        $this->load->view('dashboard/set_payout_account', $data);
        $this->load->view('dashboard/partials/_footer');
    }

    /**
     * Set IBAN Payout Account Post
     */
    public function set_iban_payout_account_post()
    {
        if ($this->earnings_model->set_iban_payout_account($this->user_id)) {
            $this->session->set_flashdata('msg_payout', "iban");
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('msg_payout', "iban");
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }

    /**
     * Campaigns
     */
    public function campaigns()
    {
        $data['title'] = 'Kampanyalar';
        $data['current_user_session'] = get_user_session();
        $data['campaigns'] = $this->campaign_model->campaigns();

        $this->load->view('dashboard/partials/_header', $data);
        $this->load->view('dashboard/campaigns', $data);
        $this->load->view('dashboard/partials/_footer');
    }

    /**
     * Reviews
     */
    public function reviews()
    {
        if ($this->auth_user->role != 'admin' && $this->auth_user->role != 'vendor') {
            redirect(lang_base_url());
        }

        $data['title'] = trans("reviews");
        $data['description'] = trans("reviews") . " - " . $this->app_name;
        $data['keywords'] = trans("reviews") . "," . $this->app_name;
        $data["active_tab"] = "reviews";
        $data["user_rating"] = calculate_user_rating($this->auth_user->id);
        $data['cart_current_user'] = get_current_user_session();

        $data['reviews'] = $this->dashboard_model->get_user_reviews_orders();

        $this->load->view('dashboard/partials/_header', $data);
        $this->load->view('dashboard/reviews', $data);
        $this->load->view('dashboard/partials/_footer');
    }

    /**
     * Trendyol Information
     */
    public function trendyol()
    {
        $data['title'] = "Trendyol'dan aktar";
        $data['current_user_session'] = get_user_session();
        $data['user'] = $this->dashboard_model->trendyol();
        $data['total'] = $this->dashboard_model->get_count_trendyol_products();
        $data['products'] = $this->dashboard_model->get_trendyol_products();

        $this->load->view('dashboard/partials/_header', $data);
        $this->load->view('dashboard/trendyol', $data);
        $this->load->view('dashboard/partials/_footer');
    }

    /**
     * Trendyol Post
     */
    public function trendyol_post()
    {
        if ($this->dashboard_model->trendyol_post())
        {
            $this->trendyol_model->add_trendyol_products();
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect($this->agent->referrer());
        }
    }
}
