<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lman_library
{

    protected $CI;
    public function __construct()
	{
		$this->_ci =&get_instance();
		$_this =& get_instance();
		$this->CI =& get_instance();
	}
	
	
    function format_rupiah($nilai)
	{
		$result = "Rp " . number_format($nilai,0,',','.');
		return $result;

    }
    
    function getdataurl($url){
        // $_this =& get_instance();
		$uri = $_this->config->item('api_endpoint').'/'.$url;
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

 	function senddataurl($url,$data,$type){
 	  //  $_this =& get_instance();
 		$time = time();
 		$uri = $this->CI->config->item('api_endpoint').'/'.$url;
//  		die($uri);
		 $apiKey = 'Lman@123';
		 // API auth credentials
		$apiUser = "admin";
		$apiPass = "1234";
 		$params = array(
 			'Content-Type: application/x-www-form-urlencoded',
 			'x-api-key:'.$apiKey,
 		    'Authorization: '. $this->CI->input->get_request_header('Authorization')
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
 	
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function created_captcha()
    {
        $_this =& get_instance();
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
            $link = "http"; 
        }else{
            $link = "https"; 
        }
        // Here append the common URL characters. 
        $link .= "://"; 
        
        // Append the host(domain name, ip) to the URL. 
        $link .= $_SERVER['HTTP_HOST']; 
        // Append the requested resource location to the URL 
        // $link .= $_SERVER['REQUEST_URI']; 
        $path = './captcha/';
        // buat folder jika tidak ada
        if(!file_exists($path)){
            $createFolder = mkdir($path,0777);
            if(!$createFolder){
                return;
            }
        }
        $baseUrl = $_this->config->item('static_base_url');
        $word       = array_merge(range('0','9'),range('A','Z'));
        $randomword = shuffle($word);
        $str        = substr(implode($word),0,5);

        $options = array(
            'word'          => $str,
            'img_path'      => $path,
            'img_url'       => base_url()."captcha/",
            // 'img_url'       => $baseUrl.'captcha/',
            'img_width'     => '150',
            'img_height'    => '50',
            // 'word_length'   => '4',
            'font_size'     => '16',
            'expiration'    => 7200
        );
        $captcha    = create_captcha($options);
        $image      = $captcha['image'];
        $str        = $_this->mx_encryption->encrypt($str);
        $_this->session->set_userdata('captchaword',$str);
        return $image;
    }
    function check_captcha($word)
    {
        $_this =& get_instance();
        if($word == $_this->session->userdata('captchaword'))
        {
            return true;
        }else{
            return false;
        }
    }
    function list_menu_nav_bar()
    {
        
    }
    

}

