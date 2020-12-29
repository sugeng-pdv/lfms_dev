<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Created on Wed Jun 17 2020 9:44:47 AM
 *
 * Filename Form.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */



require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Form extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    //get data account by_email dan get data profile user
    function registrasiCheckEmail_post()
    {
      $postdata = $_POST;
      $this->load->model('vms/Form_model','ModelForm');
      $result = $this->ModelForm->db->select('id,role,role_text,email')->get_where('accounts',array('email'=>"$postdata[id_email]"));
      if($result->num_rows() == 0){
        $this->response(array('status'=>FALSE,'data'=>'','elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_NOT_FOUND);
      }else{
        $this->response(array('status'=>TRUE,'data'=>$result->result_array(),'elapsed_time'=> $this->benchmark->elapsed_time()),200);
      }
    }

    function getDataBentukUsaha_get()
    {
      $getdata = $this->uri->segment(4);
      if(isset($getdata)){
        $getWhere = array(
          'status'  => 1,
          'id'      => $getdata
        );
      }else{
        $getWhere = array(
          'status'  => 1
        );
      }
      $this->load->model('vms/Form_model','ModelForm');
      $result = $this->ModelForm->db->select('id,nama')->get_where('ref_jenis_perusahaan',$getWhere);
      $this->response($result->result_array(),200);
    }
    function getDataProvinsi_get()
    {
      $getdata = $this->uri->segment(4);
      // print_r($getdata);die();
      if(isset($getdata)){
        $getWhere = array(
          'status'  => 1,
          'id'      => $getdata
        );
      }else{
        $getWhere = array(
          'status'  => 1
        );
      }
      $this->load->model('vms/Form_model','ModelForm');
      $result = $this->ModelForm->db->select('id,nama')->get_where('ref_provinsi',$getWhere);
      $this->response($result->result_array(),200);
    }
    function getDataKota_get()
    {
      $getdata = $this->uri->segment(4);
      if(isset($getdata)){
        $getWhere = array(
          'status'  => 1,
          'id'      => $getdata
        );
      }else{
        $getWhere = array(
          'status'  => 1
        );
      }
      $this->load->model('vms/Form_model','ModelForm');
      $result = $this->ModelForm->db->select('id,nama')->get_where('ref_kota',$getWhere);
      $this->response($result->result_array(),200);
    }
    function getDataKotaProvinsi_get()
    {
      $getdata = $this->uri->segment(4);
      if(isset($getdata)){
        $getWhere = array(
          'status'  => 1,
          'id_provinsi'      => $getdata
        );
      }else{
        $getWhere = array(
          'status'  => 1
        );
      }
      $this->load->model('vms/Form_model','ModelForm');
      $result = $this->ModelForm->db->select('id,tipe,nama')->get_where('ref_kota',$getWhere);
      $this->response($result->result_array(),200);
    }
    function saveRegistrasiForm_post()
    {
      $postdata =$_POST;
      $this->load->model('vms/Form_model','ModelForm');
      $dataRegister=array(
        'id_account'          =>$this->mx_encryption->decrypt($postdata['token']),
        // 'id_jenis_kemitraan'  =>$postdata[''],
        'id_jenis_perusahaan' =>$postdata['jenis_usaha'],
        'nama'                =>$postdata['nm_perusahaan'],
        'tahun_pendirian'     =>$postdata['thn_pendirian'],
        'npwp'                =>$postdata['npwp'],
        'siup_siujk_nib'      =>$postdata['no_siup_siujk_nib'],
        // 'verifikasi_profil'   =>$postdata[''],
        'alamat'              =>$postdata['alamat'],
        'id_provinsi'         =>$postdata['provinsi'],
        'id_kota'             =>$postdata['kab_kota'],
        'telepon'             =>$postdata['no_tlp'],
        'handpone'            =>$postdata['no_hp'],
        'fax'                 =>$postdata['no_fax'],
        'website'             =>$postdata['website'],
        'nm_pendaftar'        =>$postdata['nm_lengkap'],
        'nik'                 =>$postdata['nik'],
        'jabatan'             =>$postdata['jabatan'],
        'date_save'           => date("Y-m-d H:i:s")
      );

      //insert user dahulu
      $insertDataPerusahaan = $this->ModelForm->db->insert('perusahaan',$dataRegister);
      if (empty($insertDataPerusahaan)){
        $this->response( array('status'=>FALSE,'data'=>'',
        'message'=>'Gagal Simpan','elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
          $this->response(array('status'=>TRUE,'data'=>'','message'=>'Sukses Simpan','elapsed_time'=> $this->benchmark->elapsed_time()),200);
      }
    }

    

    
}
