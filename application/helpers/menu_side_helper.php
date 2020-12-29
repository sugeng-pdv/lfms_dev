<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('generate_menu'))
{
        // $ci = get_instance();
        
        $CI = get_instance();
        // $ci->API=API_LMAN;
        function getdataurl($url){
            $uri = $CI->config->item('api_endpoint').'/'.$url;
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
            $time = time();
            $CI = get_instance();
            $uri = $CI->config->item('api_endpoint').'/'.$url;
            // die($uri);
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
        function generate_menu()
        {
            $CI = get_instance();
            // $postdata['mgrupuser'] = $ci->session->userdata['mgrupuser'];
            // $postdata['mgrupuser'] ="[67]";
            // print_r($CI->config->item('api_endpoint'));die();
            $postdata = $_POST;
            $mainmenu = $CI->lman_library->senddataurl('Menu/get_menu',$postdata,'POST');
            print_r($mainmenu);die();
            $inits ="";
            $i=0;
            
            if(count($mainmenu)>0)        
            {
                
                foreach ($mainmenu as $main)
                
                {
                    // $submenu = senddataurl
                    $inits .=   "<li class='menu-item menu-item-active' aria-haspopup='true'>
    							        <a href='javascript:void(0)' data-url=".$main->link." class='menu-link'>
    									    <span class='menu-text'>".$main->name."</span>
    										</a>
    								</li>";
            
                }
            }
            return $inits;
        }
}