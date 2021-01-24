<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

 	 public function __construct()
        {
                parent::__construct();

        }
        public function index()
    {
    	
    if (isset($_SESSION['privilages'])){
    switch ($_SESSION['privilages']) {
        case 'SUPERADMIN' : redirect(base_url('admin'),'refresh'); break;
        case 'ADMIN' : redirect(base_url('staf'),'refresh'); break;
        case 'MEMBER' : redirect(base_url('member'),'refresh'); break;
        default; break;
         }
    }else{
    	$this->load->view('publik_area_head_and_foot/header_login.php');
		$this->load->view('publik_area/konten_login.php');
        $this->load->view('publik_area_head_and_foot/footer_login.php');
    }
        

    }
}