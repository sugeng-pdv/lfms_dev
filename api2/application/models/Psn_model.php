<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Psn_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'ref_psn_name';
        $this->primary_key = 'id';
        parent::__construct();
	}

	
	function getDataSelect()
    {
        $postdata = $_POST;
        $id = $postdata['id'];
        $payment_type = $postdata['payment_type'];
        
        $this->db->select('id,name,fiscal_year');
        $this->db->where('status','ACTIVE');
        if($id != "" ){
            $this->db->where('psn_sector_id',$id);
        }
        if($payment_type != "" ){
            $this->db->where('payment_type',$payment_type);
        }
		$this->db->order_by('name','asc');
		$query = $this->db->get('ref_psn_name');
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	
	
    function getDataPsn()
    {
        $postdata = $_POST;
        $where = array();
        $payment_type_search = $this->lman_security->clean_post('payment_type_search');
        $this->db->select('ref_psn_name.*');
        $this->db->select('ref_psn_sector.name as sector_psn');
        $this->db->select('ref_psn_sector.id as id_sector');
        $this->db->select('ref_institution.name as institution_name');
        $this->db->select('ref_institution.id as id_institution');
        $this->db->where('ref_psn_sector.id = ref_psn_name.psn_sector_id');
        $this->db->where('ref_institution.id = ref_psn_name.institution_id');
        
        if($this->lman_security->clean_post('id') != ""){
            $this->db->where('ref_psn_name.id',$this->lman_security->clean_post('id'));
        }else{
            if(($payment_type_search != '' && $payment_type_search != 'all')){
                $this->db->where('ref_psn_name.payment_type',$payment_type_search);
                
            }
            
            if($this->lman_security->clean_post('fiscal_year_search') != "" && $this->lman_security->clean_post('fiscal_year_search') != "all" ){
                $this->db->where('ref_psn_name.fiscal_year',$this->lman_security->clean_post('fiscal_year_search'));
            }
            if($this->lman_security->clean_post('psn_search') != "" ){
                $this->db->like('ref_psn_name.name',$this->lman_security->clean_post('psn_search'));
            }
        }
        // $this->db->like($where);
        $this->db->where('ref_psn_name.status','ACTIVE');
		$this->db->order_by('ref_psn_name.id','desc');
		$query = $this->db->get(array('ref_psn_name','ref_psn_sector','ref_institution'));	
		if ( $result = $query->result() ){
		    return $result;
		    
		}
		
	} // end of get() function
	
	function getDetailAllocation( $psn_id='' )
	{
				
		$this->db->select('nominal,area,allocation_ttl,realization_ttl,remaining_fund');
        $this->db->where('status','ACTIVE');
        $this->db->where('id',$psn_id);
        
		$query = $this->db->get('ref_psn_name');
			
		if ( $result = $query->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of user_detail() function
	


}
