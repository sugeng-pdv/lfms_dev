<?php

/*
 * Created on Sat Jun 13 2020 12:14:21 PM
 *
 * Filename Auth.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */



class Auth extends CI_Controller {

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
//  		$ex = curl_exec($ch);
//  		 $result  = json_encode($ex);
//  		    echo $result;
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
	   // $result = $this->senddataurl('Auth/',$postdata,'POST');
	    $data['title']      = "Login Sistem - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Login Sistem";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Login";
	    $data['js'] = array(
			'assets/js/lfm/auth/login.js',
			);
// 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Login Sistem - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Login Sistem",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Login",
				'content'	    => $this->load->view(PLATFORM_PATH.'auth/index',$data,true),
				'js'            =>array(
				    'assets/js/lfm/auth/login.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	}

    public function login()
	{
	    $postdata=$_POST;
	    $result = $this->senddataurl('Auth/login',$postdata,'POST');
		echo json_encode($result);
	}
    
    public function change_password()
	{
	   // $result = $this->senddataurl('Auth/',$postdata,'POST');
	    $data['title']      = "Change Password Sistem - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Change Password Sistem";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Change Password";
	    $data['js'] = array(
			'assets/js/lfm/auth/change_password.js',
			);
// 		$this->template->display($data,PLATFORM_PATH.'auth/change_password');
// 		$this->load->view(PLATFORM_PATH.'auth/change_password',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Change Password Sistem - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Change Password Sistem",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Change Password",
				'content'	    => $this->load->view(PLATFORM_PATH.'auth/change_password',$data,true),
				'js'            =>array(
				    'assets/js/lfm/auth/change_password.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	}
    
    public function update_password()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Auth/update_password',$postdata,'POST');
		echo json_encode($result);
	}
	
	public function loop()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Auth/check_login',$postdata,'POST');
		echo json_encode($result);
	}















	function user_login()
	{
		$postdata = $_POST;
		$sessionCaptcha = $this->mx_encryption->decrypt($this->session->userdata('captchaword'));
		$captchaWord	= $postdata['captcha'];

		if($this->check_captcha($captchaWord)){
			$dataLogin  = $this->senddataurl('vms/Auth/userLogin',$postdata,'POST');
			// print_r($dataLogin->data[0] );die();
			if($dataLogin->status == true){
				//check form registrasi vendor
				$idAccount = $dataLogin->data[0]->email;
				// $login_session=array(
				// 	'login_vms'		=> TRUE,
				// 	'id'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->id),
				// 	'role'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->role),
				// 	'email'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->email)
				// );
				// $this->session->set_userdata($login_session);
				if($dataLogin->data[0]->role_text == "Pegawai"){
					$login_session=array(
					'login_vms'		=> TRUE,
					'id'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->id),
					'role'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->role),
					'role_text'		=> $this->mx_encryption->encrypt($dataLogin->data[0]->role_text),
					'email'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->email)
					);
					$this->session->set_userdata($login_session);
					$dataLogin->data = base_url()."lman-vms";
				}elseif($dataLogin->data[0]->role_text == "Penyedia"){
					if($dataLogin->message == true)
					{
						$login_session=array(
							'login_vms'		=> TRUE,
							'id'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->id),
							'role'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->role),
							'role_text'		=> $this->mx_encryption->encrypt($dataLogin->data[0]->role_text),
							'email'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->email)
							);
							
						$this->session->set_userdata($login_session);
						// print_r($this->session->userdata('id'));die();
						$dataLogin->data =base_url()."penyedia";

					}else{
						$dataLogin->data =base_url()."form-registrasi/".$this->mx_encryption->encrypt($idAccount);;
					}
					
				}else{
					
				}
				$dataLogin->message = "Login Berhasil <br> Welcome ,<strong class='text-success'>".$postdata['email']."</strong>";

			}
			$userLogin = $dataLogin;
		}else{
			// $userLogin  = $this->senddataurl('vms/Landing/userLogin',$postdata,'POST');
			$userLogin = array(
				'status'	=> false,
				'data'		=> '',
				'message'	=> "Kode Captcha Salah");
			// $status	= false;
		}
		echo json_encode($userLogin);
	}

}
