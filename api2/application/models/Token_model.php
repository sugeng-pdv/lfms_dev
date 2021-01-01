<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Token_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		// garbage collection
		$this->db->where('issued < '.(time()-(24*3600)));
		$this->db->delete('user_token');
		
    }
    
	function detail( $jwt_uid='' )
	{
		
		$detail = $this->db->get_where('user_token', array('jwt_uid' => $jwt_uid), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail() function
	
    function insert( $data = array() ) 
    {
		if ($this->db->insert('user_token', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert() function

} // end of class

?>
