<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Name		: Employee (Controller)
| Author	: Brana Pandega
|--------------------------------------------------------------------------
*/

class Employee extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
		// enable profiler cukup disini
		//$this->output->enable_profiler(true);
		
    }
    
	public function index(){
	    
	    $method = $this->input->method(TRUE);
	    
	    switch ($method) {
	        case 'POST':
	            $this->add();
	            break;
	        
	        default:
	            $this->output->set_status_header(405,'Method Not Allowed'); 
    		    die();
	            break;
	    }

        // json result
        //$this->output->set_content_type('application/json')->set_output(json_encode($result));
	    
	}
	
	public function login(){
	    $this->lman_security->validate_request_method('POST');

        // start form validations
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user', 'User', 'required|max_length[255]');
        $this->form_validation->set_rules('password', 'Password', 'required');

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            }else{
                
                $this->load->helper('pwd_helper');
                
                $employee_detail = pwd_verify($this->input->post('user'), $this->input->post('password'));
                
                if ( $employee_detail != false ){
                    
                    // ambil role, kemudian kirim sebagai array
                    $role = $this->Employee_model->employee_role($employee_detail->id);
                    
                    if ( !empty($role) ){
                        
                        $this->load->model('Token_model');
                        $jwtuid = uniqid();
                        $this->Token_model->insert(array(
                            'jwt_uid' => $jwtuid,
                            'employee_id' => $employee_detail->id,
                            'issued' => time()
                            ));
                    
                        $token_data = array(
                            "iss" => "lman.klik.co.id", // issuer
                            "aud" => "lman.klik.co.id", // audience
                            "iat" => time(), //The time the JWT was issued. Can be used to determine the age of the JWT
                            "nbf" => time(), // not valid before
                            "jwtuid" => $jwtuid, // token unique id
                            "userid" => $employee_detail->id,
                            "username" => $employee_detail->nip_npp,
                            "name" => $employee_detail->name,
                            "role" => $role,
                        );
                        
                        $jwt = $this->access_control->generateJWT($token_data);
                        
                        $result = array(
                                    'status' => 'success',
                                    'message' => null,
                                    'token' => $jwt,
                    				'elapsed_time' => $this->benchmark->elapsed_time(),
                        );
                    
                    }else{
                        $result = array(
                                    'status' => 'error',
                                    'message' => 'Anda tidak memiliki hak akses (role) pada sistem ini.',
                    				'elapsed_time' => $this->benchmark->elapsed_time(),
                        );
                    }
                    
                }else{
                    $result = array(
                                'status' => 'error',
                                'message' => 'User dan/atau password salah.',
                				'elapsed_time' => $this->benchmark->elapsed_time(),
                    );
                }
                
            }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - login 
	
	public function add(){
	    
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/manage' ) === true ) {
	        
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Alamat E-mail', 'required|valid_email');
            $this->form_validation->set_rules('nip_npp', 'NIP/NPP', 'required|max_length[18]');
            $this->form_validation->set_rules('name', 'Nama', 'required');
            $this->form_validation->set_rules('role', 'Role', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {
                
                $this->load->model('Employee_model');
        	    $this->load->helper('pwd_helper');
        	    $this->load->helper('string_helper');
        	    
        	    $default_password = 'lman'.random_string('numeric',5);
        	    $email = $this->lman_security->clean_post('email');
        	    $password_encrypted = pwd_encrypt( $default_password, $email );
        	    
        	    $employee_data = array(
        	        'email' => $email,
        	        'nip_npp' => $this->lman_security->clean_post('nip_npp'),
        	        'pwd' => $password_encrypted['pwd'],
        	        'salt' => $password_encrypted['salt'],
        	        'version' => $password_encrypted['version'],
        	        'name' => $this->lman_security->clean_post('name'),
        	        );
        	        
        	    $employee_id = $this->Employee_model->insert($employee_data);
        	    
        	    if ( $employee_id != false ){
        	        
        	        // masukkan employee_id ke tabel access_control
        	        $this->Employee_model->insert_role( array( 'employee_id' => $employee_id, 'role' => $this->lman_security->clean_post('role') ) );
        	        
                  /* Konfigurasi email
                    $config = [
                        'mailtype'  => 'html',
                        'charset'   => 'utf-8',
                        'protocol'  => 'smtp',
                        'smtp_host' => 'smtp.pepipost.com', //'smtp.gmail.com',
                        'smtp_user' => 'itlmankemenkeu', //'it.lman.kemenkeu@gmail.com',  // Email gmail
                        'smtp_pass'   => 'Djancok14808',  // Password gmail
                        'smtp_crypto' => 'tls', //'ssl',
                        'smtp_port'   => 587, //465,
                        'crlf'    => "\r\n",
                        'newline' => "\r\n"
                    ];
            
                    $this->load->library('email', $config);
                    $this->email->from('info@asetnegara.id', 'IT LMAN');
                    $this->email->to($email); // Ganti dengan email tujuan
                    $this->email->subject('User dan Password Akun Anda pada Asset Information System LMAN');
                    $this->email->message("Dengan Hormat,<br><br> Berikut ini kami sampaikan informasi akun Anda untuk masuk ke Asset Information System LMAN: <br>Alamat aplikasi: <a href='https://asetnegara.id/aset/' target='_blank'>Klik di sini</a><br>User: Menggunakan NIP, NPP atau alamat email Anda<br>Password default (dapat diganti): ".$default_password."<br><br>Demikian informasi ini disampaikan untuk dapat digunakan sebagaimana mestinya.<br><br>Terima kasih..");
            
                    $this->email->print_debugger();
                    if ($this->email->send()) {
                        $email_success = true;
                    } else {
                        $email_success = false;
                    }*/
                    
                    $email_success = $this->kirimEmail( $email, 'Informasi Akun Anda pada Asset Information System LMAN', "Dengan Hormat,<br><br> Berikut ini kami sampaikan informasi akun Anda untuk masuk ke Asset Information System LMAN: <br>Alamat aplikasi: <a href='https://asetnegara.id/aset/' target='_blank'>Klik di sini</a><br>User: Menggunakan NIP, NPP atau alamat email Anda<br>Password default (dapat diganti): ".$default_password."<br><br>Demikian informasi ini disampaikan untuk dapat digunakan sebagaimana mestinya.<br><br>Terima kasih.." );
        	        
                    $result = array(
                        'status' => 'success',
                        'message' => null,
                        'password' => $default_password.'(dikirim via email)', 
                        'email_success' => $email_success
                        // 000000000000000000 developer@lman.site lman72095
                        // 111111111111111111 staff.pukhk@lman.site lman1234
                        // 222222222222222222 staff.hujan@lman.site lman29570
                        // 333333333333333333 staff.mandala@lman.site lman54198
                        // 444444444444444444 staff.perbendaharaan@lman.site lman70586
                        // 555555555555555555 staff.kopel@lman.site lman41832
                        // 666666666666666666 staff.pp1@lman.site lman16284
                        // 777777777777777777 staff.rkmr@lman.site lman16795
                        // 888888888888888888 staff.aa@lman.site lman04281
                        // 999999999999999999 branapandega@kemenkeu.go.id lman25016
                    );
                    
        	    }else{
                    $result = array(
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan saat menyimpan ke database, silakan ulangi lagi.'
                    );
        	    }
                    
            }
	        
	        
	    } else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
	    
	}
	
	public function update_password(){
	    
	    if ( $this->access_control->access_granted( 'ASSET_READ' ) === true ) {
	        
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password', 'Password Lama', 'required');
            $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[8]|matches[confirm_new_password]');
            $this->form_validation->set_rules('confirm_new_password', 'Ulangi Password Baru', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {
                
                $this->load->model('Employee_model');
        	    $this->load->helper('pwd_helper');
        	    $this->load->helper('string_helper');
        	    
        	    // cek password lama & cek eksistensi user dan ambil data email dari detailnya
                $employee_detail = pwd_verify(USERNAME, $this->input->post('password'));
                
                if ( $employee_detail != false ){

            	    $password_encrypted = pwd_encrypt( $this->lman_security->clean_post('new_password'), $employee_detail->email );
            	    
            	    $employee_data = array(
            	        'pwd' => $password_encrypted['pwd'],
            	        'salt' => $password_encrypted['salt'],
            	        'version' => $password_encrypted['version'],
            	        );
            	        
            	    $employee_update = $this->Employee_model->update(USERID,$employee_data);
            	    
            	    if ( $employee_update != false ){
            	        
                        $result = array(
                            'status' => 'success',
                            'message' => null,
                        );
                        
            	    }else{
                        $result = array(
                            'status' => 'error',
                            'message' => 'Terjadi kesalahan saat menyimpan ke database, silakan ulangi lagi.'
                        );
            	    }
            	    
        	    }else{
                    $result = array(
                        'status' => 'error',
                        'message' => 'Password lama salah atau user ID tidak valid.'
                    );
        	    }
        	    
            }
	        
	        
	    } else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
	    
	}
	
	private function kirimEmail( $to, $subj, $content ){
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.pepipost.com/v2/sendEmail",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\"personalizations\":[{\"recipient\":\"".$to."\"}],\"from\":{\"fromEmail\":\"info@asetnegara.id\",\"fromName\":\"IT LMAN\"},\"subject\":\"".$subj."\",\"content\":\"".$content."\"}",
          CURLOPT_HTTPHEADER => array(
            "api_key: 7328eed529816ab6cd4b40a144f112f9",
            "content-type: application/json"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          return false;
        } else {
          return true;
        }
    }

} // akhir - class
