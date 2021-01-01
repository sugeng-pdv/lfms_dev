<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Land_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->db_ro = $this->load->database('default', TRUE);
    }
	
    function get( $asset_id=null )
    {
        $this->db_ro->where('asset_id',$asset_id);
		$this->db_ro->order_by('id','asc');
		$query = $this->db_ro->get('land');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	function detail( $id='' )
	{
		
		$detail = $this->db_ro->get_where('land', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail() function
	
    function insert_land( $data = array() ) 
    {
		if ($this->db->insert('land', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert_land() function
	
    function update_land( $id='', $data='' )
    {
		$this->db->where('id', $id);
		if ($this->db->update('land', $data)){
			return true;
		}else{
			return false;
		}
	} // end of update_land() function
	
    function get_document( $land_id=null )
    {
        $this->db_ro->where('land_id',$land_id);
		$this->db_ro->order_by('id','desc');
		$query = $this->db_ro->get('land_document');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_document() function
	
} // end of class

?>
