<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Items extends CI_Controller {


   /**
    * Get All Data from this method.
    *
    * @return Response
   */
   public function index()
   {
       $this->load->database();

       if(!empty($this->input->get("search"))){

          $this->db->group_start();
          $this->db->like('sapid', $this->input->get("search"));
          $this->db->or_like('hostname', $this->input->get("search"));
          $this->db->or_like('loopback', $this->input->get("search"));
          $this->db->or_like('mac_address', $this->input->get("search"));
          $this->db->group_end();
       }

       //$this->db->limit(2, ($this->input->get("page",1) - 1) * 2);
       $this->db->where("delete_flag",0); 
       $query = $this->db->get("items");

       $data['data'] = $query->result();
       $data['total'] = $this->db->count_all("items");
        echo json_encode($data);
   }


   /**
    * Store Data from this method.
    *
    * @return Response
   */
   public function store()
   {
       $this->load->database();


       $insert = $this->input->post();
       $this->db->insert('items', $insert);
       $id = $this->db->insert_id();
       $q = $this->db->get_where('items', array('id' => $id));
       echo json_encode($q->row());
    }


   /**
    * Edit Data from this method.
    *
    * @return Response
   */
   public function edit($id)
   {
       $this->load->database();
       $q = $this->db->get_where('items', array('id' => $id));
       echo json_encode($q->row());
   }


   /**
    * Update Data from this method.
    *
    * @return Response
   */
   public function update($id)
   {
       
       $insert = $this->input->post();
       $this->db->where('id', $id);
       $this->db->update('items', $insert);
       $q = $this->db->get_where('items', array('id' => $id));
       echo json_encode($insert);
    }


   /**
    * Delete Data from this method.
    *
    * @return Response
   */
   public function delete($id)
   {
       
       $this->db->set('delete_flag', 1);
       $this->db->where('id', $id);
       $this->db->update('items');
       echo json_encode(['success'=>true]);
    }


    public function zip(Type $var = null)
    {
        $this->load->library('zip');

        $name = 'mydata1.txt';
        $data = 'A Data String!';
        
        $this->zip->add_data($name, $data);
        
        // Write the zip file to a folder on your server. Name it "my_backup.zip"
        $this->zip->archive('D:\\xampp\\my_backup.zip');
        
        // Download the file to your desktop. Name it "my_backup.zip"
        $this->zip->download('my_backup.zip');

    }

    public function files($number)
    {
        $this->load->library('zip');

        for($i=1;$i<=$number;$i++)
        {
            $name = 'file_'.$i.'.txt';
            $data = 'A Data String!';
            $this->zip->add_data($name, $data);

        }
       
        // Write the zip file to a folder on your server. Name it "my_backup.zip"
        $zip_file = "my_files".time().".zip";
        $this->zip->archive('D:\\'.$zip_file);
        
        // Download the file to your desktop. Name it "my_backup.zip"
        $this->zip->download($zip_file);

    }


    public function pentagon(){

        $this->load->view('pentagon');
    }

    //command line function 
    public function generate_records($number)
    {
        $mask = "|%5s |%-5s | %-5s | %-20s |  %-10s | \n";
        printf($mask, 'Num', 'Spid','Hostname','Loopback','MAC Address');
        for($i=1;$i<=$number;$i++)
        {
            $Spid = $this->generateRandomString(5);
            $Hostname = $this->generateRandomString(6);
            $Loopback = $this->genrrateRandomIp();
            $Mac_address = $this->genrrateRandomIp();

            $data['sapid'] = $Spid;
            $data['hostname'] = $Hostname;
            $data['loopback'] = $Loopback;
            $data['mac_address'] = $Mac_address;
            $this->db->insert('items', $data);
   
            printf($mask, $i, "$Spid", "$Hostname","$Loopback", "$Mac_address");

        }
    }


    function generateRandomString($length = 25) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function genrrateRandomIp(){
        return $randIP = "".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255);

    }


}