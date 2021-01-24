 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin_data_member_model extends CI_Model {

	var $table = 'tbl_user'; //nama tabel dari database
    var $column_order = array('user_id', 'nama','username','jenis_kelamin','tgl_daftar','email','privilage','sekolah','status','alamat'); //field yang ada di table user
    var $column_search = array('username','nama','sekolah'); //field yang diizin untuk pencarian 
    var $order = array('user_id' => 'desc'); // default order 

 public function __construct()
    {
        parent::__construct();
      

    }
     private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
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
        $this->db->where('privilage','MEMBER');
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->where('privilage','MEMBER');
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        $this->db->where('privilage','MEMBER');
        return $this->db->count_all_results();
    }

    public function kelola_biodata_get_informasi()
    {
    $this->db->select('a.user_id,b.*,c.*');
    $this->db->from('tbl_user a');
    $this->db->join('tbl_pemilihan_informan b', 'b.user_id = a.user_id','inner');
    $this->db->join('informan c', 'c.id_informasi = b.id_informan','inner');
    $this->db->where('a.user_id',$this->input->post('usr'));
    return $this->db->get()->result_array(); 
    }

    public function getmemberpaket(){
    	$this->db->select('a.*,b.*');
		$this->db->from('tbl_user a');
		$this->db->join('tbl_pembelian_paket ab', 'ab.id_user = a.user_id','inner');
		$this->db->join('paket_bimbel b', 'b.id_paket = ab.id_paket','inner');
		$this->db->where('a.user_id',$this->input->post('usr'));
		return $this->db->get()->result_array();
    }

    public function nonaktifmember(){
    	$this->db->set('status', $this->input->post('stat'));
		$this->db->where('user_id', $this->input->post('usr'));
		$this->db->where('privilage', 'MEMBER');
		return $this->db->update('tbl_user');
    }

    public function hapus_paket_member(){
    	$this->db->where('id_paket', $this->input->post('ip'));
    	$this->db->where('id_user', $this->input->post('usr'));
	return	$this->db->delete('tbl_pembelian_paket');
    }
   
    public function hapus_invoice_paket(){
    $this->db->where('user_id', $this->input->post('usr'));
    $this->db->where('status', 'Aktif');
	return	$this->db->delete('invoice');
    }

    public function inputdatapaketmember($datapaket){
    $this->db->trans_start();
    date_default_timezone_set('Asia/Jakarta');

    $result = array();
        foreach($datapaket AS $key => $val){
             $result[] = array(
              'id_paket'   => $_POST['paketmember'][$key],
              'tgl_pembelian'   => date('Y-m-d H:i:s'),
              'id_user' => $this->input->post('id')
             );
        }      
    $this->db->insert_batch('tbl_pembelian_paket', $result);
    $this->db->trans_complete();
    }

}