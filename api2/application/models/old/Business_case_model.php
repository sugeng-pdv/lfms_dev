<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Business_case_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->db_ro = $this->load->database('default', TRUE);
    }
    
    function get( $asset_id=null )
    {
        $this->db_ro->where('asset_id',$asset_id);
		$this->db_ro->order_by('id','asc');
		$query = $this->db_ro->get('business_case');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	function detail( $id='' )
	{
		
		$detail = $this->db_ro->get_where('business_case', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail() function
	
    function update( $id='', $data='' )
    {
		$this->db->where('id', $id);
		if ($this->db->update('business_case', $data)){
			return true;
		}else{
			return false;
		}
	} // end of update() function
	
    function insert( $data = array() ) 
    {
		if ($this->db->insert('business_case', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert() function
	
    function get_document( $id=null )
    {
        $this->db_ro->where('business_case_id',$id);
		$this->db_ro->order_by('id','desc');
		$query = $this->db_ro->get('business_case_document');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_document() function
	
    function insert_document( $data = array() ) 
    {
		if ($this->db->insert('business_case_document', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert() function
	
    function delete_document( $document_id = null )
    {
		if ($this->db->delete('business_case_document', array('id'=>$document_id) )){
			return true;
		}else{
			return false;
		}
	} // end of delete_document() function	
	
} // end of class

?>
