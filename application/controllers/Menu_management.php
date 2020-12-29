<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_management extends CI_Controller {
    
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
	   
		$data['title']      = "Menu management - Land Funding Management Lembaga Manajemen Aset Negara";
	    $data['menu_text']= "Menu Management";
	    $data['content_header']= "Land Funding Manajemen Lembaga Manajemen Aset Negara - Role Management";
	    $data['js'] = array(
			'assets/js/lfm/menu_management/index.js',
			);
		
// 		$this->template->display($data,PLATFORM_PATH.'menu_management/index');
        $data = array(
		        'status'=>true,
				'title'	=> "Menu management - Land Funding Management Lembaga Manajemen Aset Negara",
				'menu_text'		=> "Menu Management",
				'content_header' => "Land Funding Manajemen Lembaga Manajemen Aset Negara - Role Management",
				'content'	    => $this->load->view(PLATFORM_PATH.'menu_management/index',$data,true),
				'js'            =>array(
				    'assets/js/lfm/menu_management/index.js',
				    )
				);
			// $status	= false;
		
		echo json_encode($data);
	}
	
	
	
	
	public function data_menu()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('menu/menu_data',$postdata,'POST');
		echo json_encode($result);
	}
	
	public function parent_menu()
	{
	    $postdata=$_POST;
	    $result = $this->lman_library->senddataurl('menu/parent_data',$postdata,'POST');
		echo json_encode($result);
	}
	
	
	function save_menu()
	{
	    $postdata = $_POST;
	    $result = $this->lman_library->senddataurl('menu/menu_save',$postdata,'POST');
	    echo json_encode($result);
	}
	function delete_menu()
	{
	    $postdata = $_POST;
	    $result = $this->lman_library->senddataurl('menu/menu_delete',$postdata,'POST');
	    echo json_encode($result);
	    
	}
	
	function menu_nav()
	{
	    $postdata = $_POST;
	    $result = $this->lman_library->senddataurl('menu/get_menu',$postdata,'POST');
	    echo json_encode($result);
	    
	}
	
	
	
	
	
	
	
	
	
}
