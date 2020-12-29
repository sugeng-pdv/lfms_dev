<?php

/*
 * Created on Fri Oct 16 2020 16:12:21 PM
 *
 * Filename Bidang_detail.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */



class Bidang_detail extends CI_Controller {

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
	    $data['title']      = "Detail Bidang - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Beranda/Permohonan Pembayaran/Surat Permohonan Pembayaran/Detail Bidang";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Permohonan Pembayaran";
	    $data['js'] = array(
			'assets/js/lfm/ppk/detail_bidang.js',
			);
    // 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Detail Bidang - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Beranda/Permohonan Pembayaran/Surat Permohonan Pembayaran/Detail Bidang",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Detail Bidang",
				'content'	    => $this->load->view(PLATFORM_PATH.'ppk/bidang_detail',$data,true),
				'js'            =>array(
				    'assets/js/lfm/ppk/detail_bidang.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	    
	}
	
	public function data_bidang()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Bidang/get_data_bidang',$postdata,'POST');
		echo json_encode($result);
	}
	
	public function jenis_bidang()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Bidang/get_jenis_bidang',$postdata,'POST');
	    echo json_encode($result);
	}
    public function  get_province()
    {
        $postdata=$_POST;
        $result = $this->lman_library->senddataurl('Bidang/get_province',$postdata,'POST');
        echo json_encode($result);
    }
    public function  get_district()
    {
        $postdata=$_POST;
        $result = $this->lman_library->senddataurl('Bidang/get_district',$postdata,'POST');
        echo json_encode($result);
    }
    public function get_subdistrict()
    {
        $postdata=$_POST;
        $result = $this->lman_library->senddataurl('Bidang/get_subdistrict',$postdata,'POST');
        echo json_encode($result);
    }
    public function get_village()
    {
        $postdata=$_POST;
        $result = $this->lman_library->senddataurl('Bidang/get_village',$postdata,'POST');
        echo json_encode($result);
    }
    public function bidang_save()
    {
        $postdata=$_POST;
        $result = $this->lman_library->senddataurl('Bidang/save_bidang',$postdata,'POST');
        echo json_encode($result);
    }
    public function bidang_send()
    {
        $postdata=$_POST;
        $result = $this->lman_library->senddataurl('Bidang/send_bidang',$postdata,'POST');
        echo json_encode($result);
    }
    public function bidang_reject()
    {
        $postdata=$_POST;
        $result = $this->lman_library->senddataurl('Bidang/reject_bidang',$postdata,'POST');
        echo json_encode($result);
    }
    public function bidang_reject_update()
    {
        $postdata=$_POST;
        $result = $this->lman_library->senddataurl('Bidang/reject_bidang_update',$postdata,'POST');
        echo json_encode($result);
    }
	
	
	
	public function bidang_send_staff()
    {
        $postdata=$_POST;
        $result = $this->lman_library->senddataurl('Bidang/send_bidang_staff',$postdata,'POST');
        echo json_encode($result);
    }
    
    public function bidang_check()
    {
        $postdata=$_POST;
        $result = $this->lman_library->senddataurl('Bidang/check_video',$postdata,'POST');
        echo json_encode($result);
    }

}
