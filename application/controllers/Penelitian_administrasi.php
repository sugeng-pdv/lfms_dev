<?php

/*
 * Created on Sat Jun 13 2020 12:14:21 PM
 *
 * Filename Request_payment.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */



class Penelitian_administrasi extends CI_Controller {

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
	    $data['title']      = "Penelitian Administrasi Pendanaan Lahan - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Penelitian Administrasi Pendanaan Lahan";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Penelitian Administrasi Pendanaan Lahan";
	    $data['js'] = array(
			'assets/js/lfm/kadiv/penelitian_administrasi.js',
			);
    // 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Penelitian Administrasi Pendanaan Lahan - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Penelitian Administrasi Pendanaan Lahan",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Penelitian Administrasi Pendanaan Lahan",
				'content'	    => $this->load->view(PLATFORM_PATH.'kadiv/penelitian_administrasi',$data,true),
				'js'            =>array(
				    // 'assets/js/lfm/kadiv/penelitian_administrasi.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	    
	}
	
	public function data_spp()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('penelitian_administrasi/get_data_spp_kadiv',$postdata,'POST');
		echo json_encode($result);
	}
	
	public function data_pegawai()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('penelitian_administrasi/get_data_pegawai',$postdata,'POST');
		echo json_encode($result);
	}
	
	public function pic_update()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('penelitian_administrasi/update_pic_spp',$postdata,'POST');
		echo json_encode($result);
	}
	public function detail_summary_spp()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('penelitian_administrasi/get_summary_spp',$postdata,'POST');
		echo json_encode($result);
	}
	public function update_spp_approval_kadiv()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('penelitian_administrasi/update_spp_approval_kadiv',$postdata,'POST');
		echo json_encode($result);
	} 

}
