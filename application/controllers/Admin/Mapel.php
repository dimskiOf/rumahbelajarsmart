<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Mapel extends CI_Controller {

     public function __construct()
        {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Admin_kelola_hakakses_model');
        $this->load->model('Admin_data_notifikasi_model');
        $this->load->model('Admin_data_mapel_model');

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
    $data['mapel'] = $this->Admin_data_mapel_model->getmapelall();
    $this->load->view('admin/header_data_mapel');
    $this->load->view('admin/modal');
    $this->load->view('admin/modal_data_mapel',$data); 
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/sidebar',$data);  
    $this->load->view('admin/konten_data_mapel'); 
    $this->load->view('admin_head_and_foot/footer');
    $this->load->view('admin/script_data_mapel');
    $this->load->view('admin/script_menu');
    $this->load->view('admin_head_and_foot/endoftag');
    }

    public function getmapel(){
        $list = $this->Admin_data_mapel_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_mapel;
            $row[] = $field->status;
            $row[] = $field->id_mapel;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Admin_data_mapel_model->count_all(),
            "recordsFiltered" => $this->Admin_data_mapel_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function inputmapel(){
     $this->form_validation->set_rules('namamapel', 'Nama Mata Pelajaran', 'trim|required');
     $this->form_validation->set_rules('statusmapel', 'Status Pelajaran', 'trim|required');

     $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

       if ($this->form_validation->run() == TRUE) { 
         $this->Admin_data_mapel_model->inputmapel();
         $data = array('pesan' => "<div class='alert alert-success'>Input Mata Pelajaran Berhasil</div>");
            echo json_encode($data);
         } 
         else{
            $datar = validation_errors();
            $data = array('pesan' => $datar);
            echo json_encode($data);
         }
    }

    public function mapel_getbyid(){
        $data = $this->Admin_data_mapel_model->mapel_getbyid();
        echo json_encode($data);
    }

    public function submiteditmapel(){
      $this->form_validation->set_rules('id_mapel', 'ID Mata Pelajaran', 'trim|required|numeric');
     $this->form_validation->set_rules('editnamamapel', 'Nama Mata Pelajaran', 'trim|required');
     $this->form_validation->set_rules('editstatusmapel', 'Status Pelajaran', 'trim|required');

     $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

       if ($this->form_validation->run() == TRUE) { 
         $this->Admin_data_mapel_model->submiteditmapel();
         $data = array('pesan' => "<div class='alert alert-success'>Edit Mata Pelajaran Berhasil</div>");
            echo json_encode($data);
         } 
         else{
            $datar = validation_errors();
            $data = array('pesan' => $datar);
            echo json_encode($data);
         }
    }

    public function detailpaketmapel(){
        $data = $this->Admin_data_mapel_model->detailpaketmapel();
        echo json_encode($data);
    }

    public function submitaddmapelonpaket(){
     $this->form_validation->set_rules('idpaketurus', 'ID Paket', 'trim|required|numeric');
     $this->form_validation->set_rules('mapelid', 'Nama Mata Pelajaran', 'trim|required|numeric');
     
     $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

       if ($this->form_validation->run() == TRUE) { 
         $this->Admin_data_mapel_model->submitaddmapelonpaket();
         $data = array('pesan' => "<div class='alert alert-success'>Input Pengelompokan Mata Pelajaran Berhasil</div>");
            echo json_encode($data);
         } 
         else{
            $datar = validation_errors();
            $data = array('pesan' => $datar);
            echo json_encode($data);
         }
    }

    public function hapusmapelonpaket(){
        $this->Admin_data_mapel_model->hapusmapelonpaket();
        $data = array('pesan' => "<div class='alert alert-success'>Hapus Nilai Berhasil</div>");
        echo json_encode($data);
    }

}