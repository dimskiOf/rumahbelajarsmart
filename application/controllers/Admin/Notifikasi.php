<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Notifikasi extends CI_Controller {

 	 public function __construct()
        {
                parent::__construct();
                $this->load->model('Admin_model');
                $this->load->model('Admin_kelola_hakakses_model');
                $this->load->model('Admin_data_notifikasi_model');

        switch ($this->session->userdata('privilages')) {
        case '' : redirect(base_url('member/login'),'refresh'); break;
        case 'SUPERADMIN' :  break;
        case 'ADMIN' : redirect(base_url('staf'),'refresh'); break;
        case 'MEMBER' : redirect(base_url('member'),'refresh'); break;
    	}
    }

   public function index(){
    $data['jmlnotif'] = $this->Admin_data_notifikasi_model->notifikasi_jumlah();
   	$data['datadiri'] = $this->Admin_model->getDataDiri();
    $data['menu'] = $this->Admin_kelola_hakakses_model->get_data_menu('menu_panel', 'id_menu', 'ASC');
    $this->load->view('admin/header_data_notifikasi');
    $this->load->view('admin/modal');
    $this->load->view('admin/modal_data_notifikasi'); 
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/sidebar',$data);  
    $this->load->view('admin/konten_data_notifikasi'); 
    $this->load->view('admin_head_and_foot/footer');
    $this->load->view('admin/script_data_notifikasi');
    $this->load->view('admin/script_menu');
    $this->load->view('admin_head_and_foot/endoftag');
   }

   public function getuser(){
    $data = $this->Admin_data_notifikasi_model->getuser();
    if (count($data) > 0) {
     $list = array();
     $key=0;
     foreach ($data as $row) {
       $list[$key]['id'] = $row->user_id;
       $list[$key]['text'] = $row->nama;
       $key++; 
     }
     echo json_encode($list);
    }   
   }

   public function inputdatanotif(){
        $this->form_validation->set_rules('judul-name', 'Judul', 'required');
        $this->form_validation->set_rules('add-jenis-name', 'JenisNotif', 'required');
        
        $this->form_validation->set_rules('kontens', 'Konten', 'required');
        if ($this->input->post('semua')=='pemilihan'){
          $this->form_validation->set_rules('add-person-name[]', 'Person', 'required');  
        }
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) { 
            if ($this->input->post('semua')=='pemilihan'){
              $dataperson = $this->input->post('add-person-name',TRUE);
              $this->Admin_data_notifikasi_model->inputnotifikasipemilihan($dataperson); 
             $data = array('pesan' => "<div class='alert alert-success'>Input Data Berhasil</div>");
             echo json_encode($data);
         }else{
            $this->Admin_data_notifikasi_model->inputnotifikasiall();
            $data = array('pesan' => "<div class='alert alert-success'>Input Data Berhasil</div>");
             echo json_encode($data); 
         }

         }else{
             $datar = validation_errors();
             $data = array('pesan' => $datar);
             echo json_encode($data);
         }
      
      }

    public function registrasi(){
    $data['jmlnotif'] = $this->Admin_data_notifikasi_model->notifikasi_jumlah();
    $data['datadiri'] = $this->Admin_model->getDataDiri();
    $data['menu'] = $this->Admin_kelola_hakakses_model->get_data_menu('menu_panel', 'id_menu', 'ASC');
    $this->load->view('notifikasi/header_data_notifikasi_registrasi');
    $this->load->view('admin/modal');
    $this->load->view('notifikasi/modal_data_notifikasi_registrasi'); 
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/sidebar',$data);  
    $this->load->view('notifikasi/konten_data_notifikasi_registrasi'); 
    $this->load->view('admin_head_and_foot/footer');
    $this->load->view('notifikasi/script_data_notifikasi_registrasi');
    $this->load->view('admin_head_and_foot/endoftag');
    }

    public function getregistrasi(){
    $DaysEn = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday','January','February','March','April','May','June','July','August','September','October','November','December');
     $DaysId = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');

     $where =array('user_id' => $this->session->userdata('userid'),'jenis_notifikasi' => '4');

     $list = $this->Admin_data_notifikasi_model->get_datatables($where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->tentang_notif;
            $row[] = str_replace($DaysEn,$DaysId,date('l, d F Y h:i A', strtotime($field->tanggal)));
            $row[] = $field->status;
            $row[] = $field->id_notifikasi;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Admin_data_notifikasi_model->count_all(),
            "recordsFiltered" => $this->Admin_data_notifikasi_model->count_filtered($where),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
   }

}