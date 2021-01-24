<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin_data_nilai_siswa_model extends CI_Model {

 public function __construct()
    {
        parent::__construct();

    }

  public function nilai_getbyid(){
  	$this->db->select('a.*, b.*,c.*');
  	$this->db->from('mata_pelajaran a');
  	$this->db->join('pengelompokan_mapel b','a.id_mapel = b.id_mapel','inner');
  	$this->db->join('nilai_siswa c','c.id_pengelompokan = b.id_pengelompokan','inner');
  	$this->db->where('c.user_id',$this->input->post('usr'));
  	$this->db->where('a.status','Aktif');
  	//$this->db->order_by('c.id_nilai','desc');
  	return $this->db->get()->result_array();
  }

   public function mapel(){
  	$this->db->select('a.*, b.*');
  	$this->db->from('mata_pelajaran a');
  	$this->db->join('pengelompokan_mapel b','a.id_mapel = b.id_mapel','inner');
  	$this->db->where('a.status','Aktif');
  	//$this->db->order_by('c.id_nilai','desc');
  	$this->db->group_by('nama_mapel');
  	return $this->db->get()->result_array();
  }

  public function inputnilai(){
  	date_default_timezone_set('Asia/Jakarta');
  	$data = array(
        'user_id' => $this->input->post('userid'),
        'id_pengelompokan' => $this->input->post('mapelid'),
        'nilai' => $this->input->post('nilaiinput'),
        'tgl_nilai' => date('Y-m-d')
    );

    return $this->db->insert('nilai_siswa', $data);
  }

  public function hapusnilai(){
  	$this->db->where('id_nilai', $this->input->post('idn'));
    return  $this->db->delete('nilai_siswa');
  }

}