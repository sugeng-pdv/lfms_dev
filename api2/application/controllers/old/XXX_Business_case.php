<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business_case extends CI_Controller {

	public function add( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/'.$this->router->fetch_method() ) === true ) {
	         
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
		
	} // end of - add
	
	public function update( $business_case_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/'.$this->router->fetch_method() ) === true ) {
	         
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
		
	} // end of - update
	
	// add_document - menambahkan data foto aset 
	public function add_document( $business_case_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/'.$this->router->fetch_method() ) === true ) {
	         
            $this->load->library('form_validation');
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
                        'document_id' => $document_id,
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
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/'.$this->router->fetch_method() ) === true ) {
	         
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
		
	} // end of - delete_document

}
