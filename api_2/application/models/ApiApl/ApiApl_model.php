<?php

class ApiApl_model extends MY_Model {
    public function __construct()
	{
        $this->db_apl = $this->load->database('db_apiApl',true);
        $this->table = 'tbl_apl';
        // $this->primary_key = '';
        parent::__construct();
	}
  public function GetDataAll(){
      $this->db_apl->select('*');
      $this->db_apl->from($this->table);
      $query = $this->db_apl->get();
      $result = $query->result_array();
      
      return $result;
  }

}
