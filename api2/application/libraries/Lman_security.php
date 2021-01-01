<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|==========================================================================
|	Library name : Lman_security
|	[c] Brana Pandega
|==========================================================================
*/

class Lman_security {
    
    // Check request method
    public function validate_request_method( $allowed = null ){
		// create instance
		$this->instance =& get_instance();
		
		// CORS dan preflight request
    	header('Access-Control-Allow-Origin: *');
    	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    	header('Access-Control-Allow-Headers: *');
		
		$request_method = $this->instance->input->method(TRUE);
		if ( $request_method != "OPTIONS" ){
    	    if ( $request_method !== $allowed ){
        		$this->instance->output->set_status_header(405,'Method Not Allowed'); // Method Not Allowed
        		die();
    	    }
		}else{
    		die();
		}
    }
    
    public function clean_post( $post_name=null ){
        $this->instance =& get_instance();
        $clean_post = htmlentities($this->xss_clean($this->instance->input->post($post_name,true)), ENT_QUOTES);
        return ( !empty($clean_post) ) ? $clean_post : null;
    }

	// clean only dangerous html tags
	public function xss_filter($str){
				
		$safetag = '<br>, <img>, <ol>, <ul>, <li>, <p>, <a>, <b>, <i>, <table>, <tbody>, <th>, <tr>, <td>, <strong>, <u>, <em>, <strike>, <span>, <blockquote>, <h1>, <h2>, <h3>, <h4>, <h5>';
		
		$safeattr = 'style, href, rel, border, cellpadding, cellspacing, src, height, width, class';
		
		return  $this->strip_tags_attributes($str, $safetag, $safeattr);

	}
	
	// clean all html tags with no exception
	public function xss_clean($str){
				
		return  $this->strip_tags_attributes($str, $allowtags = null, $allowattributes = null);
		
	}
	
	// clean all array html tags with no exception
	public function xss_clean_array($str){
        
        $this->CI =& get_instance();		
		return array_map(array($this->CI->security, 'xss_clean'), $str);
	}
	
    public function strip_tags_attributes($str, $allowtags = null, $allowattributes = null){
        
        $str = preg_replace(array('/<\*/', '/<=/'), '&lt;\\1', $str);
        
        $str = strip_tags($str, $allowtags);
        
        $str = str_replace('&lt;', '<', $str);
        
        if ( ! is_null($allowattributes) ) {
            
            if( ! is_array($allowattributes) )
                $allowattributes = explode(",", $allowattributes);
                
            if( is_array($allowattributes) )
                $allowattributes = implode(")(?<!",$allowattributes);
                
            if ( strlen($allowattributes) > 0 )
                $allowattributes = "(?<!".$allowattributes.")";
                
            $str = preg_replace_callback("/<[^>]*>/i",create_function(
                '$matches',
                'return preg_replace("/ [^ =]*'.$allowattributes.'=(\"[^\"]*\"|\'[^\']*\')/i", "", $matches[0]);'   
            ),$str);
        }
        
        return $str;
    }
	
	
}
/* End of file Lman_security.php */