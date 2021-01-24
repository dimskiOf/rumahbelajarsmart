<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends CI_Controller {

 	 public function __construct()
        {
                parent::__construct();
                $this->load->library('session');
                $this->load->library('form_validation');
                $this->load->model('Register_model');
                $this->load->helper(array('form', 'url'));

        }
        public function index()
    {
    	$this->load->view('publik_area_head_and_foot/header_register');
    	$this->load->view('publik_area/konten_register');
    	$this->load->view('publik_area_head_and_foot/footer_register');
    }

    public function auth()
    {
    	 /* Validation rule */
   	 $this->form_validation->set_rules('program[]', 'Program', 'trim|required|numeric|callback_check_paketpilih');
   	 $this->form_validation->set_rules('nama', 'Nama', 'trim|required|callback_alpha_dash_space');
   	 $this->form_validation->set_rules('tl', 'Tempat Lahir', 'trim|required|callback_alpha_dash_space');
   	 $this->form_validation->set_rules('tgllahir', 'Tanggal Lahir', 'trim|required|regex_match[/\d{4}-\d{2}-\d{2}/]');
	 $this->form_validation->set_rules('jenis_kel', 'Jenis Kelamin', 'trim|required|numeric|greater_than[0]|less_than_equal_to[2]');
     $this->form_validation->set_rules('sekolah', 'Sekolah', 'trim|required');
     $this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');
     $this->form_validation->set_rules('nohpanak', 'No HP', 'trim|required');
     $this->form_validation->set_rules('ig', 'Instagram', 'trim');
     $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
     $this->form_validation->set_rules('anake', 'Anak Ke', 'trim|required');
     $this->form_validation->set_rules('namaayah', 'Nama AYAH', 'trim|required|callback_alpha_dash_space');
     $this->form_validation->set_rules('namaibu', 'Nama Ibu', 'trim|required|callback_alpha_dash_space');
     $this->form_validation->set_rules('alamatortu', 'Alamat Orang Tua', 'trim|required');
     $this->form_validation->set_rules('nomorhpayah', 'Nomor Hp Ayah', 'trim');
     $this->form_validation->set_rules('nomorhpibu', 'Nomor Hp Ibu', 'trim');
     $this->form_validation->set_rules('pekerjaanayah', 'Pekerjaan Ayah', 'trim|callback_alpha_dash_space');
     $this->form_validation->set_rules('pekerjaanibu', 'Pekerjaan Ibu', 'trim|callback_alpha_dash_space');
     $this->form_validation->set_rules('informasidari[]', 'Informasi Dari', 'trim|required|callback_check_informasi');
     $this->form_validation->set_rules('hspr1', 'Hari dan Sesi Jadwa Program 1', 'trim');
     $this->form_validation->set_rules('hspr2', 'Hari dan Sesi Jadwa Program 2', 'trim');
     $this->form_validation->set_rules('hspr3', 'Hari dan Sesi Jadwa Program 3', 'trim');
     if (!empty($this->input->post('referalid'))){
     $this->form_validation->set_rules('referalid', 'Kode Referal', 'trim|required|alpha_numeric|callback_check_kodereferal|strtoupper');
 	 }
	 $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_email');
	 $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_check_username|alpha_numeric');
	 $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[25]|callback_harus_gege');
     $this->form_validation->set_rules('re_password', 'Password Confirmation', 'required|matches[password]');		

	$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

         if ($this->form_validation->run() == FALSE) {

         	$this->session->set_flashdata('errors', validation_errors());
            
         	$this->session->set_flashdata(array('program' => $this->input->post('program',true)));

         	$this->session->set_flashdata(array('informasidari' => $this->input->post('informasidari',true)));

         	$this->session->set_flashdata(array('ig' => $this->input->post('ig'),'nama' => $this->input->post('nama'),'tl' => $this->input->post('tl'),'tgllahir' => $this->input->post('tgllahir'),'jenis_kel' => $this->input->post('jenis_kel'),'sekolah' => $this->input->post('sekolah'),'kelas' => $this->input->post('kelas'),'alamat' => $this->input->post('alamat'),'anake' => $this->input->post('anake'),'namaayah' => $this->input->post('namaayah'),'namaibu' => $this->input->post('namaibu'),'alamatortu' => $this->input->post('alamatortu'),'nomorhpayah' => $this->input->post('nomorhpayah'),'nomorhpibu' => $this->input->post('nomorhpibu'),'pekerjaanayah' => $this->input->post('pekerjaanayah'),'pekerjaanibu' => $this->input->post('pekerjaanibu'),'hspr1' => $this->input->post('hspr1'),'hspr2' => $this->input->post('hspr2'),'hspr3' => $this->input->post('hspr3'),'referalid' => $this->input->post('referalid'),'email' => $this->input->post('email'),'username' => $this->input->post('username'),'nohpanak' => $this->input->post('nohpanak')));
			redirect(base_url().'member/register');
         } 
         else{
          $this->Register_model->simpan_data1();
          $this->Register_model->simpan_data2();
          $this->Register_model->simpan_data3();
          $this->Register_model->simpan_data4();
          $this->Register_model->simpan_data6();
          $this->Register_model->simpan_data7();
          $this->Register_model->inputnotifikasitoadmin();
          if (!empty($this->input->post('referalid'))){
          	$this->Register_model->updatereferal();
          }
          echo '<script>alert("Register Berhasil!");</script>';
          redirect(base_url().'member/login','refresh');
         }
    }

    function harus_gege($password){
    if (!(preg_match('#[0-9]#', $password) && preg_match('#[A-Z]#', $password) && preg_match('/[!@#$%^&*]+/', $password))){
      $this->form_validation->set_message('harus_gege', 'Password harus berisi minimal satu huruf kapital, satu nomor, dan satu karakter (!@#$%^&*)');
      return false;
    }else{
      return true;
    }
  }
      
    function alpha_dash_space($nama){
    if (! preg_match('/^[a-zA-Z\s]+$/', $nama)) {
        $this->form_validation->set_message('alpha_dash_space', 'Kolom %s hanya boleh terdapat alpabet dan spasi');
        return FALSE;
    } else {
        return TRUE;
    }
	}
    
    function check_kodereferal($referal){
    	$data = array('kode_referal' => $referal,'jumlah >' => '0' );
    	$query = $this->db->where($data)->get("referal");
		 if ($query->num_rows() > 0)
		    {
			 
		        return TRUE;
		    }
		  else 
		  {
		  	$this->form_validation->set_message('check_kodereferal','Gagal melakukan Register kode referal '.$referal.' tidak terdaftar');
			  return FALSE;
		  }
    }

	function check_informasi($informasi){
    	$query = $this->db->where('id_informasi', $informasi)->get("informan");
		 if ($query->num_rows() > 0)
		    {
			 
		        return TRUE;
		    }
		  else 
		  {
		  	$this->form_validation->set_message('check_informasi','Gagal melakukan Register check informasi dari');
			  return FALSE;
		  }
    }

    function check_paketpilih($paketpilih){
    	$query = $this->db->where('id_paket', $paketpilih)->get("paket_bimbel");
		 if ($query->num_rows() > 0)
		    {
			 
		        return TRUE;
		    }
		  else 
		  {
		  	$this->form_validation->set_message('check_paketpilih','Gagal melakukan Register Paket Kosong');
			  return FALSE;
		  }
    }

    function check_email($email)
	   {
	         $query = $this->db->where('email', $email)->get("tbl_user");
		 if ($query->num_rows() > 0)
		    {
			 $this->form_validation->set_message('check_email','Gagal melakukan Register Email '.$email.' sudah ada');
		        return FALSE;
		    }
		  else 
			  return TRUE;
	  }	

	  function check_username($username)
	   {
	         $query = $this->db->where('username', $username)->get("tbl_user");
		 if ($query->num_rows() > 0)
		    {
			 $this->form_validation->set_message('check_username','Gagal melakukan Register Username '.$username.' sudah ada');
		        return FALSE;
		    }
		  else 
			  return TRUE;
	  }
	  
	  public function authusername1(){
	  	$this->form_validation->set_rules('query', 'Username', 'trim|required|callback_cek_username|alpha_numeric');
	  	$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

	  	if ($this->form_validation->run() == TRUE) { 
            $data = array('pesan' => "<div class='alert alert-success'>username valid dan dapat digunakan</div>");
       		echo json_encode($data);
         } 
         else{
         	$datar = validation_errors();
			$data = array('pesan' => $datar);
       		echo json_encode($data);
         }
	  	
	  }	
	  function cek_username($username)
	   {
	         $query = $this->db->where('username', $username)->get("tbl_user");
		 if ($query->num_rows() > 0)
		    {
			 $this->form_validation->set_message('cek_username','username '.$username.' sudah ada');
		        return FALSE;
		    }
		  else 
			  return TRUE;
	  }	

	  public function authemail1(){
	  	$this->form_validation->set_rules('query', 'Email', 'trim|required|valid_email|callback_cek_email');
	  	$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

	  	if ($this->form_validation->run() == TRUE) { 
            $data = array('pesan' => "<div class='alert alert-success'>email valid dan dapat digunakan</div>");
       		echo json_encode($data);
         } 
         else{
         	$datar = validation_errors();
			$data = array('pesan' => $datar);
       		echo json_encode($data);
         }
	  	
	  }	
	  function cek_email($email)
	   {
	         $query = $this->db->where('email', $email)->get("tbl_user");
		 if ($query->num_rows() > 0)
		    {
			 $this->form_validation->set_message('cek_email','email dengan '.$email.' sudah ada');
		        return FALSE;
		    }
		  else 
			  return TRUE;
	  }	
}