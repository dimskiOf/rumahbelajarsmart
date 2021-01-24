<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin_data_pembayaran_model extends CI_Model {

	var $table = 'invoice a'; //nama tabel dari database
    var $column_order = array('a.user_id', 'b.id_invoice','b.jml_pembayaran','b.tgl_pembayaran','b.status_pembayaran'); //field yang ada di table user
    var $column_search = array('b.id_invoice','username','nama','sekolah','b.status_pembayaran','a.tagihan','b.jml_pembayaran','b.tgl_pembayaran'); //field yang diizin untuk pencarian 
    var $order = array('b.tgl_pembayaran' => 'desc'); // default order 

 public function __construct()
    {
        parent::__construct();

    }
  private function _get_datatables_query()
    {
        $this->db->select('a.*,b.*,c.*');
        $this->db->from($this->table);
        $this->db->join('tbl_pembayaran b', 'a.id_invoice = b.id_invoice','inner');
        $this->db->join('tbl_user c', 'a.user_id = c.user_id','inner');
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
    	$this->db->select('a.*,b.*,c.*');
        $this->db->from($this->table);
        $this->db->join('tbl_pembayaran b', 'a.id_invoice = b.id_invoice','inner');
        $this->db->join('tbl_user c', 'a.user_id = c.user_id','inner');
	//	$this->db->where('c.status','Aktif');
	//	$this->db->group_by("ab.id_user");
        return $this->db->count_all_results();
    }

    public function getkonfirmtagihan(){
        $this->db->select('a.*,b.*,c.*');
        $this->db->from($this->table);
        $this->db->join('tbl_pembayaran b', 'a.id_invoice = b.id_invoice','inner');
        $this->db->join('tbl_user c', 'a.user_id = c.user_id','inner');
        $this->db->where('a.id_invoice',$this->input->post('inv'));
        return $this->db->get()->result_array();
    }

    public function notifkonfirmpembayaran()
    {
        
        date_default_timezone_set('Asia/Jakarta');

        if ($this->input->post('statuspem') == 'Gagal'){

        $data = array(
        'user_id' => $this->input->post('uid'),
        'jenis_notifikasi' => '2',
        'isi_notifikasi' => 'Halo '.$this->input->post('namas').' :) pembayaran yang kamu lakukan telah<font color="red"> Gagal :( </font>silahkan kirim kembali bukti pembayarannya yaah :)',
        'tanggal' => date('Y-m-d H:i:s'),
        'status' => 'BELUM DIBACA',
        'tentang_notif' => 'Pembayaran' 
        );
        }else{
        $data = array(
        'user_id' => $this->input->post('uid'),
        'jenis_notifikasi' => '2',
        'isi_notifikasi' => 'Halo '.$this->input->post('namas').' :) pembayaran yang kamu lakukan berhasil<font color="Green"> Dikonfirmasi </font>terimakasih :)',
        'tanggal' => date('Y-m-d H:i:s'),
        'status' => 'BELUM DIBACA',
        'tentang_notif' => 'Pembayaran' 
        );  
        }

        $this->db->insert('tbl_notifikasi', $data);
    }

    public function konfirmasipembayaran(){
    $this->db->set(array('status_pembayaran' => $this->input->post('statuspem'),'jml_pembayaran' => $this->input->post('jml_pem')));
    $this->db->where('id_invoice', $this->input->post('kd_inv'));
    $this->db->where('id_pembayaran', $this->input->post('kd_pem'));
    return $this->db->update('tbl_pembayaran');
    }

    public function selekkeadaanpembayaran(){
        $this->db->select('*,SUM(jml_pembayaran) AS terbayar');
        $this->db->from('tbl_pembayaran');
        $this->db->where('id_invoice',$this->input->post('kd_inv'));
        $this->db->where('status_pembayaran','Terbayar');
        return $this->db->get()->result_array();
    }

}