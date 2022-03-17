<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message_controller extends Home_Core_Controller
{
    /**
     * Messages
     */
    public function messages()
    {
        $messages = $this->api_model->messages();
        echo json_encode($messages);
    }
}