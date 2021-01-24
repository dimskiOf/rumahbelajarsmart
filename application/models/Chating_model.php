<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Chating_model extends CI_Model {

 public function __construct()
    {
        parent::__construct();

    }
public function ambil($limit, $start){
	$this->db->select('datetime, token, nama_usr, chat_usr,foto_profil');
	$this->db->from('tbl_cht_khusus');
	$this->db->order_by('datetime DESC');
	$this->db->limit($limit,$start);
	return $this->db->get()->result_array();
	}
	
public function kirimmessage($userid, $waktu, $token, $nama, $chatusr, $foto_profil)
    {
    	$data['user_id']   = $userid;
        $data['datetime'] = $waktu;
        $data['token']  = $token;
        $data['nama_usr']   = $nama;
        $data['chat_usr']    = $chatusr;
        $data['foto_profil']    = $foto_profil;
	   	$this->db->insert('tbl_cht_khusus', $data);
    }
}