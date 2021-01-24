<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Dashboard_model extends CI_Model {

 public function __construct()
    {
        parent::__construct();

    }

   public function getcountdatapaket(){
   	$this->db->select('a.*,b.*,count(*) AS subtot');
    $this->db->from('tbl_user a');
    $this->db->join('tbl_pembelian_paket ab', 'ab.id_user = a.user_id','inner');
    $this->db->join('paket_bimbel b', 'b.id_paket = ab.id_paket','inner');
    $this->db->group_by('b.id_paket');
    return $this->db->get()->result_array();

   }
}
