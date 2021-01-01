<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'spp';
        $this->primary_key = 'id';
        parent::__construct();
	}

	function get_province()
	{
        $postdata = $_POST;
        $this->db->select('*');
        $this->db->where('ref_provinsi.status','ACTIVE');
        // if($id != "" ){
        //     $this->db->where('ref_kelurahan.id',$id);
        // }
		$this->db->order_by('ref_provinsi.name','asc');
		$query = $this->db->get(array('ref_provinsi'));
		
		if ( $result = $query->result() ){ return $result; }
	}
	function get_district()
	{
        $postdata = $_POST;
        $this->db->select('*');
        $this->db->where('ref_kab_kota.status','ACTIVE');
        $this->db->where('ref_kab_kota.provinsi_id',$this->lman_security->clean_post('id'));
        // if($id != "" ){
        //     $this->db->where('ref_kab_kota.id',$id);
        // }
		$this->db->order_by('ref_kab_kota.name','asc');
		$query = $this->db->get(array('ref_kab_kota'));
		
		if ( $result = $query->result() ){ return $result; }
	}
// 	function get_subdistrict()
//     {
//         // print_r(COMPANY_ID);die();
//         $postdata = $_POST;
//         // $id = $postdata[''];
//         $this->db->select('ref_kelurahan.*');
//         $this->db->select('ref_kecamatan.name as name_kec');
//         $this->db->select('ref_kecamatan.name as id_kec');
//         $this->db->where('ref_kelurahan.kecamatan_id = ref_kecamatan.id');
//         $this->db->where('ref_kelurahan.status','ACTIVE');
//         $this->db->where('ref_kecamatan.kab_kota_id',$this->lman_security->clean_post('id'));
//         // if($id != "" ){
//         //     $this->db->where('ref_kecamatan.id',$id);
//         // }
// 		$this->db->order_by('ref_kecamatan.name','asc');
// 		$query = $this->db->get(array('ref_kelurahan','ref_kecamatan'));
		
// 		if ( $result = $query->result() ){ return $result; }
		
// 	} // end of get() function
	function get_subdistrict()
	{
        $postdata = $_POST;
        $this->db->select('*');
        $this->db->where('ref_kecamatan.status','ACTIVE');
        $this->db->where('ref_kecamatan.kab_kota_id',$this->lman_security->clean_post('id'));
        // if($id != "" ){
        //     $this->db->where('ref_kab_kota.id',$id);
        // }
		$this->db->order_by('ref_kecamatan.name','asc');
		$query = $this->db->get(array('ref_kecamatan'));
		
		if ( $result = $query->result() ){ return $result; }
	}
	function get_village()
	{
        $postdata = $_POST;
        $this->db->select('*');
        $this->db->where('ref_kelurahan.status','ACTIVE');
        $this->db->where('ref_kelurahan.kecamatan_id',$this->lman_security->clean_post('id'));
        // if($id != "" ){
        //     $this->db->where('ref_kab_kota.id',$id);
        // }
		$this->db->order_by('ref_kelurahan.name','asc');
		$query = $this->db->get(array('ref_kelurahan'));
		
		if ( $result = $query->result() ){ return $result; }
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function getDataSelect()
    {
        $postdata = $_POST;
        $id = $postdata['id'];
        $this->db->select('id,name');
        $this->db->where('status','ACTIVE');
        if($id != "" ){
            $this->db->where('psn_sector_id',$id);
        }
		$this->db->order_by('name','asc');
		$query = $this->db->get('ref_psn_name');
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	
	
//     function getData()
//     {
//         $postdata = $_POST;
//         $id = $postdata['id'];
//         $this->db->where('status','ACTIVE');
//         if($id != "" ){
//             $this->db->where('id',$id);
//         }
        
// 		$this->db->order_by('name','asc');
// 		$query = $this->db->get('ref_psn_name');	
// 		if ( $result = $query->result() ){ return $result; }
		
// 	} // end of get() function


}
