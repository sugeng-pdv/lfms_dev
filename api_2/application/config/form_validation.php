<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config = array(
    'users_post' => array(
        array('field' => 'nama_pegawai', 'label'=> 'nama_pegawai', 'rules'=> 'trim|required'),
    ),
    'usersPpk_post' => array(
        array('field' => 'nip', 'label'=> 'nip', 'rules'=> 'trim|required'),
    ),
    'usersEditPpk_post' => array(
        array('field' => 'nip', 'label'=> 'nip', 'rules'=> 'trim|required'),
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
    'pbjOkRevberkas_post' => array(
      // array('field' => 'kd_pbjNok', 'label'=> 'kd_pbjNok', 'rules'=> 'trim|required'),
      array('field' => 'nama_pbjOkRev', 'label'=> 'nama_pbjOkRev', 'rules'=> 'trim|required'),
      // array('field' => 'catatan_nok', 'label'=> 'catatan_nok', 'rules'=> 'trim|required'),
    ),
    'pbjOkberkasCheckFlag_post' => array(
      // array('field' => 'kd_pbjNok', 'label'=> 'kd_pbjNok', 'rules'=> 'trim|required'),
      array('field' => 'id_pbj', 'label'=> 'id_data', 'rules'=> 'trim|required'),
      // array('field' => 'catatan_nok', 'label'=> 'catatan_nok', 'rules'=> 'trim|required'),
    ),
    'pbjOkberkasCheck_post' => array(
      // array('field' => 'kd_pbjNok', 'label'=> 'kd_pbjNok', 'rules'=> 'trim|required'),
      array('field' => 'id_data', 'label'=> 'id_data', 'rules'=> 'trim|required'),
      // array('field' => 'catatan_nok', 'label'=> 'catatan_nok', 'rules'=> 'trim|required'),
    ),
    'pbjUploadberkasCheck_post' => array(
      // array('field' => 'kd_pbjNok', 'label'=> 'kd_pbjNok', 'rules'=> 'trim|required'),
      array('field' => 'kd_pbj2', 'label'=> 'kd_pbj2', 'rules'=> 'trim|required'),
      // array('field' => 'catatan_nok', 'label'=> 'catatan_nok', 'rules'=> 'trim|required'),
    ),

    'usersdelete_post' => array(
        array('field' => 'nip', 'label'=> 'nip', 'rules'=> 'trim|required'),
    ),

    'pbj_save_post' => array(
      array('field' => 'id_data_pbj', 'label'=> 'id_data','rules'=>'trim|required'),
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

    //add iku penilaian_post
    'penilaian_post' => array(
        array('field' => 'nm_pertanyaan', 'label'=> 'pertanyaan', 'rules'=> 'trim|required'),
        array('field' => 'status', 'label'=> 'Status', 'rules'=> 'trim|required'),
    ),
    'kk_post' => array(
        array('field' => 'no_kk', 'label'=> 'No KK', 'rules'=> 'trim|required'),
        array('field' => 'nip_pegawai', 'label'=> 'NIP KK', 'rules'=> 'trim|required'),
        array('field' => 'JnsKk', 'label'=> 'Jenis KK', 'rules'=> 'trim|required'),
        array('field' => 'TypeKk', 'label'=> 'Tipe KK', 'rules'=> 'trim|required'),
        array('field' => 'TglKkMulai', 'label'=> 'Tanggal Mulai', 'rules'=> 'trim|required'),
        array('field' => 'TglKkSelesai', 'label'=> 'Tanggal Selesai', 'rules'=> 'trim|required'),
        array('field' => 'ThnKk', 'label'=> 'Tahun KK', 'rules'=> 'trim|required'),

    ),
    'vms_post' => array(
        array('field' => 'id_no_vendor', 'label'=> 'id_no_vendor', 'rules'=> 'trim|required'),
        array('field' => 'kd_vendor', 'label'=> 'kd_vendor', 'rules'=> 'trim|required'),
        array('field' => 'nm_vendor', 'label'=> 'nm_vendorK', 'rules'=> 'trim|required'),
        array('field' => 'npwp', 'label'=> 'npwp', 'rules'=> 'trim|required'),
        array('field' => 'alamat', 'label'=> 'alamat', 'rules'=> 'trim|required'),
        array('field' => 'kota', 'label'=> 'kota', 'rules'=> 'trim|required'),
        array('field' => 'no_tlp', 'label'=> 'no_tlp', 'rules'=> 'trim|required'),
        array('field' => 'email', 'label'=> 'email', 'rules'=> 'trim|required'),
    ),
    // Array ( [DetBtn] => Simpan [id_vendor] => hj [kd_vendor] => bh [nm_vendor] => jbb [klasifikasi] => hb [kualifikasi_perusahaan] => hbh [npwp] => bhb [alamat] => hb [kota] => hb [no_tlp] => hb [no_fax] => hbh [no_hp] => bh [email] => bh [nm_pic] => bh [jbt_pic] => bh [NoHp_pic] => bhb [no_rek] => hb [nm_bank] => hb [cabang_bank] => hbh [alat_angkut] => 2 )
    //add iku penilaian_post
    'q_vms_post' => array(
      array('field' => 'nm_pertanyaan', 'label'=> 'Pertanyaan', 'rules'=> 'trim|required'),
      array('field' => 'id_akses', 'label'=> 'ID Akses', 'rules'=> 'trim|required'),
      array('field' => 'status', 'label'=> 'Status', 'rules'=> 'trim|required'),
  ),
);

?>
