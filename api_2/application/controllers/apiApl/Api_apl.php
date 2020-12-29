<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api_apl extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function postDataApl_post(){
      $postdata = ($_POST);
      // $this->load->model('ApiApl/ApiApl_model');
      $this->load->model('ApiApl/ApiApl_model','AplModel');
      if (isset($postdata)) {
        $result= $this->AplModel->GetDataAll();
      } else {
        $result= $this->AplModel->GetDataAll();
      }
      $this->response($result, 200);
    }
    function getDataApl_get(){
      $id = $this->uri->segment(4);
      // print_r($token);die();
      $this->load->model('ApiApl/ApiApl_model','AplModel');
      if (isset($id)) {
        $result['data']= $this->AplModel->GetDataAll();
      } else {
        $result['data']= $this->AplModel->GetDataAll();
      }
      $this->response($result, 200);
    }
}
