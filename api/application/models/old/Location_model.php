<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->location_db = $this->load->database('default', TRUE);
    }
	
    function get_province()
    {
		$this->location_db->order_by('name','asc');
		$query = $this->location_db->get('ref_province');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_province() function
	
    function get_city( $province_id = null )
    {
		$this->location_db->order_by('name','asc');
		$this->location_db->where('province_id',$province_id);
		$query = $this->location_db->get('ref_city');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_city() function
	
	function province_detail( $id='' )
	{
		
		$detail = $this->location_db->get_where('ref_province', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of province_detail() function
	
	function city_detail( $id='' )
	{
		
		$detail = $this->location_db->get_where('ref_city', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of city_detail() function
	
} // end of class

?>
