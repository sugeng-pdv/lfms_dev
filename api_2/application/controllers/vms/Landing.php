<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Created on Sat Jun 13 2020 12:12:24 PM
 *
 * Filename Landing.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Landing extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // =get data file
    function getMasterFile_post()
    {
        $this->load->model('vms/Landing_model','ModelLanding');
        $result= $this->ModelLanding->getMasterFile();
        $result=array(
          'data' => $result,
          'elapsed_time'=>$this->benchmark->elapsed_time()
        );
        $this->response($result, 200);
    }

    function registerVendor_post()
    {
      $postdata = $_POST;
      $this->load->model('vms/Landing_model','ModelLanding');
      //check email 
      $checkEmail = $this->ModelLanding->db->get_where('accounts',array('email'=> $postdata['email']));
      // print_r($this->benchmark->elapsed_time()s);die();
      if($checkEmail->num_rows() == 0){
        $this->response(array('status'=>TRUE,'message'=>'Email Tersedia','elapsed_time'=> $this->benchmark->elapsed_time()), REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
      }else{
        $this->response(array('status'=>FALSE,'message'=>'Email Sudah Terdaftar','elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }
      
    }

    function registerSave_post()
    {
      $postdata=$_POST;
      $this->load->model('vms/Landing_model','ModelLanding');

      $dataUser=array(
        'role'    => 5,
        'email'   => $postdata['email_subject'],
        'pwd'     => $postdata['enc_password'],
        'salt'    => $postdata['salt_password'],
        'version' => '1',
        // 'activation_code' => $enc_password['version'],
        'signup_date' => date('Y-m-d H:i:s'),
        'status'  => 1
      );

      $dataEmail=array(
        'email_to'          => $postdata['email_subject'],
        'email_subject'     => 'Akun Vendor Manajemen Sistem LMAN',
        'email_message'     => $postdata['isi_email'],
        'email_priority'    => '1',
        'email_type'        => 'html',
        'email_attachment'  => null,
        'email_send_time'   => time()
      );

      //insert user dahulu
      $insertUser = $this->ModelLanding->db->insert('accounts',$dataUser);
      if (empty($insertUser)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal','elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        //insert antrian email
        $insertEmail = $this->ModelLanding->db->insert('email_new',$dataEmail);
        if(empty($insertEmail)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal','elapsed_time'=> $this->benchmark->elapsed_time()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses','elapsed_time'=> $this->benchmark->elapsed_time()),200);
        }
      }
    }

    


    // if($checkEmail->num_rows() == 0){
    //   $this->response(array('status'=>TRUE,'message'=>'Email Berhasil Terkirim. Silakan cek email anda untuk melanjutkan ke tahap selanjutnya','elapsed_time' => $this->benchmark->elapsed_time()), REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    // }else{
    //   $this->response(array('status'=>FALSE,'message'=>'Email Sudah Terdaftar','elapsed_time' => $this->benchmark->elapsed_time()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    // }







    // belum di pakai
    function getDataMainMenuAbsen_post()
    {
        $postdata = $_POST;
        $this->load->model('harisman/Harisman_model','ModelHRIS');
        if (isset($postdata)) {
          $result= $this->ModelHRIS->getMainMenuAbsen($postdata);
        } else {
          $result= $this->ModelHRIS->getMainMenuAbsen($postdata);
        }
        $this->response($result, 200);
    }
    //sub side menu
    function getDataSubMenu_post()
    {
        $postdata = $_POST;
        $this->load->model('harisman/Harisman_model','ModelHRIS');
        if (isset($postdata)) {
          $result= $this->ModelHRIS->getSubMenu($postdata);
        } else {
          $result= $this->ModelHRIS->getSubMenu($postdata);
        }
        $this->response($result, 200);
    }
    function getDataSubMenuAbsen_post()
    {
        $postdata = $_POST;
        $this->load->model('harisman/Harisman_model','ModelHRIS');
        if (isset($postdata)) {
          $result= $this->ModelHRIS->getSubMenuAbsen($postdata);
        } else {
          $result= $this->ModelHRIS->getSubMenuAbsen($postdata);
        }
        $this->response($result, 200);
    }
    //get Data Pegawai
    function getDataPegawaiByNip_post()
    {
        $postdata =$_POST;
        $this->load->model('harisman/Harisman_model','ModelHRIS');
        if (isset($postdata)) {
            $result= $this->ModelHRIS->getDataPegawaiByNip();
          } else {
            $result= $this->ModelHRIS->getDataPegawaiByNip();
          }
        $this->response($result, 200);
    }
    function getDataPegawaiByNama_post()
    {
        $postdata =$_POST;
        $this->load->model('harisman/Harisman_model','ModelHRIS');
        if (isset($postdata)) {
            $result= $this->ModelHRIS->getDataPegawaiByNama();
          } else {
            $result= $this->ModelHRIS->getDataPegawaiByNama();
          }
        $this->response($result, 200);
    }

    function getDataPegawaiPokok_post()
    {
        $postdata =$_POST;
        $this->load->model('harisman/Harisman_model','ModelHRIS');
        $QueryResult= $this->ModelHRIS->getDataPegawaiById();
        if (!$QueryResult){
          $result = array('status'=>FALSE,'message'=>'Server wrong, please save again','code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR,'data'=>'');
        } else {
            $result = array('status'=>TRUE,'message'=>'Success Get Data','code'=>REST_Controller::HTTP_OK,'data'=>$QueryResult);
        }
        $this->response($result, 200);
    }
    function getDataProvinsi_get()
    {
      $getdata = $this->uri->segment(4);
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->getProvinsi($getdata);
      $this->response($result,200);
    }
    function getDataKota_get()
    {
      $getdata = $this->uri->segment(4);
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->getKota($getdata);
      $this->response($result,200);
    }
    function getDataJnsKelamin_get()
    {
      $getdata = $this->uri->segment(4);
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->getJnsKelamin($getdata);
      $this->response($result,200);
    }
    function getDataAgama_get()
    {
      $getdata = $this->uri->segment(4);
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->getAgama($getdata);
      $this->response($result,200);
    }
    function getDataGolDrh_get()
    {
      $getdata = $this->uri->segment(4);
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->getGolDrh($getdata);
      $this->response($result,200);
    }
    function getDataKotaProvinsi_get()
    {
      $getdata = $this->uri->segment(4);
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->getProvinsiKota($getdata);
      $this->response($result,200);
    }
    function UpdateDataPokokKk_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->db->update('pegawai',array('doc_kk'=>$postdata['doc_kk']),array('nip_npp'=>$postdata['id']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataInsert=array(
          'uraian'        => 1,
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['id'],
          'data_sebelum'  =>  $postdata['kk_lama'],
          'data_sesudah'  =>  $postdata['doc_kk'],
          'created_by'    =>  $postdata['nip_npp'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->insert('riwayat_perubahan_data',$dataInsert);
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }
    function UpdateDataPokokNik_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->db->update('pegawai',array('doc_nik'=>$postdata['doc_nik']),array('nip_npp'=>$postdata['id']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataInsert=array(
          'uraian'        => 2,
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['id'],
          'data_sebelum'  =>  $postdata['nik_lama'],
          'data_sesudah'  =>  $postdata['doc_nik'],
          'created_by'    =>  $postdata['nip_npp'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->insert('riwayat_perubahan_data',$dataInsert);
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }
    function UpdateDataPokokTtd_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->db->update('pegawai',array('doc_ttd'=>$postdata['doc_ttd']),array('nip_npp'=>$postdata['id']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataInsert=array(
          'uraian'        => 3,
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['id'],
          'data_sebelum'  =>  $postdata['ttd_lama'],
          'data_sesudah'  =>  $postdata['doc_ttd'],
          'created_by'    =>  $postdata['nip_npp'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->insert('riwayat_perubahan_data',$dataInsert);
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }

    //heck dokuman Kk
    function cekDokKk_get()
    {
      $id   = $this->uri->segment(4);
      $tabel='lman_riwayat_perubahan_data';
      $uraian=1;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->cekPerubahan($tabel,$id,$uraian);
      $this->response($result,200);
    }
    function cekDokNik_get()
    {
      $id   = $this->uri->segment(4);
      $tabel='lman_riwayat_perubahan_data';
      $uraian=2;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->cekPerubahan($tabel,$id,$uraian);
      $this->response($result,200);
    }
    //update data Pegawai
    function UpdateDataPokokPegawai_post()
    {
      $data = $_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $dataUpdate=array(
        'nip_npp'  => $data['dp_edit_nip_npp'],
        'nama'  => $data['dp_edit_nama'],
        'gelar_sebelum'  => $data['dp_edit_gelar_depan'],
        'gelar_sesudah'  => $data['dp_edit_gelar_belakang'],
        'tmpt_lahir'  => $data['dp_edit_tpt_lahir'],
        'tgl_lahir'  => $data['dp_edit_tgl_lahir'],
        'jenis_kelamin'  => $data['dp_edit_jk'],
        'agama'  => $data['dp_edit_agama'],
        'gol_darah'  => $data['dp_edit_gol_drh'],
        'access_card'  => $data['dp_edit_access_card'],
        'no_kk'  => $data['dp_edit_no_kk'],
        'nik'  => $data['dp_edit_nik'],
        'npwp'  => $data['dp_edit_npwp'],
        'alamat_ktp'  => $data['dp_edit_alamat_ktp'],
        'provinsi_ktp'  => $data['dp_edit_provinsi_ktp'],
        'kota_ktp'  => $data['dp_edit_kota_ktp'],
        'kode_pos_ktp'  => $data['dp_edit_kd_pos_ktp'],
        'alamat_tinggal'  => $data['dp_edit_alamat_tinggal'],
        'provinsi_tinggal'  => $data['dp_edit_provinsi_tinggal'],
        'kota_tinggal'  => $data['dp_edit_kota_tinggal'],
        'kode_pos_tinggal'  => $data['dp_edit_kd_pos_tinggal'],
        'email_dinas'         => $data['dp_edit_email_dinas'],
        'email_pribadi'       => $data['dp_edit_email_pribadi'],
        'no_tlp'              => $data['dp_edit_no_tlp'],
        'no_hp'               => $data['dp_edit_no_hp'],
        'nm_kontak_darurat'   => $data['dp_edit_nm_kontak_darurat'],
        'hub_kontak_darurat'  => $data['dp_edit_hub_kontak_darurat'],
        'no_kontak_darurat'   => $data['dp_edit_no_kontak_darurat'],
        'update_by'           => $data['update_by'],
        'date_update'         => date('Y-m-d h:i:s')
      );
      $insertUpdate = $this->ModelHris->db->update('pegawai',$dataUpdate,array('nip_npp'=>$data['dp_edit_nip_npp']));
      if (empty($insertUpdate)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }

    }

    function getJbOrganisasi_get()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_jb_organisasi();
      $this->response($result,200);
    }
    function getJbJabatan_get()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_jb_jabatan();
      $this->response($result,200);
    }
    function getJbStatusJabatan_get()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_jb_status_jabatan();
      $this->response($result,200);
    }
    function getJbDivisi_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_jb_select_divisi();
      if (empty($result)){
        $this->response(array('status'=>FALSE,
        'message'=>'Gagal','data'=>''),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses','data'=>$result),200);
      }
      $this->response($result,200);
    }
    function getJbJabatan_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_jb_select_jabatan();
      if (empty($result)){
        $this->response(array('status'=>FALSE,
        'message'=>'Gagal','data'=>''),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses','data'=>$result),200);
      }
      $this->response($result,200);
    }
    function getJbJabatanAtasan_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_jb_select_jabatan_atasan();
      if (empty($result)){
        $this->response(array('status'=>FALSE,
        'message'=>'Gagal','data'=>''),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses','data'=>$result),200);
      }
      $this->response($result,200);
    }
    public function SaveAddJabatan_post()
    {
      $data = $_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $dataInsert=array(
        // 'id'              => $data[''],
        'id_pegawai'      => $data['id_pegawai'],
        'id_uniq'         => $data['jenenge'],
        'direktorat'      => $data['jb_organisasi'],
        'divisi'          => $data['jb_divisi'],
        'tmt'             => $data['jb_tmt'],
        'no_sk'           => $data['jb_no_sk'],
        // 'no_doc'          => $data['jb_'],
        // 'doc_jbt'         => $data['jb_'],
        'tgl_sk'          => $data['jb_tgl_sk'],
        // 'tgl_selesai_sk'  => $data['jb_tgl_penetapan'],
        'tgl_pelantikan'  => $data['jb_tgl_penetapan'],
        'id_jbt'          => $data['jb_jabatan'],
        'id_jbt_atasan'   => $data['jb_atasan'],
        'status_jbt'      => $data['jb_status_jabatan'],
        'status_setuju'   => 0,
        // 'status'          => 0
      );
      $insertJabatan = $this->ModelHris->db->insert('riwayat_jbt',$dataInsert);
      if (empty($insertJabatan)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }
    public function UpdateAddJabatan_post()
    {
      $data = $_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $dataUpdate=array(
        // 'id'              => $data[''],
        'id_pegawai'      => $data['id_pegawai'],
        'id_uniq'         => $data['jenenge'],
        'direktorat'      => $data['jb_organisasi'],
        'divisi'          => $data['jb_divisi'],
        'tmt'             => $data['jb_tmt'],
        'no_sk'           => $data['jb_no_sk'],
        // 'no_doc'          => $data['jb_'],
        // 'doc_jbt'         => $data['jb_'],
        'tgl_sk'          => $data['jb_tgl_sk'],
        // 'tgl_selesai_sk'  => $data['jb_tgl_penetapan'],
        'tgl_pelantikan'  => $data['jb_tgl_penetapan'],
        'id_jbt'          => $data['jb_jabatan'],
        'id_jbt_atasan'   => $data['jb_atasan'],
        'status_jbt'      => $data['jb_status_jabatan'],
        'status_setuju'   => 0
        // 'status'          => 1
      );
      $UpdateJabatan = $this->ModelHris->db->update('riwayat_jbt',$dataUpdate,array('id'=>$data['jb_id']));
      if (empty($UpdateJabatan)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }
    public function UpdateDocJabatanSk_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->db->update('riwayat_jbt',array('doc_jbt'=>$postdata['doc_jbt']),array('id_uniq'=>$postdata['jenenge']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataInsert=array(
          'uraian'        => 4,          
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['nip_npp'],
          'data_sebelum'  =>  $postdata['jb_dokumen'],
          'data_sesudah'  =>  $postdata['doc_jbt'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->insert('riwayat_perubahan_data',$dataInsert);
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }

    public function UpdateDocJabatanSkUpdate_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->db->update('riwayat_jbt',array('doc_jbt'=>$postdata['doc_jbt']),array('id'=>$postdata['jb_id']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataUpdate=array(
          'uraian'        => 4,          
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['nip_npp'],
          'data_sebelum'  =>  $postdata['jb_dokumen'],
          'data_sesudah'  =>  $postdata['doc_jbt'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->update('riwayat_perubahan_data',$dataUpdate,array('kd_uniq'=>$postdata['jb_id_uniq']));
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }
    // getDataJabatan
    public function getDataJabatan_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_data_jabatan();
      // if (empty($result)){
      //   $this->response(array('status'=>FALSE,
      //   'message'=>'Gagal','data'=>''),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      // }else{
      //   $this->response(array('status'=>TRUE,'message'=>'Sukses','data'=>$result),200);
      // }
      $this->response($result,200);
    }
    public function getDataJabatanEdit_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_data_jabatan_edit();
      if (empty($result)){
        $this->response(array('status'=>FALSE,
        'message'=>'Gagal','data'=>''),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses','data'=>$result),200);
      }
      $this->response($result,200);
    }
    public function JabatanDelete_post()
    {
      // $data['urutane'] = "1987062820180730031577329001";
      $data = $_POST;
      // print_r($this->delete);die();
      $this->load->model('harisman/Harisman_model','ModelHris');
      $checkDataJbt = $this->ModelHris->db->get_where('riwayat_jbt',array('id_uniq'=>$data['urutane']));
      if(isset($checkDataJbt)){
        $checkDataRiwayatJbt = $this->ModelHris->db->get_where('riwayat_perubahan_data',array('kd_uniq'=>$data['urutane']));
        if(isset($checkDataRiwayatJbt)){
          $deletedDataJbt = $this->ModelHris->db->delete('riwayat_jbt',array('id_uniq'=>$data['urutane']));
              if (!$deletedDataJbt){
                  $this->response( array('status'=>false,
                  'message'=>'an expected error trying to delete '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
              } else {
                $deletedDataRiwayatJbt = $this->ModelHris->db->delete('riwayat_perubahan_data',array('kd_uniq'=>$data['urutane']));
                if (!$deletedDataRiwayatJbt){
                  $this->response( array('status'=>false,
                  'message'=>'an expected error trying to delete2 '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $this->response(array('status'=>true,'message'=>'deleted'));
                }
                // $this->response(array('status'=>true,'message'=>'deleted'));
              }
        }else {
          $this->response( array('status'=>false,
            'message'=>'no data found ',REST_Controller::HTTP_CONFLICT));
        }
      } else {
          $this->response( array('status'=>false,
          'message'=>'no data found 2',REST_Controller::HTTP_CONFLICT));
      }
    }

    //pangkat
    public function getDataPangkat_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_data_pangkat();
      $this->response($result,200);
    }
    public function getPkPanggol_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_pk_panggol();
      $this->response($result,200);
    }
    public function SaveAddPangkat_post()
    {
      $data = $_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $dataInsert=array(
        // 'id'              => $data[''],
        'id_pegawai'      => $data['id_pegawai'],
        'id_uniq'         => $data['jenenge'],
        'no_sk'           => $data['pk_no_sk'],
        'penerbit_sk'     => $data['pk_penerbit_sk'],
        'tgl_sk'          => $data['pk_tgl_sk'],
        'tmt'             => $data['pk_tmt'],
        'id_grade'        => $data['pk_panggol'],
        'masa_kerja_tahun'=> $data['pk_ms_kerja_thn'],
        'masa_kerja_bulan'=> $data['pk_ms_kerja_bln'],
        // 'doc_pangkat'     => $data['pk_status_jabatan'],
        'status_setuju'   => 0
        // 'status'          => 0
      );
      $insertJabatan = $this->ModelHris->db->insert('riwayat_pangkat',$dataInsert);
      if (empty($insertJabatan)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }
    public function UpdateAddPangkat_post()
    {
      $data = $_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $dataUpdate=array(
        // 'id'              => $data[''],
        'id_pegawai'      => $data['id_pegawai'],
        'id_uniq'         => $data['jenenge'],
        'no_sk'           => $data['pk_no_sk'],
        'penerbit_sk'     => $data['pk_penerbit_sk'],
        'tgl_sk'          => $data['pk_tgl_sk'],
        'tmt'             => $data['pk_tmt'],
        'id_grade'        => $data['pk_panggol'],
        'masa_kerja_tahun'=> $data['pk_ms_kerja_thn'],
        'masa_kerja_bulan'=> $data['pk_ms_kerja_bln'],
        // 'doc_pangkat'     => $data['pk_status_jabatan'],
        'status_setuju'   => 0
        // 'status'          => 0
      );
      $UpdateJabatan = $this->ModelHris->db->update('riwayat_pangkat',$dataUpdate,array('id'=>$data['pk_id']));
      if (empty($UpdateJabatan)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }
    public function UpdateDocPangkatSk_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->db->update('riwayat_pangkat',array('doc_pangkat'=>$postdata['doc_pk']),array('id_uniq'=>$postdata['jenenge']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataInsert=array(
          'uraian'        => 5, //Pangkat          
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['nip_npp'],
          'data_sebelum'  =>  $postdata['pk_dokumen'],
          'data_sesudah'  =>  $postdata['doc_pk'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->insert('riwayat_perubahan_data',$dataInsert);
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }

    public function UpdateDocPangkatSkUpdate_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->db->update('riwayat_pangkat',array('doc_pangkat'=>$postdata['doc_pk']),array('id'=>$postdata['pk_id']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataUpdate=array(
          'uraian'        => 5,          
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['nip_npp'],
          'data_sebelum'  =>  $postdata['pk_dokumen'],
          'data_sesudah'  =>  $postdata['doc_pk'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->update('riwayat_perubahan_data',$dataUpdate,array('kd_uniq'=>$postdata['pk_id_uniq']));
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }

    public function PangkatDelete_post()
    {
      // $data['urutane'] = "1987062820180730031577329001";
      $data = $_POST;
      // print_r($this->delete);die();
      $this->load->model('harisman/Harisman_model','ModelHris');
      $checkDataJbt = $this->ModelHris->db->get_where('riwayat_pangkat',array('id_uniq'=>$data['urutane']));
      if(isset($checkDataJbt)){
        $checkDataRiwayatJbt = $this->ModelHris->db->get_where('riwayat_perubahan_data',array('kd_uniq'=>$data['urutane']));
        if(isset($checkDataRiwayatJbt)){
          $deletedDataJbt = $this->ModelHris->db->delete('riwayat_pangkat',array('id_uniq'=>$data['urutane']));
              if (!$deletedDataJbt){
                  $this->response( array('status'=>false,
                  'message'=>'an expected error trying to delete '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
              } else {
                $deletedDataRiwayatJbt = $this->ModelHris->db->delete('riwayat_perubahan_data',array('kd_uniq'=>$data['urutane']));
                if (!$deletedDataRiwayatJbt){
                  $this->response( array('status'=>false,
                  'message'=>'an expected error trying to delete2 '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $this->response(array('status'=>true,'message'=>'deleted'));
                }
                // $this->response(array('status'=>true,'message'=>'deleted'));
              }
        }else {
          $this->response( array('status'=>false,
            'message'=>'no data found ',REST_Controller::HTTP_CONFLICT));
        }
      } else {
          $this->response( array('status'=>false,
          'message'=>'no data found 2',REST_Controller::HTTP_CONFLICT));
      }
    }

    //pangDiklatkat
    public function getDataDiklat_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_data_diklat();
      $this->response($result,200);
    }
    public function SaveAddDiklat_post()
    {
      $data = $_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $dataInsert=array(    
        'id_pegawai'          => $data['id_pegawai'],
        'id_uniq'             => $data['jenenge'],
        'id_jns_diklat'       => $data['dk_jns_diklat'],
        'id_type_diklat'       => $data['dk_type_diklat'],
        'tgl_diklat'          => $data['dk_tgl_diklat'],
        'nm_diklat'           => $data['dk_nm'],
        'no_sert_ikut_serta'  => $data['dk_no_sertifikat_ikut_serta'],
        'tgl_sert_ikut_serta' => $data['dk_tgl_sertifikat_ikut_serta'],
        'check_sert_kompetensi'  => $data['check_sert_kompetensi'],
        'no_sert_kompetensi'  => $data['dk_no_sertifikat_kompetensi'],
        'tgl_sert_kompetensi' => $data['dk_tgl_sertifikat_kompetensi'],
        'doc_sert_kompetensi' => '',
        'institusi'           => $data['dk_penyelenggara'],
        'instansi'            => $data['dk_instansi'],
        'jml_jam'             => $data['dk_jumlah_jam'],
        'kompetensi'          => $data['dk_kompetensi'],
        'status_setuju'       => 0
        // 'status'          => 0
      );
      $insertJabatan = $this->ModelHris->db->insert('riwayat_diklat',$dataInsert);
      if (empty($insertJabatan)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }
    public function UpdateAddDiklat_post()
    {
      $data = $_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $dataInsert=array(    
        'id_pegawai'          => $data['id_pegawai'],
        // 'id_uniq'             => $data['jenenge'],
        'id_jns_diklat'       => $data['dk_jns_diklat'],
        'id_type_diklat'      => $data['dk_type_diklat'],
        'tgl_diklat'          => $data['dk_tgl_diklat'],
        'nm_diklat'           => $data['dk_nm'],
        'no_sert_ikut_serta'  => $data['dk_no_sertifikat_ikut_serta'],
        'tgl_sert_ikut_serta' => $data['dk_tgl_sertifikat_ikut_serta'],
        'check_sert_kompetensi'=> $data['check_sert_kompetensi'],
        'no_sert_kompetensi'  => $data['dk_no_sertifikat_kompetensi'],
        'tgl_sert_kompetensi' => $data['dk_tgl_sertifikat_kompetensi'],
        'doc_sert_kompetensi' => $data['dk_dokumen_kompetensi'],
        'institusi'           => $data['dk_penyelenggara'],
        'instansi'            => $data['dk_instansi'],
        'jml_jam'             => $data['dk_jumlah_jam'],
        'kompetensi'          => $data['dk_kompetensi'],
        'status_setuju'       => 0
        // 'status'          => 0
      );
      $insertJabatan = $this->ModelHris->db->update('riwayat_diklat',$dataInsert,array('id'=>$data['dk_id']));
      if (empty($insertJabatan)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }
    public function UpdateDocDiklatSk_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      if($postdata['uraian']=="6a"){
        $result = $this->ModelHris->db->update('riwayat_diklat',array('doc_sert_ikut_serta'=>$postdata['doc_dk']),array('id_uniq'=>$postdata['jenenge']));
      }else{
        $result = $this->ModelHris->db->update('riwayat_diklat',array('doc_sert_kompetensi'=>$postdata['doc_dk']),array('id_uniq'=>$postdata['jenenge']));
      }
      // $result = $this->ModelHris->db->update('riwayat_pangkat',array('doc_pangkat'=>$postdata['doc_pk']),array('id_uniq'=>$postdata['jenenge']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataInsert=array(
          'uraian'        =>  $postdata['uraian'], //Pangkat          
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['nip_npp'],
          'data_sebelum'  =>  $postdata['data_sebelum'],
          'data_sesudah'  =>  $postdata['doc_dk'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->insert('riwayat_perubahan_data',$dataInsert);
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }

    public function UpdateDocDiklatSkUpdate_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      if($postdata['uraian']=="6a"){
        $result = $this->ModelHris->db->update('riwayat_diklat',array('doc_sert_ikut_serta'=>$postdata['doc_dk']),array('id'=>$postdata['dk_id']));
      }else{
        $result = $this->ModelHris->db->update('riwayat_diklat',array('doc_sert_kompetensi'=>$postdata['doc_dk']),array('id'=>$postdata['dk_id']));
      }
      // $result = $this->ModelHris->db->update('riwayat_diklat',array('doc_pangkat'=>$postdata['doc_pk']),array('id'=>$postdata['pk_id']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataUpdate=array(
          'uraian'        =>  $postdata['uraian'],          
          // 'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['nip_npp'],
          'data_sebelum'  =>  $postdata['data_sebelum'],
          'data_sesudah'  =>  $postdata['doc_dk'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->update('riwayat_perubahan_data',$dataUpdate,array('kd_uniq'=>$postdata['dk_id_uniq'],'uraian'=>$postdata['uraian']));
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }
    public function UpdateDocAllDiklat_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      if(!empty($postdata['dk_dokumen_kompetensi']))
      {
        $dataUpdate=array(
          'kd_uniq'  =>  $postdata['jenenge'],
          'data_sesudah'  =>  $postdata['new_doc'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
      }else{
        $dataUpdate=array(
          'kd_uniq'  =>  $postdata['jenenge'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
      }
        $insertUpdate = $this->ModelHris->db->update('riwayat_perubahan_data',$dataUpdate,array('kd_uniq'=>$postdata['dk_id_uniq'],'uraian'=>$postdata['uraian_new']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }
    public function DiklatDelete_post()
    {
      // $data['urutane'] = "1987062820180730031577329001";
      $data = $_POST;
      // print_r($this->delete);die();
      $this->load->model('harisman/Harisman_model','ModelHris');
      $checkDataJbt = $this->ModelHris->db->get_where('riwayat_diklat',array('id_uniq'=>$data['urutane']));
      if(isset($checkDataJbt)){
        $checkDataRiwayatJbt = $this->ModelHris->db->get_where('riwayat_perubahan_data',array('kd_uniq'=>$data['urutane']));
        if(isset($checkDataRiwayatJbt)){
          $deletedDataJbt = $this->ModelHris->db->delete('riwayat_diklat',array('id_uniq'=>$data['urutane']));
              if (!$deletedDataJbt){
                  $this->response( array('status'=>false,
                  'message'=>'an expected error trying to delete '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
              } else {
                $deletedDataRiwayatJbt = $this->ModelHris->db->delete('riwayat_perubahan_data',array('kd_uniq'=>$data['urutane']));
                if (!$deletedDataRiwayatJbt){
                  $this->response( array('status'=>false,
                  'message'=>'an expected error trying to delete2 '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $this->response(array('status'=>true,'message'=>'deleted'));
                }
                // $this->response(array('status'=>true,'message'=>'deleted'));
              }
        }else {
          $this->response( array('status'=>false,
            'message'=>'no data found ',REST_Controller::HTTP_CONFLICT));
        }
      } else {
          $this->response( array('status'=>false,
          'message'=>'no data found 2',REST_Controller::HTTP_CONFLICT));
      }
    }
    
    public function getPdSelectJenjang_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_pd_select_jenjang();
      $this->response($result,200);
    }
    public function getPdSelectLokasi_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_pd_select_lokasi();
      $this->response($result,200);
    }
    public function getPdSelectBelajar_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_pd_select_belajar();
      $this->response($result,200);
    }
    public function SaveAddPendidikan_post()
    {
      $data = $_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $datainsert=array(
        'id_pegawai'            =>$data['id_pegawai'],
        'id_ijin_belajar'       =>$data['pd_ijin_belajar'],
        'id_uniq'               =>$data['jenenge'],
        'id_pendidikan'         =>$data['pd_jns_jenjang'],
        'lembaga_pendidikan'    =>$data['pd_lembaga'],
        // 'id_lembaga_pendidikan' =>$data[''],
        // 'id_jurusan'            =>$data['dk_jurusan'],
        'jurusan'               =>$data['pd_jurusan'],
        'id_negara'             =>$data['pd_lokasi'],
        'provinsi'              =>$data['pd_kota'],
        // 'id_provinsi'           =>$data[''],
        'tgl_mulai'             =>$data['pd_tgl_mulai'],
        'tgl_selesai'           =>$data['pd_tgl_selesai'],
        'tgl_ijazah'            =>$data['pd_tgl_ijazah'],
        'no_ijazah'             =>$data['pd_nomor_ijazah'],
        'doc_ijazah'            =>$data['pd_dokumen_ijazah'],
        'gelar_depan'           =>$data['pd_gelar_depan'],
        'gelar_belakang'        =>$data['pd_gelar_belakang'],
        'created_by'            =>$data['created_by'],
        'date_created'          =>date('Y-m-d H:i:s')
      );
      $insertPendidikan = $this->ModelHris->db->insert('riwayat_pendidikan',$datainsert);
      if(empty($insertPendidikan)){
        $this->response(array('status'=>FALSE,'message'=>'Gagal Insert'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }
    public function UpdateAddPendidikan_post()
    {
      $data = $_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $dataInsert=array(
        'id_pegawai'            =>$data['id_pegawai'],
        'id_ijin_belajar'       =>$data['pd_ijin_belajar'],
        'id_uniq'               =>$data['jenenge'],
        'id_pendidikan'         =>$data['pd_jns_jenjang'],
        'lembaga_pendidikan'    =>$data['pd_lembaga'],
        // 'id_lembaga_pendidikan' =>$data[''],
        // 'id_jurusan'            =>$data['dk_jurusan'],
        'jurusan'               =>$data['pd_jurusan'],
        'id_negara'             =>$data['pd_lokasi'],
        'provinsi'              =>$data['pd_kota'],
        // 'id_provinsi'           =>$data[''],
        'tgl_mulai'             =>$data['pd_tgl_mulai'],
        'tgl_selesai'           =>$data['pd_tgl_selesai'],
        'tgl_ijazah'            =>$data['pd_tgl_ijazah'],
        'no_ijazah'             =>$data['pd_nomor_ijazah'],
        'doc_ijazah'            =>$data['pd_dokumen_ijazah'],
        'gelar_depan'           =>$data['pd_gelar_depan'],
        'gelar_belakang'        =>$data['pd_gelar_belakang'],
        'created_by'            =>$data['created_by'],
        'date_created'          =>date('Y-m-d H:i:s')
      );
      $insertJabatan = $this->ModelHris->db->update('riwayat_pendidikan',$dataInsert,array('id'=>$data['pd_id']));
      if (empty($insertJabatan)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }
    public function UpdateDocPendidikan_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->db->update('riwayat_pendidikan',array('doc_ijazah'=>$postdata['doc_pd']),array('id_uniq'=>$postdata['jenenge']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataInsert=array(
          'uraian'        => 7, //Pendidikan          
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['nip_npp'],
          'data_sebelum'  =>  $postdata['data_sebelum'],
          'data_sesudah'  =>  $postdata['doc_pd'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->insert('riwayat_perubahan_data',$dataInsert);
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }

    public function UpdateDocPendidikanUpdate_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->db->update('riwayat_pendidikan',array('doc_ijazah'=>$postdata['doc_pd']),array('id'=>$postdata['pd_id']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataUpdate=array(
          'uraian'        => 7,          
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['nip_npp'],
          'data_sebelum'  =>  $postdata['data_sebelum'],
          'data_sesudah'  =>  $postdata['doc_pd'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->update('riwayat_perubahan_data',$dataUpdate,array('kd_uniq'=>$postdata['pd_id_uniq']));
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }
    //get data pendidikan
    public function getDataPendidikan_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_data_pendidikan();
      $this->response($result,200);
    }

    //hapus pendidikan
    public function PendidikanDelete_post()
    {
      // $data['urutane'] = "1987062820180730031577329001";
      $data = $_POST;
      // print_r($this->delete);die();
      $this->load->model('harisman/Harisman_model','ModelHris');
      $checkDataJbt = $this->ModelHris->db->get_where('riwayat_pendidikan',array('id_uniq'=>$data['urutane']));
      if(isset($checkDataJbt)){
        $checkDataRiwayatJbt = $this->ModelHris->db->get_where('riwayat_perubahan_data',array('kd_uniq'=>$data['urutane']));
        if(isset($checkDataRiwayatJbt)){
          $deletedDataJbt = $this->ModelHris->db->delete('riwayat_pendidikan',array('id_uniq'=>$data['urutane']));
              if (!$deletedDataJbt){
                  $this->response( array('status'=>false,
                  'message'=>'an expected error trying to delete '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
              } else {
                $deletedDataRiwayatJbt = $this->ModelHris->db->delete('riwayat_perubahan_data',array('kd_uniq'=>$data['urutane']));
                if (!$deletedDataRiwayatJbt){
                  $this->response( array('status'=>false,
                  'message'=>'an expected error trying to delete2 '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $this->response(array('status'=>true,'message'=>'deleted'));
                }
                // $this->response(array('status'=>true,'message'=>'deleted'));
              }
        }else {
          $this->response( array('status'=>false,
            'message'=>'no data found ',REST_Controller::HTTP_CONFLICT));
        }
      } else {
          $this->response( array('status'=>false,
          'message'=>'no data found 2',REST_Controller::HTTP_CONFLICT));
      }
    }
    //get data seminar
    public function getDataSeminar_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_data_seminar();
      $this->response($result,200);
    }
    public function SaveAddSeminar_post()
    {
      $data = $_POST;
      // print_r($data);die();
      $this->load->model('harisman/Harisman_model','ModelHris');
      $datainsert=array(
        'id_pegawai'        =>$data['id_pegawai'],
        'id_uniq'           =>$data['jenenge'],
        'nm_seminar'        =>$data['sm_nm'],
        'penyelenggara'     =>$data['sm_penyelenggara'],
        'tgl_mulai'         =>$data['sm_tgl_mulai'],
        'tgl_selesai'       =>$data['sm_tgl_selesai'],
        'no_sert'           =>$data['sm_no_sertifikat'],
        'doc_seminar'       =>$data['sm_dokumen_seminar'], //check
        'tgl_sert'          =>$data['sm_tgl_sertifikat_seminar'],
        'id_peran_seminar'  =>$data['sm_peran_seminar'],        
        'id_negara_seminar' =>$data['sm_lokasi'],
        'kota_seminar'      =>$data['sm_kota'],
        'created_by'        =>$data['created_by'],
        'date_created'      =>date('Y-m-d H:i:s')
      );
      $insertData = $this->ModelHris->db->insert('riwayat_seminar',$datainsert);
      if(empty($insertData)){
        $this->response(array('status'=>FALSE,'message'=>'Gagal Insert'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }
    public function UpdateAddSeminar_post()
    {
      $data = $_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $dataInsert=array(
        'id_pegawai'        =>$data['id_pegawai'],
        'id_uniq'           =>$data['jenenge'],
        'nm_seminar'        =>$data['sm_nm'],
        'penyelenggara'     =>$data['sm_penyelenggara'],
        'tgl_mulai'         =>$data['sm_tgl_mulai'],
        'tgl_selesai'       =>$data['sm_tgl_selesai'],
        'no_sert'           =>$data['sm_no_sertifikat'],
        'doc_seminar'       =>$data['sm_dokumen_seminar'], //check
        'tgl_sert'          =>$data['sm_tgl_sertifikat_seminar'],
        'id_peran_seminar'  =>$data['sm_peran_seminar'],        
        'id_negara_seminar' =>$data['sm_lokasi'],
        'kota_seminar'      =>$data['sm_kota'],
        'created_by'        =>$data['created_by'],
        'date_created'      =>date('Y-m-d H:i:s')
      );
      $insertData = $this->ModelHris->db->update('riwayat_seminar',$dataInsert,array('id'=>$data['sm_id']));
      if (empty($insertData)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }
    public function UpdateDocSeminar_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->db->update('riwayat_seminar',array('doc_seminar'=>$postdata['doc_sm']),array('id_uniq'=>$postdata['jenenge']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataInsert=array(
          'uraian'        => 8, //Pendidikan          
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['nip_npp'],
          'data_sebelum'  =>  $postdata['data_sebelum'],
          'data_sesudah'  =>  $postdata['doc_sm'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->insert('riwayat_perubahan_data',$dataInsert);
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }

    public function UpdateDocSeminarUpdate_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->db->update('riwayat_seminar',array('doc_seminar'=>$postdata['doc_sm']),array('id'=>$postdata['sm_id']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataUpdate=array(
          'uraian'        => 8,          
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['nip_npp'],
          'data_sebelum'  =>  $postdata['data_sebelum'],
          'data_sesudah'  =>  $postdata['doc_sm'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->update('riwayat_perubahan_data',$dataUpdate,array('kd_uniq'=>$postdata['sm_id_uniq']));
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }

    public function SeminarDelete_post()
    {
      // $data['urutane'] = "1987062820180730031577329001";
      $data = $_POST;
      // print_r($this->delete);die();
      $this->load->model('harisman/Harisman_model','ModelHris');
      $checkDataJbt = $this->ModelHris->db->get_where('riwayat_seminar',array('id_uniq'=>$data['urutane']));
      if(isset($checkDataJbt)){
        $checkDataRiwayatJbt = $this->ModelHris->db->get_where('riwayat_perubahan_data',array('kd_uniq'=>$data['urutane']));
        if(isset($checkDataRiwayatJbt)){
          $deletedDataJbt = $this->ModelHris->db->delete('riwayat_seminar',array('id_uniq'=>$data['urutane']));
              if (!$deletedDataJbt){
                  $this->response( array('status'=>false,
                  'message'=>'an expected error trying to delete '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
              } else {
                $deletedDataRiwayatJbt = $this->ModelHris->db->delete('riwayat_perubahan_data',array('kd_uniq'=>$data['urutane']));
                if (!$deletedDataRiwayatJbt){
                  $this->response( array('status'=>false,
                  'message'=>'an expected error trying to delete2 '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $this->response(array('status'=>true,'message'=>'deleted'));
                }
                // $this->response(array('status'=>true,'message'=>'deleted'));
              }
        }else {
          $this->response( array('status'=>false,
            'message'=>'no data found ',REST_Controller::HTTP_CONFLICT));
        }
      } else {
          $this->response( array('status'=>false,
          'message'=>'no data found 2',REST_Controller::HTTP_CONFLICT));
      }
    }
    
    //menu status
    public function getSpSelectStatus_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_sp_select_status();
      $this->response($result,200);
    }
    public function getDataStatus_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_data_status();
      $this->response($result,200);
    }

    //delete status
    public function StatusDelete_post()
    {
      // $data['urutane'] = "1987062820180730031577329001";
      $data = $_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $checkDataJbt = $this->ModelHris->db->get_where('riwayat_status_pegawai',array('id_uniq'=>$data['urutane']));
      if(isset($checkDataJbt)){
        $checkDataRiwayatJbt = $this->ModelHris->db->get_where('riwayat_perubahan_data',array('kd_uniq'=>$data['urutane']));
        if(isset($checkDataRiwayatJbt)){
          $deletedDataJbt = $this->ModelHris->db->delete('riwayat_status_pegawai',array('id_uniq'=>$data['urutane']));
              if (!$deletedDataJbt){
                  $this->response( array('status'=>false,
                  'message'=>'an expected error trying to delete '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
              } else {
                $deletedDataRiwayatJbt = $this->ModelHris->db->delete('riwayat_perubahan_data',array('kd_uniq'=>$data['urutane']));
                if (!$deletedDataRiwayatJbt){
                  $this->response( array('status'=>false,
                  'message'=>'an expected error trying to delete2 '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $this->response(array('status'=>true,'message'=>'deleted'));
                }
                // $this->response(array('status'=>true,'message'=>'deleted'));
              }
        }else {
          $this->response( array('status'=>false,
            'message'=>'no data found ',REST_Controller::HTTP_CONFLICT));
        }
      } else {
          $this->response( array('status'=>false,
          'message'=>'no data found 2',REST_Controller::HTTP_CONFLICT));
      }
    }
    public function SaveAddStatus_post()
    {
      $data = $_POST;
      // print_r($data);die();
      $this->load->model('harisman/Harisman_model','ModelHris');
      $datainsert=array(
        'id_pegawai'        =>$data['id_pegawai'],
        'id_uniq'           =>$data['jenenge'],
        'id_status_pegawai' =>$data['sp_status_pegawai'],
        'tgl_sk'            =>$data['sp_tgl_sk'],
        'tmt'               =>$data['sp_tgl_sk'],
        'tgl_selesai'       =>$data['sp_tgl_selesai'],
        'no_sk'             =>$data['sp_no_sk'],
        'keterangan'       =>$data['sp_keterangan'],
        'doc_status_pegawai'=>$data['sp_dokumen_status'], 
        'created_by'        =>$data['created_by'],
        'date_created'      =>date('Y-m-d H:i:s')
      );
      $insertData = $this->ModelHris->db->insert('riwayat_status_pegawai',$datainsert);
      if(empty($insertData)){
        $this->response(array('status'=>FALSE,'message'=>'Gagal Insert'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }
    public function UpdateAddStatus_post()
    {
      $data = $_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $dataInsert=array(
        'id_pegawai'        =>$data['id_pegawai'],
        'id_uniq'           =>$data['jenenge'],
        'id_status_pegawai' =>$data['sp_status_pegawai'],
        'tgl_sk'            =>$data['sp_tgl_sk'],
        'tmt'               =>$data['sp_tgl_sk'],
        'tgl_selesai'       =>$data['sp_tgl_selesai'],
        'no_sk'             =>$data['sp_no_sk'],
        'keterangan'       =>$data['sp_keterangan'],
        'doc_status_pegawai'=>$data['sp_dokumen_status'], 
        'created_by'        =>$data['created_by'],
        'date_created'      =>date('Y-m-d H:i:s')
      );
      $insertData = $this->ModelHris->db->update('riwayat_status_pegawai',$dataInsert,array('id'=>$data['sp_id']));
      if (empty($insertData)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }
    public function UpdateDocStatus_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->db->update('riwayat_status_pegawai',array('doc_status_pegawai'=>$postdata['doc_sp']),array('id_uniq'=>$postdata['jenenge']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataInsert=array(
          'uraian'        => 9, //Pendidikan          
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['nip_npp'],
          'data_sebelum'  =>  $postdata['data_sebelum'],
          'data_sesudah'  =>  $postdata['doc_sp'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->insert('riwayat_perubahan_data',$dataInsert);
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }

    public function UpdateDocStatusUpdate_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->db->update('riwayat_status_pegawai',array('doc_status_pegawai'=>$postdata['doc_sp']),array('id'=>$postdata['sp_id']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataUpdate=array(
          'uraian'        => 9,          
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['nip_npp'],
          'data_sebelum'  =>  $postdata['data_sebelum'],
          'data_sesudah'  =>  $postdata['doc_sp'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->update('riwayat_perubahan_data',$dataUpdate,array('kd_uniq'=>$postdata['sp_id_uniq']));
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }


    //menu karya tulis
    public function getKtSelectJenisPublikasi_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_kt_select_jenispublikasi();
      $this->response($result,200);
    }
    public function getDataKaryaTulis_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_data_karyatulis();
      $this->response($result,200);
    }

    public function SaveAddKaryaTulis_post()
    {
      $data = $_POST;
      // print_r($data);die();
      $this->load->model('harisman/Harisman_model','ModelHris');
      $datainsert=array(
        'id_pegawai'        =>$data['id_pegawai'],
        'id_uniq'           =>$data['jenenge'],
        'judul'             =>$data['kt_judul'],
        'id_jns_publikasi'  =>$data['kt_jns_publikasi'],
        'tgl_publikasi'     =>$data['kt_tgl_publikasi'],
        'penerbit'          =>$data['kt_penerbit'],
        'doc_karyatulis'    =>$data['kt_dokumen_karyatulis'], 
        'created_by'        =>$data['created_by'],
        'date_created'      =>date('Y-m-d H:i:s')
      );
      $insertData = $this->ModelHris->db->insert('riwayat_karyatulis',$datainsert);
      if(empty($insertData)){
        $this->response(array('status'=>FALSE,'message'=>'Gagal Insert'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }
    public function UpdateAddKaryaTulis_post()
    {
      $data = $_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $dataInsert=array(
        'id_pegawai'        =>$data['id_pegawai'],
        'id_uniq'           =>$data['jenenge'],
        'judul'             =>$data['kt_judul'],
        'id_jns_publikasi'  =>$data['kt_jns_publikasi'],
        'tgl_publikasi'     =>$data['kt_tgl_publikasi'],
        'penerbit'          =>$data['kt_penerbit'],
        'doc_karyatulis'    =>$data['kt_dokumen_karyatulis'], 
        'created_by'        =>$data['created_by'],
        'date_created'      =>date('Y-m-d H:i:s')
      );
      $updateData = $this->ModelHris->db->update('riwayat_karyatulis',$dataInsert,array('id'=>$data['kt_id']));
      if (empty($updateData)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }
    public function UpdateDocKaryaTulis_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->db->update('riwayat_karyatulis',array('doc_karyatulis'=>$postdata['doc_kt']),array('id_uniq'=>$postdata['jenenge']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataInsert=array(
          'uraian'        => 10, //Pendidikan          
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['nip_npp'],
          'data_sebelum'  =>  $postdata['data_sebelum'],
          'data_sesudah'  =>  $postdata['doc_kt'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->insert('riwayat_perubahan_data',$dataInsert);
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }

    public function UpdateDocKaryaTulisUpdate_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->db->update('riwayat_karyatulis',array('doc_karyatulis'=>$postdata['doc_kt']),array('id'=>$postdata['kt_id']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataUpdate=array(
          'uraian'        => 10,          
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['nip_npp'],
          'data_sebelum'  =>  $postdata['data_sebelum'],
          'data_sesudah'  =>  $postdata['doc_kt'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->update('riwayat_perubahan_data',$dataUpdate,array('kd_uniq'=>$postdata['kt_id_uniq']));
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }
    public function KaryaTulisDelete_post()
    {
      // $data['urutane'] = "1987062820180730031577329001";
      $data = $_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $checkDataJbt = $this->ModelHris->db->get_where('riwayat_karyatulis',array('id_uniq'=>$data['urutane']));
      if(isset($checkDataJbt)){
        $checkDataRiwayatJbt = $this->ModelHris->db->get_where('riwayat_perubahan_data',array('kd_uniq'=>$data['urutane']));
        if(isset($checkDataRiwayatJbt)){
          $deletedDataJbt = $this->ModelHris->db->delete('riwayat_karyatulis',array('id_uniq'=>$data['urutane']));
              if (!$deletedDataJbt){
                  $this->response( array('status'=>false,
                  'message'=>'an expected error trying to delete '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
              } else {
                $deletedDataRiwayatJbt = $this->ModelHris->db->delete('riwayat_perubahan_data',array('kd_uniq'=>$data['urutane']));
                if (!$deletedDataRiwayatJbt){
                  $this->response( array('status'=>false,
                  'message'=>'an expected error trying to delete2 '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $this->response(array('status'=>true,'message'=>'deleted'));
                }
                // $this->response(array('status'=>true,'message'=>'deleted'));
              }
        }else {
          $this->response( array('status'=>false,
            'message'=>'no data found ',REST_Controller::HTTP_CONFLICT));
        }
      } else {
          $this->response( array('status'=>false,
          'message'=>'no data found 2',REST_Controller::HTTP_CONFLICT));
      }
    }

    //menu Penghargaan
    public function getKtSelectJenisPenghargaan_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_kt_select_jenispenghargaan();
      $this->response($result,200);
    }
    public function getDataPenghargaan_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_data_penghargaan();
      $this->response($result,200);
    }

    public function SaveAddPenghargaan_post()
    {
      $data = $_POST;
      // print_r($data);die();
      $this->load->model('harisman/Harisman_model','ModelHris');
      $datainsert=array(
        'id_pegawai'        =>$data['id_pegawai'],
        'id_uniq'           =>$data['jenenge'],
        'id_jns_penghargaan'=>$data['ph_jns_penghargaan'],
        'tgl_sk'            =>$data['ph_tgl_sk'],
        'no_sk'             =>$data['ph_no_sk'],
        'nm_piagam'         =>$data['ph_nm_piagam'],
        'pemberi'           =>$data['ph_pemberi'],
        'doc_penghargaan'   =>$data['ph_dokumen_penghargaan'], 
        'created_by'        =>$data['created_by'],
        'date_created'      =>date('Y-m-d H:i:s')
      );
      $insertData = $this->ModelHris->db->insert('riwayat_penghargaan',$datainsert);
      if(empty($insertData)){
        $this->response(array('status'=>FALSE,'message'=>'Gagal Insert'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }
    public function UpdateAddPenghargaan_post()
    {
      $data = $_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $dataInsert=array(
        'id_pegawai'        =>$data['id_pegawai'],
        'id_uniq'           =>$data['jenenge'],
        'id_jns_penghargaan'=>$data['ph_jns_penghargaan'],
        'tgl_sk'            =>$data['ph_tgl_sk'],
        'no_sk'             =>$data['ph_no_sk'],
        'nm_piagam'         =>$data['ph_nm_piagam'],
        'pemberi'           =>$data['ph_pemberi'],
        'doc_penghargaan'   =>$data['ph_dokumen_penghargaan'], 
        'created_by'        =>$data['created_by'],
        'date_created'      =>date('Y-m-d H:i:s')
      );
      $updateData = $this->ModelHris->db->update('riwayat_penghargaan',$dataInsert,array('id'=>$data['ph_id']));
      if (empty($updateData)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }
    public function UpdateDocPenghargaan_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->db->update('riwayat_penghargaan',array('doc_penghargaan'=>$postdata['doc_ph']),array('id_uniq'=>$postdata['jenenge']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataInsert=array(
          'uraian'        => 12, //Pendidikan          
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['nip_npp'],
          'data_sebelum'  =>  $postdata['data_sebelum'],
          'data_sesudah'  =>  $postdata['doc_ph'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->insert('riwayat_perubahan_data',$dataInsert);
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }

    public function UpdateDocPenghargaanUpdate_post()
    {
      $postdata=$_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->db->update('riwayat_penghargaan',array('doc_penghargaan'=>$postdata['doc_ph']),array('id'=>$postdata['ph_id']));
      if (empty($result)){
        $this->response( array('status'=>FALSE,
        'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $dataUpdate=array(
          'uraian'        => 12,          
          'kd_uniq'       =>  $postdata['jenenge'],
          'nip_npp'       =>  $postdata['nip_npp'],
          'data_sebelum'  =>  $postdata['data_sebelum'],
          'data_sesudah'  =>  $postdata['doc_ph'],
          'created_by'    =>  $postdata['created_by'],
          'date_update'   =>  date('Y-m-d H:i:s')
        );
        $insertUpdate = $this->ModelHris->db->update('riwayat_perubahan_data',$dataUpdate,array('kd_uniq'=>$postdata['ph_id_uniq']));
        if (empty($insertUpdate)){
          $this->response( array('status'=>FALSE,
          'message'=>'Gagal'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }else{
          $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
        }
      }
    }
    public function PenghargaanDelete_post()
    {
      // $data['urutane'] = "1987062820180730031577329001";
      $data = $_POST;
      $this->load->model('harisman/Harisman_model','ModelHris');
      $checkDataJbt = $this->ModelHris->db->get_where('riwayat_penghargaan',array('id_uniq'=>$data['urutane']));
      if(isset($checkDataJbt)){
        $checkDataRiwayatJbt = $this->ModelHris->db->get_where('riwayat_perubahan_data',array('kd_uniq'=>$data['urutane']));
        if(isset($checkDataRiwayatJbt)){
          $deletedDataJbt = $this->ModelHris->db->delete('riwayat_penghargaan',array('id_uniq'=>$data['urutane']));
              if (!$deletedDataJbt){
                  $this->response( array('status'=>false,
                  'message'=>'an expected error trying to delete '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
              } else {
                $deletedDataRiwayatJbt = $this->ModelHris->db->delete('riwayat_perubahan_data',array('kd_uniq'=>$data['urutane']));
                if (!$deletedDataRiwayatJbt){
                  $this->response( array('status'=>false,
                  'message'=>'an expected error trying to delete2 '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $this->response(array('status'=>true,'message'=>'deleted'));
                }
                // $this->response(array('status'=>true,'message'=>'deleted'));
              }
        }else {
          $this->response( array('status'=>false,
            'message'=>'no data found ',REST_Controller::HTTP_CONFLICT));
        }
      } else {
          $this->response( array('status'=>false,
          'message'=>'no data found 2',REST_Controller::HTTP_CONFLICT));
      }
    }





    //absensi
    public function absensi_save_post()
    {
      $data = $_POST;
      // print_r($data);die();
      $this->load->model('harisman/Harisman_model','ModelHris');
      $datainsert=array(
        'id_pegawai'    =>$data['id_pegawai'],
        'jam_absen'     =>date('Y-m-d H:i:s'),
        'in_out_absen'  =>$data['jenis_absen'],
        'tgl_kerja'     =>date('Y-m-d'),
        'keterangan'    =>$data['keterangan']
      );
      $insertData = $this->ModelHris->db->insert('riwayat_absen',$datainsert);
      if(empty($insertData)){
        $this->response(array('status'=>FALSE,'message'=>'Gagal Insert'),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else{
        $this->response(array('status'=>TRUE,'message'=>'Sukses'),200);
      }
    }

    public function getDataAbsen_post()
    {
      $this->load->model('harisman/Harisman_model','ModelHris');
      $result = $this->ModelHris->get_data_absensi();
      $this->response($result,200);
    }
}
