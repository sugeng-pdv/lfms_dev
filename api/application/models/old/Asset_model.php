<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asset_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->db_ro = $this->load->database('default', TRUE); // instance utk database readonly
    }
    
    function get_asset( $limit='20', $offset='0', $order_by=null, $keyword = null, $asset_status=null, $asset_origin=null, $category_id=null, $province_id=null, $city_id=null, $ready_to_market = null, $free_and_clear_status=null, $lat_min=null, $lat_max=null, $lng_min=null, $lng_max=null )
    {
    	$table[] = 'assets';
    	$this->db_ro->distinct('assets.id');
    	$this->db_ro->select('assets.*');
    	
    	// pencarian by kata kunci
    	if ( !empty($keyword) ){
    	    if ( strlen($keyword) == 13 ){
    	        $this->db_ro->where('assets.asset_code', $keyword);
    	        $this->db_ro->or_like('assets.asset_name', $keyword); 
    	    }else{
        	    $this->db_ro->like('assets.asset_name', $keyword);
    	    }
    	}
    	
    	if ( !empty($asset_status) ){
	    	$this->db_ro->where_in('assets.asset_status',$asset_status);
    	}
    	
    	if ( !empty($asset_origin) ){
	    	$this->db_ro->where_in('assets.asset_origin',$asset_origin);
    	}
    	
    	if ( !empty($category_id) ){
    		$this->db_ro->where_in('assets.asset_category',$category_id);
    	}
    	
    	if ( $province_id !== null AND $city_id !== null ){
	    	$province = array();
	    	foreach ( $province_id as $province_id ){
	    		if( !empty($province_id) AND $province_id != " " ){ $province[] = $this->db_ro->escape($province_id); }
	    	}
	    	$city = array();
	    	foreach ( $city_id as $city_id ){
	    		if( !empty($city_id) AND $city_id != " " ){ $city[] = $this->db_ro->escape($city_id); }
	    	}
	    	$province = implode(",",$province);
	    	$city = implode(",",$city);
	    	$where = "(`assets.province` IN ($province) OR `assets.city` IN ($city) )";
			$this->db_ro->where($where);
    	}elseif( $province_id !== null AND $city_id == null  ){
	    	$this->db_ro->where_in('assets.province',$province_id);
    	}elseif( $province_id == null AND $city_id !== null ){
	    	$this->db_ro->where_in('assets.city',$city_id);
    	}
    	
		switch ($order_by){
			case 'handover_date-asc':
				$this->db_ro->order_by("assets.handover_date", "asc");
			break;
			case 'handover_date-desc':
				$this->db_ro->order_by("assets.handover_date", "desc");
			break;
			case 'asset_cycle-asc':
				$this->db_ro->order_by("assets.asset_cycle", "asc");
			break;
			case 'asset_cycle-desc':
				$this->db_ro->order_by("assets.asset_cycle", "desc");
			break;
			case 'location-asc':
				$this->db_ro->order_by("assets.latitude", "asc");
				$this->db_ro->order_by("assets.longitude", "asc");
			break;
			default:
				$this->db_ro->order_by("assets.id", "desc");
		}
		
    	if ( $ready_to_market !== null ){
	    	$this->db_ro->where('assets.ready_to_market',$ready_to_market);
    	}
    	
    	if ( $free_and_clear_status !== null ){
	    	$this->db_ro->where('assets.free_and_clear_status',$free_and_clear_status);
    	}
    	
    	if ( $lat_min !== null ){
	    	$this->db_ro->where('assets.latitude >= ',$lat_min);
    	}
    	if ( $lat_max !== null ){
	    	$this->db_ro->where('assets.latitude <= ',$lat_max);
    	}

    	if ( $lng_min !== null ){
	    	$this->db_ro->where('assets.longitude >= ',$lng_min);
    	}
    	if ( $lng_max !== null ){
	    	$this->db_ro->where('assets.longitude <= ',$lng_max);
    	}
		
    	$this->db_ro->where("assets.data_status <> 'DELETED'");

		$this->db_ro->limit($limit, $offset);
		$this->db_ro->from($table);
		$query = $this->db_ro->get();
		
		if ( $result = $query->result() ){ return $result; }

	} // end of get_asset() function
    
    function count_asset( $keyword = null, $asset_status=null, $asset_origin=null, $category_id=null, $province_id=null, $city_id=null, $ready_to_market=null, $free_and_clear_status=null, $lat_min=null, $lat_max=null, $lng_min=null, $lng_max=null )
    {
    	$table[] = 'assets';
    	$this->db_ro->distinct('assets.id');
    	$this->db_ro->select('assets.id');
    	
    	// pencarian by kata kunci
    	if ( !empty($keyword) ){
    	    if ( strlen($keyword) == 13 ){
    	        $this->db_ro->where('assets.asset_code', $keyword);
    	        $this->db_ro->or_like('assets.asset_name', $keyword); 
    	    }else{
        	    $this->db_ro->like('assets.asset_name', $keyword);
    	    }
    	}
    	
    	if ( !empty($asset_status) ){
	    	$this->db_ro->where_in('assets.asset_status',$asset_status);
    	}
    	
    	if ( !empty($asset_origin) ){
	    	$this->db_ro->where_in('assets.asset_origin',$asset_origin);
    	}

    	if ( !empty($category_id) ){
    		$this->db_ro->where_in('assets.asset_category',$category_id);
    	}
    	
    	if ( $province_id !== null AND $city_id !== null ){
	    	$province = array();
	    	foreach ( $province_id as $province_id ){
	    		if( !empty($province_id) AND $province_id != " " ){ $province[] = $this->db_ro->escape($province_id); }
	    	}
	    	$city = array();
	    	foreach ( $city_id as $city_id ){
	    		if( !empty($city_id) AND $city_id != " " ){ $city[] = $this->db_ro->escape($city_id); }
	    	}
	    	$province = implode(",",$province);
	    	$city = implode(",",$city);
	    	$where = "(`assets.province` IN ($province) OR `assets.city` IN ($city) )";
			$this->db_ro->where($where);
    	}elseif( $province_id !== null AND $city_id == null  ){
	    	$this->db_ro->where_in('assets.province',$province_id);
    	}elseif( $province_id == null AND $city_id !== null ){
	    	$this->db_ro->where_in('assets.city',$city_id);
    	}
    	
    	if ( $ready_to_market !== null ){
	    	$this->db_ro->where('assets.ready_to_market',$ready_to_market);
    	}
    	
    	if ( $free_and_clear_status !== null ){
	    	$this->db_ro->where('assets.free_and_clear_status',$free_and_clear_status);
    	}
		
    	if ( $lat_min !== null ){
	    	$this->db_ro->where('assets.latitude >= ',$lat_min);
    	}
    	if ( $lat_max !== null ){
	    	$this->db_ro->where('assets.latitude <= ',$lat_max);
    	}

    	if ( $lng_min !== null ){
	    	$this->db_ro->where('assets.longitude >= ',$lng_min);
    	}
    	if ( $lng_max !== null ){
	    	$this->db_ro->where('assets.longitude <= ',$lng_max);
    	}
		
    	$this->db_ro->where("data_status <> 'DELETED'");

		$this->db_ro->from($table);
		$query = $this->db_ro->get();
		
		if ( $result = $query->result() ){ return count($result); }else{ return 0; }

	} // end of count_asset() function
    
    function insert_asset( $data = array() ) 
    {
		if ($this->db->insert('assets', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert_asset() function
	
    function update_asset( $id='', $data='' )
    {
		$this->db->where('id', $id);
		if ($this->db->update('assets', $data)){
			return true;
		}else{
			return false;
		}
	} // end of update_asset() function
	
	function asset_detail( $id='' )
	{
		
		$detail = $this->db_ro->get_where('assets', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of asset_detail() function
	
	function asset_detail_by_code( $code='' )
	{
		
		$detail = $this->db_ro->get_where('assets', array('asset_code' => $code), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of asset_detail_by_code() function
	
    function insert_image( $data = array() )
    {
		if ($this->db->insert('assets_image', $data )){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert_image() function
	
    function delete_image( $asset_id = null, $image_id = null )
    {
		if ($this->db->delete('assets_image', array('id'=>$image_id,'asset_id'=>$asset_id) )){
			return true;
		}else{
			return false;
		}
	} // end of delete_image() function
	
    function set_primary_image( $asset_id = null, $image_id = null )
    {
		$this->db->where('asset_id', $asset_id);
		if ($this->db->update('assets_image', array('primary'=>'0'))){
		    $this->db->where('id', $image_id);
		    if ($this->db->update('assets_image', array('primary'=>'1'))){
			    return true;
		    }else{
		        return false;
		    }
		}else{
			return false;
		}
	} // end of set_primary_image() function
	
	function get_primary_image( $asset_id = null )
	{
		$this->db_ro->where('asset_id', $asset_id);
		$this->db_ro->where('primary', 1);
		$this->db_ro->limit(1);
		$query = $this->db_ro->get('assets_image');	
		if ( $result = $query->result() ){ return $result[0]; }
	} // end of get_primary_image() function
	
	function get_image( $asset_id = null )
	{
		$this->db_ro->where('asset_id', $asset_id);
		$this->db_ro->where('primary', 0);
		$query = $this->db_ro->get('assets_image');	
		if ( $result = $query->result() ){ return $result; }
	} // end of get_image() function
	
    function insert_video( $data = array() )
    {
		if ($this->db->insert('assets_video', $data )){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert_video() function
	
    function delete_video( $asset_id = null, $image_id = null )
    {
		if ($this->db->delete('assets_video', array('id'=>$image_id,'asset_id'=>$asset_id) )){
			return true;
		}else{
			return false;
		}
	} // end of delete_video() function	
	
	function get_video( $asset_id = null )
	{
		$this->db_ro->where('asset_id', $asset_id);
		//$this->db_ro->where('primary', 0);
		$query = $this->db_ro->get('assets_video');	
		if ( $result = $query->result() ){ return $result; }
	} // end of get_video() function
	
	function insert_land_document( $data = array() ) 
    {
		if ($this->db->insert('land_document', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert_land_document() function
	
    function delete_land_document( $document_id = null )
    {
		if ($this->db->delete('land_document', array('id'=>$document_id) )){
			return true;
		}else{
			return false;
		}
	} // end of delete_land_document() function	.
	
	function insert_structure_document( $data = array() ) 
    {
		if ($this->db->insert('structure_document', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert_structure_document() function
	
    function delete_structure_document( $document_id = null )
    {
		if ($this->db->delete('structure_document', array('id'=>$document_id) )){
			return true;
		}else{
			return false;
		}
	} // end of delete_structure_document() function	
	
} // end of class

?>
