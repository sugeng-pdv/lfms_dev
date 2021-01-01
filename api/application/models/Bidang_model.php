<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bidang_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'field';
        $this->primary_key = 'id';
        parent::__construct();
	}

	function getDataBidang()
    {
        // print_r(COMPANY_ID);die();
        $postdata = $_POST;
        $id = $this->lman_security->clean_post('id_bidang');
        $this->db->select('field.*');
        $this->db->select('spp.spp_num as spp_no');
        $this->db->select('ref_kelurahan.name as village_name');
        $this->db->select('ref_kecamatan.name as sub_district_name');
        $this->db->select('ref_kab_kota.name as district_name');
        $this->db->select('ref_provinsi.name as province_name');
        $this->db->select('ref_jns_bidang.name as fieldtype_name');
        $this->db->where('spp.id = field.spp_id_subm');
        $this->db->where('ref_kelurahan.id =  field.village');
        $this->db->where('ref_kecamatan.id =  field.sub_district');
        $this->db->where('ref_kab_kota.id =  field.district');
        $this->db->where('ref_provinsi.id =  field.province');
        $this->db->where('ref_jns_bidang.id =  field.jns_bidang_id');
        $this->db->where('field.status','ACTIVE');
        $this->db->where('field.spp_id_subm',$this->lman_security->clean_post('id_spp'));
        if($id != "" ){
            $this->db->where('field.id',$id);
        }
		$this->db->order_by('field.id','asc');
		$query = $this->db->get(array('field','spp','ref_kelurahan','ref_jns_bidang','ref_kecamatan','ref_kab_kota','ref_provinsi'));
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	function getDataBidangRejected()
	{
	    // print_r(COMPANY_ID);die();
        $postdata = $_POST;
        $this->db->select('field.*');
        $this->db->select('spp.spp_num as spp_no');
        $this->db->select('ref_kelurahan.name as village_name');
        $this->db->select('ref_jns_bidang.name as fieldtype_name');
        $this->db->where('spp.id = field.spp_id');
        $this->db->where('ref_kelurahan.id =  field.village');
        $this->db->where('ref_jns_bidang.id =  field.jns_bidang_id');
        $this->db->where('field.status','ACTIVE');
        $this->db->where('field.status_process','Tertolak');
        $this->db->where('field.payment_type',$this->lman_security->clean_post('payment'));
        if($this->lman_security->clean_post('payment') == 'Langsung'){
            $this->db->where('field.payment_to',$this->lman_security->clean_post('payment_to'));
        }
        $this->db->where('field.company_id',COMPANY_ID);
        
		$this->db->order_by('field.id','asc');
		$query = $this->db->get(array('field','spp','ref_kelurahan','ref_jns_bidang'));
		
		if ( $result = $query->result() ){ return $result; }
	}
	//get status bidang
	function getDataBidangStatus()
    {
        $Total       = $this->get_sppCounts();
        $getRejected = $this->get_rejected();
        $getApproved = $this->get_approved();
        $getProcess  = $this->get_process();
        $getReadyProcess = $this->get_readyProcess();
        // print_r($getRejected."&&&".$getApproved."***".$getProcess."+++".$this->lman_security->clean_post('id_spp'));die();
		if($getRejected >= 1){
		    $status = true;
		}else{
		    if($Total == $getApproved){
		        $status = false;
		    }else{
		        if($Total == $getProcess){
		            $status = false;
		        }else{
		            $status = true;
		        }
		    }
		}
		return $status;
	} // end of get() function
	
	function get_sppCounts(){
	    $postdata = $_POST;
        $this->db->select('field.*');
        $this->db->where('field.status','ACTIVE');
        $this->db->where('field.spp_id',$this->lman_security->clean_post('id_spp'));
        
		$query = $this->db->get('field');
		
		if ( $result = $query->num_rows() ){ return $result; }
	}
	function get_rejected(){
	    $postdata = $_POST;
        $this->db->select('field.*');
        $this->db->where('field.status_process','Tertolak');
        $this->db->where('field.status','ACTIVE');
        $this->db->where('field.spp_id',$this->lman_security->clean_post('id_spp'));
        
		$query = $this->db->get('field');
		
		if ( $result = $query->num_rows() ){ return $result; }
	}
	function get_approved(){
	    $postdata = $_POST;
        $this->db->select('field.*');
        $this->db->where('field.status_process','Diterima');
        $this->db->where('field.status','ACTIVE');
        $this->db->where('field.spp_id',$this->lman_security->clean_post('id_spp'));
        
		$query = $this->db->get('field');
		
		if ( $result = $query->num_rows() ){ return $result; }
	}
	function get_process(){
	   // print_r($this->lman_security->clean_post('id_spp'));die();
	    $postdata = $_POST;
        $this->db->select('field.*');
        $this->db->where('field.status_process','Sedang diproses');
        $this->db->where('field.status','ACTIVE');
        $this->db->where('field.spp_id',$this->lman_security->clean_post('id_spp'));
        
		$query = $this->db->get('field');
		
		if ( $result = $query->num_rows() ){ return $result; }
	}
	function get_readyProcess(){
	   // print_r($this->lman_security->clean_post('id_spp'));die();
	    $postdata = $_POST;
        $this->db->select('field.*');
        $this->db->where('field.status_process','Belum Dikirm');
        $this->db->where('field.status','ACTIVE');
        $this->db->where('field.spp_id',$this->lman_security->clean_post('id_spp'));
        
		$query = $this->db->get('field');
		
		if ( $result = $query->num_rows() ){ return $result; }
	}
	
	
	function spp_history_ppk()
	{
	    // print_r(COMPANY_ID);die();
        $postdata = $_POST;
        $id = $this->lman_security->clean_post('id_bidang');
        $search = $this->lman_security->clean_post('query');
        $this->db->select('field.*');
        $this->db->select('spp.spp_num as spp_no');
        $this->db->select('spp.date_received as date_process');
        $this->db->select('spp.date_a3_publish as date_decision');
        $this->db->select('spp.sk_doc_id as doc_id');
        $this->db->select('spp.sk_number as sk_number');
        $this->db->select('ref_psn_name.name as psn_name');
        $this->db->select('ref_jns_bidang.status_bidang as fieldtype');
        $this->db->select('ref_jns_bidang.name as fieldtype_name');
        
        $this->db->select('ref_kelurahan.name as village_name');
        $this->db->where('ref_psn_name.id =  spp.psn_id');
        $this->db->where('spp.id = field.spp_id_subm');
        $this->db->where('ref_kelurahan.id =  field.village');
        $this->db->where('ref_jns_bidang.id =  field.jns_bidang_id');
        $this->db->where('field.status','ACTIVE');
        $this->db->where('spp.company_id',COMPANY_ID);
        if($search === 'Sudah Kirim'){
            $this->db->where('(spp.status_spp = "Sudah Kirim" or spp.status_spp = "Menunggu Approval" or spp.status_spp = "Menunggu Pembayaran")');
        }else{
            $this->db->where('spp.status_spp',$search);
        }
        // $this->db->where('field.spp_id_subm',$this->lman_security->clean_post('id_spp'));
        if($id != "" ){
            $this->db->where('field.id',$id);
        }
		$this->db->order_by('field.id','asc');
		$query = $this->db->get(array('field','spp','ref_psn_name','ref_kelurahan','ref_jns_bidang'));
		
		if ( $result = $query->result() ){ return $result; }
	}
	
	function getDataBidangStaff()
    {
        // print_r(COMPANY_ID);die();
        $postdata = $_POST;
        $id = $this->lman_security->clean_post('id_bidang');
        $this->db->select('field.*');
        $this->db->select('spp.spp_num as spp_no');
        $this->db->select('spp.document_id as doc_spp_id');
        $this->db->select('spp.doc_sptjm_id as doc_sptjm_id');
        $this->db->select('spp.doc_letter_id as doc_letter_id');
        $this->db->select('spp.doc_bpn_id as doc_bpn_id');
        $this->db->select('spp.status_doc_spp as status_doc_spp');
        $this->db->select('spp.status_dok_letter as status_dok_letter');
        			
        $this->db->select('spp.status_process as statusSpp');
        
        $this->db->select('ref_kelurahan.name as village_name');
        $this->db->select('ref_kecamatan.name as sub_district_name');
        $this->db->select('ref_kab_kota.name as district_name');
        $this->db->select('ref_provinsi.name as province_name');
        
        $this->db->select('ref_jns_bidang.name as fieldtype_name');
        $this->db->where('spp.id = field.spp_id_subm');
        $this->db->where('ref_kelurahan.id =  field.village');
        $this->db->where('ref_kecamatan.id =  field.sub_district');
        $this->db->where('ref_kab_kota.id =  field.district');
        $this->db->where('ref_provinsi.id =  field.province');
        $this->db->where('ref_jns_bidang.id =  field.jns_bidang_id');
        $this->db->where('field.status','ACTIVE');
        $this->db->where('field.spp_id_subm',$this->lman_security->clean_post('id_spp'));
        if($id != "" ){
            $this->db->where('field.id',$id);
        }
		$this->db->order_by('field.id','asc');
		$query = $this->db->get(array('field','spp','ref_kelurahan','ref_jns_bidang','ref_kecamatan','ref_kab_kota','ref_provinsi'));
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	
	function getRealisasiPPK( $spp_id='' )
	{
				
		$this->db->select('sum(field.nominal) as realization');
		$this->db->where('spp.id = field.spp_id_subm');
		$this->db->where('spp.status_spp',"Terbayar");
        $this->db->where('field.status','ACTIVE');
        $this->db->where('field.spp_id_subm',$spp_id);
        
		$query = $this->db->get(array('field','spp'));
			
		if ( $result = $query->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of user_detail() function
	
	function getRealisasiSPpPpk( $psn_id='' )
	{
				
		$this->db->select('sum(field.nominal) as realization');
		$this->db->where('spp.id = field.spp_id_subm');
		$this->db->where('ref_psn_name.id = spp.psn_id');
		$this->db->where('spp.status_spp',"Terbayar");
        $this->db->where('field.status','ACTIVE');
        $this->db->where('ref_psn_name.id',$psn_id);
        
		$query = $this->db->get(array('field','spp','ref_psn_name'));
			
		if ( $result = $query->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of user_detail() function
	
	
	function getFieldArea($spp_id = ''){
	    $this->db->select('sum(field.area) as ttl_area');
	    $this->db->select('sum(field.nominal) as ttl_nominal');
		$this->db->where('spp.id = field.spp_id_subm');
		$this->db->where('spp.id',$spp_id);
        $this->db->where('field.status','ACTIVE');
        
		$query = $this->db->get(array('field','spp'));
			
		if ( $result = $query->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
	}
	
	function cekTeritory($nib ='', $teritoryCode='')
	{
	   // $teritoryCode ='2-163-2031-26450';
	    $this->db->select('*');
		$this->db->where('nib_temp',$nib);
		$this->db->like('teritory_code',$teritoryCode);
        $this->db->where('field.status','ACTIVE');
        
		$query = $this->db->get('field');
			
		$result = $query->num_rows();
		if($result == 0){
			$status = true;
		}else{
		    $status = false;
		}
// 		print_r($status."+".$result."+".$nib."+".$teritoryCode);die();
        return $status;
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
