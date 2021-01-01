<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		//$this->db = $this->load->database('default', TRUE);
    }
    
    function get()
    {

		$this->db->order_by('role_id','asc');
		$this->db->order_by('name','asc');
		$query = $this->db->get('acl_user');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	function detail( $user_id='' )
	{
		
		$detail = $this->db->get_where('acl_user', array('user_id' => $user_id), 1);			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail() function
	
    function insert( $data = array() ) 
    {
		if ($this->db->insert('acl_user', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert() function
	
    function update( $user_id='', $data='' )
    {
		$this->db->where('user_id', $user_id);
		if ($this->db->update('acl_user', $data)){
			return true;
		}else{
			return false;
		}
	} // end of update() function
	
    function delete( $id='' )
    {
		$this->db->where('user_id', $id);
		
		if ($this->db->delete('acl_user')){
			return true;
		}else{
			return false;
		}
	} // end of delete() function

	
} // end of class

?>
