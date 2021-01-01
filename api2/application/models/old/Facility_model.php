<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facility_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->db_ro = $this->load->database('default', TRUE);
    }
    
    function get_facility( $asset_id=null )
    {
        $this->db_ro->where('asset_id',$asset_id);
		$this->db_ro->order_by('order','asc');
		$this->db_ro->order_by('id','asc');
		$query = $this->db_ro->get('facility');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_facility() function
	
	function detail_facility( $id='' )
	{
		
		$detail = $this->db_ro->get_where('facility', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail_facility() function
	
    function update_facility( $id='', $data='' )
    {
		$this->db->where('id', $id);
		if ($this->db->update('facility', $data)){
			return true;
		}else{
			return false;
		}
	} // end of update_facility() function
	
    function insert_facility( $data = array() ) 
    {
		if ($this->db->insert('facility', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert_facility() function
	
    function delete_facility( $facility_id = null )
    {
		if ($this->db->delete('facility', array('id'=>$facility_id) )){
			return true;
		}else{
			return false;
		}
	} // end of delete_facility() function	
	
    function get_facility_type()
    {
        $this->db_ro->where('active',1);
		$this->db_ro->order_by('id','asc');
		$query = $this->db_ro->get('ref_facility');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_facility_type() function
	
	function facility_type_detail( $id='' )
	{
		
		$detail = $this->db_ro->get_where('ref_facility', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of facility_type_detail() function
	
    function insert_facility_type( $data = array() ) 
    {
		if ($this->db->insert('ref_facility', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert_facility_type() function
	
    function get_public_facility( $asset_id=null )
    {
        $this->db_ro->where('asset_id',$asset_id);
		$this->db_ro->order_by('type','asc');
		$query = $this->db_ro->get('public_facility');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_public_facility() function
	
	function detail_public_facility( $id='' )
	{
		
		$detail = $this->db_ro->get_where('public_facility', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail_public_facility() function
	
    function update_public_facility( $id='', $data='' )
    {
		$this->db->where('id', $id);
		if ($this->db->update('public_facility', $data)){
			return true;
		}else{
			return false;
		}
	} // end of update_public_facility() function
	
    function insert_public_facility( $data = array() ) 
    {
		if ($this->db->insert('public_facility', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert_public_facility() function
	
    function delete_public_facility( $facility_id = null )
    {
		if ($this->db->delete('public_facility', array('id'=>$facility_id) )){
			return true;
		}else{
			return false;
		}
	} // end of delete_public_facility() function	
	
    function get_public_facility_type()
    {
        $this->db_ro->where('active',1);
		$this->db_ro->order_by('id','asc');
		$query = $this->db_ro->get('ref_public_facility');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_public_facility_type() function
	
	function public_facility_type_detail( $id='' )
	{
		
		$detail = $this->db_ro->get_where('ref_public_facility', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of facility_type_detail() function
	
    function insert_public_facility_type( $data = array() ) 
    {
		if ($this->db->insert('ref_public_facility', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert_public_facility_type() function	
} // end of class

?>
