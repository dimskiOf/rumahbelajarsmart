<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin_Register_model extends CI_Model {

 public function __construct()
    {
        parent::__construct();

    }
public function simpan_data1()
    {	

        $passwordid=md5($this->input->post('password'));
        $token=md5($passwordid);
        $data['username']   = $this->input->post('username');
        $data['password'] = $passwordid=md5($this->input->post('password'));
        $data['privilage']  = $this->input->post('hak');
        $data['access_token']   = $token;
        $data['email']    = $this->input->post('email');
	   	$this->db->insert('login', $data);
    }
public function simpan_data2()
    {	
    	date_default_timezone_set('Asia/Jakarta');
        $tgldftar=date('Y-m-d H:i:s');
        if ($this->input->post('jenis_kel') == '1'){
            $jk = 'w';
        }else{
            $jk = 'l';
        }
      	$data['nama']   = $this->input->post('nama');
        $data['username'] = $this->input->post('username');
        $data['jenis_kelamin']  = $this->input->post('jenis_kel');
        $data['privilage']  = $this->input->post('hak');
        $data['tgl_daftar']   = $tgldftar;
        $data['email']    = $this->input->post('email');
        $data['foto_profil'] = $jk;
	   	$this->db->insert('tbl_user', $data);
    }
    public function simpan_data3(){
    if ($this->input->post('privilage') == '2'){
        $kolom = array(
        array('username' => $this->input->post('username'),'privilage' => 'MEMBER', 'id_menu' => '1' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'MEMBER', 'id_menu' => '2' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'MEMBER', 'id_menu' => '16' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'MEMBER', 'id_menu' => '18' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'MEMBER', 'id_menu' => '19' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'MEMBER', 'id_menu' => '20' , 'status' => '1'));

        foreach ($kolom as $key) {
        $data['username']   = $key['username'];
        $data['privilage'] = $key['privilage'];
        $data['id_menu']  = $key['id_menu'];
        $data['status']  = $key['status'];
        $this->db->insert('user_akses_menu', $data);
        }

    } elseif ($this->input->post('privilage') == '1') {
        $kolom = array(
        array('username' => $this->input->post('username'),'privilage' => 'ADMIN', 'id_menu' => '1' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'ADMIN', 'id_menu' => '6' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'ADMIN', 'id_menu' => '16' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'ADMIN', 'id_menu' => '18' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'ADMIN', 'id_menu' => '19' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'ADMIN', 'id_menu' => '20' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'ADMIN', 'id_menu' => '9' , 'status' => '1'));

        foreach ($kolom as $key) {
        $data['username']   = $key['username'];
        $data['privilage'] = $key['privilage'];
        $data['id_menu']  = $key['id_menu'];
        $data['status']  = $key['status'];
        $this->db->insert('user_akses_menu', $data);
        }

    } else {
        $kolom = array(
        array('username' => $this->input->post('username'),'privilage' => 'SUPERADMIN', 'id_menu' => '1' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'SUPERADMIN', 'id_menu' => '6' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'SUPERADMIN', 'id_menu' => '9' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'SUPERADMIN', 'id_menu' => '12' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'SUPERADMIN', 'id_menu' => '16' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'SUPERADMIN', 'id_menu' => '18' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'SUPERADMIN', 'id_menu' => '19' , 'status' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'SUPERADMIN', 'id_menu' => '20' , 'status' => '1'));

        foreach ($kolom as $key) {
        $data['username']   = $key['username'];
        $data['privilage'] = $key['privilage'];
        $data['id_menu']  = $key['id_menu'];
        $data['status']  = $key['status'];
        $this->db->insert('user_akses_menu', $data);
        }
    }

    }
    public function simpan_data4(){
    if ($this->input->post('privilage') == '2'){
        $kolom = array(
        array('username' => $this->input->post('username'),'privilage' => 'MEMBER', 'id_menu' => '1' , 'status' => '1', 'id_submenu' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'MEMBER', 'id_menu' => '2' , 'status' => '1', 'id_submenu' => '13'),
        array('username' => $this->input->post('username'),'privilage' => 'MEMBER', 'id_menu' => '2' , 'status' => '1', 'id_submenu' => '14'),
        array('username' => $this->input->post('username'),'privilage' => 'MEMBER', 'id_menu' => '16' , 'status' => '1', 'id_submenu' => '7'));

        foreach ($kolom as $key) {
        $data['username']   = $key['username'];
        $data['privilage'] = $key['privilage'];
        $data['id_menu']  = $key['id_menu'];
        $data['status']  = $key['status'];
        $data['id_submenu']  = $key['id_submenu'];
        $this->db->insert('user_akses_submenu', $data);
        }

    } elseif ($this->input->post('privilage') == '1') {
        $kolom = array(
        array('username' => $this->input->post('username'),'privilage' => 'ADMIN', 'id_menu' => '1' , 'status' => '1', 'id_submenu' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'ADMIN', 'id_menu' => '6' , 'status' => '1', 'id_submenu' => '3'),
        array('username' => $this->input->post('username'),'privilage' => 'ADMIN', 'id_menu' => '16' , 'status' => '1', 'id_submenu' => '7'),
        array('username' => $this->input->post('username'),'privilage' => 'ADMIN', 'id_menu' => '9' , 'status' => '1', 'id_submenu' => '5'));

        foreach ($kolom as $key) {
        $data['username']   = $key['username'];
        $data['privilage'] = $key['privilage'];
        $data['id_menu']  = $key['id_menu'];
        $data['status']  = $key['status'];
        $data['id_submenu']  = $key['id_submenu'];
        $this->db->insert('user_akses_submenu', $data);
        }

    } else {
        $kolom = array(
        array('username' => $this->input->post('username'),'privilage' => 'SUPERADMIN', 'id_menu' => '1' , 'status' => '1', 'id_submenu' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'SUPERADMIN', 'id_menu' => '9' , 'status' => '1', 'id_submenu' => '5'),
        array('username' => $this->input->post('username'),'privilage' => 'SUPERADMIN', 'id_menu' => '16' , 'status' => '1', 'id_submenu' => '7'),
        array('username' => $this->input->post('username'),'privilage' => 'SUPERADMIN', 'id_menu' => '6' , 'status' => '1', 'id_submenu' => '3'),
        array('username' => $this->input->post('username'),'privilage' => 'SUPERADMIN', 'id_menu' => '12' , 'status' => '1', 'id_submenu' => '6'),
        array('username' => $this->input->post('username'),'privilage' => 'SUPERADMIN', 'id_menu' => '12' , 'status' => '1', 'id_submenu' => '9'),
        array('username' => $this->input->post('username'),'privilage' => 'SUPERADMIN', 'id_menu' => '12' , 'status' => '1', 'id_submenu' => '10'),
        array('username' => $this->input->post('username'),'privilage' => 'SUPERADMIN', 'id_menu' => '12' , 'status' => '1', 'id_submenu' => '11'));

        foreach ($kolom as $key) {
        $data['username']   = $key['username'];
        $data['privilage'] = $key['privilage'];
        $data['id_menu']  = $key['id_menu'];
        $data['status']  = $key['status'];
        $data['id_submenu']  = $key['id_submenu'];
        $this->db->insert('user_akses_submenu', $data);
        }
        }
    }
}