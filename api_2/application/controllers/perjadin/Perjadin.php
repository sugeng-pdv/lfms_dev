<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Perjadin extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function searchst_post() {
      $postdata = ($_POST);
      $requestdata = $_REQUEST;
      // print_r($requestdata['search']['regex'] );die();
      // print_r($requestdata['length']);die();
      $this->load->model('Perjadin_model');
      // if (isset($postdata)) {
        $result= $this->Perjadin_model->fetch_data_st($requestdata['search']['value'],$requestdata['order'][0]['column'] , $requestdata['order'][0]['dir'], $requestdata['start'] ,$requestdata['length']);
        // print_r($result);die();
      // } else {
        // $result= $this->Perjadin_model->getDataSt($postdata);
      // }
      $this->response($result, 200);
    }
    function search_post() {
      $postdata = ($_POST);
      $requestdata = $_REQUEST;
      $this->load->model('Perjadin_model');
      if (isset($postdata)) {
        $result= $this->Perjadin_model->getDataSt($postdata);
      } else {
        $result= $this->Perjadin_model->getDataSt($postdata);
      }
      $this->response($result, 200);
    }
    function spd_search_post() {
      $postdata = ($_POST);
      $this->load->model('Perjadin_model');
      if (isset($postdata)) {
        $result= $this->Perjadin_model->getDataSpd($postdata);
      } else {
        $result= $this->Perjadin_model->getDataSpd($postdata);
      }
      // print($result);die();
      $this->response($result, 200);
    }
    function spdTgl_search_post() {
      $postdata = ($_POST);
      $this->load->model('Perjadin_model');
      if (isset($postdata)) {
        $result= $this->Perjadin_model->getDataSpdTgl($postdata);
      } else {
        $result= $this->Perjadin_model->getDataSpdTgl($postdata);
      }
      $this->response($result, 200);
    }
    //spd_ext_search
    function spd_ext_search_post() {
      $postdata = ($_POST);
      $this->load->model('Perjadin_model');
      if (isset($postdata)) {
        $result= $this->Perjadin_model->getDataSpdExt($postdata);
      } else {
        $result= $this->Perjadin_model->getDataSpdExt($postdata);
      }
      $this->response($result, 200);
    }
    function index_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(3);
      // die($id2);
      $this->load->model('Perjadin_model');
      if ($id == '') {
              $result= $this->Perjadin_model->get_all();
      } else {
              $result= $this->Perjadin_model->get(array('id_st'=>$id));
      }
      $this->response($result, 200);
    }
    function GetMargin_get() {
      $this->load->model('PerjadinMargin_model');
      $result= $this->PerjadinMargin_model->getmargin();
      $this->response($result, 200);
    }
    function PostMargin_post(){
      $postdata = $this->post();;
      // print($postdata['id']);die();
      $this->load->model('PerjadinMargin_model');
      if(!$postdata){
        $result= $this->PerjadinMargin_model->get_all();
      }else{
        $result= $this->PerjadinMargin_model->get(array('id_margin'=>$postdata['id']));
      }
      $this->response($result, 200);
    }
    function saveMargin_post(){
      // echo "string";die();
      $postdata = $this->post();
      // $this->load->library('form_validation');
      // $this->form_validation->set_data($this->put());
      $this->load->model('PerjadinMargin_model');
      $id=$postdata['id'];
      $data = array(
        'nm_margin' => $postdata['margin'],
        'update_by' => $postdata['update_by'],
        'date_update' => date("Y-m-d H:i:s")
      );
        $data_id = $this->PerjadinMargin_model->update($data,array('id_margin'=>$id));
        if (!$data_id){
          $this->response(array('status'=>'failure','message'=>'Gagal Update Margin'));
          // $this->response( array('status'=>'failure',
          // 'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>'success','message'=>'Sukses Update Margin'));
        }
    }
    function detailSt_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(4);
      // die($id2);
      $this->load->model('Perjadin_model');
      if ($id2 == '') {
              $result= $this->Perjadin_model->get_all();
      } else {
              $result= $this->Perjadin_model->getDetailSt($id2);
      }
      $this->response($result, 200);
    }

    function getDetailStCetakSpd_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(4);
      // die($id2);
      $this->load->model('Perjadin_model');
      if ($id2 == '') {
              $result= $this->Perjadin_model->get_all();
      } else {
              $result= $this->Perjadin_model->getDetailStCetakSpd($id2);
      }
      $this->response($result, 200);
    }
    //detailStExt
    function detailStExt_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(4);
      // die($id2);
      $this->load->model('Perjadin_model');
      if ($id2 == '') {
              $result= $this->Perjadin_model->get_all();
      } else {
              $result= $this->Perjadin_model->getDetailStExt($id2);
      }
      $this->response($result, 200);
    }
    function detailSpd_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(4);
      // die($id2);
      $this->load->model('Perjadin_model');
      if ($id2 == '') {
              $result= $this->Perjadin_model->get_all();
      } else {
              $result= $this->Perjadin_model->getDetailSpd($id2);
      }
      $this->response($result, 200);
    }
    function jumlahSpd_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(4);
      $this->load->model('Perjadin_model');
      if ($id2 == '') {
              $result= $this->Perjadin_model->get_all();
      } else {
        // die($id2);
              $result= $this->Perjadin_model->getJumlahSpd($id2);
      }
      $this->response($result, 200);
    }
    function detailSpdSt_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(4);
      // die($id2);
      $this->load->model('Perjadin_model');
      if ($id2 == '') {
              $result= $this->Perjadin_model->get_all();
      } else {
              $result= $this->Perjadin_model->getDetailSpdST($id2);
      }
      $this->response($result, 200);
    }
    function detailStNip_get() {
      $id = $this->uri->segment(2);
      $id2 = $this->uri->segment(4);
      $nip = $this->uri->segment(5);
      // die($id2);
      $this->load->model('Perjadin_model');
      if ($id2 == '') {
              $result= $this->Perjadin_model->get_all();
      } else {
              $result= $this->Perjadin_model->getDetailSpdSTNip($id2,$nip);
      }
      $this->response($result, 200);
    }
    function kota_tujuanSt_get() {
      $this->load->model('Perjadin_model');
      $result= $this->Perjadin_model->getKotaTujuanSt();
      $this->response($result, 200);
    }
    function jenis_st_get() {
      $this->load->model('Perjadin_model');
      $result= $this->Perjadin_model->getJenisSt();
      $this->response($result, 200);
    }
    function data_st_get(){
      $data['id_st'] = $this->uri->segment(4);
      $this->load->model('Perjadin_model');
      $result= $this->Perjadin_model->getDataStSpby($data);
      $this->response($result, 200);
    }
    function data_st_ok_get(){
      $data['id_st'] = $this->uri->segment(4);
      $this->load->model('Perjadin_model');
      $result= $this->Perjadin_model->getDataStLpd($data);
      $this->response($result, 200);
    }

    function edit_st_post() {
        $id = $this->uri->segment(2);
        $postdata = $this->post();
        $this->load->model('Perjadin_model');
        $id_no_st = $postdata['id'];
        // print_r($id_no_st);die();
        if ($id != '') {
                $result= $this->Perjadin_model->ST_Search($id_no_st);
        } else {
                $result= $this->Perjadin_model->ST_Search($id_no_st);
        }
        // echo $result;die();
        $this->response($result, 200);
    }
    //edit_stExt
    function edit_stExt_post() {
        $id = $this->uri->segment(2);
        $postdata = $this->post();
        $this->load->model('Perjadin_model');
        $id_no_st = $postdata['id'];
        // print_r($id_no_st);die();
        if ($id != '') {
                $result= $this->Perjadin_model->STExt_Search($id_no_st);
        } else {
                $result= $this->Perjadin_model->STExt_Search($id_no_st);
        }
        // echo $result;die();
        $this->response($result, 200);
    }
    function edit_st_pegawai_post() {
        $id = $this->uri->segment(2);
        $postdata = $this->post();
        $this->load->model('Perjadin_model');
        $id_st = $postdata['id'];
        // print_r($id_no_st);die();
        if ($id != '') {
                $result= $this->Perjadin_model->ST_pegawai_Serach($postdata);
        } else {
                $result= $this->Perjadin_model->ST_pegawai_Serach($postdata);
        }
        // echo $result;die();
        $this->response($result, 200);
    }

    function save_edit_st2_post() {
        $id = $this->uri->segment(2);
        $postdata = $this->post();
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        $this->load->model('Perjadin_model');
        // $no_st =$postdata['no_st'];
        $id_no_st =$postdata['id_no_st'];
        $tgl_st = $postdata['tgl_st'];
    		$no_nd = $postdata['no_nd'];
    		$tgl_nd = $postdata['tgl_nd'];
    		$tgl_nd_terima = $postdata['tgl_nd_terima'];
    		$jenis_st = $postdata['jenis_st'];
    		$perihal = $postdata['perihal'];
    		$kota_berangkat = $postdata['kota_berangkat'];
        $kota_tujuan = $postdata['kota_tujuan'];
    		$alat_angkut = $postdata['alat_angkut'];
    		$kd_dipa = $postdata['kd_dipa'];
    		$tgl_mulai = $postdata['tgl_mulai'];
    		$tgl_selesai = $postdata['tgl_selesai'];
    		$sumber_dipa = $postdata['sumber_dipa'];

        $pegawai = $postdata['nm_pegawai'];

        $tahun_input = date("Y");
        $dataSpdOld = $this->Perjadin_model->getSpdTmp();
        foreach ($dataSpdOld as $key => $value) {
          // print_r($value['id_st_spd']);
          $dataTmp=array(
            'id_st_spd'=>$value['id_st_spd'],
            'nip_spd'=>$value['nip_spd'],
            'tgl_mulaiSt'=>$value['tgl_mulaiSt'],
            'tgl_selesaiSt'=>$value['tgl_selesaiSt']
          );
          $insertSpdTmp = $this->Perjadin_model->db->insert('tbl_tmp_spd',$dataTmp);
        }
        //             print_r($updateSpdTmp);
        // die();
        $deleted = $this->Perjadin_model->db->delete('tbl_spd',array('id_st_spd'=>$id_no_st));
        if(empty($deleted)){
            $this->response( array('status'=>'failure',
            'message'=>'an expected error trying to delete SPD'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else {
          $dataSpd=array();
          foreach( $pegawai as $key => $value){
            $gabung = explode("+",$value);
            $nipNppSpd=$gabung[0];
            $nmSpd=$gabung[1];
            $dataSpd[$key]['id_no_spd']= 0;
            $dataSpd[$key]['uyah']= $postdata['kd_uniq'];
            $dataSpd[$key]['no_nd'] = $no_nd;
            $dataSpd[$key]['no_spd']= 0;
            $dataSpd[$key]['nip_spd'] = $nipNppSpd;
            $dataSpd[$key]['nm_spd'] = $nmSpd;
            $dataSpd[$key]['detail_pegawai'] = $value;
            $dataSpd[$key]['id_st_spd']=$id_no_st;
            $dataSpd[$key]['alat_angkut']=$alat_angkut;
            $dataSpd[$key]['tgl_mulaiSt']=$tgl_mulai;
            $dataSpd[$key]['tgl_selesaiSt']=$tgl_selesai;
          }

          foreach($pegawai as $key => $nip){
            $gabung = explode("+",$value);
            $nipNppSpd=$gabung[0];
            $nmSpd=$gabung[1];
            $checkST = $this->Perjadin_model->CheckNipSt($nipNppSpd,$tgl_mulai,$tgl_selesai);
          }
              $data_spd = $this->Perjadin_model->insert_batch('tbl_spd',$dataSpd);
              if (!$data_spd){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
              }else{
                $dataSpdOldTmp = $this->Perjadin_model->getSpdTmpOld();
                foreach ($dataSpdOldTmp as $key => $value2) {
                  // print_r($value2['id_st_spd']);
                  $dataTmp=array(
                    'tgl_mulaiSt'=>$value2['tgl_mulaiSt'],
                    'tgl_selesaiSt'=>$value2['tgl_selesaiSt']
                  );
                  $checkDataTmpSpd = $this->Perjadin_model->CheckSpdTmp($value2['id_st_spd'],$value2['nip_spd']);
                  if($checkDataTmpSpd >=1){
                    $updateSpdTmp = $this->Perjadin_model->db->update('tbl_spd',$dataTmp,array('id_st_spd'=>$value2['id_st_spd'],'nip_spd'=>$value2['nip_spd']));
                  }
                }
                $deleted = $this->Perjadin_model->db->delete('tbl_tmp_spd',array('id_st_spd'=>$id_no_st));
                // die();
                $this->response(array('status'=>'success','message'=>'Sukses Update Pegawai'));
              }
/** 
 * sementara di comment
          // if($checkST >=1){
          //     $data_spd = $this->Perjadin_model->insert_batch('tbl_spd',$dataSpd);
          //   if (!$data_spd){
          //     $this->response( array('status'=>'failure',
          //     'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          //   }else{
          //     // $data_id = $this->Perjadin_model->update('tbl_st',array('tmp_pegawai'=>$pegawai),array('id_no_st'=>$id_no_st));
          //     // if (!$data_id){
          //     //   $this->response( array('status'=>'failure',
          //     //   'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          //     // }else{
          //       $this->response(array('status'=>'success','message'=>'Sukses Update Pegawai Tetapi ada Pegawai yang lebih dari satu ST dalam tanggal yang sama/beririsan'));
          //     // }
          //   }
          // }else {
          //     $data_spd = $this->Perjadin_model->insert_batch('tbl_spd',$dataSpd);
          //     if (!$data_spd){
          //       $this->response( array('status'=>'failure',
          //       'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          //     }else{
          //       // $data_id = $this->Perjadin_model->update('tbl_st',array('tmp_pegawai'=>$pegawai),array('id_no_st'=>$id_no_st));
          //       // if (!$data_id){
          //       //   $this->response( array('status'=>'failure',
          //       //   'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          //       // }else{
          //         $this->response(array('status'=>'success','message'=>'Sukses Update Pegawai'));
          //       // }
               
          //     }
          // }
          */
        }
    }
    function save_edit_st_post() {
        $id = $this->uri->segment(2);
        $postdata = $this->post();
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        $this->load->model('Perjadin_model');
        $id_no_st =$postdata['id_no_st'];

        // $no_st =$postdata['no_st'];
        $tgl_st = $postdata['tgl_st'];
    		$no_nd = $postdata['no_nd'];
    		$tgl_nd = $postdata['tgl_nd'];
    		$tgl_nd_terima = $postdata['tgl_nd_terima'];
    		$jenis_st = $postdata['jenis_st'];
    		$perihal = $postdata['perihal'];
    		$kota_berangkat = $postdata['kota_berangkat'];
        $kota_tujuan = $postdata['kota_tujuan'];
    		$alat_angkut = $postdata['alat_angkut'];
    		$kd_dipa = $postdata['kd_dipa'];
    		$tgl_mulai = $postdata['tgl_mulai'];
    		$tgl_selesai = $postdata['tgl_selesai'];
    		$sumber_dipa = $postdata['sumber_dipa'];

        // $pegawai = $postdata['nm_pegawai'];

    		$tahun_input = date("Y");
    		$data = array(
    			// 'id' =$id
    			// 'id_st' => $kd_urut,
          // 'no_st' => $no_st,
    			// 'id_no_st' => $id_no_st,
    			'tgl_st' => $tgl_st,
    			'no_nd' => $no_nd,
    			'tgl_nd_diterima' => $tgl_nd,
    			'tgl_nd' => $tgl_nd_terima,
    			'jenis' => $jenis_st,
    			'perihal' => $perihal,
    			'kota_berangkat' => $kota_berangkat,
          'kota_tujuan' => $kota_tujuan,
    			'alat_angkut' => $alat_angkut,
    			'kd_dipa' => $kd_dipa,
    			'tgl_mulai' => $tgl_mulai,
    			'tgl_selesai' => $tgl_selesai,
    			'sumber_dipa' => $sumber_dipa
    		);
          $data_id = $this->Perjadin_model->update($data,array('id_no_st'=>$id_no_st));
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $UpdateTglSpd = $this->Perjadin_model->db->update('tbl_spd',array('no_nd'=>$no_nd,'tgl_mulaiSt'=>$tgl_mulai,'tgl_selesaiSt'=>$tgl_selesai),array('id_st_spd'=>$id_no_st));
              if(!$UpdateTglSpd){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
              }else{
                $this->response(array('status'=>'success','message'=>'Sukses Update'));
              }
          }
    }
    //save Edit Tanggal Spd 21 Maret 2019 by sgr
    function save_editTgl_post() {
        $id = $this->uri->segment(2);
        $postdata = $this->post();
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        $this->load->model('Perjadin_model');
        $no_st = $postdata['no_st'];
    		$id_peg = $postdata['id_peg'];
    		$tanggal = $postdata['tanggal'];
    		$detail = $postdata['detail'];
        $updatBy =$postdata['update_bySpd'];
        if($detail == "Mulai"){
          $data = array(
            'tgl_mulaiSt' => $tanggal,
            'update_bySpd' => $updatBy,
            'date_updateSpd' => date("Y-m-d H:i:s"),
            'info_update' => "Update Tanggal"
          );
        }else if($detail == "Selesai"){
          $data = array(
            'tgl_selesaiSt' => $tanggal,
            'update_bySpd' => $updatBy,
            'date_updateSpd' => date("Y-m-d H:i:s"),
            'info_update' => "Update Tanggal"
          );
        }else{
          $data = array(
            'update_bySpd' => $updatBy,
            'date_updateSpd' => date("Y-m-d H:i:s"),
            'info_update' => "Update Tanggal Error"
          );
        }
          // $data_id = $this->Perjadin_model->where(array('id_st_spd'=>$no_st,'nip_spd'=>$id_peg));
          $data_id = $this->Perjadin_model->db->update('tbl_spd',$data,array('id_st_spd'=>$no_st,'nip_spd'=>$id_peg));
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status'=>'success','message'=>'Sukses Update'));
          }
    }
    //save_edit_stExt
    function save_edit_stExt_post() {
        $id = $this->uri->segment(2);
        $postdata = $this->post();
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        $this->load->model('Perjadin_model');
        $id_st =$postdata['id_st'];

        $no_st =$postdata['no_st'];
        $tgl_st = $postdata['tgl_st'];
    		$no_nd = $postdata['no_nd'];
    		$tgl_nd = $postdata['tgl_nd'];
    		$tgl_nd_terima = $postdata['tgl_nd_terima'];
    		$jenis_st = $postdata['jenis_st'];
    		$perihal = $postdata['perihal'];
    		$kota_berangkat = $postdata['kota_berangkat'];
        $kota_tujuan = $postdata['kota_tujuan'];
    		$alat_angkut = $postdata['alat_angkut'];
    		$kd_dipa = $postdata['kd_dipa'];
    		$tgl_mulai = $postdata['tgl_mulai'];
    		$tgl_selesai = $postdata['tgl_selesai'];
    		$sumber_dipa = $postdata['sumber_dipa'];
        $nip_pegawai_ext = $postdata['nip_pegawai'];
        $nm_pegawai_ext = $postdata['nm_pegawai'];
        $nm_pegawai_ext = $postdata['nm_pegawai'];
        $panggol_pegawai = $postdata['panggol_pegawai'];
        $jbtn_pegawai = $postdata['jbtn_pegawai'];
        // $pegawai = $postdata['nm_pegawai'];

    		$tahun_input = date("Y");
    		$data = array(
    			// 'id' =$id
    			// 'id_st' => $kd_urut,
          'no_st' => $no_st,
    			// 'id_no_st' => $id_no_st,
    			'tgl_st' => $tgl_st,
    			'no_nd' => $no_nd,
    			'tgl_nd_diterima' => $tgl_nd,
    			'tgl_nd' => $tgl_nd_terima,
    			'jenis' => $jenis_st,
    			'perihal' => $perihal,
    			'kota_berangkat' => $kota_berangkat,
          'kota_tujuan' => $kota_tujuan,
    			'alat_angkut' => $alat_angkut,
    			'kd_dipa' => $kd_dipa,
    			'tgl_mulai' => $tgl_mulai,
    			'tgl_selesai' => $tgl_selesai,
    			'sumber_dipa' => $sumber_dipa,
          'nip_pegawai_ext'  => $nip_pegawai_ext,
          'nm_pegawai_ext'  => $nm_pegawai_ext,
          'panggol_pegawai' =>$panggol_pegawai,
          'jbtn_pegawai' =>$jbtn_pegawai
    		);
        // print_r($data);die();
          $data_id = $this->Perjadin_model->db->update('tbl_st_ext',$data,array('id_st'=>$id_st));
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status'=>'success','message'=>'Sukses Update'));
          }
    }
    function save_st_ext_post() {
        $id = $this->uri->segment(2);
        $postdata = $this->post();
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        $this->load->model('Perjadin_model');
        $no_st =$postdata['no_st'];
        $id_no_st =$postdata['id_no_st'];
        $tgl_st = $postdata['tgl_st'];
    		$no_nd = $postdata['no_nd'];
    		$tgl_nd = $postdata['tgl_nd'];
    		$tgl_nd_terima = $postdata['tgl_nd_terima'];
    		$jenis_st = $postdata['jenis_st'];
    		$perihal = $postdata['perihal'];
    		$kota_berangkat = $postdata['kota_berangkat'];
        $kota_tujuan = $postdata['kota_tujuan'];
    		$alat_angkut = $postdata['alat_angkut'];
    		$kd_dipa = $postdata['kd_dipa'];
    		$tgl_mulai = $postdata['tgl_mulai'];
    		$tgl_selesai = $postdata['tgl_selesai'];
    		$sumber_dipa = $postdata['sumber_dipa'];
        // $no_spd_ext = $postdata[''];
        $nip_pegawai_ext = $postdata['nip_pegawai'];
        $nm_pegawai_ext = $postdata['nm_pegawai'];
        $panggol_pegawai = $postdata['panggol_pegawai'];
        $jbtn_pegawai = $postdata['jbtn_pegawai'];
        $created_by = $postdata['created_by'];

        $no_spd_ext = $postdata['id_no_spd']+1;
        // $id_no_spd = $id_no_spd;
        $nospd_ext = "SPD-".$no_spd_ext."/LMAN/".date("Y");
    		$tahun_input = date("Y");
    		$data = array(
    			// 'id' =$id
    			// 'id_st' => $kd_urut,
          'id_no_spd' => $no_spd_ext,
          'uyah' => $postdata['kd_uniq'],
          'no_st' => $no_st,
          'no_nd' => $no_nd,
    			'tgl_st' => $tgl_st,
          'tgl_nd_diterima' => $tgl_nd,
          'tgl_nd' => $tgl_nd_terima,
          'jenis' => $jenis_st,
          'perihal' => $perihal,
          'kota_berangkat' => $kota_berangkat,
          'kota_tujuan' => $kota_tujuan,
          'alat_angkut' => $alat_angkut,
          'kd_dipa' => $kd_dipa,
          'tgl_mulai' => $tgl_mulai,
          'tgl_selesai' => $tgl_selesai,
          'sumber_dipa' => $sumber_dipa,
          'status_spd'  => 1,
          'no_spd_ext'  => $nospd_ext,
          'nip_pegawai_ext' => $nip_pegawai_ext,
          'nm_pegawai_ext'=> $nm_pegawai_ext,
          'panggol_pegawai' =>$panggol_pegawai,
          'jbtn_pegawai' =>$jbtn_pegawai,
          'no_spd_ext' => $nospd_ext,
          'created_by' => $created_by,
          'date_created' => date("Y-m-d H:i:s")
    		);
        // if(\strpos($kota_tujuan,'JAKARTA') !== false ){
        // if($kota_tujuan == "JAKARTA"){
        //   $id_no_spd = 0;
        //   $nospd ="0";
        // }else {
        //   $id_no_spd = $postdata['id_no_spd']+1;
        //   $id_no_spd = $id_no_spd;
        //   $nospd = "SPD-".$id_no_spd."/LMAN/".date("Y");
        // }
        $detailPegwai= $nip_pegawai_ext."+".$nm_pegawai_ext;
        $dataSpd = array(
          'id_no_spd' => $no_spd_ext,
          'uyah' => $postdata['kd_uniq2'],
          'no_nd' => $no_nd,
          'no_spd' => $nospd_ext,
          'id_st_spd' => 0,
          'nip_spd' => $nip_pegawai_ext,
          'nm_spd' => $nm_pegawai_ext,
          'detail_pegawai' => $nip_pegawai_ext."+".$nm_pegawai_ext,
          'tgl_mulaiSt' => $tgl_mulai,
          'tgl_selesaiSt' => $tgl_selesai,
          'alat_angkut' => $alat_angkut,
          'status_spd' => 1,
          'jenis_spd' => "External",
          'created_bySpd' => $created_by,
          'date_createdSpd' => date("Y-m-d H:i:s"),
          'update_bySpd' => $created_by,
          'date_updateSpd' => date("Y-m-d H:i:s")
        );
        // foreach($pegawai as $key => $nip){
          $checkST = $this->Perjadin_model->CheckNipStExt($nip_pegawai_ext,$tgl_mulai,$tgl_selesai);
        // }
        // print_r($data);die();
        if($checkST >=1){
          $this->response(array('status'=>'failure','message'=>'Pegawai tidak boleh lebih dari satu ST dalam tanggal yang sama/ber irisan'));
        }else {
          $data_id = $this->Perjadin_model->db->insert('tbl_st_ext',$data);
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
            $data_spd = $this->Perjadin_model->db->insert('tbl_spd',$dataSpd);
            if (!$data_spd){
              $this->response( array('status'=>'failure',
              'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else{
              $this->response(array('status'=>'success','message'=>'Sukses Insert'));
            }
          }
        }
    }

    function save_st_post() {
        $id = $this->uri->segment(2);
        $postdata = $this->post();
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        $this->load->model('Perjadin_model');
        $no_st =$postdata['no_st'];
        $id_no_st =$postdata['id_no_st'];
        $tgl_st = $postdata['tgl_st'];
    		$no_nd = $postdata['no_nd'];
    		$tgl_nd = $postdata['tgl_nd'];
    		$tgl_nd_terima = $postdata['tgl_nd_terima'];
    		$jenis_st = $postdata['jenis_st'];
    		$perihal = $postdata['perihal'];
    		$kota_berangkat = $postdata['kota_berangkat'];
        $kota_tujuan = $postdata['kota_tujuan'];
    		$alat_angkut = $postdata['alat_angkut'];
    		$kd_dipa = $postdata['kd_dipa'];
    		$tgl_mulai = $postdata['tgl_mulai'];
    		$tgl_selesai = $postdata['tgl_selesai'];
        $sumber_dipa = $postdata['sumber_dipa'];
        $created_by = $postdata['created_by'];

    		$checkSt = $postdata['checkSt'];
        if($checkSt == "Int"){
          $jenis_st2 = "Internal";
        }else{
          $jenis_st2 = "External";
        }
        $pegawai = $postdata['nm_pegawai'];

    		$tahun_input = date("Y");
    		$data = array(
          // 'id' =$id
    			// 'id_st' => $kd_urut,
    			'id_no_st' => $id_no_st,
          'uyah' => $postdata['kd_uniq'],
          'no_st' => $no_st,
    			'tgl_st' => $tgl_st,
    			'no_nd' => $no_nd,
    			'tgl_nd_diterima' => $tgl_nd,
    			'tgl_nd' => $tgl_nd_terima,
    			'jenis' => $jenis_st,
    			'perihal' => $perihal,
    			'kota_berangkat' => $kota_berangkat,
          'kota_tujuan' => $kota_tujuan,
          // 'tmp_pegawai' => $pegawai,
    			'alat_angkut' => $alat_angkut,
    			'kd_dipa' => $kd_dipa,
    			'tgl_mulai' => $tgl_mulai,
    			'tgl_selesai' => $tgl_selesai,
    			'sumber_dipa' => $sumber_dipa,
          'jenis_st'  => $jenis_st2,
          'created_by' => $created_by,
          'date_created' => date("Y-m-d H:i:s")
    		);
        // echo array($pegawai);die();
        // if(\strpos($kota_tujuan,'JAKARTA') !== false ){
        if($kota_berangkat == "JAKARTA" && $kota_tujuan == "JAKARTA"){ //add kondisi kota berangkat != Jakarta --> Update tanggal 8 April 2019
          $id_no_spd = 0;
          $nospd ="0";
        }else {
          $id_no_spd = $postdata['id_no_spd']+1;
          $id_no_spd = $id_no_spd;
          $nospd = "SPD-".$id_no_spd."/LMAN/".date("Y");
        }
        $dataSpd=array();
        foreach( $pegawai as $key => $value){
          $gabung = explode("+",$value);
          // print_r($gabung);
          $nipNppSpd=$gabung[0];
          $nmSpd=$gabung[1];
          $dataSpd[$key]['id_no_spd']= 0;
          $dataSpd[$key]['uyah']= $postdata['kd_uniq'];
          $dataSpd[$key]['no_nd'] = $no_nd;
          $dataSpd[$key]['no_spd']= 0;
          $dataSpd[$key]['nip_spd'] = $nipNppSpd;
          $dataSpd[$key]['nm_spd'] = $nmSpd;
          $dataSpd[$key]['detail_pegawai'] = $value;
          $dataSpd[$key]['tgl_mulaiSt'] = $tgl_mulai;
          $dataSpd[$key]['tgl_selesaiSt'] = $tgl_selesai;
          $dataSpd[$key]['id_st_spd'] = $id_no_st;
          $dataSpd[$key]['alat_angkut'] = $alat_angkut;
          $dataSpd[$key]['jenis_spd'] = $jenis_st2;
          $dataSpd[$key]['created_bySpd'] = $created_by;
          $dataSpd[$key]['date_createdSpd'] = date("Y-m-d H:i:s");
          // if(\strpos($kota_tujuan,'JAKARTA') !== false ){
          // if($kota_tujuan == "JAKARTA"){
          // }else {
          //   $id_no_spd++;
          // }
        }
        foreach($pegawai as $key => $nip){
          // print_r($nip."-".$tgl_mulai."----".$tgl_selesai);die();
          // if($checkSt == "Int"){
            $gabung = explode("+",$value);
            $nipNppSpd=$gabung[0];
            $namaSpd=$gabung[1];
            $checkST = $this->Perjadin_model->CheckNipSt($nipNppSpd,$tgl_mulai,$tgl_selesai);
          // }else{
          //   $checkST = $this->Perjadin_model->CheckIdStExt($nip,$tgl_mulai,$tgl_selesai);
          // }
        }
        if($checkST >=1){
          // $this->response(array('status'=>'failure','message'=>'Pegawai tidak boleh lebih dari satu ST dalam tanggal yang sama/ber irisan <br> Apakah akan di proses?'));
          // Additional ST > 1
          $data_id = $this->Perjadin_model->insert($data);
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
            $data_spd = $this->Perjadin_model->insert_batch('tbl_spd',$dataSpd);
            if (!$data_spd){
              $this->response( array('status'=>'failure',
              'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else{
              $this->response(array('status'=>'success','message'=>'Pegawai ini lebih dari satu ST dalam tanggal yang sama/beririsan data berhasil disave'));
            }
          }
        }else {
          $data_id = $this->Perjadin_model->insert($data);
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
            $data_spd = $this->Perjadin_model->insert_batch('tbl_spd',$dataSpd);
            if (!$data_spd){
              $this->response( array('status'=>'failure',
              'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }else{
              $this->response(array('status'=>'success','message'=>'Sukses Insert'));
            }
          }
        }
    }

    //update_statusSt
    function update_statusSt_post() {
        $id = $this->uri->segment(2);
        $postdata = $this->post();
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        $this->load->model('Perjadin_model');

        $id_no_st =$postdata['id_no_st'];
        $status_approval = $postdata['status_approval'];
        // $created_by = $postdata['created_by'];


    		$data = array(
    			'status_approval' => $status_approval
    		);
          $data_id = $this->Perjadin_model->update($data,array('id_no_st'=>$id_no_st));
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status'=>'success','message'=>'Sukses Update Status Approval'));
          }
    }
    //update_statusPlhSt
    function update_statusPlhSt_post() {
        $id = $this->uri->segment(2);
        $postdata = $this->post();
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        $this->load->model('Perjadin_model');

        $id_no_st =$postdata['id_no_st'];
        $stat_plh = $postdata['stat_plh'];
        $nm_plh = $postdata['nmPlh'];
        $nip_plh = $postdata['nipPlh'];
        if(!$nm_plh){
          $stat_plh =0;
          $nm_plh="";
        }else{
          $stat_plh = $stat_plh;
          $nm_plh   = $nm_plh;
        }
    		$data = array(
    			'stat_plh' => $stat_plh,
          'nm_plh'  =>  $nm_plh,
          'nip_plh'  =>  $nip_plh
    		);
        // print_r($data);die();
          $data_id = $this->Perjadin_model->update($data,array('id_no_st'=>$id_no_st));
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status'=>'success','message'=>'Sukses Update Status Plh'));
          }
    }
    // update_statusStExt
    function update_statusStExt_post() {
        $id = $this->uri->segment(2);
        $postdata = $this->post();
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        $this->load->model('Perjadin_model');

        $id_st =$postdata['id_st'];
        $status_approval = $postdata['status_approval'];
        if($status_approval == 2){
          $status_spd_ext =1;
        }else{
          $status_spd_ext =0;
        }


    		$data = array(
          'status_approval' => $status_approval,
    			'status_spd_ext' => $status_spd_ext
    		);
          $data_id = $this->Perjadin_model->db->update('tbl_st_ext',$data,array('id_st'=>$id_st));
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status'=>'success','message'=>'Sukses Update Status Approval'));
          }
    }
    //update_statusSPD
    function update_statusSPD_post() {
        $id = $this->uri->segment(2);
        $postdata = $this->post();
        // print_r($postdata);die();
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        $this->load->model('Perjadin_model');

        $id_no_st =$postdata['id_no_st'];
        $kota_tujuan = $postdata['kota_tujuan'];
        $kota_berangkat = $postdata['kota_berangkat'];
        $alat_angkut = $postdata['alat_angkut'];
        $pegawai = $postdata['pegawai'];
        $created_by = $postdata['created_by'];
        // $status_approval = $postdata['status_approval'];
        // if(\strpos($kota_tujuan,'JAKARTA') !== false ){
        // if($kota_tujuan == "JAKARTA"){
        //   $id_no_spd = 0;
        //   $nospd ="0";
        // }else {
        //   $id_no_spd = $postdata['id_no_spd']+1;
        //   $id_no_spd = $id_no_spd;
        //   $nospd = "SPD-".$id_no_spd."/LMAN/".date("Y");
        // }
        if($kota_tujuan == "JAKARTA" && $kota_berangkat == "JAKARTA"){
          $id_no_spd = 0;
          $nospd ="0";
        }else {
          $id_no_spd = $postdata['id_no_spd']+1;
          $id_no_spd = $id_no_spd;
          $nospd = "SPD-".$id_no_spd."/LMAN/".date("Y");
        }
        // print_r($id_no_spd."-".$nospd);
        // die();
        $dataSpd=array();
        foreach( $pegawai as $key => $value){
          $dataSpd[$key]['id_st_spd']= $id_no_st;
          $dataSpd[$key]['id_no_spd']= $id_no_spd;
          if($kota_tujuan != "JAKARTA" || ($kota_tujuan == "JAKARTA" && $kota_berangkat != "JAKARTA")){
            $dataSpd[$key]['no_spd']= "SPD-".$id_no_spd."/LMAN/".date("Y");
          }
          $dataSpd[$key]['nip_spd'] = $value;
          // $dataSpd[$key]['id_st_spd']=$id_no_st;
          $dataSpd[$key]['alat_angkut']=$alat_angkut;
          $dataSpd[$key]['status_spd']=1;
          $dataSpd[$key]['update_bySpd']=$created_by;
          $dataSpd[$key]['date_updateSpd']= date("Y-m-d H:i:s");
          // if(\strpos($kota_tujuan,'JAKARTA') !== false ){
          if($kota_tujuan == "JAKARTA" && $kota_berangkat == "JAKARTA"){
          }else {
            $id_no_spd++;
          }

        }
        // print_r($dataSpd);
        // die();
          $data_id = $this->Perjadin_model->db->where('id_st_spd',$id_no_st);
          $data_id = $this->Perjadin_model->db->update_batch('tbl_spd',$dataSpd,'nip_spd');
          // $data_id .= $this->Perjadin_model->update_statusSPD($dataSpd,$id_no_st);
          // print_r($data_id);
          // $data_id = $this->Perjadin_model->update($data,array('id_no_st'=>$id_no_st));
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $data_UpdateST = $this->Perjadin_model->db->update('tbl_st',array('status_spd'=>1),array('id_no_st'=>$id_no_st));
              if (!$data_UpdateST){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
              } else {
              $this->response(array('status'=>'success','message'=>'Sukses Update Status Approval'));
            }
          }
    }
    function index_post() {
        $id = $this->uri->segment(2);
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());

        if($this->form_validation->run('perspective_post') != false){
            $this->load->model('Perjadin_model');
            $data = $this->post();
            $safe_data = $this->Perjadin_model->get(array('nm_pers'=>$this->post('nm_pers'),'tahun'=>$this->post('tahun')));
            if(!empty($safe_data)){
                $this->response( array('status'=>'failure',
                'message'=>'data already exists',REST_Controller::HTTP_CONFLICT));
              }
            $data_id = $this->Perjadin_model->insert($data);
            if (!$data_id){
                $this->response( array('status'=>'failure',
                'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->response(array('status'=>'success','message'=>'Insert Data Sukses'));
            }
        } else {
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    function index_delete() {
        $id = $this->uri->segment(2);
        $this->load->model('Perjadin_model');
        $data = $this->Perjadin_model->get(array('id_per'=>$this->delete('id_per')));
        if (isset($data)){
            $deleted = $this->Perjadin_model->force_delete(array('id_per'=>$this->delete('id_per')));
            if (!$deleted){
                $this->response( array('status'=>'failure',
                'message'=>'an expected error trying to delete '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->response(array('status'=>'success','message'=>'deleted success'));
            }
        } else {
            $this->response( array('status'=>'failure',
            'message'=>'no data found ',REST_Controller::HTTP_CONFLICT));
        }
    }

    function JumlahPegawaiSt(){

    }
    function search_spby_post()
    {
      $postdata = ($_POST);
      $requestdata = $_REQUEST;
      // print_r($requestdata);die();
      $this->load->model('perjadin/Spby_model','SpbyModel');
      $result= $this->SpbyModel->fetch_data_spby($requestdata['search']['value'],$requestdata['order'][0]['column'] , $requestdata['order'][0]['dir'], $requestdata['start'] ,$requestdata['length']);
      // $result= $this->SpbyModel->fetch_data_spby2();
      $result['totalData']		= $result['totalData'];
      $result['totalFiltered']	= $result['totalFiltered'];
      $result['query']			= $result['query'];
      $this->response($result, 200);
    }
    function simpan_spby_post()
    {
      $postdata = ($_POST);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      $this->load->model('perjadin/Spby_model','SpbyModel');
      $data = $this->post();
      $checkSimpan = $this->post('stat_edit');
      $dataInsert = array( 
        'tgl_spby' =>$this->post('tgl_spby'),
        'jns_spby' =>$this->post('jns_spby'),
        'id_st' =>$this->post('id_st'),
        'jumlah_spby' =>$this->post('jml_spby'),
        'nip_penerima_spby' =>$this->post('nip'),
        'nm_penerima_spby' =>$this->post('nama'),
        'detail_spby' =>$this->post('detail'),
        'kd_kegiatan' =>$this->post('uraian_kegiatan')
      );
      if($checkSimpan == 1){
        $dataInsert += array(
          'tgl_edit' =>date('Y-m-d H:i:s'),
          'edit_by' =>$this->post('sess_user')
        );
        $prosesSimpan = $this->SpbyModel->update($dataInsert,array('id_spby'=> $this->post('id_spby')));
        $responSUkses = $this->response(array('status'=>'success','message'=>'Sukses Update Data Baru'));
      }else{
        $dataInsert += array(
          'no_spby' =>$this->post('kd_spby'),
          'no_spby2' =>$this->post('kd_urut'),
          'tgl_buat' =>date('Y-m-d H:i:s'),
          'created_by' =>$this->post('sess_user'),
          'status_spby' =>1
        );
        $prosesSimpan = $this->SpbyModel->insert($dataInsert);
        $responSUkses = $this->response(array('status'=>'success','message'=>'Sukses Simpan Data Baru'));
      }
      // print_r($dataInsert);die();

        
      // 'kd_output' =>$this->post('kd_output'),
      // 'kd_sub_output' =>$this->post('kd_sub_output'),
      // 'kd_komponen' =>$this->post('kd_komponen'),
      // 'kd_akun' =>$this->post('kd_akun'),
      $data_id = $prosesSimpan;
      if (!$data_id){
        $this->response( array('status'=>'failure','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      } else {
        $responSUkses;
      }
    }
    function getKodeSpby_get()
    {
      $this->load->model('perjadin/Spby_model','SpbyModel');
      $result = $this->SpbyModel->getCodeSpby();
      $this->response($result, 200);
    }
    function cari_detail_st_post()
    {
      $postdata = ($_POST);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      $this->load->model('perjadin/Spby_model','SpbyModel');
      $data = $this->post();
      $id_no_st = $postdata['token'];
      $result= $this->SpbyModel->getDetailSt($id_no_st);
      $this->response($result,200);
    }
    function data_divisi_get(){
      $data['id_kegiatan'] = $this->uri->segment('4');
      $this->load->model('perjadin/Spby_model','SpbyModel');
      $result= $this->SpbyModel->getDataDivisi($data);
      $this->response($result, 200);
    }
    function data_kdKegiatan_get(){
      $data['id_kode'] = $this->uri->segment('4');
      $this->load->model('perjadin/Spby_model','SpbyModel');
      $result= $this->SpbyModel->getDataKdKegiatan($data);
      $this->response($result, 200);
    }
  function uraian_kegiatanData_post(){
    $postdata = ($_POST);
    $this->load->library('form_validation');
    $this->form_validation->set_data($this->put());
    $this->load->model('perjadin/Spby_model','SpbyModel');
    $data = $this->post();
    $id_kegiatan = $postdata['kode'];
    $result= $this->SpbyModel->getDetailKegiatan($id_kegiatan);
    $this->response($result,200);
  }
  function getDataSpby_post()
  {
    $postdata=($_POST);
    $this->load->library('form_validation');
    $this->form_validation->set_data($this->put());
    $this->load->model('perjadin/Spby_model','SpbyModel');
    $data = $this->post();
    $id_spby = $postdata['id_spby'];
    $result= $this->SpbyModel->getDetailSpby($id_spby);
    $this->response($result,200);

  }
  function st_list_lpd_post()
  {
    $data['id_kode'] = $this->uri->segment('4');
    $this->load->model('Perjadin_model','PerjadinModel');
    $result= $this->PerjadinModel->getStListSpd();
    $this->response($result, 200);
  }
  function save_lpd_post()
  {
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->post());
      $this->load->model('Perjadin_model','PerjadinModel');
      $data = $this->post();
      $status_lpd = $data['status_lpd'];
      $dataInsert = array(
        'id_st' =>$this->post('id_st'),
        'no_nd' =>$this->post('no_nd'),
        'no_st' =>$this->post('no_st'),
        'perihal' =>$this->post('perihal'),
        'kota_tujuan' =>$this->post('kota_tujuan'),
        'tgl_mulai' =>$this->post('tgl_mulai'),
        'tgl_selesai' =>$this->post('tgl_selesai'),
        'jenis_lpd' =>$this->post('jenis_lpd'),
        'dasar' =>$this->post('konten_dasar_st'),
        'pelaksanaan' =>$this->post('konten_perjadin'),
        'evaluasi' =>$this->post('konten_evaluasi'),
        'kesimpulan' =>$this->post('konten_kesimpulan'),
        'dokumentasi' =>$this->post('konten_dokumentasi'),
        'create_by' =>$this->post('created_by'),
        'date_created' =>date("Y-m-d H:i:s")
      );

      if($status_lpd == 0){
        $data_id = $this->PerjadinModel->db->insert('tbl_lpd',$dataInsert);
      }else{
        $data_id = $this->PerjadinModel->db->update('tbl_lpd',$dataInsert,array('id'=>$data['token']));
      }
      if (!$data_id){
        $this->response( array('status'=>'failure','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      } else {
        $updateStatusLpd = $this->PerjadinModel->update(array('status_lpd'=>1),array('no_nd'=>$this->post('no_nd')));
        if(!$updateStatusLpd){
          $this->response( array('status'=>'failure','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>'success','message'=>'Sukses Simpan Data Baru'));
        }
      }
  }
  function search_lpd_post()
    {
      $postdata = ($_POST);
      $requestdata = $_REQUEST;
      $this->load->model('Perjadin_model');
      if (isset($postdata)) {
        $result= $this->Perjadin_model->getDataLpd($postdata);
      } else {
        $result= $this->Perjadin_model->getDataLpd($postdata);
      }
      $this->response($result, 200);
    }
    function search_lpd_edit_post()
    {
      $postdata = ($_POST);
      $requestdata = $_REQUEST;
      $this->load->model('Perjadin_model','PerjadinModel');
      if (isset($postdata)) {
        $result= $this->PerjadinModel->getDataLpdEdit();
      } else {
        $result= $this->PerjadinModel->getDataLpdEdit();
      }
      $this->response($result, 200);
    }
    function get_pegawai_spd_post()
    {
      $postdata = ($_POST);
      $requestdata = $_REQUEST;
      $this->load->model('Perjadin_model','PerjadinModel');
      if (isset($postdata)) {
        $result= $this->PerjadinModel->getDataPegawaiSpd();
      } else {
        $result= $this->PerjadinModel->getDataPegawaiSpd();
      }
      $this->response($result, 200);
    }

}
