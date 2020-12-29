<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config = array(
    'users_post' => array(
        array('field' => 'nama_pegawai', 'label'=> 'nama_pegawai', 'rules'=> 'trim|required'),
    ),
    'pbjCatatan_post' => array(
      // array('field' => 'kd_pbjNok', 'label'=> 'kd_pbjNok', 'rules'=> 'trim|required'),
      // array('field' => 'nama_pbjNok', 'label'=> 'nama_pbjNok', 'rules'=> 'trim|required'),
      array('field' => 'catatan_nok', 'label'=> 'catatan_nok', 'rules'=> 'trim|required'),
    ),

    'pbjInberkas_post' => array(
      // array('field' => 'kd_pbjNok', 'label'=> 'kd_pbjNok', 'rules'=> 'trim|required'),
      array('field' => 'nama_pbjIn', 'label'=> 'nama_pbjIn', 'rules'=> 'trim|required'),
      // array('field' => 'catatan_nok', 'label'=> 'catatan_nok', 'rules'=> 'trim|required'),
    ),

    'pbjOkberkas_post' => array(
      // array('field' => 'kd_pbjNok', 'label'=> 'kd_pbjNok', 'rules'=> 'trim|required'),
      array('field' => 'nama_pbjOk', 'label'=> 'nama_pbjOk', 'rules'=> 'trim|required'),
      // array('field' => 'catatan_nok', 'label'=> 'catatan_nok', 'rules'=> 'trim|required'),
    ),
    'pbjOkberkasCheck_post' => array(
      // array('field' => 'kd_pbjNok', 'label'=> 'kd_pbjNok', 'rules'=> 'trim|required'),
      array('field' => 'id_data', 'label'=> 'id_data', 'rules'=> 'trim|required'),
      // array('field' => 'catatan_nok', 'label'=> 'catatan_nok', 'rules'=> 'trim|required'),
    ),

    'usersdelete_post' => array(
        array('field' => 'nip', 'label'=> 'nip', 'rules'=> 'trim|required'),
    ),

    'pbj_save_post' => array(
      array('field' => 'id_data', 'label'=> 'id_data','rules'=>'trim|required'),
      array('field' => 'nm_project', 'label'=> 'nm_project','rules'=>'trim|required'),
      array('field' => 'type', 'label'=> 'type','rules'=>'trim|required'),
      array('field' => 'estimasi_biaya', 'label'=> 'estimasi_biaya','rules'=>'trim|required'),
      // array('field' => 'estimasi_durasi', 'label'=> 'estimasi_durasi','rules'=>'trim|required'),
      array('field' => 'ppk', 'label'=> 'ppk','rules'=>'trim|required'),
      array('field' => 'data_nd', 'label'=> 'data_nd','rules'=>'trim|required'),
    ),

    'perspective_post' => array(
        array('field' => 'nm_pers', 'label'=> 'nama perspective', 'rules'=> 'trim|required'),
        array('field' => 'bobot', 'label'=> 'bobot', 'rules'=> 'trim|required'),
        array('field' => 'info', 'label'=> 'info', 'rules'=> 'trim|required'),
        // array('field' => 'det_stat', 'label'=> 'detail status', 'rules'=> 'trim|required'),
        array('field' => 'tahun', 'label'=> 'Tahun', 'rules'=> 'trim|required'),
        array('field' => 'status', 'label'=> 'Status', 'rules'=> 'trim|required'),
    ),
    'ss_post' => array(
        array('field' => 'id_per', 'label'=> 'perspective', 'rules'=> 'trim|required'),
        array('field' => 'nm_ss', 'label'=> 'sasaran strategis', 'rules'=> 'trim|required'),
        array('field' => 'info', 'label'=> 'Info', 'rules'=> 'trim|required'),
        array('field' => 'jabatan', 'label'=> 'Jabatan', 'rules'=> 'trim|required'),
        array('field' => 'tahun', 'label'=> 'tahun', 'rules'=> 'trim|required'),
        array('field' => 'status', 'label'=> 'status', 'rules'=> 'trim|required'),
    ),
    'iku_post' => array(
        // array('field' => 'id_iku', 'label'=> 'ID Iku', 'rules'=> 'trim|required'),
        array('field' => 'kd_iku', 'label'=> 'Kode IKU', 'rules'=> 'trim|required'),
        array('field' => 'id_ss', 'label'=> 'Sasaran strategis', 'rules'=> 'trim|required'),
        // array('field' => 'id_per', 'label'=> 'Perspective', 'rules'=> 'trim|required'),
        array('field' => 'nm_iku', 'label'=> 'IKU', 'rules'=> 'trim|required'),
        // array('field' => 'info', 'label'=> 'info', 'rules'=> 'trim|required'),
        array('field' => 'target_tahun', 'label'=> 'target_tahun', 'rules'=> 'trim|required'),
        // array('field' => 'satuan_tahun', 'label'=> 'satuan_tahun', 'rules'=> 'trim|required'),
        array('field' => 'target_numerik', 'label'=> 'target_numerik', 'rules'=> 'trim|required'),
        array('field' => 'satuan_numerik', 'label'=> 'satuan_numerik', 'rules'=> 'trim|required'),
        array('field' => 'jabatan_iku', 'label'=> 'jabatan', 'rules'=> 'trim|required'),
        array('field' => 'tahun_iku', 'label'=> 'tahun', 'rules'=> 'trim|required'),
        array('field' => 'status_iku', 'label'=> 'status', 'rules'=> 'trim|required'),

    ),
    'iku_realisasi_post' => array(
        // array('field' => 'id_iku', 'label'=> 'ID Iku', 'rules'=> 'trim|required'),
        array('field' => 'realisasi_numerik', 'label'=> 'realisasi numerik', 'rules'=> 'trim|required'),
        // array('field' => 'sat_num_realisasi', 'label'=> 'satuan numerik', 'rules'=> 'trim|required'),

    ),

);

?>
