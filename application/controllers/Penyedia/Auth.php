<?php

/*
 * Created on Thu Jun 18 2020 8:19:24 AM
 *
 * Filename penyedia.php
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
    
    public function common_loader($data,$views)
	 {
		 $this->load->view(PLATFORM_PATH.'cms/general/header', $data);      
		 $this->load->view(PLATFORM_PATH.'cms/general/menu_side', $data);   
		 $this->load->view(PLATFORM_PATH.'cms/general/content_header', $data);   
		 $this->load->view($views, $data);                       
		 $this->load->view(PLATFORM_PATH.'cms/general/footer', $data);              
	}
	public function index2()
	{
		$data['page'] = $this->uri->segment(2);
		// print_r($data['page']);
		$data['header_title'] ="Dashboard";
		$data['title']= "Human Resource Information System";
		$this->common_loader($data,'home/home');
	}

    public function index()
	{
		$datapost['id']					= $this->session->userdata('id');
		$dataIdPerusahaan				= $this->senddataurl('vms/penyedia/getIdPerusahaan',$datapost,'POST');
		// print_r($this->mx_encryption->decrypt($datapost['id']));die();
		$data['id']						= $this->session->userdata('id');
		$data['token']					= (!empty($dataIdPerusahaan[0]->id)) ? $this->mx_encryption->encrypt($dataIdPerusahaan[0]->id) : '';
		$data['token_csrf']				= $this->security->get_csrf_hash();
        $data['page_title']				= "Data Penyedia";
		$data['breadcrumb_item_li']		= "mdi-home-outline";
		$data['breadcrumb_item_page']	= "Penyedia";
		$data['breadcrumb_item_active']		= "Ganti Password";
		$data['title']= "Vendor Manajemen Sistem || LMAN";


		$data['css'] = array(
			// 'cms/vendor_components/datatable/datatables.min.css',
			// 'cms/vendor_components/Magnific-Popup-master/dist/magnific-popup.css'
			);
		//file javascript untuk halaman ini
		$data['js'] = array(
			// 'cms/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js',
			// 'cms/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js',
    		// 'cms/js/pages/validation.js',
			// 'cms/js/pages/form-validation.js',
			// 'cms/vendor_components/bootstrap-select/dist/js/bootstrap-select.js',
			// 'cms/vendor_components/select2/dist/js/select2.full.js',
			// 'cms/vendor_components/datatable/datatables.min.js',
			'js/lman-vms/cms/ganti_password.js',
			);
        $this->common_loader($data,PLATFORM_PATH.'cms/penyedia/ganti-password');
	}

	public function password_update()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataId		= $this->senddataurl('vms/Auth/getDataUser',$postdata,'POST');
			// print_r($dataId);die();
			if($dataId->status == true)
			{
				$status = true;
			}else{
				$status = false;
			}
			$data = $dataId->message;
			
		}else{
			$data = "";
			$status = false;
		}
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));
	}
	

	public function page_not_found()
	{
		$this->load->view(VIEWS_ERROR_PATH.'html/error_404');
	}

	

}
