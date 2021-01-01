<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Spp extends REST_Controller {
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
            $this->form_validation->set_rules('psn_sector', 'Sektor PSN', 'required');
            $this->form_validation->set_rules('payment_type', 'Jenis Pembayaran', 'required');
            $this->form_validation->set_rules('payment_to', 'Pembayaran untuk ?', 'required');
            $this->form_validation->set_rules('psn_name_data', 'Nama PSN', 'required');
            $this->form_validation->set_rules('spp_num', 'Nomor SPP', 'required');
            $this->form_validation->set_rules('spp_date', 'Tanggal SPP', 'required');
            $this->form_validation->set_rules('value', 'Nilai Nominal', 'required');
            $this->form_validation->set_rules('field_count', 'Jumlah Bidang', 'required');
            $this->form_validation->set_rules('non_field_count', 'Jumlah Non Bidang', 'required');
            $this->form_validation->set_rules('spp_gk_num', 'Nomor SPP GK PPK', 'required');
            $this->form_validation->set_rules('area', 'Luasan', 'required');
            $this->form_validation->set_rules('id_doc_spp', 'Dokumen SPP', 'required');
            $this->form_validation->set_rules('id_doc_sptjm', 'Dokumen SPTJM', 'required');
            $this->form_validation->set_rules('id_doc_letter', 'Dokumen Surat Kesesuaian Dokumen', 'required');
            $this->form_validation->set_rules('id_doc_bpn', 'Dokumen Validasi BPN', 'required');
            

            if($this->lman_security->clean_post('payment') ==='Langsung' && $this->lman_security->clean_post('payment_to') != 'Warga'){
                $this->form_validation->set_rules('bank_id', 'Nomor Rekening', 'required');
                $this->form_validation->set_rules('bank_name_data', 'Nama Bank', 'required');
            }
            
            
            
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $this->response( array('status'=>'error',
                        'message'=>validation_errors()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else {
                $nonField = str_replace(".","",$this->lman_security->clean_post('non_field_count'));
                $field = str_replace(".","",$this->lman_security->clean_post('field_count'));
                $ttlField =  ($field == '') ? 0 : $field ;
                $ttlNonField = ($nonField == '') ? 0 : $nonField;
                $ttlAll     = $ttlField + $ttlNonField;
                // print_r($ttlAll);die();
                    $data = array(
                        'psn_id'=>$this->lman_security->clean_post('psn_name_data'),
                        'payment_type'=>$this->lman_security->clean_post('payment_type'),
                        'payment_to'=>$this->lman_security->clean_post('payment_to'),
                        'spp_num'=>$this->lman_security->clean_post('spp_num'),
                        'spp_gk_num'=>$this->lman_security->clean_post('spp_gk_num'),
                        'date'=>$this->lman_security->clean_post('spp_date'),
                        'nominal'=>str_replace(".","",$this->lman_security->clean_post('value')),//
                        'nominal_realization'=>str_replace(".","",$this->lman_security->clean_post('value')),//
                        'field_count'=>str_replace(".","",$this->lman_security->clean_post('field_count')),//
                        'non_field_count'=>str_replace(".","",$this->lman_security->clean_post('non_field_count')),//
                        'area'=>str_replace(".","",$this->lman_security->clean_post('area')),
                        'area_realization'=>str_replace(".","",$this->lman_security->clean_post('area')),
                        'total_field'=>$ttlAll,
                        'document_id'=>$this->lman_security->clean_post('id_doc_spp'),
                        'doc_sptjm_id'=>$this->lman_security->clean_post('id_doc_sptjm'),
                        'doc_letter_id'=>$this->lman_security->clean_post('id_doc_letter'),
                        'doc_bpn_id'=>$this->lman_security->clean_post('id_doc_bpn'),
                        
                        'rek_num'=>( !empty($this->lman_security->clean_post('bank_id')) ) ? $this->lman_security->clean_post('bank_id') : NULL,
                        'rek_bank_id'=>(!empty($this->lman_security->clean_post('bank_name_data')) ) ? $this->lman_security->clean_post('bank_name_data') : NULL,
                        
                        'company_id' => COMPANY_ID,
                    //   'description' => $postdata['description']
                    );
                    //   'status'    =>'ACTIVE'
                $this->load->model('Spp_model');
                $this->load->model('Psn_model');
                $this->load->model('Bidang_model');
                $this->load->model('ProcessSpp_model');
                // if($postdata['status'] == 'add'){
                $checkSPP = $this->Spp_model->db->get_where('spp',array('spp_num'=>$this->lman_security->clean_post('spp_num')));
                if($checkSPP->num_rows() >=1){
                    $this->response( array('status'=>'error',
                            'message'=>"SPP Sudah Pernah di Input!"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }else{
                    $budgetPsn = $this->Psn_model->getDetailAllocation($this->lman_security->clean_post('psn_name_data'));
                    // nominal,allocation_ttl,realization_ttl,remaining_fund
                    $realizationPsn = $this->Spp_model->getRealisasiSPpPpk($this->lman_security->clean_post('psn_name_data'));
                    // realization
                    $totalBudget = $budgetPsn->nominal + $budgetPsn->remaining_fund;
                    $totalRealization = $realizationPsn->realization + str_replace(".","",$this->lman_security->clean_post('value'));
                    if($totalBudget < $totalRealization){
                        $this->response( array('status'=>'error',
                            'message'=>"Nilai Nominal Melebihi Nilai Anggaran yang ditentukan ".$totalBudget),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                    }else{
                        // getRealisasiAreaSPpPpk
                        $totalAreaRealization = $realizationPsn->area_realization + str_replace(".","",$this->lman_security->clean_post('area'));
                        // print_r($budgetPsn->area."--".$totalAreaRealization);die();
                        if($budgetPsn->area < $totalAreaRealization){
                            $this->response( array('status'=>'error',
                            'message'=>"Nilai Luasan Melebihi Luasan yang ditentukan "),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                        }else{
                            // die();
                            $data_id = $this->Spp_model->insert($data);
                            $id = $this->db->insert_id();
                                
                            if (!$data_id){
                                $this->response( array('status'=>'error',
                                    'message'=>"Gagal Simpan data ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                            } else {
                                $data_timeline = $this->ProcessSpp_model->db->get_where('timeline_spp',array('id'=> $id,'name'=>'Input Dokumen SPP'));
                                if ($data_timeline->num_rows() == 0){
                                    $dataInsert = array(
                                    'spp_id'=>$id,
                                    'name'=>'Input Dokumen SPP',
                                    'timeline_id'=>1,
                                    'description'=>'Input Dokumen SPP Pembayaran '.$this->lman_security->clean_post('payment_type')." ke".$this->lman_security->clean_post('payment_to'),
                                    'date'=>date("Y-m-d H:i:s"),
                                    );
                                    $data_id = $this->ProcessSpp_model->insert($dataInsert);
                                    if (!$data_id){
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
