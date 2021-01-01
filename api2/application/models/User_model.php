<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'acl_user';
        $this->primary_key = 'id';
        parent::__construct();
	}

    function getData()
    {
        $postdata = $_POST;
        $id = $postdata['id'];
        $this->db->select('acl_user.id,acl_user.user_id,acl_user.name,acl_user.nip_npp,acl_user.email,acl_user.role_id,acl_user.company_id,acl_user.status_user');
        $this->db->select('acl_role.name as role_name');
        $this->db->select('ref_company.name as company_name');
        $this->db->where('acl_user.status','ACTIVE');
        $this->db->join('acl_role','acl_role.id = acl_user.role_id','LEFT');
        $this->db->join('ref_company','ref_company.id = acl_user.company_id','LEFT');
        if($id != "" ){
            $this->db->where('acl_user.id',$id);
        }
		$this->db->order_by('acl_user.name','asc');
		$query = $this->db->get('acl_user');
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	function insert_user( $data = array() ) 
    {
		if ($this->db->insert('ppk_employee', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert() function
	
	
	
	function getPegawaiStaff()
	{
	    $postdata = $_POST;
        $pegawai = $postdata['id'];
        
        
        $this->db->select('acl_user.id,acl_user.user_id,acl_user.name,acl_user.nip_npp,acl_user.email,acl_user.role_id,acl_user.company_id,acl_user.status_user');
        $this->db->where('acl_user.status','ACTIVE');
        $this->db->where('acl_user.status_user','INT');
        $this->db->where('acl_user.role_id',7);
        // if($pegawai != "" ){
        //     $explodePegawai = explode("-",$pegawai);
        //     $userId = $explodePegawai[0];
        //     $this->db->where('acl_user.user_id',$userId);
        // }
		$this->db->order_by('acl_user.name','asc');
		$query = $this->db->get('acl_user');
		
		if ( $result = $query->result() ){ return $result; }
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function detail($id='')
	{
	    $detail = $this->db->get_where('acl_menu', array('id' => $id,'status'=>'ACTIVE'), 1);			
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
		$query = $this->db->get('acl_menu');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function


}
