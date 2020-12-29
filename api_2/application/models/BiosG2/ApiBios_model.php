<?php

class ApiBios_model extends MY_Model {
    public function __construct()
	{
        $this->db = $this->load->database('db_bios',true);
        $this->table = 'data_lainnya';
        // $this->primary_key = 'id_per';
        parent::__construct();
  } 
    
    public function getDataLainnya()
    {
      $this->db->select('*');
      $this->db->from('data_lainnya');
      $query = $this->db->get();
      $result = $query->result_array();
      return $result;
    }
    public function getPenerimaan()
    {
      $this->db->select('*');
      $this->db->from('penerimaan');
      $query = $this->db->get();
      $result = $query->result_array();
      return $result;
    }
    public function getPengeluaran()
    {
      $this->db->select('*');
      $this->db->from('pengeluaran');
      $query = $this->db->get();
      $result = $query->result_array();
      return $result;
    }
    public function getSaldo()
    {
      $this->db->select('*');
      $this->db->from('saldo');
      $query = $this->db->get();
      $result = $query->result_array();
      return $result;
    }















    public function getDetailSt($token)
    {
      // $this->db_sdm = $this->load->database('db_sdm',true);
      $this->db->select('id_st,no_st,kota_berangkat,kota_tujuan');
      $this->db->from('tbl_st');
      $this->db->where('id_st',$token);
      $query = $this->db->get();
      $result = $query->result_array();
      return $result;
    }
    public function getDataDivisi($data){
      $where = array();
        if(isset($data['id_kegiatan'])){
            if($data['id_kegiatan']!=''){
                $where['UPPER(id_kegiatan)']= $this->db->escape_like_str(strtoupper($data['id_kegiatan']));
            }
        }
      $this->db->select('*');
      $this->db->from('tbl_mst_kegiatan');
      $this->db->where($where);
      $this->db->order_by("kd_divisi","asc");
      $query = $this->db->get();
      $result = $query->result_array();

      return $result;
    } 
    public function getDetailKegiatan($id){
      $this->db->select('id_kode,kd_max,uraian');
      $this->db->from('tbl_mst_kode_kegiatan');
      $this->db->where('kd_kegiatan',$id);
      $this->db->order_by("id_kode","asc");
      $query = $this->db->get();
      $result = $query->result_array();

      return $result;
    }
    public function getDataKdKegiatan($data){
      $where = array();
      if(isset($data['id_kode'])){
          if($data['id_kode']!=''){
              $where['UPPER(id_kode)']= $this->db->escape_like_str(strtoupper($data['id_kode']));
          }
      }
      $this->db->select('kd_max,kd_akun,uraian');
      $this->db->from('tbl_mst_kode_kegiatan');
      $this->db->where($where);
      $this->db->order_by("id_kode","asc");
      $query = $this->db->get();
      $result = $query->result_array();

    return $result;
    }
    public function getDetailSpby($id){
      $this->db->select('tbl_spby.id_spby as tokenData,tbl_spby.tgl_spby,tbl_spby.jns_spby,tbl_spby.id_st,tbl_spby.no_spby,tbl_spby.no_spby2,tbl_spby.jumlah_spby,tbl_spby.nip_penerima_spby,tbl_spby.nm_penerima_spby,tbl_spby.detail_spby,tbl_spby.kd_kegiatan,tbl_mst_kode_kegiatan.id_kode,tbl_mst_kode_kegiatan.kd_kegiatan as dipa');
      $this->db->from($this->table);
      $this->db->join(' tbl_mst_kode_kegiatan','tbl_mst_kode_kegiatan.id_kode = tbl_spby.kd_kegiatan');
      $this->db->where("id_spby",$id);
      $query = $this->db->get();
      $result = $query->result_array();

      return $result;
    }
}
