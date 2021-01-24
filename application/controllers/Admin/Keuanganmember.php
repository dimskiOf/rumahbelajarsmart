<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Keuanganmember extends CI_Controller {

     public function __construct()
        {
                parent::__construct();
                $this->load->model('Admin_model');
                $this->load->model('Admin_kelola_hakakses_model');
                $this->load->model('Admin_data_keuangan_model');
                $this->load->model('Admin_data_invoice_model');
                $this->load->model('Admin_data_pembayaran_model');
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
    $this->load->view('admin/header_data_keuangan');
    $this->load->view('admin/modal');
    $this->load->view('admin/modal_data_keuangan'); 
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/sidebar',$data);  
    $this->load->view('admin/konten_data_keuangan'); 
    $this->load->view('admin_head_and_foot/footer');
    $this->load->view('admin/script_data_keuangan');
    $this->load->view('admin/script_menu');
    $this->load->view('admin_head_and_foot/endoftag');
    }

    public function kelola_data_keuangan(){
     $DaysEn = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday','January','February','March','April','May','June','July','August','September','October','November','December');
     $DaysId = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');
     $list = $this->Admin_data_keuangan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama;
            $row[] = $field->sekolah;
            $row[] = $field->status;
            $row[] = $field->no_hp;
            $row[] = $field->user_id;
            $row[] = $field->foto_profil;
            $row[] = $field->jenis_kelamin;
            $row[] = $field->email;
            $row[] = $field->alamat;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Admin_data_keuangan_model->count_all(),
            "recordsFiltered" => $this->Admin_data_keuangan_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function kelola_data_pembayaran(){
     $DaysEn = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday','January','February','March','April','May','June','July','August','September','October','November','December');
     $DaysId = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');
     $list = $this->Admin_data_pembayaran_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = 'Inv - '.$field->id_invoice;
            $row[] = 'Rp '.number_format($field->jml_pembayaran,2,',','.');
            $row[] = str_replace($DaysEn,$DaysId,date('l, d F Y h:i A', strtotime($field->tgl_pembayaran)));
            $row[] = $field->status_pembayaran;
            $row[] = $field->id_invoice;
            $row[] = $field->user_id;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Admin_data_pembayaran_model->count_all(),
            "recordsFiltered" => $this->Admin_data_pembayaran_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function getinvoiceall(){
     $DaysEn = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday','January','February','March','April','May','June','July','August','September','October','November','December');
     $DaysId = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');
     $list = $this->Admin_data_invoice_model->get_datatables();
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
            "recordsTotal" => $this->Admin_data_invoice_model->count_all(),
            "recordsFiltered" => $this->Admin_data_invoice_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);


    }

    public function konfirmasipembayaran(){
     $this->form_validation->set_rules('kd_inv', 'kd_inv', 'trim|required|numeric');
     $this->form_validation->set_rules('kd_pem', 'kd_pem', 'trim|required|numeric');
     $this->form_validation->set_rules('kalkulasi', 'kalkulasi', 'trim|required|numeric');
     $this->form_validation->set_rules('statuspem', 'statuspem', 'trim|required');
     $this->form_validation->set_rules('jml_pem', 'jml_pem', 'trim|required|numeric');

     $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

       if ($this->form_validation->run() == TRUE) { 
         $this->Admin_data_pembayaran_model->notifkonfirmpembayaran();
         $this->Admin_data_pembayaran_model->konfirmasipembayaran();
         $jmlterbayar =  $this->Admin_data_pembayaran_model->selekkeadaanpembayaran();
         if (!empty($jmlterbayar)){
                  foreach ($jmlterbayar as $rows) {
                    $terbayar = $rows['terbayar'];
                  }
            if ($terbayar == $this->input->post('kalkulasi')){
                $this->Admin_data_invoice_model->updatelunas();

              }elseif($terbayar > $this->input->post('kalkulasi')){
                $this->Admin_data_invoice_model->updatelunas();
              }
            }
         $data = array('pesan' => "<div class='alert alert-success'>Berhasil Dikonfirmasi</div>");
            echo json_encode($data);
         } 
         else{
            $datar = validation_errors();
            $data = array('pesan' => $datar);
            echo json_encode($data);
         }
    }

    public function getkonfirmtagihan(){
       $data = $this->Admin_data_pembayaran_model->getkonfirmtagihan();
        echo json_encode($data); 
    }

    public function getkirimtagihan(){
        $data = $this->Admin_data_invoice_model->getkirimtagihan();
        foreach ($data as $row) {
            $tes = $row['user_id'];
        }
        if ($tes !== null){
        echo json_encode($data);
        }else{
        $notpotongan = $this->Admin_data_invoice_model->notpotongan();
        echo json_encode($notpotongan);
        }
        
    }

    public function kirimdatatagihanmember(){
     $this->form_validation->set_rules('idtagihanuser', 'idtagihanuser', 'trim|required|numeric');
     $this->form_validation->set_rules('orgtagihan', 'orgtagihan', 'trim|required');
     $this->form_validation->set_rules('tagihan', 'tagihan', 'trim|required|numeric');
     $this->form_validation->set_rules('potongan', 'potongan', 'trim|numeric');

     $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

       if ($this->form_validation->run() == TRUE) { 
         $this->Admin_data_invoice_model->insertnotifikasi();
         $this->Admin_data_invoice_model->inputdatatagihanmember();
         $data = array('pesan' => "<div class='alert alert-success'>Tagihan Terkirim</div>");
            echo json_encode($data);
         } 
         else{
            $datar = validation_errors();
            $data = array('pesan' => $datar);
            echo json_encode($data);
         }
    }

    public function getinvoice(){
        $DaysEn = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday','January','February','March','April','May','June','July','August','September','October','November','December');
        $DaysId = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');
        $output = '';
        $data = $this->Admin_data_invoice_model->getinvoice();
        if (!empty($data)){
            foreach ($data as $row) {
           $output .= '<tr>
                        <th>foto member:</th>
                        <td><div id="mediass"><img src="'.base_url('assets/img/foto-profil/'.$row['foto_profil']).'" style="width:30%"></div></td> 
                       </tr>
                       <tr>
                        <th>Nama:</th>
                        <td>'.$row['nama'].'</td>  
                       </tr>
                       <tr>
                        <th>Tagihan:</th>
                        <td>Rp '.number_format($row['subtot'],2,',','.').'</td>  
                       </tr>
                       <tr>
                        <th>Tanggal Terbit Tagihan:</th>
                        <td>'.str_replace($DaysEn,$DaysId,date('l, d F Y h:i A', strtotime($row['lates']))).'</td>  
                       </tr>
                       ';
            }
            echo $output;
        }else{
            $output = '<tr>
                        <th>foto member:</th>
                        <td>-</td> 
                       </tr>
                       <tr>
                        <th>Nama:</th>
                        <td>-</td>  
                       </tr>
                       <tr>
                        <th>Tagihan:</th>
                        <td>-</td>  
                       </tr>
                       <tr>
                        <th>Tanggal Terbit Tagihan:</th>
                        <td>-</td>  
                       </tr>
                       ';
            echo $output;
        }
    }

    public function hapustagihan(){
       $valid = $this->Admin_data_invoice_model->hapustagihan();
       if ($valid == true){
        $this->Admin_data_invoice_model->hapustblpembayaran();
        $data = array('pesan' => "<div class='alert alert-success'>Tagihan dihapus</div>");
            echo json_encode($data);
       }else{
        $data = array('pesan' => "<div class='alert alert-danger'>Data Tidak Valid</div>");
            echo json_encode($data);
       }
    }

}