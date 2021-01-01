<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Token_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->db_temp = $this->load->database('temp', TRUE); // instance utk database temp
		
		// garbage collection
		$this->db_temp->where('issued < '.(time()-(24*3600)));
		$this->db_temp->delete('employee_token');
		
    }
    
	function detail( $jwt_uid='' )
	{
		
		$detail = $this->db_temp->get_where('employee_token', array('jwt_uid' => $jwt_uid), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail() function
	
    function insert( $data = array() ) 
    {
		if ($this->db_temp->insert('employee_token', $data)){
			return $this->db_temp->insert_id();
		}else{
			return false;
		}
	} // end of insert() function

} // end of class

?>
