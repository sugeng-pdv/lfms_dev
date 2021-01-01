<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Control_budget extends REST_Controller {
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
        
    function get_business_entity_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('ControlBudget_model');
            $result= $this->ControlBudget_model->getDataInstitutionSelect();
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
    
    
    function budget_save_post(){
        // if ( $this->access_control->access_granted( '', 'R' ) === true ) {
        if (VALID_LOGIN === true ) {
            $postdata = ($_POST);
            $this->load->library('form_validation');
            // id
            // type
            // psn_sector
            // psn_name
            

            $this->form_validation->set_rules('psn_sector', 'Sektor PSN', 'required');
            $this->form_validation->set_rules('psn_name', 'Nama PSN', 'required');
            $this->form_validation->set_rules('fiscal_year', 'Tahun Anggaran ', 'required');
            $this->form_validation->set_rules('value', 'Nominal', 'required');
            // $this->form_validation->set_rules('business_entity', 'Badan Usaha', 'required');
            $this->form_validation->set_rules('area', 'Luasan', 'required');
            $this->form_validation->set_rules('kepdirut_num','Nomor Kepdirut','required');
            if($this->lman_security->clean_post('payment_type') != 'Langsung'){
               $this->form_validation->set_rules('business_entity','Jenis Badan Usaha','required'); 
            }
            $this->form_validation->set_rules('payment_type','Jenis Pembayaran','required');
            $this->form_validation->set_rules('allocation_ttl','Total Alokasi','required');
            $this->form_validation->set_rules('realization_ttl','Total Realisasi','required');
            $this->form_validation->set_rules('remaining_fund','Sisa dana sebelumnya','required');
            $this->form_validation->set_rules('value','value','required');
            
            
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $this->response( array('status'=>'error',
                        'message'=>validation_errors()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else {
                $type = $this->lman_security->clean_post('type');
                    
                    //   'status'    =>'ACTIVE'
                $this->load->model('ControlBudget_model');
                $this->load->model('ProcessSpp_model');
                // $checkSPP = $this->ControlBudget_model->db->get_where('spp',array('spp_num'=>$this->lman_security->clean_post('spp_num')));
                
                if($type == 'add'){
                    $checkBudget = $this->ControlBudget_model->db->get_where('ref_psn_name',array('name'=>$this->lman_security->clean_post('psn_name'),'fiscal_year'=>$this->lman_security->clean_post('fiscal_year'),'payment_type'=>$this->lman_security->clean_post('payment_type')));
                    if($checkBudget->num_rows() >=1){
                        $this->response( array('status'=>'error',
                            'message'=>"Budget PSN Sudah Pernah di Input!"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                        die();
                    }else{
                        $data = array(
                            'psn_sector_id'=>$this->lman_security->clean_post('psn_sector'),//
                            'name'=>$this->lman_security->clean_post('psn_name'),
                            'institution_id'=>($this->lman_security->clean_post('payment_type') === 'Langsung') ? 2 : $this->lman_security->clean_post('business_entity'),
                            'kepdir_num'=>$this->lman_security->clean_post('kepdirut_num'),
                            'payment_type'=>$this->lman_security->clean_post('payment_type'),
                            'fiscal_year'=>$this->lman_security->clean_post('fiscal_year'),
                            'area'=>str_replace(".","",$this->lman_security->clean_post('area')),
                            'nominal'=>str_replace(".","",$this->lman_security->clean_post('value')),//
                            'allocation_ttl'=>str_replace(".","",$this->lman_security->clean_post('allocation_ttl')),//
                            'realization_ttl'=>str_replace(".","",$this->lman_security->clean_post('realization_ttl')),//
                            'remaining_fund'=>str_replace(".","",$this->lman_security->clean_post('remaining_fund')),//
                            'description'=>$this->lman_security->clean_post('psn_name'),
                            'date_update'=>date("Y-m-d"),
                            'userid' => USERID
                        );
                        $data_insert = $this->ControlBudget_model->insert($data);
                        // $id = $this->db->insert_id();
                    }
                }else{
                    if($type == "edit_detail"){
                        $data = array(
                                    'psn_sector_id'=>$this->lman_security->clean_post('psn_sector'),//
                                    'name'=>$this->lman_security->clean_post('psn_name'),
                                    'id_old'=> $this->lman_security->clean_post('id'),
                                    'institution_id'=>$this->lman_security->clean_post('business_entity'),
                                    'kepdir_num'=>$this->lman_security->clean_post('kepdirut_num'),
                                    'payment_type'=>$this->lman_security->clean_post('payment_type'),
                                    'fiscal_year'=>$this->lman_security->clean_post('fiscal_year'),
                                    'area'=>str_replace(".","",$this->lman_security->clean_post('area')),
                                    // 'nominal'=>str_replace(".","",$this->lman_security->clean_post('value')),//
                                    // 'allocation_ttl'=>str_replace(".","",$this->lman_security->clean_post('allocation_ttl')),//
                                    // 'realization_ttl'=>str_replace(".","",$this->lman_security->clean_post('realization_ttl')),//
                                    // 'remaining_fund'=>str_replace(".","",$this->lman_security->clean_post('remaining_fund')),//
                                    'description'=>$this->lman_security->clean_post('psn_name'),
                                    'date_update'=>date("Y-m-d"),
                                    'userid' => USERID
                            );
                            $data_insert = $this->ControlBudget_model->update($data,array('id'=>$this->lman_security->clean_post('id')));
                    }else{
                        $checkBudget = $this->ControlBudget_model->db->get_where('ref_psn_name',array('name'=>$this->lman_security->clean_post('psn_name'),'fiscal_year'=>$this->lman_security->clean_post('fiscal_year'),'payment_type'=>$this->lman_security->clean_post('payment_type'),'id !='=>$this->lman_security->clean_post('id') ));
                        if($checkBudget->num_rows() >= 1){
                            $this->response( array('status'=>'error',
                                'message'=>"Budget PSN Sudah Pernah di Input!"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                            die();
                        }else{
                            $data = array(
                                    'psn_sector_id'=>$this->lman_security->clean_post('psn_sector'),//
                                    'name'=>$this->lman_security->clean_post('psn_name'),
                                    'id_old'=> $this->lman_security->clean_post('id'),
                                    'institution_id'=>$this->lman_security->clean_post('business_entity'),
                                    'kepdir_num'=>$this->lman_security->clean_post('kepdirut_num'),
                                    'payment_type'=>$this->lman_security->clean_post('payment_type'),
                                    'fiscal_year'=>$this->lman_security->clean_post('fiscal_year'),
                                    'area'=>str_replace(".","",$this->lman_security->clean_post('area')),
                                    'nominal'=>str_replace(".","",$this->lman_security->clean_post('value')),//
                                    'allocation_ttl'=>str_replace(".","",$this->lman_security->clean_post('allocation_ttl')),//
                                    'realization_ttl'=>str_replace(".","",$this->lman_security->clean_post('realization_ttl')),//
                                    'remaining_fund'=>str_replace(".","",$this->lman_security->clean_post('remaining_fund')),//
                                    'description'=>$this->lman_security->clean_post('psn_name'),
                                    'date_update'=>date("Y-m-d"),
                                    'userid' => USERID
                            );
                            
                            $insert_data = $this->ControlBudget_model->insert($data);
                            // $id_insert = $this->db->insert_id();
                            if(!$insert_data){
                                $this->response( array('status'=>'error',
                                    'message'=>"Gagal Simpan data baru ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                                    die();
                            }else{
                                $data_insert = $this->ControlBudget_model->update(array('status'=>'INACTIVE'),array('id'=>$this->lman_security->clean_post('id')));
                            }
                        }
                        
                    }
                }
                
                    if (!$data_insert){
                        $this->response( array('status'=>'error',
                            'message'=>"Gagal Simpan data ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                    } else {
                        if($type != 'add'){
                            
                        }
                        $this->response(array('status'=>'success','message'=>'Berhasil Simpan'));
                    }
                    
                // }
            }
        } else {
            $this->response( array('status'=>'error',
                            'message'=>"Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }
    function data_psn_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Psn_model');
            $result= $this->Psn_model->getDataPsn();
            $dataArr = array();
            if(!empty($result)){
                foreach ( $result as $menu ){
                    $array_detail['id']         = $menu->id;
                    $array_detail['id_sector']  = $menu->id_sector;
                    $array_detail['id_institution']  = $menu->id_institution;
                    $array_detail['name']       = ucfirst(strtolower($menu->sector_psn." ".$menu->name));
                    $array_detail['name_edit']  = $menu->name;
                    $array_detail['fiscal_year']= $menu->fiscal_year;
                    $array_detail['institution']= ucfirst(strtolower($menu->institution_name));
                    $array_detail['area']       = $this->general_library->format_ribuan($menu->area);
                    $array_detail['area_edit']  = $menu->area;
                    $array_detail['nominal']    = $this->general_library->format_rupiah($menu->nominal);
                    $array_detail['nominal_edit']=$menu->nominal;
                    $array_detail['allocation_ttl'] = $menu->allocation_ttl;
                    $array_detail['realization_ttl'] = $menu->realization_ttl;
                    $array_detail['remaining_fund'] = $menu->remaining_fund;
                    $array_detail['payment_type'] = $menu->payment_type;
                    $array_detail['kepdir_num'] = $menu->kepdir_num;
                    // $array_detail['kepdir_num'] = $menu->kepdir_num;
                    // if($this->lman_security->clean_post('id') != ""){
                        
                    // }
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
            $result= $this->Spp_model->getDataSpp();
            $dataArr = array();
            if(!empty($result)){
                foreach ( $result as $data ){
                    $array_detail['id']         = $data->id;
                    $array_detail['spp_no']     = $data->spp_num;
                    $array_detail['psn_name']   = $data->psn_name;
                    $array_detail['psn_type']   = $data->payment_type;
                    $array_detail['payment_to'] = $data->payment_to;
                    $array_detail['nominal']    = $data->nominal;
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
