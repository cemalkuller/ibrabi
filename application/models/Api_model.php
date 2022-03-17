<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model
{
    var $token = "Qe6sfWG48XHFqhM";

    //check token
    public function check_token()
    {
        $token = $this->input->get('token', true);
        if($token == $this->token)
        {
            return true;
        } else {
            return false;
        }
    }

    //login control
    public function login($email, $password)
    {
        header('Content-Type: application/json;charset=utf-8');
        if(!$this->auth_model->is_logged_in()){
            $this->load->library('bcrypt');
            $user = $this->auth_model->get_user_by_email($email);
            $check_token = $this->check_token();
            //check token value
            //if($check_token){
                if (!empty($user)) {
                    //check password
                    if (!$this->bcrypt->check_password($password, $user->password)) {
                        $error = array('status' => 400, 'message' => 'Şifre yanlış');
                        return json_encode($error);
                    }
                    if ($user->email_status != 1) {
                        $error = array('status' => 400, 'message' => 'E-posta aktivasyonu yapılmamış');
                        return json_encode($error);
                    }
                    if ($user->banned == 1) {
                        $error = array('status' => 400, 'message' => 'Kullanıcı banlanmış.');
                        return json_encode($error);
                    }
                    //set user data
                    $user_data = array(
                        'modesy_sess_user_id' => $user->id,
                        'modesy_sess_user_email' => $user->email,
                        'modesy_sess_user_role' => $user->role,
                        'modesy_sess_logged_in' => true,
                        'modesy_sess_app_key' => $this->config->item('app_key'),
                    );
                    $this->session->set_userdata($user_data);
                    //$token = crypt(substr( md5(rand()), 0, 7));
                    $error = array('status' => 200, 'message' => 'Giriş başarılı', 'id' => $user->id);
                    return json_encode($error);
                } else {
                    $error = array('status' => 400, 'message' => 'E-posta adresi veya şifre yanlış');
                    return json_encode($error);
                }
            /*}else{
                $error = array('status' => 401, 'message' => 'Geçersiz token');
                return json_encode($error);
            }*/
        }else{
            $error = array('status' => 400, 'message' => 'Zaten giriş yapılmış');
            return json_encode($error);
        }
    }

    //register
    public function register()
    {
        header('Content-Type: application/json;charset=utf-8');
        $this->load->library('bcrypt');
        $username = $this->input->get('username', true);
        $password = $this->input->get('password', true);
        $email = $this->input->get('email', true);
        $first_name = $this->input->get('first_name', true);
        $last_name = $this->input->get('last_name', true);
        //check token
        $check_token = $this->check_token();
        /*if($check_token){ */
            $data['username'] = remove_special_characters($username);
            //secure password
            $data['password'] = $this->bcrypt->hash_password($password);
            $data['email'] = $email;
            $data['first_name'] = $first_name;
            $data['last_name'] = $last_name;
            $data['role'] = "member";
            $data['user_type'] = "registered";
            $data["slug"] = $this->auth_model->generate_uniqe_slug($username);
            
            $data['banned'] = 0;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['token'] = generate_token();
            $data['email_status'] = 0;

            //is email unique
            if (!$this->auth_model->is_unique_email($email)) {
                $error = array('status' => 400, 'message' => 'E-posta adresi sistemde mevcut.');
                return json_encode($error);
            }

            //is username unique
            if (!$this->auth_model->is_unique_username($username)) {
                $error = array('status' => 400, 'message' => 'Kullanıcı adı sistemde mevcut.');
                return json_encode($error);
            }

            $this->db->insert('users', $data);
            $success = array('status' => 200, 'message' => 'Hesabınız Başarıyla Oluşturuldu!');
            return json_encode($success);
        /*}else{
            $error = array('status' => 401, 'message' => 'Geçersiz token');
            return json_encode($error);
        }*/
    }

    //get products
    public function get_products()
    {
        $this->db->where('products.is_deleted', 0);
        $this->db->where('products.is_draft', 0);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('products');
        $result = $query->result();
        foreach($result as $product)
        {
            $images = $this->get_product_images($product->id);
            $product->images = $images;
            $products[] = $product;
        }
        return $products;
    }

    // Get parent categories
    public function get_parent_categories()
    {
        $this->db->from('categories');
        $this->db->where('categories.parent_id', 0);
        $this->db->where('categories_lang.lang_id', 2);
        $this->db->select('categories.*,categories_lang.*');
        $this->db->join('categories_lang', 'categories.id = categories_lang.category_id');
        $query = $this->db->get();
        return $query->result();
    }

    //Get Product Images
    public function get_product_images($product_id)
    {
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('images');
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

    /**
     * Messages
     */
    public function messages()
    {
        $conversation = $this->message_model->get_user_latest_conversation($this->auth_user->id);
        if (!empty($conversation))
        {
            $messages = $this->message_model->get_messages($conversation->id);
            return $messages;
        }
    }

    //search products
    public function search_products($search)
    {
        $this->db->where('products.is_deleted', 0);
        $this->db->where('products.is_draft', 0);
        $this->db->like('title', $search);
        $query = $this->db->get('products');
        $result = $query->result();
        foreach($result as $product)
        {
            $images = $this->get_product_images($product->id);
            $product->images = $images;
            $products[] = $product;
        }
        return $products;
    }

    //get product by id
    public function get_product_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('products');
        $product = $query->row();
        $images = $this->get_product_images($product->id);
        $product->images = $images;
        return $product;
    }
}
