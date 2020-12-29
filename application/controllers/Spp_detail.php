<?php

/*
 * Created on Sat Jun 13 2020 12:14:21 PM
 *
 * Filename Request_payment.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */



class Spp_detail extends CI_Controller {

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
	    $data['title']      = "Permohonan Pembayaran - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Beranda/Permohonan Pembayaran/Surat Permohonan Pembayaran";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Permohonan Pembayaran";
	    $data['js'] = array(
			'assets/js/lfm/ppk/request_payment.js',
			);
    // 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Permohonan Pembayaran Sistem - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Beranda/Permohonan Pembayaran/Surat Permohonan Pembayaran",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Permohonan Pembayaran",
				'content'	    => $this->load->view(PLATFORM_PATH.'ppk/spp_detail',$data,true),
				'js'            =>array(
				    // 'assets/js/lfm/ppk/request_payment.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	    
	}
	

}
