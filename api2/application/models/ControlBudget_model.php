<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ControlBudget_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'ref_psn_name';
        $this->primary_key = 'id';
        parent::__construct();
	}

	function getDataInstitutionSelect()
    {
        $this->db->select('id,name');
        $this->db->where('status','ACTIVE');
		$this->db->order_by('id','asc');
		$query = $this->db->get('ref_institution');
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	
	
	
	
	
	


}
