<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Data_profil extends CI_Controller {

 	 public function __construct()
        {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Akun_profile_model');
        $this->load->model('Admin_data_notifikasi_model');
        $this->load->library('form_validation');
        $this->load->library('upload');
        switch ($this->session->userdata('privilages')) {
        case '' : redirect(base_url('member/login'),'refresh'); break;
            }
        }
               
        
    public function index()
    {
    $data['jmlnotif'] = $this->Admin_data_notifikasi_model->notifikasi_jumlah();
    $data['datadiri'] = $this->Admin_model->getDataDiri();
    $this->load->view('profiler/header');
    $this->load->view('admin/modal');
    $this->load->view('admin/navbar',$data);
    $this->load->view('admin/sidebar',$data);  
    $this->load->view('profiler/konten');
    $this->load->view('admin_head_and_foot/footer'); 
    $this->load->view('profiler/footer');
    $this->load->view('admin/script_menu');
    $this->load->view('admin_head_and_foot/endoftag');  
    }

    public function update_profil(){
      if ($this->session->userdata('id') == $this->input->post('id_users')){
      $this->form_validation->set_rules('nama-usr', 'Nama', 'trim|required|callback_alpha_dash_space');
      $this->form_validation->set_rules('klmn-usr', 'Jenis Kelamin', 'trim|required');
      $this->form_validation->set_rules('password', 'Password', 'min_length[6]|max_length[25]|callback_harus_gege');
      $this->form_validation->set_rules('password2', 'Password Confirmation', 'matches[password]');
      $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
      if ($this->form_validation->run() == TRUE) { 
             $this->Akun_profile_model->updatedataprofil();
             $data = array('pesan' => "<div class='alert alert-success'>Update Data Berhasil</div>");
             echo json_encode($data);
         } 
         else{
             $datar = validation_errors();
             $data = array('pesan' => $datar);
             echo json_encode($data);
         }
      }else{
        $data = array('pesan' => "<div class='alert alert-danger'>Update Data Tidak Berhasil</div>");
        echo json_encode($data);
      }
   
  }

  function harus_gege($password){
    if (!(preg_match('#[0-9]#', $password) && preg_match('#[A-Z]#', $password) && preg_match('/[!@#$%^&*]+/', $password))){
      $this->form_validation->set_message('harus_gege', 'Password harus berisi minimal satu huruf kapital, satu nomor, dan satu karakter (!@#$%^&*)');
      return false;
    }else{
      return true;
    }
  }

  function alpha_dash_space($nama){
    if (! preg_match('/^[a-zA-Z\s]+$/', $nama)) {
        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
        return FALSE;
    } else {
        return TRUE;
    }
  }

    public function update_foto_profil(){
      if ($this->session->userdata('id') == $this->input->post('id_users')){
      $config['upload_path'] = './assets/img/foto-profil/'; //path folder
      $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
      $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
      $this->upload->initialize($config);
      
      $b = $this->input->post('id_users');
      $query = $this->Akun_profile_model->cekit($b);
      
      foreach ($query as $row => $dummydel) {
                  $fotodummy =  $dummydel['foto_profil'];
                }
      $imges = "assets/img/foto-profil/".$fotodummy;
      if (file_exists($imges)){
                   unlink($imges);
            } 

      if(!empty($_FILES['fotoprofil']['name'])){
        if ($this->upload->do_upload('fotoprofil')) { 
            $gbr = $this->upload->data();
            $config['image_library']='gd2';
            $config['source_image']='./assets/img/foto-profil/'.$gbr['file_name'];
            $config['create_thumb']= FALSE;
            $config['maintain_ratio']= FALSE;
            $config['quality']= '100%';
            $config['width']= 500;
            $config['height']= 500;
            $config['new_image']= './assets/img/foto-profil/'.$gbr['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $a=$gbr['file_name'];

          //  $this->Tabel_model->updatingfotoprofilforchat($a);
            $this->Akun_profile_model->updating_foto_profil($a);
            $this->session->set_userdata($a);
            $data = array('pesan' => "<div class='alert alert-success'>Update Data Foto Profil Berhasil</div>",'detrox' => $a);
            echo json_encode($data);
      }else{
            $data = array('pesan' => "<div class='alert alert-danger'>ext tidak valid</div>");
            echo json_encode($data);
      }
      }else{
            $data = array('pesan' => "<div class='alert alert-danger'>File Kosong atau Ekstensi Tidak Valid</div>");
           echo json_encode($data);
      }

    } else {
      $data = array('pesan' => "<div class='alert alert-danger'>Update Data Tidak Berhasil</div>");
      echo json_encode($data);
    }
   
  }

   public function user(){
        $username = $this->session->userdata('id');
        $data = $this->Akun_profile_model->getuserprofil($username);
        echo json_encode($data);
    }

}