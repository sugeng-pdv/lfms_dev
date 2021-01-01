<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Operational_activity_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->db_ro = $this->load->database('default', TRUE);
    }
    
    function get_activity( $asset_id=null, $type=null )
    {
        $this->db_ro->where('asset_id',$asset_id);
        $this->db_ro->where('type',$type);
		$this->db_ro->order_by('id','desc');
		$query = $this->db_ro->get('operational_activity');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_activity() function
	
	function activity_detail( $id='' )
	{
		
		$detail = $this->db_ro->get_where('operational_activity', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of activity_detail() function
	
    function update_activity( $id='', $data='' )
    {
		$this->db->where('id', $id);
		if ($this->db->update('operational_activity', $data)){
			return true;
		}else{
			return false;
		}
	} // end of update_activity() function
	
    function insert_activity( $data = array() ) 
    {
		if ($this->db->insert('operational_activity', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert_activity() function
	
    function get_type()
    {
        $this->db_ro->where('active',1);
		$this->db_ro->order_by('id','asc');
		$query = $this->db_ro->get('ref_operational_activity');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_type() function
	
    function insert_type( $data = array() ) 
    {
		if ($this->db->insert('ref_operational_activity', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert_type() function
	
    function get_document( $activity_id=null )
    {
        $this->db_ro->where('operational_activity_id',$activity_id);
		$this->db_ro->order_by('id','desc');
		$query = $this->db_ro->get('operational_activity_document');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_document() function
	
    function insert_document( $data = array() ) 
    {
		if ($this->db->insert('operational_activity_document', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert() function
	
    function delete_document( $document_id = null )
    {
		if ($this->db->delete('operational_activity_document', array('id'=>$document_id) )){
			return true;
		}else{
			return false;
		}
	} // end of delete_document() function	
	
} // end of class

?>
