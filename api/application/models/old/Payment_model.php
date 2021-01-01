<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->db_ro = $this->load->database('default', TRUE);
    }
    
    function get( $limit='20', $offset='0', $order_by=null, $payment_code = null, $bookkeeping_date_start = null, $bookkeeping_date_end = null, $due_date_start = null, $due_date_end = null )
    {
    	// pencarian by nomer kontrak
    	if ( !empty($payment_code) ){
    	    $this->db_ro->like('payment_code', $payment_code);
    	}
    	
    	if ( !empty($bookkeeping_date_start) ){
    	    $this->db_ro->where('bookkeeping_date >=',$bookkeeping_date_start);
    	}
    	
    	if ( !empty($bookkeeping_date_end) ){
    	    $this->db_ro->where('bookkeeping_date <=',$bookkeeping_date_end);
    	}
    	
		switch ($order_by){
			case 'bookkeeping_date-asc':
				$this->db_ro->order_by("bookkeeping_date", "asc");
			break;
			case 'bookkeeping_date-desc':
				$this->db_ro->order_by("bookkeeping_date", "desc");
			break;
			default:
				$this->db_ro->order_by("id", "desc");
		}

		$this->db_ro->limit($limit, $offset);
		$this->db_ro->from('payment');
		$query = $this->db_ro->get();
		
		if ( $result = $query->result() ){ return $result; }

	} // end of get() function
    
    function count( $payment_code = null, $bookkeeping_date_start = null, $bookkeeping_date_end = null, $due_date_start = null, $due_date_end = null )
    {
        
        $this->db_ro->select('id');
    	// pencarian by nomer kontrak
    	if ( !empty($payment_code) ){
    	    $this->db_ro->like('payment_code', $payment_code);
    	}
    	
    	if ( !empty($bookkeeping_date_start) ){
    	    $this->db_ro->where('bookkeeping_date >=',$bookkeeping_date_start);
    	}
    	
    	if ( !empty($bookkeeping_date_end) ){
    	    $this->db_ro->where('bookkeeping_date <=',$bookkeeping_date_end);
    	}

		$this->db_ro->from('payment');
		$query = $this->db_ro->get();
		
		if ( $result = $query->result() ){ return count($result); }

	} // end of count() function
    
    function get_by_asset( $asset_id=null, $date_start=null, $date_end=null )
    {
        $this->db_ro->where('asset_id',$asset_id);
		$this->db_ro->order_by('id','asc');
		$query = $this->db_ro->get('contract');	
		if ( $contract_result = $query->result() ){
		    foreach ( $contract_result as $contract_data ){
		        $contract_id[] = $contract_data->id;
		    }
		    if ( !empty($contract_id) ){
                $this->db_ro->where_in('contract_id',$contract_id);
            	if ( !empty($date_start) ){
            	    $this->db_ro->where('bookkeeping_date >=',$date_start);
            	}
            	
            	if ( !empty($date_end) ){
            	    $this->db_ro->where('bookkeeping_date <=',$date_end);
            	}
        		$this->db_ro->order_by('id','desc');
        		$query = $this->db_ro->get('payment');	
        		if ( $result = $query->result() ){ return $result; }
		    }
		}
	} // end of get_by_asset() function
    
    function get_by_contract( $contract_id=null )
    {
        $this->db_ro->where('contract_id',$contract_id);
		$this->db_ro->order_by('id','desc');
		$query = $this->db_ro->get('payment');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_by_contract() function
	
    function get_by_invoice( $invoice_id=null )
    {
        $this->db_ro->where('invoice_id',$invoice_id);
		$this->db_ro->order_by('id','desc');
		$query = $this->db_ro->get('payment');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_by_invoice() function
	
    function get_by_code( $payment_code=null )
    {
        $this->db_ro->where('payment_code',$payment_code);
		$this->db_ro->order_by('id','desc');
		$query = $this->db_ro->get('payment');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_by_code() function
	
	function detail( $id='' )
	{
		
		$detail = $this->db_ro->get_where('payment', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail() function
	
    function update( $id='', $data='' )
    {
		$this->db->where('id', $id);
		if ($this->db->update('payment', $data)){
			return true;
		}else{
			return false;
		}
	} // end of update() function
	
    function insert( $data = array() ) 
    {
		if ($this->db->insert('payment', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert() function
	
    function delete( $id = null )
    {
		if ($this->db->delete('payment', array('id'=>$id) )){
			return true;
		}else{
			return false;
		}
	} // end of delete() function
	
	
    function total_payment( $date_start=null, $date_end=null, $asset_id=null )
    {
        $this->db_ro->select('payment.amount,payment.currency');
        if ( !empty($date_start) ){
            $this->db_ro->where('payment.bookkeeping_date >=',$date_start);
        }
            	
        if ( !empty($date_end) ){
            $this->db_ro->where('payment.bookkeeping_date <=',$date_end);
        }
        
        if ( $asset_id == null ){
            $table = array('payment');
        }else{
            $table = array('payment','contract');
            $this->db_ro->where('contract.asset_id',$asset_id);
            $this->db_ro->where('contract.id = payment.contract_id');
        }

        $query = $this->db_ro->get($table);	
        if ( $result = $query->result() ){
            $total_payment['IDR'] = 0;
            $total_payment['USD'] = 0;
            foreach ( $result as $result ){
                $total_payment[$result->currency] = $total_payment[$result->currency] + $result->amount;
            }
        }else{
            $total_payment['IDR'] = 0;
            $total_payment['USD'] = 0;
        }
        
        return $total_payment;
        
	} // end of total_payment() function

} // end of class

?>
