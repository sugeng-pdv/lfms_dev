<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Structure_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->db_ro = $this->load->database('default', TRUE);
    }
	
    function get( $asset_id=null )
    {
        $this->db_ro->where('asset_id',$asset_id);
		$this->db_ro->order_by('id','asc');
		$query = $this->db_ro->get('structure');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	function detail( $id='' )
	{
		
		$detail = $this->db_ro->get_where('structure', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail() function
	
    function insert_structure( $data = array() ) 
    {
		if ($this->db->insert('structure', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert_structure() function
	
    function get_land( $structure_id=null )
    {
        $this->db_ro->where('structure_id',$structure_id);
		$this->db_ro->order_by('id','asc');
		$query = $this->db_ro->get('structure_to_land');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_land() function
	
    function add_structure_to_land( $data = array() ) 
    {
		if ($this->db->insert('structure_to_land', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of add_structure_to_land() function
	
    function clear_structure_to_land( $structure_id = null )
    {
		if ($this->db->delete('structure_to_land', array('structure_id'=>$structure_id) )){
			return true;
		}else{
			return false;
		}
	} // end of clear_structure_to_land() function
	
    function update_structure( $id='', $data='' )
    {
		$this->db->where('id', $id);
		if ($this->db->update('structure', $data)){
			return true;
		}else{
			return false;
		}
	} // end of update_structure() function
	
    function get_document( $structure_id=null )
    {
        $this->db_ro->where('structure_id',$structure_id);
		$this->db_ro->order_by('id','desc');
		$query = $this->db_ro->get('structure_document');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_document() function
	
	/*
	
	function structure_item_detail( $id='' )
	{
		
		$detail = $this->db_ro->get_where('structure_item', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of structure_item_detail() function
	
    function insert_structure_item( $data = array() ) 
    {
		if ($this->db->insert('structure_item', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert_structure_item() function	
	*/
	
} // end of class

?>
