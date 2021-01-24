<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin_data_mapel_model extends CI_Model {

  var $table = 'mata_pelajaran'; //nama tabel dari database
  var $column_order = array('id_mapel', 'nama_mapel','status'); //field yang ada di table user
  var $column_search = array('id_mapel', 'nama_mapel','status'); //field yang diizin untuk pencarian 
  var $order = array('id_mapel' => 'desc'); // default order 

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

  public function mapel_getbyid(){
  	$this->db->select('*');
  	$this->db->from('mata_pelajaran');
  	$this->db->where('id_mapel',$this->input->post('idm'));
  	return $this->db->get()->result_array();
  }

  public function inputmapel(){
  	$data = array(
        'nama_mapel' => $this->input->post('namamapel'),
        'status' => $this->input->post('statusmapel')
    );

    return $this->db->insert('mata_pelajaran', $data);
  }

  public function submiteditmapel(){
    $data = array('nama_mapel' => $this->input->post('editnamamapel'),'status' => $this->input->post('editstatusmapel'));
    $this->db->where('id_mapel',$this->input->post('id_mapel'));
    return $this->db->update('mata_pelajaran',$data);
  }

  public function getmapelall(){
    $this->db->select('*');
    $this->db->from('mata_pelajaran');
    $this->db->where('status','Aktif');
   return $this->db->get()->result_array();
  }

  public function detailpaketmapel(){
    $this->db->select('a.*, b.*,c.*');
    $this->db->from('mata_pelajaran a');
    $this->db->join('pengelompokan_mapel b','a.id_mapel = b.id_mapel','inner');
    $this->db->join('paket_bimbel c','c.id_paket = b.id_paket','inner');
    $this->db->where('b.id_paket',$this->input->post('idp'));
    $this->db->where('a.status','Aktif');
    return $this->db->get()->result_array();
  }

  public function submitaddmapelonpaket(){
    $data = array(
        'id_paket' => $this->input->post('idpaketurus'),
        'id_mapel' => $this->input->post('mapelid')
    );

    return $this->db->insert('pengelompokan_mapel', $data);
  }

  public function hapusmapelonpaket(){
    $this->db->where('id_mapel', $this->input->post('idmapel'));
    $this->db->where('id_paket', $this->input->post('idpaket'));
    return  $this->db->delete('pengelompokan_mapel');
  }

}