<?php

/*
 * Created on Sat Jun 13 2020 12:14:21 PM
 *
 * Filename Home.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */



class Home extends CI_Controller {

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
 	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('Auth/check_status_login',$postdata,'POST');
	   // print_r($result->token[0]->role_name);die();
	    if($result->status == true){
	        $roleName = $result->token[0]->role_name;
	        switch ($roleName) {
	                        case 'Administrator':
                                $this->home_admin();
                                break;
                                
                            case 'Direktur Utama':
                                $this->home_dirut();
                                break;
                                
                            case 'Direktur':
                                $this->home_direktur();
                                break;
                                
                            case 'Bendahara':
                                $this->home_bendahara();
                                break;
                            
                            case 'KADIV':
                                $this->home_kadiv();
                                break;
                            
                            case 'PRL':
                                $this->home_prl();
                                break;
                            
                            case 'STAFF':
                                $this->home_pdl();
                                break;
                                
                            default:
                                $this->home_ppk();
                                break;
                        }
                        
	       //// if($result->token)
	       //if($roleName === "Direktur Utama"){
	           
	       //}
	        
	    }else{
	        $this->login();
	    }
	   // print_r($result);die();
// 		echo json_encode($result);
 	}
 	
	public function login()
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
	
	public function home_admin(){
	    $data['title']      = "Home Sistem - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Beranda Direktur Utama";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda";
	    $data['js'] = array(
			'assets/js/lfm/home/index_dirut.js',
			);
// 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Beranda Sistem - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Beranda Direktur Utama",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Login",
				'content'	    => $this->load->view(PLATFORM_PATH.'home/index_dirut',$data,true),
				'js'            =>array(
				    'assets/js/lfm/home/index_dirut.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	}
	public function home_dirut(){
	    $data['title']      = "Home - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Beranda Direktur Utama";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda";
	    $data['js'] = array(
			'assets/js/lfm/home/index_dirut.js',
			);
// 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Beranda - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Beranda Direktur Utama",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda",
				'content'	    => $this->load->view(PLATFORM_PATH.'home/index_dirut',$data,true),
				'js'            =>array(
				    'assets/js/lfm/home/index_dirut.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	}
	
	public function home_direktur(){
	    $data['title']      = "Home Sistem - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Beranda Direktur";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda";
	    $data['js'] = array(
			'assets/js/lfm/home/index_direktur.js',
			);
// 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Login Sistem - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Beranda Landfunding Direktur",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda",
				'content'	    => $this->load->view(PLATFORM_PATH.'home/index_direktur',$data,true),
				'js'            =>array(
				    'assets/js/lfm/home/index_direktur.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	}
	
	public function home_bendahara(){
	    $data['title']      = "Home Sistem - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Beranda Direktur";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda";
	    $data['js'] = array(
			'assets/js/lfm/home/index_direktur.js',
			);
// 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Login Sistem - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Beranda Landfunding Bendahara",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda",
				'content'	    => $this->load->view(PLATFORM_PATH.'home/index_direktur',$data,true),
				'js'            =>array(
				    'assets/js/lfm/home/index_direktur.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	}
	
	public function home_kadiv(){
	    $data['title']      = "Home Sistem - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Beranda Direktur";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda";
	    $data['js'] = array(
			'assets/js/lfm/home/index_direktur.js',
			);
// 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Login Sistem - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Beranda Landfunding KADIV",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda",
				'content'	    => $this->load->view(PLATFORM_PATH.'home/index_direktur',$data,true),
				'js'            =>array(
				    'assets/js/lfm/home/index_direktur.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	}
	
	public function home_prl(){
	    $data['title']      = "Home Sistem - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Beranda Direktur";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda";
	    $data['js'] = array(
			'assets/js/lfm/home/index_direktur.js',
			);
// 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Login Sistem - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Beranda Landfunding PRL",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda",
				'content'	    => $this->load->view(PLATFORM_PATH.'home/index_direktur',$data,true),
				'js'            =>array(
				    'assets/js/lfm/home/index_direktur.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	}
	
	public function home_pdl(){
	    $data['title']      = "Home Sistem - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Beranda PDL";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda";
	    $data['js'] = array(
			'assets/js/lfm/home/index_direktur.js',
			);
// 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Login Sistem - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Beranda Landfunding PDL",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda",
				'content'	    => $this->load->view(PLATFORM_PATH.'home/index_direktur',$data,true),
				'js'            =>array(
				    'assets/js/lfm/home/index_direktur.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	}
	
	public function home_ppk(){
	    $data['title']      = "Betanda - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Beranda PPK";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda";
	    $data['js'] = array(
			'assets/js/lfm/home/index_ppk.js',
			);
// 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Beranda - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Beranda PPK",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda",
				'content'	    => $this->load->view(PLATFORM_PATH.'home/index_ppk',$data,true),
				'js'            =>array(
				    'assets/js/lfm/home/index_ppk.js',
				    )
				);
			// $status	= false;
			
		
		echo json_encode($data);
	}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
	
	public function home_ppk2(){
	    $data['title']      = "Home Sistem - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Beranda";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda";
	    $data['js'] = array(
			'assets/js/lfm/auth/login.js',
			);
// 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Login Sistem - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Dashboaard Landfunding PPK",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Login",
				'content'	    => $this->load->view(PLATFORM_PATH.'auth/index',$data,true),
				'js'            =>array(
				    'assets/js/lfm/auth/login.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	}


    
    public function pembayaran_lahan_psn(){
        $data['menu_text']= "Beranda";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Beranda";
	    $data['js'] = array(
			'assets/js/lfm/auth/login.js',
			);
// 		$this->load->view(PLATFORM_PATH.'auth/index',$data);
		
		$data = array(
		        'status'=>true,
				'title'	=> "Login Sistem - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Login",
				'content'	    => $this->load->view(PLATFORM_PATH.'ppk/pembayaran_lahan_psn',$data,true),
				'js'            =>array(
				    'assets/js/lfm/auth/login.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
    }
































//     public function login()
// 	{
// 	    $postdata=$_POST;
// 	    $result = $this->senddataurl('Auth/login',$postdata,'POST');
// 		echo json_encode($result);
// 	}

















// 	function user_login()
// 	{
// 		$postdata = $_POST;
// 		$sessionCaptcha = $this->mx_encryption->decrypt($this->session->userdata('captchaword'));
// 		$captchaWord	= $postdata['captcha'];

// 		if($this->check_captcha($captchaWord)){
// 			$dataLogin  = $this->senddataurl('vms/Auth/userLogin',$postdata,'POST');
// 			// print_r($dataLogin->data[0] );die();
// 			if($dataLogin->status == true){
// 				//check form registrasi vendor
// 				$idAccount = $dataLogin->data[0]->email;
// 				// $login_session=array(
// 				// 	'login_vms'		=> TRUE,
// 				// 	'id'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->id),
// 				// 	'role'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->role),
// 				// 	'email'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->email)
// 				// );
// 				// $this->session->set_userdata($login_session);
// 				if($dataLogin->data[0]->role_text == "Pegawai"){
// 					$login_session=array(
// 					'login_vms'		=> TRUE,
// 					'id'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->id),
// 					'role'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->role),
// 					'role_text'		=> $this->mx_encryption->encrypt($dataLogin->data[0]->role_text),
// 					'email'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->email)
// 					);
// 					$this->session->set_userdata($login_session);
// 					$dataLogin->data = base_url()."lman-vms";
// 				}elseif($dataLogin->data[0]->role_text == "Penyedia"){
// 					if($dataLogin->message == true)
// 					{
// 						$login_session=array(
// 							'login_vms'		=> TRUE,
// 							'id'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->id),
// 							'role'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->role),
// 							'role_text'		=> $this->mx_encryption->encrypt($dataLogin->data[0]->role_text),
// 							'email'			=> $this->mx_encryption->encrypt($dataLogin->data[0]->email)
// 							);
							
// 						$this->session->set_userdata($login_session);
// 						// print_r($this->session->userdata('id'));die();
// 						$dataLogin->data =base_url()."penyedia";

// 					}else{
// 						$dataLogin->data =base_url()."form-registrasi/".$this->mx_encryption->encrypt($idAccount);;
// 					}
					
// 				}else{
					
// 				}
// 				$dataLogin->message = "Login Berhasil <br> Welcome ,<strong class='text-success'>".$postdata['email']."</strong>";

// 			}
// 			$userLogin = $dataLogin;
// 		}else{
// 			// $userLogin  = $this->senddataurl('vms/Landing/userLogin',$postdata,'POST');
// 			$userLogin = array(
// 				'status'	=> false,
// 				'data'		=> '',
// 				'message'	=> "Kode Captcha Salah");
// 			// $status	= false;
// 		}
// 		echo json_encode($userLogin);
// 	}

}
