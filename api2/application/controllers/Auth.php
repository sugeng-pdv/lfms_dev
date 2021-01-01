<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('User_model');
        $this->load->library('Access_control');
    }
    
//     // cuma untuk mengecek validitas token yg dikirim melalui header Authorization: Bearer
// 	public function index(){
	    
// 	    //sleep(10);
	    
// 	    $this->lman_security->validate_request_method('GET');
	    
// 	    if ( VALID_LOGIN === true ){
	        
//             $result = array(
//                 'status' => 'success',
//                 'message' => null,
//                 'userid' => USERID,
//                 'name' => NAME,
//                 'role_id' => ROLE_ID,
//                 'role_name' => ROLE_NAME,
//                 'elapsed_time' => $this->benchmark->elapsed_time(),
//             );

// 	    }else{
//             $result = array(
//                 'status' => 'error',
//                 'message' => 'Sesi login telah berakhir atau token tidak valid.',
//                 'elapsed_time' => $this->benchmark->elapsed_time(),
//             );
// 	    }
	    
//         // json result
//         $this->output->set_content_type('application/json')->set_output(json_encode($result));
	    
// 	}
	
	public function login_post(){
	    $this->load->library('form_validation');
        $this->form_validation->set_rules('user', 'User', 'required|max_length[255]');
        $this->form_validation->set_rules('password', 'Password', 'required');

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $this->response( array('status'=>'failure',
                'message'=>validation_errors()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else{
	            $postdata = $_POST;
	    
                $this->load->helper('pwd_helper');
                $this->load->model('Acl_model');
                
                $employee_detail = pwd_verify($this->input->post('user'), $this->input->post('password'));
                // print_r($employee_detail);die();
                if ( $employee_detail != false ){
                    
                    // ambil role, kemudian kirim sebagai array
                    $user_detail = $this->Acl_model->user_detail($employee_detail->userid);
                    
                    if ( !empty($user_detail) ){
                        
                        $this->load->model('Token_model');
                        $this->load->model('Role_model');
                        $jwtuid = uniqid();
                        $this->Token_model->insert(array(
                            'jwt_uid' => $jwtuid,
                            'employee_id' => $employee_detail->userid,
                            'issued' => time()
                            ));
                            
                        $role_detail = $this->Role_model->detail($user_detail->role_id);
                    
                        $token_data = array(
                            "iss" => "asetnegara.id", // issuer
                            "aud" => "asetnegara.id", // audience
                            "iat" => time(), //The time the JWT was issued. Can be used to determine the age of the JWT
                            "nbf" => time(), // not valid before
                            "jwtuid" => $jwtuid, // token unique id
                            "userid" => $employee_detail->userid,
                        );
                        
                        $jwt = $this->access_control->generateJWT($token_data);
                        $this->response(array(
                                'status'=>'success',
                                'message'=>'Berhasil Login',
                                'token' => $jwt,
                                'elapsed_time' => $this->benchmark->elapsed_time(),
                                ));
                    
                    }else{
                        $this->response( array('status'=>'failure',
                                'message'=>'Anda tidak memiliki hak akses pada sistem ini.',
                                'elapsed_time' => $this->benchmark->elapsed_time()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                        
                    }
                    
                }else{
                    $this->response( array('status'=>'failure',
                                'message'=>'User dan/atau password salah.',
                                'elapsed_time' => $this->benchmark->elapsed_time()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                   
                }
            }
		
	} // end of - login
	
	
	public function check_status_login_post()
	{
	    $dataArr = array();
	    if(VALID_LOGIN === true ){
	        $result_detail['userid'] = USERID;
            $result_detail['name'] = NAME;
            $result_detail['role_id'] = ROLE_ID;
            $result_detail['role_name'] = ROLE_NAME;
            array_push($dataArr,$result_detail);
            $this->response(array(
                                'status'=>true,
                                'message'=>'Berhasil Login',
                                'token' => $dataArr,
                                'elapsed_time' => $this->benchmark->elapsed_time(),
                                ));
	        
	    }else{
	        $this->response( array('status'=>false,
                                'message'=>'Belum Login',
                                'elapsed_time' => $this->benchmark->elapsed_time()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                   
	    }
	}
	//untuk looping check Login
	public function check_login_post()
	{
	    $dataArr = array();
	    if(VALID_LOGIN === true ){
            $this->response(array(
                                'status'=>true,
                                'elapsed_time' => $this->benchmark->elapsed_time(),
                                ));
	    }else{
	        $this->response( array('status'=>false,
                                'elapsed_time' => $this->benchmark->elapsed_time()));
                   
	    }
	}
	public function update_password_post()
	{
	   // $this->response( array('status'=>false,
    //                             'message'=>STATUS_USER,
    //                             'elapsed_time' => $this->benchmark->elapsed_time()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                   
	   //  print_r(STATUS_USER);die();
	    if(STATUS_USER == 'EXT'){
    	    $this->load->library('form_validation');
    	    $this->form_validation->set_rules('old_password', 'Password Lama', 'required');
    	    $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[8]|matches[new_password2]');
            $this->form_validation->set_rules('new_password2', 'Ulangi Password Baru', 'required');
    
            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $this->response( array('status'=>'failure',
                                'message'=> validation_errors(),
                                'elapsed_time' => $this->benchmark->elapsed_time()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else{
                $this->load->model('Employee_model');
                $this->load->helper('pwd_helper');
                $employee_detail = $this->Employee_model->employee_detail(USERID);
                $employee_detail_check = pwd_verify($employee_detail->email, $this->input->post('old_password'));
                // print_r($employee_detail);die();
                if ( $employee_detail_check != false ){
                    // enkripsi
                    
    
                    $password_encrypted = pwd_encrypt( $this->input->post('new_password'), $employee_detail->email );
                    	    
                    $employee_data = array(
                    	'pwd' => $password_encrypted['pwd'],
                    	'salt' => $password_encrypted['salt'],
                    	'version' => $password_encrypted['version'],
                    );
                    	        
                    $update = $this->Employee_model->update(USERID, $employee_data);
    
                    if ( $update === true ){
                        $this->response(array(
                            'status'=>'success',
                            'message'=>'Password berhasil direset, silakan login menggunakan password baru.',
                            'elapsed_time' => $this->benchmark->elapsed_time(),
                            ));
                    }else{
                        $this->response( array('status'=>failure,
                        'message'=> 'Gagal menyimpan perubahan ke database.',
                        'elapsed_time' => $this->benchmark->elapsed_time()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                        
                    }
                }else{
                    $this->response( array('status'=>'failure',
                                'message'=>'password salah.',
                                'elapsed_time' => $this->benchmark->elapsed_time()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                   
                }
                
            }
	    }
	}
	
} // akhir - class
