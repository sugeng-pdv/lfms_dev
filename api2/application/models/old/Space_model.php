<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Space_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->db_ro = $this->load->database('default', TRUE);
    }
	
    function get_by_asset( $asset_id=null )
    {
        $this->db_ro->where('asset_id',$asset_id);
		$this->db_ro->order_by('id','asc');
		$query = $this->db_ro->get('space');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_space() function
	
	function detail( $id='' )
	{
		
		$detail = $this->db_ro->get_where('space', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail() function
	
    function insert( $data = array() ) 
    {
		if ($this->db->insert('space', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert() function	

} // end of class

?>
