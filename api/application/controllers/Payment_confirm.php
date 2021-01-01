<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Payment_confirm extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
    
        // if ( $this->access_control->access_granted( '', 'R' ) === true ) {
        // if (VALID_LOGIN === true ) {
        // } else {
        //     $result = array(
        //         'status' => 'error',
        //         'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
        //     );
        // }
        
    function spp_save_post(){
        // if ( $this->access_control->access_granted( '', 'R' ) === true ) {
        if (VALID_LOGIN === true ) {
            $postdata = ($_POST);
            $this->load->library('form_validation');
            // payment_type: Langsung
            // payment_to: Warga
            $this->form_validation->set_rules('date_transfer', 'Tanggal Transfer', 'required');
            $this->form_validation->set_rules('id_doc_si', 'Dokumen Surat Intruksi Pembayaran', 'required');
            $this->form_validation->set_rules('receipt_num', 'Nomor Kuitansi', 'required');
            $this->form_validation->set_rules('id_doc_bt', 'Dokumen Bukti Transfer', 'required');
            
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $this->response( array('status'=>'error',
                        'message'=>validation_errors()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else {
                    $data = array(
                        'transfer_date' =>  $this->lman_security->clean_post('date_transfer'),
                        'doc_si_id'     =>  $this->lman_security->clean_post('id_doc_si'),
                        'receipt_number'=>  $this->lman_security->clean_post('receipt_num'),
                        'doc_bt_id'     =>  $this->lman_security->clean_post('id_doc_bt'),
                        'status_spp'    =>  'Terbayar'
                    );
                    //   'status'    =>'ACTIVE'
                $this->load->model('Spp_model');
                $this->load->model('ProcessSpp_model');
                
                // die();
                $id = $this->lman_security->clean_post('id');
                $data_id = $this->Spp_model->update($data,array('id'=>$id));
                // print_r($id);die(); 
                if (!$data_id){
                    $this->response( array('status'=>'error',
                        'message'=>"Gagal Simpan data ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $data_timeline = $this->ProcessSpp_model->db->get_where('timeline_spp',array('id'=> $id,'name'=>'Transfer'));
                    if ($data_timeline->num_rows() == 0){
                        $dataInsert = array(
                        'spp_id'=>$id,
                        'name'=>'Transfer',
                        'timeline_id'=>6,
                        'description'=>'Transfer',
                        'date'=>date("Y-m-d H:i:s"),
                        );
                        $updateTimeline = $this->ProcessSpp_model->insert($dataInsert);
                        if (!$updateTimeline){
                            $this->response( array('status'=>'error',
                                'message'=>"Gagal Simpan Data Timeline ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                        } else {
                            $this->response(array('status'=>'success','message'=>'Berhasil Simpan'));
                        }
                    } else {
                        $this->response(array('status'=>'success','message'=>'Berhasil Simpan'));
                    }
                }
            }
        } else {
            $this->response( array('status'=>'error',
                            'message'=>"Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    function get_sector_psn_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Sector_model');
            $result= $this->Sector_model->getDataSelect();
            $dataArr = array();
            if(!empty($result)){
                foreach ( $result as $menu ){
                    $array_detail['id']      = $menu->id;
                    $array_detail['name']    = $menu->name;
                    array_push($dataArr,$array_detail);
                }
                $this->response(array(
                    'status'=>'success',
                    'message'=>'',
                    'elapsed_time' => $this->benchmark->elapsed_time(),
        			'data' => $dataArr
                ));
            }else{
                $this->response( array('status'=>'failure',
                    'message'=>'Data Kosong'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }
    }
    function get_name_psn_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Psn_model');
            $result= $this->Psn_model->getDataSelect();
            $dataArr = array();
            if(!empty($result)){
                foreach ( $result as $menu ){
                    $array_detail['id']      = $menu->id;
                    $array_detail['name']    = $menu->name;
                    $array_detail['tahun']    = $menu->fiscal_year;
                    array_push($dataArr,$array_detail);
                }
                $this->response(array(
                    'status'=>'success',
                    'message'=>'',
                    'elapsed_time' => $this->benchmark->elapsed_time(),
        			'data' => $dataArr
                ));
            }else{
                $this->response( array('status'=>'failure',
                    'message'=>'Data Kosong'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }
    }
    function get_data_spp_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Spp_model');
            $this->load->model('Bidang_model');
            $result= $this->Spp_model->getDataSpp();
            $dataArr = array();
            if(!empty($result)){
                foreach ( $result as $data ){
                    $totalRealisasi = $this->Bidang_model->getRealisasiPPK($data->id);
                    // print_r($totalRealisasi);die();
                    $sisaAnggaran   = $data->nominal - ($totalRealisasi->realization);
                    $array_detail['id']         = $data->id;
                    $array_detail['spp_no']     = $data->spp_num;
                    $array_detail['spp_gk_no']  = $data->spp_gk_num;
                    $array_detail['psn_name']   = $data->psn_name;
                    $array_detail['psn_type']   = $data->payment_type;
                    $array_detail['payment_to'] = $data->payment_to;
                    $array_detail['nominal']    = $data->nominal;
                    $array_detail['remain_budget']= $sisaAnggaran;
                    $array_detail['realization'] = $totalRealisasi->realization;
                    $array_detail['status_spp'] = $data->status_spp;
                    $array_detail['nominal_idr']= $this->general_library->format_rupiah($data->nominal);
                    array_push($dataArr,$array_detail);
                }
                $this->response(array(
                    'status'=>'success',
                    'message'=>'',
                    'elapsed_time' => $this->benchmark->elapsed_time(),
        			'data' => $dataArr
                ));
            }else{
                $this->response( array('status'=>'failure',
                    'message'=>'Data Kosong'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }
    }
    function get_name_bank_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Bank_model');
            $result= $this->Bank_model->getDataSelect();
            $dataArr = array();
            if(!empty($result)){
                foreach ( $result as $menu ){
                    $array_detail['id']      = $menu->id;
                    $array_detail['name']    = $menu->name;
                    array_push($dataArr,$array_detail);
                }
                $this->response(array(
                    'status'=>'success',
                    'message'=>'',
                    'elapsed_time' => $this->benchmark->elapsed_time(),
        			'data' => $dataArr
                ));
            }else{
                $this->response( array('status'=>'failure',
                    'message'=>'Data Kosong'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }
    }
    















    function role_data_post() {
        $postdata = ($_POST);
        $this->load->model('role_model');
        $result= $this->role_model->getData();
        $this->response($result, 200);
    }
    
    function role_delete_post(){
        $this->load->model('role_model');
        $data_id = $this->role_model->update(array('status' => 'INACTIVE'),array('id'=>$this->post('id')));
            if (!$data_id){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                $this->response(array('status'=>'success','message'=>'Berhasil Dihapus'));
            }
    }
    function role_save_post(){
        $postdata = ($_POST);
        $data = array(
              'name' =>  $postdata['name'],
              'description' => $postdata['description']
            );
            //   'status'    =>'ACTIVE'
        $this->load->model('role_model');
        if($postdata['status'] == 'add'){
            $data_id = $this->role_model->insert($data);
        }else{
            $data_id = $this->role_model->update($data,array('id'=>$this->post('id')));
        }
        if (!$data_id){
            $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            $this->response(array('status'=>'success','message'=>'Berhasil Simpan'));
        }
        
    }



















    

}
