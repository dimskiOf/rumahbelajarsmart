<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {

 	 public function __construct()
        {
        parent::__construct();
        }
        public function index(){
        switch ($this->session->userdata('privilages')) {
        case '' : redirect(base_url('member/login'),'refresh'); break;
        case 'ADMIN' : redirect(base_url('staf'),'refresh'); break;
        case 'SUPERADMIN' : redirect(base_url('admin'),'refresh'); break;
        case 'MEMBER' : redirect(base_url('member'),'refresh'); break;
            }
        }
    }