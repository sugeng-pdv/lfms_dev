<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Name		: Asset (Controller)
| Author	: Brana Pandega
|--------------------------------------------------------------------------
*/

class Asset extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Asset_model');

		// enable profiler cukup disini
		//$this->output->enable_profiler(true);
		
    }
    
	public function index(){ /* DO NOTHING */ }
	
    // get_asset
	public function get_asset()
	{
	    // sleep(3);
	    // $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( 'DATAPOKOK', 'R' ) === true ) {
	         
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
            
            // $per_page = intval($this->input->get('per_page',true));
            // if (empty($per_page) OR is_numeric($per_page) !== true) {
            //     $per_page = 10;
            // }
            
            // keyword
            $keyword = $this->input->get('keyword');
            if ( empty($keyword) ) {
                $keyword = null;
            }
            
            // asset_status
            $asset_status = $this->input->get('asset_status');
            if ( empty($asset_status) ) {
                $asset_status = null;
            }
            
            // asset_origin
            $asset_origin = $this->input->get('asset_origin');
            if ($this->array_has_value($asset_origin) == false) {
                $asset_origin = null;
            }
            
            // kategori
            $category_id = $this->input->get('category_id');
            if ($this->array_has_value($category_id) == false) {
                $category_id = null;
            }
            
            // provinsi
            $province_id = $this->input->get('province_id', true);
            if ($this->array_has_value($province_id) == false) {
                $province_id = null;
            }
    
            // kota
            $city_id = $this->input->get('city_id', true);
            if ($this->array_has_value($city_id) == false) {
                $city_id = null;
            }else{
                $province_id = null; // patch untuk UI versi sederhana, jika pake UI spt lelang.go.id, tinggal ilangin baris ini
            }
            
            // ready_to_market
            $ready_to_market = $this->input->get('ready_to_market');
            switch ($ready_to_market) {
                case '1':
                    $ready_to_market = '1';
                    break;
                case '0':
                    $ready_to_market = '0';
                    break;
                default:
                    $ready_to_market = null;
                    break;
            }
            
            // free and clear status
            $free_and_clear_status = $this->input->get('free_and_clear_status');
            if ( empty($free_and_clear_status) ) {
                $free_and_clear_status = null;
            }
            
            // latitude dan longitude
            $lat_min = $this->input->get('lat_min');
            if ( empty($lat_min) ) {
                $lat_min = null;
            }
            
            $lat_max = $this->input->get('lat_max');
            if ( empty($lat_max) ) {
                $lat_max = null;
            }
            
            $lng_min = $this->input->get('lng_min');
            if ( empty($lng_min) ) {
                $lng_min = null;
            }
            
            $lng_max = $this->input->get('lng_max');
            if ( empty($lng_max) ) {
                $lng_max = null;
            }
            
            $order_by = $this->input->get('order_by');
            if ( empty($order_by) ) {
                $order_by = null;
            }

            $num_of_data = $this->Asset_model->count_asset($keyword, $asset_status, $asset_origin, $category_id, $province_id, $city_id, $ready_to_market, $free_and_clear_status, $lat_min, $lat_max, $lng_min, $lng_max);
            $num_of_page = ceil($num_of_data/$per_page);
            
            $offset = ($page * $per_page) - $per_page;
    		$asset = $this->Asset_model->get_asset($per_page,$offset, $order_by, $keyword, $asset_status, $asset_origin, $category_id, $province_id, $city_id, $ready_to_market, $free_and_clear_status, $lat_min, $lat_max, $lng_min, $lng_max);
    		if ( !empty($asset) ){
    		    
        		$this->load->model('Location_model');
    		    
    		    $i = $offset + 1; // $i = urutan
    		    foreach ( $asset as $asset ){
    		        $assets[$i]['id'] = $asset->id;
    		        $assets[$i]['asset_name'] = $asset->asset_name;
    		        $assets[$i]['asset_code'] = $asset->asset_code;
    		        $assets[$i]['address'] = $asset->address;
        		    $province_detail = $this->Location_model->province_detail($asset->province);
        		    $assets[$i]['province_name'] = ( !empty($province_detail) ) ? str_replace('Dki','DKI',ucwords(strtolower($province_detail->name))) : 'N/A';
        		    $city_detail = $this->Location_model->city_detail($asset->city);
        		    $assets[$i]['city_name'] = ( !empty($city_detail) ) ? ucwords(strtolower($city_detail->name)) : 'N/A';
    		        $assets[$i]['latitude'] = $asset->latitude;
    		        $assets[$i]['longitude'] = $asset->longitude;
    		        $assets[$i]['image_url_crop'] = $this->config->item('image_url_crop');

                    // primary image
                    $primary_image = $this->Asset_model->get_primary_image($asset->id);
                    if (!empty($primary_image)) {
                        $assets[$i]['primary_image_url'] = $this->config->item('image_url_crop').'200/200/'.$primary_image->s3_bucket.'/'.$primary_image->s3_object;
                        $assets[$i]['primary_image_s3_bucket'] = $primary_image->s3_bucket;
                        $assets[$i]['primary_image_s3_object'] = $primary_image->s3_object;
                    } else {
                        $assets[$i]['primary_image_url'] = $this->config->item('image_url_crop').'200/200/s3-lman/mobile/noimage.jpg';
                        $assets[$i]['primary_image_s3_bucket'] = 's3-lman';
                        $assets[$i]['primary_image_s3_object'] = 'mobile/noimage.jpg';
                    }
                    
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
    				'data' => $assets
    			);
    
    		}else{
    			// create result
    			$result = array(
    					'status' => 'error',
    					'message' => 'Tidak ditemukan data aset dengan kriteria yang diminta.'
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
		
	} // end of - get_asset
	
    // asset_detail
	public function asset_detail( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( 'DATAPOKOK', 'R' ) === true ) {
	         
    		$asset_detail = $this->Asset_model->asset_detail($asset_id);
    		if ( !empty($asset_detail) ){
    		    
    		    $asset['id'] = $asset_detail->id;
    		    $asset['asset_code'] = $asset_detail->asset_code;
    		    $asset['asset_name'] = $asset_detail->asset_name;
    		    $asset['asset_description'] = $asset_detail->asset_description;
    		    
    		    // asal, status utilisasi, posisi dalam 7 cycle
    		    $asset['asset_origin_id'] = $asset_detail->asset_origin;
    		    $this->load->model('Asset_origin_model');
    		    $asset_origin_detail = $this->Asset_origin_model->detail($asset_detail->asset_origin);
    		    $asset['asset_origin_name'] = ( !empty($asset_origin_detail) ) ? $asset_origin_detail->name : 'N/A';
    		    
    		    $asset['asset_status_id'] = $asset_detail->asset_status;
    		    $this->load->model('Asset_status_model');
    		    $asset_status_detail = $this->Asset_status_model->detail($asset_detail->asset_status);
    		    $asset['asset_status_name'] = ( !empty($asset_status_detail) ) ? $asset_status_detail->name : 'N/A';
    		    
    		    $asset['asset_category_id'] = $asset_detail->asset_category;
    		    $this->load->model('Asset_category_model');
    		    $asset_category_detail = $this->Asset_category_model->detail($asset_detail->asset_category);
    		    $asset['asset_category_name'] = ( !empty($asset_category_detail) ) ? $asset_category_detail->name : 'N/A';
    		    
    		    $asset['asset_cycle_id'] = $asset_detail->asset_cycle;
    		    $this->load->model('Asset_cycle_model');
    		    $asset_cycle_detail = $this->Asset_cycle_model->detail($asset_detail->asset_cycle);
    		    $asset['asset_cycle_name'] = ( !empty($asset_cycle_detail) ) ? $asset_cycle_detail->name : 'N/A';
    		    
    		    $asset['free_and_clear_status'] = $asset_detail->free_and_clear_status;
    		    $asset['ready_to_market'] = $asset_detail->ready_to_market;
    		    
    		    // BAST
    		    $asset['minutes_of_handover_number'] = $asset_detail->minutes_of_handover_number;
    		    $asset['handover_date'] = $asset_detail->handover_date;
    		    
    		    // alamat aset
    		    $asset['province_id'] = $asset_detail->province;
    		    $asset['city_id'] = $asset_detail->city;
    		    $this->load->model('Location_model');
    		    $province_detail = $this->Location_model->province_detail($asset_detail->province);
    		    $asset['province_name'] = ( !empty($province_detail) ) ? str_replace('Dki','DKI',ucwords(strtolower($province_detail->name))) : 'N/A';
    		    $city_detail = $this->Location_model->city_detail($asset_detail->city);
    		    $asset['city_name'] = ( !empty($city_detail) ) ? ucwords(strtolower($city_detail->name)) : 'N/A';
    		    $asset['address'] = $asset_detail->address;
    		    $asset['latitude'] = $asset_detail->latitude;
    		    $asset['longitude'] = $asset_detail->longitude;
    		    
    		    // data tanah & sertifikatnya
    		    $this->load->model('Land_model');
    		    $land = $this->Land_model->get($asset_detail->id);
                //$asset['land'] = ( !empty($land) ) ? $land : null;
                $total_luas_tanah = 0;
                if ( !empty($land) ){
                    
                    foreach ( $land as $land ){
                        $lands[$land->id] = $land; 
                        $total_luas_tanah = $total_luas_tanah + $land->total_surface_area;
                        $doc = $this->Land_model->get_document($land->id);
                        if ( !empty($doc) ){
                            unset($document);
                            foreach ( $doc as $iDoc => $doc ){
                                $document[$iDoc]['id'] = $doc->id;
                                $document[$iDoc]['name'] = $doc->doc_name;
                                $document[$iDoc]['url'] = $this->config->item('view_file_url').$doc->s3_object;
                            }
                            $lands[$land->id]->document = $document;
                        }
                    }
                    $asset['land'] = $lands;
                }else{
                    $asset['land'] = null;
                }
                
                $asset['total_surface_area'] = $total_luas_tanah;

    		    // data bangunan
    		    $this->load->model('Structure_model');
    		    $structure = $this->Structure_model->get($asset_detail->id);
                $asset['structure'] = null;
                $total_luas_bangunan = 0;
                if ( !empty($structure) ){
                    foreach ( $structure as $i => $structure ){
                        $land_of_structure = $this->Structure_model->get_land($structure->id);
                        $structure->land_id = ( !empty($land_of_structure) ) ? $land_of_structure : null;
                        $asset['structure'][$i] = $structure;
                        $total_luas_bangunan = $total_luas_bangunan + $structure->total_structure_area;
                        $doc = $this->Structure_model->get_document($structure->id);
                        if ( !empty($doc) ){
                            unset($document);
                            foreach ( $doc as $iDoc => $doc ){
                                $document[$iDoc]['id'] = $doc->id;
                                $document[$iDoc]['name'] = $doc->doc_name;
                                $document[$iDoc]['url'] = $this->config->item('view_file_url').$doc->s3_object;
                            }
                            $asset['structure'][$i]->document = $document;
                        }
                    }
                }else{
                    $asset['structure'] = null;
                }
                
                $asset['total_structure_area'] = $total_luas_bangunan;
    		    
    		    // data space aset
    		    $this->load->model('Space_model');
    		    $space = $this->Space_model->get_by_asset($asset_detail->id);
                $asset['space'] = ( !empty($space) ) ? $space : null;
                
                // image_url_crop
                $asset['image_url_crop'] = $this->config->item('image_url_crop');
                
                // primary image
                $primary_image = $this->Asset_model->get_primary_image($asset_detail->id);
                if (!empty($primary_image)) {
                    $asset['primary_image']['thumb'] = $this->config->item('image_url_crop').'300/300/'.$primary_image->s3_bucket.'/'.$primary_image->s3_object;
                    $asset['primary_image']['full'] = $this->config->item('image_url_full').$primary_image->s3_bucket.'/'.$primary_image->s3_object;
                    $asset['primary_image']['s3_bucket'] = $primary_image->s3_bucket;
                    $asset['primary_image']['s3_object'] = $primary_image->s3_object;
                    $asset['primary_image']['image_id'] = $primary_image->id;
                } else {
                    
                    $asset['primary_image']['thumb'] = $this->config->item('image_url_crop').'300/300/s3-lman/mobile/noimage.jpg';
                    $asset['primary_image']['full'] = $this->config->item('image_url_crop').'500/400/s3-lman/mobile/noimage.jpg';
                    $asset['primary_image']['s3_bucket'] = 's3-lman';
                    $asset['primary_image']['s3_object'] = 'mobile/noimage.jpg';
                    $asset['primary_image']['image_id'] = null;
                }
                
                // regular image
                $image = $this->Asset_model->get_image($asset_detail->id);
                if (!empty($image)) {
                    $i = 1;
                    foreach( $image as $image ){
                        $asset['image'][$i]['thumb'] = $this->config->item('image_url_crop').'300/300/'.$primary_image->s3_bucket.'/'.$image->s3_object;
                        $asset['image'][$i]['full'] = $this->config->item('image_url_full').$primary_image->s3_bucket.'/'.$image->s3_object;
                        $asset['image'][$i]['s3_bucket'] = $image->s3_bucket;
                        $asset['image'][$i]['s3_object'] = $image->s3_object;
                        $asset['image'][$i]['image_id'] = $image->id;
                        $i++;
                    }
                }else{
                    $asset['image'] = null;
                }
                
                // video
                $video = $this->Asset_model->get_video($asset_detail->id);
                if (!empty($video)) {
                    $i = 1;
                    foreach( $video as $video ){
                        $asset['video'][$i]['video_id'] = $video->id;
                        $asset['video'][$i]['video_url'] = $video->video_url;
                        $i++;
                    }
                }else{
                    $asset['video'] = null;
                }
                
    		    $this->load->model('Facility_model');
    		    $this->load->helper('iddate_helper');
    		    $facility = $this->Facility_model->get_facility($asset_detail->id);
                $asset['facility'] = null;
                if ( !empty($facility) ){
                    foreach ( $facility as $i => $facility ){
                        // tipe fasilitas 
                        $type_detail = $this->Facility_model->facility_type_detail($facility->type);
                        $facility->type_name = ( !empty($type_detail) ) ? $type_detail->name : 'N/A'  ;
                        $asset['facility'][$i] = $facility;
                    }
                }
    		    $public_facility = $this->Facility_model->get_public_facility($asset_detail->id);
                $asset['public_facility'] = null;
                if ( !empty($public_facility) ){
                    foreach ( $public_facility as $i => $public_facility ){
                        // tipe fasilitas 
                        $type_detail = $this->Facility_model->public_facility_type_detail($public_facility->type);
                        $public_facility->type_name = ( !empty($type_detail) ) ? $type_detail->name : 'N/A'  ;
                        $asset['public_facility'][$i] = $public_facility;
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
		
	} // end of - asset_detail
	
    // add_basic_data
	public function add_basic_data()
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'DATAPOKOK', 'RW' ) === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('asset_code', 'Nomor Identitas Aset Kelolaan', 'required');
            $this->form_validation->set_rules('asset_name', 'Nama Aset', 'required|max_length[255]');
            $this->form_validation->set_rules('asset_description', 'Deskripsi', 'required');
            $this->form_validation->set_rules('minutes_of_handover_number', 'Nomor BAST', 'required');
            $this->form_validation->set_rules('handover_date', 'Tanggal BAST', 'required');
            $this->form_validation->set_rules('asset_category', 'Kategori Aset', 'required|numeric');
            $this->form_validation->set_rules('asset_origin', 'Asal Aset', 'required|numeric');
            $this->form_validation->set_rules('asset_status', 'Status Pemanfaatan Aset ', 'required|numeric');
            //$this->form_validation->set_rules('asset_cycle', 'Posisi pada 7 Cycle Aset', 'required|numeric');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $asset_detail = array(
                    'asset_code' => $this->lman_security->clean_post('asset_code'),
                    'asset_name' => $this->lman_security->clean_post('asset_name'),
                    'asset_description' => $this->lman_security->clean_post('asset_description'),
                    'minutes_of_handover_number' => $this->lman_security->clean_post('minutes_of_handover_number'),
                    'handover_date' => $this->lman_security->clean_post('handover_date'),
                    'asset_category' => $this->lman_security->clean_post('asset_category'),
                    'asset_origin' => $this->lman_security->clean_post('asset_origin'),
                    'asset_status' => $this->lman_security->clean_post('asset_status'),
                    //'asset_cycle' => $this->lman_security->clean_post('asset_cycle'),
                );
                
                $asset_id = $this->Asset_model->insert_asset($asset_detail);
                if ($asset_id != false) {

                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'asset_id' => $asset_id,
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
		
	} // end of - add_basic_data
	
	/* buat training flutter 
	public function add_data()
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/'.$this->router->fetch_method() ) === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nama', 'Nama Aset', 'required|max_length[255]');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $asset_detail = array(
                    //'asset_code' => $this->lman_security->clean_post('asset_code'),
                    'asset_name' => $this->lman_security->clean_post('nama'),
                    'asset_description' => $this->lman_security->clean_post('alamat'),
                );
                
                $asset_id = $this->Asset_model->insert_asset($asset_detail);
                if ($asset_id != false) {

                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'asset_id' => $asset_id,
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
		
	} // end of - add_basic_data*/
	
    /* update_handover_data - melengkapi atau update data serah terima aset
	public function update_handover_data( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( $this->router->fetch_class().'/'.$this->router->fetch_method() ) === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('minutes_of_handover_number', 'Nomor BAST', 'required');
            $this->form_validation->set_rules('handover_date', 'Tanggal BAST', 'required|exact_length[10]');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {
                
                // if validations returns TRUE
                unset($error);
                $error = '';
                

                if ( !isset($error) OR $error == '' ) { // jika tidak ada error

                    $asset_detail = array(
                        'minutes_of_handover_number' => $this->lman_security->clean_post('minutes_of_handover_number'),
                        'handover_date' => $this->lman_security->clean_post('handover_date'),
                    );
                    
                    $asset_update = $this->Asset_model->update_asset($asset_id,$asset_detail);
                    if ($asset_update != false) {
    
                        $result = array(
                            'status' => 'success',
                            'message' => null,
            				'elapsed_time' => $this->benchmark->elapsed_time(),
                            'asset_id' => $asset_id,
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
                            'message' => $error
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
		
	} // end of - update_handover_data */
	
    // update_basic_data - melengkapi atau update data dasar
	public function update_basic_data( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'DATAPOKOK', 'RW' ) === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('asset_code', 'Nomor Identitas Aset Kelolaan', 'required');
            $this->form_validation->set_rules('asset_name', 'Nama Aset', 'required|max_length[255]');
            $this->form_validation->set_rules('asset_description', 'Deskripsi', 'required');
            $this->form_validation->set_rules('minutes_of_handover_number', 'Nomor BAST', 'required');
            $this->form_validation->set_rules('handover_date', 'Tanggal BAST', 'required');
            $this->form_validation->set_rules('asset_category', 'Kategori Aset', 'required|numeric');
            $this->form_validation->set_rules('asset_origin', 'Asal Aset', 'required|numeric');
            $this->form_validation->set_rules('asset_status', 'Status Pemanfaatan Aset ', 'required|numeric');
            //$this->form_validation->set_rules('asset_cycle', 'Posisi pada 7 Cycle Aset', 'required|numeric');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {
                
                // if validations returns TRUE
                unset($error);
                $error = '';
                
                /*
                if ( ) {
                    $error .= 'H';
                }*/
                
                if ( !isset($error) OR $error == '' ) { // jika tidak ada error

                    $asset_detail = array(
                        'asset_code' => $this->lman_security->clean_post('asset_code'),
                        'asset_name' => $this->lman_security->clean_post('asset_name'),
                        'asset_description' => $this->lman_security->clean_post('asset_description'),
                        'minutes_of_handover_number' => $this->lman_security->clean_post('minutes_of_handover_number'),
                        'handover_date' => $this->lman_security->clean_post('handover_date'),
                        'asset_category' => $this->lman_security->clean_post('asset_category'),
                        'asset_origin' => $this->lman_security->clean_post('asset_origin'),
                        'asset_status' => $this->lman_security->clean_post('asset_status'),
                        //'asset_cycle' => $this->lman_security->clean_post('asset_cycle'),
                    );
                    
                    $asset_update = $this->Asset_model->update_asset($asset_id,$asset_detail);
                    if ($asset_update != false) {
    
                        $result = array(
                            'status' => 'success',
                            'message' => null,
            				'elapsed_time' => $this->benchmark->elapsed_time(),
                            'asset_id' => $asset_id,
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
                            'message' => $error
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
		
	} // end of - update_basic_data
	
    // update_location - melengkapi atau update data lokasi aset yg meliputi alamat dan koordinat
	public function update_location( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'LOKASI', 'RW' ) === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('province', 'Provinsi', 'required|numeric');
            $this->form_validation->set_rules('city', 'Kota', 'required|numeric');
            $this->form_validation->set_rules('address', 'Alamat', 'required|max_length[255]');
            $this->form_validation->set_rules('latitude', 'Koordinat (latitude)', 'decimal');
            $this->form_validation->set_rules('longitude', 'Koordinat (longitude)', 'decimal');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {
                
                // if validations returns TRUE
                unset($error);
                $error = '';
                
                /*
                if ( ) {
                    $error .= 'H';
                }*/
                
                if ( !isset($error) OR $error == '' ) { // jika tidak ada error

                    $asset_detail = array(
                        'province' => $this->lman_security->clean_post('province'),
                        'city' => $this->lman_security->clean_post('city'),
                        'address' => $this->lman_security->clean_post('address'),
                        'latitude' => $this->lman_security->clean_post('latitude'),
                        'longitude' => $this->lman_security->clean_post('longitude'),
                    );
                    
                    $asset_update = $this->Asset_model->update_asset($asset_id,$asset_detail);
                    if ($asset_update != false) {
    
                        $result = array(
                            'status' => 'success',
                            'message' => null,
            				'elapsed_time' => $this->benchmark->elapsed_time(),
                            'asset_id' => $asset_id,
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
                            'message' => $error
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
		
	} // end of - update_location
	
	// add_land_data - menambahkan data tanah pada suatu aset
	public function add_land_data( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'TANAHBANGUNAN', 'RW' ) === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            //$this->form_validation->set_rules('certificate_number', 'Nomor Sertifikat', 'required|max_length[255]');
            //$this->form_validation->set_rules('type_of_land_right', 'Jenis Hak', 'required|max_length[255]');
            $this->form_validation->set_rules('total_surface_area', 'Luas Tanah', 'required|numeric');
            //$this->form_validation->set_rules('certificate_expiration_date', 'Masa Berlaku Sertifikat', 'required|exact_length[10]');
            //$this->form_validation->set_rules('rights_holder', 'Nama Pemegang Hak', 'required|max_length[255]');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $land_detail = array(
                    'asset_id' => $asset_id,
                    'certificate_number' => $this->lman_security->clean_post('certificate_number'),
                    'type_of_land_right' => $this->lman_security->clean_post('type_of_land_right'),
                    'total_surface_area' => $this->lman_security->clean_post('total_surface_area'),
                    'certificate_expiration_date' => $this->lman_security->clean_post('certificate_expiration_date'),
                    'rights_holder' => $this->lman_security->clean_post('rights_holder'),
                    /*
                    'acquisition_value' => $this->lman_security->clean_post('acquisition_value'),
                    'capitalized_value' => $this->lman_security->clean_post('capitalized_value'),
                    'total_value' => $this->lman_security->clean_post('total_value'),
                    'accumulated_depreciation' => $this->lman_security->clean_post('accumulated_depreciation'),
                    'book_value' => $this->lman_security->clean_post('book_value'),
                    'latitude' => $this->lman_security->clean_post('latitude'),
                    'longitude' => $this->lman_security->clean_post('longitude'),*/
                );
                
                $this->load->model('Land_model');
                $land_id = $this->Land_model->insert_land($land_detail);
                if ($land_id != false) {

                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'land_id' => $land_id,
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
		
	} // end of - add_land_data
	
	// update_land_data
	public function update_land_data($land_id=null)
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'TANAHBANGUNAN', 'RW' ) === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('certificate_number', 'Nomor Sertifikat', 'required|max_length[255]');
            $this->form_validation->set_rules('type_of_land_right', 'Jenis Hak', 'required');
            $this->form_validation->set_rules('total_surface_area', 'Luas Tanah', 'required|numeric');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $land_detail = array(
                    'certificate_number' => $this->lman_security->clean_post('certificate_number'),
                    'type_of_land_right' => $this->lman_security->clean_post('type_of_land_right'),
                    'total_surface_area' => $this->lman_security->clean_post('total_surface_area'),
                    'certificate_expiration_date' => $this->lman_security->clean_post('certificate_expiration_date'),
                    'rights_holder' => $this->lman_security->clean_post('rights_holder'),
                );
                
                $this->load->model('Land_model');
                $update_land = $this->Land_model->update_land($land_id,$land_detail);
                if ($update_land != false) {
                    
                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'land_id' => $land_id,
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
		
	} // end of - update_land_data
	
	// add_land_document - menambahkan dokumen terkait tanah
	public function add_land_document( $land_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'TANAHBANGUNAN', 'RW' ) === true ) {
	         
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
                    'land_id' => $land_id,
                    'doc_name' => $this->lman_security->clean_post('doc_name'),
                    's3_bucket' => $this->lman_security->clean_post('s3_bucket'),
                    's3_object' => $this->lman_security->clean_post('s3_object'),
                );
                
                $this->load->model('Asset_model');
                $document_id = $this->Asset_model->insert_land_document($document_detail);
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
		
	} // end of - add_land_document
	
	public function delete_land_document( $document_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'TANAHBANGUNAN', 'RW' ) === true ) {
	         
            $this->load->model('Asset_model');
            $delete_document = $this->Asset_model->delete_land_document( $document_id );
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
		
	} // end of - delete_land_document

	// add_structure_data - menambahkan data bangunan pada suatu aset
	public function add_structure_data($asset_id=null)
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'TANAHBANGUNAN', 'RW' ) === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('structure_name', 'Nama Bangunan', 'required|max_length[255]');
            $this->form_validation->set_rules('total_structure_area', 'Total Luas Bangunan', 'required|numeric');
            $this->form_validation->set_rules('number_of_structure_story', 'Jumlah Lantai', 'required|numeric');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $structure_detail = array(
                    'asset_id' => $asset_id,
                    'structure_name' => $this->lman_security->clean_post('structure_name'),
                    'total_structure_area' => $this->lman_security->clean_post('total_structure_area'),
                    'number_of_structure_story' => $this->lman_security->clean_post('number_of_structure_story'),
                    'imb_number' => $this->lman_security->clean_post('imb_number'),
                    'structure_condition' => $this->lman_security->clean_post('structure_condition'),
                );
                
                $this->load->model('Structure_model');
                $structure_id = $this->Structure_model->insert_structure($structure_detail);
                if ($structure_id != false) {
                    
                    $land_id = $this->input->post('land_id');
                    if (!empty($land_id)) {
                        foreach ($land_id as $land_id) {
                            $this->Structure_model->add_structure_to_land(
                                array(
                                    'land_id' => $land_id,
                                    'structure_id' => $structure_id
                                    )
                                );
                        }
                    }
                    
                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'structure_id' => $structure_id,
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
		
	} // end of - add_structure_data

	// update_structure_data
	public function update_structure_data($structure_id=null)
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'TANAHBANGUNAN', 'RW' ) === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('structure_name', 'Nama Bangunan', 'required|max_length[255]');
            $this->form_validation->set_rules('total_structure_area', 'Total Luas Bangunan', 'required|numeric');
            $this->form_validation->set_rules('number_of_structure_story', 'Jumlah Lantai', 'required|numeric');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $structure_detail = array(
                    'structure_name' => $this->lman_security->clean_post('structure_name'),
                    'total_structure_area' => $this->lman_security->clean_post('total_structure_area'),
                    'number_of_structure_story' => $this->lman_security->clean_post('number_of_structure_story'),
                    'imb_number' => $this->lman_security->clean_post('imb_number'),
                    'structure_condition' => $this->lman_security->clean_post('structure_condition'),
                );
                
                $this->load->model('Structure_model');
                $update_structure = $this->Structure_model->update_structure($structure_id,$structure_detail);
                if ($update_structure != false) {
                    
                    $this->Structure_model->clear_structure_to_land($structure_id);
                    $land_id = $this->input->post('land_id');
                    if (!empty($land_id)) {
                        foreach ($land_id as $land_id) {
                            $this->Structure_model->add_structure_to_land(
                                array(
                                    'land_id' => $land_id,
                                    'structure_id' => $structure_id
                                    )
                                );
                        }
                    }
                    
                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'structure_id' => $structure_id,
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
		
	} // end of - update_structure_data
	
	// add_structure_document - menambahkan dokumen terkait bangunan
	public function add_structure_document( $structure_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'TANAHBANGUNAN', 'RW' ) === true ) {
	         
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
                    'structure_id' => $structure_id,
                    'doc_name' => $this->lman_security->clean_post('doc_name'),
                    's3_bucket' => $this->lman_security->clean_post('s3_bucket'),
                    's3_object' => $this->lman_security->clean_post('s3_object'),
                );
                
                $this->load->model('Asset_model');
                $document_id = $this->Asset_model->insert_structure_document($document_detail);
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
		
	} // end of - add_structure_document
	
	public function delete_structure_document( $document_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'TANAHBANGUNAN', 'RW' ) === true ) {
	         
            $this->load->model('Asset_model');
            $delete_document = $this->Asset_model->delete_structure_document( $document_id );
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
		
	} // end of - delete_structure_document

	// add_asset_image - menambahkan data foto aset 
	public function add_asset_image( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'FOTOVIDEO', 'RW' ) === true ) {
	         
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

                $image_detail = array(
                    'asset_id' => $asset_id,
                    's3_bucket' => $this->lman_security->clean_post('s3_bucket'),
                    's3_object' => $this->lman_security->clean_post('s3_object'),
                );
                
                $image_id = $this->Asset_model->insert_image($image_detail);
                if ($image_id != false) {

                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'image_id' => $image_id,
                        'thumbnail_url' => $this->config->item('image_url_crop').'200/200/'.$image_detail['s3_object']
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
		
	} // end of - add_asset_image

	// set_primary_image - menambahkan data foto aset 
	public function set_primary_image( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'FOTOVIDEO', 'RW' ) === true ) {
	         
            $this->load->library('form_validation');
            $this->form_validation->set_rules('image_id', 'image_id', 'required');

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $set_primary_image = $this->Asset_model->set_primary_image( $asset_id, $this->lman_security->clean_post('image_id') );
                if ( $set_primary_image != false ) {

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
		
	} // end of - set_primary_image
	
	// delete_image - menghapus data foto aset 
	public function delete_image( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'FOTOVIDEO', 'RW' ) === true ) {
	         
            $this->load->library('form_validation');
            $this->form_validation->set_rules('image_id', 'image_id', 'required');

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $delete_image = $this->Asset_model->delete_image( $asset_id, $this->lman_security->clean_post('image_id') );
                if ( $delete_image != false ) {

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
		
	} // end of - delete_image
	
	// add_asset_video - menambahkan data video aset 
	public function add_asset_video( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'FOTOVIDEO', 'RW' ) === true ) {
	         
            $this->load->library('form_validation');
            $this->form_validation->set_rules('video_url', 'video_url', 'required');

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $video_detail = array(
                    'asset_id' => $asset_id,
                    'video_url' => $this->lman_security->clean_post('video_url'),
                );
                
                $video_id = $this->Asset_model->insert_video($video_detail);
                if ($video_id != false) {

                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'video_id' => $video_id,
                        'video_url' => $video_detail['video_url']
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
		
	} // end of - add_asset_video
	
	// delete_video - menghapus data video aset 
	public function delete_video( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted( 'FOTOVIDEO', 'RW' ) === true ) {
	         
            $this->load->library('form_validation');
            $this->form_validation->set_rules('video_id', 'video_id', 'required');

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {

                $delete_video = $this->Asset_model->delete_video( $asset_id, $this->lman_security->clean_post('video_id') );
                if ( $delete_video != false ) {

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
		
	} // end of - delete_video
	
	public function get_reference()
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( 'REFERENSI', 'R' ) === true ) {
	         
	         $this->load->model('Asset_category_model');
	         $this->load->model('Asset_cycle_model');
	         $this->load->model('Asset_origin_model');
	         $this->load->model('Asset_status_model');

    		// create result
    		$result = array(
    			'status' => 'success',
    			'message' => null,
    			'elapsed_time' => $this->benchmark->elapsed_time(),
    			'asset_category' => $this->Asset_category_model->get(),
    			'asset_cycle' => $this->Asset_cycle_model->get(),
    			'asset_origin' => $this->Asset_origin_model->get(),
    			'asset_status' => $this->Asset_status_model->get(),
    		);

    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - get_reference
	
	/** FACILITY **/
	public function get_facility( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( 'DATAPOKOK', 'R' ) === true ) {
	        
	        $this->load->model('Asset_model');
    		$asset_detail = $this->Asset_model->asset_detail($asset_id);
    		if ( !empty($asset_detail) ){
    		    
    		    $asset['id'] = $asset_detail->id;
    		    $asset['asset_code'] = $asset_detail->asset_code;
    		    $asset['asset_name'] = $asset_detail->asset_name;
    		    
    		    $this->load->model('Facility_model');
    		    $facility = $this->Facility_model->get_facility($asset_detail->id);
                $asset['facility'] = null;
                if ( !empty($facility) ){
                    $this->load->helper('iddate_helper');
                    foreach ( $facility as $i => $facility ){
                        // tipe fasilitas 
                        $type_detail = $this->Facility_model->facility_type_detail($facility->type);
                        $facility->type_name = ( !empty($type_detail) ) ? $type_detail->name : 'N/A'  ;
                        $asset['facility'][$i] = $facility;
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
		
	} // end of - get_facility
	
	public function get_facility_type()
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted('REFERENCE') === true ) {
	         
	         $this->load->model('Facility_model');

    		// create result
    		$result = array(
    			'status' => 'success',
    			'message' => null,
    			'elapsed_time' => $this->benchmark->elapsed_time(),
    			'facility_type' => $this->Facility_model->get_facility_type(),
    		);

    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - get_reference
	
	public function add_facility( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('asset/update_facility') === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $new_type = $this->input->post('new_type');
            if ( empty($new_type) ){
                $this->form_validation->set_rules('type', 'Jenis Fasilitas', 'required|numeric');
            }
            $this->form_validation->set_rules('has_value', 'Nilai', 'required|numeric');
            $has_value = $this->input->post('has_value');
            if ( $has_value == '1' ){
                $this->form_validation->set_rules('value', 'Nilai', 'required|numeric');
            }
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {
                
                $this->load->model('Facility_model');
                
                if ( !empty($new_type) ){
                    //echo 'aa';
                    $type_id = $this->Facility_model->insert_facility_type( array( 'name' => $this->lman_security->clean_post('new_type') ) );
                }else{
                    $type_id = $this->lman_security->clean_post('type');
                }

                $detail = array(
                    'asset_id' => $asset_id,
                    'type' => $type_id,
                    'value' => $this->lman_security->clean_post('value'),
                    'unit' => $this->lman_security->clean_post('unit'),
                );
                
                $facility_id = $this->Facility_model->insert_facility($detail);
                if ($facility_id != false) {

                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'facility_id' => $facility_id,
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
		
	} // end of - add_facility
	
	public function update_facility( $facility_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('asset/update_facility') === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $new_type = $this->input->post('new_type');
            if ( empty($new_type) ){
                $this->form_validation->set_rules('type', 'Jenis Fasilitas', 'required|numeric');
            }
            $this->form_validation->set_rules('has_value', 'Nilai', 'required|numeric');
            $has_value = $this->input->post('has_value');
            if ( $has_value == '1' ){
                $this->form_validation->set_rules('value', 'Nilai', 'required|numeric');
            }
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {
                
                $this->load->model('Facility_model');
                
                if ( !empty($new_type) ){
                    //echo 'aa';
                    $type_id = $this->Facility_model->insert_facility_type( array( 'name' => $this->lman_security->clean_post('new_type') ) );
                }else{
                    $type_id = $this->lman_security->clean_post('type');
                }

                $detail = array(
                    'type' => $type_id,
                    'value' => $this->lman_security->clean_post('value'),
                    'unit' => $this->lman_security->clean_post('unit'),
                );
                
                $facility_update = $this->Facility_model->update_facility($facility_id,$detail);
                if ($facility_update != false) {

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
		
	} // end of - update_facility
	
	public function delete_facility( $facility_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('asset/update_facility') === true ) {
	         
            $this->load->model('Facility_model');
            $delete_facility = $this->Facility_model->delete_facility( $facility_id );
            if ( $delete_facility != false ) {

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
		
	} // end of - delete_facility
	
	/** PUBLIC FACILITY **/
	public function get_public_facility( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( 'DATAPOKOK', 'R' ) === true ) {
	        
	        $this->load->model('Asset_model');
    		$asset_detail = $this->Asset_model->asset_detail($asset_id);
    		if ( !empty($asset_detail) ){
    		    
    		    $asset['id'] = $asset_detail->id;
    		    $asset['asset_code'] = $asset_detail->asset_code;
    		    $asset['asset_name'] = $asset_detail->asset_name;
    		    
    		    $this->load->model('Facility_model');
    		    $public_facility = $this->Facility_model->get_public_facility($asset_detail->id);
                $asset['public_facility'] = null;
                if ( !empty($public_facility) ){
                    $this->load->helper('iddate_helper');
                    foreach ( $public_facility as $i => $public_facility ){
                        // tipe fasilitas 
                        $type_detail = $this->Facility_model->public_facility_type_detail($public_facility->type);
                        $public_facility->type_name = ( !empty($type_detail) ) ? $type_detail->name : 'N/A'  ;
                        $asset['public_facility'][$i] = $public_facility;
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
		
	} // end of - get_public_facility
	
	public function get_public_facility_type()
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted('REFERENCE') === true ) {
	         
	         $this->load->model('Facility_model');

    		// create result
    		$result = array(
    			'status' => 'success',
    			'message' => null,
    			'elapsed_time' => $this->benchmark->elapsed_time(),
    			'public_facility_type' => $this->Facility_model->get_public_facility_type(),
    		);

    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - get_reference
	
	public function add_public_facility( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('asset/update_facility') === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $new_type = $this->input->post('new_type');
            if ( empty($new_type) ){
                $this->form_validation->set_rules('type', 'Jenis Fasum', 'required|numeric');
            }
            $this->form_validation->set_rules('distance', 'Jarak', 'required|numeric');
            
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {
                
                $this->load->model('Facility_model');
                
                if ( !empty($new_type) ){
                    //echo 'aa';
                    $type_id = $this->Facility_model->insert_public_facility_type( array( 'name' => $this->lman_security->clean_post('new_type') ) );
                }else{
                    $type_id = $this->lman_security->clean_post('type');
                }

                $detail = array(
                    'asset_id' => $asset_id,
                    'type' => $type_id,
                    'name' => $this->lman_security->clean_post('name'),
                    'distance' => $this->lman_security->clean_post('distance'),
                );
                
                $public_facility_id = $this->Facility_model->insert_public_facility($detail);
                if ($public_facility_id != false) {

                    $result = array(
                        'status' => 'success',
                        'message' => null,
        				'elapsed_time' => $this->benchmark->elapsed_time(),
                        'public_facility_id' => $public_facility_id,
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
		
	} // end of - add_public_facility
	
	public function update_public_facility( $public_facility_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('asset/update_facility') === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $new_type = $this->input->post('new_type');
            if ( empty($new_type) ){
                $this->form_validation->set_rules('type', 'Jenis Fasum', 'required|numeric');
            }
            $this->form_validation->set_rules('distance', 'Jarak', 'required|numeric');
            
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {
                
                $this->load->model('Facility_model');
                
                if ( !empty($new_type) ){
                    //echo 'aa';
                    $type_id = $this->Facility_model->insert_public_facility_type( array( 'name' => $this->lman_security->clean_post('new_type') ) );
                }else{
                    $type_id = $this->lman_security->clean_post('type');
                }

                $detail = array(
                    'type' => $type_id,
                    'name' => $this->lman_security->clean_post('name'),
                    'distance' => $this->lman_security->clean_post('distance'),
                );
                
                $public_facility_update = $this->Facility_model->update_public_facility($public_facility_id,$detail);
                if ($public_facility_update != false) {

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
		
	} // end of - update_public_facility
	
	public function delete_public_facility( $public_facility_id=null )
	{
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('asset/update_facility') === true ) {
	         
            $this->load->model('Facility_model');
            $delete_public_facility = $this->Facility_model->delete_public_facility( $public_facility_id );
            if ( $delete_public_facility != false ) {

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
		
	} // end of - delete_public_facility
	
    // update_readiness - melengkapi atau update data kesiapan aset untuk dipasarkan
	public function update_readiness( $asset_id=null )
	{
	    //$this->output->enable_profiler(true);
	    $this->lman_security->validate_request_method('POST');
	    if ( $this->access_control->access_granted('asset/update_readiness') === true ) {
	         
            // start form validations
            $this->load->library('form_validation');
            $this->form_validation->set_rules('free_and_clear_status', 'Status Free and Clear', 'required');
            $this->form_validation->set_rules('ready_to_market', 'Kesiapan Aset', 'required|exact_length[1]|numeric');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $result = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            } else {
                
                // if validations returns TRUE
                unset($error);
                $error = '';
                
                $free_and_clear_status = $this->lman_security->clean_post('free_and_clear_status');
                $ready_to_market = $this->lman_security->clean_post('ready_to_market');
                
                if ( $ready_to_market == '1' AND $free_and_clear_status != 'Free and Clear' ) {
                    $error .= 'Hanya aset dengan status Free and Clear yang dapat ditetapkan siap untuk dipasarkan.';
                }
                
                if ( !isset($error) OR $error == '' ) { // jika tidak ada error

                    $asset_detail = array(
                        'free_and_clear_status' => $free_and_clear_status,
                        'ready_to_market' => ( empty($ready_to_market) ) ? 0 : $ready_to_market,
                    );
                    
                    $asset_update = $this->Asset_model->update_asset($asset_id,$asset_detail);
                    if ($asset_update != false) {
    
                        $result = array(
                            'status' => 'success',
                            'message' => null,
            				'elapsed_time' => $this->benchmark->elapsed_time(),
                            'asset_id' => $asset_id,
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
                            'message' => $error
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
		
	} // end of - update_readiness
	
    // check_asset_code
	public function check_asset_code( $asset_code=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( 'DATAPOKOK', 'R' ) === true ) {
	         
    		$asset_detail = $this->Asset_model->asset_detail_by_code($asset_code);
    		if ( !empty($asset_detail) ){
    		    
    		    $asset['id'] = $asset_detail->id;
    		    $asset['asset_code'] = $asset_detail->asset_code;
    		    $asset['asset_name'] = $asset_detail->asset_name;
    		    
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
    					'message' => 'Data aset kosong / tidak ditemukan.'
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
	
	public function revenue_by_year($asset_id=null)
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted( 'ASSET_READ' ) === true ) {
	        
        	$this->load->model('Payment_model');
	        $year_end = date('Y');
	        
	        $cash_basis_revenue = array();
	        for ( $i = 2015; $i <= $year_end; $i++ ){
        		$cash_basis_revenue[$i] = $this->Payment_model->total_payment($i.'-01-31', $i.'-12-31',$asset_id);
	        }
	        
        	$this->load->model('Invoice_model');
	        $year_end = date('Y');
	        
	        $accrual_basis_revenue = array();
	        for ( $i = 2015; $i <= $year_end; $i++ ){
        		$accrual_basis_revenue[$i] = $this->Invoice_model->total_billed_amount($i.'-01-31', $i.'-12-31',$asset_id);
	        }
	        
    		// create result
    		$result = array(
    			'status' => 'success',
    			'message' => null,
    			'elapsed_time' => $this->benchmark->elapsed_time(),
    			'cash_basis_revenue' => $cash_basis_revenue,
    			'accrual_basis_revenue' => $accrual_basis_revenue
    		);

    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - revenue_by_year
	
    // fungsi bantuan utk cek apakah array yg dipost punya value
    private function array_has_value($arr) {
        if (is_array($arr)) {
            foreach ($arr as $key => $value) {
                if (!empty($value) || $value != NULL || $value != "") {
                    return true;
                    break;
                    //stop the process we have seen that at least 1 of the array has value so its not empty
                }
            }

            return false;
        }
    }
    // akhir - array_has_value

} // akhir - class
