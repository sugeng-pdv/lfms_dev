<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class List_jabatan extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
      // echo "string";die();
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(3);
      // die($id2);
      // $id=1;
      // print_r($id);die();
      $this->load->model('List_jabatan_model');
      if ($id == '') {
              $result= $this->List_jabatan_model->getdata($id);
      } else {

              $result= $this->List_jabatan_model->get(array('id_det'=>$id));
      }
      // echo $result;die();
      $this->response($result, 200);
    }

    function ListJabatan_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(3);
      die($id2);
      // $id=1;
      // print_r($id);die();
      $this->load->model('List_jabatan_model');
      if ($id == '') {
              $result= $this->List_jabatan_model->getdata($id);
      } else {

              $result= $this->List_jabatan_model->get(array('id_det'=>$id));
      }
      // echo $result;die();
      $this->response($result, 200);
    }


}
