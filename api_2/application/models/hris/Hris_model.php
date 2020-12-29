<?php

class Hris_model extends MY_Model {
    public function __construct()
	{
        $this->db = $this->load->database('db_hris',true);
        $this->table = 'menu_side';
        // $this->primary_key = '';
        parent::__construct();
    }


}