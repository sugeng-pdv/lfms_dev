<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Monitoring extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    
    function getDataSpd_post()
    {
      $this->load->model('monitoring/Monitoring_model','monitoringModel');
      $result = $this->monitoringModel->getDataPegawaiSpd();
      $this->response($result,200);
    }
    
}
