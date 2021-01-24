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
    	}
    }

   public function index(){
    switch ($this->session->userdata('privilages')) {
        case '' : redirect(base_url('member/login'),'refresh'); break;
        }
   }

   public function pembaruan(){
    $data['jmlnotif'] = $this->Admin_data_notifikasi_model->notifikasi_jumlah();
    $data['datadiri'] = $this->Admin_model->getDataDiri();
    $data['menu'] = $this->Admin_kelola_hakakses_model->get_data_menu('menu_panel', 'id_menu', 'ASC');
    $this->load->view('notifikasi/header_data_notifikasi_pembaruan');
    $this->load->view('admin/modal');
    $this->load->view('notifikasi/modal_data_notifikasi_pembaruan'); 
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/sidebar',$data);  
    $this->load->view('notifikasi/konten_data_notifikasi_pembaruan'); 
    $this->load->view('admin_head_and_foot/footer');
    $this->load->view('notifikasi/script_data_notifikasi_pembaruan');
    $this->load->view('admin_head_and_foot/endoftag');
   }

    public function pengumuman(){
    $data['jmlnotif'] = $this->Admin_data_notifikasi_model->notifikasi_jumlah();
    $data['datadiri'] = $this->Admin_model->getDataDiri();
    $data['menu'] = $this->Admin_kelola_hakakses_model->get_data_menu('menu_panel', 'id_menu', 'ASC');
    $this->load->view('notifikasi/header_data_notifikasi_pengumuman');
    $this->load->view('admin/modal');
    $this->load->view('notifikasi/modal_data_notifikasi_pengumuman'); 
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/sidebar',$data);  
    $this->load->view('notifikasi/konten_data_notifikasi_pengumuman'); 
    $this->load->view('admin_head_and_foot/footer');
    $this->load->view('notifikasi/script_data_notifikasi_pengumuman');
    $this->load->view('admin_head_and_foot/endoftag');
   }

    public function pembayaran(){
    $data['jmlnotif'] = $this->Admin_data_notifikasi_model->notifikasi_jumlah();
    $data['datadiri'] = $this->Admin_model->getDataDiri();
    $data['menu'] = $this->Admin_kelola_hakakses_model->get_data_menu('menu_panel', 'id_menu', 'ASC');
    $this->load->view('notifikasi/header_data_notifikasi_pembayaran');
    $this->load->view('admin/modal');
    $this->load->view('notifikasi/modal_data_notifikasi_pembayaran'); 
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/sidebar',$data);  
    $this->load->view('notifikasi/konten_data_notifikasi_pembayaran'); 
    $this->load->view('admin_head_and_foot/footer');
    $this->load->view('notifikasi/script_data_notifikasi_pembayaran');
    $this->load->view('admin_head_and_foot/endoftag');
   }

   public function getpembaruan(){
    $DaysEn = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday','January','February','March','April','May','June','July','August','September','October','November','December');
     $DaysId = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');

     $where =array('user_id' => $this->session->userdata('userid'),'jenis_notifikasi' => '1');

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
   
   public function getpengumuman(){
    $DaysEn = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday','January','February','March','April','May','June','July','August','September','October','November','December');
     $DaysId = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');

     $where =array('user_id' => $this->session->userdata('userid'),'jenis_notifikasi' => '3');

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
   public function getpembayaran(){
    $DaysEn = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday','January','February','March','April','May','June','July','August','September','October','November','December');
     $DaysId = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');

    
         $where =array('user_id' => $this->session->userdata('userid'),'jenis_notifikasi' => '2');

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

   public function lihat(){
    //$idnotif = $this->input->post('id');
    $data = $this->Admin_data_notifikasi_model->getnotifbyid();
    if (!empty($data)){
      $this->Admin_data_notifikasi_model->updatenotif();
      echo json_encode($data);

    }else{
      $data = array('pesan' => "<div class='alert alert-danger'>data tidak ada</div>");
      echo json_encode($data);

    }
   }

}