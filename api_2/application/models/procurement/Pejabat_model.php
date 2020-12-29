<?php

class Pejabat_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'pegawai';
        $this->primary_key = 'nip';
        parent::__construct();
	}

    public function getData($data){
      // print_r($data['nip']."-------------");die();

        $where = array();
        if(isset($data['nip'])){
            if($data['nip']!=''){
                $where['UPPER(nip)']= $this->db->escape_like_str(strtoupper($data['nip']));
                //$inv_entity_code = $this->db->escape_like_str(strtoupper($data['INV_ENTITY_CODE']));
            }
        }
        // print_r($where);die();
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('direktorat','pegawai.id_dir = direktorat.id_dir',"LEFT");
        $this->db->where("pegawai.akses_procurement" ,"1");
        $this->db->like($where);
        $this->db->order_by("pegawai.nama","asc");
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

}
