<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Referal extends CI_Controller {

     public function __construct()
        {
                parent::__construct();
                $this->load->model('Admin_model');
                $this->load->model('Admin_kelola_hakakses_model');
                $this->load->model('Admin_data_referal_model');
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
    $this->load->view('admin/header_data_referal');
    $this->load->view('admin/modal');
    $this->load->view('admin/modal_data_referal'); 
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/sidebar',$data);  
    $this->load->view('admin/konten_data_referal'); 
    $this->load->view('admin_head_and_foot/footer');
    $this->load->view('admin/script_data_referal');
    $this->load->view('admin/script_menu');
    $this->load->view('admin_head_and_foot/endoftag');
    }

    public function getreferal(){
     $list = $this->Admin_data_referal_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->kode_referal;
            $row[] = $field->jumlah;
            $row[] = $field->potongan;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Admin_data_referal_model->count_all(),
            "recordsFiltered" => $this->Admin_data_referal_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function getreferalbyid(){
       $data = $this->Admin_data_referal_model->getreferalbyid();
       echo json_encode($data);
    }

    public function editdatareferal(){
     $this->form_validation->set_rules('kodereferal1', 'Kode referal', 'trim|required|alpha_numeric|exact_length[8]');
     $this->form_validation->set_rules('jmlreferal1', 'Jumlah Referal', 'trim|required|numeric');
     $this->form_validation->set_rules('potonganreferal1', 'Potongan Harga', 'trim|required|numeric');

     $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

       if ($this->form_validation->run() == TRUE) { 
         $this->Admin_data_referal_model->updatereferal();
         $data = array('pesan' => "<div class='alert alert-success'>Referal Berhasil Diubah</div>");
            echo json_encode($data);
         } 
         else{
            $datar = validation_errors();
            $data = array('pesan' => $datar);
            echo json_encode($data);
         }
    }

    public function inputreferal(){
     $this->form_validation->set_rules('kodereferal2', 'Kode referal', 'trim|required|alpha_numeric|exact_length[8]|strtoupper|callback_korel_check');
     $this->form_validation->set_rules('jmlreferal2', 'Jumlah Referal', 'trim|required|numeric');
     $this->form_validation->set_rules('potonganreferal2', 'Potongan Harga', 'trim|required|numeric');

     $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

       if ($this->form_validation->run() == TRUE) { 
         $this->Admin_data_referal_model->inputreferal();
         $data = array('pesan' => "<div class='alert alert-success'>Referal Berhasil Diinput</div>");
            echo json_encode($data);
         } 
         else{
            $datar = validation_errors();
            $data = array('pesan' => $datar);
            echo json_encode($data);
         }
    }

    function korel_check($korel){
         $query = $this->db->where('kode_referal', $korel)->get("referal");
         if ($query->num_rows() > 0)
            {
             $this->form_validation->set_message('korel_check','Gagal melakukan Input Kode Referal '.$korel.' sudah ada');
                return FALSE;
            }
          else 
              return TRUE;
    }


    public function hapusreferal()
    {
        $valid = $this->Admin_data_referal_model->hapusreferal();
       if ($valid == true){
        $data = array('pesan' => "<div class='alert alert-success'>Referal dihapus</div>");
            echo json_encode($data);
       }else{
        $data = array('pesan' => "<div class='alert alert-danger'>Data Tidak Valid</div>");
            echo json_encode($data);
       }
    }

}