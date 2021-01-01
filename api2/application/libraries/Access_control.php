<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|==========================================================================
|	Library name : Access_control
|	[c] Brana Pandega
|==========================================================================
*/

require_once APPPATH . '/libraries/JWT.php';
require_once APPPATH . '/libraries/BeforeValidException.php';
require_once APPPATH . '/libraries/ExpiredException.php';
require_once APPPATH . '/libraries/SignatureInvalidException.php';
use \Firebase\JWT\JWT;

class Access_control
{

	/**
	 * Constructor - Initializes and references CI
	 */
	function __construct(){
	    $this->instance =& get_instance();
	    
	    $this->token_key = "yZ%&D6c5O@UHiGm";
	    
	    $jwt = $this->getBearerToken();
	   // echo $jwt;
	    
	   // echo 'JWT'.$jwt;die();
	    
	    try {
	        
            JWT::$leeway = 60; // $leeway in seconds (toleransi)
	        $jwt_decoded =  JWT::decode($jwt, $this->token_key, array('HS256'));
    	    // cek validitas jwt: domain, masa berlaku, eksistensi user id, beneran punya role dsb
    	   // print_r($jwt_decoded);die();
        	$this->instance->load->model('Token_model');
        	$token_detail = $this->instance->Token_model->detail( (!empty($jwt_decoded->jwtuid)) ? $jwt_decoded->jwtuid : null );
    	    // cek masa berlaku 
    	    if ( time() - $jwt_decoded->iat <= 7200 AND !empty($token_detail) ){
    	        
        	    if ( $token_detail->employee_id == $jwt_decoded->userid ){
        	        $this->instance->load->model('Acl_model');
        	        
        	        $user_detail = $this->instance->Acl_model->user_detail( $jwt_decoded->userid );
        	        
        	        if ( !empty($user_detail) ){
        	            
        	            $this->instance->load->model('Role_model');
        	            $role_detail = $this->instance->Role_model->detail($user_detail->role_id);
        	            
            	        define('VALID_LOGIN',true);
                	    define('USERID',$jwt_decoded->userid);
            	       // define('ID',$user_detail->id);
                	    define('NAME',$user_detail->name);
                	    define('ROLE_ID',$user_detail->role_id);
                	    define('STATUS_USER',$user_detail->status_user);
                	    define('COMPANY_ID',$user_detail->company_id);
                	    define('ROLE_NAME',(!empty($role_detail)) ? $role_detail->name : null);
                	    
        	        }else{
            	        define('VALID_LOGIN',false);
        	        }
        	        
        	    }else{
        	        define('VALID_LOGIN',false);
        	    }
    	        
    	    }else{
    	        define('VALID_LOGIN',false);
    	    }
    	    
	    }catch(Exception $e){
	        define('VALID_LOGIN',false);
	    }
	    
	   // print_r($token_detail);die();
	}
	
    function access_granted( $menu_code=null, $authority=null ){
    	if ( VALID_LOGIN !== true OR empty(ROLE_ID) ){
    		return false;
    	}else{
    		
    		$this->instance->load->model('Acl_model');
    		return $this->instance->Acl_model->check_authority(ROLE_ID, $menu_code, $authority);
    		
    	} 
    } // akhir - access_granted()
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*
	function granted( $url ) // cek permission berdasarkan segmen url 1 dan 2 pada API
	{
    	if ( VALID_LOGIN !== true ){
    		return false;
    	}else{
    		
    		$this->instance->load->model('Acl_model');
    		foreach ( ROLE as $i => $role ){
        		$employee_authority = $this->instance->Acl_model->employee_authority($role);
    		    if ( !empty($employee_authority) ){
    		        foreach( $employee_authority as $employee_authority ){
    		            if ( $authority_name == $employee_authority ){ return true; }
    		        }
    		    }
    		}
    		
			return false;

    	} 
	} // akhir - granted()
	
	
    function access_granted( $authority_name=null ){
    	if ( VALID_LOGIN !== true ){
    		return false;
    	}else{
    		
    		$this->instance->load->model('Acl_model');
    		foreach ( ROLE as $i => $role ){
        		$employee_authority = $this->instance->Acl_model->employee_authority($role);
    		    if ( !empty($employee_authority) ){
    		        foreach( $employee_authority as $employee_authority ){
    		            if ( $authority_name == $employee_authority ){ return true; }
    		        }
    		    }
    		}
    		
			return false;

    	} 
    } // akhir access_granted()
    */
	
	/*
    function access_granted_OLD( $name=null ){
    	if ( VALID_LOGIN !== true ){
    		return false;
    	}else{
    		
    		$this->instance->load->config('access_control');
    		$access_control = $this->instance->config->item('access_control');
    		
    		$role_allowed = $access_control[$name];
    		
    		foreach ( ROLE as $i => $role ){
    		    if ( in_array( $role, $role_allowed ) )
				return true;
    		}
    		
			return false;

    	} 
    } // akhir access_granted()
    */
    
    function generateJWT($data=array()){
        return JWT::encode($data, $this->token_key);
    }
    
    private function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }
    
    /**
     * get access token from header
     * */
    private function getBearerToken() {
        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
    

}

