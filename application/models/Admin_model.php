<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin_model extends CI_Model {

 public function __construct()
    {
        parent::__construct();
      

    }

    public function getSetting(){
    $this->db->select('*');
    $this->db->from('superadmin_set');
    $this->db->where('user_id',$this->session->userdata('privilage'));
    return $this->db->get()->result_array();
    }

    

    public function getDataDiri(){
    $this->db->select('*');
    $this->db->from('tbl_user');
    $this->db->where('user_id',$this->session->userdata('userid'));
    return $this->db->get()->result_array();
    }


}