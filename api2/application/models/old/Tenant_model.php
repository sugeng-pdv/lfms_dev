<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tenant_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->db_ro = $this->load->database('default', TRUE);
    }
    
    function search( $keyword=null ){
        
        $this->db_ro->like('name', $keyword);
		$query = $this->db_ro->get('tenant');	
		if ( $result = $query->result() ){ return $result; }
        
    }

	function detail( $id='' )
	{
		
		$detail = $this->db_ro->get_where('tenant', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail() function
	
    function update( $id='', $data='' )
    {
		$this->db->where('id', $id);
		if ($this->db->update('tenant', $data)){
			return true;
		}else{
			return false;
		}
	} // end of update() function
	
    function insert( $data = array() ) 
    {
		if ($this->db->insert('tenant', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert() function
	
} // end of class

?>
