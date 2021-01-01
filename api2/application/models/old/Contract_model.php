<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contract_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->db_ro = $this->load->database('default', TRUE);
    }
    
    function get( $limit='20', $offset='0', $order_by=null, $contract_number = null, $contract_date_start = null, $contract_date_end = null, $due_date_start = null, $due_date_end = null, $status = null )
    {
    	// pencarian by nomer kontrak
    	if ( !empty($contract_number) ){
    	    $this->db_ro->like('contract_number', $contract_number);
    	}
    	
    	if ( !empty($contract_date_start) ){
    	    $this->db_ro->where('contract_date >=',$contract_date_start);
    	}
    	
    	if ( !empty($contract_date_end) ){
    	    $this->db_ro->where('contract_date <=',$contract_date_end);
    	}
    	
    	if ( !empty($due_date_start) ){
    	    $this->db_ro->where('due_date >=',$due_date_start);
    	}
    	
    	if ( !empty($due_date_end) ){
    	    $this->db_ro->where('due_date <=',$due_date_end);
    	}
    	
    	if ( !empty($status) ){
    	    $this->db_ro->where('status',$status);
    	}
    	
		switch ($order_by){
			case 'due_date-asc':
				$this->db_ro->order_by("due_date", "asc");
			break;
			case 'due_date-desc':
				$this->db_ro->order_by("due_date", "desc");
			break;
			default:
				$this->db_ro->order_by("id", "desc");
		}

		$this->db_ro->limit($limit, $offset);
		$this->db_ro->from('contract');
		$query = $this->db_ro->get();
		
		if ( $result = $query->result() ){ return $result; }

	} // end of get() function
    
    function count( $contract_number = null, $contract_date_start = null, $contract_date_end = null, $due_date_start = null, $due_date_end = null, $status=null )
    {
        
        $this->db_ro->select('id');
    	// pencarian by nomer kontrak
    	if ( !empty($contract_number) ){
    	    $this->db_ro->like('contract_number', $contract_number);
    	}
    	
    	if ( !empty($contract_date_start) ){
    	    $this->db_ro->where('contract_date >=',$contract_date_start);
    	}
    	
    	if ( !empty($contract_date_end) ){
    	    $this->db_ro->where('contract_date <=',$contract_date_end);
    	}
    	
    	if ( !empty($due_date_start) ){
    	    $this->db_ro->where('due_date >=',$due_date_start);
    	}
    	
    	if ( !empty($due_date_end) ){
    	    $this->db_ro->where('due_date <=',$due_date_end);
    	}
    	
    	if ( !empty($status) ){
    	    $this->db_ro->where('status',$status);
    	}
    	
		$this->db_ro->from('contract');
		$query = $this->db_ro->get();
		
		if ( $result = $query->result() ){ return count($result); }else{ return 0; }

	} // end of count() function
    
    function get_by_asset( $asset_id=null )
    {
        $this->db_ro->where('asset_id',$asset_id);
		$this->db_ro->order_by('id','desc');
		$query = $this->db_ro->get('contract');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_by_asset() function
	
    function get_by_space( $space_id=null )
    {
        $this->db_ro->where('space_id',$space_id);
		$this->db_ro->order_by('id','asc');
		$query = $this->db_ro->get('contract');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_by_space() function
	
	function detail( $id='' )
	{
		
		$detail = $this->db_ro->get_where('contract', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail() function
	
	function detail_by_contract_number( $contract_number='' )
	{
		
		$detail = $this->db_ro->get_where('contract', array('contract_number' => $contract_number), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail_by_contract_number() function
	
    function update( $id='', $data='' )
    {
		$this->db->where('id', $id);
		if ($this->db->update('contract', $data)){
			return true;
		}else{
			return false;
		}
	} // end of update() function
	
    function insert( $data = array() ) 
    {
		if ($this->db->insert('contract', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert() function
	
    function get_document( $id=null )
    {
        $this->db_ro->where('contract_id',$id);
		$this->db_ro->order_by('id','desc');
		$query = $this->db_ro->get('contract_document');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_document() function
	
    function insert_document( $data = array() )
    {
		if ($this->db->insert('contract_document', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert_document() function
	
    function delete_document( $document_id = null )
    {
		if ($this->db->delete('contract_document', array('id'=>$document_id) )){
			return true;
		}else{
			return false;
		}
	} // end of delete_document() function	
	
    function due_soon( $days_to_go = null )
    {
    	$this->db_ro->where('due_date >',date('Y-m-d'));
    	if ( $days_to_go !== null ){
        	$this->db_ro->where('due_date <=',date('Y-m-d',strtotime("+".$days_to_go." day")));
    	}else{
        	$this->db_ro->where('due_date <=',date('Y-m-d',strtotime("+1 month")));
    	}
		$this->db_ro->from('contract');
		$query = $this->db_ro->get();
		
		if ( $result = $query->result() ){ return $result; }
	} // end of due_soon() function
	
} // end of class

?>
