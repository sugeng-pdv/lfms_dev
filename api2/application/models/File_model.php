<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'document';
        $this->primary_key = 'id';
        parent::__construct();
	}

   //untuk function
   function insert_document( $data = array() ) 
    {
		if ($this->db->insert('document', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert() function
	
	//untuk function
   function insert_field_document( $data = array() ) 
    {
		if ($this->db->insert('field_document', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert() function
	


}
