<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Monitoring extends REST_Controller {
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
    function spp_monitoring_ppk_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Monitoring_model');
            $result= $this->Monitoring_model->getDataMonitoringSpp();
            // print_r($result);die();
            // $lastProcess= $this->Monitoring_model->getLastProcessSpp();
            $dataArr = array();
            $dataArrTimeline = array();
            $num = 1;
            $num2 = 1;
            $status = false;
            $date = '';
            
            if(!empty($result)){
                foreach ( $result as $data ){
                    // if($data->payment_type == "COF"){
                    //     $status = "Belum Di approve";
                    // }else{
                    // }
                    $dataRefTimeLine = $this->Monitoring_model->db->order_by('id','asc')->get_where('ref_timeline',array('status'=> 'ACTIVE'));
                    $lastProcess= $this->Monitoring_model->getLastProcessSpp($data->id);
                    if(!empty($dataRefTimeLine->result())){
                        foreach ( $dataRefTimeLine->result() as $iData  => $data2 ){
                            $result2= $this->Monitoring_model->getDataMonitoringSpp2($data->id,$data2->id);
                            if(empty($result2)){
                                if($lastProcess->lastProcess == 3){
                                    $array_detail2[$iData][$iData]['info_title']     = "Softcopy dokumen anda sudah di terima dan sedang kami cek";
                                    $array_detail2[$iData][$iData]['info_alert']     = "Silahkan mengirimkan hardcopy Anda";
                                    $array_detail2[$iData][$iData]['info_download']  = "Download Guidline PDF";
                                    $array_detail2[$iData][$iData]['date']           = "Sedang Proses";
                                    $array_detail2[$iData][$iData]['timeline_class'] = "text-success";
                                    $array_detail2[$iData][$iData]['wizard_icon']    = "far fa-check-circle icon-3x text-success mt-5 mb-5";
                                    $array_detail2[$iData][$iData]['check']          = "";
                                }else{
                                    $array_detail2[$iData][$iData]['info_title']     = "";
                                    $array_detail2[$iData][$iData]['info_alert']     = "";
                                    $array_detail2[$iData][$iData]['info_download']  = "";
                                    $array_detail2[$iData][$iData]['timeline_class'] = "text-muted";
                                    $array_detail2[$iData][$iData]['wizard_icon']    = "far fa-check-circle icon-3x text-muted mt-5 mb-5";
                                    $array_detail2[$iData][$iData]['date']           = "-";
                                    $array_detail2[$iData][$iData]['check']          = "";
                                    $status = false;
                                }
                            }else{
                                if($lastProcess->lastProcess == 6){
                                    $array_detail2[$iData][$iData]['info_title']     = "Surat Keputusan Pembayaran Lahan";
                                    $array_detail2[$iData][$iData]['info_alert']     = "LIHAT";
                                    $array_detail2[$iData][$iData]['info_download']  = "DOWNLOAD";
                                    $array_detail2[$iData][$iData]['timeline_class'] = "text-success";
                                    $array_detail2[$iData][$iData]['wizard_icon']    = "far fa-check-circle icon-3x text-success mt-5 mb-5";
                                    $array_detail2[$iData][$iData]['date']           = date("Y-m-d",strtotime($result2->date));
                                    $array_detail2[$iData][$iData]['check']          = "";
                                    
                                }else{
                                    $array_detail2[$iData][$iData]['info_title']     = "";
                                    $array_detail2[$iData][$iData]['info_alert']     = "";
                                    $array_detail2[$iData][$iData]['info_download']  = "";
                                    $array_detail2[$iData][$iData]['timeline_class'] = "text-success";
                                    $array_detail2[$iData][$iData]['wizard_icon']    = "far fa-check-circle icon-3x text-success mt-5 mb-5";
                                    $array_detail2[$iData][$iData]['date']           = "Uang sudah terbayar tanggal: ".date("Y-m-d",strtotime($result2->date));
                                    $array_detail2[$iData][$iData]['check']          = "";
                                    $status = false;
                                    
                                }
                            }
                            $array_detail2[$iData][$iData]['id']            = $data2->id;
                            $array_detail2[$iData][$iData]['desc']           = $data2->description;
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            $array_detail2[$iData][$iData]['id']            = $data2->id;
                            $array_detail2[$iData][$iData]['desc']           = $data2->description;
                            $result2= $this->Monitoring_model->getDataMonitoringSpp2($data->id,$data2->id);
                            
                            
                            if($status == true){
                                $array_detail2[$iData][$iData]['timeline_class'] = "text-muted";
                                $array_detail2[$iData][$iData]['wizard_icon']    = "far fa-check-circle icon-3x text-muted mt-5 mb-5";
                                
                                if($data2->id == 4){
                                    $array_detail2[$iData][$iData]['info_title']     = "Softcopy dokumen anda sudah di terima dan sedang kami cek";
                                    $array_detail2[$iData][$iData]['info_alert']     = "Silahkan mengirimkan hardcopy Anda";
                                    $array_detail2[$iData][$iData]['info_download']  = "Download Guidline PDF";
                                    $array_detail2[$iData][$iData]['date']           = "Sedang Proses";
                                    $array_detail2[$iData][$iData]['timeline_class'] = "text-success";
                                    $array_detail2[$iData][$iData]['wizard_icon']    = "far fa-check-circle icon-3x text-success mt-5 mb-5";
                                }else{
                                    $array_detail2[$iData][$iData]['info_title']     = "";
                                    $array_detail2[$iData][$iData]['info_alert']     = "";
                                    $array_detail2[$iData][$iData]['info_download']  = "";
                                    $array_detail2[$iData][$iData]['date']           = "-";
                                }
                            }else{
                                $array_detail2[$iData][$iData]['info_title']     = "";
                                $array_detail2[$iData][$iData]['info_alert']     = "";
                                $array_detail2[$iData][$iData]['info_download']  = "";
                                if(empty($result2)){
                                    $array_detail2[$iData][$iData]['timeline_class'] = "text-muted";
                                    $array_detail2[$iData][$iData]['wizard_icon']    = "far fa-check-circle icon-3x text-muted mt-5 mb-5";
                                    $array_detail2[$iData][$iData]['date']           = "-";
                                    $status = false;
                                    $array_detail2[$iData][$iData]['check']          = "";
                                }else{
                                    $idTimeline = intval($result2->timeline_id);
                                    if($idTimeline == 3){
                                        $status = true;
                                        $date = date("Y-m-d",strtotime($result2->date));
                                    }else{
                                        $status = false;
                                    }
                                    if($lastProcess->lastProcess == 6){
                                        $array_detail2[$iData][$iData]['info_title']     = "Surat Keputusan Pembayaran Lahan";
                                        $array_detail2[$iData][$iData]['info_alert']     = "LIHAT";
                                        $array_detail2[$iData][$iData]['info_download']  = "DOWNLOAD";
                                        $array_detail2[$iData][$iData]['date']           = "Uang sudah terbayar tanggal: ".date("Y-m-d",strtotime($result2->date));
                                        // strtotime($dt->format("Y-m-d")
                                    }else{
                                        $array_detail2[$iData][$iData]['timeline_class'] = "text-success";
                                        $array_detail2[$iData][$iData]['wizard_icon']    = "far fa-check-circle icon-3x text-success mt-5 mb-5";
                                        $array_detail2[$iData][$iData]['date']           = date("Y-m-d",strtotime($result2->date));
                                        
                                    }
                                    
                                    
                                }
                            }
                            $array_detail2[$iData]['icon_color']     = '';
                            
                            array_push($dataArrTimeline,$array_detail2);
                        }
                    }
                    
                    
                    if($data->status_spp == "Sudah Kirim"){
                        $status = "Belum Di approve";
                    }else{
                        $status = $data->status_spp;
                    }
                    $array_detail['num']        = $num;
                    $array_detail['id']         = $data->id;
                    $array_detail['psn_name']   = $data->psn_name;
                    $array_detail['spp_no']     = $data->spp_num;
                    $array_detail['timeline']   =  $array_detail2;
                    // $array_detail['timeline']   =  ( !empty($dataRefTimeLine) ) ? $array_detail2 : "";
                    $array_detail['spp_status'] = $status;
                    $array_detail['spp_type']   = $data->payment_type;
                    $array_detail['tes']   = $dataArrTimeline;
                    // $result= $this->Monitoring_model->getDataMonitoringSpp($data->id);
                    
                    
                    
                    
                    
                    $array_detail['icon_color']     = '';
                    
                    $num++;
                    array_push($dataArr,$array_detail);
                }
                $this->response(array(
                    'status'=>'success',
                    'message'=>'',
                    'elapsed_time' => $this->benchmark->elapsed_time(),
        			'data' => $dataArr,
                ));
            }else{
                $this->response( array('status'=>'failure',
                    'message'=>'Data Kosong'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $this->response(array(
                    'status'=>'error',
                    'message'=>'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.',
                    'elapsed_time' => $this->benchmark->elapsed_time()
                ));
        }
    } 
    
    function spp_monitoring_ppk2_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Monitoring_model');
            $id = $this->lman_security->clean_post('id_bidang');
            $dataRefTimeLine = $this->Monitoring_model->db->order_by('id','asc')->get_where('ref_timeline',array('status'=> 'ACTIVE'));
            $lastProcess= $this->Monitoring_model->getLastProcessSpp();
            $dataArr = array();
            $num = 1;
            $status = false;
            $date = '';
            if(!empty($dataRefTimeLine)){
                foreach ( $dataRefTimeLine->result() as $data ){
                    $array_detail['num']            = $num;
                    $array_detail['desc']           = $data->description;
                    $result= $this->Monitoring_model->getDataMonitoringSpp($data->id);
                    
                    
                    if($status == true){
                        $array_detail['timeline_class'] = "text-muted";
                        $array_detail['wizard_icon']    = "far fa-check-circle icon-3x text-muted mt-5 mb-5";
                        
                        if($data->id == 4){
                            $array_detail['info_title']     = "Softcopy dokumen anda sudah di terima dan sedang kami cek";
                            $array_detail['info_alert']     = "Silahkan mengirimkan hardcopy Anda";
                            $array_detail['info_download']  = "Download Guidline PDF";
                            $array_detail['date']           = "Sedang Proses";
                        }else{
                            $array_detail['info_title']     = "";
                            $array_detail['info_alert']     = "";
                            $array_detail['info_download']  = "";
                            $array_detail['date']           = "";
                        }
                    }else{
                        $array_detail['info_title']     = "";
                        $array_detail['info_alert']     = "";
                        $array_detail['info_download']  = "";
                        if(empty($result)){
                            $array_detail['timeline_class'] = "text-muted";
                            $array_detail['wizard_icon']    = "far fa-check-circle icon-3x text-muted mt-5 mb-5";
                            $array_detail['date']           = "";
                            $status = false;
                            $array_detail['check']          = "";
                        }else{
                            $idTimeline = intval($result->timeline_id);
                            if($idTimeline == 3){
                                $status = true;
                                $date = date("Y-m-d",strtotime($result->date));
                            }else{
                                $status = false;
                            }
                            if($lastProcess->lastProcess == 6){
                                $array_detail['info_title']     = "Surat Keputusan Pembayaran Lahan";
                                $array_detail['info_alert']     = "LIHAT";
                                $array_detail['info_download']  = "DOWNLOAD";
                                $array_detail['date']           = "Uang sudah terbayar tanggal: ".date("Y-m-d",strtotime($result->date));
                                // strtotime($dt->format("Y-m-d")
                            }else{
                                $array_detail['timeline_class'] = "text-success";
                                $array_detail['wizard_icon']    = "far fa-check-circle icon-3x text-success mt-5 mb-5";
                                $array_detail['date']           = date("Y-m-d",strtotime($result->date));
                                
                            }
                            
                            
                        }
                    }
                    
                    
                    $array_detail['icon_color']     = '';
                    
                    $num++;
                    array_push($dataArr,$array_detail);
                }
                $this->response(array(
                    'status'=>'success',
                    'message'=>'',
                    'elapsed_time' => $this->benchmark->elapsed_time(),
        			'data' => $dataArr,
                ));
            }else{
                $this->response( array('status'=>'failure',
                    'message'=>'Data Kosong'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $this->response(array(
                    'status'=>'error',
                    'message'=>'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.',
                    'elapsed_time' => $this->benchmark->elapsed_time()
                ));
        }
    }  
    
    
    function spp_history_ppk_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Bidang_model');
            $id = $this->lman_security->clean_post('id_bidang');
            $result= $this->Bidang_model->spp_history_ppk();
            // $resultStatus= $this->Bidang_model->getDataBidangStatus();
            $dataArr = array();
            $dataArrCof = array();
            $num = 1;
            if(!empty($result)){
                foreach ( $result as $data ){
                    // print_r(COMPANY_ID);die();
                    $array_detail['num']        = $num;
                    $array_detail['fieldtype']  = $data->fieldtype;
                    $array_detail['psn_name']   = $data->psn_name;
                    $array_detail['area']       = $data->area." m<sup>2</sup>";
                    $array_detail['nominal']    = $this->general_library->format_rupiah($data->nominal);
                    $array_detail['name']       = ucfirst($data->name);
                    
                    $array_detail['fieldtype_name']= $data->fieldtype_name;
                    $array_detail['date_process']  = ($data->date_process ='0000-00-00') ? $data->date_process : null;
                    $array_detail['date_decision'] = !empty($data->date_decision) ? $data->date_decision : null;
                    if(!empty($data->doc_id)){
                        $array_detail['action'] = '<button class="btn btn-success btn-sm" onclick="edit_field('."'$data->id'".')"><i class="flaticon-edit-1"></i> Edit Bidang</button>';
                    }else{
                        $array_detail['action'] = '';
                    }

                    $num++;
                    array_push($dataArr,$array_detail);
                }
                $this->response(array(
                    'status'=>'success',
                    'message'=>'',
                    'elapsed_time' => $this->benchmark->elapsed_time(),
        			'dataHistory' => $dataArr,
        // 			'dataCof' => $dataArrCof,
        // 			'sendStatus' => $resultStatus
                ));
            }else{
                $this->response( array('status'=>'failure',
                    'message'=>'Data Kosong'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $this->response(array(
                    'status'=>'error',
                    'message'=>'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.',
                    'elapsed_time' => $this->benchmark->elapsed_time()
                ));
        }
    }
    
    
    
    function spp_allocations_ppk_post()
    {
         $this->response( array('status'=>'failure',
                    'message'=>'Data Kosong'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }
    
    




}
