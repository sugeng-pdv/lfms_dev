<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
	public function get_asset_stats()
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted('ASSET_READ') === true ) {

            $this->load->model('Asset_model');
            $this->load->model('Asset_category_model');
            $this->load->model('Asset_origin_model');
            $this->load->model('Asset_status_model');
            
            // total aset
            $total = $this->Asset_model->count_asset();
            
            // aset berdasarkan kategori
            $asset_category = $this->Asset_category_model->get();
            $category = array();
            if ( !empty($asset_category) ){
                foreach ($asset_category as $asset_category){
                    $category[$asset_category->id]['name'] = $asset_category->name;
                    $category[$asset_category->id]['asset_number'] = $this->Asset_model->count_asset( $keyword = null, $asset_status=null, $asset_origin=null, $asset_category->id, $province_id=null, $city_id=null, $ready_to_market=null );
                    $category[$asset_category->id]['percentage'] = round(($category[$asset_category->id]['asset_number']/$total)*100, 2);
                }
            }
            
            // aset berdasarkan asal aset
            $asset_origin = $this->Asset_origin_model->get();
            $origin = array();
            if ( !empty($asset_origin) ){
                $search = array('Eks Hak Tanggungan Bank Indonesia (HTBI)','Eks PT Perusahaan Pengelola Aset (PPA)');
                $replace = array('Eks HTBI','Eks PT PPA');                
                foreach ($asset_origin as $asset_origin){
                    $origin[$asset_origin->id]['name'] = str_replace($search,$replace,$asset_origin->name);
                    $origin[$asset_origin->id]['asset_number'] = $this->Asset_model->count_asset( $keyword = null, $asset_status=null, $asset_origin->id, $asset_category=null, $province_id=null, $city_id=null, $ready_to_market=null );
                    $origin[$asset_origin->id]['percentage'] = round(($origin[$asset_origin->id]['asset_number']/$total)*100, 2);
                }
            }
            
            // aset berdasarkan status free and clear
            $ref_free_and_clear = array(
                'Free and Clear','Free but Non Clear','Clear but Non Free','Non Free and Non Clear'
                );
            $total_data = 0;
            foreach ($ref_free_and_clear as $i => $ref_free_and_clear){
                $free_and_clear_status[$i]['name'] = str_replace('and','&amp;',$ref_free_and_clear);
                $free_and_clear_status[$i]['asset_number'] = $this->Asset_model->count_asset( $keyword = null, $asset_status=null, $asset_origin=null, $asset_category=null, $province_id=null, $city_id=null, $ready_to_market=null, $ref_free_and_clear );
                $total_data = $total_data + $free_and_clear_status[$i]['asset_number'];
                $free_and_clear_status[$i]['percentage'] = round(($free_and_clear_status[$i]['asset_number']/$total)*100, 2);
            }
            $free_and_clear_status[$i+1]['name'] = 'Data belum lengkap';
            $free_and_clear_status[$i+1]['asset_number'] = $total - $total_data;
            $free_and_clear_status[$i+1]['percentage'] = round(($free_and_clear_status[$i+1]['asset_number']/$total)*100, 2);
            
            // aset berdasarkan kesiapan untuk dipasarkan
            $readiness['Belum Siap'] = $this->Asset_model->count_asset( $keyword = null, $asset_status=null, $asset_origin=null, $asset_category=null, $province_id=null, $city_id=null, 0 );
            $readiness['Siap Dipasarkan'] = $this->Asset_model->count_asset( $keyword = null, $asset_status=null, $asset_origin=null, $asset_category=null, $province_id=null, $city_id=null, 1 );
            
            // aset berdasarkan status optimalisasi
            $asset_status = $this->Asset_status_model->get();
            $status = array();
            if ( !empty($asset_status) ){
                $total_data = 0;
                foreach ($asset_status as $asset_status){
                    $status[$asset_status->id]['name'] = $asset_status->name;
                    $status[$asset_status->id]['asset_number'] = $this->Asset_model->count_asset( $keyword = null, $asset_status->id, $asset_origin=null, $asset_category=null, $province_id=null, $city_id=null, $ready_to_market=null );
                    $total_data = $total_data + $status[$asset_status->id]['asset_number'];
                    $status[$asset_status->id]['percentage'] = round(($status[$asset_status->id]['asset_number']/$total)*100, 2);
                    
                    $i = $asset_status->id + 1;
                }
                $status[$i]['name'] = 'Data belum lengkap';
                $status[$i]['asset_number'] = $total - $total_data;
                $status[$i]['percentage'] = round(($status[$i]['asset_number']/$total)*100, 2);
                
            }
            
            // jumlah aset berdasarkan tahun rekuisisi
            $this->load->model('Dashboard_model');
            for ( $year=2015; $year<=date('Y'); $year++ ){
                $requisition[$year] = $this->Dashboard_model->countAssetByHandoverYear($year);
            }
            
    		// create result
    		$result = array(
    			'status' => 'success',
    			'message' => null,
    			'elapsed_time' => $this->benchmark->elapsed_time(),
    			'total' => $total,
    			'category' => $category,
    			'origin' => $origin,
    			'readiness' => $readiness,
    			'free_and_clear_status' => $free_and_clear_status,
    			'optimalization_status' => $status,
    			'requisition' => $requisition
    		);
    
    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
		
	} // end of - get_payment
    
	public function revenue_by_year()
	{
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted('ASSET_READ') === true ) {
	        
        	$this->load->model('Payment_model');
	        $year_end = date('Y');
	        
	        $cash_basis_revenue = array();
	        for ( $i = 2015; $i <= $year_end; $i++ ){
        		$cash_basis_revenue[$i] = $this->Payment_model->total_payment($i.'-01-31', $i.'-12-31');
	        }
	        
        	$this->load->model('Invoice_model');
	        $year_end = date('Y');
	        
	        $accrual_basis_revenue = array();
	        for ( $i = 2015; $i <= $year_end; $i++ ){
        		$accrual_basis_revenue[$i] = $this->Invoice_model->total_billed_amount($i.'-01-31', $i.'-12-31');
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
	
	/* dashboard perjanjian
	- EWS perjanjian berakhir
	- EWS penerbitan invoice
	- jumlah perjanjian aktif
	- jumlah perjanjian dari tahun ke tahun
	*/
	public function contract_stats(){
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted('ASSET_READ') === true ) {
	        
        	$this->load->model('Contract_model');
        	
	        $year_end = date('Y');
	        $contract_by_year = array();
	        for ( $i = 2015; $i <= $year_end; $i++ ){
	            $jml_kontrak = $this->Contract_model->count( $contract_number = null, $i.'-01-31', $i.'-12-31');
        		$contract_by_year[$i] = ( !empty($jml_kontrak) ? $jml_kontrak : 0 );
	        }
	        
	        $contract_due_soon = $this->Contract_model->due_soon();
	        $contract_open = $this->Contract_model->count( null, null, null, null, null, 'OPEN' );
	        $contract_close = $this->Contract_model->count( null, null, null, null, null, 'CLOSE' );

    		// create result
    		$result = array(
    			'status' => 'success',
    			'message' => null,
    			'elapsed_time' => $this->benchmark->elapsed_time(),
    			'contract_stats' => array(
    			        'due_soon' => ( !empty($contract_due_soon) ) ? count($contract_due_soon) : 0,
    			        'open' => $contract_open,
    			        'close' => $contract_close
    			    ),
    			'contract_by_year' => $contract_by_year,
    		);

    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
    
    /* dashboard kewajiban
    - Proyeksi nilai kewajiban
    - nilai kewajiban yang belum dibayar
    - nilai kewajiban yang sudah lunas
    - grafik kewajiban dari tahun ke tahun
    */
	public function duty_stats(){
	    $this->lman_security->validate_request_method('GET');
	    if ( $this->access_control->access_granted('ASSET_READ') === true ) {
	        
        	$this->load->model('Duty_model');
	        $year_end = date('Y');
	        $duty_by_year = array();
	        for ( $i = 2015; $i <= $year_end; $i++ ){
	            $total_duty = $this->Duty_model->total_duty($i.'-01-31', $i.'-12-31');
        		$duty_by_year[$i] = ( !empty($total_duty) ) ? $total_duty : 0;
	        }
	        
    		// create result
    		$result = array(
    			'status' => 'success',
    			'message' => null,
    			'elapsed_time' => $this->benchmark->elapsed_time(),
    			'due_soon' => $this->Duty_model->due_soon(),
    			'over_due' => $this->Duty_model->over_due(),
    			'duty_by_year' => $duty_by_year,
    		);

    	} else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }

        // json result
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
    
    
}