<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Duty_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->db_ro = $this->load->database('default', TRUE);
    }
    
    function get( $asset_id=null )
    {
        $this->db_ro->where('asset_id',$asset_id);
		$this->db_ro->order_by('id','desc');
		$query = $this->db_ro->get('duty');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	function detail( $id='' )
	{
		
		$detail = $this->db_ro->get_where('duty', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail() function
	
    function update( $id='', $data='' )
    {
		$this->db->where('id', $id);
		if ($this->db->update('duty', $data)){
			return true;
		}else{
			return false;
		}
	} // end of update() function
	
    function insert( $data = array() ) 
    {
		if ($this->db->insert('duty', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert() function
	
    function get_document( $id=null )
    {
        $this->db_ro->where('duty_id',$id);
		$this->db_ro->order_by('id','desc');
		$query = $this->db_ro->get('duty_document');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_document() function
	
    function insert_document( $data = array() ) 
    {
		if ($this->db->insert('duty_document', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert() function
	
    function delete_document( $document_id = null )
    {
		if ($this->db->delete('duty_document', array('id'=>$document_id) )){
			return true;
		}else{
			return false;
		}
	} // end of delete_document() function	
	
    function get_type()
    {
        $this->db_ro->where('active',1);
		$this->db_ro->order_by('id','asc');
		$query = $this->db_ro->get('ref_duty_type');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_type() function
	
	function type_detail( $id='' )
	{
		$detail = $this->db_ro->get_where('ref_duty_type', array('id' => $id), 1);			
		if ( $result = $detail->result() ){
			foreach ( $result as $data ){}
			return $data;
		}
	} // end of type_detail() function
	
    function insert_type( $data = array() ) 
    {
		if ($this->db->insert('ref_duty_type', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert_type() function
	
	// segera jatuh tempo
    function due_soon( $days_to_go = null )
    {
    	$this->db_ro->where('status','UNPAID');
    	$this->db_ro->where('due_date >=',date('Y-m-d'));
    	if ( $days_to_go !== null ){
        	$this->db_ro->where('due_date <=',date('Y-m-d',strtotime("+".$days_to_go." day")));
    	}else{
        	$this->db_ro->where('due_date <=',date('Y-m-d',strtotime("+1 month")));
    	}
		$this->db_ro->from('duty');
		$query = $this->db_ro->get();
		
		if ( $result = $query->result() ){ return $result; }
	} // end of due_soon() function
	
	// melewati jatuh tempo
    function over_due()
    {
    	$this->db_ro->where('status','UNPAID');
    	$this->db_ro->where('due_date <',date('Y-m-d'));
		$this->db_ro->from('duty');
		$query = $this->db_ro->get();
		
		if ( $result = $query->result() ){ return $result; }
	} // end of over_due() function
	
    function total_duty( $date_start=null, $date_end=null )
    {
        $this->db_ro->select('sum(value) as total');
        //$this->db_ro->where('status','ISSUED');
        if ( !empty($date_start) ){
            $this->db_ro->where('due_date >=',$date_start);
        }
            	
        if ( !empty($date_end) ){
            $this->db_ro->where('due_date <=',$date_end);
        }

        $query = $this->db_ro->get('duty');	
        if ( $result = $query->result() ){
            return $result[0]->total;
        }else{
            return 0;
        }
	} // end of total_duty() function
	
} // end of class

?>
