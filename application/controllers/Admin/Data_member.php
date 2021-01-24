<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Data_member extends CI_Controller {

 	 public function __construct()
        {
                parent::__construct();
                $this->load->model('Admin_model');
                $this->load->model('Admin_kelola_hakakses_model');
                $this->load->model('Admin_kelola_paket_produk_model');
                $this->load->model('Admin_data_notifikasi_model');
                $this->load->model('Admin_biodata_member_model');
                $this->load->model('Admin_data_member_model');

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
    $data['paketmember'] = $this->Admin_kelola_paket_produk_model->getpaketproduk();
    $this->load->view('admin/header_data_member');
    $this->load->view('admin/modal');
    $this->load->view('admin/modal_data_member'); 
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/sidebar',$data);  
    $this->load->view('admin/konten_data_member'); 
    $this->load->view('admin_head_and_foot/footer');
    $this->load->view('admin/script_data_member',$data);
    $this->load->view('admin/script_menu');
    $this->load->view('admin_head_and_foot/endoftag');
   }
    public function kelola_data_member(){
    $DaysEn = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday','January','February','March','April','May','June','July','August','September','October','November','December');
     $DaysId = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');
     $list = $this->Admin_data_member_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama;
            $row[] = $field->sekolah;
            $row[] = $field->status;
 			$row[] = str_replace($DaysEn,$DaysId,date('l, d F Y h:i A', strtotime($field->tgl_daftar)));
 			$row[] = $field->user_id;
 			$row[] = $field->foto_profil;
 			$row[] = $field->jenis_kelamin;
 			$row[] = $field->email;
 			$row[] = $field->alamat;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Admin_data_member_model->count_all(),
            "recordsFiltered" => $this->Admin_data_member_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function nonaktifmember(){
    	$a = $this->Admin_data_member_model->nonaktifmember();
    if ($a){
    	$data =  array('pesan' => "<div class='alert alert-success'>Ganti Status Berhasil</div>");
        echo json_encode($data);
        }
    }

    public function kelola_data_paket_member(){
    $data =	$this->Admin_data_member_model->getmemberpaket();
    echo json_encode($data);
    }

    public function kelola_biodata_get_informasi(){
    $data = $this->Admin_data_member_model->kelola_biodata_get_informasi();
    echo json_encode($data);    
    }

    public function hapus_data_paket_member(){
    	
    	$this->Admin_data_member_model->hapus_invoice_paket();
    	$this->Admin_data_member_model->hapus_paket_member();
 
    	$data =  array('pesan' => "<div class='alert alert-success'>Hapus Paket Berhasil</div>");
        echo json_encode($data);
    }

    public function inputpaketmember(){
    $this->form_validation->set_rules('usr', 'usr', 'trim|required|numeric');
     $this->form_validation->set_rules('id', 'id', 'trim|required|numeric');
     $this->form_validation->set_rules('paketmember[]', 'paketmember', 'trim|required|numeric');
     $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

       if ($this->form_validation->run() == TRUE) { 
       	 $datapaket = $this->input->post('paketmember',TRUE);
         $this->Admin_data_member_model->hapus_invoice_paket();
         $this->Admin_data_member_model->inputdatapaketmember($datapaket);
         $data = array('pesan' => "<div class='alert alert-success'>terimakasih paket telah diinput</div>");
       		echo json_encode($data);
         } 
         else{
         	$datar = validation_errors();
			$data = array('pesan' => $datar);
       		echo json_encode($data);
         }
    }

    public function pri_member(){
    $data['jmlnotif'] = $this->Admin_data_notifikasi_model->notifikasi_jumlah();
    $data['datadiri'] = $this->Admin_model->getDataDiri();
    $data['menu'] = $this->Admin_kelola_hakakses_model->get_data_menu('menu_panel', 'id_menu', 'ASC');
    $this->load->view('admin/header_biodata_member');
    $this->load->view('admin/modal');
    $this->load->view('admin/modal_biodata_member'); 
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/sidebar',$data);  
    $this->load->view('admin/konten_biodata_member'); 
    $this->load->view('admin_head_and_foot/footer');
    $this->load->view('admin/script_biodata_member',$data);
    $this->load->view('admin/script_menu');
    $this->load->view('admin_head_and_foot/endoftag');  
    }

    public function getbiodata(){
     $list = $this->Admin_biodata_member_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->username;
            $row[] = $field->nama;
            $row[] = $field->sekolah;
            $row[] = $field->jenis_kelamin;
            $row[] = $field->no_hp;
            $row[] = $field->user_id;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Admin_biodata_member_model->count_all(),
            "recordsFiltered" => $this->Admin_biodata_member_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function getbiodatabyid(){
        $data = $this->Admin_biodata_member_model->getbiodatabyid();
        echo json_encode($data);
    }

}
           