<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin_data_invoice_model extends CI_Model {

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
        $this->db->select('a.*,b.*'); 
        $this->db->from($this->table);
        $this->db->join('tbl_user b', 'b.user_id = a.user_id','inner');
	//	$this->db->where('a.status','Aktif');
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
    	$this->db->select('a.*,b.*'); 
        $this->db->from($this->table);
        $this->db->join('tbl_user b', 'b.user_id = a.user_id','inner');
	//	$this->db->where('b.status','Aktif');
	//	$this->db->group_by("ab.id_user");
        return $this->db->count_all_results();
    }

    public function getinvoice(){
    	$this->db->select('a.*,b.*,c.*,sum(harga_paket) AS subtot, MAX(tgl) AS lates');
		$this->db->from('tbl_user a');
		$this->db->join('tbl_pembelian_paket ab', 'ab.id_user = a.user_id','inner');
		$this->db->join('paket_bimbel b', 'b.id_paket = ab.id_paket','inner');
		$this->db->join('invoice c', 'c.user_id = ab.id_user','inner');
		$this->db->where('c.user_id',$this->input->post('usr'));
		$this->db->where('c.status','Aktif');
		return $this->db->get()->result_array();
    }

    public function getkirimtagihan(){
    	$this->db->select('a.*,b.*,c.*,sum(harga_paket) AS subtot');
		$this->db->from('tbl_user a');
		$this->db->join('tbl_pembelian_paket ab', 'ab.id_user = a.user_id','inner');
		$this->db->join('paket_bimbel b', 'b.id_paket = ab.id_paket','inner');
        $this->db->join('referal c', 'c.kode_referal = a.kode_referal','inner');
		$this->db->where('a.user_id',$this->input->post('usr'));
		return $this->db->get()->result_array();
    }
     public function notpotongan(){
        $this->db->select('a.*,b.*,sum(harga_paket) AS subtot');
        $this->db->from('tbl_user a');
        $this->db->join('tbl_pembelian_paket ab', 'ab.id_user = a.user_id','inner');
        $this->db->join('paket_bimbel b', 'b.id_paket = ab.id_paket','inner');
        $this->db->where('a.user_id',$this->input->post('usr'));
        return $this->db->get()->result_array();
    }

    public function insertnotifikasi()
    {   
        date_default_timezone_set('Asia/Jakarta');
        $data = array(
        'user_id' => $this->input->post('idtagihanuser'),
        'jenis_notifikasi' => '2',
        'isi_notifikasi' => 'Halo '.$this->input->post('orgtagihan').' :) silahkan lakukan pembayaran',
        'tanggal' => date('Y-m-d H:i:s'),
        'status' => 'BELUM DIBACA',
        'tentang_notif' => 'Pembayaran' 
        );
        $this->db->insert('tbl_notifikasi', $data);
    }

    public function inputdatatagihanmember()
    {
    	date_default_timezone_set('Asia/Jakarta');
    	$data = array(
        'user_id' => $this->input->post('idtagihanuser'),
        'status' => 'Aktif',
        'status2' => 'Dalam Pembayaran',
        'tgl' => date('Y-m-d H:i:s'),
        'tagihan' => $this->input->post('tagihan'),
        'potongan' => $this->input->post('potongan') 
		);

		$this->db->insert('invoice', $data);
    }

    public function hapustagihan(){
    $this->db->where('id_invoice', $this->input->post('inv'));
    return  $this->db->delete('invoice');
    }
    public function hapustblpembayaran(){
    $this->db->where('id_invoice', $this->input->post('inv'));
    return  $this->db->delete('tbl_pembayaran');
    }
    public function updatelunas(){
    $this->db->set(array('status' => 'Tidak','status2' => 'Lunas'));
    $this->db->where('id_invoice', $this->input->post('kd_inv'));
    return $this->db->update('invoice');
    }
}