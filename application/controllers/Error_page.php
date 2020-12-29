<?php

/*
 * Created on Tue Jun 16 2020 3:11:27 PM
 *
 * Filename Error_page.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */



class Error_page extends CI_Controller {

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
		$this->load->library('Lman_library');
	}

	protected function getdataurl($url){
		$uri = $this->config->item('api_endpoint').'/'.$url;
		$apiKey = 'Lman@123';
		$params = array(
			'Content-Type: application/json',
			'x-api-key:'.$apiKey
			);
			$apiUser ="admin";
			$apiPass = "1234";

		$ch = curl_init($uri);
		// curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
		curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");

		// $data  = json_decode(curl_exec($ch));
		$data  = json_decode(curl_exec($ch));
		// echo $data;die();
 		return $data;
 	}

 	protected function senddataurl($url,$data,$type){
 		$time = time();
 		$uri = $this->config->item('api_endpoint').'/'.$url;
 		// die($uri);
		 $apiKey = 'Lman@123';
		 // API auth credentials
		$apiUser = "admin";
		$apiPass = "1234";
 		$params = array(
 			'Content-Type: application/x-www-form-urlencoded',
 			'x-api-key:'.$apiKey
 			);

 		$ch = curl_init($uri);
 		curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$type);
 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 		curl_setopt($ch, CURLOPT_HEADER, false);
 		curl_setopt($ch, CURLOPT_HTTPHEADER, $params);
		curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");
 		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
 		$ex = curl_exec($ch);
 		$result  = json_decode($ex);
 		// $ex = curl_exec($ch);
 		//  $result  = json_encode($ex);
 		//    echo $result;
 		#debug file
 				 // file_put_contents("C:\server\htdocs\dummy\debug\debug.txt", print_r(
 					// array(
 					// 	"body" => $ex,
 					// 	"url" => $uri,
 					// 	"data" => $data,
 				 // ),true), FILE_APPEND);
 		return $result;
 	}
	public function index()
	{
	
	}
	public function page_not_found()
	{
	   // $this->load->view(PLATFORM_PATH.'home/index_direktur','',true);
	    $data['title']      = "Home Sistem - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Beranda Direktur";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda";
// 	    $data['js'] = array(
// 			'assets/js/lfm/home/index_direktur.js',
// 			);
// 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Halaman tidak ditemukan",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - page not found",
				'content'	    => $this->load->view(VIEWS_ERROR_PATH.'html/error_404',$data,true),
				// $this->load->view(PLATFORM_PATH.'home/index_direktur',$data,true),
				// 'js'            =>array(
				//     'assets/js/lfm/home/index_direktur.js',
				//     )
				);
			// $status	= false;
		
		echo json_encode($data);
// 		$this->load->view(VIEWS_ERROR_PATH.'html/error_404');
	}

	

}
