<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
(c) Brana Pandega - 198709182008121003
*/

if ( ! function_exists('pwd_encrypt'))
{
    // Fungsi untuk enkripsi password
	function pwd_encrypt( $pwd_string='', $email=null ) {
		
		$options = [
			'cost' => 12,
		];
		
		$random = random_string('alnum',rand(30,50));
		
		$salt = $email.$random;
		
		$pwd = password_hash( $pwd_string.$salt, PASSWORD_BCRYPT, $options);
		
		$pwd_data = [
				'salt' => $random,
				'pwd' => $pwd,
				'version' => '1'
			];
		
		return $pwd_data;

	} // akhir - fungsi pwd_encrypt()
}

// if ( ! function_exists('pwd_verify_ppk'))
// {
// 	function pwd_verify_ppk( $email_or_nip='', $pwd2check='' ) {
	    
// 	    $CI = get_instance();
		
// 		$CI->load->model('Employee_model');
		
// 		$employee_id = $CI->Employee_model->get_employee_id($email_or_nip);
		
// 		if ( !empty($employee_id) ){
// 		    $employee_detail = $CI->Employee_model->employee_detail($employee_id);
//     		switch ($employee_detail->version){
    			
//     			case '1' :
    				
//     				$salt = $employee_detail->email.$employee_detail->salt;
    				
//     				if ( password_verify($pwd2check.$salt, $employee_detail->pwd) ) {
//     				    return $employee_detail;
//     				} else {
//     				    return false;
//     				}
    				
//     			break;
    			
//     			case '0' :
    				
//     				if ( password_verify($pwd2check, $employee_detail->pwd) ) {
//     				    return $employee_detail;
//     				} else {
//     				    return false;
//     				}
    				
//     			break;
    			
//     		}
// 		}else{
// 		    return false;
// 		}
		
// 	} // akhir - fungsi pwd_verify()
// }

if ( ! function_exists('pwd_verify'))
{
	function pwd_verify( $email_or_nip='', $pwd2check='' ) {
	    
	    $CI = get_instance();
	    
        include_once APPPATH.'/third_party/Requests/Requests.php';
            
        // Next, make sure Requests can load internal classes
        Requests::register_autoloader();
            
        $response = Requests::post( $CI->config->item('sso_endpoint').'login', array(), array('user'=>$email_or_nip, 'password'=>$pwd2check));
        if ( $response->success === true ){
                
            $result = json_decode($response->body);
            // print_r($result);
            if ( $result->status == 'success'){
                return $result->data;
            }else{
                $CI->load->model('Employee_model');
                $employee_id = $CI->Employee_model->get_employee_id($email_or_nip);
		
        		if ( !empty($employee_id) ){
        		    $employee_detail = $CI->Employee_model->employee_detail($employee_id);
            		switch ($employee_detail->version){
            			
            			case '1' :
            				
            				$salt = $employee_detail->email.$employee_detail->salt;
            				
            				if ( password_verify($pwd2check.$salt, $employee_detail->pwd) ) {
            				        
            				    $employee_data = array(
                                    "userid" => $employee_detail->id,
                                    "username" => $employee_detail->nip_npp,
                                    "email" => $employee_detail->email,
                                    "name" => $employee_detail->name,
                                    );
            				    return json_decode(json_encode($employee_data));
            				} else {
            				    return false;
            				}
            				
            			break;
            			
            			case '0' :
            				
            				if ( password_verify($pwd2check, $employee_detail->pwd) ) {
            				    $employee_data = array(
                                    "userid" => $employee_detail->id,
                                    "username" => $employee_detail->nip_npp,
                                    "email" => $employee_detail->email,
                                    "name" => $employee_detail->name,
                                    );
            				    return $employee_data;
            				} else {
            				    return false;
            				}
            				
            			break;
            			
            		}
        		}else{
        		    return false;
        		}
                return false;
            }

        }else{
            return false;
        }
		
	} // akhir - fungsi pwd_verify()
}

