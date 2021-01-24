  <?php defined('BASEPATH') OR exit('No direct script access allowed');
class Chating extends CI_Controller {

   public function __construct()
        {
                parent::__construct();
                $this->load->model('Chating_model');
        switch ($this->session->userdata('privilages')) {
        case '' : redirect(base_url('member/login'),'refresh'); break;
        
            }
        }
               
        
    public function index()
    {
          $datal = array();
          $data = $this->Chating_model->ambil($this->input->post('limit'), $this->input->post('start'));
        foreach ($data as $date => $value) {
           $datal[$date] = $value['datetime'];  
          }
          array_multisort($datal, SORT_ASC, $data);
          echo json_encode($data, JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS);   
      }

    public function send(){
    if ($this->session->userdata('token')){
            $nama = $this->session->userdata('namas');
            $userid = $this->session->userdata('userid');
            $token = $this->session->userdata('token');
            date_default_timezone_set('Asia/Jakarta');
            $waktu = date('Y-m-d H:i:s');
    if (!empty($this->input->post('ms')) and !empty($this->input->post('pp'))){
            $chatusr = $this->input->post('ms');
            $foto_profil = $this->input->post('pp');
            $this->Chating_model->kirimmessage($userid, $waktu, $token, $nama, $chatusr ,$foto_profil);
    require_once(APPPATH.'/vendor/autoload.php');
            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new  Pusher\Pusher(
                '03390b8b7160498ec7dc', //ganti dengan App_key pusher Anda
                '2019924890ffdf16030d', 
                '865726', 
                $options
            );
            $data['message'] = 'success';
            $pusher->trigger('my-channel', 'my-event', $data);
            }else{
            
            }      
        }else{
            echo 'anti hacker method';
        }
    }
    }