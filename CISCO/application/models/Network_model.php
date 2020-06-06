<?php
class Network_model extends CI_Model {


    public function check_login($username,$password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $query = $this->db->get('user_auth');
        return $query->result_array();
    }

    public function unique_loopaddress_macaddress($loopback, $macaddress)
    {
        $this->db->group_start();
        $this->db->like('loopback', $loopback); 
        $this->db->or_like('mac_address', $macaddress);
        $this->db->group_end();
        $this->db->where('delete_flag', 0);
        $query = $this->db->get('items');
        return $query->result_array();

    }

    public function search_by_sapid($sapid)
    {
        $this->db->like('sapid', $sapid);
        $this->db->where('delete_flag', 0);
        $query = $this->db->get('items');
        return $query->result_array();
    }

    public function search_by_ip($ip)
    {
        $this->db->group_start();
        $this->db->like('loopback', $ip); 
        $this->db->or_like('mac_address', $ip);
        $this->db->group_end();
        $this->db->where('delete_flag', 0);
        $query = $this->db->get('items');
        return $query->result_array();
    }


    public function update_record_id($token)
    {
        $this->db->like('token', $token);
        $query = $this->db->get('user_auth');
        return $query->result_array();
    }

    public function valid_token($token)
    {
        $this->db->like('token', $token);
        $query = $this->db->get('user_auth');
        return $query->result_array();
    }

}
?>