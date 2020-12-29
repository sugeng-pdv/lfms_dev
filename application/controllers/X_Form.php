<?php
/*
 * Created on Sat Jun 13 2020 4:40:57 PM
 *
 * Filename Form.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */


class Form extends CI_Controller {

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
		
	}

	function registrasi()
	{
		$data['token'] = $this->uri->segment(2);
		$postdata['id_email'] = $this->mx_encryption->decrypt($data['token']);
		//620a670b7e5924550f6b050041555b0f3801250d38073c1f0034070c385100573f02790b2706
		$checkId  = $this->senddataurl('vms/Form/registrasiCheckEmail',$postdata,'POST');
		if($checkId->status == true){
			$data['tokenid']	= $this->mx_encryption->encrypt($checkId->data[0]->id);
			$data['email']		= $postdata['id_email'];
			$this->load->view(PLATFORM_PATH.'form/registrasi',$data);
		}else{
			$this->load->view(VIEWS_ERROR_PATH.'html/error_404');
		}
	}

	function register_form_data()
	{
		$postdata = $_POST;
		if(isset($postdata['info'])){
			$dataBentukUsaha	= $this->getdataurl('vms/form/getDataBentukUsaha');
			$dataProvinsi 		= $this->getdataurl('vms/form/getDataProvinsi');
			$dataKota			= $this->getdataurl('vms/form/getDataKota');
			$data = array(
				'dataBentukUsaha'	=> $dataBentukUsaha,
				'dataProvinsi' 		=> $dataProvinsi,
				'dataKota' 			=> $dataKota
			);
			$status = true;
		}else{
			$data = "";
			$status = false;
		}
		echo json_encode(array('status'=>$status,'data'=>$data));
	}
	function get_kab_kota()
	{
		$postdata = $_POST;
		if(!empty($postdata['id'])){
			$dataKota			= $this->getdataurl('vms/form/getDataKotaProvinsi/'.$postdata['id']);
			$data = array(
				'dataKota' 			=> $dataKota
			);
			$status = true;
		}else{
			$data = "";
			$status = false;
		}
		echo json_encode(array('status'=>$status,'data'=>$data));
	}
	function save_register_form()
	{
		$postdata=$_POST;
		$data['id_email'] =$this->mx_encryption->decrypt($postdata['token_link']);
		// print_r($data);die();
		$checkId  = $this->senddataurl('vms/Form/registrasiCheckEmail',$data,'POST');
		// print_r($checkId->status);die();
		if($checkId->status == true){
			$saveFormRegistrasi  = $this->senddataurl('vms/Form/saveRegistrasiForm',$postdata,'POST');
			if($saveFormRegistrasi->status == true)
			{
				$dataLogin= $this->senddataurl('vms/Form/userData',$data,'POST');
				$login_session=array(
					'login_vms'		=> TRUE,
					'id'			=> $this->mx_encryption->encrypt($checkId->data[0]->id),
					'role'			=> $this->mx_encryption->encrypt($checkId->data[0]->role),
					'role_text'		=> $this->mx_encryption->encrypt($checkId->data[0]->role_text),
					'email'			=> $this->mx_encryption->encrypt($checkId->data[0]->email)
					);
					$this->session->set_userdata($login_session);
					$saveFormRegistrasi->data = base_url()."penyedia";
			}
			$output =$saveFormRegistrasi;
		}else{
			$output = array(
				'message' => "Gagal Simpan",
				'data' => "",
				'status' => false
			);
		}
		echo json_encode($output);
	}


}
