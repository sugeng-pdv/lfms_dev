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

if ( ! function_exists('pwd_verify'))
{
	function pwd_verify( $email_or_nip='', $pwd2check='' ) {
	    
	    $CI = get_instance();
		
		$CI->load->model('Employee_model');
		
		$employee_id = $CI->Employee_model->get_employee_id($email_or_nip);
		
		if ( !empty($employee_id) ){
		    $employee_detail = $CI->Employee_model->employee_detail($employee_id);
    		switch ($employee_detail->version){
    			
    			case '1' :
    				
    				$salt = $employee_detail->email.$employee_detail->salt;
    				
    				if ( password_verify($pwd2check.$salt, $employee_detail->pwd) ) {
    				    return $employee_detail;
    				} else {
    				    return false;
    				}
    				
    			break;
    			
    			case '0' :
    				
    				if ( password_verify($pwd2check, $employee_detail->pwd) ) {
    				    return $employee_detail;
    				} else {
    				    return false;
    				}
    				
    			break;
    			
    		}
		}else{
		    return false;
		}
		
	} // akhir - fungsi pwd_verify()
}
