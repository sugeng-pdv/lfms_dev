<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Name		: Asset (Controller)
| Author	: Brana Pandega
|--------------------------------------------------------------------------
*/

class Public_asset extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Asset_model');
        
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: authorization");

		// enable profiler cukup disini
		//$this->output->enable_profiler(true);
		
    }
    
	public function index(){ $this->get(); }
	
    // get_asset
	public function get()
	{
	    // sleep(3);

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
    		    $asetArr = [];
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
                        $assets[$i]['primary_image_s3_object'] = $primary_image->s3_object;
                    } else {
                        $assets[$i]['primary_image_url'] = $this->config->item('image_url_crop').'200/200/s3-lman/mobile/noimage.jpg';
                        $assets[$i]['primary_image_s3_object'] = 'mobile/noimage.jpg';
                    }
                    
                    array_push($asetArr,$assets[$i]);
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
    				'data' => $asetArr
    			);
    
    	}else{
    		// create result
    		$result = array(
    				'status' => 'error',
    				'message' => 'Tidak ditemukan data aset dengan kriteria yang diminta.'
    		);
    	}
		
        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - get_asset
	
    // asset_detail
	public function detail( $asset_id=null )
	{

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
                $asset['image'] = [];
                if (!empty($image)) {
                    $i = 1;
                    foreach( $image as $image ){
                        $foto_aset[$i]['thumb'] = $this->config->item('image_url_crop').'300/300/'.$primary_image->s3_bucket.'/'.$image->s3_object;
                        $foto_aset[$i]['full'] = $this->config->item('image_url_full').$primary_image->s3_bucket.'/'.$image->s3_object;
                        $foto_aset[$i]['s3_bucket'] = $image->s3_bucket;
                        $foto_aset[$i]['s3_object'] = $image->s3_object;
                        $foto_aset[$i]['image_id'] = $image->id;
                        array_push( $asset['image'], $foto_aset[$i] );
                        $i++;
                    }
                }
                
                // video
                $video = $this->Asset_model->get_video($asset_detail->id);
                $asset['video'] = [];
                if (!empty($video)) {
                    $i = 1;
                    foreach( $video as $video ){
                        $video_aset[$i]['video_id'] = $video->id;
                        $video_aset[$i]['video_url'] = $video->video_url;
                        
                        parse_str( parse_url( $video->video_url, PHP_URL_QUERY ), $array_of_vars );

                        $video_aset[$i]['video_embed'] = 'https://www.youtube.com/embed/'.$array_of_vars['v'].'?rel=0&autoplay=0&showinfo=0&controls=0';
                        
                        array_push( $asset['video'], $video_aset[$i] );

                        $i++;
                    }
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
		
        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - asset_detail
	
    // get_asset
	public function get_top_category()
	{
	    // sleep(3);

        // page
        $page = 1;

        // per page
        $per_page = intval($this->input->get('per_page',true));
        if (empty($per_page) OR is_numeric($per_page) !== true) {
            $per_page = 10;
        }
            
        // keyword
        $keyword = null;

        // asset_status
        $asset_status = null;

        // asset_origin
        $asset_origin = null;

        // provinsi
        $province_id = null;

        // kota
        $city_id = null;
        $province_id = null; 

        // ready_to_market
        $ready_to_market = null;

        // free and clear status
        $free_and_clear_status = null;

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
        
        // kategori, sementara hardcode, nantinya ada kriteria yg diambil, misal dari popularitas atau preferensi pengunjung
        $topKategori[0] = (object) array(
                            'id' => 5,
                            'name' => 'Apartemen'
                        );
                        
        $topKategori[1] = (object) array(
                            'id' => 2,
                            'name' => 'Ruko'
                        );
                        
        $topKategori[2] = (object) array(
                            'id' => 3,
                            'name' => 'Gedung'
                        );
                        
        $topKategori[3] = (object) array(
                            'id' => 1,
                            'name' => 'Tanah'
                        );
        
        $assetArr = [];
        
        foreach ( $topKategori as $i => $topKategori ){
            $kategori[$i]['id'] = $topKategori->id;
            $kategori[$i]['name'] = $topKategori->name;
    	    $asset = $this->Asset_model->get_asset($per_page,$offset=0, $order_by, $keyword, $asset_status, $asset_origin, array($topKategori->id), $province_id, $city_id, $ready_to_market=1, $free_and_clear_status, $lat_min, $lat_max, $lng_min, $lng_max);
            $kategori[$i]['aset'] = ( !empty($asset) ) ? $this->tataDataAset($asset) : null;
            
            // push array
            array_push($assetArr,$kategori[$i]);
        }

    	$result = array(
    				'status' => 'success',
    				'message' => null,
    				'elapsed_time' => $this->benchmark->elapsed_time(),
    				'data' => $assetArr
    	);
		
        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - get_asset
	
	private function tataDataAset( $dataAset )
	{
	    $this->load->model('Location_model');
	    $i = 1; // $i = urutan
	    $asetArr = [];
    		    foreach ( $dataAset as $asset ){
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
                        $assets[$i]['primary_image_url'] = $this->config->item('image_url_crop').'200/200/'.$primary_image->s3_object;
                        $assets[$i]['primary_image_s3_object'] = $primary_image->s3_object;
                    } else {
                        $assets[$i]['primary_image_url'] = $this->config->item('image_url_crop').'200/200/mobile/noimage.jpg';
                        $assets[$i]['primary_image_s3_object'] = 'mobile/noimage.jpg';
                    }
                    
                    array_push($asetArr,$assets[$i]);
                    $i++;
    		    }
    	return $asetArr;
	} // akhir tataDataAset
	
	public function get_reference()
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted('REFERENCE') === true ) {
	         
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
	    if ( $this->access_control->access_granted('ASSET_READ') === true ) {
	        
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
	
	/** PUBLIC FACILITY **/
	public function get_public_facility( $asset_id=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted('ASSET_READ') === true ) {
	        
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
	
    // check_asset_code
	public function check_asset_code( $asset_code=null )
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted('ASSET_READ') === true ) {
	         
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
