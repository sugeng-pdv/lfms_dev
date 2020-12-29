<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
    var $template_data = array();
	protected $_ci;
	
	function __construct()
	{
		$this->_ci =&get_instance();
	}
	function set($name, $value)
	{
		$this->template_data[$name] = $value;
	}
	function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
	{               
		$this->CI =& get_instance();
		$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));			
		return $this->CI->load->view($template, $this->template_data, $return);
	}
	
	function display($data,$views)
	{
	    $this->_ci->load->view(PLATFORM_PATH.'general/header', $data);      
    // 	$this->_ci->load->view(PLATFORM_PATH.'general/menu_side', $data);   
    // 	$this->_ci->load->view(PLATFORM_PATH.'general/content_header', $data);   
    	$this->_ci->load->view($views, $data);                       
    	$this->_ci->load->view(PLATFORM_PATH.'general/footer', $data);
	}
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */