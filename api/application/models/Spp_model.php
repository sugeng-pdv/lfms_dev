<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spp_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'spp';
        $this->primary_key = 'id';
        parent::__construct();
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
	
	function getDataSPP()
    {
        // print_r(COMPANY_ID);die();
        $postdata = $_POST;
        // $id = $postdata[''];
        $this->db->select('spp.id,spp.spp_num,spp.spp_gk_num,spp.payment_type,spp.payment_to,spp.nominal,spp.total_field,spp.document_id,spp.status_spp');
        $this->db->select('ref_psn_name.name as psn_name');
        $this->db->where('ref_psn_name.id = spp.psn_id');
        $this->db->where('ref_psn_sector.id = ref_psn_name.psn_sector_id');
        $this->db->where('spp.status','ACTIVE');
        $this->db->where('spp.company_id',COMPANY_ID);
        // if($id != "" ){
        //     $this->db->where('psn_sector_id',$id);
        // }
		$this->db->order_by('spp.id','desc');
		$query = $this->db->get(array('spp','ref_psn_sector','ref_psn_name'));
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	function getDataSppAll()
    {
        // print_r(COMPANY_ID);die();
        $postdata = $_POST;
        $id = $postdata['id_spp'];
        $this->db->select('spp.*');
        $this->db->select('ref_psn_name.name as psn_name');
        $this->db->select('ref_psn_sector.name as sector_name');
        $this->db->where('ref_psn_name.id = spp.psn_id');
        $this->db->where('ref_psn_sector.id = ref_psn_name.psn_sector_id');
        $this->db->where('spp.status','ACTIVE');
        $this->db->where('spp.status_spp != "Belum Kirim"');
        $this->db->where('spp.status_spp != "Terbayar"');
        // $this->db->where('spp.status_spp != "Tertolak"');
        
        // Belum Kirim','Sudah Kirim','Menunggu Approval','Menunggu Pembayaran','Terbayar','Tertolak')
        // $this->db->where('spp.company_id',COMPANY_ID);
        if($id != "" ){
            $this->db->where('spp.id',$id);
        }
		$this->db->order_by('spp.id','desc');
		$query = $this->db->get(array('spp','ref_psn_sector','ref_psn_name'));
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	function getDataSppKadiv()
    {
        // print_r(COMPANY_ID);die();
        $postdata = $_POST;
        $id = $postdata['id_spp'];
        $this->db->select('spp.*');
        $this->db->select('ref_psn_name.name as psn_name');
        $this->db->select('ref_psn_sector.name as sector_name');
        $this->db->where('ref_psn_name.id = spp.psn_id');
        $this->db->where('ref_psn_sector.id = ref_psn_name.psn_sector_id');
        $this->db->where('spp.status','ACTIVE');
        $this->db->where('spp.status_spp != "Belum Kirim"');
        // $this->db->where('spp.status_spp != "Terbayar"');
        // $this->db->where('spp.status_spp != "Tertolak"');
        
        // Belum Kirim','Sudah Kirim','Menunggu Approval','Menunggu Pembayaran','Terbayar','Tertolak')
        // $this->db->where('spp.company_id',COMPANY_ID);
        if($id != "" ){
            $this->db->where('spp.id',$id);
        }
		$this->db->order_by('spp.id','desc');
		$query = $this->db->get(array('spp','ref_psn_sector','ref_psn_name'));
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	
	
	function getDataSPPStaff()
    {
        // print_r(COMPANY_ID);die();
        $postdata = $_POST;
        // $id = $postdata[''];
        $this->db->select('spp.id,spp.spp_num,spp.payment_type,spp.payment_to,spp.nominal,spp.total_field,spp.document_id,spp.status_spp,spp.status_process,spp.message_rejected');
        $this->db->select('ref_psn_name.name as psn_name');
        $this->db->where('ref_psn_name.id = spp.psn_id');
        $this->db->where('ref_psn_sector.id = ref_psn_name.psn_sector_id');
        $this->db->where('spp.status','ACTIVE');
        $this->db->where('spp.status_spp != "Belum Kirim"');
        //  $this->db->where('spp.status_spp',"Sudah Kirim");
        // if($id != "" ){
        //     $this->db->where('psn_sector_id',$id);
        // }
		$this->db->order_by('spp.id','desc');
		$query = $this->db->get(array('spp','ref_psn_sector','ref_psn_name'));
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	function getDataSppBendahara()
    {
        // print_r(COMPANY_ID);die();
        $postdata = $_POST;
        $id = $postdata['id_spp'];
        $this->db->select('spp.*');
        $this->db->select('ref_psn_name.name as psn_name');
        $this->db->select('ref_psn_sector.name as sector_name');
        // $this->db->select('ref_bank.name as bank_name');
        $this->db->where('ref_psn_name.id = spp.psn_id');
        $this->db->where('ref_psn_sector.id = ref_psn_name.psn_sector_id');
        // $this->db->where('ref_bank.id = spp.rek_bank_id');
        $this->db->where('spp.status','ACTIVE');
        $this->db->where('(spp.status_spp = "Menunggu Pembayaran" or spp.status_spp = "Terbayar" or spp.status_spp = "Menunggu Approval")');
        // $this->db->where('spp.status_spp','Terbayar');
        $this->db->where('spp.status_process','Nota Dinas sudah dikirim ke Direktur');
        
        // Belum Kirim','Sudah Kirim','Menunggu Approval','Menunggu Pembayaran','Terbayar','Tertolak')
        // $this->db->where('spp.company_id',COMPANY_ID);
        if($id != "" ){
            $this->db->where('spp.id',$id);
        }
		$this->db->order_by('spp.id','desc');
		$query = $this->db->get(array('spp','ref_psn_sector','ref_psn_name'));
		
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
// 	get_ttl_realiization

    function get_ttl_realiization($id =''){
        $this->db->select('sum(nominal) as ttl_realization');
        $this->db->where('status_process','Diterima');
        $this->db->where('status','ACTIVE');
        $this->db->where('spp_id_subm',$id);
        
		$query = $this->db->get('field');
			
		if ( $result = $query->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
    }
// 	getRealization
    function getRealization( $psn_id='')
    {
        $this->db->select('spp.*');
        $this->db->where('spp.status','ACTIVE');
        $this->db->where('(spp.status_spp = "Menunggu Pembayaran" or spp.status_spp = "Terbayar")');
        // $this->db->where('spp.status_spp','Terbayar');
        $this->db->where('spp.status_process','Nota Dinas sudah dikirim ke Direktur');
        
        // Belum Kirim','Sudah Kirim','Menunggu Approval','Menunggu Pembayaran','Terbayar','Tertolak')
        // $this->db->where('spp.company_id',COMPANY_ID);
        if($id != "" ){
            $this->db->where('spp.id',$psn_id);
        }
		$this->db->order_by('spp.id','desc');
		$query = $this->db->get(array('spp','ref_psn_sector','ref_psn_name'));
		
		if ( $result = $query->result() ){ return $result; }
    }
    // getRealisasiSPpPpk
    function getRealisasiSPpPpk( $psn_id='' )
	{
				
		$this->db->select('sum(spp.nominal_realization) as realization');
		$this->db->select('sum(spp.area_realization) as area_realization');
		$this->db->where('ref_psn_name.id = spp.psn_id');
        $this->db->where('spp.status','ACTIVE');
        $this->db->where('ref_psn_name.id',$psn_id);
        
		$query = $this->db->get(array('spp','ref_psn_name'));
			
		if ( $result = $query->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of user_detail() function
	
    // 	getFieldArea
    function getFieldArea( $spp_id='' )
	{
				
		$this->db->select('nominal,area');
        $this->db->where('spp.status','ACTIVE');
        $this->db->where('id',$spp_id);
        
		$query = $this->db->get('spp');
			
		if ( $result = $query->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of user_detail() function
	
	
	
	function checkSPpKadiv()
	{
	    $this->db->select('*');
	    $this->db->where('(status_process = "Dalam Proses Penelitian" or status_spp = "Tertolak")');
        $this->db->where('status','ACTIVE');
        $this->db->where('id',$this->lman_security->clean_post('id_spp'));
        
		$query = $this->db->get('spp');
			
		if ( $result = $query->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
	}
	

	
	
	
	
	
	
	
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
