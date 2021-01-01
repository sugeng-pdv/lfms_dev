<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Duty extends CI_Controller {
   
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
    		    
    		    $this->load->model('Duty_model');
    		    $duty = $this->Duty_model->get($asset_detail->id);
                $asset['duty'] = null;
                
                if ( !empty($duty) ){
                    $this->load->helper('iddate_helper');

                    foreach ( $duty as $i => $duty ){
                        $duty_type_detail = $this->Duty_model->type_detail($duty->duty_type);
                        $duty->duty_type_name = ( !empty($duty_type_detail) ) ? $duty_type_detail->name : null;
                        $duty->value_txt = 'Rp. ' . number_format($duty->value, 0, ',', '.');
                        $duty->status_txt = ( $duty->status == 'PAID' ) ? 'Lunas' : 'Belum Lunas';
                        
                        // sisa due date
                        if ( !empty($duty->due_date) AND $duty->status != 'PAID' ){
                            
                            $duty->days_to_due_date = ceil(( strtotime($duty->due_date) - time() ) / 86400);
                            
                        }else{
                            $duty->days_to_due_date = null;
                        }
                        
                        
                        // periode tagihan
                        switch ($duty->cycle){
                            case 'TAHUNAN' :
                                $duty->period_txt = 'Tahun '.substr($duty->period, 0, 4);
                            break;
                            case 'BULANAN' :
                                $this->load->helper('iddate_helper');
                                $duty->period_txt = 'Bulan '.convert_month($duty->period);
                            break;
                            case 'MINGGUAN' :
                                $this->load->helper('iddate_helper');
                                $duty->period_txt = 'Tanggal '.convert_date($duty->period);
                            break;
                            case 'HARIAN' :
                                $this->load->helper('iddate_helper');
                                $duty->period_txt = 'Tanggal '.convert_date($duty->period);
                            break;
                        }
                        
                        $duty->due_date_txt = ( !empty($duty->due_date) ) ? convert_date($duty->due_date) : '-';
                        $duty->paid_date_txt = ( !empty($duty->paid_date) ) ? convert_date($duty->paid_date) : '-';
                        
                        // dokumen (jika ada):
                        $duty->document = null;
                        $doc = $this->Duty_model->get_document($duty->id);
                        if ( !empty($doc) ){
                            unset($document);
                            foreach ( $doc as $iDoc => $doc ){
                                $document[$iDoc]['id'] = $doc->id;
                                $document[$iDoc]['name'] = $doc->doc_name;
                                $document[$iDoc]['url'] = $this->config->item('view_file_url').$doc->s3_object;
                            }
                            $duty->document = $document;
                        }
                        
                        $data['duty'][$i] = $duty;
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
		
	} // end of - get

	public function add( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('asset/update_duty') === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('duty_type', 'Jenis Kewajiban', 'required');
            $this->form_validation->set_rules('value', 'Nilai', 'required|numeric');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_rules('cycle', 'Siklus Tagihan', 'required');
            $this->form_validation->set_rules('period', 'Periode Tagihan', 'required|max_length[10]');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $duty_detail = array(
                    'asset_id' => $asset_id,
                    'duty_type' => $this->lman_security->clean_post('duty_type'),
                    'value' => $this->lman_security->clean_post('value'),
                    'status' => $this->lman_security->clean_post('status'),
                    'period' => $this->lman_security->clean_post('period'),
                    'cycle' => $this->lman_security->clean_post('cycle'),
                    'due_date' => $this->lman_security->clean_post('due_date'),
                    'paid_date' => $this->lman_security->clean_post('paid_date'),
                );
                
                $this->load->model('Duty_model');
                $duty_id = $this->Duty_model->insert($duty_detail);
                if ($duty_id != false) {
                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'duty_id' => $duty_id,
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
	
	public function update( $duty_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('asset/update_duty') === true ) {
	         
            $this->load->library('form_validation');
            $this->form_validation->set_rules('duty_type', 'Jenis Kewajiban', 'required');
            $this->form_validation->set_rules('value', 'Nilai', 'required|numeric');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_rules('period', 'Periode Tagihan', 'required|max_length[10]');
            $this->form_validation->set_rules('cycle', 'Siklus Tagihan', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $duty_detail = array(
                    'duty_type' => $this->lman_security->clean_post('duty_type'),
                    'value' => $this->lman_security->clean_post('value'),
                    'status' => $this->lman_security->clean_post('status'),
                    'period' => $this->lman_security->clean_post('period'),
                    'cycle' => $this->lman_security->clean_post('cycle'),
                    'due_date' => $this->lman_security->clean_post('due_date'),
                    'paid_date' => $this->lman_security->clean_post('paid_date'),
                );
                
                $this->load->model('Duty_model');
                $update_duty = $this->Duty_model->update($duty_id, $duty_detail);
                if ($update_duty != false) {

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
	
	public function add_document( $duty_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('asset/update_duty') === true ) {
	         
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
                    'duty_id' => $duty_id,
                    'doc_name' => $this->lman_security->clean_post('doc_name'),
                    's3_bucket' => $this->lman_security->clean_post('s3_bucket'),
                    's3_object' => $this->lman_security->clean_post('s3_object'),
                );
                
                $this->load->model('Duty_model');
                $document_id = $this->Duty_model->insert_document($document_detail);
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
	    if ( $this->access_control->access_granted('asset/update_duty') === true ) {
	         
            $this->load->model('Duty_model');
            $delete_document = $this->Duty_model->delete_document( $document_id );
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
	
	public function get_duty_type()
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted('REFERENCE') === true ) {
	         
	         $this->load->model('Duty_model');

    		// create result
    		$result = array(
    			'status' => 'success',
    			'message' => null,
    			'elapsed_time' => $this->benchmark->elapsed_time(),
    			'duty_type' => $this->Duty_model->get_type(),
    		);

    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - get_duty_type
	
}
