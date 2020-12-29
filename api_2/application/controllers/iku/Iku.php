<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Iku extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }


    function search_post() {
      $postdata = ($_POST);
      // print_r($postdata['nip']);die();
      $this->load->model('Iku_model');
      if (isset($postdata)) {
        // echo "stsdsadring";die();
        $result= $this->Iku_model->getData($postdata);
      } else {
        // echo "..,,,,,,";die();
        $result= $this->Iku_model->get_all();
      }
      $this->response($result, 200);
    }

    function data_search_post() {
      $postdata = ($_POST);
      // print_r($postdata['nip']);die();
      $this->load->model('Iku_model');
      if (isset($postdata)) {
        // echo "stsdsadring";die();
        $result= $this->Iku_model->getDataIku($postdata);
      } else {
        // echo "..,,,,,,";die();
        $result= $this->Iku_model->get_all();
      }
      $this->response($result, 200);
    }
    function data_chart_post() {
      $postdata = ($_POST);
      // print_r($postdata['nip']);die();
      $this->load->model('Iku_model');
      if (isset($postdata)) {
        // echo "stsdsadring";die();
        $result= $this->Iku_model->getDataChart($postdata);
      } else {
        // echo "..,,,,,,";die();
        $result= $this->Iku_model->get_all();
      }
      $this->response($result, 200);
    }

    function index_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(3);
      // die($id2);
      $this->load->model('Iku_model');
      if ($id == '') {
              $result= $this->Iku_model->get_all();
      } else {
        // echo "test";die();
              // $where['nip'] = $id;
              // $result= $this->Iku_model->getData($where);
              $result= $this->Iku_model->get(array('id_iku'=>$id));
      }
      // echo $result;die();
      $this->response($result, 200);
    }

    function getiku_get(){
      $id = $this->uri->segment(3);
      $id2 = $this->uri->segment(4);
      // die($id."tessssssssssssss");
      $this->load->model('Iku_model');
      if (empty($id)){
        // echo "testdsdfs";die();
              $result= $this->Iku_model->get_all();
      } else {
        // echo "test";die();
              // $where['nip'] = $id;
              // $result= $this->Iku_model->getData($where);
              // $result= $this->Iku_model->get(array('id_iku'=>$id));
              $result= $this->Iku_model->getIku($id);
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

        if($this->form_validation->run('iku_post') != false){
            $this->load->model('Iku_model');
            $data = $this->post();
            // print_r($this->post('nm_pers'));die();
            // print_r($data);die();
            // $safe_data = $this->Iku_model->get(array('id_iku'=>"11"));
            $safe_data = $this->Iku_model->get(array('nm_iku'=>$this->post('nm_iku'),'tahun_iku'=>$this->post('tahun_iku'),'jabatan_iku'=>$this->post('jabatan_iku')));
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

            $data_id = $this->Iku_model->insert($data);
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

        if($this->form_validation->run('iku_post') != false){
            $this->load->model('Iku_model');
            $data = $this->post();
            // print_r($this->post('id_iku')."-------OK");die();
            $safe_data = $this->Iku_model->get(array('id_iku'=>$this->post('id_iku')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure',
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->Iku_model->update($data,array('id_iku'=>$this->post('id_iku')));
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
    // Edit data realisasi
    function save_edit_iku_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        // print_r($this->post('id_iku_realisasi'));echo "string";die();
        if($this->form_validation->run('iku_realisasi_post') != false){
            $this->load->model('Iku_realisasi_model');
            $data = $this->post();
            // print_r($this->post('id_iku_realisasi')."-------OK");die();
            $safe_data = $this->Iku_realisasi_model->get(array('id_iku_realisasi'=>$this->post('id_iku_realisasi')));
            if(!empty($safe_data)){
              // echo "string";die();
                // $this->response( array('status'=>'failure',
                // 'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
                $data_id = $this->Iku_realisasi_model->update($data,array('id_iku_realisasi'=>$this->post('id_iku_realisasi')));
                if (empty($data_id)){
                    $this->response( array('status'=>'failure',
                    'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $this->response(array('status'=>'success','message'=>'Sukses updated Data'));
                }
            }else{
              // echo "string2";die();
              $data_id = $this->Iku_realisasi_model->insert($data);
                if (empty($data_id)){
                    $this->response( array('status'=>'failure',
                    'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $this->response(array('status'=>'success','message'=>'Sukses updated Insert'));
                }
              }
        } else {
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_delete() {
        $id = $this->uri->segment(2);
        $this->load->model('Iku_model');
        $data = $this->Iku_model->get(array('id_iku'=>$this->delete('id_iku')));
        if (isset($data)){
            $deleted = $this->Iku_model->force_delete(array('id_iku'=>$this->delete('id_iku')));
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
            $this->load->model('Iku_model');
            $data = $this->post();
            // print_r($data['akses_iku']."-------OK");die();
            $safe_data = $this->Iku_model->get(array('nip'=>$this->post('nama_pegawai')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure',
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->Iku_model->update("akses_iku = '0',last_login = ''",array('nip'=>$this->post('nip')));
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
