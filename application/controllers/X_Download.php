<?php

/*
 * Created on Mon Jun 08 2020 6:15:50 PM
 * Controller
 * Filename Download.php
 * Author Sugeng Riyadi
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */

class Download extends CI_Controller {

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
		// $this->main_library->check_login();
		// $this->API=API_LMAN;
		// $this->UPLOAD=FILE_FORM_B_;
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
		$url = $this->uri->segment(2);
		$linkDownload = $this->config->item('static_file_download_url')."".$url;
		$path = file_get_contents($linkDownload);
		// print_r($linkDownload);die();
		// print_r($url);die();
		force_download(NULL,$path);
	}
	public function download()
	{
		$url = $this->uri->segment(1);
		print_r($url);die();
		$data = array();
	}
	
}
