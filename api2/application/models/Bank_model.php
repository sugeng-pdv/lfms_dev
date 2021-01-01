<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'ref_bank';
        $this->primary_key = 'id';
        parent::__construct();
	}
	function getDataSelect()
    {
        $postdata = $_POST;
        $id = $postdata['id'];
        $this->db->select('id,name');
        $this->db->where('status','ACTIVE');
        if($id != "" ){
            $this->db->where('id',$id);
        }
		$this->db->order_by('id','asc');
		$query = $this->db->get('ref_bank');
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	



}
