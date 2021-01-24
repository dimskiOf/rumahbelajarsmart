<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin_kelola_paket_produk_model extends CI_Model {

	var $table = 'paket_bimbel'; //nama tabel dari database
    var $column_order = array('id_paket','nama_paket', 'status','gambar_paket','harga_paket'); //field yang ada di table user
    var $column_search = array('nama_paket','status','harga_paket'); //field yang diizin untuk pencarian 
    var $order = array('id_paket' => 'desc'); // default order 

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
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

   public function getpaketproduk(){
   	$this->db->select('*');
   	$this->db->from('paket_bimbel');
   	$this->db->where('status','Aktif');
   	return $this->db->get()->result_array();
   }
   public function getpaketbyid(){
   	$this->db->select('*');
   	$this->db->from('paket_bimbel');
   	$this->db->where('id_paket',$this->input->post('idpaket'));
   	return $this->db->get()->result_array();
   }
   public function updatepaket(){
   	$this->db->set(array('nama_paket' => $this->input->post('paket_nama1'),'status' => $this->input->post('status_paket1'),'harga_paket' => $this->input->post('paket_harga1'),'rincian_paket' => $this->input->post('rincian_paket1'),'kurikulum_paket' => $this->input->post('kurikulum_paket1')));
    $this->db->where('id_paket', $this->input->post('idp'));
    return $this->db->update('paket_bimbel');
   }
   public function hapuspaket()
   {
   	$this->db->where('id_paket', $this->input->post('id'));
    return  $this->db->delete('paket_bimbel');
   }
   public function cekitfotpak()
   {
    $this->db->select('*');
    $this->db->from('paket_bimbel');
    $this->db->where('id_paket',$this->input->post('id_paket'));
    return $this->db->get()->result_array();
   }
   public function updating_fotopk($a)
   {
    $this->db->set(array('gambar_paket'=>$a));
    $this->db->where('id_paket',$this->input->post('id_paket'));
    return $this->db->update('paket_bimbel');
   }
   public function inputpaket($a)
   {
      $data = array(
        'nama_paket' => $this->input->post('paket_nama2'),
        'status' => 'Aktif',
        'gambar_paket' => $a,
        'harga_paket' => $this->input->post('paket_harga2'),
        'rincian_paket' => $this->input->post('rincian_paket2'),
        'kurikulum_paket' => $this->input->post('kurikulum_paket2') 
    );

    $this->db->insert('paket_bimbel', $data);
   }
}