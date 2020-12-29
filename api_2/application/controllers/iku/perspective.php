<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Perspective extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }


    function search_post() {
      $postdata = ($_POST);
      // print_r($postdata['nip']);die();
      $this->load->model('Perspective_model');
      if (isset($postdata)) {
        // echo "stsdsadring";die();
        $result= $this->Perspective_model->getData($postdata);
      } else {
        // echo "..,,,,,,";die();
        $result= $this->Perspective_model->get_all();
      }
      $this->response($result, 200);
    }

    function index_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(3);
      // die($id2);
      $this->load->model('Perspective_model');
      if ($id == '') {
              $result= $this->Perspective_model->get_all();
      } else {
        // echo "test";die();
              // $where['nip'] = $id;
              // $result= $this->Perspective_model->getData($where);
              $result= $this->Perspective_model->get(array('id_per'=>$id));
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

        if($this->form_validation->run('perspective_post') != false){
            $this->load->model('Perspective_model');
            $data = $this->post();
            // print_r($this->post('nm_pers'));die();
            // print_r($data);die();
            // $safe_data = $this->Perspective_model->get(array('id_per'=>"11"));
            $safe_data = $this->Perspective_model->get(array('nm_pers'=>$this->post('nm_pers'),'tahun'=>$this->post('tahun')));
            if(!empty($safe_data)){
              // echo "string";die();
                $this->response( array('status'=>'failure',
                'message'=>'data already exists',REST_Controller::HTTP_CONFLICT));
                // $this->response( array('status'=>'failure',
                // 'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }
            // else{
            //   echo "string2";die();
            // }

            $data_id = $this->Perspective_model->insert($data);
            if (!$data_id){
              // echo "string";die();
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
              // echo "string";die();


                $this->response(array('status'=>'success','message'=>'Insert Data Sukses'));
            }
        } else {
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function save_edit_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());

        if($this->form_validation->run('perspective_post') != false){
            $this->load->model('Perspective_model');
            $data = $this->post();
            // print_r($data['akses_iku']."-------OK");die();
            $safe_data = $this->Perspective_model->get(array('id_per'=>$this->post('id_per')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure',
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->Perspective_model->update($data,array('id_per'=>$this->post('id_per')));
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
        $this->load->model('Perspective_model');
        $data = $this->Perspective_model->get(array('id_per'=>$this->delete('id_per')));
        if (isset($data)){
            $deleted = $this->Perspective_model->force_delete(array('id_per'=>$this->delete('id_per')));
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
