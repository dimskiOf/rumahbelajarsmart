<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Registeradmin extends CI_Controller {

 	 public function __construct()
        {
                parent::__construct();
                $this->load->model('Admin_Register_model');

         switch ($this->session->userdata('privilages')) {
        case '' : redirect(base_url('member/login'),'refresh'); break;
        case 'SUPERADMIN' :  break;
        case 'ADMIN' : redirect(base_url('staf'),'refresh'); break;
        case 'MEMBER' : redirect(base_url('member'),'refresh'); break;
    	}
               
        }

    public function index()
    {
    	$this->load->view('admin/header_register');
    	$this->load->view('admin/konten_register');
    	$this->load->view('admin/footer_register');
    }

    public function auth()
    {
    	 /* Validation rule */
	 $this->form_validation->set_rules('jenis_kel', 'jenis_kel', 'trim|required|numeric|greater_than[0]|less_than_equal_to[2]');
     $this->form_validation->set_rules('hak', 'hak', 'trim|required|numeric|greater_than[0]|less_than_equal_to[3]'); 
	 $this->form_validation->set_rules('nama', 'Nama', 'trim|required|callback_alpha_dash_space');
	 $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_email');
	 $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_check_username|alpha_numeric');
	 $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[25]|callback_harus_gege');
     $this->form_validation->set_rules('re_password', 'Password Confirmation', 'required|matches[password]');		

	$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

         if ($this->form_validation->run() == FALSE) { 
            $this->load->view('admin/header_register');
	    	$this->load->view('admin/konten_register');
	    	$this->load->view('admin/footer_register');
         } 
         else{
          $this->Admin_Register_model->simpan_data1();
          $this->Admin_Register_model->simpan_data2();
          $this->Admin_Register_model->simpan_data3();
          $this->Admin_Register_model->simpan_data4();
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
        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
        return FALSE;
    } else {
        return TRUE;
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

	  	  public function authusername(){
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

	  public function authemail(){
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