<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Authority extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function authority_data_post() {
        
        $postdata = ($_POST);
        $this->load->model('Authority_model');
        $result= $this->Authority_model->getData();
        if(!empty($result)){
            $dataArr = array();
            $num = 1;
            foreach ( $result as $data ){
                $array_detail['no'] = $num;
                $array_detail['id'] = $data->id;
                $array_detail['role_id'] = $data->role_id;
                $array_detail['menu_id'] = $data->menu_id;
                $array_detail['role'] = $data->role_name;
                $array_detail['menu'] = $data->menu_name;
                $array_detail['authority'] = $data->authority;
                $array_detail['action'] = '<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details" onclick="edit_authority('."'$data->id'".')"><i class="la la-edit"></i></a><a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" onclick="delete_authority('."'$data->id'".')"><i class="la la-trash"></i></a>';
                $num++;
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
    }
    
    function menu_data_post() {
        $postdata = ($_POST);
        $this->load->model('Menu_model');
        $result= $this->Menu_model->getData();
        $menuArr = array();
        if(!empty($result)){
            foreach ( $result as $menu ){
                $menu_detail['id'] = $menu->id;
                $menu_detail['name'] = $menu->name;
                array_push($menuArr,$menu_detail);
            }
            $this->response(array(
                'status'=>'success',
                'message'=>'',
                'elapsed_time' => $this->benchmark->elapsed_time(),
    			'data' => $menuArr
            ));
        }else{
            $this->response( array('status'=>'failure',
                'message'=>'Data Kosong'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    function role_data_post() {
        $postdata = ($_POST);
        $this->load->model('Role_model');
        $result= $this->Role_model->getData();
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
    }
    
    
    
    function authority_save_post(){
        $postdata = ($_POST);
        $data = array(
                'role_id'    => $postdata['role'],
                'menu_id'      => $postdata['menu'],
                'authority'      => $postdata['authority'],
            );
            //   'status'    =>'ACTIVE'
        $this->load->model('Authority_model');
        if($postdata['status'] == 'add'){
            $data_id = $this->Authority_model->insert($data);
        }else{
            $data_id = $this->Authority_model->update($data,array('id'=>$this->post('id')));
        }
        if (!$data_id){
            $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            $this->response(array('status'=>'success','message'=>'Berhasil Simpan'));
        }
        
    }
    
    function authority_delete_post(){
        $this->load->model('Authority_model');
        $data_id = $this->Authority_model->update(array('status' => 'INACTIVE'),array('id'=>$this->post('id')));
            if (!$data_id){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                $this->response(array('status'=>'success','message'=>'Berhasil Dihapus'));
            }
    }





}
