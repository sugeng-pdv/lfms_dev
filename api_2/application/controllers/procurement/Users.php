<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Users extends REST_Controller {

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

    function searchPpk_post() {
      $postdata = ($_POST);
      // print_r('nip');die();
      // print_r($postdata['nip']);die();
      $this->load->model('procurement/users_model');
      if (isset($postdata)) {
        // echo "stsdsadring";die();
        $result= $this->users_model->getDataPpk($postdata);
      } else {
        // echo "..,,,,,,";die();
        $result= $this->users_model->get_all();
      }
      $this->response($result, 200);
    }

    function index_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(3);
      // die($id2);
      $this->load->model('procurement/users_model');
      if ($id == '') {
              $result= $this->users_model->get_all();
      } else {
        // echo "test";die();
              // $where['nip'] = $id;
              // $result= $this->users_model->getData($where);
              $result= $this->users_model->get(array('nip'=>$id2));
      }
      // echo $result;die();
      $this->response($result, 200);
    }

    function userPpk_get() {
      // $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(4);
      // die($id2);
      $this->load->model('procurement/userPbj_model');
      if ($id2 == '') {
              $result= $this->userPbj_model->get_all();
      } else {
              // $result= $this->userPbj_model->get(array('id'=>$id2));
              $result= $this->userPbj_model->getDataPpk($id2);
      }
      $this->response($result, 200);
    }


    function index_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());

        if($this->form_validation->run('users_post') != false){
            $this->load->model('procurement/users_model');
            $data = $this->post();
            $jab = $this->post('jab_pbj');
            // print_r($this->post('jab_pbj')."-------OK");die();
            $safe_data = $this->users_model->get(array('nip'=>$this->post('nama_pegawai')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure',
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->users_model->update(array('akses_procurement' =>'1','last_login' => '','jab_pbj' => $jab),array('nip'=>$this->post('nama_pegawai')));
            // $data_id = $this->users_model->update($data,array('nip'=>$this->post('nama_pegawai')));
            if (!$data_id){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->response(array('status'=>'success','message'=>'updated'));
            }
        } else {
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function userPpk_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());

        if($this->form_validation->run('usersPpk_post') != false){
            $this->load->model('procurement/userPbj_model');
            $data = $this->post();
            $nip = $this->post('nip');
            $ppk = $this->post('ppk');
            $jbt = $this->post('jabatan');
            // print_r($data);die();
            // $safe_data = $this->userPbj_model->get(array('nip'=>$this->post('nip'),'ppk'=>$this->post('ppk'),'jabatan'=>$this->post('jabatan')));
            $safe_data = $this->userPbj_model->getData($nip,$ppk,$jbt);
            if(!empty($safe_data)){
              // print_r($safe_data);die();
                $this->response( array('status'=>'failures',
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }
            // else{
              $data_id = $this->userPbj_model->insert($data);
              // $data_id = $this->users_model->update($data,array('nip'=>$this->post('nama_pegawai')));
              if (!$data_id){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
              } else {
                $this->response(array('status'=>'success','message'=>'updated'));
              }
            // }

        } else {
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    function userUpdatePpk_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());

        if($this->form_validation->run('usersEditPpk_post') != false){
          $data = $this->post();
          // print_r($data);die();
            $this->load->model('procurement/userPbj_model');
            $safe_data = $this->userPbj_model->get(array('id'=>$this->post('id')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure',
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->userPbj_model->update($data,array('id'=>$this->post('id')));
            if (empty($data_id)){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->response(array('status'=>'success','message'=>'updated'));
            }
        } else {
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    function delete_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());

        if($this->form_validation->run('usersdelete_post') != false){
            $this->load->model('procurement/users_model');
            $data = $this->post();
            // print_r($data['akses_procurement']."-------OK");die();
            $safe_data = $this->users_model->get(array('nip'=>$this->post('nama_pegawai')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure',
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->users_model->update("akses_procurement = '0',last_login = ''",array('nip'=>$this->post('nip')));
            if (!$data_id){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                $this->response(array('status'=>'success','message'=>'updated'));
            }
        } else {
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }


    function deletePpk_post() {
        $id = $this->uri->segment(2);
        $data = $this->post();
        // print_r($this->post('id'));die();
        $this->load->model('procurement/UserPbj_model');
        $data = $this->UserPbj_model->get(array('id'=>$this->post('id')));
        if (isset($data)){
            $deleted = $this->UserPbj_model->delete(array('id'=>$this->post('id')));
            if (!$deleted){
                $this->response( array('status'=>'failure',
                'message'=>'an expected error trying to delete '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->response(array('status'=>'success','message'=>'deleted'));
            }
        } else {
            $this->response( array('status'=>'failure',
            'message'=>'no data found ',REST_Controller::HTTP_CONFLICT));
        }
    }
    function index_delete() {
        $id = $this->uri->segment(2);
        $this->load->model('procurement/UserPbj_model');
        // $this->load->model('Iku_model');
        $data = $this->UserPbj_model->get(array('id'=>$this->delete('id')));
        if (isset($data)){
            $deleted = $this->UserPbj_model->force_delete(array('id'=>$this->delete('id')));
            if (!$deleted){
                $this->response( array('status'=>'failure',
                'message'=>'an expected error trying to delete '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->response(array('status'=>'success','message'=>'deleted success'));
            }
        } else {
            $this->response( array('status'=>'failure',
            'message'=>'no data found ',REST_Controller::HTTP_CONFLICT));
        }
    }





}
