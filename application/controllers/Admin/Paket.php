<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Paket extends CI_Controller {

     public function __construct()
        {
                parent::__construct();
                $this->load->model('Admin_model');
                $this->load->model('Admin_kelola_hakakses_model');
                $this->load->model('Admin_kelola_paket_produk_model');
                $this->load->model('Admin_data_notifikasi_model');
                $this->load->library('upload');
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
    $this->load->view('admin/header_data_paket');
    $this->load->view('admin/modal');
    $this->load->view('admin/modal_paket'); 
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/sidebar',$data);  
    $this->load->view('admin/konten_paket'); 
    $this->load->view('admin_head_and_foot/footer');
    $this->load->view('admin/script_data_paket');
    $this->load->view('admin/script_menu');
    $this->load->view('admin_head_and_foot/endoftag');
    }

    public function getpaket(){
      $DaysEn = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday','January','February','March','April','May','June','July','August','September','October','November','December');
     $DaysId = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');
     $list = $this->Admin_kelola_paket_produk_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_paket;
            $row[] = $field->status;
            $row[] = '<image alt="tidak ada gambar" src="'.base_url('assets/img/paket/').$field->gambar_paket.'" style=width:50%;>';
            $row[] = 'Rp '.number_format($field->harga_paket,2,',','.');
            $row[] = $field->id_paket;
            $row[] = $field->nama_paket;
            $row[] = $field->status;
            $row[] = $field->gambar_paket;
            $row[] = $field->harga_paket;
            $row[] = $field->rincian_paket;
            $row[] = $field->kurikulum_paket;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Admin_kelola_paket_produk_model->count_all(),
            "recordsFiltered" => $this->Admin_kelola_paket_produk_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function getpaketbyid(){
        $data = $this->Admin_kelola_paket_produk_model->getpaketbyid();
        echo json_encode($data);
    }

    public function editdatapaket(){
     $this->form_validation->set_rules('idp', 'idp', 'trim|required|numeric');
     $this->form_validation->set_rules('paket_nama1', 'paket_nama1', 'trim|required');
     $this->form_validation->set_rules('status_paket1', 'status_paket', 'trim|required');
     $this->form_validation->set_rules('paket_harga1', 'paket_harga1', 'trim|required');
     $this->form_validation->set_rules('rincian_paket1', 'rincian_paket1', 'trim|required');
     $this->form_validation->set_rules('kurikulum_paket1', 'kurikulum_paket1', 'trim|required');

     $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

       if ($this->form_validation->run() == TRUE) { 
         $this->Admin_kelola_paket_produk_model->updatepaket();
         $data = array('pesan' => "<div class='alert alert-success'>Paket Berhasil Diubah</div>");
            echo json_encode($data);
         } 
         else{
            $datar = validation_errors();
            $data = array('pesan' => $datar);
            echo json_encode($data);
         }
    }

    public function hapuspaket(){
        $valid = $this->Admin_kelola_paket_produk_model->hapuspaket();
       if ($valid == true){
        $data = array('pesan' => "<div class='alert alert-success'>Paket dihapus</div>");
            echo json_encode($data);
       }else{
        $data = array('pesan' => "<div class='alert alert-danger'>Data Tidak Valid</div>");
            echo json_encode($data);
       }
    }

    public function editfotopaket(){
      $config['upload_path'] = './assets/img/paket/'; //path folder
      $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
      $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
      $this->upload->initialize($config);
      
      $query = $this->Admin_kelola_paket_produk_model->cekitfotpak();
      
      foreach ($query as $row => $dummydel) {
                  $fotodummy =  $dummydel['gambar_paket'];
                }
      $imges = "assets/img/paket/".$fotodummy;
      $imgesSmall = "assets/img/paket/small/".$fotodummy;
      $imgesMedium = "assets/img/paket/medium/".$fotodummy;
      if (file_exists($imges)){
                   unlink($imges);
                   unlink($imgesSmall);
                   unlink($imgesMedium);
            } 

      if(!empty($_FILES['fotopaketname']['name'])){
        if ($this->upload->do_upload('fotopaketname')) { 
            $gbr = $this->upload->data();

            $this->_create_thumbs($gbr['file_name']);

            $a=$gbr['file_name'];

            $this->Admin_kelola_paket_produk_model->updating_fotopk($a);
            $data = array('pesan' => "<div class='alert alert-success'>Input Foto Berhasil</div>",'detrox' => $a);
            echo json_encode($data);
      }else{
            $data = array('pesan' => "<div class='alert alert-danger'>ext tidak valid</div>");
            echo json_encode($data);
      }
      }else{
            $data = array('pesan' => "<div class='alert alert-danger'>File Kosong atau Ekstensi Tidak Valid</div>");
           echo json_encode($data);
      }
    
    }

      function _create_thumbs($file_name){
        // Image resizing config
        $config = array(
          // Large Image
            array(
                'image_library' => 'GD2',
                'source_image'  => './assets/img/paket/'.$file_name,
                'maintain_ratio'=> FALSE,
                'width'         => 750,
                'height'        => 439,
                'new_image'     => './assets/img/paket/'.$file_name
                ),
            // Medium Image
            array(
                'image_library' => 'GD2',
                'source_image'  => './assets/img/paket/'.$file_name,
                'maintain_ratio'=> FALSE,
                'width'         => 500,
                'height'        => 500,
                'new_image'     => './assets/img/paket/medium/'.$file_name
                ),
            // Small Image
            array(
                'image_library' => 'GD2',
                'source_image'  => './assets/img/paket/'.$file_name,
                'maintain_ratio'=> FALSE,
                'width'         => 100,
                'height'        => 80,
                'new_image'     => './assets/img/paket/small/'.$file_name
            ));
 
        $this->load->library('image_lib', $config[0]);
        foreach ($config as $item){
            $this->image_lib->initialize($item);
            if(!$this->image_lib->resize()){
                return false;
            }
            $this->image_lib->clear();
        }
    }

    public function inputpaket(){
        $config['upload_path'] = './assets/img/paket/'; //path folder
        $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
        $this->upload->initialize($config);

        $this->form_validation->set_rules('paket_nama2', 'Nama Paket', 'required');
        $this->form_validation->set_rules('status_paket2', 'Status Paket', 'required');
        $this->form_validation->set_rules('paket_harga2', 'Harga', 'required|numeric|trim');
        $this->form_validation->set_rules('rincian_paket2', 'Rincian Paket', 'required');
        $this->form_validation->set_rules('kurikulum_paket2', 'Kurikulum Paket', 'required');
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if(!empty($_FILES['fotopaketname2']['name'])){
            $ext = pathinfo($_FILES['fotopaketname2']['name'], PATHINFO_EXTENSION);

        if ($this->form_validation->run() == TRUE){
        if ($this->upload->do_upload('fotopaketname2')){
            $gbr = $this->upload->data();
             //Compress Image
            $this->_create_thumbs($gbr['file_name']);

            $this->Admin_kelola_paket_produk_model->inputpaket($gbr['file_name']);

            $data = array('pesan' => "<div class='alert alert-success'>Input Data Berhasil</div>");

            chmod('./assets/img/paket/' . $gbr['file_name'], 0644);
            chmod('./assets/img/paket/small/' .  $gbr['file_name'], 0644);
            chmod('./assets/img/paket/medium/' . $gbr['file_name'], 0644);
            echo json_encode($data);

         } else {

           $data = array('pesan' => "<div class='alert alert-danger'>ext tidak valid</div>");
           echo json_encode($data);
            
         } 
        } else {

           $datar = validation_errors();
           $data = array('pesan' => $datar);
           echo json_encode($data);

        }
        }else{

           $data = array('pesan' => "<div class='alert alert-danger'>File Media Kosong atau Ekstensi Tidak Valid</div>");
           echo json_encode($data);

        }
    }
}