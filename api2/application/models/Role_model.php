<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'acl_role';
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
        
		$this->db->order_by('name','asc');
		$query = $this->db->get('acl_role');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
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
		$query = $this->db->get('acl_role');
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	
	
	function getData_Id()
    {
        $postdata = $_POST;
        $id = $postdata['id'];
        $this->db->where('status','ACTIVE');
        $this->db->where('id',$id);
		$this->db->order_by('name','asc');
		$query = $this->db->get('acl_role');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function

    function detail( $id='' )
	{
		
		$detail = $this->db->get_where('acl_role', array('id' => $id), 1);			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail() function
	
	
	
	
	
	
	
	












    public function getData2($data){
        // print_r($where);die();
        $this->db->select('*');
        $this->db->from($this->table);
        // $this->db->join('direktorat','pegawai.id_dir = direktorat.id_dir',"LEFT");
        $this->db->where("pegawai.akses_procurement" ,"1");
        $this->db->order_by("pegawai.nama","asc");
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

    public function getDataPpk($data){
        $where = array();
        if(isset($data['nip'])){
            if($data['nip']!=''){
                $where['UPPER(nip)']= $this->db->escape_like_str(strtoupper($data['nip']));
                //$inv_entity_code = $this->db->escape_like_str(strtoupper($data['INV_ENTITY_CODE']));
            }
        }
        // print_r($where);die();
        $this->db->select('*');
        $this->db->from('tbl_pbj');
        $this->db->join('pegawai','tbl_pbj.nip = pegawai.nip',"LEFT");
        $this->db->join('direktorat','pegawai.id_dir = direktorat.id_dir',"LEFT");
        // $this->db->where("pegawai.akses_procurement" ,"1");
        $this->db->like($where);
        $this->db->order_by("tbl_pbj.ppk","asc");
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

}
