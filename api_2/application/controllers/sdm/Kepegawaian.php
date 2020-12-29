<?php
/**
    Created date : 24 Juli 2019
    Email        : sugeng.riyadi@kemenkeu.go.id
    Created by Sugeng Riyadi
    Controller Untuk Control Kepegawaian
 **/
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kepegawaian extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }
    
    function data_divisi_get(){
        $this->load->model('sdm/Kepegawaian_model','ModelKepegawaian');
        $result= $this->ModelKepegawaian->getDataDivisi();
        $this->response($result, 200);
    }
}
