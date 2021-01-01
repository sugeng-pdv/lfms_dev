<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contract extends CI_Controller {
   
	public function get_contract()
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( $this->router->fetch_class() ) === true ) {
	    //$this->output->enable_profiler(true);
	    //if ( true === true ) {
	         
            // page
            $page = intval($this->input->get('page',true));
            if (empty($page) OR is_numeric($page) !== true) {
                $page = 1;
            }
    
            // per page
            $per_page = intval($this->input->get('per_page',true));
            if (empty($per_page) OR is_numeric($per_page) !== true) {
                $per_page = 10;
            }
            
            // $contract_number as keyword
            $contract_number = $this->input->get('contract_number');
            if ( empty($contract_number) ) {
                $contract_number = null;
            }
            
            // contract_date_range utk filter range tanggal kontrak
            $contract_date_range = $this->input->get('contract_date_range');
            if ( !empty($contract_date_range) ) {
                $contract_date = explode(" s.d. ",$contract_date_range);
            }
            
            // due_date_range utk filter range tanggal jatuh tempo 
            $due_date_range = $this->input->get('due_date_range');
            if ( !empty($due_date_range) ) {
                $due_date = explode(" s.d. ",$due_date_range);
            }
            
            $this->load->model('Contract_model');
            
            $num_of_data = $this->Contract_model->count($contract_number, ( !empty($contract_date[0])) ? $contract_date[0] : null, ( !empty($contract_date[1])) ? $contract_date[1] : null, ( !empty($due_date[0])) ? $due_date[0] : null, ( !empty($due_date[1])) ? $due_date[1] : null);
            $num_of_page = ceil($num_of_data/$per_page);
            
            $offset = ($page * $per_page) - $per_page;
    		$contract = $this->Contract_model->get( $limit='20', $offset='0', $order_by=null, $contract_number, ( !empty($contract_date[0])) ? $contract_date[0] : null, ( !empty($contract_date[1])) ? $contract_date[1] : null, ( !empty($due_date[0])) ? $due_date[0] : null, ( !empty($due_date[1])) ? $due_date[1] : null );
    		if ( !empty($contract) ){
    		    $this->load->model('Asset_model');
    		    $this->load->model('Tenant_model');
    		    $this->load->helper('iddate_helper');
    		    $i = $offset + 1; // $i = urutan
    		    foreach ( $contract as $contract ){
    		        $contracts[$i]['id'] = $contract->id;
    		        $contracts[$i]['contract_number'] = $contract->contract_number;
    		        $contracts[$i]['contract_date'] = $contract->contract_date;
    		        $contracts[$i]['contract_date_txt'] = convert_date($contract->contract_date);
    		        $contracts[$i]['start_date'] = $contract->start_date;
    		        $contracts[$i]['start_date_txt'] = convert_date($contract->start_date);
    		        $contracts[$i]['due_date'] = $contract->due_date;
    		        $contracts[$i]['due_date_txt'] = convert_date($contract->due_date);
        		    $asset_detail = $this->Asset_model->asset_detail($contract->asset_id);
        		    $contracts[$i]['asset_name'] = ( !empty($asset_detail) ) ? $asset_detail->asset_name : 'N/A';
        		    $tenant_detail = $this->Tenant_model->detail($contract->tenant_id);
        		    $contracts[$i]['tenant'] = ( !empty($tenant_detail) ) ? $tenant_detail : null;
        		    
                    // dokumen
                    $contracts[$i]['document'] = null;
                    $doc = $this->Contract_model->get_document($contract->id);
                    if ( !empty($doc) ){
                        foreach ( $doc as $iDoc => $doc ){
                            $contracts[$i]['document'][$iDoc]['id'] = $doc->id;
                            $contracts[$i]['document'][$iDoc]['name'] = $doc->doc_name;
                            $contracts[$i]['document'][$iDoc]['url'] = $this->config->item('view_file_url').$doc->s3_object;
                        }
                    }

        		    // perhitungan sisa hari
                    $future = strtotime($contract->due_date);
                    $timeleft = $future-time();
                    $totaltime = $future - strtotime($contract->start_date);
                    $daysleft = round((($timeleft/24)/60)/60); 
                    $totalday = round((($totaltime/24)/60)/60); 
                    $contracts[$i]['day_left'] = $daysleft;
                    $contracts[$i]['day_total'] = $totalday;
                    $contracts[$i]['day_percentage'] = round( (($totalday-$daysleft)/$totalday)*100, 2);


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
    				'data' => $contracts
    			);
    
    		}else{
    			// create result
    			$result = array(
    					'status' => 'error',
    					'message' => 'Tidak ditemukan data kontrak.'
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
		
	} // end of - get_contract
	
	public function contract_detail( $contract_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( $this->router->fetch_class() ) === true ) {
	         
	        $this->load->model('Contract_model');
    		$contract_detail = $this->Contract_model->detail($contract_id);
    		if ( !empty($contract_detail) ){
    		    
    		    $contract = (array) $contract_detail; // typecast (konversi) dari object ke array
    		    
    		    $this->load->model('Asset_model');
    		    
    		    $asset_detail = $this->Asset_model->asset_detail($contract_detail->asset_id);
    		    
    		    $contract['asset_code'] = ( !empty($asset_detail) ) ? $asset_detail->asset_code : null;
    		    $contract['asset_name'] = ( !empty($asset_detail) ) ? $asset_detail->asset_name : null;
                
                // mitra / tenant
    		    $this->load->model('Tenant_model');
    		    $tenant = $this->Tenant_model->detail($contract_detail->tenant_id);
    		    $contract['tenant'] = null;
    		    if ( !empty($tenant) ){
    		        $contract['tenant']['id'] = $tenant->id;
    		        $contract['tenant']['name'] = $tenant->name;
    		        $contract['tenant']['email'] = $tenant->email;
    		        $contract['tenant']['phone'] = $tenant->phone;
    		        $contract['tenant']['phone_alternative'] = $tenant->phone_alternative;
    		        $contract['tenant']['address'] = $tenant->address;
    		        $contract['tenant']['province_id'] = $tenant->province_id;
        		    $this->load->model('Location_model');
        		    $province_detail = $this->Location_model->province_detail($tenant->province_id);
        		    $contract['tenant']['province'] = ( !empty($province_detail) ) ? str_replace('Dki','DKI',ucwords(strtolower($province_detail->name))) : 'N/A';
    		        $contract['tenant']['city_id'] = $tenant->city_id;
        		    $city_detail = $this->Location_model->city_detail($tenant->city_id);
        		    $contract['tenant']['city'] = ( !empty($city_detail) ) ? ucwords(strtolower($city_detail->name)) : 'N/A';
    		        $contract['tenant']['npwp'] = $tenant->npwp;
    		        $contract['tenant']['field_of_work'] = $tenant->field_of_work;
    		    }
    		    
    		    // dokumen
                $contract['document'] = null;
                $doc = $this->Contract_model->get_document($contract_id);
                if ( !empty($doc) ){
                    unset($document);
                    foreach ( $doc as $iDoc => $doc ){
                        $document[$iDoc]['id'] = $doc->id;
                        $document[$iDoc]['name'] = $doc->doc_name;
                        $document[$iDoc]['url'] = $this->config->item('view_file_url').$doc->s3_object;
                    }
                    $contract['document'] = $document;
                }

    			// create result
    			$result = array(
    				'status' => 'success',
    				'message' => null,
    				'elapsed_time' => $this->benchmark->elapsed_time(),
    				'data' => $contract
    			);
    
    		}else{
    			// create result
    			$result = array(
    					'status' => 'error',
    					'message' => 'Data aset kosong.'
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
		
	} // end of - contract_detail
    
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
    		    
    		    $this->load->model('Contract_model');
    		    $contract = $this->Contract_model->get_by_asset($asset_id);

        		if ( !empty($contract) ){
        		    $this->load->model('Asset_model');
        		    $this->load->model('Tenant_model');
        		    $this->load->helper('iddate_helper');
        		    $i = 1; // $i = urutan
        		    foreach ( $contract as $contract ){
        		        $contracts[$i]['id'] = $contract->id;
        		        $contracts[$i]['contract_number'] = $contract->contract_number;
        		        $contracts[$i]['contract_date'] = $contract->contract_date;
        		        $contracts[$i]['contract_date_txt'] = convert_date($contract->contract_date);
        		        $contracts[$i]['status'] = $contract->status;
        		        $contracts[$i]['start_date'] = $contract->start_date;
        		        $contracts[$i]['start_date_txt'] = convert_date($contract->start_date);
        		        $contracts[$i]['due_date'] = $contract->due_date;
        		        $contracts[$i]['due_date_txt'] = convert_date($contract->due_date);
            		    $asset_detail = $this->Asset_model->asset_detail($contract->asset_id);
            		    $contracts[$i]['asset_name'] = ( !empty($asset_detail) ) ? $asset_detail->asset_name : 'N/A';
            		    $tenant_detail = $this->Tenant_model->detail($contract->tenant_id);
            		    $contracts[$i]['tenant'] = ( !empty($tenant_detail) ) ? $tenant_detail : null;
            		    
                        // dokumen
                        $contracts[$i]['document'] = null;
                        $doc = $this->Contract_model->get_document($contract->id);
                        if ( !empty($doc) ){
                            foreach ( $doc as $iDoc => $doc ){
                                $contracts[$i]['document'][$iDoc]['id'] = $doc->id;
                                $contracts[$i]['document'][$iDoc]['name'] = $doc->doc_name;
                                $contracts[$i]['document'][$iDoc]['url'] = $this->config->item('view_file_url').$doc->s3_object;
                            }
                        }
    
            		    // perhitungan sisa hari
                        $future = strtotime($contract->due_date);
                        $timeleft = $future-time();
                        $totaltime = $future - strtotime($contract->start_date);
                        $daysleft = round((($timeleft/24)/60)/60); 
                        $totalday = round((($totaltime/24)/60)/60); 
                        $contracts[$i]['day_left'] = $daysleft;
                        $contracts[$i]['day_total'] = $totalday;
                        $contracts[$i]['day_percentage'] = round( (($totalday-$daysleft)/$totalday)*100, 2);
    
    
                        $i++;
        		    }
    
        			// create result
        			$result = array(
        				'status' => 'success',
        				'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
        				'data' => $contracts
        			);
        
        		}else{
        			// create result
        			$result = array(
        					'status' => 'error',
        					'message' => 'Tidak ditemukan data kontrak untuk aset ini.'
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

	public function add_contract()
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/update' ) === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('asset_id', 'Aset', 'required|numeric');
            $this->form_validation->set_rules('contract_number', 'Nomor Perjanjian', 'required');
            $this->form_validation->set_rules('contract_date', 'Tanggal Perjanjian', 'required|exact_length[10]');
            $this->form_validation->set_rules('contract_value', 'Nilai Kontrak (KSO)', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_rules('utilization_scope', 'Peruntukan', 'required');
            $this->form_validation->set_rules('start_date', 'Mulai Berlakunya Kontrak', 'required|exact_length[10]');
            $this->form_validation->set_rules('due_date', 'Tanggal Kontrak Berakhir', 'required|exact_length[10]');
            //$this->form_validation->set_rules('time_period', 'Jangka Waktu', 'required|numeric');
            //$this->form_validation->set_rules('unit_of_time_period', 'Satuan Waktu', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $contract_detail = array(
                    'contract_number' => $this->lman_security->clean_post('contract_number'),
                    'contract_date' => $this->lman_security->clean_post('contract_date'),
                    'status' => $this->lman_security->clean_post('status'),
                    'asset_id' => $this->lman_security->clean_post('asset_id'),
                    'space_id' => $this->lman_security->clean_post('space_id'),
                    'tenant_id' => $this->lman_security->clean_post('tenant_id'),
                    'utilization_scope' => $this->lman_security->clean_post('utilization_scope'),
                    'start_date' => $this->lman_security->clean_post('start_date'),
                    'due_date' => $this->lman_security->clean_post('due_date'),
                    //'time_period' => $this->lman_security->clean_post('time_period'),
                    //'unit_of_time_period' => $this->lman_security->clean_post('unit_of_time_period'),
                    'contract_value' => $this->lman_security->clean_post('contract_value'),
                    'previous_contract' => $this->lman_security->clean_post('previous_contract'),
                );
                
                $this->load->model('Contract_model');
                $contract_id = $this->Contract_model->insert($contract_detail);
                if ($contract_id != false) {
                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'contract_id' => $contract_id,
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
		
	} // end of - add_contract
	
	public function update_contract( $contract_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/update' ) === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('asset_id', 'Aset', 'required|numeric');
            $this->form_validation->set_rules('contract_number', 'Nomor Perjanjian', 'required');
            $this->form_validation->set_rules('contract_date', 'Tanggal Perjanjian', 'required|exact_length[10]');
            $this->form_validation->set_rules('contract_value', 'Nilai Kontrak (KSO)', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_rules('utilization_scope', 'Peruntukan', 'required');
            $this->form_validation->set_rules('start_date', 'Mulai Berlakunya Kontrak', 'required|exact_length[10]');
            $this->form_validation->set_rules('due_date', 'Tanggal Kontrak Berakhir', 'required|exact_length[10]');
            //$this->form_validation->set_rules('time_period', 'Jangka Waktu', 'required|numeric');
            //$this->form_validation->set_rules('unit_of_time_period', 'Satuan Waktu', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $contract_detail = array(
                    'contract_number' => $this->lman_security->clean_post('contract_number'),
                    'contract_date' => $this->lman_security->clean_post('contract_date'),
                    'status' => $this->lman_security->clean_post('status'),
                    'asset_id' => $this->lman_security->clean_post('asset_id'),
                    'space_id' => $this->lman_security->clean_post('space_id'),
                    'utilization_scope' => $this->lman_security->clean_post('utilization_scope'),
                    'start_date' => $this->lman_security->clean_post('start_date'),
                    'due_date' => $this->lman_security->clean_post('due_date'),
                    'contract_value' => $this->lman_security->clean_post('contract_value'),
                    'previous_contract' => $this->lman_security->clean_post('previous_contract'),
                );
                
                $this->load->model('Contract_model');
                $update_contract = $this->Contract_model->update($contract_id, $contract_detail);
                if ($update_contract != false) {

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
		
	} // end of - update_contract
	
	public function update_tenant( $contract_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/update' ) === true ) {
	        
	        $new_tenant = $this->input->post('new_tenant',true);
	        
	        // jika ada inputan tenant baru
	        if ( $new_tenant == '1' ){
                // start form validations
                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'Nama Mitra', 'required');
                $this->form_validation->set_rules('phone', 'Telepon', 'required|numeric');
                $this->form_validation->set_rules('address', 'Alamat', 'required');
                $this->form_validation->set_rules('province', 'Alamat (Provinsi)', 'required|numeric');
                $this->form_validation->set_rules('city', 'Alamat (Kota)', 'required|numeric');
                $this->form_validation->set_error_delimiters("", "\r\n");
    
                // if validations returns FALSE statement
                if ($this->form_validation->run() == FALSE) {
                    $result = array(
                        'status' => 'error',
                        'message' => validation_errors()
                    );
                } else {
                    // insert tenant ke DB   
                    $this->load->model('Tenant_model');
                    
                    $tenant_detail = array(
                        'name' => $this->lman_security->clean_post('name'),
                        'email' => $this->lman_security->clean_post('email'),
                        'phone' => $this->lman_security->clean_post('phone'),
                        'phone_alternative' => $this->lman_security->clean_post('phone_alternative'),
                        'address' => $this->lman_security->clean_post('address'),
                        'province_id' => $this->lman_security->clean_post('province'),
                        'city_id' => $this->lman_security->clean_post('city'),
                        'npwp' => $this->lman_security->clean_post('npwp'),
                        'field_of_work' => $this->lman_security->clean_post('field_of_work'),
                    );
                    
                    $tenant_id = $this->Tenant_model->insert($tenant_detail);
                }
	        }else{ // jika memilih dari tenant eksisting
                // start form validations
                $this->load->library('form_validation');
                $this->form_validation->set_rules('tenant_id', 'Mitra', 'required|numeric');
                $this->form_validation->set_error_delimiters("", "\r\n");
    
                // if validations returns FALSE statement
                if ($this->form_validation->run() == FALSE) {
                    $result = array(
                        'status' => 'error',
                        'message' => validation_errors()
                    );
                } else {
                    $tenant_id = $this->lman_security->clean_post('tenant_id');
                }
	        }
	         
            if ( !empty($tenant_id) ) {
                
                $contract_detail = array(
                    'tenant_id' => $tenant_id,
                );
                
                $this->load->model('Contract_model');
                $update_contract = $this->Contract_model->update($contract_id, $contract_detail);
                if ($update_contract != false) {

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
		
	} // end of - update_tenant
	
	public function remove_tenant( $contract_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/update' ) === true ) {
	        
            $this->load->model('Contract_model');
            $update_contract = $this->Contract_model->update($contract_id, array('tenant_id'=>null));
            if ($update_contract != false) {
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
		
	} // end of - remove_tenant
	
	public function update_tenant_data( $tenant_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/update' ) === true ) {
	        
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Nama Mitra', 'required');
            $this->form_validation->set_rules('phone', 'Telepon', 'required|numeric');
            $this->form_validation->set_rules('address', 'Alamat', 'required');
            $this->form_validation->set_rules('province', 'Alamat (Provinsi)', 'required|numeric');
            $this->form_validation->set_rules('city', 'Alamat (Kota)', 'required|numeric');
            $this->form_validation->set_error_delimiters("", "\r\n");
    
            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {
                // insert tenant ke DB   
                $this->load->model('Tenant_model');
                    
                $tenant_detail = array(
                    'name' => $this->lman_security->clean_post('name'),
                    'email' => $this->lman_security->clean_post('email'),
                    'phone' => $this->lman_security->clean_post('phone'),
                    'phone_alternative' => $this->lman_security->clean_post('phone_alternative'),
                    'address' => $this->lman_security->clean_post('address'),
                    'province_id' => $this->lman_security->clean_post('province'),
                    'city_id' => $this->lman_security->clean_post('city'),
                    'npwp' => $this->lman_security->clean_post('npwp'),
                    'field_of_work' => $this->lman_security->clean_post('field_of_work'),
                );
                    
                $tenant_update = $this->Tenant_model->update($tenant_id, $tenant_detail);
                
                if ( $tenant_update === true ) {
                    
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
		
	} // end of - update_contract
	
	public function add_document( $contract_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/update' ) === true ) {
	         
            $this->load->library('form_validation');
            $this->form_validation->set_rules('doc_name', 'Nama Dokumen', 'required');
            $this->form_validation->set_rules('s3_bucket', 's3_bucket', 'required');
            $this->form_validation->set_rules('s3_object', 's3_object', 'required');

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $document_detail = array(
                    'contract_id' => $contract_id,
                    'doc_name' => $this->lman_security->clean_post('doc_name'),
                    's3_bucket' => $this->lman_security->clean_post('s3_bucket'),
                    's3_object' => $this->lman_security->clean_post('s3_object'),
                );
                
                $this->load->model('Contract_model');
                $document_id = $this->Contract_model->insert_document($document_detail);
                if ($document_id != false) {

                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'id' => $document_id,
                        'name' => $document_detail['doc_name'],
                        'url' => $this->config->item('view_file_url').$document_detail['s3_object'],
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
		
	} // end of - add_document
	
	public function delete_document( $document_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/update' ) === true ) {
	         
            $this->load->model('Contract_model');
            $delete_document = $this->Contract_model->delete_document( $document_id );
            if ( $delete_document != false ) {

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
		
	} // end of - delete_document
	
    // search_tenant
	public function search_tenant()
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( $this->router->fetch_class() ) === true ) {
	        
	        $this->load->model('Tenant_model');
	        $keyword = $this->input->post('keyword', true);
    		$search_result = $this->Tenant_model->search( $keyword );
    		if ( !empty($search_result) ){
    		    
    		    foreach( $search_result as $tenant_detail ){
    		        $tenant[$tenant_detail->id]['id'] = $tenant_detail->id;
    		        $tenant[$tenant_detail->id]['name'] = $tenant_detail->name;
    		        $tenant[$tenant_detail->id]['address'] = $tenant_detail->address;
    		    }

    			// create result
    			$result = array(
    				'status' => 'success',
    				'message' => null,
    				'elapsed_time' => $this->benchmark->elapsed_time(),
    				'data' => $tenant
    			);
    
    		}else{
    			// create result
    			$result = array(
    					'status' => 'error',
    					'message' => 'Data tenant dengan kata kunci tersebut tidak ditemukan.'
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
		
	} // end of - check_asset_code
	
	public function check_contract_number()
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('ASSET_READ') === true ) {
	        
	        $contract_number = $this->input->post('contract_number');
	        
	        $this->load->model('Contract_model');
	        $this->load->model('Asset_model');
	        $this->load->model('Tenant_model');
    		$this->load->helper('iddate_helper');
	        
    		$contract_detail = $this->Contract_model->detail_by_contract_number($contract_number);
    		if ( !empty($contract_detail) ){
    		    
    		    $asset['id'] = $contract_detail->id;
    		    $asset['contract_number'] = $contract_detail->contract_number;
    		    $asset['contract_date_txt'] = convert_date($contract_detail->contract_date);
    		    
        		$asset_detail = $this->Asset_model->asset_detail( ( !empty($contract_detail) ) ? $contract_detail->asset_id : null );
        		$asset['asset_name'] = ( !empty($asset_detail) ) ? $asset_detail->asset_name : 'N/A';
        		$asset['asset_code'] = ( !empty($asset_detail) ) ? $asset_detail->asset_code : 'N/A';
    		        
        		$tenant_detail = $this->Tenant_model->detail( ( !empty($contract_detail) ) ? $contract_detail->tenant_id : null );
        		$asset['tenant_name'] = ( !empty($tenant_detail) ) ? $tenant_detail->name : 'N/A';

    			// create result
    			$result = array(
    				'status' => 'success',
    				'message' => null,
    				'elapsed_time' => $this->benchmark->elapsed_time(),
    				'data' => $asset
    			);
    
    		}else{
    			// create result
    			$result = array(
    					'status' => 'error',
    					'message' => 'Data perjanjian tidak ditemukan.'
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
		
	} // end of - check_asset_code
	
}
