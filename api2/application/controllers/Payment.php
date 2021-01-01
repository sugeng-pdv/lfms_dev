<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
   
	public function input()
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'payment/update' ) === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('invoice_id', 'Invoice', 'required|numeric');
            $this->form_validation->set_rules('bookkeeping_date', 'Tanggal Pembukuan', 'required|exact_length[10]');
            $this->form_validation->set_rules('amount', 'Jumlah Pembayaran', 'required|numeric');
            $this->form_validation->set_rules('currency', 'Mata Uang', 'required|exact_length[3]');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {
                
                // tarik data kontrak
                $invoice_id = $this->lman_security->clean_post('invoice_id');
                $this->load->model('Invoice_model');
                $invoice_detail = $this->Invoice_model->detail($invoice_id);
                
                if ( empty($invoice_detail) ){
                    $result = array(
                        'status' => 'error',
                        'message' => 'Data invoice tidak valid.'
                    );
                }else{
                    $payment_detail = array(
                        'contract_id' => $invoice_detail->contract_id,
                        'invoice_id' => $invoice_id,
                        'bookkeeping_date' => $this->lman_security->clean_post('bookkeeping_date'),
                        'input_date' => date('Y-m-d H:i:s',time()),
                        'amount' => $this->lman_security->clean_post('amount'),
                        'currency' => $this->lman_security->clean_post('currency'),
                        'payment_code' => $this->lman_security->clean_post('payment_code'),
                    );
                    
                    $this->load->model('Payment_model');
                    $payment_id = $this->Payment_model->insert($payment_detail);
                    if ($payment_id != false) {
                        $result = array(
                            'status' => 'success',
                            'message' => null,
            				'elapsed_time' => $this->benchmark->elapsed_time(),
                            'payment_id' => $payment_id,
                        );
                    } else {
                        $result = array(
                            'status' => 'error',
                            'message' => 'Gagal menyimpan data ke database, silakan coba lagi!'
                        );
                    }
                }
            }

    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - input
	
	public function get_payment()
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( $this->router->fetch_class() ) === true ) {
	    //$this->output->enable_profiler(true);
	    //if ( true === true ) {
	         
            // page
            $page = intval($this->input->get('page'));
            if (empty($page) OR is_numeric($page) !== true) {
                $page = 1;
            }
    
            // per page
            $per_page = intval($this->input->get('per_page'));
            if (empty($per_page) OR is_numeric($per_page) !== true) {
                $per_page = 10;
            }
            
            // $payment_code as keyword
            $payment_code = $this->input->get('payment_code');
            if ( empty($payment_code) ) {
                $payment_code = null;
            }
            
            // bookkeeping_date_range utk filter range tanggal kontrak
            $bookkeeping_date_range = $this->input->get('bookkeeping_date_range');
            if ( !empty($bookkeeping_date_range) ) {
                $bookkeeping_date = explode(" s.d. ",$bookkeeping_date_range);
            }
            
            $this->load->model('Payment_model');
            
            $num_of_data = $this->Payment_model->count($payment_code, ( !empty($bookkeeping_date[0])) ? $bookkeeping_date[0] : null, ( !empty($bookkeeping_date[1])) ? $bookkeeping_date[1] : null);
            $num_of_page = ceil($num_of_data/$per_page);
            
            $offset = ($page * $per_page) - $per_page;
    		$payment = $this->Payment_model->get( $per_page, $offset, $order_by=null, $payment_code, ( !empty($bookkeeping_date[0])) ? $bookkeeping_date[0] : null, ( !empty($bookkeeping_date[1])) ? $bookkeeping_date[1] : null );
    		if ( !empty($payment) ){
    		    $this->load->model('Contract_model');
    		    $this->load->model('Invoice_model');
    		    $this->load->model('Asset_model');
    		    $this->load->model('Tenant_model');
    		    $this->load->helper('iddate_helper');
    		    $i = $offset + 1; // $i = urutan
    		    foreach ( $payment as $payment ){
    		        $payments[$i] = $payment;
    		        $payments[$i]->bookkeeping_date_txt = convert_date($payment->bookkeeping_date);
                    $payments[$i]->amount_txt = $payment->currency .' '. number_format($payment->amount, 0, ',', '.');
        		    $contract_detail = $this->Contract_model->detail($payment->contract_id);
        		    $payments[$i]->contract_number = ( !empty($contract_detail) ) ? $contract_detail->contract_number : 'N/A';
        		    $asset_detail = $this->Asset_model->asset_detail( ( !empty($contract_detail) ) ? $contract_detail->asset_id : null );
        		    $payments[$i]->asset_name = ( !empty($asset_detail) ) ? $asset_detail->asset_name : 'N/A';
        		    $payments[$i]->asset_code = ( !empty($asset_detail) ) ? $asset_detail->asset_code : 'N/A';
        		    $tenant_detail = $this->Tenant_model->detail( ( !empty($contract_detail) ) ? $contract_detail->tenant_id : null );
        		    $payments[$i]->tenant_name = ( !empty($tenant_detail) ) ? $tenant_detail->name : 'N/A';
        		    $invoice_detail = $this->Invoice_model->detail($payment->invoice_id);
        		    $payments[$i]->invoice_number = ( !empty($invoice_detail) ) ? $invoice_detail->invoice_number : 'N/A';

                    $i++;
    		    }

    			// create result
    			$result = array(
    				'status' => 'success',
    				'message' => null,
    				'elapsed_time' => $this->benchmark->elapsed_time(),
    				'num_of_data' => $num_of_data,
    				'num_of_page' => $num_of_page,
    				'current_page' => $page,
    				'data' => $payments
    			);
    
    		}else{
    			// create result
    			$result = array(
    					'status' => 'error',
    					'message' => 'Tidak ditemukan data pembayaran.'
    			);
    		}
		
    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - get_payment

	public function get_by_asset( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( 'ASSET_READ' ) === true ) {
	        
	        $this->load->model('Asset_model');
    		$asset_detail = $this->Asset_model->asset_detail($asset_id);
    		if ( !empty($asset_detail) ){
    		    
    		    $data['id'] = $asset_detail->id;
    		    $data['asset_code'] = $asset_detail->asset_code;
    		    $data['asset_name'] = $asset_detail->asset_name;
    		    
                $date_start = $this->input->get('date_start');
                $date_start = ( empty($date_start) ) ? null : $date_start;

                $date_end = $this->input->get('date_end');
                $date_end = ( empty($date_end) ) ? null : $date_end;
    		    
    		    $this->load->model('Payment_model');
    		    $payment = $this->Payment_model->get_by_asset($asset_detail->id, $date_start, $date_end);
                $data['payment'] = null;
                $data['total_payment']['IDR'] = 0;
                $data['total_payment']['USD'] = 0;
                if ( !empty($payment) ){
                    $this->load->helper('iddate_helper');
                    foreach ( $payment as $i => $payment ){
                        $data['payment'][$i] = $payment;
                        $data['total_payment'][$payment->currency] = $data['total_payment'][$payment->currency] + $payment->amount;
                    }
                }
                
    			// create result
    			$result = array(
    				'status' => 'success',
    				'message' => null,
    				'elapsed_time' => $this->benchmark->elapsed_time(),
    				'data' => $data
    			);
    
    		}else{
    			// create result
    			$result = array(
    					'status' => 'error',
    					'message' => 'Data aset kosong atau tidak valid.'
    			);
    		}
		
    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - get_by_asset
	
	public function get_by_code($payment_code=null)
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( $this->router->fetch_class() ) === true ) {
	        
	        if ( empty($payment_code) ){
                $result = array(
                    'status' => 'error',
                    'message' => 'Kode pembayaran / virtual account harus diisi.'
                );
	        }else{
            	$this->load->model('Payment_model');
            	$payment = $this->Payment_model->get_by_code($payment_code);

        		if ( !empty($payment) ){
        		    $this->load->model('Contract_model');
        		    $this->load->model('Invoice_model');
        		    $this->load->model('Asset_model');
        		    $this->load->model('Tenant_model');
        		    $this->load->helper('iddate_helper');
        		    $i = 1; // $i = urutan
        		    foreach ( $payment as $payment ){
        		        $payments[$i] = $payment;
        		        $payments[$i]->bookkeeping_date_txt = convert_date($payment->bookkeeping_date);
                        $payments[$i]->amount_txt = $payment->currency .' '. number_format($payment->amount, 0, ',', '.');
            		    $contract_detail = $this->Contract_model->detail($payment->contract_id);
            		    $payments[$i]->contract_number = ( !empty($contract_detail) ) ? $contract_detail->contract_number : 'N/A';
            		    $asset_detail = $this->Asset_model->asset_detail( ( !empty($contract_detail) ) ? $contract_detail->asset_id : null );
            		    $payments[$i]->asset_name = ( !empty($asset_detail) ) ? $asset_detail->asset_name : 'N/A';
            		    $payments[$i]->asset_code = ( !empty($asset_detail) ) ? $asset_detail->asset_code : 'N/A';
            		    $tenant_detail = $this->Tenant_model->detail( ( !empty($contract_detail) ) ? $contract_detail->tenant_id : null );
            		    $payments[$i]->tenant_name = ( !empty($tenant_detail) ) ? $tenant_detail->name : 'N/A';
            		    $invoice_detail = $this->Invoice_model->detail($payment->invoice_id);
            		    $payments[$i]->invoice_number = ( !empty($invoice_detail) ) ? $invoice_detail->invoice_number : 'N/A';
    
                        $i++;
        		    }
    
        			// create result
        			$result = array(
        				'status' => 'success',
        				'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
        				'num_of_data' => count($payments),
        				'num_of_page' => 1,
        				'current_page' => 1,
        				'data' => $payments
        			);
        
        		}else{
        			// create result
        			$result = array(
        					'status' => 'error',
        					'message' => 'Tidak ditemukan data pembayaran.'
        			);
        		}
	        }
	        
    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - get_by_code

	public function get_by_contract( $contract_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( $this->router->fetch_class() ) === true ) {
	        
	        $this->load->model('Contract_model');
    		$contract_detail = $this->Contract_model->detail($contract_id);
    		if ( !empty($contract_detail) ){
    		    
    		    $asset['id'] = $contract_detail->id;
    		    $asset['contract_number'] = $contract_detail->contract_number;
    		    $asset['contract_date'] = $contract_detail->contract_date;
    		    
    		    $this->load->model('Payment_model');
    		    $payment = $this->Payment_model->get_by_contract($contract_detail->id);
                $payments = array();
        		if ( !empty($payment) ){
        		    $this->load->model('Contract_model');
        		    $this->load->model('Invoice_model');
        		    $this->load->model('Asset_model');
        		    $this->load->model('Tenant_model');
        		    $this->load->helper('iddate_helper');
        		    $i = 1; // $i = urutan
        		    foreach ( $payment as $payment ){
        		        $payments[$i] = $payment;
        		        $payments[$i]->bookkeeping_date_txt = convert_date($payment->bookkeeping_date);
                        $payments[$i]->amount_txt = $payment->currency .' '. number_format($payment->amount, 0, ',', '.');
            		    $contract_detail = $this->Contract_model->detail($payment->contract_id);
            		    $payments[$i]->contract_number = ( !empty($contract_detail) ) ? $contract_detail->contract_number : 'N/A';
            		    $asset_detail = $this->Asset_model->asset_detail( ( !empty($contract_detail) ) ? $contract_detail->asset_id : null );
            		    $payments[$i]->asset_name = ( !empty($asset_detail) ) ? $asset_detail->asset_name : 'N/A';
            		    $payments[$i]->asset_code = ( !empty($asset_detail) ) ? $asset_detail->asset_code : 'N/A';
            		    $tenant_detail = $this->Tenant_model->detail( ( !empty($contract_detail) ) ? $contract_detail->tenant_id : null );
            		    $payments[$i]->tenant_name = ( !empty($tenant_detail) ) ? $tenant_detail->name : 'N/A';
            		    $invoice_detail = $this->Invoice_model->detail($payment->invoice_id);
            		    $payments[$i]->invoice_number = ( !empty($invoice_detail) ) ? $invoice_detail->invoice_number : 'N/A';
    
                        $i++;
        		    }
    
        			// create result
        			$result = array(
        				'status' => 'success',
        				'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
        				'num_of_data' => count($payments),
        				'num_of_page' => 1,
        				'current_page' => 1,
        				'data' => $payments
        			);
        
        		}else{
        			// create result
        			$result = array(
        					'status' => 'error',
        					'message' => 'Tidak ditemukan data pembayaran.'
        			);
        		}
                
    		}else{
    			// create result
    			$result = array(
    					'status' => 'error',
    					'message' => 'Data kontrak kosong atau tidak valid.'
    			);
    		}
		
    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - get_by_contract
	
	public function get_by_invoice( $invoice_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( $this->router->fetch_class() ) === true ) {
	        
	        $this->load->model('Invoice_model');
    		$invoice_detail = $this->Invoice_model->detail($invoice_id);
    		if ( !empty($invoice_detail) ){
    		    
    		    $asset['id'] = $invoice_detail->id;
    		    $asset['invoice_number'] = $invoice_detail->invoice_number;
    		    $asset['invoice_date'] = $invoice_detail->invoice_date;
    		    
    		    $this->load->model('Payment_model');
    		    $payment = $this->Payment_model->get_by_invoice($invoice_detail->id);
                $payments = array();
        		if ( !empty($payment) ){
        		    $this->load->model('Contract_model');
        		    $this->load->model('Invoice_model');
        		    $this->load->model('Asset_model');
        		    $this->load->model('Tenant_model');
        		    $this->load->helper('iddate_helper');
        		    $i = 1; // $i = urutan
        		    foreach ( $payment as $payment ){
        		        $payments[$i] = $payment;
        		        $payments[$i]->bookkeeping_date_txt = convert_date($payment->bookkeeping_date);
                        $payments[$i]->amount_txt = $payment->currency .' '. number_format($payment->amount, 0, ',', '.');
            		    $contract_detail = $this->Contract_model->detail($payment->contract_id);
            		    $payments[$i]->contract_number = ( !empty($contract_detail) ) ? $contract_detail->contract_number : 'N/A';
            		    $asset_detail = $this->Asset_model->asset_detail( ( !empty($contract_detail) ) ? $contract_detail->asset_id : null );
            		    $payments[$i]->asset_name = ( !empty($asset_detail) ) ? $asset_detail->asset_name : 'N/A';
            		    $payments[$i]->asset_code = ( !empty($asset_detail) ) ? $asset_detail->asset_code : 'N/A';
            		    $tenant_detail = $this->Tenant_model->detail( ( !empty($contract_detail) ) ? $contract_detail->tenant_id : null );
            		    $payments[$i]->tenant_name = ( !empty($tenant_detail) ) ? $tenant_detail->name : 'N/A';
            		    $invoice_detail = $this->Invoice_model->detail($payment->invoice_id);
            		    $payments[$i]->invoice_number = ( !empty($invoice_detail) ) ? $invoice_detail->invoice_number : 'N/A';
    
                        $i++;
        		    }
    
        			// create result
        			$result = array(
        				'status' => 'success',
        				'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
        				'num_of_data' => count($payments),
        				'num_of_page' => 1,
        				'current_page' => 1,
        				'data' => $payments
        			);
        
        		}else{
        			// create result
        			$result = array(
        					'status' => 'error',
        					'message' => 'Tidak ditemukan data pembayaran.'
        			);
        		}
                
    		}else{
    			// create result
    			$result = array(
    					'status' => 'error',
    					'message' => 'Data kontrak kosong atau tidak valid.'
    			);
    		}
		
    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - get_by_invoice
	
	public function payment_detail( $payment_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( $this->router->fetch_class() ) === true ) {
	         
	        $this->load->model('Payment_model');
    		$payment_detail = $this->Payment_model->detail($payment_id);
    		if ( !empty($payment_detail) ){
    		    
    		    $payment = (array) $payment_detail; // typecast (konversi) dari object ke array
    		    
    		    $payment['amount_txt'] = $payment_detail->currency .' '. number_format($payment_detail->amount, 0, ',', '.');
    		    
    		    $this->load->model('Invoice_model');
    		    $this->load->model('Contract_model');
    		    $this->load->model('Asset_model');
    		    $this->load->helper('iddate_helper');
    		    
        		$invoice_detail = $this->Invoice_model->detail($payment_detail->invoice_id);
        		$payment['invoice_number'] = ( !empty($invoice_detail) ) ? $invoice_detail->invoice_number : 'N/A';
    		    
        		$contract_detail = $this->Contract_model->detail($payment_detail->contract_id);
        		$payment['contract_number'] = ( !empty($contract_detail) ) ? $contract_detail->contract_number : 'N/A';
        		$payment['contract_date_txt'] = ( !empty($contract_detail) ) ? convert_date($contract_detail->contract_date) : 'N/A';

        		$asset_detail = $this->Asset_model->asset_detail( ( !empty($contract_detail) ) ? $contract_detail->asset_id : null );
        		$payment['asset_name'] = ( !empty($asset_detail) ) ? $asset_detail->asset_name : 'N/A';
        		$payment['asset_code'] = ( !empty($asset_detail) ) ? $asset_detail->asset_code : 'N/A';
    		    
    			// create result
    			$result = array(
    				'status' => 'success',
    				'message' => null,
    				'elapsed_time' => $this->benchmark->elapsed_time(),
    				'data' => $payment
    			);
    
    		}else{
    			// create result
    			$result = array(
    					'status' => 'error',
    					'message' => 'Data payment tidak ditemukan.'
    			);
    		}
		
    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - payment_detail
	
	public function update( $payment_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'payment/update' ) === true ) {
	         
            $this->load->library('form_validation');
            $this->form_validation->set_rules('bookkeeping_date', 'Tanggal Pembukuan', 'required|exact_length[10]');
            $this->form_validation->set_rules('amount', 'Jumlah Pembayaran', 'required|numeric');
            $this->form_validation->set_rules('currency', 'Mata Uang', 'required|exact_length[3]');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {
                $payment_detail = array(
                        'bookkeeping_date' => $this->lman_security->clean_post('bookkeeping_date'),
                        'amount' => $this->lman_security->clean_post('amount'),
                        'currency' => $this->lman_security->clean_post('currency'),
                        'payment_code' => $this->lman_security->clean_post('payment_code'),
                );
                
                $this->load->model('Payment_model');
                $update_payment = $this->Payment_model->update($payment_id, $payment_detail);
                if ($update_payment != false) {

                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                    );

                } else {
                    $result = array(
                        'status' => 'error',
                        'message' => 'Gagal menyimpan data ke database, silakan coba lagi!'
                    );
                }
                
            }

    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - update
	
	public function delete( $payment_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( 'payment/update' ) === true ) {
	         
            $this->load->model('Payment_model');
            $update_payment = $this->Payment_model->delete($payment_id);
            if ($update_payment != false) {

                $result = array(
                    'status' => 'success',
                    'message' => null,
        			'elapsed_time' => $this->benchmark->elapsed_time(),
                );

            } else {
                $result = array(
                    'status' => 'error',
                    'message' => 'Gagal menyimpan data ke database, silakan coba lagi!'
                );
            }
                
    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - delete
	
	public function total_payment()
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( $this->router->fetch_class() ) === true ) {
	        
            $date_start = $this->input->get('date_start');
            $date_start = ( empty($date_start) ) ? null : $date_start;

            $date_end = $this->input->get('date_end');
            $date_end = ( empty($date_end) ) ? null : $date_end;
    		    
    		$this->load->model('Payment_model');
    		$payment = $this->Payment_model->total_payment($date_start, $date_end);

    		// create result
    		$result = array(
    			'status' => 'success',
    			'message' => null,
    			'elapsed_time' => $this->benchmark->elapsed_time(),
    			'data' => $payment
    		);

    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - total_billed_amount
	
}
