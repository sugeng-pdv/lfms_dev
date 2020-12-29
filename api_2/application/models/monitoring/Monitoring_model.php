<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_model extends MY_Model {
    public function __construct()
	{
        $this->db = $this->load->database('db_lfbooking',true);
        $this->table = 'kalender';
        // $this->primary_key = '';
        parent::__construct();
	}
  public function getDataPegawaiSpd(){
      $data = $_POST;
      // $data['tgl_skrg'] ="2020-03-05";
      // "2020-03-06" sd "2020-03-10"
      $this->db = $this->load->database('db_perjadin',true);
      $this->db->select('tbl_spd.nm_spd,tbl_spd.tgl_mulaiSt,tbl_spd.tgl_selesaiSt');
      $this->db->select('tbl_st.perihal,tbl_st.kota_tujuan');
      $this->db->from('tbl_spd');
      $this->db->join('tbl_st','tbl_st.id_no_st=tbl_spd.id_st_spd','LEFT');
      // now() >= tgl_mulaiSt and now() <= tgl_selesaiSt
      // $this->db->where("now() >= tbl_spd.tgl_mulaiSt");
      // $this->db->where("now() <= tbl_spd.tgl_selesaiSt");
      $this->db->where("'$data[tgl_skrg]' >= tbl_spd.tgl_mulaiSt");
      $this->db->where("'$data[tgl_skrg]' <= tbl_spd.tgl_selesaiSt");
      // $this->db->where("tbl_spd.tgl_mulaiSt >= '$data[tgl_skrg]'");
      // $this->db->where("tbl_spd.tgl_selesaiSt >= '$data[tgl_skrg]'");
      $this->db->like("tbl_spd.tgl_mulaiSt",date('Y'));
      $this->db->where("tbl_spd.jenis_spd","internal");
      $this->db->where("tbl_spd.status_spd",1);
      $this->db->where("tbl_spd.no_spd != '0'");
      $this->db->order_by("tbl_spd.tgl_mulaiSt","ASC");
      
      $query = $this->db->get();
      $result = $query->result_array();

      return $result;
  }

}
