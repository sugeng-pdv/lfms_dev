<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
    
	public function get_invoice()
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
            
            // $invoice_number as keyword
            $invoice_number = $this->input->get('invoice_number');
            if ( empty($invoice_number) ) {
                $invoice_number = null;
            }
            
            // invoice_date_range utk filter range tanggal kontrak
            $invoice_date_range = $this->input->get('invoice_date_range');
            if ( !empty($invoice_date_range) ) {
                $invoice_date = explode(" s.d. ",$invoice_date_range);
            }
            
            // due_date_range utk filter range tanggal jatuh tempo 
            $due_date_range = $this->input->get('due_date_range');
            if ( !empty($due_date_range) ) {
                $due_date = explode(" s.d. ",$due_date_range);
            }
            
            $this->load->model('Invoice_model');
            
            $num_of_data = $this->Invoice_model->count($invoice_number, ( !empty($invoice_date[0])) ? $invoice_date[0] : null, ( !empty($invoice_date[1])) ? $invoice_date[1] : null, ( !empty($due_date[0])) ? $due_date[0] : null, ( !empty($due_date[1])) ? $due_date[1] : null);
            $num_of_page = ceil($num_of_data/$per_page);
            
            $offset = ($page * $per_page) - $per_page;
    		$invoice = $this->Invoice_model->get( $per_page, $offset, $order_by=null, $invoice_number, ( !empty($invoice_date[0])) ? $invoice_date[0] : null, ( !empty($invoice_date[1])) ? $invoice_date[1] : null, ( !empty($due_date[0])) ? $due_date[0] : null, ( !empty($due_date[1])) ? $due_date[1] : null );
    		if ( !empty($invoice) ){
    		    $this->load->model('Contract_model');
    		    $this->load->model('Asset_model');
    		    $this->load->model('Tenant_model');
    		    $this->load->helper('iddate_helper');
    		    $i = $offset + 1; // $i = urutan
    		    foreach ( $invoice as $invoice ){
    		        $invoices[$i] = $invoice;
    		        $invoices[$i]->invoice_date_txt = convert_date($invoice->invoice_date);
    		        $invoices[$i]->due_date_txt = convert_date($invoice->due_date);
                    $invoices[$i]->billed_amount_txt = $invoice->currency .' '. number_format($invoice->billed_amount, 0, ',', '.');
                    $invoices[$i]->amount_paid_txt = $invoice->currency .' '. number_format($invoice->amount_paid, 0, ',', '.');
    		        
        		    $contract_detail = $this->Contract_model->detail($invoice->contract_id);
        		    $invoices[$i]->contract_number = ( !empty($contract_detail) ) ? $contract_detail->contract_number : 'N/A';
    		        
        		    $asset_detail = $this->Asset_model->asset_detail( ( !empty($contract_detail) ) ? $contract_detail->asset_id : null );
        		    $invoices[$i]->asset_name = ( !empty($asset_detail) ) ? $asset_detail->asset_name : 'N/A';
        		    $invoices[$i]->asset_code = ( !empty($asset_detail) ) ? $asset_detail->asset_code : 'N/A';
    		        
        		    $tenant_detail = $this->Tenant_model->detail( ( !empty($contract_detail) ) ? $contract_detail->tenant_id : null );
        		    $invoices[$i]->tenant_name = ( !empty($tenant_detail) ) ? $tenant_detail->name : 'N/A';

        		    // perhitungan sisa hari
                    $future = strtotime($invoice->due_date);
                    $timeleft = $future-time();
                    $daysleft = round((($timeleft/24)/60)/60); 
                    $invoices[$i]->day_left = $daysleft;


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
    				'data' => $invoices
    			);
    
    		}else{
    			// create result
    			$result = array(
    					'status' => 'error',
    					'message' => 'Tidak ditemukan data invoice.'
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
		
	} // end of - get_invoice
	
	public function invoice_detail( $invoice_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( $this->router->fetch_class() ) === true ) {
	         
	        $this->load->model('Invoice_model');
    		$invoice_detail = $this->Invoice_model->detail($invoice_id);
    		if ( !empty($invoice_detail) ){
    		    
    		    $invoice = (array) $invoice_detail; // typecast (konversi) dari object ke array
    		    
    		    $invoice['billed_amount_txt'] = $invoice_detail->currency .' '. number_format($invoice_detail->billed_amount, 0, ',', '.');
    		    
    		    $this->load->model('Contract_model');
    		    $this->load->model('Asset_model');
    		    $this->load->helper('iddate_helper');
    		    
        		$contract_detail = $this->Contract_model->detail($invoice_detail->contract_id);
        		$invoice['contract_number'] = ( !empty($contract_detail) ) ? $contract_detail->contract_number : 'N/A';
        		$invoice['contract_date_txt'] = ( !empty($contract_detail) ) ? convert_date($contract_detail->contract_date) : 'N/A';

        		$asset_detail = $this->Asset_model->asset_detail( ( !empty($contract_detail) ) ? $contract_detail->asset_id : null );
        		$invoice['asset_name'] = ( !empty($asset_detail) ) ? $asset_detail->asset_name : 'N/A';
        		$invoice['asset_code'] = ( !empty($asset_detail) ) ? $asset_detail->asset_code : 'N/A';
    		    
    			// create result
    			$result = array(
    				'status' => 'success',
    				'message' => null,
    				'elapsed_time' => $this->benchmark->elapsed_time(),
    				'data' => $invoice
    			);
    
    		}else{
    			// create result
    			$result = array(
    					'status' => 'error',
    					'message' => 'Data invoice tidak ditemukan.'
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
		
	} // end of - invoice_detail
	
	public function invoice_detail_by_number()
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( $this->router->fetch_class() ) === true ) {
	         
	        $this->load->model('Invoice_model');
	        $invoice_number = $this->input->post('invoice_number');
    		$invoice_detail = $this->Invoice_model->detail_by_number($invoice_number);
    		if ( !empty($invoice_detail) ){
    		    
    		    $invoice = (array) $invoice_detail; // typecast (konversi) dari object ke array
    		    
    		    $invoice['billed_amount_txt'] = $invoice_detail->currency .' '. number_format($invoice_detail->billed_amount, 0, ',', '.');
    		    
    		    $this->load->model('Contract_model');
    		    $this->load->model('Asset_model');
    		    $this->load->helper('iddate_helper');
    		    
        		$contract_detail = $this->Contract_model->detail($invoice_detail->contract_id);
        		$invoice['contract_number'] = ( !empty($contract_detail) ) ? $contract_detail->contract_number : 'N/A';
        		$invoice['contract_date_txt'] = ( !empty($contract_detail) ) ? convert_date($contract_detail->contract_date) : 'N/A';

        		$asset_detail = $this->Asset_model->asset_detail( ( !empty($contract_detail) ) ? $contract_detail->asset_id : null );
        		$invoice['asset_name'] = ( !empty($asset_detail) ) ? $asset_detail->asset_name : 'N/A';
        		$invoice['asset_code'] = ( !empty($asset_detail) ) ? $asset_detail->asset_code : 'N/A';
    		    
    			// create result
    			$result = array(
    				'status' => 'success',
    				'message' => null,
    				'elapsed_time' => $this->benchmark->elapsed_time(),
    				'data' => $invoice
    			);
    
    		}else{
    			// create result
    			$result = array(
    					'status' => 'error',
    					'message' => 'Data invoice tidak ditemukan.'
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
		
	} // end of - invoice_detail_by_number
   
	public function get_by_asset( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( 'ASSET_READ' ) === true ) {
	        
	        $this->load->model('Asset_model');
    		$asset_detail = $this->Asset_model->asset_detail($asset_id);
    		if ( !empty($asset_detail) ){
    		    
    		    $asset['id'] = $asset_detail->id;
    		    $asset['asset_code'] = $asset_detail->asset_code;
    		    $asset['asset_name'] = $asset_detail->asset_name;
    		    
    		    $this->load->model('Invoice_model');
    		    $invoice = $this->Invoice_model->get_by_asset($asset_detail->id);

        		if ( !empty($invoice) ){
        		    $this->load->model('Contract_model');
        		    $this->load->model('Asset_model');
        		    $this->load->model('Tenant_model');
        		    $this->load->helper('iddate_helper');
        		    $i = 1;
        		    foreach ( $invoice as $invoice ){
        		        $invoices[$i] = $invoice;
        		        $invoices[$i]->invoice_date_txt = convert_date($invoice->invoice_date);
        		        $invoices[$i]->due_date_txt = convert_date($invoice->due_date);
                        $invoices[$i]->billed_amount_txt = $invoice->currency.' '. number_format($invoice->billed_amount, 0, ',', '.');
                        $invoices[$i]->amount_paid_txt = $invoice->currency.' '. number_format($invoice->amount_paid, 0, ',', '.');
        		        
            		    $contract_detail = $this->Contract_model->detail($invoice->contract_id);
            		    $invoices[$i]->contract_number = ( !empty($contract_detail) ) ? $contract_detail->contract_number : 'N/A';
        		        
            		    $asset_detail = $this->Asset_model->asset_detail( ( !empty($contract_detail) ) ? $contract_detail->asset_id : null );
            		    $invoices[$i]->asset_name = ( !empty($asset_detail) ) ? $asset_detail->asset_name : 'N/A';
            		    $invoices[$i]->asset_code = ( !empty($asset_detail) ) ? $asset_detail->asset_code : 'N/A';
        		        
            		    $tenant_detail = $this->Tenant_model->detail( ( !empty($contract_detail) ) ? $contract_detail->tenant_id : null );
            		    $invoices[$i]->tenant_name = ( !empty($tenant_detail) ) ? $tenant_detail->name : 'N/A';
    
            		    // perhitungan sisa hari
                        $future = strtotime($invoice->due_date);
                        $timeleft = $future-time();
                        $daysleft = round((($timeleft/24)/60)/60); 
                        $invoices[$i]->day_left = $daysleft;
    
    
                        $i++;
        		    }
    
        			$asset['invoice'] = $invoices;
        			
        			// create result
        			$result = array(
        				'status' => 'success',
        				'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
        				'num_of_data' => count($asset['invoice']),
        				'num_of_page' => 1,
        				'current_page' => 1,
        				'data' => $asset
        			);
        		}else{
        			$result = array(
        					'status' => 'error',
        					'message' => 'Tidak ditemukan invoice untuk aset ini.'
        			);
        		}

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
    		    
    		    $this->load->model('Invoice_model');
    		    $invoice = $this->Invoice_model->get_by_contract($contract_detail->id);
                $asset['invoice'] = null;
        		if ( !empty($invoice) ){
        		    $this->load->model('Contract_model');
        		    $this->load->model('Asset_model');
        		    $this->load->model('Tenant_model');
        		    $this->load->helper('iddate_helper');
        		    $i = 1;
        		    foreach ( $invoice as $invoice ){
        		        $invoices[$i] = $invoice;
        		        $invoices[$i]->invoice_date_txt = convert_date($invoice->invoice_date);
        		        $invoices[$i]->due_date_txt = convert_date($invoice->due_date);
                        $invoices[$i]->billed_amount_txt = $invoice->currency  .' '. number_format($invoice->billed_amount, 0, ',', '.');
                        $invoices[$i]->amount_paid_txt = $invoice->currency  .' '. number_format($invoice->amount_paid, 0, ',', '.');
        		        
            		    $contract_detail = $this->Contract_model->detail($invoice->contract_id);
            		    $invoices[$i]->contract_number = ( !empty($contract_detail) ) ? $contract_detail->contract_number : 'N/A';
        		        
            		    $asset_detail = $this->Asset_model->asset_detail( ( !empty($contract_detail) ) ? $contract_detail->asset_id : null );
            		    $invoices[$i]->asset_name = ( !empty($asset_detail) ) ? $asset_detail->asset_name : 'N/A';
            		    $invoices[$i]->asset_code = ( !empty($asset_detail) ) ? $asset_detail->asset_code : 'N/A';
        		        
            		    $tenant_detail = $this->Tenant_model->detail( ( !empty($contract_detail) ) ? $contract_detail->tenant_id : null );
            		    $invoices[$i]->tenant_name = ( !empty($tenant_detail) ) ? $tenant_detail->name : 'N/A';
    
            		    // perhitungan sisa hari
                        $future = strtotime($invoice->due_date);
                        $timeleft = $future-time();
                        $daysleft = round((($timeleft/24)/60)/60); 
                        $invoices[$i]->day_left = $daysleft;
    
    
                        $i++;
        		    }
    
        			$asset['invoice'] = $invoices;
        			
        			// create result
        			$result = array(
        				'status' => 'success',
        				'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
        				'num_of_data' => count($asset['invoice']),
        				'num_of_page' => 1,
        				'current_page' => 1,
        				'data' => $asset
        			);
        		}else{
        			$result = array(
        					'status' => 'error',
        					'message' => 'Tidak ditemukan invoice untuk perjanjian (kontrak) ini.'
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
	
	public function get_by_payment_code($payment_code=null)
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( $this->router->fetch_class() ) === true ) {
	        
	        if ( empty($payment_code) ){
                $result = array(
                    'status' => 'error',
                    'message' => 'Kode pembayaran / virtual account harus diisi.'
                );
	        }else{
    		    $this->load->model('Invoice_model');
                $asset['invoice'] = null;
            	$invoice = $this->Invoice_model->get_by_payment_code($payment_code);
        		if ( !empty($invoice) ){
        		    $this->load->model('Contract_model');
        		    $this->load->model('Asset_model');
        		    $this->load->model('Tenant_model');
        		    $this->load->helper('iddate_helper');
        		    $i = 1;
        		    foreach ( $invoice as $invoice ){
        		        $invoices[$i] = $invoice;
        		        $invoices[$i]->invoice_date_txt = convert_date($invoice->invoice_date);
        		        $invoices[$i]->due_date_txt = convert_date($invoice->due_date);
                        $invoices[$i]->billed_amount_txt = $invoice->currency  .' '. number_format($invoice->billed_amount, 0, ',', '.');
                        $invoices[$i]->amount_paid_txt = $invoice->currency  .' '. number_format($invoice->amount_paid, 0, ',', '.');
        		        
            		    $contract_detail = $this->Contract_model->detail($invoice->contract_id);
            		    $invoices[$i]->contract_number = ( !empty($contract_detail) ) ? $contract_detail->contract_number : 'N/A';
        		        
            		    $asset_detail = $this->Asset_model->asset_detail( ( !empty($contract_detail) ) ? $contract_detail->asset_id : null );
            		    $invoices[$i]->asset_name = ( !empty($asset_detail) ) ? $asset_detail->asset_name : 'N/A';
            		    $invoices[$i]->asset_code = ( !empty($asset_detail) ) ? $asset_detail->asset_code : 'N/A';
        		        
            		    $tenant_detail = $this->Tenant_model->detail( ( !empty($contract_detail) ) ? $contract_detail->tenant_id : null );
            		    $invoices[$i]->tenant_name = ( !empty($tenant_detail) ) ? $tenant_detail->name : 'N/A';
    
            		    // perhitungan sisa hari
                        $future = strtotime($invoice->due_date);
                        $timeleft = $future-time();
                        $daysleft = round((($timeleft/24)/60)/60); 
                        $invoices[$i]->day_left = $daysleft;
    
    
                        $i++;
        		    }
    
        			$asset['invoice'] = $invoices;
        			
        			// create result
        			$result = array(
        				'status' => 'success',
        				'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
        				'num_of_data' => count($asset['invoice']),
        				'num_of_page' => 1,
        				'current_page' => 1,
        				'data' => $asset
        			);
        		}else{
        			$result = array(
        					'status' => 'error',
        					'message' => 'Tidak ditemukan invoice untuk perjanjian (kontrak) ini.'
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
		
	} // end of - get_by_payment_code

	public function create()
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/update' ) === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('contract_id', 'Nomor Perjanjian (Kontrak)', 'required|numeric');
            $this->form_validation->set_rules('invoice_number', 'Nomor Invoice', 'required');
            $this->form_validation->set_rules('due_date', 'Tanggal Jatuh Tempo', 'required|exact_length[10]');
            $this->form_validation->set_rules('billed_amount', 'Nilai Tagihan', 'required|numeric');
            $this->form_validation->set_rules('currency', 'Mata Uang', 'required|exact_length[3]');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $invoice_detail = array(
                    'contract_id' => $this->lman_security->clean_post('contract_id'),
                    'invoice_number' => $this->lman_security->clean_post('invoice_number'),
                    'due_date' => $this->lman_security->clean_post('due_date'),
                    'create_date' => date('Y-m-d H:i:s',time()),
                    'billed_amount' => $this->lman_security->clean_post('billed_amount'),
                    'currency' => $this->lman_security->clean_post('currency'),
                    'title' => $this->lman_security->clean_post('title'),
                    'payment_code' => $this->lman_security->clean_post('payment_code'),
                );
                
                $this->load->model('Invoice_model');
                $invoice_id = $this->Invoice_model->insert($invoice_detail);
                if ($invoice_id != false) {
                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'invoice_id' => $invoice_id,
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
		
	} // end of - create
	
	public function update( $invoice_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/update' ) === true ) {
	         
            $this->load->library('form_validation');
            $this->form_validation->set_rules('contract_id', 'Nomor Perjanjian (Kontrak)', 'required|numeric');
            $this->form_validation->set_rules('invoice_number', 'Nomor Invoice', 'required');
            $this->form_validation->set_rules('due_date', 'Tanggal Jatuh Tempo', 'required|exact_length[10]');
            $this->form_validation->set_rules('billed_amount', 'Nilai Tagihan', 'required|numeric');
            $this->form_validation->set_rules('currency', 'Mata Uang', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $invoice_detail = array(
                    'contract_id' => $this->lman_security->clean_post('contract_id'),
                    'invoice_number' => $this->lman_security->clean_post('invoice_number'),
                    'due_date' => $this->lman_security->clean_post('due_date'),
                    'billed_amount' => $this->lman_security->clean_post('billed_amount'),
                    'currency' => $this->lman_security->clean_post('currency'),
                    'title' => $this->lman_security->clean_post('title'),
                    'payment_code' => $this->lman_security->clean_post('payment_code'),
                );
                
                $this->load->model('Invoice_model');
                $update_invoice = $this->Invoice_model->update($invoice_id, $invoice_detail);
                if ($update_invoice != false) {

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
	
	public function issue( $invoice_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/'.$this->router->fetch_method() ) === true ) {
	        
            $this->load->library('form_validation');
            $this->form_validation->set_rules('invoice_date', 'Tanggal Invoice', 'required|exact_length[10]');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {
	         
                $this->load->model('Invoice_model');
                $update_invoice = $this->Invoice_model->update($invoice_id, array('status'=>'ISSUED','invoice_date'=>$this->lman_security->clean_post('invoice_date')));
                if ($update_invoice != false) {
    
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
		
	} // end of - issue
	
	public function delete( $invoice_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/'.$this->router->fetch_method() ) === true ) {
	         
            $this->load->model('Invoice_model');
            $update_invoice = $this->Invoice_model->update($invoice_id, array('status'=>'DELETED'));
            if ($update_invoice != false) {

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
	
	// total_billed_amount - untuk menghitung total tagihan yang telah dibuat. bisa dibilang ini adalah total pendapatan accrual based
	public function total_billed_amount()
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( $this->router->fetch_class() ) === true ) {
	        
            $date_start = $this->input->get('date_start');
            $date_start = ( empty($date_start) ) ? null : $date_start;

            $date_end = $this->input->get('date_end');
            $date_end = ( empty($date_end) ) ? null : $date_end;
            
            $asset_id = $this->input->get('asset_id');
            $asset_id = ( empty($asset_id) ) ? null : $asset_id;
    		    
    		$this->load->model('Invoice_model');
    		$total_billed_amount = $this->Invoice_model->total_billed_amount($date_start, $date_end, $asset_id);

    		// create result
    		$result = array(
    			'status' => 'success',
    			'message' => null,
    			'elapsed_time' => $this->benchmark->elapsed_time(),
    			'data' => $total_billed_amount
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
} // akhir - class