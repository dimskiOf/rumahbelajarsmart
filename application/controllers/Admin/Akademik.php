<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Akademik extends CI_Controller {

     public function __construct()
        {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Admin_kelola_hakakses_model');
        $this->load->model('Admin_data_notifikasi_model');
        $this->load->model('Admin_biodata_member_model');
        $this->load->model('Admin_data_nilai_siswa_model');

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
    $data['mapel'] = $this->Admin_data_nilai_siswa_model->mapel();
    $this->load->view('admin/header_data_akademik');
    $this->load->view('admin/modal');
    $this->load->view('admin/modal_data_akademik',$data); 
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/sidebar',$data);  
    $this->load->view('admin/konten_data_akademik'); 
    $this->load->view('admin_head_and_foot/footer');
    $this->load->view('admin/script_data_akademik');
    $this->load->view('admin/script_menu');
    $this->load->view('admin_head_and_foot/endoftag');
    }

    public function nilai_getbyid(){
        $data = $this->Admin_data_nilai_siswa_model->nilai_getbyid();
        echo json_encode($data);
    }

    public function inputnilai(){
     $this->form_validation->set_rules('userid', 'User Id', 'trim|required|numeric');
     $this->form_validation->set_rules('mapelid', 'Mata Pelajaran', 'trim|required|numeric');
     $this->form_validation->set_rules('nilaiinput', 'Nilai', 'trim|required|numeric');

     $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

       if ($this->form_validation->run() == TRUE) { 
         $this->Admin_data_nilai_siswa_model->inputnilai();
         $data = array('pesan' => "<div class='alert alert-success'>Input Nilai Berhasil</div>");
            echo json_encode($data);
         } 
         else{
            $datar = validation_errors();
            $data = array('pesan' => $datar);
            echo json_encode($data);
         }
    }

    public function hapusnilai(){
        $this->Admin_data_nilai_siswa_model->hapusnilai();
        $data = array('pesan' => "<div class='alert alert-success'>Hapus Nilai Berhasil</div>");
        echo json_encode($data);
    }

}