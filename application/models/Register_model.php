<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Register_model extends CI_Model {

 public function __construct()
    {
        parent::__construct();

    }
public function simpan_data1()
    {	

        $passwordid=md5($this->input->post('password'));
        $token=md5($passwordid);
       // $str = $this->input->post('sekolah');
       // $filter = preg_replace("/[^0-2]/", "",$str);
        $data['username']   = $this->input->post('username');
        $data['password'] = $passwordid=md5($this->input->post('password'));
        $data['privilage']  = 'MEMBER';
        $data['access_token']   = $token;
        $data['email']    = $this->input->post('email');
        $data['status']   = 'Aktif';
	   	$this->db->insert('login', $data);
    }
public function simpan_data2()
    {	
    	date_default_timezone_set('Asia/Jakarta');
        if ($this->input->post('jenis_kel') == '1'){
            $jk = 'w';
        }else{
            $jk = 'l';
        }
        $data['status']   = 'Aktif';
        $data['nama']   = $this->input->post('nama');
        $data['tempat_lahir']   = $this->input->post('tl');
        $data['tgl_lahir']   = $this->input->post('tgllahir');
        $data['jenis_kelamin']   = $this->input->post('jenis_kel');
        $data['sekolah']   = $this->input->post('sekolah');
        $data['kelas']   = $this->input->post('kelas');
        $data['no_hp']   = $this->input->post('nohpanak');
        $data['instagram']   = $this->input->post('ig');
        $data['alamat']   = $this->input->post('alamat');
        $data['anak_ke']   = $this->input->post('anake');
        $data['nama_ayah']   = $this->input->post('namaayah');
        $data['nama_ibu']   = $this->input->post('namaibu');
        $data['alamat_ortu']   = $this->input->post('alamatortu');
        $data['no_hp_ayah']   = $this->input->post('nomorhpayah');
        $data['no_hp_ibu']   = $this->input->post('nomorhpibu');
        $data['pekerjaan_ayah']   = $this->input->post('pekerjaanayah');
        $data['pekerjaan_ibu']   = $this->input->post('pekerjaanibu');
        $data['hari_dan_sesi_pr1']   = $this->input->post('hspr1');
        $data['hari_dan_sesi_pr2']   = $this->input->post('hspr2');
        $data['hari_dan_sesi_pr3']   = $this->input->post('hspr3');
        if (!empty($this->input->post('referalid'))){
         $data['kode_referal']   = $this->input->post('referalid');
         }
        $data['foto_profil'] = $jk;
        $tgldftar=date('Y-m-d H:i:s');
        $data['username'] = $this->input->post('username');
        $data['privilage']  = 'MEMBER';
        $data['tgl_daftar']   = $tgldftar;
        $data['email']    = $this->input->post('email');
	   	$this->db->insert('tbl_user', $data);
    }
    public function simpan_data3(){
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

    }
    public function simpan_data4(){
     $kolom = array(
        array('username' => $this->input->post('username'),'privilage' => 'MEMBER', 'id_submenu' => '1' , 'status' => '1', 'id_menu' => '1'),
        array('username' => $this->input->post('username'),'privilage' => 'MEMBER', 'id_submenu' => '13' , 'status' => '1', 'id_menu' => '2'),
        array('username' => $this->input->post('username'),'privilage' => 'MEMBER', 'id_submenu' => '14' , 'status' => '1', 'id_menu' => '2'),
        array('username' => $this->input->post('username'),'privilage' => 'MEMBER', 'id_submenu' => '7' , 'status' => '1', 'id_menu' => '16')); 
        foreach ($kolom as $key) {
        $data['username']   = $key['username'];
        $data['privilage'] = $key['privilage'];
        $data['id_submenu']  = $key['id_submenu'];
        $data['status']  = $key['status'];
        $data['id_menu']  = $key['id_menu'];
        $this->db->insert('user_akses_submenu', $data);
        }
    }

    public function simpan_data6()
    {
    $data = $this->Register_model->getuserbyusername($this->input->post('username'));
   foreach ($data as $row) {
        $uid = $row['user_id'];
   }
    $this->db->trans_start();
    date_default_timezone_set('Asia/Jakarta');

    $result = array();
        foreach($this->input->post('informasidari',TRUE) AS $key => $val){
             $result[] = array(
              'id_informan'   => $_POST['informasidari'][$key],
              'user_id'   => $uid
             );
        }      
    $this->db->insert_batch('tbl_pemilihan_informan', $result);
    $this->db->trans_complete();
    }

    function getuserbyusername($data)
    {
        $this->db->select('user_id');
        $this->db->from('tbl_user');
        $this->db->where('username',$data);
        $this->db->group_by('user_id');
        return $this->db->get()->result_array();
    }
    public function simpan_data7(){
       $data = $this->Register_model->getuserbyusername($this->input->post('username'));
       foreach ($data as $row) {
            $uid = $row['user_id'];
       }
       $this->db->trans_start();
        date_default_timezone_set('Asia/Jakarta');

        $result = array();
            foreach($this->input->post('program',TRUE) AS $key => $val){
                 $result[] = array(
                  'id_paket'   => $_POST['program'][$key],
                  'id_user'   => $uid,
                  'tgl_pembelian' => date('Y-m-d H:i:s')
                 );
            }      
        $this->db->insert_batch('tbl_pembelian_paket', $result);
        $this->db->trans_complete();
    }
    public function alluser(){
    $this->db->select('user_id');
    $this->db->from('tbl_user');
    $this->db->where('privilage !=','MEMBER');
    return $this->db->get()->result_array();
    }

    public function updatereferal(){
        $this->db->set('jumlah', 'jumlah-1');
        $this->db->where('kode_referal', $this->input->post('referalid'));
        $this->db->update('referal');
    }

    public function inputnotifikasitoadmin(){
    $DaysEn = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday','January','February','March','April','May','June','July','August','September','October','November','December');
     $DaysId = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');
    $this->db->trans_start();
    date_default_timezone_set('Asia/Jakarta');
    $data = $this->Register_model->alluser();
    $result = array();
        foreach($data as $key){
             $result[] = array(
              'user_id'   => $key['user_id'],
              'tanggal'   => date('Y-m-d H:i:s'),
              'tentang_notif' => 'Registrasi Member',
              'jenis_notifikasi' => '4',
              'isi_notifikasi' => 'Registrasi dengan nama '.$this->input->post('nama').' pada hari '.str_replace($DaysEn,$DaysId,date('l, d F Y h:i A', strtotime(date('Y-m-d H:i:s') ))).' berhasil dilakukan silahkan cek',
              'status' => 'BELUM DIBACA'
             );
        }      
    $this->db->insert_batch('tbl_notifikasi', $result);
    $this->db->trans_complete();
}
}