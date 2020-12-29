<?php

/*
 * Created on Sat Jun 13 2020 12:14:21 PM
 *
 * Filename Request_payment.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */



class Control_budget extends CI_Controller {

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
	    $data['menu_text']= "Alokasi Anggaran PSN";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Alokasi Anggaran PSN";
	    $data['js'] = array(
			'assets/js/lfm/prl/control_budget.js',
			);
    // 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Control Budget PSN - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Alokasi Anggaran PSN",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Alokasi Anggaran PSN",
				'content'	    => $this->load->view(PLATFORM_PATH.'prl/control_budget',$data,true),
				'js'            =>array(
				    // 'assets/js/lfm/ppk/request_payment.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	    
	}
	public function businessEntity_data()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Control_budget/get_business_entity',$postdata,'POST');
		echo json_encode($result);
	}
	public function budget_save(){
        $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Control_budget/budget_save',$postdata,'POST');
	   // print_r($result);die();
		echo json_encode($result);
    }
    //data-psn
    public function data_psn(){
        $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Control_budget/data_psn',$postdata,'POST');
		echo json_encode($result);
    }
	

}
