<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Created on Sat Jun 13 2020 3:48:51 AM
 *
 * Filename Cron.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Cron extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // =get data file
    function save_cron_post()
    {
      $postdata = $_POST;
        $this->load->model('vms/Cron_model','ModelCron');
        $dataCron=array(
          'teks'  => $postdata['teks']
        );
        $insertCron = $this->ModelCron->db->insert('cron_test',$dataCron);
        if(empty($insertCron)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal','elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses','elapsed_time'=> $this->benchmark->elapsed_time()),200);
        }
    }

    //get new data email register
    function get_email_new_get()
    {
      $this->load->model('vms/Cron_model','ModelCron');
      $sekarang = time() + 1;
      $result = $this->ModelCron->db->limit(5)->order_by('email_priority', 'ASC')->get_where('email_new',array('email_send_time <'=> $sekarang));
      if($result->num_rows() == 0){
        $this->response( array('status'=>FALSE,
        'data'=>'','elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_NOT_FOUND);
      }else{
        $this->response(array('status'=>TRUE,'data'=>$result->result_array(),'elapsed_time'=> $this->benchmark->elapsed_time()),200);
      }
      $this->response($result->result_array(), 200);
    }

    //send email after get email (from cron job)
    function send_email_new_post()
    {
      $postdata = $_POST;
      $this->load->model('vms/Cron_model','ModelCron');
      //check id
      $checkIdEmail = $this->ModelCron->db->get_where('email_new',array('id'=>$postdata['id']));
      if($checkIdEmail->num_rows() == 0){
        $this->response( array('status'=>FALSE,
        'data'=>'','elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_NOT_FOUND);
      }else{
        //kirim ke email send
        $dataInsertNewEmail = array(
          'id'                =>$postdata['id'],
          'sender_preference' =>$checkIdEmail->result_array()[0]['sender_preference'],
          'email_to'          =>$checkIdEmail->result_array()[0]['email_to'],
          'email_subject'     =>$checkIdEmail->result_array()[0]['email_subject'],
          'email_message'     =>$checkIdEmail->result_array()[0]['email_message'],
          'email_alt_message' =>$checkIdEmail->result_array()[0]['email_alt_message'],
          'email_cc'          =>$checkIdEmail->result_array()[0]['email_cc'],
          'email_bcc'         =>$checkIdEmail->result_array()[0]['email_bcc'],
          'email_priority'    =>$checkIdEmail->result_array()[0]['email_priority'],
          'result_sender'     =>$postdata['result_sender'],
          'email_type'        =>$checkIdEmail->result_array()[0]['email_type'],
          'email_send_time'   =>$checkIdEmail->result_array()[0]['email_send_time'],
          'result_sent_time'  =>$postdata['result_sent_time']
        );
        // print_r($dataInsertNewEmail);die();
        $insertEmailSend = $this->ModelCron->db->insert('email_sent',$dataInsertNewEmail);
        if(empty($insertEmailSend)){
          $this->response(array('status'=>FALSE,
          'message'=>'Gagal','elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          //hapus field
          $deleteEmailNew = $this->ModelCron->db->delete('email_new',array('id'=>$postdata['id']));
          if(empty($deleteEmailNew)){
            $this->response( array('status'=>FALSE,
            'data'=>'','elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_NOT_FOUND);
          }else{
            $this->response(array('status'=>TRUE,'message'=>'Sukses','elapsed_time'=> $this->benchmark->elapsed_time()),200);
          }
        }
      }


    }
    
	
	
  

    
}
