<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_model extends CI_Model {

    function __construct()
    {
        $this->table = 'ppk_employee';
        $this->primary_key = 'id';
        parent::__construct();
    }
    
    function insert_user( $data = array() ) 
    {
		if ($this->db->insert('ppk_employee', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert() function
	
	
	function employee_detail( $id='' )
	{
		
		$detail = $this->db->get_where('ppk_employee', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of employee_detail() function
	
	function get_employee_id( $email_or_nip='' )
	{

		if( filter_var($email_or_nip, FILTER_VALIDATE_EMAIL) ){ // jika email
    		$detail = $this->db->get_where('ppk_employee', array('email' => $email_or_nip), 1);			
		}else{
    		$detail = $this->db->get_where('ppk_employee', array('nip_npp' => $email_or_nip), 1);			
		}
		/*
		if ( is_numeric($email_or_nip) AND strlen($email_or_nip) == 18 ){ // jika NIP
    		$detail = $this->db->get_where('employee', array('nip_npp' => $email_or_nip), 1);			
		}elseif( filter_var($email_or_nip, FILTER_VALIDATE_EMAIL) ){ // jika email
    		$detail = $this->db->get_where('employee', array('email' => $email_or_nip), 1);			
		}else{
		    return null;
		}
		*/
		
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data->id;
		}
		
	} // end of get_employee_id() function
	function update( $id='', $data='' )
    {
		$this->db->where('id', $id);
		if ($this->db->update('ppk_employee', $data)){
			return true;
		}else{
			return false;
		}
	} // end of update() function
	
} // end of class

?>
