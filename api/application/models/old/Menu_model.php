<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		//$this->db = $this->load->database('default', TRUE);
    }
    
    function get($parent=null)
    {
        switch ( $parent ){
            case 'root' :
                $this->db->where('parent', null);
            break;
            case null :
            break;
            default:
                $this->db->where('parent', $parent);
        }
        
        $this->db->where('status','ACTIVE');
		$this->db->order_by('parent','asc');
		$this->db->order_by('name','asc');
		$this->db->order_by('id','asc');
		$query = $this->db->get('acl_menu');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get() function
	
	function detail( $id='' )
	{
		
		$detail = $this->db->get_where('acl_menu', array('id' => $id), 1);			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail() function
	
    function insert( $data = array() ) 
    {
		if ($this->db->insert('acl_menu', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert() function
	
    function update( $id='', $data='' )
    {
		$this->db->where('id', $id);
		if ($this->db->update('acl_menu', $data)){
			return true;
		}else{
			return false;
		}
	} // end of update() function
	
    function delete( $id='' )
    {
		$this->db->where('id', $id);
		
		if ($this->db->update('acl_menu', array('status'=>'INACTIVE'))){
			return true;
		}else{
			return false;
		}
	} // end of delete() function

	
} // end of class

?>
