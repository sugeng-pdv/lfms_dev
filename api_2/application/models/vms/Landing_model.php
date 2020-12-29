<?php

/*
 * Created on Wed Jun 10 2020 2:07:20 PM
 *
 * Filename Landing_model.php
 * Author Sugeng Riyadi
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */


class Landing_model extends MY_Model {
    public function __construct()
	{
        $this->db = $this->load->database('db_eproc',true);
        $this->table = 'accounts';
        // $this->primary_key = 'id';
        parent::__construct();
    }
    
    public function getMasterFile(){
        $this->db->select('id,keterangan,s3_region,s3_bucket,s3_object,date_upload');
        $this->db->from('dokumen_statik');
        $this->db->where("status" ,1);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }









  
    //belum di pakai

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
        $this->db->where("pegawai.akses_iku" ,"1");
        $this->db->like($where);
        $this->db->order_by("pegawai.nama","asc");
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

}
