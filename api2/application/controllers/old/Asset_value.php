<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset_value extends CI_Controller {
   
	public function get( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted('ASSET_READ') === true ) {
	        
	        $this->load->model('Asset_model');
    		$asset_detail = $this->Asset_model->asset_detail($asset_id);
    		if ( !empty($asset_detail) ){
    		    
    		    $data['id'] = $asset_detail->id;
    		    $data['asset_code'] = $asset_detail->asset_code;
    		    $data['asset_name'] = $asset_detail->asset_name;
    		    
    		    $this->load->model('Asset_value_model');
    		    $asset_value = $this->Asset_value_model->get($asset_detail->id);
                $data['asset_value'] = null;
                if ( !empty($asset_value) ){
                    $this->load->helper('iddate_helper');
                    foreach ( $asset_value as $i => $asset_value ){
                        $asset_value->value_txt = 'Rp. ' . number_format($asset_value->value, 0, ',', '.');
                        $asset_value->date_txt = convert_date($asset_value->date);
                        
                        // dokumen penilaian (jika ada):
                        $asset_value->document = null;
                        $doc = $this->Asset_value_model->get_document($asset_value->id);
                        if ( !empty($doc) ){
                            unset($document);
                            foreach ( $doc as $iDoc => $doc ){
                                $document[$iDoc]['id'] = $doc->id;
                                $document[$iDoc]['name'] = $doc->doc_name;
                                $document[$iDoc]['url'] = $this->config->item('view_file_url').$doc->s3_object;
                            }
                            $asset_value->document = $document;
                        }
                        
                        $data['asset_value'][$i] = $asset_value;
                        
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
		
	} // end of - get_asset_value

	public function add( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'asset/update_value' ) === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('date', 'Tanggal', 'required|exact_length[10]');
            $this->form_validation->set_rules('value', 'Nilai', 'required|numeric');
            $this->form_validation->set_rules('notes', 'Catatan/Keterangan', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $asset_value_detail = array(
                    'asset_id' => $asset_id,
                    'date' => $this->lman_security->clean_post('date'),
                    'value' => $this->lman_security->clean_post('value'),
                    'value_type' => $this->lman_security->clean_post('value_type'),
                    'notes' => $this->lman_security->clean_post('notes'),
                );
                
                $this->load->model('Asset_value_model');
                $asset_value_id = $this->Asset_value_model->insert($asset_value_detail);
                if ($asset_value_id != false) {
                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'asset_value_id' => $asset_value_id,
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
		
	} // end of - add
	
	public function update( $asset_value_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'asset/update_value' ) === true ) {
	         
            $this->load->library('form_validation');
            $this->form_validation->set_rules('date', 'Tanggal', 'required|exact_length[10]');
            $this->form_validation->set_rules('value', 'Nilai', 'required|numeric');
            $this->form_validation->set_rules('notes', 'Catatan/Keterangan', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $asset_value_detail = array(
                    'date' => $this->lman_security->clean_post('date'),
                    'value' => $this->lman_security->clean_post('value'),
                    'value_type' => $this->lman_security->clean_post('value_type'),
                    'notes' => $this->lman_security->clean_post('notes'),
                );
                
                $this->load->model('Asset_value_model');
                $update_asset_value = $this->Asset_value_model->update($asset_value_id, $asset_value_detail);
                if ($update_asset_value != false) {

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
	
	public function add_document( $asset_value_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'asset/update_value' ) === true ) {
	         
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
                    'asset_value_id' => $asset_value_id,
                    'doc_name' => $this->lman_security->clean_post('doc_name'),
                    's3_bucket' => $this->lman_security->clean_post('s3_bucket'),
                    's3_object' => $this->lman_security->clean_post('s3_object'),
                );
                
                $this->load->model('Asset_value_model');
                $document_id = $this->Asset_value_model->insert_document($document_detail);
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
	    if ( $this->access_control->access_granted( 'asset/update_value' ) === true ) {
	         
            $this->load->model('Asset_value_model');
            $delete_document = $this->Asset_value_model->delete_document( $document_id );
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
