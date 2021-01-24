<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Memberdashboard extends CI_Controller {

 	 public function __construct()
        {
                parent::__construct();
                $this->load->model('Admin_model');
                $this->load->model('Admin_data_notifikasi_model');
                $this->load->model('Dashboard_model');

        switch ($this->session->userdata('privilages')) {
        case '' : redirect(base_url('member/login'),'refresh'); break;
        case 'SUPERADMIN' : redirect(base_url('admin'),'refresh'); break;
        case 'ADMIN' : redirect(base_url('staf'),'refresh'); break;
        case 'MEMBER' :  break;
            }
        }
               
        
    public function index()
    {
        
    require_once(APPPATH.'/vendor/autoload.php');
    $options = array(
    'cluster' => 'ap1',
    'useTLS' => true
    );
    $pusher = new  Pusher\Pusher(
        '03390b8b7160498ec7dc', //ganti dengan App_key pusher Anda
        '2019924890ffdf16030d', 
        '865726', 
        $options
        );

    $data['jmlnotif'] = $this->Admin_data_notifikasi_model->notifikasi_jumlah();
    $data['datadiri'] = $this->Admin_model->getDataDiri();
    $data['jumlahber'] = $this->Dashboard_model->getcountdatapaket();
    $this->load->view('member_head_and_foot/header');
    $this->load->view('admin/modal'); 
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/sidebar',$data);  
    $this->load->view('member/konten'); 
    $this->load->view('admin_head_and_foot/footer');
    $this->load->view('member_head_and_foot/script',$data);
    $this->load->view('admin/script_menu');
    $this->load->view('admin_head_and_foot/endoftag');  
    }

}