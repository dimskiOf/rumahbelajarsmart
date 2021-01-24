<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Bayar extends CI_Controller {

     public function __construct()
        {
                parent::__construct();
                $this->load->model('Admin_model');
                $this->load->model('Admin_kelola_hakakses_model');
                $this->load->model('Admin_data_notifikasi_model');
                $this->load->model('Member_keuangan_model');
                $this->load->library('upload');
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
    $this->load->view('member/header_data_pembayaran');
    $this->load->view('admin/modal');
    $this->load->view('member/modal_data_pembayaran'); 
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/sidebar',$data);  
    $this->load->view('member/konten_data_pembayaran'); 
    $this->load->view('admin_head_and_foot/footer');
    $this->load->view('member/script_data_pembayaran');
    $this->load->view('admin/script_menu');
    $this->load->view('admin_head_and_foot/endoftag');
    } 

    public function getkonfirmtagihan(){
       $data = $this->Member_keuangan_model->getkonfirmtagihan();
       if ($data != null){
        echo json_encode($data);
        }else{
            $data = $this->Member_keuangan_model->getkonfirmtagihan2();
            echo json_encode($data);
        } 
    }

    public function getinvoiceall(){
     $DaysEn = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday','January','February','March','April','May','June','July','August','September','October','November','December');
     $DaysId = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');
     $list = $this->Member_keuangan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = 'Inv - '.$field->id_invoice;
            $row[] = $field->nama;
            $row[] = $field->status2;
            $row[] = 'Rp '.number_format($field->tagihan,2,',','.');
            $row[] = 'Rp '.number_format($field->potongan,2,',','.');
            $row[] = str_replace($DaysEn,$DaysId,date('l, d F Y h:i A', strtotime($field->tgl))); 
            $row[] = $field->user_id;
            $row[] = $field->id_invoice;
            $row[] = $field->tagihan;
            $row[] = $field->potongan;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Member_keuangan_model->count_all(),
            "recordsFiltered" => $this->Member_keuangan_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function tampil()
    {
    $data['jmlnotif'] = $this->Admin_data_notifikasi_model->notifikasi_jumlah();
    $data['datadiri'] = $this->Admin_model->getDataDiri();
    $data['menu'] = $this->Admin_kelola_hakakses_model->get_data_menu('menu_panel', 'id_menu', 'ASC');
    $this->load->view('member/header_log_pembayaran');
    $this->load->view('admin/modal');
    $this->load->view('member/modal_log_pembayaran'); 
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/sidebar',$data);  
    $this->load->view('member/konten_log_pembayaran'); 
    $this->load->view('admin_head_and_foot/footer');
    $this->load->view('member/script_log_pembayaran');
    $this->load->view('admin/script_menu');
    $this->load->view('admin_head_and_foot/endoftag');   
    }

    public function tagihan()
    {
    
    $data2 = $this->Member_keuangan_model->getinvoicebyid();

    if ($data2 != null){
    $data = $this->Member_keuangan_model->getmemberpaket();
    echo json_encode($data);
    }else{
    $data = $this->Member_keuangan_model->getmemberpaket2();
    echo json_encode($data);
    }

    }
    public function pembayaran()
    {
     $data = $this->Member_keuangan_model->getmemberpembayaran();
     if ($data != null){
    echo json_encode($data);
    }else{
    $data = $this->Member_keuangan_model->getmemberpembayaran2();
    echo json_encode($data); 
    }

    }
    public function rekapitulasi()
    {
     $data = $this->Member_keuangan_model->getmemberrekapitulasi();
    echo json_encode($data);
    }

    public function submit()
    {
        $config['upload_path'] = './assets/img/bukti_pembayaran/'; //path folder
        $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
        $this->upload->initialize($config);

        $this->form_validation->set_rules('idinv', 'Manipulasi Data', 'required|numeric');
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if(!empty($_FILES['fotobukti']['name'])){
            $ext = pathinfo($_FILES['fotobukti']['name'], PATHINFO_EXTENSION);

        if ($this->form_validation->run() == TRUE){
        if ($this->upload->do_upload('fotobukti')){
            $gbr = $this->upload->data();
             //Compress Image
            $this->_create_thumbs($gbr['file_name']);

            $this->Member_keuangan_model->submit($gbr['file_name']);
            $this->Member_keuangan_model->inputnotifikasitoadmin();
            $data = array('pesan' => "<div class='alert alert-success'>Pembayaran Berhasil</div>");

            chmod('./assets/img/bukti_pembayaran/' . $gbr['file_name'], 0644);
            chmod('./assets/img/bukti_pembayaran/small/' .  $gbr['file_name'], 0644);
            chmod('./assets/img/bukti_pembayaran/medium/' . $gbr['file_name'], 0644);
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
                'source_image'  => './assets/img/bukti_pembayaran/'.$file_name,
                'maintain_ratio'=> FALSE,
                'width'         => 750,
                'height'        => 439,
                'new_image'     => './assets/img/bukti_pembayaran/'.$file_name
                ),
            // Medium Image
            array(
                'image_library' => 'GD2',
                'source_image'  => './assets/img/bukti_pembayaran/medium/'.$file_name,
                'maintain_ratio'=> FALSE,
                'width'         => 500,
                'height'        => 500,
                'new_image'     => './assets/img/bukti_pembayaran/medium/'.$file_name
                ),
            // Small Image
            array(
                'image_library' => 'GD2',
                'source_image'  => './assets/img/bukti_pembayaran/small/'.$file_name,
                'maintain_ratio'=> FALSE,
                'width'         => 100,
                'height'        => 80,
                'new_image'     => './assets/img/bukti_pembayaran/small/'.$file_name
            ));
        }
}