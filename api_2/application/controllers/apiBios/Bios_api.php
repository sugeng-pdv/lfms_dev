<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class bios_api extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function view_data_lainnya_post()
    {
      $postdata=($_POST);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      $this->load->model('BiosG2/ApiBios_model','BiosModel');
      $data = $this->post();
      $result= $this->BiosModel->getDataLainnya();
      $this->response($result,200);
    }
    function simpan_data_lainnya_post()
    {
      $postdata = ($_POST);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      // $this->dbBios = $this->load->database('db_perjadin',true);
      $this->load->model('BiosG2/ApiBios_model','BiosModel');
      $data = $this->post();
      $dataInsert = array( 
        'satker' =>$this->post('satker'),
        'tahun' =>$this->post('tahun'),
        'bulan' =>$this->post('bulan'),
        'kd_indikator' =>$this->post('kd_indikator'),
        'jumlah' =>$this->post('jumlah'),
        'tgl_transaksi' =>$this->post('tgl_transaksi'),
        'tgl_update' =>$this->post('tgl_update'),
        'operator' =>$this->post('operator')
      );
      $checkData = $this->BiosModel->db->get_where('data_lainnya',array('satker'=>$this->post('satker'),'tahun'=>$this->post('tahun'),'bulan'=>$this->post('bulan'),'kd_indikator'=>$this->post('kd_indikator'),'tgl_transaksi'=>$this->post('tgl_transaksi')));
      // print_r($checkData->num_rows());die();
      if($checkData->num_rows() == 0){
        // print_r("Kosong");die();
        $data_id = $this->BiosModel->db->insert('data_lainnya',$dataInsert);
      }else{
        // print_r("Isi");die();
        $data_id = $this->BiosModel->db->update('data_lainnya',$dataInsert,array('satker'=>$this->post('satker'),'tahun'=>$this->post('tahun'),'bulan'=>$this->post('bulan'),'kd_indikator'=>$this->post('kd_indikator'),'tgl_transaksi' =>$this->post('tgl_transaksi')));
      }
      if (!$data_id){
        $this->response(array('status'=>'failure','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      } else {
        $this->response(array('status'=>'success','message'=>'Sukses Input Data'));
      }
    }
    function view_penerimaan_post()
    {
      $postdata=($_POST);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      $this->load->model('BiosG2/ApiBios_model','BiosModel');
      $data = $this->post();
      $result= $this->BiosModel->getPenerimaan();
      $this->response($result,200);
    }
    function simpan_penerimaan_post()
    {
      $postdata = ($_POST);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      // $this->dbBios = $this->load->database('db_perjadin',true);
      $this->load->model('BiosG2/ApiBios_model','BiosModel');
      $data = $this->post();
      $dataInsert = array( 
        'satker' =>$this->post('satker'),
        // 'tahun' =>$this->post('tahun'),
        // 'bulan' =>$this->post('bulan'),
        'kd_akun' =>$this->post('kd_akun'),
        'jumlah' =>$this->post('jumlah'),
        'tgl_transaksi' =>$this->post('tgl_transaksi'),
        'tgl_update' =>$this->post('tgl_update'),
        'operator' =>$this->post('operator')
      );
      // $checkData = $this->BiosModel->db->get_where('penerimaan',array('satker'=>$this->post('satker'),'kd_akun'=>$this->post('kd_akun'),'tgl_transaksi'=>$this->post('tgl_transaksi')));
      // if($checkData->num_rows() == 0){
        $data_id = $this->BiosModel->db->insert('penerimaan',$dataInsert);
      // }else{
      //   $data_id = $this->BiosModel->db->update('penerimaan',$dataInsert,array('satker'=>$this->post('satker'),'kd_akun'=>$this->post('kd_akun'),'tgl_transaksi' =>$this->post('tgl_transaksi')));
      // }
      if (!$data_id){
        $this->response(array('status'=>'failure','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      } else {
        $this->response(array('status'=>'success','message'=>'Sukses Input Data'));
      }
    }
    function view_pengeluaran_post()
    {
      $postdata=($_POST);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      $this->load->model('BiosG2/ApiBios_model','BiosModel');
      $data = $this->post();
      $result= $this->BiosModel->getPengeluaran();
      $this->response($result,200);
    }
    function simpan_pengeluaran_post()
    {
      $postdata = ($_POST);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      // $this->dbBios = $this->load->database('db_perjadin',true);
      $this->load->model('BiosG2/ApiBios_model','BiosModel');
      $data = $this->post();
      $dataInsert = array( 
        'satker' =>$this->post('satker'),
        // 'tahun' =>$this->post('tahun'),
        // 'bulan' =>$this->post('bulan'),
        'kd_akun' =>$this->post('kd_akun'),
        'jumlah' =>$this->post('jumlah'),
        'tgl_transaksi' =>$this->post('tgl_transaksi'),
        'tgl_update' =>$this->post('tgl_update'),
        'operator' =>$this->post('operator')
      );
      $checkData = $this->BiosModel->db->get_where('pengeluaran',array('satker'=>$this->post('satker'),'kd_akun'=>$this->post('kd_akun'),'tgl_transaksi'=>$this->post('tgl_transaksi')));
      if($checkData->num_rows() == 0){
        $data_id = $this->BiosModel->db->insert('pengeluaran',$dataInsert);
      }else{
        $data_id = $this->BiosModel->db->update('pengeluaran',$dataInsert,array('satker'=>$this->post('satker'),'kd_akun'=>$this->post('kd_akun'),'tgl_transaksi' =>$this->post('tgl_transaksi')));
      }
      if (!$data_id){
        $this->response(array('status'=>'failure','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      } else {
        $this->response(array('status'=>'success','message'=>'Sukses Input Data'));
      }
    }

    function view_saldo_post()
    {
      $postdata=($_POST);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      $this->load->model('BiosG2/ApiBios_model','BiosModel');
      $data = $this->post();
      $result= $this->BiosModel->getSaldo();
      $this->response($result,200);
    }
    function simpan_saldo_post()
    {
      $postdata = ($_POST);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      // $this->dbBios = $this->load->database('db_perjadin',true);
      $this->load->model('BiosG2/ApiBios_model','BiosModel');
      $data = $this->post();
      $dataInsert = array( 
        'satker' =>$this->post('satker'),
        'kd_bank' =>$this->post('kd_bank'),
        'norek' =>$this->post('norek'),
        'saldo' =>$this->post('saldo'),
        'kd_rek' =>$this->post('kd_rek'),
        'tgl_transaksi' =>$this->post('tgl_transaksi'),
        'tgl_update' =>$this->post('tgl_update'),
        'operator' =>$this->post('operator')
      );
      $checkData = $this->BiosModel->db->get_where('saldo',array('satker'=>$this->post('satker'),'kd_bank'=>$this->post('kd_bank'),'norek'=>$this->post('norek'),'kd_rek'=>$this->post('kd_rek'),'tgl_transaksi'=>$this->post('tgl_transaksi')));
      if($checkData->num_rows() == 0){
        $data_id = $this->BiosModel->db->insert('saldo',$dataInsert);
      }else{
        $data_id = $this->BiosModel->db->update('saldo',$dataInsert,array('satker'=>$this->post('satker'),'kd_bank'=>$this->post('kd_bank'),'norek'=>$this->post('norek'),'kd_rek'=>$this->post('kd_rek'),'tgl_transaksi'=>$this->post('tgl_transaksi')));
      }
      if (!$data_id){
        $this->response(array('status'=>'failure','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      } else {
        $this->response(array('status'=>'success','message'=>'Sukses Input Data'));
      }
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

}
