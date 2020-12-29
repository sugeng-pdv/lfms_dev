<?php

/*
 * Created on Wed Jun 10 2020 10:39:17 AM
 *
 * Filename Landing.php
 * Author Sugeng Riyadi
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */


class Landing extends CI_Controller {

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
	 protected function senddataurlEmail($url,$data,$type){
		$time = time();
		$uri = $this->config->item('endpoint_email').'/'.$url;
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
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
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
		$data = array();
		$data['cap_image'] = $this->lman_library->created_captcha();
		// print_r($data['cap_image']);die();
		$this->load->view( PLATFORM_PATH.'landing/index', $data );
	}

	//untuk menampilkan data file master
	public function master_file()
	{
		$postdata = $_POST;
		$dataFile  = $this->senddataurl('vms/Landing/getMasterFile',$postdata,'POST');
		// print_r($dataFile);die();
		$data = array(
			'data' => array()
		);
		$num =1;
		foreach ($dataFile->data as $key => $value) {
			$datas[$key] = $value;
			$value->id = $this->mx_encryption->encrypt($value->id);
			$doc = '<a href="'.$this->config->item('static_base_url')."file-download/".$value->s3_object.'" target="_blank" ><label">'.$value->keterangan.'<span class="badge bg-green"> <i class="fa fa-cloud-download-alt" title="Download File"></i></span></label></a>';
			// $doc = '<a href="'.base_url()."download/".$value->s3_object.'" target="_blank" ><label"><span class="badge bg-green">'.$value->keterangan.' <i class="fa fa-cloud-download-alt" title="Sudah Diupload"></i></span></label></a>';
			$value->s3_object = $this->mx_encryption->encrypt($value->s3_object);
				// $datas[$key]->tgl_selesai_sk = $this->main_library->tanggal_indo($datas[$key]->tgl_selesai_sk);
			
			$datas[$key]->num = $num;
			$datas[$key]->kontent = $doc;
			$datas[$key]->posting_time =$value->date_upload;
			$num++;
		}
		$data['data']['elapsed_time'] = $dataFile->elapsed_time;
		echo json_encode(array('data'=>$datas,'elapsed_time'=>$dataFile->elapsed_time));
	}

	//untuk refresh captcha
	function request_captcha(){
		$data=array();
		$data = $this->lman_library->created_captcha();
		if(!$data){
			$status = FALSE;
		}else{
			$status = TRUE;
		}
		echo json_encode(array('status'=>$status,'captcha'=>$data));
	}

	function vendor_register()
	{
		$postdata = $_POST;
		$sessionCaptcha = $this->mx_encryption->decrypt($this->session->userdata('captchaword'));
		$captchaWord	= $postdata['captcha'];

		if($this->check_captcha($captchaWord)){
			$registerVendor  = $this->senddataurl('vms/Landing/registerVendor',$postdata,'POST');
			// print_r($registerVendor->status);die();
			if($registerVendor->status == true){
				// $this->load->helper('pwd_helper');
				
				$default_password = random_string('alnum',6);
				$enc_password = $this->mx_encryption->encrypt($default_password);
				$postdata['api_key']  		= "gD7m2efNl5tq1iQzkB3gU";
				$postdata['email_to']  		= strtolower($postdata['email']);
				$postdata['email_subject']  = "Pendaftaran Vendor Manajemen Sistem LMAN";
				$postdata['reply_to']  		= "procurement.lman@kemenkeu.go.id";
				$postdata['enc_password'] 	= $enc_password;
				$postdata['salt_password'] 	= $this->mx_encryption->encrypt($postdata['email']);
				$postdata['default_password'] = $default_password;
				// $postdata['isi_email'] 		= "coba kirim email";
				$postdata['isi_email'] = $this->load->view(PLATFORM_PATH.'email/vendor_register', $postdata, TRUE);
				// $postdata['isi_email'] 		= $this->load->view(PLATFORM_PATH.'email/vendor_register_email_token', $postdata, TRUE);
				$postdata['email_message']  = $postdata['isi_email'];
				print_r($postdata['isi_email']);die();
				$registerEmail = $this->senddataurlEmail('email',$postdata,'POST');
				$saveRegister  = $this->senddataurl('vms/Landing/registerSave',$postdata,'POST');
				print_r($saveRegister);die();
				//email ke server 

				$registerVendor = $saveRegister;
			}else{
				$registerVendor =$registerVendor ;
			}
		}else{
			// $registerVendor  = $this->senddataurl('vms/Landing/registerVendor',$postdata,'POST');
			// print_r($this->mx_encryption->decrypt($this->session->userdata('captchaword')));die();
			$registerVendor = array(
				'status'	=> false,
				'message'	=> "Kode Captcha Salah");
			// $status	= false;
		}
		echo json_encode($registerVendor);
	}

	function user_login()
	{
		$postdata = $_POST;
		$sessionCaptcha = $this->mx_encryption->decrypt($this->session->userdata('captchaword'));
		$captchaWord	= $postdata['captcha'];

		if($this->check_captcha($captchaWord)){
			$userLogin  = $this->senddataurl('vms/Landing/userLogin',$postdata,'POST');
			// print_r($userLogin);die();
			if($userLogin->status == true){
				// $this->load->helper('pwd_helper');
				$default_password = random_string('alnum',6);
				$enc_password = $this->mx_encryption->encrypt($default_password);

				$postdata['email'] = strtolower($postdata['email']);
				$postdata['enc_password'] = $enc_password;
				$postdata['salt_password'] = $this->mx_encryption->encrypt($postdata['email']);
				$postdata['default_password'] = $default_password;
				$postdata['isi_email'] = $this->load->view(PLATFORM_PATH.'email/vendor_register', $postdata, TRUE);
				$saveRegister  = $this->senddataurl('vms/Landing/registerSave',$postdata,'POST');
				$userLogin = $saveRegister;
			}else{
				$userLogin =$userLogin ;
			}
		}else{
			// $userLogin  = $this->senddataurl('vms/Landing/userLogin',$postdata,'POST');
			// print_r($this->mx_encryption->decrypt($this->session->userdata('captchaword')));die();
			$userLogin = array(
				'status'	=> false,
				'message'	=> "Kode Captcha Salah");
			// $status	= false;
		}
		echo json_encode($userLogin);
	}



	function template_email(){
		$default_password = random_string('alnum',6);
		$enc_password = $this->mx_encryption->encrypt($default_password);
		$maildata['email'] = "sugeng.riyadi10@gmail.com";
		$maildata['default_password'] = $default_password;
		$this->load->view(PLATFORM_PATH.'/email/vendor_register', $maildata); 
	}

	function check_captcha($val=null)
	{
		$sessionCaptcha = $this->mx_encryption->decrypt($this->session->userdata('captchaword'));
		if($val == $sessionCaptcha){
			return true;
		}else{
			return false;
		}
	}
}
