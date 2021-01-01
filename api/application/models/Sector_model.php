<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sector_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'ref_psn_sector';
        $this->primary_key = 'id';
        parent::__construct();
	}

	function getDataSelect()
    {
        $this->db->select('id,name');
        $this->db->where('status','ACTIVE');
		$this->db->order_by('id','asc');
		$query = $this->db->get('ref_psn_sector');
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	
	
	
	
	
//     function getData()
//     {
//         $postdata = $_POST;
//         $id = $postdata['id'];
//         $this->db->where('status','ACTIVE');
//         if($id != "" ){
//             $this->db->where('id',$id);
//         }
        
// 		$this->db->order_by('name','asc');
// 		$query = $this->db->get('ref_psn_sector');	
// 		if ( $result = $query->result() ){ return $result; }
		
// 	} // end of get() function
	
	
	
	


}
