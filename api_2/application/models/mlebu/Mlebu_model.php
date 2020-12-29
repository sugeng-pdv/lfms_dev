<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlebu_model extends MY_Model {
    public function __construct()
	{
        $this->db = $this->load->database('db_hris',true);
        $this->table = 'mlebu';
        // $this->primary_key = '';
        parent::__construct();
    }
    
    public function cekMlebu($data)
    {
        $this->db->select('*');
        $this->db->from('mlebu');
        $this->db->where("nip_npp",$data['username']);
        // $this->db->where("password",$data['password']);
        $query = $this->db->get();
        // $result = $query->num_rows();
        $result = $query->result_array();
        return $result;
    }

}