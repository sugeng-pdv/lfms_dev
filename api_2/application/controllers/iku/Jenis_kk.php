<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Jenis_kk extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(3);
      die("dsfdsfdfdf".$id);
      $this->load->model('Jenis_kk_model');
      if ($id == '') {
              $result= $this->Jenis_kk_model->get_all();
      } else {
              $result= $this->Jenis_kk_model->get(array('id_jenis_kk'=>$id));
      }
      $this->response($result, 200);
    }

}
