<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->db_ro = $this->load->database('default', TRUE); // instance utk database readonly
    }
    
	function countAssetByHandoverYear( $year = null )
	{
		$query = $this->db->query("CALL CountAssetByHandoverYear(".$this->db->escape($year).")");
		$result = $query->result();
		
		$query->next_result();
		$query->free_result();
		
        return $result[0]->jumlah_aset;
	}
	
} // end of class

?>
