<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Created on Sat Jun 13 2020 12:12:14 PM
 *
 * Filename Auth.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    //untuk check login
    function userLogin_post()
    {
      $postdata=$_POST;
      $this->load->model('vms/Auth_model','ModelAuth');
      $dataUser = $this->ModelAuth->db->get_where('accounts',array('email'=>$postdata['email'],'status_delete'=>0));
      if($dataUser->num_rows() == 0){
        $this->response( array('status'=>FALSE,
        'data'=>'','message'=>"<strong class='text-warning'>Akun belum terdaftar</strong>",'elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_NOT_FOUND);
      }else{
        // print_r($dataUser->result_array()[0]['pwd']);die();
        $decrypt_pass = $this->mx_encryption->decrypt($dataUser->result_array()[0]['pwd']);
        $status = $dataUser->result_array()[0]['status'];
        $message = '';
        if($status == 0){
          $message = 'User dan/atau password salah.';
        }elseif($status == 1)
        { 
          // $message = 'User dan/atau password salah.';
          $message = "Login Berhasil <br> Welcome ,<strong class='text-success'>".$postdata['email']."</strong>";
        }elseif($status == 2)
        {
          $message = 'User dan/atau password salah.';
          // $message = "Akun <strong class='text-primary'>Sudpend</strong> <br> Silakan hubungi <strong><a href='mailto:procurement.lman@kemenkeu.go.id' class='text-info'>Admin VMS LMAN</a></strong> untuk konfirmasi";
        }else{
          $message = 'User dan/atau password salah.';
          // $message ='<strong class='text-warning'>Akun belum terdaftar</strong>';
        }
        if($postdata['password'] == $decrypt_pass)
        {
          if($status == 1){
            //check data profile perusahaan
            $checkProfile = $this->ModelAuth->db->select('id_account')->get_where('perusahaan',array('id_account'=>$dataUser->result_array()[0]['id']));
            // print_r($checkProfile->num_rows());die();
            if($checkProfile->num_rows() == 0){
              $message = false;
            }else{
              $message = true;
            }
            $this->response( array('status'=>TRUE,
            'data'=>$dataUser->result_array(),'message'=>$message,'elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_OK);
          }else{
            $this->response( array('status'=>FALSE,
          'data'=>'','message'=>$message,'elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_BAD_REQUEST);
          }
        }else{
          $this->response( array('status'=>FALSE,
          'data'=>'','message'=>'User dan/atau password salah.','elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_BAD_REQUEST);
        }
        
      }

    }

    function getDataUser_post()
    {
      $postdata=$_POST;
      $this->load->model('vms/Auth_model','ModelAuth');
      $dataUser = $this->ModelAuth->db->select('pwd')->get_where('accounts',array('id'=>$this->mx_encryption->decrypt($postdata['token_id']),'status_delete'=>0));
      if($dataUser->num_rows() == 0){
        $this->response(array('status'=>FALSE,
        'data'=>'','message'=>"<strong class='text-warning'>Akun belum terdaftar</strong>",'elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_NOT_FOUND);
      }else{
        if($postdata['password_lama'] == $this->mx_encryption->decrypt($dataUser->result_array()[0]['pwd']))
        {
          $insertData = $this->ModelAuth->db->update('accounts',array('pwd'=>$this->mx_encryption->encrypt($postdata['password_baru']),'date_update'=>date("Y-m-d H:i:s")),array('id'=>$this->mx_encryption->decrypt($postdata['token_id'])));
          if (empty($insertData)){
            $this->response( array('status'=>FALSE,'data'=>'',
            'message'=>'Gagal Update','elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          }else{
              $this->response(array('status'=>TRUE,'data'=>'','message'=>"<strong class='text-success'>Sukses Update</strong>",'elapsed_time'=> $this->benchmark->elapsed_time()),200);
          }
          // $this->response( array('status'=>TRUE,
          //     'data'=>$dataUser->result_array(),'message'=>'','elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_OK);
        }else{
          $this->response(array('status'=>FALSE,
          'data'=>'','message'=>"<strong class='text-warning'>Pasword salah</strong>",'elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_BAD_REQUEST);
        }
      }
    }


}
