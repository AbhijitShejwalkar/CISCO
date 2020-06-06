<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

class Checkauth extends \Restserver\Libraries\REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Network_model');


    }

    public function token_post()
    {
        $username = $this->post('username');
        $password = $this->post('password');
        $login_reseult = $this->Network_model->check_login( $username, $password );
        if(!empty($login_reseult))
        {
            $this->response([
                'status' => TRUE,
                'message' => 'User login succesfull',
                'user_details' => $login_reseult
            ], \Restserver\Libraries\REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code


        }else
        {

            $this->response([
                'status' => FALSE,
                'message' => 'Invalid login details'
            ], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // CREATED (201) being the HTTP response code
        }
       
    }


    
     private function _generate_key()
     {
        
        // Generate a random salt
        $salt = base_convert(bin2hex($this->security->get_random_bytes(64)), 16, 36);

        // If an error occurred, then fall back to the previous method
        if ($salt === FALSE)
        {
            $salt = hash('sha256', time() . mt_rand());
        }

        $new_key = substr($salt, 0, config_item('rest_key_length'));
        
             return $new_key;
     }

  
}
