<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Vms extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }


    function search_post() {
      $postdata = ($_POST);
      // print_r($postdata['nip']);die();
      $this->load->model('procurement/users_model');
      if (isset($postdata)) {
        // echo "stsdsadring";die();
        $result= $this->users_model->getData($postdata);
      } else {
        // echo "..,,,,,,";die();
        $result= $this->users_model->get_all();
      }
      $this->response($result, 200);
    }
    function searchQ_post() {
      $postdata = ($_POST);
      $this->load->model('procurement/Vms_model');
      if (isset($postdata)) {
        $result= $this->Vms_model->getData($postdata);
      } else {
        $result= $this->Vms_model->getData($postdata);
      }
      $this->response($result, 200);
    }
    function getJbt_post(){
      $postdata = ($_POST);
      // print_r($postdata);die();
      $this->load->model('procurement/Vms_model');
      if(isset($postdata['jbt'])){
        $result = $this->Vms_model->getDataJbt($postdata);
      }else
      {
        $result = $this->Vms_model->getDataJbt($postdata);
      }
      $this->response($result,200);
    }
    function getAkses_get(){
      $id = $this->uri->segment(3);
      $this->load->model('Procurement/Vms_model','ModelVms');
      if($id == ''){
        $result = $this->ModelVms->getDataAkses();
      }else{
        $result = $this->ModelVms->getDataAkses();
      }
      $this->response($result,200);
    }
    function searchVms_post() {
      $postdata = ($_POST);
      // echo "stsdsadring";die();
      $this->load->model('procurement/Vms_model');
      if (isset($postdata)) {
        // die();
        $result= $this->Vms_model->getDataVms($postdata);
      } else {
        $result= $this->Vms_model->get(array('status_hapus'=>0));
      }
      $this->response($result, 200);
    }
    function searchVmsRating_post()
    {
      $postdata = ($_POST);
      $this->load->model('procurement/Vms_model');
      $result= $this->Vms_model->getDataVmsRating();

      $this->response($result, 200);
    }
    function searchVmsRatingAvg_post()
    {
      $postdata = ($_POST);
      $this->load->model('procurement/Vms_model');
      $result= $this->Vms_model->getDataVmsRatingAVg();

      $this->response($result, 200);
    }
    function index_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(3);
      // die($id2);
      $this->load->model('procurement/Vms_model');
      if ($id2 == '') {
              $result= $this->Vms_model->get_all(array('status_vendor'=>0,'status_hapus'=>0));
      } else {
        // echo "string";
              $result= $this->Vms_model->get_all(array('status_vendor'=>0,'status_hapus'=>0));
      } 
      $this->response($result, 200);
    }
    function vms_save_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        // print_r($_POST);die();
        if($this->form_validation->run('vms_post') != false){
            $this->load->model('procurement/Vms_model');
            $data = $this->post();
            $cekSimpan = $this->post('DetBtn');
            $dataSave = array(
              // 'id_vendor' =>  $this->post('id_vendor'),
              'id_no_vendor' =>  $this->post('id_no_vendor'),
              'kd_vendor' =>  $this->post('kd_vendor'),
              'nm_vendor' =>  $this->post('nm_vendor'),
              'tipe_vendor' =>  $this->post(''),
              'klasifikasi' =>  $this->post('klasifikasi'),
              'status_perusahaan' =>  $this->post('kualifikasi_perusahaan'),
              'npwp' =>  $this->post('npwp'),
              // 'berdiri_sejak' =>  $this->post(''),
              'alamat' =>  $this->post('alamat'),
              'kota' =>  $this->post('kota'),
              'no_tlp' =>  $this->post('no_tlp'),
              'no_fax' =>  $this->post('no_fax'),
              'no_hp' =>  $this->post('no_hp'),
              'email' =>  $this->post('email'),
              'nm_pic' =>  $this->post('nm_pic'),
              'jbt_pic' =>  $this->post('jbt_pic'),
              'no_hp_pic' =>  $this->post('NoHp_pic'),
              'no_rek' =>  $this->post('no_rek'),
              'nm_bank' =>  $this->post('nm_bank'),
              'cabang_bank' =>  $this->post('cabang_bank'),
              'created_by' =>  $this->post('created_by'),
              'date_created' =>  $this->post('date_created'),
              'status_vendor' =>  $this->post('status_vendor')
            );
            $dataUpdate = array(
              // 'id_vendor' =>  $this->post('id_vendor'),
              // 'id_no_vendor' =>  $this->post('id_no_vendor'),
              // 'kd_vendor' =>  $this->post('kd_vendor'),
              'nm_vendor' =>  $this->post('nm_vendor'),
              'tipe_vendor' =>  $this->post(''),
              'klasifikasi' =>  $this->post('klasifikasi'),
              'status_perusahaan' =>  $this->post('kualifikasi_perusahaan'),
              'npwp' =>  $this->post('npwp'),
              // 'berdiri_sejak' =>  $this->post(''),
              'alamat' =>  $this->post('alamat'),
              'kota' =>  $this->post('kota'),
              'no_tlp' =>  $this->post('no_tlp'),
              'no_fax' =>  $this->post('no_fax'),
              'no_hp' =>  $this->post('no_hp'),
              'email' =>  $this->post('email'),
              'nm_pic' =>  $this->post('nm_pic'),
              'jbt_pic' =>  $this->post('jbt_pic'),
              'no_hp_pic' =>  $this->post('NoHp_pic'),
              'no_rek' =>  $this->post('no_rek'),
              'nm_bank' =>  $this->post('nm_bank'),
              'cabang_bank' =>  $this->post('cabang_bank'),
              'update_by' =>  $this->post('created_by'),
              'date_update' =>  $this->post('date_created'),
              'status_vendor' =>  $this->post('status_vendor')
            );
            if ($cekSimpan == "Simpan") {
              $safe_data = $this->Vms_model->get(array('id_no_vendor'=>$this->post('id_no_vendor'),'kd_vendor'=>$this->post('kd_vendor'),'npwp'=>$this->post('npwp'),'nm_vendor'=>$this->post('nm_vendor')));
              $checkDataIdVendor = $this->Vms_model->get(array('id_no_vendor'=>$this->post('id_no_vendor')));
              $checkDataKdVendor = $this->Vms_model->get(array('kd_vendor'=>$this->post('kd_vendor')));
              $checkDataNpwp = $this->Vms_model->get(array('npwp'=>$this->post('npwp')));
              $checkDataNmVendor  = $this->Vms_model->get(array('nm_vendor'=>$this->post('nm_vendor')));
              // if(!$checkDataIdVendor){
              //   print "ADA";
              // }else{
              //   print "Tdak Ada";
              // }
              // print_r($checkDataIdVendor);die();
              if(!$checkDataIdVendor && !$checkDataKdVendor && !$checkDataNpwp && !$checkDataNmVendor){
                $data_id = $this->Vms_model->insert($dataSave);
                if (!$data_id){
                  $this->response( array('status'=>'failure',
                  'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                  $this->response(array('status'=>'success','message'=>'Data berhasil disimpan'));
                }
              }else{
                $ErrorMessage =array();
                if($checkDataIdVendor){
                  $ErrorMessage['0'] ="Data ID vendor sudah ada";
                }else{
                  $ErrorMessage['0'] = "Ok";
                }
                if($checkDataKdVendor){
                  $ErrorMessage['1'] ="Data Kode vendor sudah ada";
                }else{
                  $ErrorMessage['1'] = "Ok";
                }
                if($checkDataNpwp){
                  $ErrorMessage['2'] ="Data NPWP vendor sudah ada";
                }else{
                  $ErrorMessage['2'] = "Ok";
                }
                if($checkDataNmVendor){
                  $ErrorMessage['3'] ="Data Nama vendor sudah ada";
                }else{
                  $ErrorMessage['3'] = "Ok";
                }
                // print_r($ErrorMessage);die();
                $this->response( array('status'=>'failures',
                'message'=>$ErrorMessage,REST_Controller::HTTP_CONFLICT));
              }
            }else if ($cekSimpan == "Hapus") {
              $safe_data = $this->Vms_model->get(array('id_no_vendor'=>$this->post('id_no_vendor')));
              if(!empty($safe_data)){
                $this->response( array('status'=>'failures',
                'message'=>'Data ini tidak ada di database',REST_Controller::HTTP_CONFLICT));
              }else{
                $data_id = $this->Vms_model->update(array('status_hapus' => 1,'update_by' =>  $this->post('created_by'),'date_update' =>  $this->post('date_created'),),array('id_vendor'=>$this->post('id_vendor')));
                if (!$data_id){
                  $this->response( array('status'=>'failure',
                  'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                  $this->response(array('status'=>'success','message'=>'Data berhasil didelete'));
                }
              }
            }else if ($cekSimpan == "Rubah"){
              $safe_data = $this->Vms_model->get(array('id_no_vendor'=>$this->post('id_no_vendor')));
              if(!empty($safe_data)){
                $this->response( array('status'=>'failures',
                'message'=>'Data ini tidak ada di database',REST_Controller::HTTP_CONFLICT));
              }else{
                $data_id = $this->Vms_model->update($dataUpdate,array('id_vendor'=>$this->post('id_vendor')));
                if (!$data_id){
                  $this->response( array('status'=>'failure',
                  'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                  $this->response(array('status'=>'success','message'=>'Data berhasil diupdate'));
                }
              }
            }else{
              $this->response( array('status'=>'failures',
              'message'=>'Error Query',REST_Controller::HTTP_CONFLICT));
            }

        } else {
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    function vms_save_rating_post() {
      $id = $this->uri->segment(2);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      // print_r($_POST);die();
      // if($this->form_validation->run('vms_post') != false){
          $this->load->model('procurement/Vms_model');
          $data = $this->post();
          $this->db_pbj = $this->load->database('db_pbj',true);      
          $dataSave = array(
            'pengadaan' =>  $this->post('pengadaan'),
            'vendor' =>  $this->post('nmVendor'),
            'tahun' =>  $this->post('ThnPengadaan'),
            'date_created' =>  $this->post('date_created'),
            'created_by' =>  $this->post('created_by'),
          );
          $data_id = $this->Vms_model->db_pbj->insert('tbl_pengadaan',$dataSave);
          
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
            $this->response(array('status'=>'success','message'=>'Data berhasil disimpan'));
          }
      // } else {
      //     $this->response( array('status'=>'failure',
      //     'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
      // }
  }
    
    function q_save_post() {
      $id = $this->uri->segment(2);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put()); 
      $this->db_pbj = $this->load->database('db_pbj',true);

      if($this->form_validation->run('q_vms_post') != false){
          $this->load->model('procurement/Vms_model','ModelVms');
          $data = $this->post();
          $safe_data = $this->ModelVms->checkPertanyaan($data['nm_pertanyaan']);
          // print_r($safe_data);die();
          if(!empty($safe_data)){
              $this->response( array('status'=>'failure',
              'message'=>'data already exists',REST_Controller::HTTP_CONFLICT));
          }else
          {
            $data_id = $this->ModelVms->db_pbj->insert('mst_tanya_pbj',array('nm_pertanyaan'=>$data['nm_pertanyaan'],'id_jab_pbj'=>$data['id_akses'],'date_update'=>date('Y-m-d H:i:s'),'status'=>$data['status']));
            if (!$data_id){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->response(array('status'=>'success','message'=>'Insert Data Sukses'));
            }
          }

      } else {
          $this->response( array('status'=>'failure',
          'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
      }
    }
    function q_edit_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(4);
      $this->load->model('procurement/Vms_model','ModelVms');
      if ($id2 == '') {
        $this->response( array('status'=>'failure',
        'message'=>'data not exists',REST_Controller::HTTP_CONFLICT));
      } else {
              $result= $this->ModelVms->checkIdPertanyaan($id2);
      }
      $this->response($result, 200);
    }
    function q_save_edit_post() {
      $id = $this->uri->segment(2);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put()); 
      $this->db_pbj = $this->load->database('db_pbj',true);

      if($this->form_validation->run('q_vms_post') != false){
          $this->load->model('procurement/Vms_model','ModelVms');
          $data = $this->post();
          $safe_data = $this->ModelVms->checkIdPertanyaan($this->post('id_per'));
          if(!isset($safe_data)){
              $this->response( array('status'=>'failure',
              'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
          }else{
            $data_id = $this->ModelVms->db_pbj->update('mst_tanya_pbj',array('nm_pertanyaan'=>$data['nm_pertanyaan'],'id_jab_pbj'=>$data['id_akses'],'date_update'=>date('Y-m-d H:i:s'),'status'=>$data['status']),array('id_p'=>$this->post('id_per')));
            if (!$data_id){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else{
                $this->response(array('status'=>'success','message'=>'Sukses updated'));
            }
          }
      } else {
          $this->response( array('status'=>'failure',
          'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
      }
    }
    function pertanyaan_delete() {
      $this->load->model('procurement/Vms_model','ModelVms'); 
      $this->db_pbj = $this->load->database('db_pbj',true);
      $data = $this->ModelVms->checkIdPertanyaan($this->delete('id_per'));
      if (isset($data)){
          $deleted = $this->ModelVms->db_pbj->update('mst_tanya_pbj',array('date_update'=>date('Y-m-d H:i:s'),'status'=>'Tidak Aktif'),array('id_p'=>$this->delete('id_per')));
          if (!$deleted){
              $this->response( array('status'=>'failure',
              'message'=>'Hapus Data Gagal '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status'=>'success','message'=>'Hapus Data Berhasil'));
          }
      } else {
          $this->response( array('status'=>'failure',
          'message'=>'no data found ',REST_Controller::HTTP_CONFLICT));
      }
  }
  function getIdJbtPbj_get(){
    $id = $this->uri->segment(4);
    $this->load->model('procurement/Vms_model','ModelVms');
    if($id == ''){
      $this->response( array('status'=>'failure',
      'message'=>'data not exists',REST_Controller::HTTP_CONFLICT));
    }else{
      // print_r($id);die();
      $result= $this->ModelVms->getIdJbt($id);
    }
    $this->response($result,200);
  }
  function postQ_post(){
    $this->load->library('form_validation');
    $this->form_validation->set_data($this->put());
    // if($this->form_validation->run('q_vms_post') != false){
        $this->load->model('procurement/Vms_model','ModelVms');
        $postdata = ($_POST);
      // echo "stsdsadring";die();
      if (isset($postdata)) {
        // die();
        $result= $this->ModelVms->getDataQuestion($postdata);
      } else {
        $result= $this->ModelVms->getDataQuestion($postdata);
      }
      $this->response($result, 200);

    // } else {
        // $this->response( array('status'=>'failure',
        // 'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
    // }
  }
  function CheckQ_post(){
    $this->load->library('form_validation');
    $this->form_validation->set_data($this->put());
    $this->load->model('procurement/Vms_model','ModelVms');
    $postdata = ($_POST);
      if (isset($postdata)) {
        $result= $this->ModelVms->checkDataQuestion($postdata);
      } else {
        $result= $this->ModelVms->checkDataQuestion($postdata);
      }
    $this->response($result, 200);
  }
  //data add 27 juni 2019
  function updateRating_post(){
    $postdata=($_POST);
    $this->load->library('form_validation');
    $this->form_validation->set_data($this->put());
    $this->load->model('procurement/Vms_model','ModelVms');
    $this->db_pbj = $this->load->database('db_pbj',true);
    $dataUpdate = array(
                          'userid' => $postdata['sess_nip'],
                          'id_pengadaan' => $postdata['id'],
                          'id_vendor' => $postdata['vendor'],
                          'id_tanya' => $postdata['id_p']
                        );
                        
                        // 'rating' =>$postdata['nilai'],
                        // 'update_date' => date("Y-m-d H:i:s")
    $dataCek = $this->ModelVms->checkDataQuestion($postdata);
    if(!$dataCek){
      $dataInsert = $this->ModelVms->db_pbj->insert('posts_rating',array('userid'=>$postdata['sess_nip'],'id_pengadaan'=>$postdata['id'],'id_vendor'=>$postdata['vendor'],'id_tanya'=>$postdata['id_p'],'rating' =>$postdata['nilai'],'update_date'=>date('Y-m-d H:i:s')));
      if (!$dataInsert){
          $this->response( array('status'=>'failure',
          'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
          $this->response(array('status'=>'success','message'=>'Sukses Input Data'));
      }
    }else{
      $dataInsert = $this->ModelVms->db_pbj->update('posts_rating',array('rating' =>$postdata['nilai'],'update_date' =>date('Y-m-d H:i:s')),$dataUpdate);
      if (!$dataInsert){
          $this->response( array('status'=>'failure',
          'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
          $this->response(array('status'=>'success','message'=>'Sukses updated'));
      }
    }

  }
  function updateRatingVms_post(){
    $postdata=($_POST);
    $this->load->library('form_validation');
    $this->form_validation->set_data($this->put());
    $this->load->model('procurement/Vms_model','ModelVms');
    $this->db_pbj = $this->load->database('db_pbj',true);
    $dataUpdate = array(
                          'userid' => $postdata['sess_nip'],
                          'id_pengadaan' => $postdata['id'],
                          'id_vendor' => $postdata['vendor'],
                          'id_tanya' => $postdata['id_p']
                        );
                        
                        // 'rating' =>$postdata['nilai'],
                        // 'update_date' => date("Y-m-d H:i:s")
    $dataCek = $this->ModelVms->checkDataQuestion($postdata);
    if(!$dataCek){
      $dataInsert = $this->ModelVms->db_pbj->insert('vms_rating',array('userid'=>$postdata['sess_nip'],'id_pengadaan'=>$postdata['id'],'id_vendor'=>$postdata['vendor'],'id_tanya'=>$postdata['id_p'],'rating' =>$postdata['nilai'],'update_date'=>date('Y-m-d H:i:s')));
      if (!$dataInsert){
          $this->response( array('status'=>'failure',
          'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
          $this->response(array('status'=>'success','message'=>'Sukses Input Data'));
      }
    }else{
      $dataInsert = $this->ModelVms->db_pbj->update('vms_rating',array('rating' =>$postdata['nilai'],'update_date' =>date('Y-m-d H:i:s')),$dataUpdate);
      if (!$dataInsert){
          $this->response( array('status'=>'failure',
          'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
          $this->response(array('status'=>'success','message'=>'Sukses updated'));
      }
    }

  }
  




}
