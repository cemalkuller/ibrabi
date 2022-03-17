<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->auth_user->id;
        header('Content-Type: application/json;charset=utf-8');
    }

    /**
     * Login Post
     */
    public function login()
    {
        $method = $this->input->method(TRUE);
		if($method == 'POST')
        {
            $email = $this->input->get('email', true);
            $password = $this->input->get('password', true);
            $token = $this->input->get('token', true);
            $response = $this->api_model->login($email, $password, $token);
            echo $response;
		}
        else
        {
			echo json_encode(400, array('status' => 400, 'message' => 'Request tipi hatali'));
		}
    }

    /**
     * :Register
     */
    public function register()
    {
        $method = $this->input->method(TRUE);
		if($method == 'POST')
        {
            $response = $this->api_model->register();
            echo $response;
		}
        else
        {
			echo json_encode(400, array('status' => 400, 'message' => 'Request tipi hatali'));
		}
    }

    /**
     * Logout
     */
    public function logout()
    {
        header('Content-Type: application/json;charset=utf-8');
        $method = $this->input->method(TRUE);
		if($method == 'POST')
        {
            $token = $this->input->get('token', true);
            $check_token = $this->api_model->check_token($token);
            if($check_token){
                if($this->auth_model->is_logged_in()){
                    $this->auth_model->logout();
                    $success = array('status' => 200, 'message' => 'Başarılı bir şekilde çıkış yapıldı.');
                    echo json_encode($success);
                }else{
                    $error = array('status' => 400, 'message' => 'Zaten çıkış yapılmış.');
                    echo json_encode($error);
                }
            }else{
                $error = array('status' => 400, 'message' => 'Geçersiz token');
                echo json_encode($error);
            }
        }
    }

    /**
     * Members
     */
    public function members()
    {
        header('Content-Type: application/json;charset=utf-8');
        $get_members = $this->auth_model->get_members();
        echo json_encode($get_members);
    }

    /**
     * Member
     */
    public function member($id)
    {
        header('Content-Type: application/json;charset=utf-8');
        $vendor = $this->auth_model->get_user($id);
        echo json_encode($vendor);
    }

    /**
     * Vendors
     */
    public function vendors()
    {
        header('Content-Type: application/json;charset=utf-8');
        $vendors = $this->auth_model->get_vendors();
        echo json_encode($vendors);
    }

    /**
     * Vendor
     */
    public function vendor($id)
    {
        header('Content-Type: application/json;charset=utf-8');
        $vendor = $this->auth_model->get_user($id);
        echo json_encode($vendor);
    }

    /**
     * Followers
     */
    public function followers()
    {
        $followers = $this->profile_model->get_followers($this->user_id);
        echo json_encode($followers);
    }

    /**
     * Following
     */
    public function following()
    {
        $following_users = $this->profile_model->get_following_users($this->user_id);
        echo json_encode($following_users);
    }

    /**
     * Reviews
     */
    public function reviews()
    {
        $reviews = $this->review_model->get_user_reviews_orders($this->user_id, 0 , 100);
        echo json_encode($reviews);
    }
}
