<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class User extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('User_model');
    }

        // if($this->access_control->access_granted( 'USER', 'RW' ) === true )
        // {
        // } else {
        //     $this->response( array('status'=>'failure',
        //             'message'=>'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        // }
    function user_data_post() {
        // if($this->access_control->access_granted( 'USER', 'RW' ) === true )
        if(VALID_LOGIN === true)
        {
            $postdata = ($_POST);
            $this->load->model('User_model');
            $result= $this->User_model->getData();
            if(!empty($result)){
                $dataArr = array();
                $num = 1;
                foreach ( $result as $data ){
                    $array_detail['no'] = $num;
                    $array_detail['id'] = $data->id;
                    $array_detail['user_id'] = $data->user_id;
                    $array_detail['name'] = $data->name;
                    $array_detail['nip_npp'] = $data->nip_npp;
                    $array_detail['company_id'] = $data->company_id;
                    $array_detail['role_id'] = $data->role_id;
                    $array_detail['role_name'] = $data->role_name;
                    $array_detail['company_name'] = $data->company_name;
                    $array_detail['email'] = $data->email;
                    $array_detail['status_user'] = $data->status_user;
                    $array_detail['action'] = '<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details" onclick="edit_user('."'$data->id'".')"><i class="la la-edit"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" onclick="delete_user('."'$data->id'".','."'$data->user_id'".','."'$data->status_user'".')"><i class="la la-trash"></i></a>';
                    $num++;
                    array_push($dataArr,$array_detail);
                }
                $this->response(array(
                    'status'=>'success',
                    'message'=>'',
                    'elapsed_time' => $this->benchmark->elapsed_time(),
        			'data' => $dataArr
                ));
            }else{
                $this->response( array('status'=>'failure',
                    'message'=>'Data Kosong'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
            
        } else {
            $this->response( array('status'=>'failure',
                    'message'=>'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    
    function role_data_post() {
        // if(VALID_LOGIN === true)
        // {
        // } else {
        //     $this->response( array('status'=>'failure',
        //             'message'=>'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        // }
        $postdata = ($_POST);
        $this->load->model('Role_model');
        $result= $this->Role_model->getData();
        $dataArr = array();
        if(!empty($result)){
            foreach ( $result as $menu ){
                $array_detail['id']      = $menu->id;
                $array_detail['name']    = $menu->name;
                array_push($dataArr,$array_detail);
            }
            $this->response(array(
                'status'=>'success',
                'message'=>'',
                'elapsed_time' => $this->benchmark->elapsed_time(),
    			'data' => $dataArr
            ));
        }else{
            $this->response( array('status'=>'failure',
                'message'=>'Data Kosong'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    function company_data_post() {
        $postdata = ($_POST);
        $this->load->model('Company_model');
        $result= $this->Company_model->getDataSelect();
        $dataArr = array();
        if(!empty($result)){
            foreach ( $result as $menu ){
                $array_detail['id']      = $menu->id;
                $array_detail['name']    = $menu->name;
                array_push($dataArr,$array_detail);
            }
            $this->response(array(
                'status'=>'success',
                'message'=>'',
                'elapsed_time' => $this->benchmark->elapsed_time(),
    			'data' => $dataArr
            ));
        }else{
            $this->response( array('status'=>'failure',
                'message'=>'Data Kosong'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    function detail_pegawai_post()
    {
        
    //     $this->lman_security->validate_request_method('GET');
	   // if ( $this->access_control->access_granted( 'USER', 'R' ) === true ) {
	        
            include_once APPPATH.'/third_party/Requests/Requests.php';
                
            // Next, make sure Requests can load internal classes
            Requests::register_autoloader();
            $postdata = $_POST;
            $nip = ( !empty($postdata['nip_npp']) ) ? $postdata['nip_npp'] : null."***";
            // print_r($nip."--");die();
            if (!empty($postdata['nip_npp'])) 
            {
                $response = Requests::get( $this->config->item('sso_endpoint').'api-v1/employee-detail/'.$nip.'?key=OFNkHqWIKp7taH' );
                if ( $response->success === true ){
                    $result = json_decode($response->body);
                    //print_r($result);
                    if ( $result->status == 'success'){
                        $this->response(array(
                            'status'=>'success',
                            'message'=>null,
                            'employee' => $result->employee
                        ));
                    }else{
                        $this->response( array('status'=>'failure',
                        'message'=>'Gagal mendapatkan data pegawai: '.$result->message),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                    }
        
                }else{
                    $this->response( array('status'=>'failure',
                    'message'=>'Gagal menghubungi server SSO LMAN.'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            }else{
                $this->response( array('status'=>'failure',
                    'message'=>'Gagal mendapatkan data pegawai : NIP/NPP tidak ditemukan'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
    }
    
    
    function user_save_post(){
        $postdata = ($_POST);
        // if ( $this->access_control->access_granted( 'USER', 'RW' ) === true ) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_user', 'User ID', 'required|numeric');
            $this->form_validation->set_rules('role', 'Role', 'required|numeric');
            $this->form_validation->set_rules('name', 'Nama User', 'required');
            $this->form_validation->set_rules('nip_npp', 'NIP/NPP', 'required|numeric');
            $this->form_validation->set_rules('email', 'E-Mail', 'required|valid_email');
            $this->form_validation->set_rules('company', 'Instansi', 'required');
            $this->form_validation->set_rules('status_user', 'Status user', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");
            
                
            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $this->response( array('status'=>'failure',
                'message'=>validation_errors()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                if($postdata['status'] == 'add')
                {
                    $user_detail = array(
                        // id	user_id	role_id	name	nip_npp	email	company_id	status_user	statu
                        'user_id' => $this->lman_security->clean_post('id_user'),
                        'role_id' => $this->lman_security->clean_post('role'),
                        'name' => $this->lman_security->clean_post('name'),
                        'nip_npp' => $this->lman_security->clean_post('nip_npp'),
                        'email' => $this->lman_security->clean_post('email'),
                        'company_id' => $this->lman_security->clean_post('company'),
                        'status_user' => $this->lman_security->clean_post('status_user'),
                    );
                    if($postdata['status_user'] == 'INT')
                    {
                        $user_id = $this->User_model->insert($user_detail);
                        if ($user_id != false) {
                            $this->response(array(
                                'status'=>'success',
                                'message'=>'Berhasil Simpan',
                                'elapsed_time' => $this->benchmark->elapsed_time(),
                                ));
                        }else {
                            $this->response( array('status'=>'failure',
                                    'message'=> 'Gagal menyimpan data ke database, silakan coba lagi!'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                           
                        }
                    }else
                    {
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
                	        
                	    $employee_id = $this->User_model->insert_user($employee_data);
                	   // print_r($employee_id);die();
                	    if ($employee_id != false ){
                	        $user_detail = array(
                                // id	user_id	role_id	name	nip_npp	email	company_id	status_user	statu
                                'user_id' => $employee_id,
                                'role_id' => $this->lman_security->clean_post('role'),
                                'name' => $this->lman_security->clean_post('name'),
                                'nip_npp' => $this->lman_security->clean_post('nip_npp'),
                                'email' => $this->lman_security->clean_post('email'),
                                'company_id' => $this->lman_security->clean_post('company'),
                                'status_user' => $this->lman_security->clean_post('status_user'),
                            );
                            //insert ke table User
                            $user_id = $this->User_model->insert($user_detail);
                            if ($user_id != false) {
                                // $this->response(array(
                                //     'status'=>'success',
                                //     'message'=>'Berhasil Simpan',
                                //     'elapsed_time' => $this->benchmark->elapsed_time(),
                                //     ));
                                $email_to = $email;
                
                                include_once APPPATH.'/third_party/Requests/Requests.php';
                                    
                                // Next, make sure Requests can load internal classes
                                Requests::register_autoloader();
                                
                                $header = array('Content-Type'=>'application/json');
                                $body = array(
                                    'api_key' => '6DiX9rVrpd9$7e!3pEb',
                                    'email_to' => $email_to,
                                    'email_subject' => 'Informasi Pendaftaran Akun SSO LMAN - Landfunding Management System',
                                    'email_message' => "<h1>Dengan Hormat,</h1><p>Berikut ini kami sampaikan informasi akun Landfunding Management System Anda untuk masuk menggunakan akun SSO LMAN.</p><p>User: Menggunakan Alamat e-mail, NIP, atau NPP Anda</p><p>Password default (dapat diganti): ".$default_password."</p><p>Demikian informasi ini disampaikan untuk dapat digunakan sebagaimana mestinya.</p><p>Terima kasih.</p>",
                                );
                                // print_r(json_encode($body));
                                $response = Requests::post( $this->config->item('email_api_endpoint').'email/', $header, json_encode($body) );
                                //$response = (object) array('success'=>true);
                                if ( $response->success === true ){
                                        
                                    $result = json_decode($response->body);
                                    //print_r($result);
                                    if ( $result->status == 'success'){
                                        $this->response(array(
                                            'status'=>'success',
                                            'message'=>'Berhasil Simpan',
                                            'id'    => $employee_id,
                                            'password' => $default_password.'(dikirim via email)', 
                                            'email_success' => 'email terkirim',
                                            'elapsed_time' => $this->benchmark->elapsed_time()
                                            ));
                                    }else{
                                        $this->response( array('status'=>'failure',
                                        'message'=> 'gagal mengirim email: '.$result->message.' User tersimpan'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                                    }
                                }else{
                                     $this->response( array('status'=>'failure',
                                        'message'=> 'gagal mengirim email: '.$result->message.' User tersimpan'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                                    
                                }
                            }else {
                                $this->response( array('status'=>'failure',
                                        'message'=> 'Gagal menyimpan data ke database user, silakan coba lagi!'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                               
                            }
                	    }else{
                	        $this->response( array('status'=>'failure',
                                        'message'=> 'Terjadi kesalahan saat menyimpan ke databasee, silakan ulangi lagi.'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                            
                	    }
                    }
                    
                }else{
                    $user_detail = array(
                                // 'user_id' => $employee_id,
                                'role_id' => $this->lman_security->clean_post('role'),
                                // 'name' => $this->lman_security->clean_post('name'),
                                // 'nip_npp' => $this->lman_security->clean_post('nip_npp'),
                                // 'email' => $this->lman_security->clean_post('email'),
                                // 'company_id' => $this->lman_security->clean_post('company'),
                                // 'status_user' => $this->lman_security->clean_post('status_user'),
                            );
                            //insert ke table User
                            // $user_id = $this->User_model->insert($user_detail);
                            $user_id = $this->User_model->update($user_detail,array('id'=>$this->post('id')));
                            if ($user_id != false) {
                                $this->response(array(
                                            'status'=>'success',
                                            'message'=>'Berhasil update data',
                                            'elapsed_time' => $this->benchmark->elapsed_time()
                                            ));
                            }else {
                                $this->response( array('status'=>'failure',
                                        'message'=> 'Gagal menyimpan data ke database user, silakan coba lagi!'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                               
                            }
                    
                }
            }
    }
    
    function user_delete_post(){
        $this->load->model('User_model');
        $data_id = $this->User_model->db->delete('acl_user',array('id'=>$this->post('id')));
            if (!$data_id){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                if($this->post('status_user') == 'EXT'){
                    $data_id = $this->User_model->db->update('ppk_employee',array('status'=>'INACTIVE'),array('id'=>$this->post('id_user')));
                    if(!$data_id){
                        $this->response( array('status'=>'failure',
                            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                    }else{
                        $this->response(array('status'=>'success','message'=>'Berhasil Dihapus'));
                    }
                }else{
                    $this->response(array('status'=>'success','message'=>'Berhasil Dihapus'));
                }
            }
    }
    

    

}
