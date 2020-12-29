<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Monitoring_Ruby extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }
    //Monitoring Ruby
    function getDataEvents_post()
    {
      $postdata = $_POST;
      $this->load->model('ruby/Ruby_model','ModelRuby');
      $result = $this->ModelRuby->getDataRubyEvents();

      $this->response($result,200);
    }

    function getDataDrivers_post()
    {
      $postdata = $_POST;
      $this->load->model('ruby/Ruby_model','ModelRuby');
      $result = $this->ModelRuby->getDataRubyDrivers();

      $this->response($result,200);
    }

    
    

}
