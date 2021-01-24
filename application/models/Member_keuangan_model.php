 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Member_keuangan_model extends CI_Model {

	var $table = 'invoice a'; //nama tabel dari database
    var $column_order = array('a.user_id', 'a.id_invoice','b.nama','a.tagihan','a.potongan','a.tgl'); //field yang ada di table user
    var $column_search = array('a.tagihan','a.id_invoice','username','nama','sekolah'); //field yang diizin untuk pencarian 
    var $order = array('a.user_id' => 'desc'); // default order 

	public function __construct()
    {
        parent::__construct();
      

    }

      private function _get_datatables_query()
    {
        $this->db->select('a.*,b.user_id,b.nama,b.username'); 
        $this->db->from($this->table);
        $this->db->join('tbl_user b', 'b.user_id = a.user_id','inner');
		$this->db->where('a.user_id',$this->session->userdata('userid'));
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
    	$this->db->select('a.*,b.user_id,b.nama,b.username'); 
        $this->db->from($this->table);
        $this->db->join('tbl_user b', 'b.user_id = a.user_id','inner');
        return $this->db->count_all_results();
    }

        public function getkonfirmtagihan(){
        $this->db->select('a.*,b.*,c.user_id,c.username');
        $this->db->from($this->table);
        $this->db->join('tbl_pembayaran b', 'a.id_invoice = b.id_invoice','inner');
        $this->db->join('tbl_user c', 'a.user_id = c.user_id','inner');
        $this->db->where('a.id_invoice',$this->input->post('inv'));
        $this->db->where('a.user_id',$this->session->userdata('userid'));
        return $this->db->get()->result_array();
    }

    public function getkonfirmtagihan2(){
        $data = array(array('status_pembayaran' => 'Belum ada pembayaran','bukti_pembayaran' => '-','jml_pembayaran' => 0,'tgl_pembayaran' => '-'));
        return $data;
    }

    public function getmemberpaket(){
    	$this->db->select('a.user_id,a.nama,b.*,c.*,(tagihan - potongan) as total');
		$this->db->from('tbl_user a');
		$this->db->join('tbl_pembelian_paket ab', 'ab.id_user = a.user_id','inner');
		$this->db->join('paket_bimbel b', 'b.id_paket = ab.id_paket','inner');
		$this->db->join('invoice c', 'c.user_id = ab.id_user','inner');
		$this->db->where('a.user_id',$this->session->userdata('userid'));
		$this->db->where('c.status','Aktif');
		return $this->db->get()->result_array();
    }
    public function getmemberpaket2(){
    	$data = array(array('user_id' => 0,'nama' => 0, 'total' => 0, 'id_invoice' => 0,'status' => 0,'tagihan' => 0,'tgl' => 0,'potongan' => 0,'status2' => 0,'nama_paket' => 'Belum Ada Tagihan', 'harga_paket' => 0));
		return $data;
    }

    public function getinvoicebyid()
    {
    	$this->db->select('*');
		$this->db->from('invoice');
		$this->db->where('user_id',$this->session->userdata('userid'));
		$this->db->where('status','Aktif');
		return $this->db->get()->result_array();
    }

    public function getmemberpembayaran(){
    	$this->db->select('a.*,b.*,c.user_id');
        $this->db->from('invoice a');
        $this->db->join('tbl_pembayaran b', 'a.id_invoice = b.id_invoice','inner');
        $this->db->join('tbl_user c', 'a.user_id = c.user_id','inner');
        $this->db->where('c.user_id',$this->session->userdata('userid'));
        $this->db->where('a.status2','Dalam Pembayaran');
        return $this->db->get()->result_array();
    }

    public function getmemberpembayaran2(){
        $data = array(array('status_pembayaran' => 'Belum ada pembayaran','id_invoice' => '-', 'tgl_pembayaran' => '-', 'jml_pembayaran' => 0));
        return $data;
    }

    public function getmemberrekapitulasi(){
    	$this->db->select('a.*,b.*,c.user_id,sum(jml_pembayaran) AS subtot,((a.tagihan - a.potongan) - sum(jml_pembayaran)) AS total');
        $this->db->from('invoice a');
        $this->db->join('tbl_pembayaran b', 'a.id_invoice = b.id_invoice','inner');
        $this->db->join('tbl_user c', 'a.user_id = c.user_id','inner');
        $this->db->where('c.user_id',$this->session->userdata('userid'));
        $this->db->where('a.status2','Dalam Pembayaran');
        return $this->db->get()->result_array();
    }

    public function submit($data)
    {	
    	date_default_timezone_set('Asia/Jakarta');
    	$data = array('id_invoice' => $this->input->post('idinv'),'bukti_pembayaran' => $data,'status_pembayaran' => 'Menunggu Konfirmasi', 'jml_pembayaran' => '0','tgl_pembayaran' => date('Y-m-d H:i:s'));
    	$this->db->insert('tbl_pembayaran',$data);
    }

    public function alluser(){
    $this->db->select('user_id');
    $this->db->from('tbl_user');
    $this->db->where('privilage !=','MEMBER');
    return $this->db->get()->result_array();
 	}

    public function inputnotifikasitoadmin(){
    $DaysEn = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday','January','February','March','April','May','June','July','August','September','October','November','December');
     $DaysId = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');
    $this->db->trans_start();
    date_default_timezone_set('Asia/Jakarta');
    $data = $this->Member_keuangan_model->alluser();
    $result = array();
        foreach($data as $key){
             $result[] = array(
              'user_id'   => $key['user_id'],
              'tanggal'   => date('Y-m-d H:i:s'),
              'tentang_notif' => 'Pembayaran Member',
              'jenis_notifikasi' => '2',
              'isi_notifikasi' => 'Pembayaran A/N '. $this->input->post('nm'). 'Sudah dilakukan pada hari '.str_replace($DaysEn,$DaysId,date('l, d F Y h:i A', strtotime(date('Y-m-d H:i:s') ))).'silahkan lakukan konfirmasi pembayaran.',
              'status' => 'BELUM DIBACA'
             );
        }      
    $this->db->insert_batch('tbl_notifikasi', $result);
    $this->db->trans_complete();
}

}