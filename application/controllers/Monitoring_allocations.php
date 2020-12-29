<?php

/*
 * Created on Sat Oct 23 2020 15:25:21 PM
 *
 * Filename Monitoring_payment.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */



class Monitoring_allocations extends CI_Controller {

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
	    $data['title']      = "Monitoring Pembayaran - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Beranda/Monitoring SPP";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Monitoring SPP";
	    $data['js'] = array(
			'assets/js/lfm/ppk/monitoring_allocations.js',
			);
        // $this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Monitoring Pembayaran Sistem - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Beranda/Monitoring SPP",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Monitoring SPP",
				'content'	    => $this->load->view(PLATFORM_PATH.'ppk/monitoring_allocations',$data,true),
				'js'            =>array(
				    'assets/js/lfm/ppk/monitoring_allocations.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	    
	}
	public function data_spp()
	{
	    $postdata=$_POST;
        $result = $this->lman_library->senddataurl('Monitoring/spp_monitoring_ppk',$postdata,'POST');
        echo json_encode($result);
	}
	
	public function data_table_spp()
	{
	    $postdata=$_POST;
        $result = $this->lman_library->senddataurl('Monitoring/spp_history_ppk',$postdata,'POST');
        echo json_encode($result);
	}
	
	

}
