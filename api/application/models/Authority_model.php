<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authority_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'acl_authority';
        $this->primary_key = 'id';
        parent::__construct();
	}

    function getData()
    {
        $postdata = $_POST;
        $id = $postdata['id'];
        $this->db->select('acl_authority.*');
        // $this->db->select('acl_menu.id as menu_id');
        $this->db->select('acl_menu.name as menu_name');
        // $this->db->select('acl_role.id as role_id');
        $this->db->select('acl_role.name as role_name');
        $this->db->where('acl_authority.status','ACTIVE');
        $this->db->join('acl_menu','acl_menu.id = acl_authority.menu_id','LEFT');
        $this->db->join('acl_role','acl_role.id = acl_authority.role_id','LEFT');
        if($id != "" ){
            $this->db->where('acl_authority.id',$id);
        }
		$this->db->order_by('acl_authority.id','asc');
		$query = $this->db->get('acl_authority');
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	function detail($id='')
	{
	    $detail = $this->db->get_where('acl_authority', array('id' => $id,'status'=>'ACTIVE'), 1);			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
	}
	function getData_Id()
    {
        $postdata = $_POST;
        $id = $postdata['id'];
        $this->db->where('status','ACTIVE');
        $this->db->where('id',$id);
		$this->db->order_by('name','asc');
		$query = $this->db->get('acl_authority');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function


}
