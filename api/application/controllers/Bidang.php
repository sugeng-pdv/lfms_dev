<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Bidang extends REST_Controller {
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
    function get_data_bidang_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Bidang_model');
            $id = $this->lman_security->clean_post('id_bidang');
            $result= $this->Bidang_model->getDataBidang();
            // $resultStatus= $this->Bidang_model->getDataBidangStatus();
            
            $getResultStatus= $this->Bidang_model->db->get_where('spp',array('id'=>$this->lman_security->clean_post('id_spp'),'status_spp'=>'Belum Kirim'))->num_rows();
            // print_r($getResultStatus);die();
            if($getResultStatus === 0){
                $resultStatus = false;
            }else{
                $resultStatus=true;
            }
            
            $dataArr = array();
            $num = 1;
            if(!empty($result)){
                foreach ( $result as $data ){
                    $array_detail['num']            = $num;
                    $array_detail['no_spp']         = $data->spp_no;
                    $array_detail['name']           = $data->name;
                    $array_detail['payment_type']   = $data->payment_type;
                    $array_detail['payment_to']     = $data->payment_to;
                    
                    
                    $array_detail['compensation_type']= $data->compensation_type;
                    $array_detail['field_condition']= $data->field_condition;
                    $array_detail['is_eligible']    = $data->is_eligible;
                    $array_detail['id_lhv']         = $data->id_lhv;
                    $array_detail['date_lhv']       = $data->date_lhv;
                    $array_detail['is_konsinyasi']  = $data->is_konsinyasi;
                    $array_detail['val_num']        = $data->val_num;
                    $array_detail['val_date']       = $data->val_date;
                    				
                    					
                    
                    
                    
                    
                    $array_detail['type_field']     = $data->fieldtype_name;
                    $array_detail['nik']            = $data->nik;
                    $array_detail['no_nominatif']   = $data->no_nominatif;
                    $array_detail['nib']            = $data->nib_temp;
                    $array_detail['location']       = $data->sub_district_name.",".$data->village_name;
                    $array_detail['proof_owner']    = ucfirst($data->proof_owner);
                    $array_detail['area_rank']      = $data->area." m<sup>2</sup>";
                    $array_detail['area']           = $data->area;
                    $array_detail['nominal_idr']    = $this->general_library->format_rupiah($data->nominal);
                    $array_detail['nominal']        = $data->nominal;
                    
                    $array_detail['id']             = $data->id;
                    $array_detail['spp_id']         = $data->spp_id;
                    $array_detail['type_field_id']  = $data->jns_bidang_id;
                    $array_detail['village']        = $data->village;
                    $array_detail['sub_district']   = $data->sub_district;
                    $array_detail['district']       = $data->district;
                    $array_detail['province']       = $data->province;
                    $array_detail['nik_doc_id']     = $data->nik_doc_id;
                    $array_detail['poo_doc_id']     = $data->poo_doc_id;
                    $array_detail['result_doc_id']  = $data->result_doc_id;
                    $array_detail['receipt_doc_id']  = $data->receipt_doc_id;
                    
                    $array_detail['baph_doc_id']    = $data->baph_doc_id;
                    $array_detail['baugr_doc_id']    = $data->baugr_doc_id;
                    $array_detail['doc_rek_bpn_id'] = $data->doc_rek_bpn_id;
                    $array_detail['doc_court_id']   = $data->doc_court_id;
                    $array_detail['doc_ba_court_id']= $data->doc_ba_court_id;
                    $array_detail['doc_add_id']     = $data->doc_add_id;
                    $array_detail['letter_doc_id']  = $data->letter_doc_id; //take out to spp
                    
                    // $array_detail['sptjm_doc_id']   = $data->sptjm_doc_id; //take out to spp
                    $array_detail['status_nik_doc']   = $data->status_nik_doc;
                    $array_detail['status_poo_doc']   = $data->status_poo_doc;
                    $array_detail['status_result_doc']   = $data->status_result_doc;
                    $array_detail['status_letter_doc']   = $data->status_letter_doc;
                    $array_detail['status_sptjm_doc']   = $data->status_sptjm_doc;
                    if($id == "" ){
                        if($data->status_process == 'Belum Dikirm')
                        {
                            $array_detail['action'] = '<button class="btn btn-success btn-sm" onclick="edit_field('."'$data->id'".')"><i class="flaticon-edit-1"></i> Edit Bidang</button>';
                            
                        }else{
                            $array_detail['action'] = '';
                        }
                    }

                    $num++;
                    array_push($dataArr,$array_detail);
                }
                $this->response(array(
                    'status'=>'success',
                    'message'=>'',
                    'elapsed_time' => $this->benchmark->elapsed_time(),
        			'data' => $dataArr,
        			'sendStatus' => $resultStatus
                ));
            }else{
                $this->response( array('status'=>'failure',
                    'message'=>'Data Kosong',
        			'sendStatus' => $resultStatus),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $this->response(array(
                    'status'=>'error',
                    'message'=>'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.',
                    'elapsed_time' => $this->benchmark->elapsed_time()
                ));
        }
    }  
    
    function save_bidang_post(){
        // if ( $this->access_control->access_granted( '', 'R' ) === true ) {
        if (VALID_LOGIN === true ) {
            $postdata = ($_POST);
            $paymentType = $this->lman_security->clean_post('payment_type');
            $paymentTo = $this->lman_security->clean_post('payment_to');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_spp', 'id SPP', 'required');
            $this->form_validation->set_rules('spp_num', 'Nomor SPP', 'required');
            $this->form_validation->set_rules('name', 'Nama yang berhak', 'required');
            $this->form_validation->set_rules('type', 'Jenis Bidang', 'required');
            $this->form_validation->set_rules('field_condition', 'Kondisi Bidang', 'required');
            if($paymentType === "Langsung"){
                if($paymentTo != "Pengadilan"){
                    $this->form_validation->set_rules('nik', 'NIK', 'required');
                    $this->form_validation->set_rules('ownership_type', 'Jenis Bukti Kepemilikan', 'required');
                    $this->form_validation->set_rules('compensation_type', 'Bentuk Ganti Rugi', 'required');
                    $this->form_validation->set_rules('val_num', 'Nomor Validasi', 'required');
                    $this->form_validation->set_rules('val_date', 'Tanggal Validasi', 'required');
                    $this->form_validation->set_rules('id_doc_nik', 'Dokumen Identitas', 'required');
                    $this->form_validation->set_rules('id_doc_poo', 'Dokumen Bukti Milik', 'required');
                }
            }
            $this->form_validation->set_rules('no_nominatif', 'Nomor urut Nominatif', 'required');
            $this->form_validation->set_rules('nib_temp', 'Nomor Induk Bidang Sementara', 'required');
            $this->form_validation->set_rules('province', 'Provinsi', 'required');
            $this->form_validation->set_rules('district', 'Kabupaten/Kota', 'required');
            $this->form_validation->set_rules('sub_district', 'Kecamatan/Kelurahan', 'required');
            
            $this->form_validation->set_rules('field_area', 'Luas Bidang', 'required');
            $this->form_validation->set_rules('price', 'Harga/Nilai', 'required');
            $this->form_validation->set_rules('id_doc_result', 'Dokumen Laporan Hasil', 'required');
            
            if($paymentType === "Talangan"){
                $this->form_validation->set_rules('is_eligible', 'Pilihan Eligible', 'required');
                $this->form_validation->set_rules('is_konsinyasi', 'Pilihan Konsinyasi', 'required');
                $this->form_validation->set_rules('id_doc_nik', 'Dokumen Identitas', 'required');
                $this->form_validation->set_rules('id_doc_poo', 'Dokumen Bukti Milik', 'required');
                
                $this->form_validation->set_rules('id_doc_receipt', 'Dokumen Kuitansi Pembayaran', 'required');
                $this->form_validation->set_rules('id_doc_baugr', 'Dokumen BAUGR', 'required');
                $this->form_validation->set_rules('id_doc_baph', 'Dokumen BAPH', 'required');
                if($this->lman_security->clean_post('is_eligible') === '1'){
                    $this->form_validation->set_rules('lhv_num', 'Nomor LHV', 'required');
                    $this->form_validation->set_rules('lhv_date', 'Tanggal LHV', 'required');
                }
                if($this->lman_security->clean_post('is_konsinyasi') === '0'){
                    $this->form_validation->set_rules('val_num', 'Nomor Validasi', 'required');
                    $this->form_validation->set_rules('val_date', 'Tanggal Validasi', 'required');
                }else{
                    $this->form_validation->set_rules('id_doc_rek_bpn', 'Dokumen Rekomendasi BPN', 'required');
                    $this->form_validation->set_rules('id_doc_court', 'Dokumen fotokopi penetapan pengadilan', 'required');
                    $this->form_validation->set_rules('id_ba_court', 'Dokumen BA penyimbanan penitipan ganti rugi pengadilan', 'required');
                }
            }
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $this->response( array('status'=>'error',
                        'message'=>validation_errors()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else {
                $teritoryCode = $this->lman_security->clean_post('province').'-'.$this->lman_security->clean_post('district').'-'.$this->lman_security->clean_post('sub_district').'-'.$this->lman_security->clean_post('village');
                    $data = array(
                        'spp_id'=>$this->lman_security->clean_post('id_spp'),
                        'spp_id_subm'=>$this->lman_security->clean_post('id_spp'),
                        // ''=>$this->lman_security->clean_post('spp_num'),
                        'name'=>$this->lman_security->clean_post('name'),
                        'payment_type'=>$this->lman_security->clean_post('payment_type'),
                        'payment_to'=>$this->lman_security->clean_post('payment_to'),
                        'jns_bidang_id'=>$this->lman_security->clean_post('type'),
                        'nik'=>(!empty($this->lman_security->clean_post('nik'))) ? $this->lman_security->clean_post('nik') : NULL,
                        'no_nominatif'=>$this->lman_security->clean_post('no_nominatif'),
                        'nib_temp'=>$this->lman_security->clean_post('nib_temp'),
                        'province'=>$this->lman_security->clean_post('province'),
                        'district'=>$this->lman_security->clean_post('district'),
                        'sub_district'=>$this->lman_security->clean_post('sub_district'),
                        'village'=>$this->lman_security->clean_post('village'),
                        'proof_owner'=>$this->lman_security->clean_post('ownership_type'),
                        'area'=>str_replace(".","",$this->lman_security->clean_post('field_area')),
                        'nominal'=>str_replace(".","",$this->lman_security->clean_post('price')),
                        'nik_doc_id'=>$this->lman_security->clean_post('id_doc_nik'),
                        'poo_doc_id'=>$this->lman_security->clean_post('id_doc_poo'),
                        'result_doc_id'=>$this->lman_security->clean_post('id_doc_result'),
                        // 'letter_doc_id'=>$this->lman_security->clean_post('id_doc_letter'),
                        // 'sptjm_doc_id'=>$this->lman_security->clean_post('id_doc_sptjm'),//
                        'teritory_code'=>$teritoryCode,
                        'date_input' => date("Y-m-d"),
                        
                        'is_eligible'=>(!empty($this->lman_security->clean_post('is_eligible'))) ? $this->lman_security->clean_post('is_eligible') : NULL,
                        'id_lhv'=>(!empty($this->lman_security->clean_post('lhv_num'))) ? $this->lman_security->clean_post('lhv_num') : NULL,
                        'date_lhv'=>(!empty($this->lman_security->clean_post('lhv_date'))) ? $this->lman_security->clean_post('lhv_date') : NULL,
                        'is_konsinyasi'=>(!empty($this->lman_security->clean_post('is_konsinyasi'))) ? $this->lman_security->clean_post('is_konsinyasi') : NULL,
                        'val_num'=>(!empty($this->lman_security->clean_post('val_num'))) ? $this->lman_security->clean_post('val_num') : NULL,
                        'val_date'=>(!empty($this->lman_security->clean_post('val_date'))) ? $this->lman_security->clean_post('val_date') : NULL,
                        'compensation_type'=>(!empty($this->lman_security->clean_post('compensation_type'))) ? $this->lman_security->clean_post('compensation_type') : NULL,
                        'field_condition'=>(!empty($this->lman_security->clean_post('field_condition'))) ? $this->lman_security->clean_post('field_condition') : NULL,
                       
                        
                        'receipt_doc_id'    => (!empty($this->lman_security->clean_post('id_doc_receipt'))) ? $this->lman_security->clean_post('id_doc_receipt') : NULL,
                        'baugr_doc_id'  => (!empty($this->lman_security->clean_post('id_doc_baugr'))) ? $this->lman_security->clean_post('id_doc_baugr') : NULL,
                        'baph_doc_id'   => (!empty($this->lman_security->clean_post('id_doc_baph'))) ? $this->lman_security->clean_post('id_doc_baph') : NULL,
                        'doc_rek_bpn_id'    => (!empty($this->lman_security->clean_post('id_doc_rek_bpn'))) ? $this->lman_security->clean_post('id_doc_rek_bpn') : NULL,
                        'doc_court_id'  => (!empty($this->lman_security->clean_post('id_doc_court'))) ? $this->lman_security->clean_post('id_doc_court') : NULL,
                        'doc_ba_court_id'   => (!empty($this->lman_security->clean_post('id_ba_court'))) ? $this->lman_security->clean_post('id_ba_court') : NULL,
                        'doc_add_id'    => (!empty($this->lman_security->clean_post('id_doc_add'))) ? $this->lman_security->clean_post('id_doc_add') : NULL,
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        'company_id' => COMPANY_ID,
                    //   'description' => $postdata['description']
                    );
                    //   'status'    =>'ACTIVE'
                $this->load->model('Bidang_model');
                $this->load->model('Spp_model');
                $this->load->model('ProcessSpp_model');
                // if($postdata['status'] == 'add'){
                $checkRealizationArea = $this->Bidang_model->getFieldArea($this->lman_security->clean_post('id_spp'));
                $statusData = $this->Bidang_model->cekTeritory($this->lman_security->clean_post('nib_temp'),$teritoryCode);
                
                // print_r($checkRealizationField."----");die();
                $checkPlanArea = $this->Spp_model->getFieldArea($this->lman_security->clean_post('id_spp'));
                $pengajuanLuasan = (str_replace(".","",$this->lman_security->clean_post('field_area')) + $checkRealizationArea->ttl_area);
                $pengajuanNominal = (str_replace(".","",$this->lman_security->clean_post('price')) + $checkRealizationArea->ttl_nominal);
                
                
                if($this->lman_security->clean_post('id_bidang') == ""){
                    if($pengajuanLuasan > $checkPlanArea->area){
                        $this->response( array('status'=>'error',
                        'message'=>"Luasan melebihi data pengajuan"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                    }else{
                        if($pengajuanNominal > $checkPlanArea->nominal){
                            $this->response( array('status'=>'error',
                            'message'=>"Nominal melebihi data pengajuan"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                        }else{
                            if($statusData === true){
                                $data_id = $this->Bidang_model->insert($data);
                                $id = $this->db->insert_id();
                            }else{
                                 $this->response( array('status'=>'error',
                                    'message'=>"Data sudah pernah diajukan"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                            }
                        }
                    }
                    
                }else{
                    $data_id = $this->Bidang_model->update($data,array('id'=>$this->lman_security->clean_post('id_bidang')));
                }
                    
                if (!$data_id){
                    $this->response( array('status'=>'error',
                        'message'=>"Gagal Simpan data ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $data_timeline = $this->ProcessSpp_model->db->get_where('timeline_spp',array('spp_id'=> $this->lman_security->clean_post('id_spp'),'name'=>'Pilih Bidang Dari Database'));
                    if ($data_timeline->num_rows() == 0){
                        $dataInsert = array(
                        'spp_id'=>$this->lman_security->clean_post('id_spp'),
                        'name'=>'Pilih Bidang Dari Database',
                        'timeline_id'=>2,
                        'description'=>'Pilih Bidang Dari Database',
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
        } else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }
        
    }
    
    
    function send_bidang_post(){
        if (VALID_LOGIN === true ) {
            $postdata = ($_POST);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_spp', 'id SPP', 'required');
            
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $this->response( array('status'=>'error',
                        'message'=>validation_errors()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else {
                    $requestCode = strtoupper(random_string('alnum',5));
                    $data = array(
                        'status_process'=>'Sedang diproses',
                        'request_code'=>$requestCode
                        
                    );
                    //   'status'    =>'ACTIVE'
                $this->load->model('Bidang_model');
                $this->load->model('Spp_model');
                $this->load->model('Notification_model');
                $this->load->model('ProcessSpp_model');
                    $data_id = $this->Bidang_model->update($data,array('spp_id_subm'=>$this->lman_security->clean_post('id_spp')));
                if (!$data_id){
                    $this->response( array('status'=>'error',
                        'message'=>"Gagal Simpan data ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $updateSpp = $this->Spp_model->update(array('request_code'=>$requestCode,'status_spp'=>'Sudah Kirim'),array('id'=>$this->lman_security->clean_post('id_spp')));
                    if(!$updateSpp){
                        $this->response( array('status'=>'error',
                                'message'=>"Gagal Update Data Status SPP ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                    }else{
                        $insertNotif = $this->Notification_model->insert(array('company_id'=>COMPANY_ID,'spp_id'=>$this->lman_security->clean_post('id_spp'),'name'=>'Pengajuan permohonan pembayaran PSN'.$this->lman_security->clean_post('spp_name').', Senilai :'.$this->lman_security->clean_post('spp_nominal'),'date'=>date("Y-m-d H:i:s")));
                        $data_timeline = $this->ProcessSpp_model->db->get_where('timeline_spp',array('spp_id'=> $this->lman_security->clean_post('id_spp'),'name'=>'Review dan Kirim'));
                        if ($data_timeline->num_rows() == 0){
                            $dataInsert = array(
                            'spp_id'=>$this->lman_security->clean_post('id_spp'),
                            'name'=>'Review dan Kirim',
                            'timeline_id'=>3,
                            'description'=>'Review dan Kirim',
                            'date'=>date("Y-m-d H:i:s"),
                            );
                            $data_id = $this->ProcessSpp_model->insert($dataInsert);
                            if (!$data_id){
                                $this->response( array('status'=>'error',
                                    'message'=>"Gagal Simpan Data Timeline ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                            } else {
                                $this->response(array('status'=>'success','code'=>$requestCode,'message'=>'Berhasil Simpan'));
                            }
                        } else {
                            $this->response(array('status'=>'success','code'=>$requestCode,'message'=>'Berhasil Simpan'));
                        }
                    }
                    
                }
            }
        } else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }
    }    
        
    function reject_bidang_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Bidang_model');
            // $id = $this->lman_security->clean_post('id_bidang');
            $fieldsCount =0;
            $checkSpp = $this->Bidang_model->db->select('status_spp,status_process')->get_where('spp',array('id'=>$this->lman_security->clean_post('id_spp')))->result_array()[0];
            // print_r($checkSpp['status_process'] != 'Belum Diteliti' );die();
             if($checkSpp['status_process'] === 'Belum Diteliti' ){
                $result= $this->Bidang_model->getDataBidangRejected();
                if($result){
                    $fieldsCount = count($result);
                }
                $dataArr = array();
                $num = 1;
                if(!empty($result)){
                    foreach ( $result as $data ){
                        $array_detail['id']             = $data->id;
                        $array_detail['num']            = $num;
                        $array_detail['no_spp']         = $data->spp_no;
                        $array_detail['date_input']     = $data->date_input;
                        $array_detail['name']           = $data->name;
                        $array_detail['type_field']     = $data->fieldtype_name;
                        $array_detail['reason']         = $data->info_denied;
                        $array_detail['action']         = "";
                        
                            // $array_detail['action'] = '<button class="btn btn-success btn-sm" onclick="edit_field('."'$data->id'".')"><i class="flaticon-edit-1"></i> Edit Bidang</button>';
    
                        $num++;
                        array_push($dataArr,$array_detail);
                    }
                    $this->response(array(
                        'status'=>true,
                        'message'=>'',
                        'elapsed_time' => $this->benchmark->elapsed_time(),
            			'data' => $dataArr,
            			'qty'=>$fieldsCount
                    ),200);
                }else{
                    $this->response( array('status'=>false,
                        'message'=>'Data Kosong'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
                 
             }else{
                 $this->response( array('status'=>false,
                        'message'=>'Data Kosong'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
             }
            	
        } else {
            $this->response(array(
                    'status'=>false,
                    'message'=>'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.',
                    'elapsed_time' => $this->benchmark->elapsed_time()
                ));
        }
    }
    function reject_bidang_update_post()
    {
        if (VALID_LOGIN === true ) {
            $postdata = ($_POST);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('data[]', 'Data bidang', 'required');
            $this->form_validation->set_rules('id_spp', 'Nomor SPP', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $this->response( array('status'=>'error',
                        'message'=>validation_errors()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else {
                    $data = array(
                        'psn_id'=>$this->lman_security->clean_post('psn_name_data'),
                        'company_id' => COMPANY_ID,
                    //   'description' => $postdata['description']
                    );
                    //   'status'    =>'ACTIVE'
                $this->load->model('Bidang_model');
                $this->load->model('ProcessSpp_model');
                $dataIdsppUpdate = $postdata['data'];
                $countDataSppUpdate = count($dataIdsppUpdate);
                $countSpp =0;
                // print_r(count($dataIdsppUpdate));die();
                foreach( $dataIdsppUpdate as $value )
                {
                    $data_id = $this->Bidang_model->update(array('spp_id_subm'=>$this->lman_security->clean_post('id_spp'),'status_process'=>'Sedang diproses'),array('id'=>$value));
                    if ($data_id){
                        $countSpp++;
                    }
                }
                // print_r($countSpp);
                // die();
                if ($countDataSppUpdate != $countSpp){
                    $this->response( array('status'=>'error',
                        'message'=>"Gagal Simpan data ke Database,Silahkan Ulangi Kembali"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $id = $this->lman_security->clean_post('id_spp');
                    $data_timeline = $this->ProcessSpp_model->db->get_where('timeline_spp',array('id'=> $id,'timeline_id'=>1,'name'=>'Input Dokumen SPP'));
                    if ($data_timeline->num_rows() == 0){
                        $dataInsert = array(
                        'spp_id'=>$id,
                        'timeline_id'=>1,
                        'name'=>'Input Dokumen SPP',
                        'description'=>'Input Dokumen SPP',
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
        } else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }
    }
        
    function send_bidang_staff_post(){
        if (VALID_LOGIN === true ) {
            $postdata = ($_POST);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_spp', 'id SPP', 'required');
            
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $this->response( array('status'=>'error',
                        'message'=>validation_errors()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else {
                    $requestCode = strtoupper(random_string('alnum',5));
                    $data = array(
                        'status_process'=>'Sedang diproses',
                        'request_code'=>$requestCode
                        
                    );
                    //   'status'    =>'ACTIVE'
                $this->load->model('Bidang_model');
                $this->load->model('Spp_model');
                $this->load->model('Notification_model');
                $this->load->model('ProcessSpp_model');
                //     $data_id = $this->Bidang_model->update($data,array('spp_id_subm'=>$this->lman_security->clean_post('id_spp')));
                // if (!$data_id){
                //     $this->response( array('status'=>'error',
                //         'message'=>"Gagal Simpan data ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                // } else {
                
                    $updateSpp = $this->Spp_model->update(array('status_process'=>'Sudah Diteliti','status_spp'=>'Menunggu Approval'),array('id'=>$this->lman_security->clean_post('id_spp')));
                    if(!$updateSpp){
                        $this->response( array('status'=>'error',
                                'message'=>"Gagal Update Data Status SPP ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                    }else{
                        $insertNotif = $this->Notification_model->insert(array('company_id'=>COMPANY_ID,'spp_id'=>$this->lman_security->clean_post('id_spp'),'name'=>'Pengajuan permohonan pembayaran PSN'.$this->lman_security->clean_post('spp_name').', Senilai :'.$this->lman_security->clean_post('spp_nominal'),'date'=>date("Y-m-d H:i:s")));
                        $data_timeline = $this->ProcessSpp_model->db->get_where('timeline_spp',array('spp_id'=> $this->lman_security->clean_post('id_spp'),'name'=>'Penelitian Administrasi'));
                        if ($data_timeline->num_rows() == 0){
                            $dataInsert = array(
                            'spp_id'=>$this->lman_security->clean_post('id_spp'),
                            'name'=>'Penelitian Administrasi',
                            'timeline_id'=>4,
                            'description'=>'Penelitian Administrasi	',
                            'date'=>date("Y-m-d H:i:s"),
                            );
                            $data_id = $this->ProcessSpp_model->insert($dataInsert);
                            if (!$data_id){
                                $this->response( array('status'=>'error',
                                    'message'=>"Gagal Simpan Data Timeline ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                            } else {
                                $this->response(array('status'=>'success','code'=>$requestCode,'message'=>'Berhasil Simpan'));
                            }
                        } else {
                            $this->response(array('status'=>'success','message'=>'Berhasil Simpan'));
                        }
                    // }
                    
                }
            }
        } else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }
    }        
    
    function check_video_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Spp_model');
            $result= $this->Spp_model->db->get_where('spp',array('id'=>$this->lman_security->clean_post('id_spp'),'video_view'=>0));
            if($result->num_rows() == 0){
                $status = 'Ok'; //video sudah di lihat
            }else{
                $status = 'Nok';
                $updateStatus= $this->Spp_model->update(array('video_view'=>1),array('id'=>$this->lman_security->clean_post('id_spp')));
            }
            $this->response(array(
                'status'=>true,
                'elapsed_time' => $this->benchmark->elapsed_time(),
    			'data' => $status,
            ),200);
           
        } else {
            $this->response(array(
                    'status'=>false,
                    'message'=>'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.',
                    'elapsed_time' => $this->benchmark->elapsed_time()
                ));
        }
    }
    
    
    
    
    
    
        
        
        
        
    function spp_save_post(){
        // if ( $this->access_control->access_granted( '', 'R' ) === true ) {
        if (VALID_LOGIN === true ) {
            $postdata = ($_POST);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('psn_sector', 'Sektor PSN', 'required');
            $this->form_validation->set_rules('psn_name_data', 'Nama PSN', 'required');
            $this->form_validation->set_rules('spp_num', 'Nomor SPP', 'required');
            $this->form_validation->set_rules('spp_date', 'Tanggal SPP', 'required');
            $this->form_validation->set_rules('value', 'Nilai Nominal', 'required');
            $this->form_validation->set_rules('field_count', 'Jumlah Bidang', 'required');
            $this->form_validation->set_rules('id_doc_spp', 'Dokumen SPP', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $this->response( array('status'=>'error',
                        'message'=>validation_errors()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else {
                    $data = array(
                        'psn_id'=>$this->lman_security->clean_post('psn_name_data'),
                        'spp_num'=>$this->lman_security->clean_post('spp_num'),
                        'date'=>$this->lman_security->clean_post('spp_date'),
                        'nominal'=>str_replace(".","",$this->lman_security->clean_post('value')),//
                        'total_field'=>str_replace(".","",$this->lman_security->clean_post('field_count')),//
                        'document_id'=>$this->lman_security->clean_post('id_doc_spp'),
                        'company_id' => COMPANY_ID,
                    //   'description' => $postdata['description']
                    );
                    //   'status'    =>'ACTIVE'
                $this->load->model('Spp_model');
                $this->load->model('ProcessSpp_model');
                // if($postdata['status'] == 'add'){
                $data_id = $this->Spp_model->insert($data);
                $id = $this->db->insert_id();
                    
                if (!$data_id){
                    $this->response( array('status'=>'error',
                        'message'=>"Gagal Simpan data ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $data_timeline = $this->ProcessSpp_model->db->get_where('timeline_spp',array('id'=> $id,'timeline_id'=>1,'name'=>'Input Dokumen SPP'));
                    if ($data_timeline->num_rows() == 0){
                        $dataInsert = array(
                        'spp_id'=>$id,
                        'timeline_id'=>1,
                        'name'=>'Input Dokumen SPP',
                        'description'=>'Input Dokumen SPP',
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
        } else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
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
    
    function get_jenis_bidang_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('FieldType_model');
            $result= $this->FieldType_model->getJenisBidang();
            $dataArr = array();
            if(!empty($result)){
                foreach ( $result as $data ){
                    $array_detail['id']      = $data->id;
                    $array_detail['name']    = $data->name;
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
            $this->response( array('status'=>'failure',
                    'message'=>'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    function get_province_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Location_model');
            $result= $this->Location_model->get_province();
            $dataArr = array();
            if(!empty($result)){
                foreach ( $result as $data ){
                    $array_detail['id']      = $data->id;
                    $array_detail['name']    = $data->name;
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
            $this->response( array('status'=>'failure',
                    'message'=>'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    function get_district_post()
    {
       if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Location_model');
            $result= $this->Location_model->get_district();
            $dataArr = array();
            if(!empty($result)){
                foreach ( $result as $data ){
                    $array_detail['id']      = $data->id;
                    $array_detail['name']    = $data->name;
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
            $this->response( array('status'=>'failure',
                    'message'=>'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        } 
    }
    function get_subdistrict_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Location_model');
            $result= $this->Location_model->get_subdistrict();
            $dataArr = array();
            if(!empty($result)){
                foreach ( $result as $data ){
                    $array_detail['id']      = $data->id;
                    $array_detail['name']    = $data->name;
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
            $this->response( array('status'=>'failure',
                    'message'=>'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    function get_village_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Location_model');
            $result= $this->Location_model->get_village();
            $dataArr = array();
            if(!empty($result)){
                foreach ( $result as $data ){
                    $array_detail['id']      = $data->id;
                    $array_detail['name']    = $data->name;
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
            $this->response( array('status'=>'failure',
                    'message'=>'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    








}
