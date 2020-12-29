<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lman_constant
{

	function __construct()
	{
		log_message('debug', "Constant library initialized.");

        $CI =& get_instance();
		// $CI->session->set_userdata('csrf',"tes");

		// // SYSTEM_TIME
        // $query = $CI->db->query("SELECT UNIX_TIMESTAMP() as dbunixtime;");
        // foreach ($query->result() as $row)
		// {
		//    $db_unixtime = $row->dbunixtime;
		//    $db_unixmicrotime = $row->dbunixtime.'.0000';
		// }

    	// if ( isset($_COOKIE['demo_instance']) AND $CI->config->item('demo') == true ) {
    	
		// 	$CI->load->model('Demo_model');
		
		// 	$system_time = $CI->Demo_model->get_tanggal_sistem($_COOKIE['demo_instance']);
			
		// 	if( empty($system_time) OR $system_time == '' OR $system_time == NULL ){
			
		// 		define('SYSTEM_TIME', $db_unixtime);
		// 		define('SYSTEM_MICROTIME', $db_unixmicrotime);
				
		// 	}else{
			
		// 		define('SYSTEM_TIME', $system_time);
		// 		define('SYSTEM_MICROTIME', $system_time.'.0000');
				
		// 	}
		
		// }else{
		
		// 	define('SYSTEM_TIME', $db_unixtime);
		// 	define('SYSTEM_MICROTIME', $db_unixmicrotime);
			
		// }
        // RANDOM - konstanta untuk random string
        $workspace_uri_string = ( defined('WORKSPACE') ) ? '&workspace='.WORKSPACE : null;
		define( "RANDOM",random_string('alnum',10).$workspace_uri_string );
        
		// PLATFORM_PATH - konstanta untuk view dan asset dinamis
		if ( isset($_GET['mobile']) OR $CI->agent->is_mobile() ){
			define("PLATFORM_PATH", "web/");

		}else{
			define("PLATFORM_PATH", "web/");
		}
		define("VIEWS_ERROR_PATH", "errors/");
		// Bahasa
		define("LANGUAGE", "indonesia");

		//System Time
		define('SYSTEM_TIME', time());
		
	}

}

