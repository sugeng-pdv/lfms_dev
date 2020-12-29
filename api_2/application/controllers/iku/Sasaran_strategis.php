<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Sasaran_strategis extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }


    function search_post() {
      $postdata = ($_POST);
      // print_r($postdata['nip']);die();
      $this->load->model('Sasaran_strategis_model');
      if (isset($postdata)) {
        // echo "stsdsadring";die();
        $result= $this->Sasaran_strategis_model->getData($postdata);
      } else {
        // echo "..,,,,,,";die();
        $result= $this->Sasaran_strategis_model->get_all();
      }
      $this->response($result, 200);
    }

    function index_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(3);
      // die($id2);
      $this->load->model('Sasaran_strategis_model');
      if ($id == '') {
              $result= $this->Sasaran_strategis_model->get_all();
      } else {
        // echo "test";die();
              // $where['nip'] = $id;
              // $result= $this->Sasaran_strategis_model->getData($where);
              $result= $this->Sasaran_strategis_model->get(array('id_ss'=>$id));
      }
      // echo $result;die();
      $this->response($result, 200);
    }
    function index_put() {

    }

    function index_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());

        if($this->form_validation->run('ss_post') != false){
            $this->load->model('Sasaran_strategis_model');
            $data = $this->post();
            // print_r($this->post('nm_pers'));die();
            // print_r($data);die();
            // $safe_data = $this->Sasaran_strategis_model->get(array('id_ss'=>"11"));
            $safe_data = $this->Sasaran_strategis_model->get(array('nm_ss'=>$this->post('nm_ss'),'tahun'=>$this->post('tahun')));
            if(!empty($safe_data)){
              // echo "string";die();
                $this->response( array('status'=>'failure',
                'message'=>'data already exists',REST_Controller::HTTP_CONFLICT));
                // $this->response( array('status'=>'failure',
                // 'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }
            // else{
            //   echo "OK";die();
            // }

            $data_id = $this->Sasaran_strategis_model->insert($data);
            if (!$data_id){
              // echo "string";die();
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
              // echo "OK ";die();
                $this->response(array('status'=>'success','message'=>'Insert Data Sukses'));
            }
        } else {
          // echo "string";die();
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function save_edit_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());

        if($this->form_validation->run('ss_post') != false){
            $this->load->model('Sasaran_strategis_model');
            $data = $this->post();
            // print_r($data['akses_iku']."-------OK");die();
            $safe_data = $this->Sasaran_strategis_model->get(array('id_ss'=>$this->post('id_ss')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure',
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->Sasaran_strategis_model->update($data,array('id_ss'=>$this->post('id_ss')));
            if (!$data_id){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                $this->response(array('status'=>'success','message'=>'Sukses updated'));
            }
        } else {
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_delete() {
        $id = $this->uri->segment(2);
        $this->load->model('Sasaran_strategis_model');
        $data = $this->Sasaran_strategis_model->get(array('id_ss'=>$this->delete('id_ss')));
        if (isset($data)){
            $deleted = $this->Sasaran_strategis_model->force_delete(array('id_ss'=>$this->delete('id_ss')));
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

    function delete_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());

        if($this->form_validation->run('usersdelete_post') != false){
            $this->load->model('Sasaran_strategis_model');
            $data = $this->post();
            // print_r($data['akses_iku']."-------OK");die();
            $safe_data = $this->Sasaran_strategis_model->get(array('nip'=>$this->post('nama_pegawai')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure',
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->Sasaran_strategis_model->update("akses_iku = '0',last_login = ''",array('nip'=>$this->post('nip')));
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



}
