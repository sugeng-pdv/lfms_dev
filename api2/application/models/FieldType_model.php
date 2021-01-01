<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FieldType_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'spp';
        $this->primary_key = 'id';
        parent::__construct();
	}

	
	function getJenisBidang()
    {
        // print_r(COMPANY_ID);die();
        $postdata = $_POST;
        // $id = $postdata[''];
        $this->db->select('*');
        $this->db->where('status','ACTIVE');
        // if($id != "" ){
        //     $this->db->where('psn_sector_id',$id);
        // $this->db->where('field.spp_id',$this->lman_security->clean_post('spp_id'));
        // }
		$this->db->order_by('name','asc');
		$query = $this->db->get(array('ref_jns_bidang'));
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function getDataSelect()
    {
        $postdata = $_POST;
        $id = $postdata['id'];
        $this->db->select('id,name');
        $this->db->where('status','ACTIVE');
        if($id != "" ){
            $this->db->where('psn_sector_id',$id);
        }
		$this->db->order_by('name','asc');
		$query = $this->db->get('ref_psn_name');
		
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
// 		$query = $this->db->get('ref_psn_name');	
// 		if ( $result = $query->result() ){ return $result; }
		
// 	} // end of get() function


}
