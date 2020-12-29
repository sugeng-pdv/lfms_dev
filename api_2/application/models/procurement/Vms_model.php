<?php

class Vms_model extends MY_Model {
    public function __construct()
	{
        $this->db = $this->load->database('db_pbj',true);
        $this->table = 'tbl_vendor';
        // $this->primary_key = 'kd_vendor';
        parent::__construct();
	}
    public function getDataVms($data){
        $where = array();
        if(isset($data['id'])){
            if($data['id']!=''){
                $where['UPPER(id_vendor)']= $this->db->escape_like_str(strtoupper($data['id']));
            }
        }
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('status_hapus',0);
        $this->db->like($where);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getDataVmsRating()
    {
        $data = $_POST;
        $where = array();
        if(isset($data['id'])){
            if($data['id']!=''){
                $where['UPPER(tbl_pengadaan.id)']= $this->db->escape_like_str(strtoupper($data['id']));
            }
        }
        if(isset($data['tahun'])){
            if($data['tahun']!=''){
                $where['UPPER(tbl_pengadaan.tahun)']= $this->db->escape_like_str(strtoupper($data['tahun']));
            }
        }
        $this->db->select('tbl_pengadaan.id as id_rating');
        $this->db->select('tbl_pengadaan.*');
        $this->db->select('tbl_status_pengadaan.keterangan');
        $this->db->select('tbl_vendor.nm_vendor');
        // $this->db->select('avg(vms_rating.rating');
        $this->db->from('tbl_pengadaan');
        $this->db->join('tbl_status_pengadaan','tbl_pengadaan.status_pengadaan = tbl_status_pengadaan.id','LEFT');
        $this->db->join('tbl_vendor','tbl_vendor.id_vendor=tbl_pengadaan.vendor','LEFT');
        // $this->db->where('status_hapus',0);
        $this->db->like($where);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getDataVmsRatingAvg()
    {
        $data = $_POST;
        $where = array();
        if(isset($data['id_rating'])){
            if($data['id_rating']!=''){
                $where['UPPER(vms_rating.id_pengadaan)']= $this->db->escape_like_str(strtoupper($data['id_rating']));
            }
        }
        
        $this->db->select('AVG(vms_rating.rating) as ratingnya');
        $this->db->from('vms_rating');
        $this->db->join('tbl_pengadaan','tbl_pengadaan.id=vms_rating.id_pengadaan','LEFT');
        // $this->db->where('status_hapus',0);
        $this->db->like($where);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getData($data){
        $where = array();
        if(isset($data['id_p'])){
            if($data['id_p']!=''){
                $where['UPPER(id_p)']= $this->db->escape_like_str(strtoupper($data['id_p']));
            }
        }
        $this->db->select('*');
        $this->db->from('mst_tanya_pbj');
        // $this->db->join('mst_jbt_pbj')
        $this->db->order_by("mst_tanya_pbj.id_p","asc");
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }
    public function getDataJbt($data){
        $ArrayData = explode(",",$data['jbt']);
        $this->db->select('jbt_proses');
        $this->db->from('mst_jbt_pbj');
        $this->db->where_in('id_jbt_proses',$ArrayData);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getDataAkses(){
        $this->db->select('id_jbt_proses,jbt_proses');
        $this->db->from('mst_jbt_pbj');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function checkPertanyaan($data){
        $this->db->select('nm_pertanyaan');
        $this->db->from('mst_tanya_pbj');
        $this->db->where('nm_pertanyaan',$data);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function checkIdPertanyaan($data){
        $this->db->select('*');
        $this->db->from('mst_tanya_pbj');
        // $this->db->join('mst_jbt_pbj','mst_tanya_pbj.=mst_jbt_pbj.id_jbt_proses');
        $this->db->where('id_p',$data);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getIdJbt($data){
        $this->db->select('jbt_proses');
        $this->db->from('mst_jbt_pbj');
        $this->db->where_in('id_jbt_proses',$data);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getDataQuestion($data){
        $where = array();
        $this->db->select('mst_tanya_pbj.*');
        // $this->db->select('posts_rating.rating');
        $this->db->from('mst_tanya_pbj');
        // $this->db->join('posts_rating','mst_tanya_pbj.id_p=posts_rating.id_tanya','LEFT');
        $this->db->where("mst_tanya_pbj.id_jab_pbj like '%$data[id_Jabpbj]%'");
        $this->db->where('mst_tanya_pbj.status',"Aktif");
        // $this->db->where('posts_rating.userid',$data['sess_nip']);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function checkDataQuestion($data){
        $where = array();
        // $this->db->select('mst_tanya_pbj.*');
        $this->db->select('posts_rating.rating');
        $this->db->from('posts_rating');
        // $this->db->join('posts_rating','mst_tanya_pbj.id_p=posts_rating.id_tanya','LEFT');
        // $this->db->where("mst_tanya_pbj.id_jab_pbj like '%$data[id_Jabpbj]%'");
        // $this->db->where('mst_tanya_pbj.status',"Aktif");
        $this->db->where('posts_rating.userid',$data['sess_nip']);
        $this->db->where('posts_rating.id_pengadaan',$data['id']);
        $this->db->where('posts_rating.id_vendor',$data['vendor']);
        $this->db->where('posts_rating.id_tanya',$data['id_p']);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

}
