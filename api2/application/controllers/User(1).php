<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('User_model');

		// enable profiler cukup disini
		//$this->output->enable_profiler(true);
		
    }
    
    // "router" REST API
	public function index()
	{
	    $request_method = $this->input->method(TRUE);
	    switch ( $request_method ) {
	        case 'OPTIONS' :
	            $this->output->set_status_header(200,'Success');
	        break;
	        case 'GET' :
                $this->get();
            break;
	        case 'POST' :
	            $this->add();
	        break;
	        default:
	            $this->output->set_status_header(405,'Method Not Allowed');
	    }
	}
	// akhir - "router" REST API
   
	public function get()
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( 'USER', 'R' ) === true ) {
	        
    		$user = $this->User_model->get();

            if ( !empty($user) ){
                    $userArr = array();
                    $this->load->model('Role_model');
                    foreach ( $user as $user ){
                        $user_detail['id'] = $user->id;
                        $user_detail['user_id'] = $user->user_id;
                        $user_detail['role_id'] = $user->role_id;
                        $user_detail['name'] = $user->name;
                        $role_detail = $this->Role_model->detail($user->role_id);
                        $user_detail['role_name'] = ( !empty($role_detail) ) ? $role_detail->name : null;
                        $user_detail['nip_npp'] = $user->nip_npp;
                        $user_detail['email'] = $user->email;
                        
        		        array_push($userArr,$user_detail);
                    }

    			// create result
    			$result = array(
    				'status' => 'success',
    				'message' => null,
    				'elapsed_time' => $this->benchmark->elapsed_time(),
    				'user' => $userArr
    			);
    
    		}else{
    			// create result
    			$result = array(
    					'status' => 'error',
    					'message' => 'Data user kosong.'
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
		
	} // end of - get
	
	public function get_detail_pegawai($nip=null)
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( 'USER', 'R' ) === true ) {
	        
            include_once APPPATH.'/third_party/Requests/Requests.php';
                
            // Next, make sure Requests can load internal classes
            Requests::register_autoloader();
            
            $response = Requests::get( $this->config->item('sso_endpoint').'api-v1/employee-detail/'.$nip.'?key=OFNkHqWIKp7taH' );
            //print_r($response);
            if ( $response->success === true ){
                    
                $result = json_decode($response->body);
                //print_r($result);
                if ( $result->status == 'success'){
        			$result = array(
        					'status' => 'success',
        					'message' => null,
        					'employee' => $result->employee
        			);
                }else{
        			$result = array(
        					'status' => 'error',
        					'message' => 'Gagal mendapatkan data pegawai: '.$result->message
        			);
                }
    
            }else{
    			$result = array(
    					'status' => 'error',
    					'message' => 'Gagal menghubungi server SSO LMAN.'
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
		
	} // end of - get_detail_pegawai
	
	public function add()
	{
	    
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'USER', 'RW' ) === true ) {
	         
            // konversi JSON ke POST 
            $_POST = json_decode(file_get_contents("php://input"), true);
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'User ID', 'required|numeric');
            $this->form_validation->set_rules('role_id', 'Role', 'required|numeric');
            $this->form_validation->set_rules('name', 'Nama User', 'required');
            $this->form_validation->set_rules('nip_npp', 'NIP/NPP', 'required|numeric');
            $this->form_validation->set_rules('email', 'E-Mail', 'required|valid_email');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $user_detail = array(
                    'user_id' => $this->lman_security->clean_post('id'),
                    'role_id' => $this->lman_security->clean_post('role_id'),
                    'name' => $this->lman_security->clean_post('name'),
                    'nip_npp' => $this->lman_security->clean_post('nip_npp'),
                    'email' => $this->lman_security->clean_post('email'),
                );
                
                $user_id = $this->User_model->insert($user_detail);
                if ($user_id != false) {
                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                    );
                } else {
                    $result = array(
                        'status' => 'error',
                        'message' => 'Gagal menyimpan data ke database, silakan coba lagi!'
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
		
	} // end of - add
	
	public function update( $user_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'USER', 'RW' ) === true ) {
	         
            // konversi JSON ke POST 
            $_POST = json_decode(file_get_contents("php://input"), true);
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('role_id', 'Role', 'required|numeric');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $user_detail = array(
                    'role_id' => $this->lman_security->clean_post('role_id'),
                );
                
                $update = $this->User_model->update($user_id, $user_detail);
                if ($update != false) {
                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                    );
                } else {
                    $result = array(
                        'status' => 'error',
                        'message' => 'Gagal menyimpan data ke database, silakan coba lagi!'
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
	} // end of - update
	
	public function delete( $user_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( 'USER', 'RW' ) === true ) {
	         
            $delete_user = $this->User_model->delete($user_id);
            if ($delete_user != false) {
                $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                );
            } else {
                $result = array(
                        'status' => 'error',
                        'message' => 'Gagal menyimpan data ke database, silakan coba lagi!'
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
	} // end of - delete()

}
