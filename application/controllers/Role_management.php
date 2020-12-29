<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_management extends CI_Controller {
    
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
//  		die($uri);
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
	   
		$data['title']      = "Role management - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Role Management";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Role Management";
	    $data['js'] = array(
			'assets/js/lfm/role_management/index.js',
			);
// 		$this->template->display($data,PLATFORM_PATH.'role_management/index');
		$data = array(
		        'status'=>true,
				'title'	=> "Role management - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Role Management",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Role Management",
				'content'	    => $this->load->view(PLATFORM_PATH.'role_management/index',$data,true),
				'js'            =>array(
				    'assets/js/lfm/role_management/login.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	}
	
	public function data_role()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('role/role_data',$postdata,'POST');
		if(isset($result)){
			$data = array(
				'data' => array()
			);
			foreach ($result as $key => $value) {
				$data['data'][$key] = $value; 

				// $enc_no_st = $this->mx_encryption->encrypt($value->id);
				// print_r($enc_no_st);die();

				$data['data'][$key]->action = '<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details" onclick="edit_role('."'$value->id'".')">
								<i class="la la-edit"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" onclick="delete_role('."'$value->id'".')"><i class="la la-trash"></i></a>';
				// $data['data'][$key]->role ='';
				// $data['data'][$key]->pengguna ='';
				$data['data'][$key]->role ='<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">'.ucwords(strtolower($value->name)).'</a><span class="text-muted font-weight-bold text-muted d-block">'.$value->description.'</span>';
				$data['data'][$key]->pengguna = '<span class="text-dark-75 font-weight-bolder d-block font-size-lg">16 Pengguna</span><span class="text-muted font-weight-bold">Paijo, Tejo dan 14 lainnya</span>';
			
			}
		}
		else{
			$data = array(
				'data' => array(
					'role'	=> "",
					'pengguna' 	=>"",
					'action'		=>""
				)
			);
		}
		echo json_encode($data);
	}
	function delete_role()
	{
	    $postdata = $_POST;
	    $result = $this->lman_library->senddataurl('role/role_delete',$postdata,'POST');
	    echo json_encode($result);
	    
	}
	function save_role()
	{
	    $postdata = $_POST;
	    $result = $this->lman_library->senddataurl('role/role_save',$postdata,'POST');
	    echo json_encode($result);
	}
	
}
