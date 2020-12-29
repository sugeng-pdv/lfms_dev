<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Mlebu extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        // print_r($config);die();
    }

    function cekMlebu_post()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        $this->load->model('mlebu/Mlebu_model','ModelMlebu');
        $data = $this->post();
        // print_r($data);die();
        $check_username = $this->ModelMlebu->cekMlebu($data);
        // print_r($check_username[0]['password']);die();
        if (!$check_username){
            $this->response( array('status'=>FALSE,'notif'=>'Gagal - NIP/NPP / Password Salah...!'));
            // 'notif'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            $this->response(array('status'=>TRUE,'notif'=>'Sukses','id'=>$check_username[0]['id'],'sandhi'=>$check_username[0]['sandhi'],'username'=>$check_username[0]['nip_npp'],'uyah'=>$check_username[0]['uyah'],'mgrupuser'=>$check_username[0]['mgrupuser'],'mgrupapk'=>$check_username[0]['mgrupapk']));
            // $this->response(array('status'=>TRUE,'notif'=>'Login Sukses','info'=>$check_username[0]['password'],'username'=>$check_username[0]['nip'],'nama'=>$check_username[0]['nama'],'instansi'=>$check_username[0]['instansi'],'email'=>$check_username[0]['email'],'no_hp'=>$check_username[0]['no_hp'],'akses'=>$check_username[0]['akses']));
        }
    }

}