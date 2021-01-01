<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Penelitian_administrasi extends REST_Controller {
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
            $result= $this->Spp_model->getDataSppAll();
            $dataArr = array();
            if(!empty($result)){
                foreach ( $result as $data ){
                    $array_detail['id']         = $data->id;
                    $array_detail['spp_no']     = $data->spp_num;
                    $array_detail['psn_name']   = ucfirst(strtolower($data->sector_name))." ".ucfirst($data->psn_name);
                    $array_detail['psn_type']   = $data->payment_type;
                    $array_detail['payment_to']     = $data->payment_to;
                    $array_detail['status_spp'] = $data->status_spp;
                    $array_detail['status_process'] = $data->status_process;
                    $array_detail['pic'] = (!empty($data->name_pic)) ? ($data->userid_pic."+".str_replace(" ","-",$data->name_pic)) : '';
                    $array_detail['pic2'] = (!empty($data->name_pic)) ? ucfirst(strtolower($data->name_pic)): '';
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
    function get_data_spp_kadiv_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Spp_model');
            $result= $this->Spp_model->getDataSppKadiv();
            $dataArr = array();
            if(!empty($result)){
                foreach ( $result as $data ){
                    $array_detail['id']         = $data->id;
                    $array_detail['spp_no']     = $data->spp_num;
                    $array_detail['psn_name']   = ucfirst(strtolower($data->sector_name))." ".ucfirst($data->psn_name);
                    $array_detail['psn_type']   = $data->payment_type;
                    $array_detail['payment_to']     = $data->payment_to;
                    $array_detail['status_spp'] = $data->status_spp;
                    $array_detail['status_process'] = $data->status_process;
                    $array_detail['pic'] = (!empty($data->name_pic)) ? ($data->userid_pic."+".str_replace(" ","-",$data->name_pic)) : '';
                    $array_detail['pic2'] = (!empty($data->name_pic)) ? ucfirst(strtolower($data->name_pic)): '';
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
    function get_data_pegawai_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('User_model');
            $result= $this->User_model->getPegawaiStaff();
            $dataArr = array();
            if(!empty($result)){
                foreach ( $result as $data ){
                    $array_detail['id']         = $data->id;
                    $array_detail['userid']     = $data->user_id;
                    $array_detail['name']   = $data->name;
                    $array_detail['nip_npp']   = $data->nip_npp;
                    $array_detail['userid_name'] = $data->user_id."+".str_replace(" ", "-", $data->name);
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
    function update_pic_spp_post()
    {
        if (VALID_LOGIN === true ) {
            $postdata = ($_POST);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_spp', 'Kode SPP', 'required');
            $this->form_validation->set_rules('name_pic', 'Nama PIC', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $this->response( array('status'=>'error',
                        'message'=>validation_errors()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else {
                    $pegawai    = explode("+",$this->lman_security->clean_post('name_pic'));
                    $userid     = $pegawai[0];
                    $pic_name   = str_replace("-", " ",$pegawai[1]);
                    $data = array(
                        // 'id'=>$this->lman_security->clean_post('id_spp'),
                        'userid_pic'=>$userid,
                        'name_pic'=>$pic_name
                    );
                    //   'status'    =>'ACTIVE'
                $this->load->model('Spp_model');
                $dataUpdate = $this->Spp_model->update($data,array('id'=>$this->lman_security->clean_post('id_spp')));
                if (!$dataUpdate){
                    $this->response( array('status'=>'error',
                        'message'=>"Gagal Simpan data ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $this->response(array('status'=>'success','message'=>'Berhasil Simpan'),200);
                }
            }
        } else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }
    }
    
    //get_summary_spp
    function get_summary_spp_post()
    {
        if(VALID_LOGIN === true){
            $postdata = ($_POST);
            $this->load->model('Spp_model');
            $result= $this->Spp_model->getDataSppAll();
            $dataArr = array();
            $dataArrField = array();
            if(!empty($result)){
                foreach ( $result as $data ){
                    $array_detail['id']         = $data->id;
                    $array_detail['spp_no']     = $data->spp_num;
                    $array_detail['psn_name']   = ucfirst(strtolower($data->sector_name))." ".ucfirst($data->psn_name);
                    $array_detail['psn_type']   = $data->payment_type;
                    $array_detail['payment_to']     = $data->payment_to;
                    $array_detail['status_spp'] = $data->status_spp;
                    $array_detail['status_process'] = $data->status_process;
                    $array_detail['pic'] = (!empty($data->name_pic)) ? ($data->userid_pic."+".str_replace(" ","-",$data->name_pic)) : '';
                    $array_detail['pic2'] = (!empty($data->name_pic)) ? ucfirst(strtolower($data->name_pic)): '';
                    array_push($dataArr,$array_detail);
                }
                $this->load->model('Bidang_model');
                $id = $this->lman_security->clean_post('id_bidang');
                $fieldResult= $this->Bidang_model->getDataBidang();
                // print_r($fieldResult);die();
                $num = 1;
                    foreach ( $fieldResult as $data ){
                        $info = $data->status_process;
                        $result = "<span class='text-dark'>".$data->status_process."</span>";
                        if($info === "Tertolak"){
                            $result = "<span class='text-danger'>".$data->status_process."</span>";
                        }
                        $array_detailField['num']            = $num;
                        $array_detailField['type_field']     = $data->field_type;
                        $array_detailField['nominal_idr']    = $this->general_library->format_rupiah($data->nominal);
                        $array_detailField['result']     = $result;
                        $array_detailField['noted']     = (!empty($data->info_denied)) ? $data->info_denied : "-";
    
                        $num++;
                        array_push($dataArrField,$array_detailField);
                    }
                $this->response(array(
                    'status'=>'success',
                    'message'=>'',
                    'elapsed_time' => $this->benchmark->elapsed_time(),
        			'dataSpp' => $dataArr,
        			'dataBidang' =>$dataArrField,
        			'dataLampiran' =>''
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
    
    
    function update_spp_approval_kadiv_post()
    {
        if (VALID_LOGIN === true ) {
            $postdata = ($_POST);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_spp', 'Kode SPP', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_error_delimiters("", "\r\n");

            // if validations returns FALSE statement
            if ($this->form_validation->run() == FALSE) {
                $this->response( array('status'=>'error',
                        'message'=>validation_errors()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else {
                    $status     = $this->lman_security->clean_post('status');
                    $message    = $this->lman_security->clean_post('message');
                    if($status === "Tertolak"){
                        $infoStatus = "Sudah Diteliti";
                    }else{
                        $status = "Menunggu Approval";
                        $infoStatus = "Nota Dinas sudah dikirim ke Direktur";
                    }
                    $data = array(
                        // 'id'=>$this->lman_security->clean_post('id_spp'),
                        'status_spp'        =>$status,
                        'status_process'    =>$infoStatus,
                        'role_process'      =>ROLE_ID,
                        'message_rejected'  =>ucwords($message),
                        'is_notif'          => 1
                    );
                    //   'status'    =>'ACTIVE'
                $this->load->model('Spp_model');
                $this->load->model('ProcessSpp_model');
                $dataUpdate = $this->Spp_model->update($data,array('id'=>$this->lman_security->clean_post('id_spp')));
                if (!$dataUpdate){
                    $this->response( array('status'=>'error',
                        'message'=>"Gagal Simpan data ke Database"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    if($status != 'Tertolak'){
                        $data_timeline = $this->ProcessSpp_model->db->get_where('timeline_spp',array('spp_id'=> $this->lman_security->clean_post('id_spp'),'name'=>'Persetujuan Pembayaran'));
                        if ($data_timeline->num_rows() == 0){
                            $dataInsert = array(
                            'spp_id'=>$this->lman_security->clean_post('id_spp'),
                            'name'=>'Persetujuan Pembayaran',
                            'timeline_id'=>5,
                            'description'=>'Persetujuan Pembayaran',
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
                    $this->response(array('status'=>'success','message'=>'Berhasil Simpan'),200);
                }
            }
        } else {
            $result = array(
                'status' => 'error',
                'message' => 'Akses ditolak, Anda belum login, sesi login habis atau tidak memiliki hak akses yang cukup.'
            );
        }
    }
    
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        ///end penelitian Penelitian_administrasi
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
