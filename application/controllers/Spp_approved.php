<?php

/*
 * Created on Sat Jun 13 2020 12:14:21 PM
 *
 * Filename Request_payment.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */



class Spp_approved extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
	}

 	
	public function index()
	{
	   // $result = $this->senddataurl('Auth/',$postdata,'POST');
	    $data['title']      = "Pembayaran SPP yang Telah Disetujui- Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Pembayaran SPP yang Telah Disetujui";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Pembayaran SPP yang Telah Disetujui";
	    $data['js'] = array(
			'assets/js/lfm/bdh/spp_approved.js',
			);
    // 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "SummaryPembayaran SPP yang Telah Disetujui - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Pembayaran SPP yang Telah Disetujui",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Pembayaran SPP yang Telah Disetujui",
				'content'	    => $this->load->view(PLATFORM_PATH.'bdh/spp_approved',$data,true),
				'js'            =>array(
				    // 'assets/js/lfm/kadiv/penelitian_administrasi.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	    
	}
	
	public function detail_summary_spp()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('spp_approved/get_summary_spp',$postdata,'POST');
		echo json_encode($result);
	}
    
    public function data_spp()
	{
	     $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('spp_approved/get_data_spp',$postdata,'POST');
		echo json_encode($result);
	}
	public function spp_save(){
        $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('spp_approved/spp_save',$postdata,'POST');
	   // print_r($result);die();
		echo json_encode($result);
    }
}