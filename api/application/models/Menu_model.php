<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'acl_menu';
        $this->primary_key = 'id';
        parent::__construct();
	}

    function getData()
    {
        $postdata = $_POST;
        $id = $postdata['id'];
        $this->db->where('status','ACTIVE');
        if($id != "" ){
            $this->db->where('id',$id);
        }
		$this->db->order_by('id','asc');
		$query = $this->db->get('acl_menu');
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	function detail($id='')
	{
	    $detail = $this->db->get_where('acl_menu', array('id' => $id,'status'=>'ACTIVE'), 1);			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
	}
	
	function getDataSelect()
    {
        // $postdata = $_POST;
        // $id = $postdata['id'];
        $this->db->select('id,name');
        $this->db->where('status','ACTIVE');
        // if($id != "" ){
        //     $this->db->where('id',$id);
        // }
		$this->db->order_by('id','asc');
		$query = $this->db->get('acl_menu');
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	function getData_Id()
    {
        $postdata = $_POST;
        $id = $postdata['id'];
        $this->db->where('status','ACTIVE');
        $this->db->where('id',$id);
		$this->db->order_by('name','asc');
		$query = $this->db->get('acl_menu');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	
	function getMenu()
    {
        $postdata = $_POST;
        // print_r($postdata);die();
        $this->db->select('acl_menu.*');
        if($postdata['is_default'] == 1){
            $this->db->where('acl_menu.is_default',1);
        }else{
            $this->db->where('acl_authority.role_id',ROLE_ID);
            $this->db->join('acl_authority','acl_menu.id  = acl_authority.menu_id' ,'LEFT');
		    $this->db->order_by('acl_menu.id','asc');
        }
        $this->db->where('acl_menu.status','ACTIVE');
        $this->db->where('acl_menu.parent','0');
		$query = $this->db->get('acl_menu');
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of getMenu() function

    function getSubMenu($id)
    {
        $postdata = $_POST;
        if($postdata['is_default'] == 1){
            $this->db->where('acl_menu.is_default',1);
        }else{
            $this->db->where('acl_authority.role_id',ROLE_ID);
            $this->db->join('acl_authority','acl_authority.menu_id = acl_menu.id','LEFT');
        }
        $this->db->where('acl_menu.parent',$id);
        $this->db->where('acl_menu.status','ACTIVE');
		$this->db->order_by('acl_menu.id','asc');
		$query = $this->db->get('acl_menu');
		
		if ( $result = $query->result() ){ return $result; }
    }

}
