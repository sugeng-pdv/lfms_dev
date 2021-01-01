<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Penelitian_administrasi_ppk extends REST_Controller {
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
    function get_data_spp_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Spp_model');
            $result= $this->Spp_model->getDataSPPStaff();
            // print_r(($result));die()
            $dataArr = array();
            if(!empty($result)){
                foreach ( $result as $data ){
                    $array_detail['id']         = $data->id;
                    $array_detail['spp_no']     = $data->spp_num;
                    $array_detail['psn_name']   = $data->psn_name;
                    $array_detail['psn_info']     = $data->message_rejected;
                    $array_detail['psn_type']   = $data->payment_type;
                    $array_detail['payment_to']     = $data->payment_to;
                    $array_detail['nominal']    = $data->nominal;
                    $array_detail['status_spp'] = $data->status_spp;
                    $array_detail['status_process'] = $data->status_process;
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
    
    function get_data_bidang_byid_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Bidang_model');
            $this->load->model('Spp_model');
            $id = $this->lman_security->clean_post('id_bidang');
            
            $result= $this->Bidang_model->getDataBidangStaff();
            $resultCheck= $this->Bidang_model->db->get_where('field',array('spp_id_subm'=>$this->lman_security->clean_post('id_spp'),'status_process'=>'Sedang diproses'));
            // print_r($resultCheck->num_rows());die();
            if($resultCheck->num_rows() == 0){
                $resultStatus = true;
            }else{
                $resultStatus=false;
            }
            $dataArr = array();
            $dataDoc = array();
            $num = 1;
            if(!empty($result)){
                foreach ( $result as $data ){
                    $array_detail['num']            = $num;
                    $array_detail['no_spp']         = $data->spp_no;
                    $array_detail['name']           = $data->name;
                    $array_detail['type_field']     = $data->fieldtype_name;
                    $array_detail['payment_type']     = $data->payment_type;
                    $array_detail['payment_to']     = $data->payment_to;
                    $array_detail['nik']            = $data->nik;
                    $array_detail['no_nominatif']   = $data->no_nominatif;
                    $array_detail['nib']            = $data->nib_temp;
                    $array_detail['location']       = $data->village_name;
                    $array_detail['proof_owner']    = ucfirst($data->proof_owner);
                    $array_detail['area_rank']      = $data->area." m<sup>2</sup>";
                    $array_detail['area']           = $data->area;
                    $array_detail['nominal_idr']    = $this->general_library->format_rupiah($data->nominal);
                    $array_detail['nominal']        = $data->nominal;
                    $array_detail['compensation_type']= $data->compensation_type;
                    $array_detail['field_condition']= $data->field_condition;
                    $array_detail['is_eligible']    = $data->is_eligible;
                    $array_detail['id_lhv']         = $data->id_lhv;
                    $array_detail['date_lhv']       = $data->date_lhv;
                    $array_detail['is_konsinyasi']  = $data->is_konsinyasi;
                    $array_detail['val_num']        = $data->val_num;
                    $array_detail['val_date']       = $data->val_date;
                    
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
                    $array_detail['letter_doc_id']  = $data->letter_doc_id;
                    $array_detail['sptjm_doc_id']   = $data->sptjm_doc_id;
                    
                    $array_detail['status_nik_doc']   = $data->status_nik_doc;
                    $array_detail['status_poo_doc']   = $data->status_poo_doc;
                    $array_detail['status_result_doc']   = $data->status_result_doc;
                    $array_detail['status_letter_doc']   = $data->status_letter_doc;
                    // $array_detail['status_sptjm_doc']   = $data->status_sptjm_doc;
                    $array_detail['status_process']   = ($data->status_process == "Sedang diproses") ? "Belum Diteliti" :$data->status_process;
                    $array_detail['id_lhv']   = $data->id_lhv;
                    $array_detail['date_lhv']   = $data->date_lhv;
                    
                    $array_detail['checklist_code_spp'] = $data->checklist_code_spp;
                    $array_detail['checklist_name_owner']   = $data->checklist_name_owner;
                    $array_detail['checklist_type_field']   = $data->checklist_type_field;
                    $array_detail['checklist_nik']  = $data->checklist_nik;
                    $array_detail['checklist_id_nominatif'] = $data->checklist_id_nominatif;
                    $array_detail['checklist_id_master_field']  = $data->checklist_id_master_field;
                    $array_detail['checklist_village']  = $data->checklist_village;
                    $array_detail['checklist_sub_district'] = $data->checklist_sub_district;
                    $array_detail['checklist_district'] = $data->checklist_district;
                    $array_detail['checklist_type_proof_owner'] = $data->checklist_type_proof_owner;
                    $array_detail['checklist_area'] = $data->checklist_area;
                    $array_detail['checklist_nominal']  = $data->checklist_nominal;
                    
                    $array_detail['status_nik_doc'] = $data->status_nik_doc;
                    $array_detail['status_poo_doc'] = $data->status_poo_doc;
                    $array_detail['status_result_doc']  = $data->status_result_doc;
                    $array_detail['status_letter_doc']  = $data->status_letter_doc;
                    $array_detail['status_sptjm_doc']   = $data->status_sptjm_doc;
                    $array_detail['status_receipt_doc'] = $data->status_receipt_doc;
                    $array_detail['status_baugr_doc']   = $data->status_baugr_doc;
                    $array_detail['status_baph_doc']    = $data->status_baph_doc;
                    $array_detail['status_doc_spp']   = $data->status_doc_spp;
                    $array_detail['status_dok_letter']    = $data->status_dok_letter;
                    $array_detail['status_doc_add']    = $data->status_doc_add;
                    $array_detail['status_doc_rek_bpn']    = $data->status_doc_rek_bpn;
                    $array_detail['status_doc_court']    = $data->status_doc_court;
                    $array_detail['status_ba_court']    = $data->status_ba_court;
                    $array_detail['info_denied']    = $data->info_denied;
                    
                    
                    

                    
                    
                    
                    // doc_spp_id
                    // doc_sptjm_id
                    // doc_letter_id
                    // doc_bpn_id
                    
                    // Upload SPP Menteri/Kepala dan Lampiran OK
                    // Upload SPTJM OK
                    // Upload Surat Kesesuaian Dokumen OK
                    // Upload Validasi BPN OK
                    /** Bidang  **/
                    // Fotokopi Identitas dan dok. pendukung* OK
                    // Fotokopi Bukti Kepemilikan dan data pendukung* OK
                    // Fotokopi Laporan Hasil Penilaian* OK
                    // * Yang sudah dilegalisasi
                    // Kuitansi Pembayaran* OK
                    // BAUGR* OK
                    // BAPH*OK 
                    // Fotokopi surat rekomendasi BPN/ BA penitipan dari P2T* OK
                    // Fotokopi penetapan pengadilan* OK
                    // Fotokopi BA penyimpanan penitipan ganti rugi dari pengadilan* OK
                    // Dokumen Tambahan* OK
                    
                    // if(!empty($data->nik_doc_id)){
                    //     $nik_doc_id = $this->Bidang_model->db->get_where('field_document',array('id'=>$data->nik_doc_id))->result()[0];
                    //     $array_doc['nik_doc_id']    = $this->config->item('view_file_url').'/'.$nik_doc_id->s3_bucket.'/'.$nik_doc_id->s3_object;
                        
                    // }else{
                    //     $array_doc['nik_doc_id'] = NULL;
                    // }
                    
                    //KTP
                    if(!empty($data->nik_doc_id)){
                        $nik_doc_id = $this->Bidang_model->db->get_where('field_document',array('id'=>$data->nik_doc_id))->result()[0];
                        $array_doc['nik_doc_id']    = $this->config->item('view_file_url').'/'.$nik_doc_id->s3_bucket.'/'.$nik_doc_id->s3_object;
                        
                    }else{
                        $array_doc['nik_doc_id'] = NULL;
                    }
                    //bukti milik
                    if(!empty($data->poo_doc_id)){
                        $poo_doc_id = $this->Bidang_model->db->get_where('field_document',array('id'=>$data->poo_doc_id))->result()[0];
                        $array_doc['poo_doc_id']    = $this->config->item('view_file_url').'/'.$poo_doc_id->s3_bucket.'/'.$poo_doc_id->s3_object;
                    }else{
                        $array_doc['poo_doc_id'] = NULL;
                    }
                    
                    // Fotokopi Laporan Hasil Penilaian*
                    //bukti milik
                    if(!empty($data->result_doc_id)){
                        $poo_doc_id = $this->Bidang_model->db->get_where('field_document',array('id'=>$data->result_doc_id))->result()[0];
                        $array_doc['lhp_doc']    = $this->config->item('view_file_url').'/'.$poo_doc_id->s3_bucket.'/'.$poo_doc_id->s3_object;
                    }else{
                        $array_doc['lhp_doc'] = NULL;
                    }
                    
                    //kwitansi
                    if(!empty($data->receipt_doc_id)){
                        $result_doc_id = $this->Bidang_model->db->get_where('field_document',array('id'=>$data->receipt_doc_id))->result()[0];
                        $array_doc['kuitansi_doc'] = $this->config->item('view_file_url').'/'.$result_doc_id->s3_bucket.'/'.$result_doc_id->s3_object;
                    }else{
                        $array_doc['kuitansi_doc'] = NULL;
                    }
                    // BAUGR
                    if(!empty($data->baugr_doc_id)){
                        $result_doc_id = $this->Bidang_model->db->get_where('field_document',array('id'=>$data->baugr_doc_id))->result()[0];
                        $array_doc['baugr_doc'] = $this->config->item('view_file_url').'/'.$result_doc_id->s3_bucket.'/'.$result_doc_id->s3_object;
                    }else{
                        $array_doc['baugr_doc'] = NULL;
                    }
                    // BAPH
                    if(!empty($data->baph_doc_id)){
                        $result_doc_id = $this->Bidang_model->db->get_where('field_document',array('id'=>$data->baph_doc_id))->result()[0];
                        $array_doc['baph_doc'] = $this->config->item('view_file_url').'/'.$result_doc_id->s3_bucket.'/'.$result_doc_id->s3_object;
                    }else{
                        $array_doc['baph_doc'] = NULL;
                    }
                    
                    // Fotokopi surat rekomendasi BPN/ BA penitipan dari P2T*
                    if(!empty($data->doc_rek_bpn_id)){
                        $result_doc_id = $this->Bidang_model->db->get_where('field_document',array('id'=>$data->doc_rek_bpn_id))->result()[0];
                        $array_doc['rek_bpn_doc'] = $this->config->item('view_file_url').'/'.$result_doc_id->s3_bucket.'/'.$result_doc_id->s3_object;
                    }else{
                        $array_doc['rek_bpn_doc'] = NULL;
                    }
                    
                    // Fotokopi penetapan pengadilan*
                    if(!empty($data->doc_court_id)){
                        $result_doc_id = $this->Bidang_model->db->get_where('field_document',array('id'=>$data->doc_court_id))->result()[0];
                        $array_doc['court_doc'] = $this->config->item('view_file_url').'/'.$result_doc_id->s3_bucket.'/'.$result_doc_id->s3_object;
                    }else{
                        $array_doc['court_doc'] = NULL;
                    }
                    // Fotokopi BA penyimpanan penitipan ganti rugi dari pengadilan*
                    if(!empty($data->doc_ba_court_id)){
                        $result_doc_id = $this->Bidang_model->db->get_where('field_document',array('id'=>$data->doc_ba_court_id))->result()[0];
                        $array_doc['ba_court_doc'] = $this->config->item('view_file_url').'/'.$result_doc_id->s3_bucket.'/'.$result_doc_id->s3_object;
                    }else{
                        $array_doc['ba_court_doc'] = NULL;
                    }
                    // Dokumen Tambahan*
                    if(!empty($data->doc_add_id)){
                        $result_doc_id = $this->Bidang_model->db->get_where('field_document',array('id'=>$data->doc_add_id))->result()[0];
                        $array_doc['add_doc'] = $this->config->item('view_file_url').'/'.$result_doc_id->s3_bucket.'/'.$result_doc_id->s3_object;
                    }else{
                        $array_doc['add_doc'] = NULL;
                    }

                    
                    
                    // spp
                    if(!empty($data->doc_spp_id)){
                        $letter_doc_id = $this->Bidang_model->db->get_where('document',array('id'=>$data->doc_spp_id))->result()[0];
                        $array_doc['spp_doc'] = $this->config->item('view_file_url').'/'.$letter_doc_id->s3_bucket.'/'.$letter_doc_id->s3_object;
                    }else{
                        $array_doc['spp_doc'] = NULL;
                    }
                    // surat validasi BPN
                    if(!empty($data->doc_bpn_id)){
                        $letter_doc_id = $this->Bidang_model->db->get_where('document',array('id'=>$data->doc_bpn_id))->result()[0];
                        $array_doc['bpn_doc_id'] = $this->config->item('view_file_url').'/'.$letter_doc_id->s3_bucket.'/'.$letter_doc_id->s3_object;
                    }else{
                        $array_doc['bpn_doc_id'] = NULL;
                    }
                    
                    // DOK SPTJM
                    if(!empty($data->doc_sptjm_id)){
                        $sptjm_doc_id = $this->Bidang_model->db->get_where('document',array('id'=>$data->doc_sptjm_id))->result()[0];
                        
                        $array_doc['sptjm_doc']  = $this->config->item('view_file_url').'/'.$sptjm_doc_id->s3_bucket.'/'.$sptjm_doc_id->s3_object;
                    }else{
                        $array_doc['sptjm_doc']  = NULL;
                    }
                    // Surat Kesesuaian Dokumen
                    if(!empty($data->doc_letter_id)){
                        $letter_doc_id = $this->Bidang_model->db->get_where('document',array('id'=>$data->doc_letter_id))->result()[0];
                        $array_doc['letter_conform_doc'] = $this->config->item('view_file_url').'/'.$letter_doc_id->s3_bucket.'/'.$letter_doc_id->s3_object;
                    }else{
                        $array_doc['letter_conform_doc'] = NULL;
                    }
                    
                    // if(!empty($data->result_doc_id)){
                    // }else{
                    // }
                    
                    
                    // if($id == "" ){
                        if($data->status_process == 'Sedang diproses')
                        {
                            $array_detail['action'] = '<button class="btn btn-success btn-sm" onclick="check_field('."'$data->id'".')"><i class="flaticon-edit-1"></i> Teliti Bidang</button>';
                            
                        }else{
                            $array_detail['action'] = '<button class="btn btn-outline-success btn-sm" onclick="check_field('."'$data->id'".')"><i class="flaticon-edit-1"></i> Teliti Ulang</button>';
                        }
                    // }

                    $num++;
                    array_push($dataArr,$array_detail);
                    array_push($dataDoc,$array_doc);
                }
                $this->response(array(
                    'status'=>'success',
                    'message'=>'',
                    'elapsed_time' => $this->benchmark->elapsed_time(),
        			'data' => $dataArr,
        			'document' => $dataDoc,
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
    function get_data_bidang_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Bidang_model');
            $this->load->model('Spp_model');
            $id = $this->lman_security->clean_post('id_bidang');
            
            $ceheckUpdateSppStatus = $this->Spp_model->db->get_where('spp',array('status_process'=>'Belum Diteliti','id'=>$this->lman_security->clean_post('id_spp')))->num_rows();
            // print_r($ceheckUpdateSppStatus);die();
            if($ceheckUpdateSppStatus > 0){
                $updateSppStatus = $this->Spp_model->update(array('status_process'=>'Dalam Proses Penelitian'),array('id'=>$this->lman_security->clean_post('id_spp')));
            }
            
            $result= $this->Bidang_model->getDataBidangStaff();
            $resultCheck= $this->Spp_model->checkSPpKadiv();
            if(!empty($resultCheck)){
                $resultStatus = true;
            }else{
                $resultStatus=false;
            }
            
            
            $dataArr = array();
            $num = 1;
            if(!empty($result)){
                foreach ( $result as $data ){
                    $array_detail['num']            = $num;
                    $array_detail['no_spp']         = $data->spp_no;
                    
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
                    
                    
                    $array_detail['compensation_type']= $data->compensation_type;
                    $array_detail['field_condition']= $data->field_condition;
                    $array_detail['is_eligible']    = $data->is_eligible;
                    $array_detail['id_lhv']         = $data->id_lhv;
                    $array_detail['date_lhv']       = $data->date_lhv;
                    $array_detail['is_konsinyasi']  = $data->is_konsinyasi;
                    $array_detail['val_num']        = $data->val_num;
                    $array_detail['val_date']       = $data->val_date;
                    
                    
                    
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
                    $array_detail['letter_doc_id']  = $data->letter_doc_id;
                    $array_detail['sptjm_doc_id']   = $data->sptjm_doc_id;
                    $array_detail['status_nik_doc']   = $data->status_nik_doc;
                    $array_detail['status_poo_doc']   = $data->status_poo_doc;
                    $array_detail['status_result_doc']   = $data->status_result_doc;
                    $array_detail['status_letter_doc']   = $data->status_letter_doc;
                    $array_detail['status_sptjm_doc']   = $data->status_sptjm_doc;
                    $array_detail['status_process']   = ($data->status_process == "Sedang diproses") ? "Belum Diteliti" :$data->status_process;
                    
                    
                    // if($id == "" ){
                        if($data->status_process === 'Sedang diproses')
                        {
                            $array_detail['name']  ='<span class="label label-info label-pill label-inline">'.$data->name.'</span>';
                            $array_detail['action'] = '<button class="btn btn-success btn-sm" onclick="check_field('."'$data->id'".')"><i class="flaticon-edit-1"></i> Teliti Bidang</button>';
                            
                        }else{
                            if($data->status_process === 'Belum Dikirm'){
                                $array_detail['name']  = '<span class="label label-primary label-pill label-inline">'.$data->name.'</span>';
                            }elseif($data->status_process === 'Diterima'){
                                $array_detail['name']  = '<span class="label label-success label-pill label-inline">'.$data->name.'</span>';
                            }else{
                                //tertolak
                                $array_detail['name']  = '<span class="label label-danger label-pill label-inline">'.$data->name.'</span>';
                            }
                            $array_detail['action'] = '<button class="btn btn-outline-success btn-sm" onclick="check_field('."'$data->id'".')"><i class="flaticon-edit-1"></i> Teliti Ulang</button>';
                        }
                    // }

                    $num++;
                    array_push($dataArr,$array_detail);
                }
                $this->response(array(
                    'status'=>'success',
                    'message'=>'',
                    'elapsed_time' => $this->benchmark->elapsed_time(),
        			'data' => $dataArr,
        			'sendStatus' => $resultStatus
        // 			'sendStatus' => true
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
    
    
    
    function update_approval_post()
    {
        if (VALID_LOGIN === true ) {
            $postdata = ($_POST);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_bidang', 'ID Bidang', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_rules('column', 'Kolom', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $this->response( array('status'=>'error',
                        'message'=>validation_errors()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else {
                    $column = $this->lman_security->clean_post('column');
                    $data = array(
                        $column =>$this->lman_security->clean_post('status')
                    );
                    //   'status'    =>'ACTIVE'
                    $this->load->model('Bidang_model');
                    $data_id = $this->Bidang_model->update($data,array('id'=>$this->lman_security->clean_post('id_bidang')));
                    if (!$data_id){
                        $this->response( array('status'=>'error',
                            'message'=>"Gagal Simpan data ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                    } else {
                        $this->response(array('status'=>'success','message'=>'Berhasil Simpan'));
                        
                    }
            }
        } else {
            $this->response( array('status'=>'error',
                            'message'=>"Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    function update_approval_spp_post()
    {
        if (VALID_LOGIN === true ) {
            $postdata = ($_POST);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_spp', 'ID SPP', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_rules('column', 'Kolom', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $this->response( array('status'=>'error',
                        'message'=>validation_errors()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else {
                    $column = $this->lman_security->clean_post('column');
                    $data = array(
                        $column =>$this->lman_security->clean_post('status')
                    );
                    //   'status'    =>'ACTIVE'
                    $this->load->model('Spp_model');
                    $data_id = $this->Spp_model->update($data,array('id'=>$this->lman_security->clean_post('id_spp')));
                    if (!$data_id){
                        $this->response( array('status'=>'error',
                            'message'=>"Gagal Simpan data ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                    } else {
                        $this->response(array('status'=>'success','message'=>'Berhasil Simpan'));
                        
                    }
            }
        } else {
            $this->response( array('status'=>'error',
                            'message'=>"Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    //update_approval_lhv
    function update_approval_bidang_post()
    {
        if (VALID_LOGIN === true ) {
            $postdata = ($_POST);
            $paymentType = $this->lman_security->clean_post('payment_type');
            $paymentTo   = $this->lman_security->clean_post('payment_to');
            $konsinyasi  = $this->lman_security->clean_post('konsinyasi');
            $status      = $this->lman_security->clean_post('status');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_bidang', 'id_bidang', 'required');
            // $this->form_validation->set_rules('nomor_lhv', 'nomor_lhv', 'required');
            // $this->form_validation->set_rules('tgl_lhv', 'tgl_lhv', 'required');
            
            $this->form_validation->set_rules('txtBtnSpp', 'txtBtnSpp', 'required');
            $this->form_validation->set_rules('txtBtnName', 'txtBtnName', 'required');
            $this->form_validation->set_rules('txtBtnJns', 'txtBtnJns', 'required');
            $this->form_validation->set_rules('txtBtnNominatif', 'txtBtnNominatif', 'required');
            $this->form_validation->set_rules('txtBtnNibs', 'txtBtnNibs', 'required');
            $this->form_validation->set_rules('txtBtnKec', 'txtBtnKec', 'required');
            $this->form_validation->set_rules('txtBtnDesa', 'txtBtnDesa', 'required');
            $this->form_validation->set_rules('txtBtnKab', 'txtBtnKab', 'required');
            $this->form_validation->set_rules('txtBtnJnsBukti', 'txtBtnJnsBukti', 'required');
            $this->form_validation->set_rules('txtBtnLuas', 'txtBtnLuas', 'required');
            $this->form_validation->set_rules('txtBtnHarga', 'txtBtnHarga', 'required');
            
            $this->form_validation->set_rules('txtBtnTmSpp', 'txtBtnTmSpp', 'required');
            $this->form_validation->set_rules('txtBtnConformLetter', 'txtBtnConformLetter', 'required');
            
            
            if($paymentType === 'Talangan'){
                $this->form_validation->set_rules('txtBtnReceipt', 'txtBtnReceipt', 'required');
                $this->form_validation->set_rules('txtBtnBaugr', 'txtBtnBaugr', 'required');
                $this->form_validation->set_rules('txtBtnBaph', 'txtBtnBaph', 'required');
                if($konsinyasi === 1){
                    $this->form_validation->set_rules('txtBtnRekBpn', 'txtBtnRekBpn', 'required');
                    $this->form_validation->set_rules('txtBtnCourt', 'txtBtnCourt', 'required');
                    $this->form_validation->set_rules('txtBtnBaCourt', 'txtBtnBaCourt', 'required');
                    
                }
                
                $this->form_validation->set_rules('txtBtnSptjm', 'txtBtnSptjm', 'required');
                $this->form_validation->set_rules('txtBtnDocAdd', 'txtBtnDocAdd', 'required');
                $this->form_validation->set_rules('txtBtnCopyId', 'txtBtnCopyId', 'required');
                $this->form_validation->set_rules('txtBtnCopyBm', 'txtBtnCopyBm', 'required');
                $this->form_validation->set_rules('txtBtnCopyLhp', 'txtBtnCopyLhp', 'required');
                
            }
            if($paymentType === 'Langsung'){
                if($paymentTo === 'Pengadilan'){
                    $this->form_validation->set_rules('txtBtnRekBpn', 'txtBtnRekBpn', 'required');
                    $this->form_validation->set_rules('txtBtnCourt', 'txtBtnCourt', 'required');
                }else{
                    $this->form_validation->set_rules('txtBtnSptjm', 'txtBtnSptjm', 'required');
                    $this->form_validation->set_rules('txtBtnDocAdd', 'txtBtnDocAdd', 'required');
                    $this->form_validation->set_rules('txtBtnCopyId', 'txtBtnCopyId', 'required');
                    $this->form_validation->set_rules('txtBtnCopyBm', 'txtBtnCopyBm', 'required');
                    $this->form_validation->set_rules('txtBtnCopyLhp', 'txtBtnCopyLhp', 'required');
                    $this->form_validation->set_rules('txtBtnNik', 'txtBtnNik', 'required');
                    
                }
            }
            $this->form_validation->set_rules('txtBtnBpn', 'txtBtnBpn', 'required');
            $this->form_validation->set_rules('catatan_approval', 'catatan_approval', 'required');
            $this->form_validation->set_rules('id_bidang', 'id_bidang', 'required');
            if($status === 'Tertolak'){
                $this->form_validation->set_rules('status', 'id_bidang', 'required');
            }
    
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $this->response( array('status'=>'error',
                        'message'=>'Pastikan data verifikasi sudah di cek semua' /* .validation_errors() */),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else {
                    $column = $this->lman_security->clean_post('column');
                    $data = array(
                        'info_denied' =>$this->lman_security->clean_post('catatan_approval'),
                        'status_process'=>$this->lman_security->clean_post('status'),
                    );
                    //   'status'    =>'ACTIVE'
                    $this->load->model('Bidang_model');
                    $data_id = $this->Bidang_model->update($data,array('id'=>$this->lman_security->clean_post('id_bidang')));
                    if (!$data_id){
                        $this->response( array('status'=>'error',
                            'message'=>"Gagal Simpan data ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                    } else {
                        $this->response(array('status'=>'success','message'=>'Berhasil Simpan'));
                        
                    }
            }
        } else {
            $this->response( array('status'=>'error',
                            'message'=>"Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
        
        
        
        
        
        
        
        
        
        
        
        
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
            $this->form_validation->set_rules('id_doc_spp', 'Dokumen SPP', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $this->response( array('status'=>'error',
                        'message'=>validation_errors()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else {
                    $data = array(
                        'psn_id'=>$this->lman_security->clean_post('psn_name_data'),
                        'payment_type'=>$this->lman_security->clean_post('payment_type'),
                        'payment_to'=>$this->lman_security->clean_post('payment_to'),
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
                $checkSPP = $this->Spp_model->db->get_where('spp',array('spp_num'=>$this->lman_security->clean_post('spp_num')));
                if($checkSPP->num_rows() >=1){
                    $this->response( array('status'=>'error',
                            'message'=>"SPP Sudah Pernah di Input!"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }else{
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
