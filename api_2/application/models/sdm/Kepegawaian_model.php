<?php
/**
    Created date : 24 Juli 2019
    Email        : sugeng.riyadi@kemenkeu.go.id
    Created by Sugeng Riyadi
    Model Untuk Control Kepegawaian
 **/
class Kepegawaian_model extends MY_Model {
    public function __construct()
	{
        $this->db = $this->load->database('db_sdm',true);
        $this->table = 'pegawai';
        // $this->primary_key = 'nip';
        parent::__construct();
	}

    public function getDataDivisi(){
        $this->db->select('*');
        $this->db->from('bagian');
        $this->db->order_by("id_div","asc");
        $query = $this->db->get();
        $result = $query->result_array();
  
        return $result;
    }

}
