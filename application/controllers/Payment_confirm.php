<?php

/*
 * Created on Sat Jun 13 2020 12:14:21 PM
 *
 * Filename Request_payment.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */



class Payment_confirm extends CI_Controller {

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
	    $data['title']      = "Konfirmasi Pembayarn SPP- Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Konfirmasi Pembayarn SPP";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Konfirmasi Pembayarn SPP";
	    $data['js'] = array(
			'assets/js/lfm/bdh/payment_confirm.js',
			);
    // 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "SummaryKonfirmasi Pembayarn SPP - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Konfirmasi Pembayarn SPP",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Konfirmasi Pembayarn SPP",
				'content'	    => $this->load->view(PLATFORM_PATH.'bdh/payment_confirm',$data,true),
				'js'            =>array(
				    // 'assets/js/lfm/kadiv/penelitian_administrasi.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	    
	}
	
	public function spp_save()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Payment_confirm/spp_save',$postdata,'POST');
	   // print_r($result);die();
		echo json_encode($result);
	}

}
