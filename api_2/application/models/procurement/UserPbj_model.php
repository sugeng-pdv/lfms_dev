<?php

class UserPbj_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'tbl_pbj';
        // $this->primary_key = 'id';
        parent::__construct();
	}

    public function getData($nip,$ppk,$jbt){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("nip",$nip);
        $this->db->where("ppk",$ppk);
        $this->db->where("jabatan",$jbt);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }
    public function getDataPpk($data){
      // $where = array();
        $where = "";
        if(isset($data['id'])){
            $where = $data['id'];
            // if($data['id']!=''){
            //     $where['UPPER(id)'] = $this->db->escape_like_str(strtoupper($data['id']));
            //     //$inv_entity_code = $this->db->escape_like_str(strtoupper($data['INV_ENTITY_CODE']));
            // }
        }
        // print_r($where);die();
        $this->db->select('*');
        $this->db->from('tbl_pbj');
        $this->db->join('pegawai','tbl_pbj.nip = pegawai.nip',"LEFT");
        $this->db->join('direktorat','pegawai.id_dir = direktorat.id_dir',"LEFT");
        $this->db->where('tbl_pbj.id',$data);
        $this->db->order_by("tbl_pbj.ppk","asc");
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }
    protected function prep_data($data){
      return $data;
    }
}
