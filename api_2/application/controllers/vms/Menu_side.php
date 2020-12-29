<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Created on Fri Aug 07 2020 9:20:29 AM
 *
 * Filename Menu_side.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Menu_side extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_post()
    {

    }

    function get_nestable_post()
    {
      $this->load->model('vms/SideMenu_model','ModelMenuSide');
      $resultData= $this->ModelMenuSide->getDataNestable();
      if (!empty($resultData) ){
        $i = 0; // $i = urutan
        $nestableArr = [];
        foreach ( $resultData as $resultData ){
          $resultDatas[$i]['parent'] = $resultData->parent_id;
          $resultDatas[$i]['label'] = $resultData->nama_modul;
          $resultDatas[$i]['link'] = $resultData->param_link;
          $resultDatas[$i]['id'] = $resultData->id;
          $resultDatas[$i]['child'] = $this->childMenu($resultData->id);
          array_push($nestableArr,$resultDatas[$i]);
          $i++;
        }
        $result = array(
          'status' => true,
          'message' => null,
          'nestable' => $nestableArr,
          'elapsed_time' => $this->benchmark->elapsed_time(),
        );
      }else{
        // create result
    		$result = array(
          'status' => false,
          'message' => 'Tidak ditemukan data dengan kriteria yang diminta.'
        );
      }
      // $result=array(
      //   'data' => $resultData,
      //   'elapsed_time'=>$this->benchmark->elapsed_time()
      // );

      
      $this->response($result,200);
    }
    function childMenu($id)
    {
      $this->load->model('vms/SideMenu_model','ModelMenuSide');
      $resultData= $this->ModelMenuSide->child_data($id);
      // if (!empty($resultData) ){
        $i=0;
        $nestableArr = [];
        foreach($resultData as $resultData){
          // print_r($resultData);die();
            $resultDatas[$i]['parent'] = $resultData->parent_id;
            $resultDatas[$i]['label'] = $resultData->nama_modul;
            $resultDatas[$i]['link'] = $resultData->param_link;
            $resultDatas[$i]['id'] = $resultData->id;
            $resultDatas[$i]['child'] = $this->childMenu($resultData->id);
            array_push($nestableArr,$resultDatas[$i]);
            $i++;
        }
        return $nestableArr;  
      // } 
    }
    function get_nestable2_post()
    {
      $this->load->model('vms/SideMenu_model','ModelMenuSide');
      $resultData= $this->ModelMenuSide->getDataNestable();
      if (!empty($resultData) ){
        $i = 1; // $i = urutan
        $nestableArr = [];
        foreach ( $resultData as $resultData ){
          $thisRef = &$ref[$data->id];
          $thisRef['parent'] = $data->parent;
          $thisRef['label'] = $data->label;
          $thisRef['link'] = $data->link;
          $thisRef['id'] = $data->id;

        if($data->parent == 0) {
              $items[$data->id] = &$thisRef;
        } else {
              $ref[$data->parent]['child'][$data->id] = &$thisRef;
        }
          $i++;
        }
        $result = array(
          'status' => true,
          'message' => null,
          'nestable' => $nestableArr,
          'elapsed_time' => $this->benchmark->elapsed_time(),
        );
      }else{
        // create result
    		$result = array(
          'status' => false,
          'message' => 'Tidak ditemukan data dengan kriteria yang diminta.'
        );
      }
      // $result=array(
      //   'data' => $resultData,
      //   'elapsed_time'=>$this->benchmark->elapsed_time()
      // );

      
      $this->response($result,200);
    }

}
