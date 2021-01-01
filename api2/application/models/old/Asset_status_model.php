<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asset_status_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->db_ro = $this->load->database('default', TRUE);
    }
	
    function get()
    {
        $this->db_ro->where('active',1);
		$this->db_ro->order_by('id','asc');
		$query = $this->db_ro->get('ref_asset_status');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	function detail( $id='' )
	{
		
		$detail = $this->db_ro->get_where('ref_asset_status', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail() function
	
} // end of class

?>
