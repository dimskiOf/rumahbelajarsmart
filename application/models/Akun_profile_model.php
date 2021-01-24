<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Akun_profile_model extends CI_Model {

 public function __construct()
    {
        parent::__construct();
      

    }
    public function getuserprofil($usrn){
    $this->db->select('tbl_user.username,login.username,nama, tbl_user.email, jenis_kelamin ,foto_profil');
    $this->db->from('tbl_user');
    $this->db->join('login', 'tbl_user.username = login.username');
  //  $this->db->where('login.privilage !=', $hak);
    $this->db->where('tbl_user.username', $usrn);
    $hsl = $this->db->get()->result_array();
 if($hsl != null){
            foreach ($hsl as $data) {
                $hasil=array(
                    'username' => $data['username'],
                    'nama' => $data['nama'],
                    'email' => $data['email'],
                    'jenis_kelamin' => $data['jenis_kelamin'],
                    'foto_profil' => $data['foto_profil'],
                    );
            }
            return $hasil;
        }
}

public function cekit($b){
$this->db->select('foto_profil');
$this->db->from('tbl_user');
$this->db->where('username', $b);
return $this->db->get()->result_array();
}

public function updating_foto_profil($a){
    $userd = $this->session->userdata('userid');
    $arraylist = array('foto_profil' => $a);
    $this->db->where('user_id', $userd);
   return $this->db->update('tbl_user', $arraylist);
}

public function updatedataprofil(){
    $a = $this->input->post('nama-usr');
    $d = md5($this->input->post('password'));
    $e = $this->input->post('klmn-usr');
    $f = $this->session->userdata('id');
    if (!empty($d)){

    $arraylist = array('password' => $d);
    $this->db->where('username', $f);
    $this->db->update('login', $arraylist);

    $arraylist2 = array('nama' => $a, 'jenis_kelamin' => $e);
    $this->db->where('username', $f);
    $this->db->update('tbl_user', $arraylist2);
    }else{

    $arraylist2 = array('nama' => $a,'jenis_kelamin' => $e);
    $this->db->where('username', $f);
    $this->db->update('tbl_user', $arraylist2);
    }
}

}