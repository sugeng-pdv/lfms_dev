<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acl_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		//$this->db_employee = $this->load->database('employee', TRUE); // instance utk database readonly
    }
    
    // 2020-09-10
	function check_authority( $role_id=null, $menu_code=null, $authority=null )
	{
		
		$this->db->where('acl_menu.code',$menu_code);
		$this->db->where('acl_authority.menu_id = acl_menu.id');
		$this->db->where('acl_authority.role_id',$role_id);

		if ( $authority == 'R' ){
		    $this->db->where_in('authority',array('R','RW'));
		}else{
		    $this->db->where('authority','RW');
		}
		
		$query = $this->db->get(array('acl_authority','acl_menu'));	
		if ( $result = $query->result() ){ 
		    return true;
		}else{
		    return false;
		}

	} // end of check_authority() function
    
    // 2020-09-10
	function user_detail( $user_id='' )
	{
		
		$detail = $this->db->get_where('acl_user', array('user_id'=>$user_id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of user_detail() function
    
    
    /*
	function employee_detail( $id='' )
	{
		
		$detail = $this->db_employee->get_where('employee', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of employee_detail() function
	
	function get_employee_id( $email_or_nip='' )
	{
		
		if ( is_numeric($email_or_nip) AND strlen($email_or_nip) == 18 ){ // jika NIP
    		$detail = $this->db_employee->get_where('employee', array('nip_npp' => $email_or_nip), 1);			
		}elseif( filter_var($email_or_nip, FILTER_VALIDATE_EMAIL) ){ // jika email
    		$detail = $this->db_employee->get_where('employee', array('email' => $email_or_nip), 1);			
		}else{
		    return null;
		}
		
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data->id;
		}
		
	} // end of get_employee_id() function
	*/
	
	function employee_role( $id='' )
	{
		
		$detail = $this->db->get_where('access_control', array('employee_id' => $id, 'active' => '1'));			
			
		if ( $result = $detail->result() ){
		    $role = array();
			foreach ( $result as $data ){
			    $role[] = $data->role;
			}
			return $role;
		}
		
	} // end of employee_role() function
	
	function employee_authority( $role=array() )
	{
		
		$this->db->where_in('role',$role);
		$query = $this->db->get('access_control_list');	
		if ( $result = $query->result() ){ 
		    foreach ( $result as $result ){
		        $privilege[] = $result->authority;
		    }
		}
		
		return ( !empty($privilege) ) ? $privilege : null;
		
	} // end of employee_authority() function
	
	/*
    function insert( $data = array() ) 
    {
		if ($this->db_employee->insert('employee', $data)){
			return $this->db_employee->insert_id();
		}else{
			return false;
		}
	} // end of insert() function
	*/
	
    function insert_role( $data = array() ) 
    {
		if ($this->db->insert('access_control', $data)){
			return true;
		}else{
			return false;
		}
	} // end of insert_role() function
	
	/*
    function update( $id='', $data='' )
    {
		$this->db_employee->where('id', $id);
		if ($this->db_employee->update('employee', $data)){
			return true;
		}else{
			return false;
		}
	} // end of update() function
	*/
	
} // end of class

?>
