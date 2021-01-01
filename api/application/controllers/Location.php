<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Name		: Location (Controller)
| Author	: Brana Pandega
|--------------------------------------------------------------------------
*/

class Location extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Location_model');

		// enable profiler cukup disini
		//$this->output->enable_profiler(true);
		
    }
    
	public function index(){ /* DO NOTHING */ }
	
    // get_province
	public function get_province()
	{

		$province = $this->Location_model->get_province();
		if ( !empty($province) ){

			// create result
			$result = array(
				'status' => 'success',
				'message' => null,
				'elapsed_time' => $this->benchmark->elapsed_time(),
				'data' => $province
			);

		}else{
			// create result
			$result = array(
					'status' => 'error',
					'message' => 'Data provinsi kosong.'
			);
		}
		
		// json result
		$this->output->set_content_type('application/json')->set_output(json_encode( $result ));
		
	} // end of - get_province
	
    // province_detail
	public function province_detail($province_id=null)
	{
		$province = $this->Location_model->detail_province($province_id);
		if ( !empty($province) ){

			// create result
			$result = array(
				'status' => 'success',
				'message' => null,
				'elapsed_time' => $this->benchmark->elapsed_time(),
				'data' => $province
			);

		}else{
			// create result
			$result = array(
					'status' => 'error',
					'message' => 'Data provinsi tidak ditemukan.'
			);
		}
		
		// json result
		$this->output->set_content_type('application/json')->set_output(json_encode( $result ));
		
	} // end of - province_detail
	
	public function get_city($province_id=null)
	{
		
		$city = $this->Location_model->get_city($province_id);
		if ( !empty($city) ){

			// create result
			$result = array(
				'status' => 'success',
				'message' => null,
				'elapsed_time' => $this->benchmark->elapsed_time(),
				'city' => $city
			);

		}else{
			// create result
			$result = array(
					'status' => 'error',
					'message' => 'Data kota kosong.'
			);
		}
		
		// json result
		$this->output->set_content_type('application/json')->set_output(json_encode( $result ));
		
	} // end of - get_city
	
    // city_detail
	public function city_detail($city_id=null)
	{
        
		$city = $this->Location_model->city_detail($city_id);
		if ( !empty($city) ){

			// create result
			$result = array(
				'status' => 'success',
				'message' => null,
				'elapsed_time' => $this->benchmark->elapsed_time(),
				'data' => $city
			);

		}else{
			// create result
			$result = array(
					'status' => 'error',
					'message' => 'Data kota tidak ditemukan.'
			);
		}
		
		// json result
		$this->output->set_content_type('application/json')->set_output(json_encode( $result ));
		
	} // end of - city_detail

} // akhir - class
