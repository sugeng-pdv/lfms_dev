<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Monitoring_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'timeline_spp';
        $this->primary_key = 'id';
        parent::__construct();
	}

	
	function getDataMonitoringSpp()
    {
        // print_r(COMPANY_ID);die();
        // $id='';
        $postdata = $_POST;
        $idSpp = $this->lman_security->clean_post('id_spp');
        $search = $this->lman_security->clean_post('query');
        $this->db->select('spp.*');
        $this->db->select('ref_psn_name.name as psn_name');
        $this->db->where('ref_psn_name.id = spp.psn_id');
        $this->db->where('spp.status_spp != "Belum Kirim"');
        $this->db->where('spp.company_id',COMPANY_ID);
        if($search != ''){
            $this->db->where("(spp.spp_num = '".$search."' OR spp.request_code LIKE '%".$search."%' ESCAPE '!')"); //LIKE '%match%' ESCAPE '!'
            // $this->db->like('spp.spp_num',$search);
        }
        $this->db->order_by('spp.id','desc');
		$query = $this->db->get(array('spp','ref_psn_name'));
		
		if ( $result = $query->result() ){ return $result; }
// 		if ( $result = $query->result() ){
// 			// convert the result from array to object
// 			foreach ( $result as $data ){}
// 			return $data;
// 		}
		
	} // end of get() function
	
	function getLastProcessSpp($idSpp)
	{
	    $postdata = $_POST;
        // $idSpp = $this->lman_security->clean_post('id_spp');
        $this->db->select('max(timeline_id) as lastProcess');
        $this->db->where('spp_id',$idSpp);
        // $this->db->order_by('timeline_spp.timeline_id','asc');
		$query = $this->db->get(array('timeline_spp'));
		
// 		if ( $result = $query->result() ){ return $result; }
		if ( $result = $query->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
	}
	
	
	
	function getDataMonitoringSpp2($idSpp,$id)
    {
        // print_r(COMPANY_ID);die();
        // $id='';
        $postdata = $_POST;
        // $idSpp = $this->lman_security->clean_post('id_spp');
        $this->db->select('timeline_spp.*');
        // $this->db->select('ref_timeline.description as desc');
        // $this->db->where('ref_timeline.id = timeline_spp.timeline_id');
        $this->db->where('timeline_spp.spp_id',$idSpp);
        $this->db->where('timeline_spp.timeline_id',$id);
        // $this->db->order_by('timeline_spp.timeline_id','asc');
		$query = $this->db->get(array('timeline_spp'));
		
// 		if ( $result = $query->result() ){ return $result; }
		if ( $result = $query->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
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
