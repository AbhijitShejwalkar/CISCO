<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

class Network extends \Restserver\Libraries\REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Network_model');
        // $this->validateToken();


    }


    public function validateToken()
    {
        $token =  $this->input->post('token');
        $token_result = $this->Network_model->valid_token($token);
    
        if( empty($token_result) OR (false == $this->input->post('token') ))
        {
            $this->response([
                'status' => FALSE,
                'message' => 'Please enter valid token'
            ], \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED); // CREATED (201) being the HTTP response code

        }else
        {
            echo "Test";
        }

    }

    public function createNewRouter_post()
    {
        

        $token =  $this->input->post('token');
        $token_result = $this->Network_model->valid_token($token);
        if( empty($token_result) OR (false == $this->input->post('token') ))
        {
            $this->response([
                'status' => FALSE,
                'message' => 'Please enter valid token'
            ], \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED); // CREATED (201) being the HTTP response code

        }
        else 
        {
            $data = array(
                "sapid" => $this->input->post('sapid'),
                "hostname" => $this->input->post('hostname'),
                "loopback" => $this->input->post('loopback'),
                "mac_address" => $this->input->post('mac_address'),
            );
            
            $unique_loopaddress_macaddress = $this->Network_model->unique_loopaddress_macaddress($this->input->post('loopback'),$this->input->post('mac_address'));
            if(empty($unique_loopaddress_macaddress))
            {
                $this->db->insert('items', $data);
                $this->response([
                    'status' => TRUE,
                    'message' => 'Network Rotuer Properties added successfully!',
                   
                ], \Restserver\Libraries\REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    
    
            }else
            {
    
                $this->response([
                    'status' => FALSE,
                    'message' => 'Dublicate macaddress or loopback present in database'
                ], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // CREATED (201) being the HTTP response code
            }

        }
        
       
    }


    public function serchBySapId_post(Type $var = null)
    {
        $token =  $this->input->post('token');
        $token_result = $this->Network_model->valid_token($token);
        if( empty($token_result) OR (false == $this->input->post('token') ))
        {
            $this->response([
                'status' => FALSE,
                'message' => 'Please enter valid token'
            ], \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED); // CREATED (201) being the HTTP response code

        }else
        {
           
            if(false == $this->input->post('sapid'))
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Please enter sapid'
                ], \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED);

            }
            $serach_result = $this->Network_model->search_by_sapid($this->input->post('sapid'));
            if($serach_result)
            {
                $this->response([
                    'status' => TRUE,
                    'message' => 'serach by sapid',
                    'search_result' => $serach_result
                ], \Restserver\Libraries\REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    
            }else
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No result',
                    'search_result' => 'No result'
                ], \Restserver\Libraries\REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
            }


        }

    }


    public function serchByIP_post(Type $var = null)
    {
        $token =  $this->input->post('token');
        $token_result = $this->Network_model->valid_token($token);
        if( empty($token_result) OR (false == $this->input->post('token') ))
        {
            $this->response([
                'status' => FALSE,
                'message' => 'Please enter valid token'
            ], \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED); // CREATED (201) being the HTTP response code

        }else
        {
           
            if(false == $this->input->post('ip'))
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Please enter loopback ip or mac address'
                ], \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED);

            }
            $serach_result = $this->Network_model->search_by_ip($this->input->post('ip'));
            if($serach_result)
            {
                $this->response([
                    'status' => TRUE,
                    'message' => 'serach by loopback or mac address ip',
                    'search_result' => $serach_result
                ], \Restserver\Libraries\REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    
            }else
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No result',
                    'search_result' => 'No result'
                ], \Restserver\Libraries\REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
            }


        }

    }

    public function deleteRecordByMacaddress_post()
    {
        $token =  $this->input->post('token');
        $token_result = $this->Network_model->valid_token($token);
        if( empty($token_result) OR (false == $this->input->post('token') ))
        {
            $this->response([
                'status' => FALSE,
                'message' => 'Please enter valid token'
            ], \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED); // CREATED (201) being the HTTP response code

        }else
        {
            if(false == $this->input->post('mac_address'))
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Please enter mac address ip '
                ], \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED);

            }else 
            {
                $this->db->where('mac_address', $this->input->post('mac_address'));
                $this->db->delete('items');
                $this->response([
                    'status' => TRUE,
                    'message' => 'Record deleted successfully',
                ], \Restserver\Libraries\REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code

            }

        }
    }

    public function updateRecordByMacaddress_post()
    {
        $token =  $this->input->post('token');
        $token_result = $this->Network_model->valid_token($token);
        if( empty($token_result) OR (false == $this->input->post('token') ))
        {
            $this->response([
                'status' => FALSE,
                'message' => 'Please enter valid token'
            ], \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED); 
        }else
        {
            if(false == $this->input->post('mac_address'))
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Please enter mac address ip '
                ], \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED);

            }else 
            {
                unset($_POST['token']);
                $insert = $this->input->post();
                $this->db->where('mac_address', $this->input->post('mac_address'));
                $this->db->update('items', $insert);
                $this->response([
                    'status' => TRUE,
                    'message' => 'Record updated successfully',
                ], \Restserver\Libraries\REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    

            }
           
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
