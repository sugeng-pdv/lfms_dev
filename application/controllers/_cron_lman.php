<?php

/*
 * Created on Fri Jun 12 2020 6:39:32 PM
 *
 * Filename cron_lman.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */



class cron_lman extends CI_Controller {

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

		$data  = json_decode(curl_exec($ch));
		// $data  = json_encode(curl_exec($ch));
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
		// $postdata['teks'] = "tessss";
		$crondata = $this->getdataurl('vms/Cron/get_email_new');
		// print_r($crondata);die();
		foreach ( $crondata->data as $email_single ){
			// print_r($email_single);die();
			$send_via_smtp1 = $this->send_email_via_gmail_smtp( $email_single );
          
			if ( $send_via_smtp1 != true ){
				// disabled mandrillnya
				$status = false;
				$message = "Gagal mengirim via SMTP-1";

				// $send_via_smtp2 = $this->send_email_via_zoho_smtp( $email_single );
				// if ( $send_via_smtp2 != true ){
				// echo "Gagal mengirim via SMTP-2.<br>";
				// }else{
				// echo "Terkirim via SMTP-2: ".$email_single->id." to ".$email_single->email_to.", prio: ".$email_single->email_priority.", subject: ".$email_single->email_subject."<br>";
				// }
		
			}else{
				$status = true;
				$message = "Terkirim via SMTP-1: ".$email_single->id." to ".$email_single->email_to.", prio: ".$email_single->email_priority.", subject: ".$email_single->email_subject."<br>";
			}
		}
		echo json_encode(array('status'=>$status,'message'=>$message));
	}
	public function email()
    {
      $this->load->model('Email_model');
      $email = $this->Email_model->get_new();
      if( !empty($email) ){
      
        foreach ( $email as $email_single ){
        
          $send_via_smtp1 = $this->send_email_via_app_smtp( $email_single );
          
          if ( $send_via_smtp1 != true ){
            
            // disabled mandrillnya
            echo "Gagal mengirim via SMTP-1. Mencoba kirim via SMTP-2... : ";
            
            $send_via_smtp2 = $this->send_email_via_zoho_smtp( $email_single );
            if ( $send_via_smtp2 != true ){
              echo "Gagal mengirim via SMTP-2.<br>";
            }else{
              echo "Terkirim via SMTP-2: ".$email_single->id." to ".$email_single->email_to.", prio: ".$email_single->email_priority.", subject: ".$email_single->email_subject."<br>";
            }
    
          }else{
            echo "Terkirim via SMTP-1: ".$email_single->id." to ".$email_single->email_to.", prio: ".$email_single->email_priority.", subject: ".$email_single->email_subject."<br>";
          }
        
        }
        
        $next_email = $this->Email_model->get_new();
        if( !empty($next_email) ){
          //redirect( base_url().$this->uri->uri_string().'?_PID='.rand() );
          // jika kondisi antrian sedang banyak (di atas 50 email) karena gangguan sebelumnya, 
          // maka kode di bawah ini harus dicomment untuk menghindari borosnya kuota e-mail
          // $this->email();
        }
        
      }
    }
	
	public function send_email_via_gmail_smtp( $email = null ){
		// print_r($email);die();
		$this->load->library('email');
		
		$config['useragent'] = 'CodeIgniter';
		$config['smtp_crypto'] = 'ssl';
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'smtp.gmail.com';//'smtp.kemenkeu.go.id';
		$config['smtp_user'] = 'noreply.lman@gmail.com';
		$config['smtp_pass'] = 'Lm4n123#';
		$config['smtp_port'] = 465; 
		$config['smtp_timeout'] = 5;
		$config['wordwrap'] = TRUE;
		$config['wrapchars'] = 76;
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['validate'] = TRUE;
		$config['priority'] = 3;
		$config['crlf'] = "\r\n";
		$config['newline'] = "\r\n";
		$config['bcc_batch_mode'] = FALSE;
		$config['bcc_batch_size'] = 200;
		$this->email->initialize($config);
		
		$this->email->from('noreply.lman@gmail.com', 'endor Manajemen Sistem LMAN');
		$this->email->to($email->email_to); 
		//$this->email->cc($email->email_cc); 
		//$this->email->bcc($email->email_bcc); 

		$this->email->subject($email->email_subject);
		$this->email->message($email->email_message);
		$this->email->set_alt_message($email->email_alt_message);
		$this->email->reply_to('procurement.lman@kemenkeu.go.id', 'Vendor Manajemen Sistem LMAN');
		$kirim = $this->email->send();
				
		$this->email->clear(TRUE);
			
		if ( $kirim == true ){ 
			$data['id'] 				= $email->id;
			$data['result_sender'] 		= "gmail_smtp";
			$data['result_sent_time']	= SYSTEM_TIME;	
			$insertSendEmail = $this->senddataurl('vms/Cron/send_email_new',$data,'POST');
			// print_r($insertSendEmail->status);die();
			if($insertSendEmail->status == true){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
 		
	} // akhir - send_email_via_gmail_smtp	

	function tes_delete()
	{
		$data['id'] 				= 29;
		$data['result_sender'] 		= "gmail_smtp";
		$data['result_sent_time']	= SYSTEM_TIME;	
		$insertSendEmail = $this->senddataurl('vms/Cron/send_email_new',$data,'POST');
		print_r($insertSendEmail->status);die();
		// echo json_encode($insertSendEmail);
	}





	public function send_email_via_local_smtp( $email = null )
	{
	
		$this->load->library('email');
		
		$config['useragent'] = 'CodeIgniter';
		$config['protocol'] = 'sendmail';
		$config['wordwrap'] = TRUE;
		$config['wrapchars'] = 76;
		$config['mailtype'] = $email->email_type;
		$config['charset'] = 'utf-8';
		$config['validate'] = FALSE;
		$config['priority'] = $email->email_priority;
		$config['crlf'] = "\r\n";
		$config['newline'] = "\r\n";
		$config['bcc_batch_mode'] = FALSE;
		$config['bcc_batch_size'] = 200;

		$this->email->initialize($config);
		
		$this->email->from('noreply@klik.co.id', 'Klik.co.id');
		$this->email->to($email->email_to); 
		//$this->email->cc($email->email_cc); 
		//$this->email->bcc($email->email_bcc); 

		$this->email->subject($email->email_subject);
		$this->email->message($email->email_message);
		$this->email->set_alt_message($email->email_alt_message);
		$this->email->reply_to('noreply@klik.co.id', 'Klik.co.id');

		$kirim = $this->email->send();
				
		$this->email->clear(TRUE);
			
		if ( $kirim == true ){ 
			$this->Email_model->move( $email->id, array('result_sender'=>'local_smtp','result_sent_time'=>SYSTEM_TIME ) ); 
			return true;
		}else{
			return false;
		}
 		
	} 
	public function send_email_via_app_smtp( $email = null ){
	
		$this->load->library('email');
	
		$config['useragent'] = 'CodeIgniter';
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://m003.dapurhosting.com';//'smtp.kemenkeu.go.id';
		$config['smtp_user'] = 'eproc@approperti.co.id';
		$config['smtp_pass'] = 'Procurement2017';
		$config['smtp_port'] = 465; 
		$config['smtp_timeout'] = 5;
		$config['wordwrap'] = TRUE;
		$config['wrapchars'] = 76;
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['validate'] = FALSE;
		$config['priority'] = 3;
		$config['crlf'] = "\r\n";
		$config['newline'] = "\r\n";
		$config['bcc_batch_mode'] = FALSE;
		$config['bcc_batch_size'] = 200;

		$this->email->initialize($config);
		
		$this->email->from('eproc@approperti.co.id', 'e-Procurement PT. Angkasa Pura Properti');
		$this->email->to($email->email_to); 
		//$this->email->cc($email->email_cc); 
		//$this->email->bcc($email->email_bcc); 

		$this->email->subject($email->email_subject);
		$this->email->message($email->email_message);
		$this->email->set_alt_message($email->email_alt_message);
		$this->email->reply_to('eproc@approperti.co.id', 'e-Procurement PT. Angkasa Pura Properti');

		$kirim = $this->email->send();
				
		$this->email->clear(TRUE);
			
		if ( $kirim == true ){ 
			$this->Email_model->move( $email->id, array('result_sender'=>'app_smtp','result_sent_time'=>SYSTEM_TIME ) ); 
			return true;
		}else{
			return false;
		}
 		
	} // akhir - send_email_via_app_smtp	
	
    public function send_email_via_zoho_smtp( $email = null ){
	
		$this->load->library('email');
	
		$config['useragent'] = 'CodeIgniter';
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.zoho.com';//'smtp.kemenkeu.go.id';
		$config['smtp_user'] = 'noreply@klik.co.id';
		$config['smtp_pass'] = 'djancok14808';
		$config['smtp_port'] = 465; 
		$config['smtp_timeout'] = 5;
		$config['wordwrap'] = TRUE;
		$config['wrapchars'] = 76;
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['validate'] = FALSE;
		$config['priority'] = 3;
		$config['crlf'] = "\r\n";
		$config['newline'] = "\r\n";
		$config['bcc_batch_mode'] = FALSE;
		$config['bcc_batch_size'] = 200;

		$this->email->initialize($config);
		
		$this->email->from('noreply@klik.co.id', 'Klik.co.id');
		$this->email->to($email->email_to); 
		//$this->email->cc($email->email_cc); 
		//$this->email->bcc($email->email_bcc); 

		$this->email->subject($email->email_subject);
		$this->email->message($email->email_message);
		$this->email->set_alt_message($email->email_alt_message);
		$this->email->reply_to('noreply@klik.co.id', 'Klik.co.id');

		$kirim = $this->email->send();
				
		$this->email->clear(TRUE);
			
		if ( $kirim == true ){ 
			$this->Email_model->move( $email->id, array('result_sender'=>'zoho_smtp','result_sent_time'=>SYSTEM_TIME ) ); 
			return true;
		}else{
			return false;
		}
 		
	} // akhir - send_email_via_zoho_smtp	

	
	
}
