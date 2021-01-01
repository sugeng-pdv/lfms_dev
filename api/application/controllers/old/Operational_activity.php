<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operational_activity extends CI_Controller {
    
    /** PENGAMANAN **/
	public function get_security( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted('ASSET_READ') === true ) {
	        
	        $this->load->model('Asset_model');
    		$asset_detail = $this->Asset_model->asset_detail($asset_id);
    		if ( !empty($asset_detail) ){
    		    
    		    $asset['id'] = $asset_detail->id;
    		    $asset['asset_code'] = $asset_detail->asset_code;
    		    $asset['asset_name'] = $asset_detail->asset_name;
    		    
    		    $this->load->model('Operational_activity_model');
    		    $security = $this->Operational_activity_model->get_activity($asset_detail->id,1);
                $asset['security'] = null;
                if ( !empty($security) ){
                    $this->load->helper('iddate_helper');
                    foreach ( $security as $i => $security ){
                        // custom date
                        $security->date_txt = convert_date($security->date);
                        $security->cost_txt = 'Rp. ' . number_format($security->cost, 0, ',', '.');
                        
                        // dokumen
                        $security->document = null;
                        $doc = $this->Operational_activity_model->get_document($security->id);
                        if ( !empty($doc) ){
                            unset($document);
                            foreach ( $doc as $iDoc => $doc ){
                                $document[$iDoc]['id'] = $doc->id;
                                $document[$iDoc]['name'] = $doc->doc_name;
                                $document[$iDoc]['url'] = $this->config->item('view_file_url').$doc->s3_object;
                            }
                            $security->document = $document;
                        }

                        $asset['security'][$i] = $security;
                    }
                }
                
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
		
	} // end of - get_security

	public function add_security( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('operational_activity/security') === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('date', 'Tanggal', 'required|exact_length[10]');
            $this->form_validation->set_rules('by', 'Pelaksana Kegiatan', 'required|max_length[255]');
            $this->form_validation->set_rules('status', 'Status Pekerjaan/Kegiatan', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $activity_detail = array(
                    'asset_id' => $asset_id,
                    'type' => 1, // pengamanan
                    'date' => $this->lman_security->clean_post('date'),
                    'by' => $this->lman_security->clean_post('by'),
                    'name' => $this->lman_security->clean_post('name'),
                    'object' => $this->lman_security->clean_post('object'),
                    'cost' => $this->lman_security->clean_post('cost'),
                    'status' => $this->lman_security->clean_post('status'),
                    'notes' => $this->lman_security->clean_post('notes'),
                );
                
                $this->load->model('Operational_activity_model');
                $activity_id = $this->Operational_activity_model->insert_activity($activity_detail);
                if ($activity_id != false) {

                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'activity_id' => $activity_id,
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
		
	} // end of - add_security
	
	public function update_security( $activity_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('operational_activity/security') === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('date', 'Tanggal', 'required|exact_length[10]');
            $this->form_validation->set_rules('by', 'Pelaksana Kegiatan', 'required|max_length[255]');
            $this->form_validation->set_rules('status', 'Status Pekerjaan/Kegiatan', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $activity_detail = array(
                    'date' => $this->lman_security->clean_post('date'),
                    'by' => $this->lman_security->clean_post('by'),
                    'name' => $this->lman_security->clean_post('name'),
                    'object' => $this->lman_security->clean_post('object'),
                    'cost' => $this->lman_security->clean_post('cost'),
                    'status' => $this->lman_security->clean_post('status'),
                    'notes' => $this->lman_security->clean_post('notes'),
                );
                
                $this->load->model('Operational_activity_model');
                $update_activity = $this->Operational_activity_model->update_activity($activity_id, $activity_detail);
                if ($update_activity != false) {

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
		
	} // end of - update_security
	
	/** KONSTRUKSI **/
	public function get_construction( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted('ASSET_READ') === true ) {
	        
	        $this->load->model('Asset_model');
    		$asset_detail = $this->Asset_model->asset_detail($asset_id);
    		if ( !empty($asset_detail) ){
    		    
    		    $asset['id'] = $asset_detail->id;
    		    $asset['asset_code'] = $asset_detail->asset_code;
    		    $asset['asset_name'] = $asset_detail->asset_name;
    		    
    		    $this->load->model('Operational_activity_model');
    		    $construction = $this->Operational_activity_model->get_activity($asset_detail->id,2);
                $asset['construction'] = null;
                if ( !empty($construction) ){
                    $this->load->helper('iddate_helper');
                    foreach ( $construction as $i => $construction ){
                        // custom date
                        $construction->date_txt = convert_date($construction->date);
                        $construction->cost_txt = 'Rp. ' . number_format($construction->cost, 0, ',', '.');
                        // dokumen
                        $construction->document = null;
                        $doc = $this->Operational_activity_model->get_document($construction->id);
                        if ( !empty($doc) ){
                            unset($document);
                            foreach ( $doc as $iDoc => $doc ){
                                $document[$iDoc]['id'] = $doc->id;
                                $document[$iDoc]['name'] = $doc->doc_name;
                                $document[$iDoc]['url'] = $this->config->item('view_file_url').$doc->s3_object;
                            }
                            $construction->document = $document;
                        }

                        $asset['construction'][$i] = $construction;
                    }
                }
                
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
		
	} // end of - get_construction
	
	public function add_construction( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('operational_activity/construction') === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('date', 'Tanggal', 'required|exact_length[10]');
            $this->form_validation->set_rules('by', 'Pelaksana Kegiatan', 'required|max_length[255]');
            $this->form_validation->set_rules('status', 'Status Pekerjaan/Kegiatan', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $activity_detail = array(
                    'asset_id' => $asset_id,
                    'type' => 2, // konstruksi
                    'date' => $this->lman_security->clean_post('date'),
                    'by' => $this->lman_security->clean_post('by'),
                    'name' => $this->lman_security->clean_post('name'),
                    'object' => $this->lman_security->clean_post('object'),
                    'cost' => $this->lman_security->clean_post('cost'),
                    'status' => $this->lman_security->clean_post('status'),
                    'notes' => $this->lman_security->clean_post('notes'),
                );
                
                $this->load->model('Operational_activity_model');
                $activity_id = $this->Operational_activity_model->insert_activity($activity_detail);
                if ($activity_id != false) {

                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'activity_id' => $activity_id,
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
		
	} // end of - add_construction
	
	public function update_construction( $activity_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('operational_activity/construction') === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('date', 'Tanggal', 'required|exact_length[10]');
            $this->form_validation->set_rules('by', 'Pelaksana Kegiatan', 'required|max_length[255]');
            $this->form_validation->set_rules('status', 'Status Pekerjaan/Kegiatan', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $activity_detail = array(
                    'date' => $this->lman_security->clean_post('date'),
                    'by' => $this->lman_security->clean_post('by'),
                    'name' => $this->lman_security->clean_post('name'),
                    'object' => $this->lman_security->clean_post('object'),
                    'cost' => $this->lman_security->clean_post('cost'),
                    'status' => $this->lman_security->clean_post('status'),
                    'notes' => $this->lman_security->clean_post('notes'),
                );
                
                $this->load->model('Operational_activity_model');
                $update_activity = $this->Operational_activity_model->update_activity($activity_id, $activity_detail);
                if ($update_activity != false) {

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
		
	} // end of - update_construction
	
	/** PEMELIHARAAN **/
	public function get_maintenance( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted('ASSET_READ') === true ) {
	        
	        $this->load->model('Asset_model');
    		$asset_detail = $this->Asset_model->asset_detail($asset_id);
    		if ( !empty($asset_detail) ){
    		    
    		    $asset['id'] = $asset_detail->id;
    		    $asset['asset_code'] = $asset_detail->asset_code;
    		    $asset['asset_name'] = $asset_detail->asset_name;
    		    
    		    $this->load->model('Operational_activity_model');
    		    $maintenance = $this->Operational_activity_model->get_activity($asset_detail->id,3);
                $asset['maintenance'] = null;
                if ( !empty($maintenance) ){
                    $this->load->helper('iddate_helper');
                    foreach ( $maintenance as $i => $maintenance ){
                        // custom date
                        $maintenance->date_txt = convert_date($maintenance->date);
                        $maintenance->cost_txt = 'Rp. ' . number_format($maintenance->cost, 0, ',', '.');
                        // dokumen
                        $maintenance->document = null;
                        $doc = $this->Operational_activity_model->get_document($maintenance->id);
                        if ( !empty($doc) ){
                            unset($document);
                            foreach ( $doc as $iDoc => $doc ){
                                $document[$iDoc]['id'] = $doc->id;
                                $document[$iDoc]['name'] = $doc->doc_name;
                                $document[$iDoc]['url'] = $this->config->item('view_file_url').$doc->s3_object;
                            }
                            $maintenance->document = $document;
                        }

                        $asset['maintenance'][$i] = $maintenance;
                    }
                }
                
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
		
	} // end of - get_maintenance
	
	public function add_maintenance( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('operational_activity/maintenance') === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('date', 'Tanggal', 'required|exact_length[10]');
            $this->form_validation->set_rules('by', 'Pelaksana Kegiatan', 'required|max_length[255]');
            $this->form_validation->set_rules('status', 'Status Pekerjaan/Kegiatan', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $activity_detail = array(
                    'asset_id' => $asset_id,
                    'type' => 3, // pemeliharaan
                    'date' => $this->lman_security->clean_post('date'),
                    'by' => $this->lman_security->clean_post('by'),
                    'name' => $this->lman_security->clean_post('name'),
                    'object' => $this->lman_security->clean_post('object'),
                    'cost' => $this->lman_security->clean_post('cost'),
                    'status' => $this->lman_security->clean_post('status'),
                    'notes' => $this->lman_security->clean_post('notes'),
                );
                
                $this->load->model('Operational_activity_model');
                $activity_id = $this->Operational_activity_model->insert_activity($activity_detail);
                if ($activity_id != false) {

                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'activity_id' => $activity_id,
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
		
	} // end of - add_maintenance
	
	public function update_maintenance( $activity_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('operational_activity/maintenance') === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('date', 'Tanggal', 'required|exact_length[10]');
            $this->form_validation->set_rules('by', 'Pelaksana Kegiatan', 'required|max_length[255]');
            $this->form_validation->set_rules('status', 'Status Pekerjaan/Kegiatan', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $activity_detail = array(
                    'date' => $this->lman_security->clean_post('date'),
                    'by' => $this->lman_security->clean_post('by'),
                    'name' => $this->lman_security->clean_post('name'),
                    'object' => $this->lman_security->clean_post('object'),
                    'cost' => $this->lman_security->clean_post('cost'),
                    'status' => $this->lman_security->clean_post('status'),
                    'notes' => $this->lman_security->clean_post('notes'),
                );
                
                $this->load->model('Operational_activity_model');
                $update_activity = $this->Operational_activity_model->update_activity($activity_id, $activity_detail);
                if ($update_activity != false) {

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
		
	} // end of - update_maintenance
	
	/** PEMASARAN **/
	public function get_marketing( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted('ASSET_READ') === true ) {
	        
	        $this->load->model('Asset_model');
    		$asset_detail = $this->Asset_model->asset_detail($asset_id);
    		if ( !empty($asset_detail) ){
    		    
    		    $asset['id'] = $asset_detail->id;
    		    $asset['asset_code'] = $asset_detail->asset_code;
    		    $asset['asset_name'] = $asset_detail->asset_name;
    		    
    		    $this->load->model('Operational_activity_model');
    		    $marketing = $this->Operational_activity_model->get_activity($asset_detail->id,4);
                $asset['marketing'] = null;
                if ( !empty($marketing) ){
                    $this->load->helper('iddate_helper');
                    foreach ( $marketing as $i => $marketing ){
                        // custom date
                        $marketing->date_txt = convert_date($marketing->date);
                        $marketing->cost_txt = 'Rp. ' . number_format($marketing->cost, 0, ',', '.');
                        // dokumen
                        $marketing->document = null;
                        $doc = $this->Operational_activity_model->get_document($marketing->id);
                        if ( !empty($doc) ){
                            unset($document);
                            foreach ( $doc as $iDoc => $doc ){
                                $document[$iDoc]['id'] = $doc->id;
                                $document[$iDoc]['name'] = $doc->doc_name;
                                $document[$iDoc]['url'] = $this->config->item('view_file_url').$doc->s3_object;
                            }
                            $marketing->document = $document;
                        }

                        $asset['marketing'][$i] = $marketing;
                    }
                }
                
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
		
	} // end of - get_marketing
	
	public function add_marketing( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('operational_activity/marketing') === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('date', 'Tanggal', 'required|exact_length[10]');
            $this->form_validation->set_rules('by', 'Pelaksana Kegiatan', 'required|max_length[255]');
            $this->form_validation->set_rules('status', 'Status Pekerjaan/Kegiatan', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $activity_detail = array(
                    'asset_id' => $asset_id,
                    'type' => 4, // pemasaran
                    'date' => $this->lman_security->clean_post('date'),
                    'by' => $this->lman_security->clean_post('by'),
                    'name' => $this->lman_security->clean_post('name'),
                    'object' => $this->lman_security->clean_post('object'),
                    'cost' => $this->lman_security->clean_post('cost'),
                    'status' => $this->lman_security->clean_post('status'),
                    'notes' => $this->lman_security->clean_post('notes'),
                );
                
                $this->load->model('Operational_activity_model');
                $activity_id = $this->Operational_activity_model->insert_activity($activity_detail);
                if ($activity_id != false) {

                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'activity_id' => $activity_id,
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
		
	} // end of - add_marketing
	
	public function update_marketing( $activity_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('operational_activity/marketing') === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('date', 'Tanggal', 'required|exact_length[10]');
            $this->form_validation->set_rules('by', 'Pelaksana Kegiatan', 'required|max_length[255]');
            $this->form_validation->set_rules('status', 'Status Pekerjaan/Kegiatan', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $activity_detail = array(
                    'date' => $this->lman_security->clean_post('date'),
                    'by' => $this->lman_security->clean_post('by'),
                    'name' => $this->lman_security->clean_post('name'),
                    'object' => $this->lman_security->clean_post('object'),
                    'cost' => $this->lman_security->clean_post('cost'),
                    'status' => $this->lman_security->clean_post('status'),
                    'notes' => $this->lman_security->clean_post('notes'),
                );
                
                $this->load->model('Operational_activity_model');
                $update_activity = $this->Operational_activity_model->update_activity($activity_id, $activity_detail);
                if ($update_activity != false) {

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
		
	} // end of - update_marketing
	
	/** BUSINESS CASE **/
	public function get_business_case( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted('ASSET_READ') === true ) {
	        
	        $this->load->model('Asset_model');
    		$asset_detail = $this->Asset_model->asset_detail($asset_id);
    		if ( !empty($asset_detail) ){
    		    
    		    $asset['id'] = $asset_detail->id;
    		    $asset['asset_code'] = $asset_detail->asset_code;
    		    $asset['asset_name'] = $asset_detail->asset_name;
    		    
    		    $this->load->model('Business_case_model');
    		    $business_case = $this->Business_case_model->get($asset_detail->id);
                $asset['business_case'] = null;
                if ( !empty($business_case) ){
                    $this->load->helper('iddate_helper');
                    foreach ( $business_case as $i => $business_case ){
                        // custom date
                        $business_case->date_txt = convert_date($business_case->date);
                        // dokumen
                        $business_case->document = null;
                        $doc = $this->Business_case_model->get_document($business_case->id);
                        if ( !empty($doc) ){
                            unset($document);
                            foreach ( $doc as $iDoc => $doc ){
                                $document[$iDoc]['id'] = $doc->id;
                                $document[$iDoc]['name'] = $doc->doc_name;
                                $document[$iDoc]['url'] = $this->config->item('view_file_url').$doc->s3_object;
                            }
                            $business_case->document = $document;
                        }

                        $asset['business_case'][$i] = $business_case;
                    }
                }
                
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
		
	} // end of - get_business_case
	
	public function add_business_case( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('operational_activity/business_case') === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('date', 'Tanggal', 'required|exact_length[10]');
            $this->form_validation->set_rules('by', 'Pelaksana Kegiatan', 'required|max_length[255]');
            $this->form_validation->set_rules('result', 'Hasil/Rekomendasi', 'required');
            $this->form_validation->set_rules('implementation_status', 'Status Pelaksanaan', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $business_case_detail = array(
                    'asset_id' => $asset_id,
                    'date' => $this->lman_security->clean_post('date'),
                    'by' => $this->lman_security->clean_post('by'),
                    'name' => $this->lman_security->clean_post('name'),
                    'object' => $this->lman_security->clean_post('object'),
                    'result' => $this->lman_security->clean_post('result'),
                    'implementation_status' => $this->lman_security->clean_post('implementation_status'),
                );
                
                $this->load->model('Business_case_model');
                $business_case_id = $this->Business_case_model->insert($business_case_detail);
                if ($business_case_id != false) {

                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'business_case_id' => $business_case_id,
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
		
	} // end of - add_business_case
	
	public function update_business_case( $business_case_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('operational_activity/business_case') === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('date', 'Tanggal', 'required|exact_length[10]');
            $this->form_validation->set_rules('by', 'Pelaksana Kegiatan', 'required|max_length[255]');
            $this->form_validation->set_rules('result', 'Hasil/Rekomendasi', 'required');
            $this->form_validation->set_rules('implementation_status', 'Status Pelaksanaan', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $business_case_detail = array(
                    'date' => $this->lman_security->clean_post('date'),
                    'by' => $this->lman_security->clean_post('by'),
                    'name' => $this->lman_security->clean_post('name'),
                    'object' => $this->lman_security->clean_post('object'),
                    'result' => $this->lman_security->clean_post('result'),
                    'implementation_status' => $this->lman_security->clean_post('implementation_status'),
                );
                
                $this->load->model('Business_case_model');
                $update_activity = $this->Business_case_model->update($business_case_id, $business_case_detail);
                if ($update_activity != false) {

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
		
	} // end of - _business_case
	
	public function add_business_case_document( $business_case_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('operational_activity/business_case_document') === true ) {
	         
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
                    'business_case_id' => $business_case_id,
                    'doc_name' => $this->lman_security->clean_post('doc_name'),
                    's3_bucket' => $this->lman_security->clean_post('s3_bucket'),
                    's3_object' => $this->lman_security->clean_post('s3_object'),
                );
                
                $this->load->model('Business_case_model');
                $document_id = $this->Business_case_model->insert_document($document_detail);
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
		
	} // end of - add_business_case_document
	
	public function delete_business_case_document( $document_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('operational_activity/business_case_document') === true ) {
	         
            $this->load->model('Business_case_model');
            $delete_document = $this->Business_case_model->delete_document( $document_id );
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
		
	} // end of - delete_business_case_document
	
	/** DOKUMEN **/
	// add_document - menambahkan data foto aset 
	public function add_document( $operational_activity_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('operational_activity/document') === true ) {
	         
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
                    'operational_activity_id' => $operational_activity_id,
                    'doc_name' => $this->lman_security->clean_post('doc_name'),
                    's3_bucket' => $this->lman_security->clean_post('s3_bucket'),
                    's3_object' => $this->lman_security->clean_post('s3_object'),
                );
                
                $this->load->model('Operational_activity_model');
                $document_id = $this->Operational_activity_model->insert_document($document_detail);
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
	    if ( $this->access_control->access_granted('operational_activity/document') === true ) {
	         
            $this->load->model('Operational_activity_model');
            $delete_document = $this->Operational_activity_model->delete_document( $document_id );
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
	
}
