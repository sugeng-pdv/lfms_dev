<?php

/*
 * Created on Sat Jun 13 2020 12:14:21 PM
 *
 * Filename Request_payment.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */



class Penelitian_administrasi_ppk extends CI_Controller {

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
	    $data['title']      = "Penelitian Administrasi - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Penelitian Administrasi";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Penelitian Administrasi";
	    $data['js'] = array(
			'assets/js/lfm/staff/penelitian_administrasi.js',
			);
    // 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Penelitian Administrasi Sistem - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Penelitian Administrasi",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Penelitian Administrasi",
				'content'	    => $this->load->view(PLATFORM_PATH.'staff/penelitian_administrasi',$data,true),
				'js'            =>array(
				    // 'assets/js/lfm/ppk/request_payment.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	    
	}
	
	
	public function data_spp()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Penelitian_administrasi_ppk/get_data_spp',$postdata,'POST');
	   // print_r($result);die();
		echo json_encode($result);
	}
	
	public function data_bidang()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Penelitian_administrasi_ppk/get_data_bidang',$postdata,'POST');
		echo json_encode($result);
	}
// 	data-bidang-byid
	public function data_bidang_byid()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Penelitian_administrasi_ppk/get_data_bidang_byid',$postdata,'POST');
	   // print_r($result);die();
		echo json_encode($result);
	}
	
	
	public function update_approval()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Penelitian_administrasi_ppk/update_approval',$postdata,'POST');
		echo json_encode($result);
	}
	//update_approval_spp_post
	public function update_approval_spp()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Penelitian_administrasi_ppk/update_approval_spp',$postdata,'POST');
		echo json_encode($result);
	}
	
	public function update_approval_bidang()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Penelitian_administrasi_ppk/update_approval_bidang',$postdata,'POST');
		echo json_encode($result);
	}
    
	

}
