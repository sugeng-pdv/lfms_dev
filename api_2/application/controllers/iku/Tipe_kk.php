<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Tipe_kk extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(3);
      // die($id2);
      $this->load->model('Tipe_kk_model');
      if ($id == '') {
              $result= $this->Tipe_kk_model->get_all();
      } else {
              $result= $this->Tipe_kk_model->get(array('id_tipe_kk'=>$id));
      }
      $this->response($result, 200);
    }

}
