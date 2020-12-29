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
      $this->load->model('users_model');
      if (isset($postdata)) {
        // echo "stsdsadring";die();
        $result= $this->users_model->getData($postdata);
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
      $this->load->model('users_model');
      if ($id == '') {
              $result= $this->users_model->get_all();
      } else {
        // echo "test";die();
              // $where['nip'] = $id;
              // $result= $this->users_model->getData($where);
              $result= $this->users_model->get(array('nip'=>$id));
      }
      // echo $result;die();
      $this->response($result, 200);
    }
    

    function index_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());

        if($this->form_validation->run('users_post') != false){
            $this->load->model('users_model');
            $data = $this->post();
            // print_r($data['akses_iku']."-------OK");die();
            $safe_data = $this->users_model->get(array('nip'=>$this->post('nama_pegawai')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure',
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->users_model->update("akses_iku = '1',last_login = ''",array('nip'=>$this->post('nama_pegawai')));
            if (!$data_id){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                // $kirim = array(
                //     "tables" => "INV_MST_ENTITY",
                //     "attr" => "",
                //     "idVal" => $this->post('INV_ENTITY_ID'),
                //     "id" => "INV_ENTITY_ID",
                // );
                // $this->load->model('updatedDateAllTable_model');
                // $this->updatedDateAllTable_model->saveData($kirim);
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
            $this->load->model('users_model');
            $data = $this->post();
            // print_r($data['akses_iku']."-------OK");die();
            $safe_data = $this->users_model->get(array('nip'=>$this->post('nama_pegawai')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure',
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            $data_id = $this->users_model->update("akses_iku = '0',last_login = ''",array('nip'=>$this->post('nip')));
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

    function index_delete() {

    }





}
