<?php

/*
 * Created on Thu Jun 18 2020 8:19:24 AM
 *
 * Filename penyedia.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */


class penyedia extends CI_Controller {

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

	protected function getdataurl($url,$method = null){
		if($method == "API"){
			$uri = $this->config->item('api_endpoint').'/'.$url;
		}elseif($method == "VMS"){
			$uri = $this->config->item('static_base_url').'/'.$url;
		}else{
			$uri = $this->config->item('api_endpoint').'/'.$url;
		}
		// print_r($uri);die();
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

 	protected function senddataurl($url,$data,$type,$method = null){
		$time = time();
		if($method == "VMS"){
			$uri = $this->config->item('static_base_url').'/'.$url;
			$postFields = json_encode($data);
		}else{
			$uri = $this->config->item('api_endpoint').'/'.$url;
			$postFields = http_build_query($data);
		}
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
 		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
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
	 protected function senddataurls3($url,$data,$type,$method = null){
		$time = time();
		$uri = $url;
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
		// $ex = curl_exec($ch);
		// $result  = json_decode($ex);
		$ex = curl_exec($ch);
		 $result  = json_encode($ex);
		   echo $result;
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
        $data['page_title']				= "Data Penyedia";
		$data['breadcrumb_item_li']		= "mdi-home-outline";
		$data['breadcrumb_item_page']	= "Penyedia";
		$data['breadcrumb_item_active']		= "Data";
		$data['title']= "Vendor Manajemen Sistem || LMAN";
        $this->common_loader($data,PLATFORM_PATH.'cms/penyedia/dashboard');
		// $this->load->view(PLATFORM_PATH.'cms/penyedia/dashboard2');
	}
	public function profile_penyedia()
	{
		$datapost['id']					= $this->session->userdata('id');
		$dataIdPerusahaan				= $this->senddataurl('vms/penyedia/getIdPerusahaan',$datapost,'POST');
		$data['token']					= (!empty($dataIdPerusahaan[0]->id)) ? $this->mx_encryption->encrypt($dataIdPerusahaan[0]->id) : '';
		$data['token_csrf']				= $this->security->get_csrf_hash();
		$data['page_title']				= "Data Penyedia";
		$data['breadcrumb_item_li']		= "mdi-home-outline";
		$data['breadcrumb_item_page']	= "Penyedia";
		$data['breadcrumb_item_active']	= "Data";
		$data['title']= "Vendor Manajemen Sistem || Data Penyedia";
		//file CSS untuk halaman ini
		$data['css'] = array(
			'cms/vendor_components/datatable/datatables.min.css',
			// <!-- Popup CSS -->
			'cms/vendor_components/Magnific-Popup-master/dist/magnific-popup.css'
			// 'cms/css/
			);
		//file javascript untuk halaman ini
		$data['js'] = array(
			//data input dan validation
			
			'cms/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js',
			'cms/vendor_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js',
    		'cms/js/pages/validation.js',
			'cms/js/pages/form-validation.js',
			'cms/vendor_components/bootstrap-select/dist/js/bootstrap-select.js',
			'cms/vendor_components/select2/dist/js/select2.full.js',
			'cms/vendor_components/datatable/datatables.min.js',
			'js/lman-vms/cms/profile_penyedia.js',
			// 'js/lman-vms/cms/upload_file_penyedia.js', // brana
			);
		// print_r(strtolower("CDO@ksndjJJJJsjsbf.com"));die();
        $this->common_loader($data,PLATFORM_PATH.'cms/penyedia/data_profile');
	}
	public function identitas_perusahaan()
	{
		$postdata = $_POST;
		// print_r($this->security->get_csrf_token_name()."--".$this->security->get_csrf_hash());die();
		if(isset($postdata['token'])){
			$dataIdentitas		= $this->senddataurl('vms/penyedia/getIdentitasPerusahaan',$postdata,'POST');
			// print_r($dataIdentitas);die();
			$dataProvinsi 		= $this->getdataurl('vms/form/getDataProvinsi','API');
			$dataKota			= $this->getdataurl('vms/form/getDataKotaProvinsi/'.$dataIdentitas->data->id_provinsi,'API');
			$data = array(
				'dataIdentitas'		=> $dataIdentitas->data,
				'dataProvinsi' 		=> $dataProvinsi,
				'dataKota' 			=> $dataKota,
				'elapsed_time'		=> $dataIdentitas->elapsed_time
			);
			$status = true;
		}else{
			$data = "";
			$status = false;
		}
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));
	}
	function update_id_perusahaan()
	{
		$postdata = $_POST;
		// print_r($this->mx_encryption->decrypt($postdata['token']));die();
		if(isset($postdata['token'])){
			$dataIdentitas		= $this->senddataurl('vms/penyedia/updateIdentitasPerusahaan',$postdata,'POST');
			
			$data = array(
				'dataIdentitas'		=> $dataIdentitas->data,
				'elapsed_time'		=> $dataIdentitas->elapsed_time
			);
			$status = true;
		}else{
			$data = "";
			$status = false;
		}
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));

	}

	function izin_usaha_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataIdentitas		= $this->senddataurl('vms/penyedia/getIzinUsahaPerusahaan',$postdata,'POST');
			// print_r($dataIdentitas->data);die();
			
			$data = array(
				'data' => array()
			);
			$num = 1;
			foreach ($dataIdentitas->data as $key => $value) {
				$data['data'][$key] = $value;
				$status_terverivikasi = $value->terverifikasi;
				if($status_terverivikasi == 1){
					$status		='<span class="text-success">Sudah</span>';
					$disable	='disabled';
				}else{
					$status		='-';
					$disable	='';
				}
				$enc_id = $this->mx_encryption->encrypt($value->id);

				$data['data'][$key]->num = $num;
				$data['data'][$key]->id	= $enc_id;
				$data['data'][$key]->terverifikasi	= $status;
				$data['data'][$key]->action='<button href="javascript:;" class="btn btn-circle btn-lman btn-sm mb-5" onclick="edit_izin_usaha('."'$enc_id'".')" '.$disable.'><i class="mdi mdi-tooltip-edit"></i>Edit</button>';
				$num++;
			}
			// print_r($data);die();

			$status = true;
		}else{
			$data = "";
			$status = false;
		}

		// echo json_encode($data);
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));
	}
	function izin_usaha_perusahaan_edit()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataIdentitas		= $this->senddataurl('vms/penyedia/getIzinUsahaPerusahaanEdit',$postdata,'POST');
			$data = array(
				'data' => array()
			);
			$num = 1;
			foreach ($dataIdentitas->data as $key => $value) {
				$data['data'][$key] = $value;
				$status_terverivikasi = $value->terverifikasi;
				if($status_terverivikasi == 1){
					$status		='<span class="text-success">Sudah</span>';
					$disable	='disabled';
				}else{
					$status		='-';
					$disable	='';
				}
				$enc_id = $this->mx_encryption->encrypt($value->id);

				$data['data'][$key]->num = $num;
				$data['data'][$key]->id	= $enc_id;
				$data['data'][$key]->terverifikasi	= $status;
				$data['data'][$key]->action='<button href="javascript:;" class="btn btn-circle btn-lman btn-sm mb-5" onclick="edit_izin_usaha('."'$enc_id'".')" '.$disable.'><i class="mdi mdi-tooltip-edit"></i>Edit</button>';
				$num++;
			}
			// print_r($data);die();

			$status = true;
		}else{
			$data = "";
			$status = false;
		}

		// echo json_encode($data);
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));
	}

	function jenis_dokumen_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataJnsDokumen		= $this->senddataurl('vms/penyedia/getSelectIzinUsahaPerusahaan',$postdata,'POST');
			// $dataKualifikasi		= $this->senddataurl('vms/penyedia/getKualifikasiPerusahaan',$postdata,'POST');
			// print_r($dataJnsDokumen->dataJnsDok);die();
			
			$data = array(
				'dataJnsDokumen'	=> $dataJnsDokumen->dataJnsDok,
				'dataKualifikasi'	=> $dataJnsDokumen->dataKualifikasi,
				'elapsed_time'		=> $dataJnsDokumen->elapsed_time
			);
			$status = true;
		}else{
			$data = "";
			$status = false;
		}
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));
	}
	function simpan_izin_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataIdentitas		= $this->senddataurl('vms/penyedia/simpanIzinPerusahaan',$postdata,'POST');
			
			$data = array(
				'dataIdentitas'		=> $dataIdentitas->data,
				'elapsed_time'		=> $dataIdentitas->elapsed_time
			);
			$status = true;
		}else{
			$data = "";
			$status = false;
		}
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));	
	}
	//pemilik perusahaan

	function pemilik_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataArray		= $this->senddataurl('vms/penyedia/getPemilikPerusahaan',$postdata,'POST');
			// print_r($dataArray);die();
			$data = array(
				'data' => array()
			);
			$num = 1;
			foreach ($dataArray->data as $key => $value) {
				$data['data'][$key] = $value;
				$enc_id = $this->mx_encryption->encrypt($value->id);
				$status_terverivikasi = $value->terverifikasi;
				if($status_terverivikasi == 1){
					$status		='<span class="text-success">Sudah</span>';
					$disable	='disabled';
				}else{
					$status		='-';
					$disable	='';
				}
				$data['data'][$key]->num = $num;
				$data['data'][$key]->id	= $enc_id;
				// $data['data'][$key]->saham	= $value->saham." ".$value->satuan_saham;
				$data['data'][$key]->terverifikasi	= $status;
				$data['data'][$key]->action='<button href="javascript:;" class="btn btn-circle btn-lman btn-sm mb-5" onclick="edit_pemilik_usaha('."'$enc_id'".')" '.$disable.'><i class="mdi mdi-tooltip-edit"></i>Edit</button>';
				$num++;
			}
			// print_r($data);die();

			$status = true;
		}else{
			$data = "";
			$status = false;
		}

		// echo json_encode($data);
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));
	}
	//simpan_pemilik_perusahaan
	function simpan_pemilik_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataIdentitas			= $this->senddataurl('vms/penyedia/simpanPemilikPerusahaan',$postdata,'POST');
			
			$data = array(
				'data'				=> $dataIdentitas->data,
				'elapsed_time'		=> $dataIdentitas->elapsed_time
			);
			$status = true;
		}else{
			$data = "";
			$status = false;
		}
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));	
	}

	//pengurusperusahaan
	function pengurus_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataArray		= $this->senddataurl('vms/penyedia/getPengurusPerusahaan',$postdata,'POST');
			// print_r($dataArray);die();
			$data = array(
				'data' => array()
			);
			$num = 1;
			foreach ($dataArray->data as $key => $value) {
				$data['data'][$key] = $value;
				$enc_id = $this->mx_encryption->encrypt($value->id);
				$status_terverivikasi = $value->terverifikasi;
				if($status_terverivikasi == 1){
					$status		='<span class="text-success">Sudah</span>';
					$disable	='disabled';
				}else{
					$status		='-';
					$disable	='';
				}
				$data['data'][$key]->num = $num;
				$data['data'][$key]->id	= $enc_id;
				// $data['data'][$key]->saham	= $value->saham." ".$value->satuan_saham;
				$data['data'][$key]->terverifikasi	= $status;
				$data['data'][$key]->action='<button href="javascript:;" class="btn btn-circle btn-lman btn-sm mb-5" onclick="edit_pengurus_usaha('."'$enc_id'".')" '.$disable.'><i class="mdi mdi-tooltip-edit"></i>Edit</button>';
				$num++;
			}
			// print_r($data);die();

			$status = true;
		}else{
			$data = "";
			$status = false;
		}

		// echo json_encode($data);
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));
	}
	//simpan_pengurus_perusahaan
	function simpan_pengurus_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataIdentitas			= $this->senddataurl('vms/penyedia/simpanPengurusPerusahaan',$postdata,'POST');
			
			$data = array(
				'data'				=> $dataIdentitas->data,
				'elapsed_time'		=> $dataIdentitas->elapsed_time
			);
			$status = true;
		}else{
			$data = "";
			$status = false;
		}
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));	
	}

	// tenagaahli-perusahaan
	function tenagaahli_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataArray		= $this->senddataurl('vms/penyedia/getTenagaAhliPerusahaan',$postdata,'POST');
			// print_r($dataArray);die();
			$data = array(
				'data' => array()
			);
			$num = 1;
			foreach ($dataArray->data as $key => $value) {
				$data['data'][$key] = $value;
				$enc_id = $this->mx_encryption->encrypt($value->id);
				$status_terverivikasi = $value->terverifikasi;
				if($status_terverivikasi == 1){
					$status		='<span class="text-success">Sudah</span>';
					$disable	='disabled';
				}else{
					$status		='-';
					$disable	='';
				}
				$data['data'][$key]->num = $num;
				$data['data'][$key]->id	= $enc_id;
				// $data['data'][$key]->saham	= $value->saham." ".$value->satuan_saham;
				$data['data'][$key]->terverifikasi	= $status;
				$data['data'][$key]->action='<button href="javascript:;" class="btn btn-circle btn-lman btn-sm mb-5" onclick="edit_tenagaahli_usaha('."'$enc_id'".')" '.$disable.'><i class="mdi mdi-tooltip-edit"></i>Edit</button>';
				$num++;
			}
			// print_r($data);die();

			$status = true;
		}else{
			$data = "";
			$status = false;
		}

		// echo json_encode($data);
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));
	}
	//simpan_pengurus_perusahaan
	function simpan_tenagaahli_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataIdentitas			= $this->senddataurl('vms/penyedia/simpanTenagaAhliPerusahaan',$postdata,'POST');
			
			$data = array(
				'data'				=> $dataIdentitas->data,
				'elapsed_time'		=> $dataIdentitas->elapsed_time
			);
			$status = true;
		}else{
			$data = "";
			$status = false;
		}
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));	
	}

	// peralatan-perusahaan
	function peralatan_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataArray		= $this->senddataurl('vms/penyedia/getPeralatanPerusahaan',$postdata,'POST');
			// print_r($dataArray);die();
			$data = array(
				'data' => array()
			);
			$num = 1;
			foreach ($dataArray->data as $key => $value) {
				$data['data'][$key] = $value;
				$enc_id = $this->mx_encryption->encrypt($value->id);
				$status_terverivikasi = $value->terverifikasi;
				if($status_terverivikasi == 1){
					$status		='<span class="text-success">Sudah</span>';
					$disable	='disabled';
				}else{
					$status		='-';
					$disable	='';
				}
				$data['data'][$key]->num = $num;
				$data['data'][$key]->id	= $enc_id;
				// $data['data'][$key]->saham	= $value->saham." ".$value->satuan_saham;
				$data['data'][$key]->terverifikasi	= $status;
				$data['data'][$key]->action='<button href="javascript:;" class="btn btn-circle btn-lman btn-sm mb-5" onclick="edit_peralatan_usaha('."'$enc_id'".')" '.$disable.'><i class="mdi mdi-tooltip-edit"></i>Edit</button>';
				$num++;
			}
			// print_r($data);die();

			$status = true;
		}else{
			$data = "";
			$status = false;
		}

		// echo json_encode($data);
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));
	}
	//simpan_peralatanperusahaan
	function simpan_peralatan_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataIdentitas			= $this->senddataurl('vms/penyedia/simpanPeralatanPerusahaan',$postdata,'POST');
			
			$data = array(
				'data'				=> $dataIdentitas->data,
				'elapsed_time'		=> $dataIdentitas->elapsed_time
			);
			$status = true;
		}else{
			$data = "";
			$status = false;
		}
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));	
	}

	// pengalaman-perusahaan
	function pengalaman_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataArray		= $this->senddataurl('vms/penyedia/getPengalamanPerusahaan',$postdata,'POST');
			// print_r($dataArray);die();
			$data = array(
				'data' => array()
			);
			$num = 1;
			foreach ($dataArray->data as $key => $value) {
				$data['data'][$key] = $value;
				$enc_id = $this->mx_encryption->encrypt($value->id);
				$status_terverivikasi = $value->terverifikasi;
				if($status_terverivikasi == 1){
					$status		='<span class="text-success">Sudah</span>';
					$disable	='disabled';
				}else{
					$status		='-';
					$disable	='';
				}
				$data['data'][$key]->num = $num;
				$data['data'][$key]->id	= $enc_id;
				// $data['data'][$key]->saham	= $value->saham." ".$value->satuan_saham;
				$data['data'][$key]->terverifikasi	= $status;
				$data['data'][$key]->action='<button href="javascript:;" class="btn btn-circle btn-lman btn-sm mb-5" onclick="edit_pengalaman_usaha('."'$enc_id'".')" '.$disable.'><i class="mdi mdi-tooltip-edit"></i>Edit</button>';
				$num++;
			}
			// print_r($data);die();

			$status = true;
		}else{
			$data = "";
			$status = false;
		}

		// echo json_encode($data);
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));
	}
	//simpan_pengalamanperusahaan
	function simpan_pengalaman_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataArray			= $this->senddataurl('vms/penyedia/simpanPengalamanPerusahaan',$postdata,'POST');
			
			$data = array(
				'data'				=> $dataArray->data,
				'elapsed_time'		=> $dataArray->elapsed_time
			);
			$status = true;
		}else{
			$data = "";
			$status = false;
		}
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));	
	}
	function jenis_klasifikasi_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataArray		= $this->senddataurl('vms/penyedia/getSelectKlasifikasiPerusahaan',$postdata,'POST');
			
			$data = array(
				'dataJnsKlasifikasi'	=> $dataArray->dataJnsKlasifikasi,
				'elapsed_time'			=> $dataArray->elapsed_time
			);
			$status = true;
		}else{
			$data = "";
			$status = false;
		}
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));
	}

	// pajak-perusahaan
	function pajak_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataArray		= $this->senddataurl('vms/penyedia/getPajakPerusahaan',$postdata,'POST');
			// print_r($dataArray);die();
			$data = array(
				'data' => array()
			);
			$num = 1;
			foreach ($dataArray->data as $key => $value) {
				$data['data'][$key] = $value;
				$enc_id = $this->mx_encryption->encrypt($value->id);
				$status_terverivikasi = $value->terverifikasi;
				if($status_terverivikasi == 1){
					$status		='<span class="text-success">Sudah</span>';
					$disable	='disabled';
				}else{
					$status		='-';
					$disable	='';
				}
				$data['data'][$key]->num = $num;
				$data['data'][$key]->id	= $enc_id;
				// $data['data'][$key]->saham	= $value->saham." ".$value->satuan_saham;
				$data['data'][$key]->terverifikasi	= $status;
				$data['data'][$key]->action='<button href="javascript:;" class="btn btn-circle btn-lman btn-sm mb-5" onclick="edit_pajak_usaha('."'$enc_id'".')" '.$disable.'><i class="mdi mdi-tooltip-edit"></i>Edit</button>';
				$num++;
			}
			// print_r($data);die();

			$status = true;
		}else{
			$data = "";
			$status = false;
		}

		// echo json_encode($data);
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));
	}
	//simpan_pajak_perusahaan
	function simpan_pajak_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataArray			= $this->senddataurl('vms/penyedia/simpanPajakPerusahaan',$postdata,'POST');
			
			$data = array(
				'data'				=> $dataArray->data,
				'elapsed_time'		=> $dataArray->elapsed_time
			);
			$status = true;
		}else{
			$data = "";
			$status = false;
		}
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));	
	}

	// buat nangkep data s3_object dan disimpan ke DB
    function simpan_fotokantor_perusahaan()
    {
        // konversi JSON ke POST 
        $_POST = json_decode(file_get_contents("php://input"), true);

		// WARNING: kasih script untuk cek login dan get id perusahaannya //

		$valid_login = true; // DUMMY
		
        if ( $valid_login === true ){
            
                // start form validations
				$this->load->library('form_validation');
                $this->form_validation->set_rules('s3_bucket', 's3_bucket', 'required');
				$this->form_validation->set_rules('s3_object', 's3_object', 'required');
				$this->form_validation->set_rules('keterangan', 'keterangan', 'required');
                $this->form_validation->set_error_delimiters("", "\r\n");
                
                // if validations returns FALSE statement
                if ($this->form_validation->run() == FALSE) {
                    $result = array(
                        'status' => 'error',
                        'message' => validation_errors()
                    );
                } else {
					
					$s3_bucket = $this->input->post('s3_bucket');
					$s3_object = $this->input->post('s3_object');
					$keterangan = $this->input->post('keterangan');

					// NOTE: simpan data s3_bucket dan s3_object tersebut ke database sesuai id perusahaannya, kemudian jika berhasil disimpan resultnya spt ini: //
					$result = array(
						'status' => 'success',
						'message' => null
					);
				}
                
    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
        
	} // akhir - simpan_fotokantor_perusahaan()

	function upload_fotokantor_perusahaan()
	{
		$getS3Url 		= $this->getdataurl('file-s3/get-s3-upload-url','VMS');
		if($getS3Url->status == "success"){
			$s3UploadUrl = $getS3Url->url;
			// axios.post( 'https://procurement.asetnegara.id/file-s3/get-s3-upload-auth/IMAGE/public', JSON.stringify({ file_name: vuePenyedia.file.name }), options )
			$postdata['file_name'] = 'xxx.png';
			$respUploadAuth			= $this->senddataurl('file-s3/get-s3-upload-auth/IMAGE/public',$postdata,'POST','VMS');


			$file_name = $_FILES['file']['name'];
			$size = $_FILES['file']['size'];
			$tmp = $_FILES['file']['tmp_name'];
			$ext = $this->getExtension($file_name);
			$actual_image_name = time().".".$ext;
			print_r($_FILES['file']);die();
			// menentukan header file type
			
			// }

			// $random_prefix = random_string('alnum',3);
			// $new_filename = ((!empty($folder)) ? $folder.'/':null).date("Y").'/'.date("m").'/'.date("d").'/'.$random_prefix.'-'.$file_name;
			// print_r($new_filename);die();
			// $requestHeaders = array(
			//     //'Content-Type' => 'binary/octet-stream',
			//     'Content-Disposition' => 'attachment; filename='.$random_prefix.'-'.$file_name
			// );

			// end-get input


			// stdClass Object ( [status] => success [message] => [bucket] => vms [key] => IMAGE/2020/08/12/3GA-xxx.png [data] => stdClass Object ( [AWSAccessKeyId] => LMAN839Q5CTHX83TFAC7 [key] => IMAGE/2020/08/12/3GA-xxx.png [acl] => public [policy] => eyJleHBpcmF0aW9uIjoiMjAyMC0wOC0xMlQxMDowNDo1MloiLCJjb25kaXRpb25zIjpbeyJidWNrZXQiOiJ2bXMifSx7ImFjbCI6InB1YmxpYyJ9LHsic3VjY2Vzc19hY3Rpb25fc3RhdHVzIjoiMjAxIn0sWyJzdGFydHMtd2l0aCIsIiRrZXkiLCJJTUFHRS8yMDIwLzA4LzEyLzNHQS14eHgucG5nIl0sWyJzdGFydHMtd2l0aCIsIiRDb250ZW50LURpc3Bvc2l0aW9uIiwiIl0seyJjb250ZW50X3R5cGVfc3RhcnRzX3dpdGgiOiJpbWFnZS9qcGcifSx7InN0YXJ0cy13aXRoIjoiaW1hZ2UvanBnIn0sWyJjb250ZW50LWxlbmd0aC1yYW5nZSIsMCwxMDQ4NTc2MDBdXX0= [signature] => MXY1X9VuhkBzNtGF3PODEdewVuA= [success_action_status] => 201 [Content-Disposition] => attachment; filename=3GA-xxx.png [content_type_starts_with] => image/jpg [starts-with] => image/jpg ) )
			$sendata['file'] = $_FILES['file'];// (binary)
			$sendata['AWSAccessKeyId'] = $respUploadAuth->AWSAccessKeyId;// LMAN839Q5CTHX83TFAC7
			$sendata['key'] = $respUploadAuth->key;// IMAGE/2020/08/12/GIe-screen-shot-2020-08-11-at-08.42.50.png
			$sendata['acl'] = $respUploadAuth->acl;// public
			$sendata['policy'] = $respUploadAuth->policy;// eyJleHBpcmF0aW9uIjoiMjAyMC0wOC0xMlQxMDowMjowN1oiLCJjb25kaXRpb25zIjpbeyJidWNrZXQiOiJ2bXMifSx7ImFjbCI6InB1YmxpYyJ9LHsic3VjY2Vzc19hY3Rpb25fc3RhdHVzIjoiMjAxIn0sWyJzdGFydHMtd2l0aCIsIiRrZXkiLCJJTUFHRS8yMDIwLzA4LzEyL0dJZS1zY3JlZW4tc2hvdC0yMDIwLTA4LTExLWF0LTA4LjQyLjUwLnBuZyJdLFsic3RhcnRzLXdpdGgiLCIkQ29udGVudC1EaXNwb3NpdGlvbiIsIiJdLHsiY29udGVudF90eXBlX3N0YXJ0c193aXRoIjoiaW1hZ2UvanBnIn0seyJzdGFydHMtd2l0aCI6ImltYWdlL2pwZyJ9LFsiY29udGVudC1sZW5ndGgtcmFuZ2UiLDAsMTA0ODU3NjAwXV19
			$sendata['signature'] = $respUploadAuth->signature;// HAXG203yBlmp95CKDqv71VPvW1Q=
			$sendata['success_action_status'] = $respUploadAuth->success_action_status;// 201
			$sendata['Content-Disposition'] = $respUploadAuth->Content;// attachment; filename=GIe-screen-shot-2020-08-11-at-08.42.50.png
			$sendata['content_type_starts_with'] = $respUploadAuth->content_type_starts_with;// image/jpg
			$sendata['starts-with'] = $respUploadAuth->starts;// image/jpg\
			$respUpload		= $this->senddataurls3($s3UploadUrl,$sendata,'POST');
			print_r($respUpload);die();

			// $respUploadAuth			= $this->senddataurls3($s3UploadUrl,$postdata,'POST');
			// file-s3/get-s3-upload-auth/IMAGE/public
		}else{
			$result = array(
		        'status' => 'error',
		        'message' => 'Gagal mendapatkan url server s3.'
		    );
			$status = false;
		}

		// 'https://procurement.asetnegara.id/file-s3/get-s3-upload-url'
		// base_url()

		if (!empty($s3params)) {
		    foreach ($s3params as $name => $value) {
		        $data[$name] = $value;
		    }

		    $result = array(
		        'status' => 'success',
		        'message' => '',
		        'bucket' => $this->config->item('s3_bucket_name'),
		        'key' => $new_filename,
		        'data' => $data
			);
			$status = true;

		} else {
		    // create result
		    $result = array(
		        'status' => 'error',
		        'message' => 'Gagal meminta data otentikasi ke server S3 (file storage).'
		    );
			$status = false;
		}

		// json result
		echo json_encode(array('status'=>$status,'data'=>$result,'token_csrf'=> $this->security->get_csrf_hash()));
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
	// //upload foto-workshop kantor
	// function upload_fotokantor_perusahaan($folder = null, $access_type = 'private')
	// {
	// 	$access_type = ( $access_type == 'public' ? 'public' : 'private' );
  
	// 	$this->load->config('s3');
	// 	$this->load->library('s3');
	// 	/// !!!!! PENDING FORM VALIDATION
	// 	$_POST = json_decode(file_get_contents("php://input"), true);
	// 	// $file_name = strtolower(str_replace(" ", "-", $this->input->post('file_name',true)));
	// 	// print_r($folder."-".$access_type."-".$this->config->item('s3_bucket_name')."----".$file_name."****".$_POST);die();
	// 	// $file_name    =  'Hand Soap (Foamy Hand Soap)_PNG.png';
	// 	$file_name = $_FILES['file']['name'];
	// 	$size = $_FILES['file']['size'];
	// 	$tmp = $_FILES['file']['tmp_name'];
	// 	$ext = $this->getExtension($file_name);
	// 	$actual_image_name = time().".".$ext;
	// 	// if($this->s3->putObjectFile($tmp, 'file' , $actual_image_name, S3::ACL_PUBLIC_READ) )
	// 	// {
	// 	// 	$msg = "S3 Upload Successful.";
	// 	// 	$s3file='https://file.asetnegara.id/vms/'.$actual_image_name;
	// 	// 	echo "<img src='$s3file'/>";
	// 	// 	echo 'S3 File URL:'.$s3file;
	// 	// }
	// 	// else
	// 	// {
	// 	// 	$msg = "S3 Upload Fail.";
	// 	// }
	// 	print_r($msg);die();
	// 	// menentukan header file type
	// 	switch ($folder){
	// 	case 'FOTO' :
	// 	    $amzHeaders = array(
	// 	        'content_type_starts_with' => 'image/jpg',
	// 	        'starts-with' => 'image/jpg'
	// 	    );
	// 	break;
	// 	default :
	// 			$amzHeaders = array();
	// 			// $amzHeaders = array(
	// 	        // 'content_type_starts_with' => 'image/jpg',
	// 	        // 'starts-with' => 'image/jpg'
	// 	    // );
	// 	}

	// 	$random_prefix = random_string('alnum',3);
	// 	$new_filename = ((!empty($folder)) ? $folder.'/':null).date("Y").'/'.date("m").'/'.date("d").'/'.$random_prefix.'-'.$file_name;
	// 	print_r($new_filename);die();
	// 	$requestHeaders = array(
	// 	    //'Content-Type' => 'binary/octet-stream',
	// 	    'Content-Disposition' => 'attachment; filename='.$random_prefix.'-'.$file_name
	// 	);

	// 	$mb = 1048576;
	// 	$file_size_limit = 100 * $mb;
	// 	// s3-d7c
	// 	$s3params = $this->s3->getHttpUploadPostParams($this->config->item('s3_bucket_name'), $new_filename, $access_type, 3600, $file_size_limit, '201', $amzHeaders, $requestHeaders);
	// 	// $s3params = $this->s3->getHttpUploadPostParams($this->config->item('s3_bucket_name'), $new_filename, $access_type, 3600, $file_size_limit, '201', $amzHeaders, $requestHeaders);

	// 	if (!empty($s3params)) {
	// 	    foreach ($s3params as $name => $value) {
	// 	        $data[$name] = $value;
	// 	    }

	// 	    $result = array(
	// 	        'status' => 'success',
	// 	        'message' => '',
	// 	        'bucket' => $this->config->item('s3_bucket_name'),
	// 	        'key' => $new_filename,
	// 	        'data' => $data
	// 		);
	// 		$status = true;

	// 	} else {
	// 	    // create result
	// 	    $result = array(
	// 	        'status' => 'error',
	// 	        'message' => 'Gagal meminta data otentikasi ke server S3 (file storage).'
	// 	    );
	// 		$status = false;
	// 	}

	// 	// json result
	// 	echo json_encode(array('status'=>$status,'data'=>$result,'token_csrf'=> $this->security->get_csrf_hash()));
    //     // $this->output->set_content_type('application/json')->set_output(json_encode($result));
	// }
	function getExtension($str)
	{
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}

	function file_upload_to_s3_old(){
 
	    $this->load->library('S3'); //load S3 library
	    $this->load->model('Common_mdl'); //load model
 
	    $upload_folder   = 'vms';  //folder name
		// $fileTempName    =  '/var/www/html/fileuploadproject/uploads/email_logo.png'; //local image path (who we have to upload on s3)
		// <?php echo $this->config->item('static_file_url').PLATFORM_PATH;
		// $fileTempName    =  $this->config->item('static_file_url').PLATFORM_PATH.'img/logo/lman-logo-52.png';
		$fileTempName    =  $_SERVER['DOCUMENT_ROOT'].'/lman-vms_prod/static/web/img/logo/lman-logo-52.png';
		// https://procurement.asetnegara.id/static/web/img/logo/lman-logo-52.png
		// C:/xampp/htdocs/web/lman-vms_prod/static/img/logo/lman-logo-52.png
		// print_r($_SERVER['DOCUMENT_ROOT'].'/lman-vms_prod/web/static/img/logo/lman-logo-52.png');die();
        $image_name      =  'email_logo.png'; //image name
        $bucket_name     =  'Upload'; //Bucket name
        $awsstatus       =  $this->Common_mdl->amazons3Upload($image_name, $fileTempName, $upload_folder); //call model function
        $awss3filepath   =  "http://".$bucket_name.'.'."s3.amazonaws.com/".$upload_folder.'/'.$image_name;
	 }
	//  public function get_s3_upload_auth($folder = null, $access_type = 'private') {
	 public function file_upload_to_s3($folder = null, $access_type = 'private') {
        
        $access_type = ( $access_type == 'public' ? 'public' : 'private' );
  
		$this->load->config('s3');
		$this->load->library('s3');
			// print_r($folder."-".$access_type."-".$this->config->item('s3_bucket_name'));die();
		/// !!!!! PENDING FORM VALIDATION
		$_POST = json_decode(file_get_contents("php://input"), true);
			// $file_name = strtolower(str_replace(" ", "-", $this->input->post('file_name',true)));
			$file_name    =  $_SERVER['DOCUMENT_ROOT'].'/lman-vms_prod/static/web/img/logo/lman-logo-52.png';
			

		// menentukan header file type
		switch ($folder){
		case 'FOTO' :
		    $amzHeaders = array(
		        'content_type_starts_with' => 'image/jpg',
		        'starts-with' => 'image/jpg'
		    );
		break;
		default :
				// $amzHeaders = array();
				$amzHeaders = array(
		        'content_type_starts_with' => 'image/jpg',
		        'starts-with' => 'image/jpg'
		    );
		}

		$random_prefix = random_string('alnum',3);
		$new_filename = ((!empty($folder)) ? $folder.'/':null).date("Y").'/'.date("m").'/'.date("d").'/'.$random_prefix.'-'.$file_name;
		print_r($new_filename);die();
		$requestHeaders = array(
		    //'Content-Type' => 'binary/octet-stream',
		    'Content-Disposition' => 'attachment; filename='.$random_prefix.'-'.$file_name
		);

		$mb = 1048576;
		$file_size_limit = 100 * $mb;

		$s3params = $this->s3->getHttpUploadPostParams($this->config->item('s3_bucket_name'), $new_filename, $access_type, 3600, $file_size_limit, '201', $amzHeaders, $requestHeaders);

		if (!empty($s3params)) {
		    foreach ($s3params as $name => $value) {
		        $data[$name] = $value;
		    }

		    $result = array(
		        'status' => 'success',
		        'message' => '',
		        'bucket' => $this->config->item('s3_bucket_name'),
		        'key' => $new_filename,
		        'data' => $data
		    );

		} else {
		    // create result
		    $result = array(
		        'status' => 'error',
		        'message' => 'Gagal meminta data otentikasi ke server S3 (file storage).'
		    );
		}

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));

    } // akhir - get_s3_upload_auth

	// sertifikat-perusahaan
	function sertifikat_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataArray		= $this->senddataurl('vms/penyedia/getSertifikatPerusahaan',$postdata,'POST');
			// print_r($dataArray);die();
			$data = array(
				'data' => array()
			);
			$num = 1;
			foreach ($dataArray->data as $key => $value) {
				$data['data'][$key] = $value;
				$enc_id = $this->mx_encryption->encrypt($value->id);
				$status_terverivikasi = $value->terverifikasi;
				if($status_terverivikasi == 1){
					$status		='<span class="text-success">Sudah</span>';
					$disable	='disabled';
				}else{
					$status		='-';
					$disable	='';
				}
				$data['data'][$key]->num = $num;
				$data['data'][$key]->id	= $enc_id;
				// $data['data'][$key]->saham	= $value->saham." ".$value->satuan_saham;
				$data['data'][$key]->terverifikasi	= $status;
				$data['data'][$key]->action='<button href="javascript:;" class="btn btn-circle btn-lman btn-sm mb-5" onclick="edit_sertifikasi_usaha('."'$enc_id'".')" '.$disable.'><i class="mdi mdi-tooltip-edit"></i>Edit</button>';
				$num++;
			}
			// print_r($data);die();

			$status = true;
		}else{
			$data = "";
			$status = false;
		}

		// echo json_encode($data);
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));
	}
	//simpan_pengalamanperusahaan
	function simpan_sertifikat_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataArray			= $this->senddataurl('vms/penyedia/simpanSertifikasiPerusahaan',$postdata,'POST');
			
			$data = array(
				'data'				=> $dataArray->data,
				'elapsed_time'		=> $dataArray->elapsed_time
			);
			$status = true;
		}else{
			$data = "";
			$status = false;
		}
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));	
	}
	function jenis_kualifikasi_klasifikasi_perusahaan()
	{
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataArray		= $this->senddataurl('vms/penyedia/getSelectKualifikasiPerusahaan',$postdata,'POST');
			$dataArray2		= $this->senddataurl('vms/penyedia/getSelectKlasifikasiPerusahaan',$postdata,'POST');
			
			$data = array(
				'dataJnsKualifikasi'	=> $dataArray->dataJnsKualifikasi,
				'dataJnsKlasifikasi'	=> $dataArray2->dataJnsKlasifikasi,
				'elapsed_time'			=> $dataArray->elapsed_time
			);
			$status = true;
		}else{
			$data = "";
			$status = false;
		}
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));
	}
	function jenis_sub_kualifikasi_perusahaan()
    {
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataArray		= $this->senddataurl('vms/penyedia/getSelectSubKualifikasiPerusahaan',$postdata,'POST');
			// print_r($dataArray);die();
			$data = array(
				'dataJnsSubKualifikasi'	=> $dataArray->dataJnsKualifikasi,
				'elapsed_time'			=> $dataArray->elapsed_time
			);
			$status = true;
		}else{
			$data = "";
			$status = false;
		}
		echo json_encode(array('status'=>$status,'data'=>$data,'token_csrf'=> $this->security->get_csrf_hash()));
    }
    function jenis_sub_klasifikasi_perusahaan()
    {
		$postdata = $_POST;
		if(isset($postdata['token'])){
			$dataArray2		= $this->senddataurl('vms/penyedia/getSelectSubKlasifikasiPerusahaan',$postdata,'POST');
			
			$data = array(
				'dataJnsSubKlasifikasi'	=> $dataArray2->dataJnsKlasifikasi,
				'elapsed_time'			=> $dataArray2->elapsed_time
			);
			$status = true;
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
