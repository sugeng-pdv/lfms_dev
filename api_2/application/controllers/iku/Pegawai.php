<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Pegawai extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }


    function index_get() {
        $id = $this->uri->segment(2);
        $id2 = $this->uri->segment(3);
        //die($id);
        $this->load->model('pegawai_model');
        if ($id == '') {
                $result= $this->pegawai_model->get_all();
        } else {
            if($id=='page' && $id2!==''){
                $total_posts = $this->pegawai_model->count_rows(); // retrieve the total number of posts
                $result = $this->pegawai_model->paginate(10,$total_posts);
            } else {
                if($id!=='' && $id2==''){
                    $result= $this->pegawai_model->get(array('INV_ROLE_ID'=>$id));
                }
            }
        }
        $this->response($result, 200);
    }

    function index_put() {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());

        if($this->form_validation->run('role_put') != false){
            $this->load->model('pegawai_model');
            $exist = $this->pegawai_model->get(array('INV_ROLE_NAME'=> $this->put('INV_ROLE_NAME')));
            if($exist){
                $this->response( array('status'=>'failure',
                'message'=>'the specified user already exists',REST_Controller::HTTP_CONFLICT));
                die;
            }
            $user = $this->put();
            $user_id = $this->pegawai_model->insert($user);
            if (!$user_id){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->response(array('status'=>'success','message'=>'Created'));
            }
        } else {
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());

        if($this->form_validation->run('role_post') != false){
            $this->load->model('pegawai_model');
            $data = $this->post();

            $safe_data = $this->pegawai_model->get(array('INV_ROLE_ID'=>$this->post('INV_ROLE_ID')));
            if(!isset($safe_data)){
                $this->response( array('status'=>'failure',
                'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
            }

            // print_r($data);die;
            $data_id = $this->pegawai_model->update( $data,array('INV_ROLE_ID'=>$this->post('INV_ROLE_ID')));
            if (!$data_id){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $kirim = array( "tables"=>"INV_MST_ROLE",
                                "attr"=>"",
                                "id"=>"INV_ROLE_ID",
                                "idVal"=>$this->post('INV_ROLE_ID'));
                $this->load->model('UpdatedDateAllTable_model');
                $this->UpdatedDateAllTable_model->saveData($kirim);
                $this->response(array('status'=>'success','message'=>'updated'));
            }
        } else {
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    function index_delete() {
        $id = $this->uri->segment(2);
        $this->load->model('pegawai_model');
        $data = $this->user_model->get_by(array('USERNAME'=>$id));
        if (isset($data['USERNAME'])){
            $data['ENABLED'] = '0';
            $deleted = $this->pegawai_model->update($id,$data);
            if (!$deleted){
                $this->response( array('status'=>'failure',
                'message'=>'an expected error trying to update '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->response(array('status'=>'success','message'=>'deleted'));
            }
        }
    }

    function search_post() {
        $postdata = ($_POST);
        // print_r($postdata);die;
        $this->load->model('pegawai_model');
        if (isset($postdata)) {
                $result= $this->pegawai_model->getData($postdata);
        } else {
            $result= $this->pegawai_model->get_all();
        }
        $this->response($result, 200);
    }

}
