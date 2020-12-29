<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class List_perspective extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(3);
      // print_r($id)."fffyghbhj";die();
      // $id ="1";
      $this->load->model('List_perspective_model');
      if ($id == '') {
              $result= $this->List_perspective_model->get_all();
      } else {

              $result= $this->List_perspective_model->get(array('id_per'=>$id));
      }
      // echo $result;die();
      $this->response($result, 200);
    }

    function search_post() {
        $postdata = ($_POST);
        // print_r($postdata);die;
        $this->load->model('List_perspective_model');
        if (isset($postdata)) {
            $result= $this->List_perspective_model->getData($postdata);
        } else {
            $result= $this->List_perspective_model->get_all();
        }
        $this->response($result, 200);
    }


}
