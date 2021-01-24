<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Akademik extends CI_Controller {

     public function __construct()
        {
                parent::__construct();
                $this->load->model('Admin_model');
                $this->load->model('Admin_kelola_hakakses_model');
                $this->load->model('Admin_data_notifikasi_model');
                $this->load->model('Member_akademik_model');
        switch ($this->session->userdata('privilages')) {
        case '' : redirect(base_url('member/login'),'refresh'); break;
        case 'SUPERADMIN' : redirect(base_url('admin'),'refresh'); break;
        case 'ADMIN' : redirect(base_url('staf'),'refresh'); break;
        case 'MEMBER' :  break;
        }
    }
    public function index(){
    $data['jmlnotif'] = $this->Admin_data_notifikasi_model->notifikasi_jumlah();
    $data['datadiri'] = $this->Admin_model->getDataDiri();
    $data['menu'] = $this->Admin_kelola_hakakses_model->get_data_menu('menu_panel', 'id_menu', 'ASC');
    $this->load->view('member/header_data_belajar');
    $this->load->view('admin/modal');
    $this->load->view('member/modal_data_belajar'); 
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/sidebar',$data);  
    $this->load->view('member/konten_data_belajar'); 
    $this->load->view('admin_head_and_foot/footer');
    $this->load->view('member/script_data_belajar');
    $this->load->view('admin/script_menu');
    $this->load->view('admin_head_and_foot/endoftag');
    }

    public function getnilai(){
     $DaysEn = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday','January','February','March','April','May','June','July','August','September','October','November','December');
     $DaysId = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');
     $list = $this->Member_akademik_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_mapel;
            $row[] = $field->nilai;
            $row[] = str_replace($DaysEn,$DaysId,date('l, d F Y', strtotime($field->tgl_nilai))); 
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Member_akademik_model->count_all(),
            "recordsFiltered" => $this->Member_akademik_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    } 

}