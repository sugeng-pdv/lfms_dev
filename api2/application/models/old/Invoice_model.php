<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->db_ro = $this->load->database('default', TRUE);
    }
    
    function get( $limit='20', $offset='0', $order_by=null, $invoice_number = null, $invoice_date_start = null, $invoice_date_end = null, $due_date_start = null, $due_date_end = null )
    {
    	// pencarian by nomer kontrak
    	if ( !empty($invoice_number) ){
    	    $this->db_ro->like('invoice_number', $invoice_number);
    	}
    	
    	if ( !empty($invoice_date_start) ){
    	    $this->db_ro->where('invoice_date >=',$invoice_date_start);
    	}
    	
    	if ( !empty($invoice_date_end) ){
    	    $this->db_ro->where('invoice_date <=',$invoice_date_end);
    	}
    	
    	if ( !empty($due_date_start) ){
    	    $this->db_ro->where('due_date >=',$due_date_start);
    	}
    	
    	if ( !empty($due_date_end) ){
    	    $this->db_ro->where('due_date <=',$due_date_end);
    	}
    	
		switch ($order_by){
			case 'due_date-asc':
				$this->db_ro->order_by("due_date", "asc");
			break;
			case 'due_date-desc':
				$this->db_ro->order_by("due_date", "desc");
			break;
			default:
				$this->db_ro->order_by("id", "desc");
		}
		
		$this->db_ro->where('status <> "DELETED"');

		$this->db_ro->limit($limit, $offset);
		$this->db_ro->from('invoice');
		$query = $this->db_ro->get();
		
		if ( $result = $query->result() ){ return $result; }

	} // end of get() function
    
    function count( $invoice_number = null, $invoice_date_start = null, $invoice_date_end = null, $due_date_start = null, $due_date_end = null )
    {
        
        $this->db_ro->select('id');
    	// pencarian by nomer kontrak
    	if ( !empty($invoice_number) ){
    	    $this->db_ro->like('invoice_number', $invoice_number);
    	}
    	
    	if ( !empty($invoice_date_start) ){
    	    $this->db_ro->where('invoice_date >=',$invoice_date_start);
    	}
    	
    	if ( !empty($invoice_date_end) ){
    	    $this->db_ro->where('invoice_date <=',$invoice_date_end);
    	}
    	
    	if ( !empty($due_date_start) ){
    	    $this->db_ro->where('due_date >=',$due_date_start);
    	}
    	
    	if ( !empty($due_date_end) ){
    	    $this->db_ro->where('due_date <=',$due_date_end);
    	}
    	
    	$this->db_ro->where('status <> "DELETED"');
    	
		$this->db_ro->from('invoice');
		$query = $this->db_ro->get();
		
		if ( $result = $query->result() ){ return count($result); }

	} // end of count() function
    
    function get_by_asset( $asset_id=null )
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
                $this->db_ro->where('status <> "DELETED"');
        		$this->db_ro->order_by('id','desc');
        		$query = $this->db_ro->get('invoice');	
        		if ( $result = $query->result() ){ return $result; }
		    }
		}
	} // end of get_by_asset() function
    
    function get_by_contract( $contract_id=null )
    {
        $this->db_ro->where('contract_id',$contract_id);
        $this->db_ro->where('status <> "DELETED"');
		$this->db_ro->order_by('id','desc');
		$query = $this->db_ro->get('invoice');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_by_contract() function
	
    function get_by_payment_code( $payment_code=null )
    {
        $this->db_ro->where('payment_code',$payment_code);
        $this->db_ro->where('status <> "DELETED"');
		$this->db_ro->order_by('id','desc');
		$query = $this->db_ro->get('invoice');	
		if ( $result = $query->result() ){ return $result; }
		
	} // end of get_by_payment_code() function
	
	function detail( $id='' )
	{
		
		$detail = $this->db_ro->get_where('invoice', array('id' => $id), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail() function
	
	function detail_by_number( $invoice_number='' )
	{
		
		$detail = $this->db_ro->get_where('invoice', array('invoice_number' => $invoice_number), 1);			
			
		if ( $result = $detail->result() ){
			// convert the result from array to object
			foreach ( $result as $data ){}
			return $data;
		}
		
	} // end of detail() function
	
    function update( $id='', $data='' )
    {
		$this->db->where('id', $id);
		if ($this->db->update('invoice', $data)){
			return true;
		}else{
			return false;
		}
	} // end of update() function
	
    function insert( $data = array() ) 
    {
		if ($this->db->insert('invoice', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	} // end of insert() function
	
    function total_billed_amount( $date_start=null, $date_end=null, $asset_id=null )
    {
        $this->db_ro->select('invoice.billed_amount,invoice.currency');
        $this->db_ro->where('invoice.status','ISSUED');
        if ( !empty($date_start) ){
            $this->db_ro->where('invoice.invoice_date >=',$date_start);
        }
            	
        if ( !empty($date_end) ){
            $this->db_ro->where('invoice.invoice_date <=',$date_end);
        }
        
        if ( $asset_id == null ){
            $table = array('invoice');
        }else{
            $table = array('invoice','contract');
            $this->db_ro->where('contract.asset_id',$asset_id);
            $this->db_ro->where('contract.id = invoice.contract_id');
        }

        $query = $this->db_ro->get($table);	
        if ( $result = $query->result() ){
            $total_billed_amount['IDR'] = 0;
            $total_billed_amount['USD'] = 0;
            foreach ( $result as $result ){
                $total_billed_amount[$result->currency] = $total_billed_amount[$result->currency] + $result->billed_amount;
            }
        }else{
            $total_billed_amount['IDR'] = 0;
            $total_billed_amount['USD'] = 0;
        }
        return $total_billed_amount;
	} // end of total_billed_amount() function

} // end of class

?>
