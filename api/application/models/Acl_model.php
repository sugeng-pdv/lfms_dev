<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acl_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'acl_user';
        $this->primary_key = 'id';
        parent::__construct();
	}

    function user_detail( $user_id='' )
	{
		
		$detail = $this->db->get_where('acl_user', array('user_id'=>$user_id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of user_detail() function
	
	function user_detail_profile( $user_id='' )
	{
	    $this->db->select('acl_user.*');
	    $this->db->select('acl_role.name as role_name');
	    $this->db->select('ref_company.name as company_name');
	   // $this->db->select('ref_company.description');
		$this->db->where('acl_user.user_id',$user_id);
		$this->db->where('acl_user.role_id = acl_role.id');
		$this->db->where('acl_user.company_id = ref_company.id');		
		$detail = $this->db->get(array('acl_user','acl_role','ref_company'));	
// 		if ( $result = $detail->result() ){
// 			// convert the result from array to object
// 			foreach ( $result as $data ){}
// 			return $data;
// 		}
		if ( $result = $detail->result() ){ return $result; }
		
	} // end of user_detail() function
	
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
    


}
