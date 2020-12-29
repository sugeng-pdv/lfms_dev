<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Spp extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: authorization");

    }

    public function index() {}

    public function spp_save(){
        $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Spp/spp_save',$postdata,'POST');
	   // print_r($result);die();
		echo json_encode($result);
    }
    public function sectorPsn_data()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Spp/get_sector_psn',$postdata,'POST');
		echo json_encode($result);
	}
	
	public function namePsn_data()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Spp/get_name_psn',$postdata,'POST');
		echo json_encode($result);
	}
	
	public function data_spp()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Spp/get_data_spp',$postdata,'POST');
		echo json_encode($result);
	}
	
	public function bank_data()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Spp/get_name_bank',$postdata,'POST');
		echo json_encode($result);
	}
    
    
    
    
    
    
    

}
// akhir - class
