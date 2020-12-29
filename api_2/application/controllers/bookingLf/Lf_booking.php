<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Lf_booking extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }


    function search_post() {
      $postdata = ($_POST);
      // print_r($postdata);die();
      $this->load->model('Pbj_model');
      if (isset($postdata)) {
        // echo "stsdsadring";die();
        $result= $this->Pbj_model->getData($postdata);
      } else {
        // echo "..,,,,,,";die();
        $result= $this->Pbj_model->get_all();
      }
      $this->response($result, 200);
    }

    function SearchTglLangsung_post() {
      $postdata = ($_POST);
      $dataTgl = $postdata;
      // print_r($dataTgl);die();
      $this->load->model('LfBooking/Booking_model');
      if (isset($postdata)) {
        $result= $this->Booking_model->getTanggalLangsung($dataTgl);
      } else {
        $result= $this->Booking_model->getTanggalLangsung($dataTgl);
      }
      $this->response($result, 200);
    }
    function SearchTglBerkas_post() {
      $postdata = ($_POST);
      $dataTgl = $postdata;
      // print_r($dataTgl);die();
      $this->load->model('LfBooking/Booking_model');
      if (isset($postdata)) {
        $result= $this->Booking_model->getTanggalBerkasAntrian($dataTgl);
      } else {
        $result= $this->Booking_model->getTanggalBerkasAntrian($dataTgl);
      }
      $this->response($result, 200);
    }
    //SearchTglLibur
    function SearchTglLibur_post() {
      $postdata = ($_POST);
      $dataTgl = $postdata;
      // print_r($dataTgl);die();
      $this->load->model('LfBooking/Booking_model');
      if (isset($postdata)) {
        $result= $this->Booking_model->getTanggalLibur($dataTgl);
      } else {
        $result= $this->Booking_model->getTanggalLibur($dataTgl);
      }
      $this->response($result, 200);
    }
    //SearchTglLiburList
    function SearchTglLiburList_post() {
      $postdata = ($_POST);
      $dataTgl = $postdata;
      // print_r($dataTgl);die();
      $this->load->model('LfBooking/Booking_model');
      if (isset($postdata)) {
        $result= $this->Booking_model->getTanggalLiburList($dataTgl);
      } else {
        $result= $this->Booking_model->getTanggalLiburList($dataTgl);
      }
      $this->response($result, 200);
    }
    function SaveBooking_post()
    {
      // print_r("jsdbhsbfjd");die();
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      $this->db_book = $this->load->database('db_lfbooking',true);
      // if($this->form_validation->run('booking_save_post') != false){
          $this->load->model('LfBooking/Booking_model');
          $data = $this->post();
          $dateCreate = date("Y-m-d H:i:s");
          $dataInsert = array(
            'id_kode' => $this->input->post('id_kode'),
            'kd_kalender' => $this->input->post('kode'),
            'jns_booking' => $this->input->post('cmbJenis'),
            'jns_sektor' => $this->input->post('cmbSektor'),
            'title' => $this->input->post('title'),
            'jml_ugr' => $this->input->post('jml_ugr'),
            'no_surat' => $this->input->post('no_surat'),
            'jml_bidang' => $this->input->post('jml_bidang'),
            'description' => $this->input->post('description'),
            'color' => "#efe62b",
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'start_week' => $this->input->post('week'),
            'instansi' => $this->input->post('instansi'),
            'create_at' => $dateCreate,
            'create_by' => $this->input->post('sess_usr'),
            'modified_at' => $this->input->post(''),
            'modified_by' => $this->input->post('')
          );
          // print_r($dataInsert);die();
          // $safe_data = $this->Booking_model->get(array('id_pbj'=>$this->post('id_pbj')));
          // if(!isset($safe_data)){
          //     $this->response( array('status'=>'failure',
          //     'message'=>'the specified no data to update',REST_Controller::HTTP_CONFLICT));
          // }
          $data_id = $this->Booking_model->db_book->insert('kalender',$dataInsert);
          if (!$data_id){
              $this->response( array('status'=>FALSE,'notif'=>'Server wrong, please save again'));
              // 'notif'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status'=>TRUE,'notif'=>'Sukses Mengajukan Appoinment'));
          }
      // } else {
      //     $this->response( array('status'=>'failure',
      //     'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
      // }
    }
    function test_tgl_berkas_post()
    {
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $this->db_book = $this->load->database('db_lfbooking',true);
      $tglAkhirTmp2 ="2019-11-12";
      $checkBerkasHArian = $this->ModelBooking->getJumlahBerkasHarian($tglAkhirTmp2);
      if(!isset($checkBerkasHArian[0]['dataJam']))
      {
        print_r("----Tidak Ada");
      }else{
        print_r(round($checkBerkasHArian[0]['dataJam']));die();
      }
    }
    function text_berkas_tgl_post()
    {
      
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $this->db_book = $this->load->database('db_lfbooking',true);
      $data['start'] ="2019-11-11";
      $checkBerkasHArian = $this->ModelBooking->getTanggalBerkasAntrian($data);
      if(!isset($checkBerkasHArian[0]['dataJam']))
      {
        print_r("----Tidak Ada");
      }else{
        print_r(round($checkBerkasHArian[0]['dataJam']));die();
      }
    }
    //DateUpdateAvailable
    function DateUpdateAvailable_post()
    {
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $this->db_book = $this->load->database('db_lfbooking',true);
      $data = $this->post();
      $dateCreate = date("Y-m-d H:i:s");
      $dataTtlHari = $data['ttl_hariAll'];
      $tglStart = $data['start_date'];
      $data['start'] = $data['start_date'];
      $checkTgl = $this->ModelBooking->getTanggalBerkasAntrian($data);
      
      if($checkTgl[0]['dataJam'] < $data['jumlah_Loket_total'] ){
          $updateAvailable = $this->ModelBooking->db_book->update('tbl_cek_tgl',array('tgl_setting'=>$tglStart),array('id_cek'=>2));
      }else {
        $tglStart2 = date('Y-m-d', strtotime('+1 days', strtotime($tglStart)));
          $data['start'] = $tglStart2;
          $totalHariTmp = $dataTtlHari;
          // $checkTgl = $this->ModelBooking->getTanggalBerkasAntrian($data);
          $i = 0;
          $i2 = 0;
          $i3 = 0;
          $sum = 0;
          $angka = 0;
          $jumlahLibur =0;
          $statusAwal = FALSE;
          $statusAkhir = TRUE;
          $tanggalAKhirLibur ="";
          do
          {
            $pecahTglStart2 = explode("-", $tglStart2);
            $tgl2 = $pecahTglStart2[2];
            $bln2 = $pecahTglStart2[1];
            $thn2 = $pecahTglStart2[0];

            $tanggal = date("w", mktime(0, 0, 0,$bln2, $tgl2+$i, $thn2));
            if ($tanggal == 5)
             {
               $tglAkhirTmp2 = date('Y-m-d', strtotime('+'.($i+3).' days', strtotime($tglStart2)));
               $angka = 3;
               $a= "Jumat";
               $i+=4;
             }else{
               $tglAkhirTmp2 = date('Y-m-d', strtotime('+'.$i.' days', strtotime($tglStart2)));
               $a= " Bukan Jumat";
               $i++;
             }
             // $i++;
             $dataInsert['start_date']=$tglAkhirTmp2;
             $dataInsert['end_date']=$tglAkhirTmp2;
             $dataInsert['status_tampil']=1;

             $dataCheck = $this->ModelBooking->checkLibur($tglAkhirTmp2);
             if($dataCheck>0){
               $jumlahLibur++;
               $tanggalAKhirLibur = $tglAkhirTmp2;
             }else {
               $checkBerkasHArian = $this->ModelBooking->getJumlahBerkasHarian($tglAkhirTmp2);
               //check total bekas per hari
               $dataTotalPerhari = ($data['total_berkas_per_hari']-5);
               if(($checkBerkasHArian[0]['dataJam'] < $dataTotalPerhari) && isset($checkBerkasHArian[0]['dataJam'])){
                 $updateAvailable = $this->ModelBooking->db_book->update('tbl_cek_tgl',array('tgl_setting'=>$tglAkhirTmp2),array('id_cek'=>2));
                 $statusAkhir = FALSE;
               }else{
                 $tglAkhirTmp2 = date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirTmp2)));
                 $statusAkhir = TRUE;
               }
             }
             $i2++;
             // echo "angka ".$i2." Tanggal -".$tglAkhirTmp2."--- ".$a." Jumlah Libur ".$jumlahLibur."<br>";
          }
          while ($statusAwal != $statusAkhir);
          // while ($i2 != $totalHariTmp);
          if($jumlahLibur>0)
          {
            $tglStart2 =  date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirTmp2)));;
            $totalHariTmp = $jumlahLibur;
            $tglAkhirTmp = date('Y-m-d', strtotime('+'.$totalHariTmp.' days', strtotime($tglStart2)));
            $hitung = 0;
            $hitung2 = 0;
            // counter untuk jumlah hari jumat
            $sum = 0;
            $angka = 0;
            $jumlahLibur =0;
            do
            {
              $pecahTglStartLbrCheck = explode("-", $tglStart2);
              $tglCheckLbr = $pecahTglStartLbrCheck[2];
              $blnCheckLbr = $pecahTglStartLbrCheck[1];
              $thnCheckLbr = $pecahTglStartLbrCheck[0];

              $tanggal = date("w", mktime(0, 0, 0,$blnCheckLbr, $tglCheckLbr+$hitung, $thnCheckLbr));
              if ($tanggal == 5)
              {
                $tglAkhirLibur = date('Y-m-d', strtotime('+'.($hitung+3).' days', strtotime($tglStart2)));
                $angka = 3;
                $a= "Jumat";
                $hitung+=4;
              }else{
                $tglAkhirLibur = date('Y-m-d', strtotime('+'.$hitung.' days', strtotime($tglStart2)));
                // $tglAkhirTmp6 = date('Y-m-d', strtotime('+'.$hitung.' days', strtotime($tglStart)));
                $angka = 1;
                $a= " Bukan Jumát";
                $hitung++;
              }
              $updateAvailable = $this->ModelBooking->db_book->update('tbl_cek_tgl',array('tgl_setting'=>$tglAkhirLibur),array('id_cek'=>2));
              $hitung2++;
              $angka2 =$angka+$hitung;
              // echo "angka ".$hitung2." Tanggal -".$tglAkhirLibur."--- ".$a." Jumlah Libur ".$jumlahLibur."<br>";
            }
            while ($hitung2 != $totalHariTmp);
          }
        }
    }
    //Check jam ke dari berkas
    function check_jam_berkas_post()
    {
      $postdata = ($_POST);
      $dataTgl = $postdata;
      // print_r($dataTgl);die();
      $this->load->model('LfBooking/Booking_model');
      $result = $this->Booking_model->checkJam($postdata['start_date'],$postdata['id_loket']);
      // print_r($result[0]['dataJam']);die();
      $this->response($result, 200);
    }
    // SaveBookingBerkas
  function SaveBookingBerkas1_new_post()
  {
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      $this->db_book = $this->load->database('db_lfbooking',true);
      // if($this->form_validation->run('booking_save_post') != false){
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $DataPenyerahanBerkas = $this->ModelBooking->get_data_konfigurasi(2);
		  $jumlah_per_jam = $DataPenyerahanBerkas[0]['jumlah_per_jam']; 
		  $jumlah_jam_kerja = $DataPenyerahanBerkas[0]['jumlah_jam_kerja'];
		  $total_per_hari = ($DataPenyerahanBerkas[0]['jumlah_per_jam']*$DataPenyerahanBerkas[0]['jumlah_jam_kerja']);
      // print_r($DataPenyerahanBerkas);die();
      $data = $this->post();
      $dateCreate = date("Y-m-d H:i:s");
      $dataTtlHari = $data['ttl_hariAll'];
      $tglStart = $data['start_date'];
      $totalHari = $data['ttl_hariAll'];
      $kodeStatus = $data['kode_hitung'];
      $tgl_bulat  = $data['start_date'];
      $tgl_akhir  = $data['start_date'];
      //kondisi untuk kode hitung 2 dan 3
      $sisa_bulat = FALSE;
      //deafult sisa hari di Awal
      $sisa_awal = FALSE;
      //deafult sisa hari di akhir
      $sisa_akhir =TRUE;
      if($data['ttl_hariAll'] >= 3)
      {
        //Check Status jika kode hitung 2
        if($data['kode_hitung'] == 2){
          $sisa_bulat = TRUE;
          if($data['ttl_jamFix'] == 0)
          {
            $sisa_akhir = FALSE;
          }else{
            $sisa_akhir = TRUE;
            $data['ttl_hariAll'] = $data['ttl_hariAll']-1;
          }
        }
        //Check Status jika kode hitung 3
        if($data['kode_hitung'] ==3)
        {
          $sisa_awal = TRUE;
          // $sisa_bulat = TRUE;
          $sisa_bulat = TRUE;
          $tgl_bulat  = date('Y-m-d', strtotime('+1 days', strtotime($data['start_date'])));
          if($data['ttl_jamFix'] == 0)
          {
            $sisa_akhir = FALSE;
            $data['ttl_hariAll'] = $data['ttl_hariAll']-1;
          }else{
            $sisa_akhir = TRUE;
            $data['ttl_hariAll'] = $data['ttl_hariAll']-2;
          }
        }
      }elseif($data['ttl_hariAll'] == 2)
      {
        //Check Status jika kode hitung 2
        if($data['kode_hitung']==2)
        {
          if($data['ttl_jamFix']==0)
          {
            $sisa_bulat = TRUE;
            $sisa_akhir = FALSE;
          }else{
            $sisa_bulat = TRUE;
            $sisa_akhir = TRUE;
            $data['ttl_hariAll'] = $data['ttl_hariAll']-1;
            $tgl_akhir  = date('Y-m-d', strtotime('+1 days', strtotime($data['start_date'])));
            // $tgl_akhir  = date('Y-m-d', strtotime('+1 days', strtotime($data['start_date'])));
          }
        }
        //Check Status jika kode hitung 3
        if($data['kode_hitung']==3)
        {
          $sisa_alwal = TRUE;
          if($data['ttl_jamFix']==0)
          {
            $sisa_bulat = TRUE;
            $sisa_akhir = FALSE;
          }else{
            $sisa_bulat = FALSE;
            $sisa_akhir = TRUE;
            $data['ttl_hariAll'] = $data['ttl_hariAll']-1;
          }
        }
      }else{
        $sisa_awal = FALSE;
        $sisa_bulat = FALSE;
        $sisa_akhir = FALSE;
      }
      if($data['ttl_jamFix']==0)
      {
        $sisa_akhir=FALSE;
      }
      if($data['kode_hitung'] == 3)
      {
        $sisa_awal = TRUE;
      }
      $dataInsert = array(
        'id_kode' => $this->input->post('id_kode'),
        'kd_kalender' => $this->input->post('kode'),
        'jns_booking' => $this->input->post('cmbJenis'),
        'jns_sektor' => $this->input->post('cmbSektor'),
        'title' => $this->input->post('title'),
        'jml_ugr' => $this->input->post('jml_ugr'),
        'no_surat' => $this->input->post('no_surat'),
        'jml_bidang' => $this->input->post('jml_bidang'),
        'jml_non_bidang' => $this->input->post('jml_non_bidang'),
        'description' => $this->input->post('description'),
        'color' => "#efe62b",
        'instansi' => $this->input->post('instansi'),
        'status_approval' => 1,
        'create_at' => $dateCreate,
        'create_by' => $this->input->post('sess_usr'),
        'modified_at' => $this->input->post(''),
        'modified_by' => $this->input->post('')
      );
      $dataInsert['start_date']=$this->input->post('start_date');
      $dataInsert['end_date']=$this->input->post('start_date');
      $dataInsert['status_tampil']=1;
      $status_loket=0;
      // print_r($sisa_awal."_".$sisa_bulat."_".$sisa_akhir);die();
      if($kodeStatus == 1){
        $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
        if (!$data_id){
          $this->response( array('status'=>FALSE,'notif'=>'Server wrong, please save again','token'=>''));
        }else{
          if($data['ttl_jamFix'] == $jumlah_jam_kerja)
          {
            $status_loket=1;
          }
          $insertAntrian = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$data['start_date'],'jml_bidang'=>$data['jml_bidang'],'jml_jam'=>$data['ttl_jamFix'],'jam_start'=>1,'jam_end'=>$data['ttl_jamFix'],'status_antrian'=>1,'status_loket'=>$status_loket));
          // print_r($data);die();
              // if(!$insertAntrian){
              //   $this->response( array('status'=>FALSE,'notif'=>'Server wrong, please save again','token'=>$data['kode_enc']));
              // }else {
              //   $this->response(array('status'=>TRUE,'notif'=>'Sukses Insert Data','token'=>$data['kode_enc']));
              // }
        }
      }else
      { 
        if($sisa_awal == TRUE)
        {
          $cekJam = $this->ModelBooking->checkJam($data['start_date'],$data['id_loket']);
          // print_r($result[0]['dataJam']);die();
          // $JamKe = json_decode(json_encode($cekJam))[0]->dataJam;
          $JamKe = $cekJam[0]['dataJam'];
          $BerkasTerpakai = $data['qty_berkas'];
          if($data['jml_bidang'] < $data['qty_berkas'])
          {
            $totalJam = round($data['jml_bidang']/$jumlah_per_jam);
          }
          else
          {
            // if($data['jml_bidang'] == $data['qty_berkas'])
            $totalJam = $data['qty_berkas']/$jumlah_per_jam;
            if($data['jml_bidang'] > $data['qty_berkas'])
            {
              $data['jml_bidang'] = $data['jml_bidang']-$data['qty_berkas'];
              $status_loket=1;
            }
          }
          $jamStart = $JamKe+1;
          $jamEnd = $JamKe+$totalJam;
          // print_r($totalJam);die();
          $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
          if (!$data_id){
            $this->response( array('status'=>FALSE,'notif'=>'Server wrong, please save again','token'=>''));
          }else{
            // $checkTtlBidangPerLoket = $this->ModelBooking->getTanggalBerkasAntrian()
            if($jamEnd < $jumlah_jam_kerja)
            {
              $status_loket=0;
            }else{
              $status_loket=1;
            }
            $updateStatusLoket = $this->ModelBooking->db_book->update('tbl_antrian',array('status_loket'=>$status_loket),array('id_loket'=>$data['id_loket'],'tgl_pengajuan'=>$data['start_date']));
            if(!$updateStatusLoket){
                $this->response( array('status'=>FALSE,'notif'=>'Update Locket Status Fault, please save again','token'=>''));
            }else{
              $insertAntrian = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$data['start_date'],'jml_bidang'=>$data['qty_berkas'],'jml_jam'=>$totalJam,'jam_start'=>$jamStart,'jam_end'=>$jamEnd,'status_antrian'=>1,'status_loket'=>$status_loket));
            }
            // if(!$insertAntrian){
            //   $this->response( array('status'=>FALSE,'notif'=>'Server wrong, please save again','token'=>''));
            // }else {
                
            // }
          }
        }
        if($sisa_bulat == TRUE)
        {
          if($kodeStatus == 3)
          {
            $data['start_date'] =date('Y-m-d', strtotime('+1 days', strtotime($data['start_date'])));
          }
          $totalHariTmp = $data['ttl_hariAll'];
          // print_r($totalHariTmp."XXXXX".$data['start_dat e']);die();
          $tglStart = $data['start_date'];
          $status_loket=1;
          // if()
          $i = 0;
          $i2 = 0;
          // counter untuk jumlah hari jumat
          $sum = 0;
          $angka = 0;
          $jumlahLibur =0;
          //hitung Jumlah Libur
          do
          {
            $TglCheck= date('Y-m-d', strtotime('+'.$i2.' days', strtotime($tglStart)));
            // $pecahTglStart2 = explode("-", $data['start_date']);
            $pecahTglStart2 = explode("-", $TglCheck);
            $tgl2 = $pecahTglStart2[2];
            $bln2 = $pecahTglStart2[1];
            $thn2 = $pecahTglStart2[0];    
            $libur = " tidak ";
            // $tanggal = date("w", mktime(0, 0, 0,$bln2, $tgl2+$i, $thn2));
            $tanggal = date("w", mktime(0, 0, 0,$bln2, $tgl2, $thn2));
            // print_r($TglCheck." xxxs- $i2 - ");
            //jika hari jumat pindah ke senen
            if($tanggal == 5)
            {
              $tglAkhirTmp2 = date('Y-m-d', strtotime('+'.($i2+3).' days', strtotime($tglStart)));
              $angka = 3;
              $a= "Jumat";
              $i2+=4;
              $totalHariTmp+=3;
              // $i+=4;
            }else{
              //jika bukan lanjut
              $tglAkhirTmp2 = $TglCheck;
              $a= " Bukan Jumát";
              $i++;
              $i2++;
            }
            // $i++;
            $dataInsert['start_date']=$tglAkhirTmp2;
            $dataInsert['end_date']=$tglAkhirTmp2;
            $data['start_date'] =$tglAkhirTmp2;
            $dataInsert['status_tampil']=1;
            $status_loket=1;
            $dataCheck = $this->ModelBooking->checkLibur($tglAkhirTmp2);
            if($dataCheck>0){
              // print_r("ZZZ-".$dataCheck."-ZZZ");
              $totalHariTmp++;
              $jumlahLibur++;
              $libur = "ya";
              $i++;
              // $i2++;
            }else {
              $libur =" Tidak ";
              // print_r("ZZZ-".$dataCheck."-ZZZ");
              $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
              if ($data_id){
                  $insertAntrian = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirTmp2,'jml_bidang'=>60,'jml_jam'=>6,'jam_start'=>1,'jam_end'=>6,'status_antrian'=>1,'status_loket'=>$status_loket));
              }
            }
            // print_r($i2."--".$totalHariTmp."-".$tglAkhirTmp2."- $libur <br>");
          }
          while ($i2 != $totalHariTmp);
          // $i2++;
          // die();
        }
      }
      // print_r($data['start_date']);die();
      if($sisa_akhir == TRUE)
      {
          $tglStart = date('Y-m-d', strtotime('+1 days', strtotime($data['start_date'])));;
          $totalHariTmp = 1;
          $status_loket=0;
          // if()
          $i = 0;
          $i2 = 0;
          // counter untuk jumlah hari jumat
          $sum = 0;
          $angka = 0;
          $jumlahLibur =0;
          //hitung Jumlah Libur
          do
          {
            $pecahTglStart2 = explode("-",$tglStart);
            $tgl2 = $pecahTglStart2[2];
            $bln2 = $pecahTglStart2[1];
            $thn2 = $pecahTglStart2[0];

            $tanggal = date("w", mktime(0, 0, 0,$bln2, $tgl2+$i, $thn2));
            //jika hari jumat pindah ke senen
            if ($tanggal == 5)
            {
              $tglAkhirTmp2 = date('Y-m-d', strtotime('+'.($i+3).' days', strtotime($tglStart)));
              $angka = 3;
              $a= "Jumat";
              $i+=4;
            }else{
              //jika bukan lanjut
              $tglAkhirTmp2 = date('Y-m-d', strtotime('+'.$i.' days', strtotime($tglStart)));
              $a= " Bukan Jumát";
              $i++;
            }
            // $i++;
            
            $dataCheck = $this->ModelBooking->checkLibur($tglAkhirTmp2);
            if($dataCheck>0){
              $totalHariTmp++;
              $jumlahLibur++;
            }else {
              $cekJam = $this->ModelBooking->checkJam($tglAkhirTmp2,$data['id_loket']);
              $JamKe = $cekJam[0]['dataJam'];
              $BerkasTerpakai = $data['qty_berkas'];
              $totalJam = $data['ttl_jamFix'];
              $jamStart = $JamKe+1;
              $jamEnd = $JamKe+$totalJam;
              // $totalHariTmp = $data['ttl_hariAll'];
              $dataInsert['start_date']=$tglAkhirTmp2;
              $dataInsert['end_date']=$tglAkhirTmp2;
              $dataInsert['status_tampil']=0;
              $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
              if ($data_id){
                  $insertAntrian = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirTmp2,'jml_bidang'=>$data['ttl_jam'],'jml_jam'=>$data['ttl_jamFix'],'jam_start'=>$jamStart,'jam_end'=>$jamEnd,'status_antrian'=>1,'status_loket'=>$status_loket));
              }
            }
            $i2++;
          }
          while ($i2 != $totalHariTmp);
      }
      if(!$insertAntrian){
        $this->response( array('status'=>FALSE,'notif'=>'Server wrong, please save again','token'=>''));
      }else {
        $this->response(array('status'=>TRUE,'notif'=>'Sukses Insert Data','token'=>$data['kode_enc']));
      }
  }
    // SaveBookingBerkas
    function SaveBookingBerkas1_post()
    {
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      $this->db_book = $this->load->database('db_lfbooking',true);
      // if($this->form_validation->run('booking_save_post') != false){
          $this->load->model('LfBooking/Booking_model','ModelBooking');
          $data = $this->post();
          $dateCreate = date("Y-m-d H:i:s");
          $dataTtlHari = $data['ttl_hariAll'];
          // print_r($dataTtlHari);die();
          $tglStart = $data['start_date'];
          $totalHari = $data['ttl_hariAll'];
          $dataInsert = array(
            'kd_kalender' => $this->input->post('kode'),
            'jns_booking' => $this->input->post('cmbJenis'),
            'jns_sektor' => $this->input->post('cmbSektor'),
            'title' => $this->input->post('title'),
            'jml_ugr' => $this->input->post('jml_ugr'),
            'no_surat' => $this->input->post('no_surat'),
            'jml_bidang' => $this->input->post('jml_bidang'),
            'description' => $this->input->post('description'),
            'color' => "#efe62b",
            'instansi' => $this->input->post('instansi'),
            'status_approval' => 1,
            'create_at' => $dateCreate,
            'create_by' => $this->input->post('sess_usr'),
            'modified_at' => $this->input->post(''),
            'modified_by' => $this->input->post('')
          );
          if($dataTtlHari == 1){
            $dataInsert['start_date']=$this->input->post('start_date');
            $dataInsert['end_date']=$this->input->post('start_date');
            $dataInsert['status_tampil']=1;
            $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
            if (!$data_id){
              $this->response( array('status'=>FALSE,'notif'=>'Server wrong, please save again','token'=>''));
            }else{
                $cekJam = $this->ModelBooking->checkJam($data['start_date'],$data['id_loket']);
                $JamKe = json_decode(json_encode($cekJam))[0]->dataJam;
                // print_r($JamKe);die();
                if(!$JamKe){
                  // if($data['ttl_jamFix'] == 0)
                  // {
                  //   $data['ttl_jamFix'] =6;
                  // }
                  $insertAntrian = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$data['start_date'],'jml_bidang'=>$data['jml_bidang'],'jml_jam'=>$data['ttl_jamFix'],'jam_start'=>1,'jam_end'=>$data['ttl_jamFix'],'status_antrian'=>1));
                  if(!$insertAntrian){
                    $this->response( array('status'=>FALSE,'notif'=>'Server wrong, please save again','token'=>''));
                  }else {
                    $this->response(array('status'=>TRUE,'notif'=>'Sukses Insert Data','token'=>$data['kode_enc']));
                  }
                }else {
                  $insertAntrian = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$data['start_date'],'jml_bidang'=>$data['jml_bidang'],'jml_jam'=>$data['ttl_jamFix'],'jam_start'=>($JamKe+1),'jam_end'=>($JamKe+$data['ttl_jamFix']),'status_antrian'=>1));
                  if(!$insertAntrian){
                    $this->response( array('status'=>FALSE,'notif'=>'Server wrong, please save again','token'=>''));
                  }else {
                    $this->response(array('status'=>TRUE,'notif'=>'Sukses Insert Data','token'=>$data['kode_enc']));
                  }
                  // print_r($JamKe);die();
                }
                $this->response(array('status'=>TRUE,'notif'=>'Sukses Insert Data'));
              }
          }else {
              //format Tgl ="Y-m-d"
              $tglStart = $data['start_date'];
              $totalHariTmp = ($data['ttl_hariAll']);
              $totalHariAwal = ($data['ttl_hariAll']);
              $tglAkhirTmp = date('Y-m-d', strtotime('+'.$totalHariTmp.' days', strtotime($tglStart)));
              $pecahTglStart = explode("-", $tglStart);
              $tgl1 = $pecahTglStart[2];
              $bln1 = $pecahTglStart[1];
              $thn1 = $pecahTglStart[0];

              if($data['ttl_jamFix'] == 0){
                if($data['qty_berkas'] == 60)
                {
                  $i = 0;
                  $i2 = 0;
                  // counter untuk jumlah hari jumat
                  $sum = 0;
                  $angka = 0;
                  $jumlahLibur =0;
                  do
                  {
                    $pecahTglStart2 = explode("-", $tglStart);
                    $tgl2 = $pecahTglStart2[2];
                    $bln2 = $pecahTglStart2[1];
                    $thn2 = $pecahTglStart2[0];

                    $tanggal = date("w", mktime(0, 0, 0,$bln2, $tgl2+$i, $thn2));
                    if ($tanggal == 5)
                     {
                       $tglAkhirTmp2 = date('Y-m-d', strtotime('+'.($i+3).' days', strtotime($tglStart)));
                       $angka = 3;
                       $a= "Jumat";
                       $i+=4;
                     }else{
                       $tglAkhirTmp2 = date('Y-m-d', strtotime('+'.$i.' days', strtotime($tglStart)));
                       $a= " Bukan Jumát";
                       $i++;
                     }
                     // $i++;
                     $dataInsert['start_date']=$tglAkhirTmp2;
                     $dataInsert['end_date']=$tglAkhirTmp2;
                     $dataInsert['status_tampil']=1;

                     $dataCheck = $this->ModelBooking->checkLibur($tglAkhirTmp2);
                     if($dataCheck>0){
                       $jumlahLibur++;
                     }else {
                       $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                       if ($data_id){
                          $insertAntrian = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirTmp2,'jml_bidang'=>60,'jml_jam'=>6,'jam_start'=>1,'jam_end'=>6,'status_antrian'=>1));
                       }
                     }
                     $i2++;
                     // echo "angka ".$i2." Tanggal -".$tglAkhirTmp2."--- ".$a." Jumlah Libur ".$jumlahLibur."<br>";
                  }
                  while ($i2 != $totalHariTmp);
                  // echo "<p>Hari Terakhir: ".$tglAkhirTmp2." Jumlah Libut ".$jumlahLibur."</p>";
                  // die();
                  if($jumlahLibur>0)
                  {
                    $tglStart2 =  date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirTmp2)));;
                    $totalHariTmp = $jumlahLibur;
                    $tglAkhirTmp = date('Y-m-d', strtotime('+'.$totalHariTmp.' days', strtotime($tglStart2)));
                    $pecahTglStartLbr = explode("-", $tglStart2);
                    $tglLbr = $pecahTglStartLbr[2];
                    $blnLbr = $pecahTglStartLbr[1];
                    $thnLbr = $pecahTglStartLbr[0];
                    $hitung = 0;
                    $hitung2 = 0;
                    // counter untuk jumlah hari jumat
                    $sum = 0;
                    $angka = 0;
                    $jumlahLibur =0;
                    do
                    {
                      $pecahTglStartLbrCheck = explode("-", $tglStart2);
                      $tglCheckLbr = $pecahTglStartLbrCheck[2];
                      $blnCheckLbr = $pecahTglStartLbrCheck[1];
                      $thnCheckLbr = $pecahTglStartLbrCheck[0];

                      $tanggal = date("w", mktime(0, 0, 0,$blnCheckLbr, $tglCheckLbr+$hitung, $thnCheckLbr));
                      if ($tanggal == 5)
                      {
                        $tglAkhirLibur = date('Y-m-d', strtotime('+'.($hitung+3).' days', strtotime($tglStart2)));
                        $angka = 3;
                        $a= "Jumat";
                        $hitung+=4;
                      }else{
                        $tglAkhirLibur = date('Y-m-d', strtotime('+'.$hitung.' days', strtotime($tglStart2)));
                        // $tglAkhirTmp6 = date('Y-m-d', strtotime('+'.$hitung.' days', strtotime($tglStart)));
                        $angka = 1;
                        $a= " Bukan Jumát";
                        $hitung++;
                      }
                      // $hitung++;
                      $dataInsert['start_date']=$tglAkhirLibur;
                      $dataInsert['end_date']=$tglAkhirLibur;
                      $dataInsert['status_tampil']=1;
                      $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                      if ($data_id){
                         $insertAntrian = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirLibur,'jml_bidang'=>60,'jml_jam'=>6,'jam_start'=>1,'jam_end'=>6,'status_antrian'=>1));
                      }
                      $hitung2++;
                      $angka2 =$angka+$hitung;
                      // echo "angka ".$hitung2." Tanggal -".$tglAkhirLibur."--- ".$a." Jumlah Libur ".$jumlahLibur."<br>";
                    }
                    while ($hitung2 != $totalHariTmp);
                    // echo "<p>Hari Terakhir: ".$tglAkhirLibur." Jumlah Libut ".$tglAkhirTmp."</p>";
                    // die();
                  // }
                  }
                    if(!$insertAntrian){
                      $this->response( array('status'=>FALSE,'notif'=>'Server wrong, please save again','token'=>''));
                    }else {
                      $this->response(array('status'=>TRUE,'notif'=>'Sukses Insert Data','token'=>$data['kode_enc']));
                    }
                  // if($sum == 0){
                    // while(strtotime($tglStart) <= strtotime($tglAKhir)){
                    //   $pecahTglStart1 = explode("-", $tglStart);
                    //   $tgl2 = $pecahTglStart1[2];
                    //   $bln2 = $pecahTglStart1[1];
                    //   $thn2 = $pecahTglStart1[0];
                    //   $checkTgl =  date("w", mktime(0, 0, 0, $bln2, $tgl2+1, $thn2));
                    //   if($checkTgl == 0 || $checkTgl == 5 || $checkTgl == 6){
                    //
                    //   }else{
                    //     $dataInsert['start_date']=$tglStart;
                    //     $dataInsert['end_date']=$tglStart;
                    //     $dataInsert['status_tampil']=1;
                    //     $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                    //     if ($data_id){
                    //       $insertAntrian = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglStart,'jml_bidang'=>60,'jml_jam'=>6,'jam_start'=>1,'jam_end'=>6,'status_antrian'=>1));
                    //     }
                    //   }
                    //   $tglStart = date('Y-m-d', strtotime('+1 days', strtotime($tglStart)));
                    // }
                  // }else {
                  //
                  // }
                }else
                {
                    $i = 0;
                    $i2 = 0;
                    // counter untuk jumlah hari jumat
                    $sum = 0;
                    $angka = 0;
                    $jumlahLibur =0;
                    $tglStartKe2 =  date('Y-m-d', strtotime('+1 days', strtotime($tglStart)));
                    $totalJam=($data['qty_berkas']/10);
                    $dataInsert['start_date']=$tglStart;
                    $dataInsert['end_date']=$tglStart;
                    $dataInsert['status_tampil']=1;
                    $cekJam = $this->ModelBooking->checkJam($data['start_date'],$data['id_loket']);
                    $JamKe = json_decode(json_encode($cekJam))[0]->dataJam;
                    $jamStart = $JamKe+1;
                    $jamEnd = $JamKe+$totalJam;
                    // print_r($totalJam."SSSSSSS");die();
                    $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                    if ($data_id){
                       $insertAntrian = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglStart,'jml_bidang'=>$data['qty_berkas'],'jml_jam'=>$totalJam,'jam_start'=>$jamStart,'jam_end'=>$jamEnd,'status_antrian'=>1));
                    }
                    $totalHariTmp = ($data['ttl_hariAll']-1);
                    if($insertAntrian){
                      do
                      {
                        $pecahTglStart2 = explode("-", $tglStartKe2);
                        $tgl2 = $pecahTglStart2[2];
                        $bln2 = $pecahTglStart2[1];
                        $thn2 = $pecahTglStart2[0];

                        $tanggal = date("w", mktime(0, 0, 0,$bln2, $tgl2+$i, $thn2));
                        if ($tanggal == 5)
                        {
                          $tglAkhirTmp2 = date('Y-m-d', strtotime('+'.($i+3).' days', strtotime($tglStartKe2)));
                          $angka = 3;
                          $a= "Jumat";
                          $i+=4;
                        }else{
                          $tglAkhirTmp2 = date('Y-m-d', strtotime('+'.$i.' days', strtotime($tglStartKe2)));
                          $a= " Bukan Jumát";
                          $i++;
                        }
                        // $i++;
                        $dataInsert['start_date']=$tglAkhirTmp2;
                        $dataInsert['end_date']=$tglAkhirTmp2;
                        $dataInsert['status_tampil']=1;

                        $dataCheck = $this->ModelBooking->checkLibur($tglAkhirTmp2);
                        if($dataCheck>0){
                          $jumlahLibur++;
                        }else {
                          $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                          if ($data_id){
                            $insertAntrian2 = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirTmp2,'jml_bidang'=>60,'jml_jam'=>6,'jam_start'=>1,'jam_end'=>6,'status_antrian'=>1));
                          }
                        }
                        $i2++;
                        // echo "angka ".$i2." Tanggal -".$tglAkhirTmp2."--- ".$a." Jumlah Libur ".$jumlahLibur."<br>";
                      }
                      while ($i2 != $totalHariTmp);
                      // echo "<p>Hari Terakhir: ".$tglAkhirTmp2." Jumlah Libut ".$jumlahLibur."</p>";
                      // die();
                      if($jumlahLibur>0){
                        $tglStart2 =  date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirTmp2)));;
                        $totalHariTmp = $jumlahLibur;
                        $tglAkhirTmp = date('Y-m-d', strtotime('+'.$totalHariTmp.' days', strtotime($tglStart2)));
                        $pecahTglStartLbr = explode("-", $tglStart2);
                        $tglLbr = $pecahTglStartLbr[2];
                        $blnLbr = $pecahTglStartLbr[1];
                        $thnLbr = $pecahTglStartLbr[0];
                        $hitung = 0;
                        $hitung2 = 0;
                        // counter untuk jumlah hari jumat
                        $sum = 0;
                        $angka = 0;
                        $jumlahLibur =0;
                        do
                        {
                          $pecahTglStartLbrCheck = explode("-", $tglStart2);
                          $tglCheckLbr = $pecahTglStartLbrCheck[2];
                          $blnCheckLbr = $pecahTglStartLbrCheck[1];
                          $thnCheckLbr = $pecahTglStartLbrCheck[0];

                          $tanggal = date("w", mktime(0, 0, 0,$blnCheckLbr, $tglCheckLbr+$hitung, $thnCheckLbr));
                          if ($tanggal == 5)
                          {
                            $tglAkhirLibur = date('Y-m-d', strtotime('+'.($hitung+3).' days', strtotime($tglStart2)));
                            $angka = 3;
                            $a= "Jumat";
                            $hitung+=4;
                          }else{
                            $tglAkhirLibur = date('Y-m-d', strtotime('+'.$hitung.' days', strtotime($tglStart2)));
                            // $tglAkhirTmp6 = date('Y-m-d', strtotime('+'.$hitung.' days', strtotime($tglStart)));
                            $angka = 1;
                            $a= " Bukan Jumát";
                            $hitung++;
                          }
                          // $hitung++;
                          $dataInsert['start_date']=$tglAkhirLibur;
                          $dataInsert['end_date']=$tglAkhirLibur;
                          $dataInsert['status_tampil']=1;
                          $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                          if ($data_id){
                            $insertAntrian2 = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirLibur,'jml_bidang'=>60,'jml_jam'=>6,'jam_start'=>1,'jam_end'=>6,'status_antrian'=>1));
                          }
                          $hitung2++;
                          $angka2 =$angka+$hitung;
                          // echo "angka ".$hitung2." Tanggal -".$tglAkhirLibur."--- ".$a." Jumlah Libur ".$jumlahLibur."<br>";
                        }
                        while ($hitung2 != $totalHariTmp);
                        // echo "<p>Hari Terakhir: ".$tglAkhirLibur." Jumlah Libut ".$tglAkhirTmp."</p>";
                        // die();
                        // }
                      }
                      if(!$insertAntrian2){
                        $this->response( array('status'=>FALSE,'notif'=>'Server wrong, please save again','token'=>''));
                      }else {
                        $this->response(array('status'=>TRUE,'notif'=>'Sukses Insert Data','token'=>$data['kode_enc']));
                      }
                    }
                }
              }else {
                if($data['qty_berkas'] == 60)
                {
                  $totalHariTmp = ($totalHariTmp-1);
                  $totalHariAwal = ($totalHariAwal-1);
                  // print_r($totalHariTmp);die();
                  $i = 0;
                  $i2 = 0;
                  // counter untuk jumlah hari jumat
                  $sum = 0;
                  $angka = 0;
                  $jumlahLibur = 0;
                  do
                  {
                    $pecahTglStart2 = explode("-", $tglStart);
                    $tgl2 = $pecahTglStart2[2];
                    $bln2 = $pecahTglStart2[1];
                    $thn2 = $pecahTglStart2[0];

                    $tanggal = date("w", mktime(0, 0, 0,$bln2, $tgl2+$i, $thn2));
                    if ($tanggal == 5)
                     {
                       $tglAkhirTmp2 = date('Y-m-d', strtotime('+'.($i+3).' days', strtotime($tglStart)));
                       $angka = 3;
                       $a= "Jumat";
                       $i+=4;
                     }else{
                       $tglAkhirTmp2 = date('Y-m-d', strtotime('+'.$i.' days', strtotime($tglStart)));
                       $a= " Bukan Jumát";
                       $i++;
                     }
                     // $i++;
                     $dataInsert['start_date']=$tglAkhirTmp2;
                     $dataInsert['end_date']=$tglAkhirTmp2;
                     $dataInsert['status_tampil']=1;
                     $dataCheck = $this->ModelBooking->checkLibur($tglAkhirTmp2);
                     if($dataCheck>0){
                       $jumlahLibur++;
                     }else{
                       $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                       if ($data_id){
                          $insertAntrian = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirTmp2,'jml_bidang'=>60,'jml_jam'=>6,'jam_start'=>1,'jam_end'=>6,'status_antrian'=>1));
                       }
                     }
                     $i2++;
                  }
                  while ($i2 != $totalHariTmp);
                  // print_r("-".$tglAkhirTmp2);die();
                  if($jumlahLibur>0)
                  {
                    $tglStart2 =  date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirTmp2)));;
                    $totalHariTmp = $jumlahLibur;
                    $tglAkhirTmp = date('Y-m-d', strtotime('+'.$totalHariTmp.' days', strtotime($tglStart2)));
                    $hitung = 0;
                    $hitung2 = 0;
                    // counter untuk jumlah hari jumat
                    $sum = 0;
                    $angka = 0;
                    $jumlahLibur =0;
                    do
                    {
                      $pecahTglStartLbrCheck = explode("-", $tglStart2);
                      $tglCheckLbr = $pecahTglStartLbrCheck[2];
                      $blnCheckLbr = $pecahTglStartLbrCheck[1];
                      $thnCheckLbr = $pecahTglStartLbrCheck[0];

                      $tanggal = date("w", mktime(0, 0, 0,$blnCheckLbr, $tglCheckLbr+$hitung, $thnCheckLbr));
                      if ($tanggal == 5)
                      {
                        $tglAkhirLibur = date('Y-m-d', strtotime('+'.($hitung+3).' days', strtotime($tglStart2)));
                        $angka = 3;
                        $a= "Jumat";
                        $hitung+=4;
                      }else{
                        $tglAkhirLibur = date('Y-m-d', strtotime('+'.$hitung.' days', strtotime($tglStart2)));
                        $angka = 1;
                        $a= " Bukan Jumát";
                        $hitung++;
                      }
                      // $hitung++;
                      $dataInsert['start_date']=$tglAkhirLibur;
                      $dataInsert['end_date']=$tglAkhirLibur;
                      $dataInsert['status_tampil']=1;
                      $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                      if ($data_id){
                         $insertAntrianLibur = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirLibur,'jml_bidang'=>60,'jml_jam'=>6,'jam_start'=>1,'jam_end'=>6,'status_antrian'=>1));
                      }
                      $hitung2++;
                      $angka2 =$angka+$hitung;
                    }
                    while ($hitung2 != $totalHariTmp);

                    if($insertAntrianLibur)
                    {
                      $tglStartKe3 =  date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirLibur)));
                      // $tglStart2 =  date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirTmp2)));;
                      $totalHariTmp = 1;
                      $tglAkhirTmp = date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirLibur)));
                      $cekJam = $this->ModelBooking->checkJam($tglStartKe3,$data['id_loket']);
                      $JamKe = json_decode(json_encode($cekJam))[0]->dataJam;
                      $jamStart = $JamKe+1;
                      $jamEnd = $JamKe+$data['ttl_jamFix'];
                      $totalJam = $data['ttl_jamFix'];
                      $hitung = 0;
                      $hitung2 = 0;
                      // counter untuk jumlah hari jumat
                      $sum = 0;
                      $angka = 0;
                      $jumlahLibur =0;
                      do
                      {
                        $pecahTglStartLbrCheck = explode("-", $tglStartKe3);
                        $tglCheckLbr = $pecahTglStartLbrCheck[2];
                        $blnCheckLbr = $pecahTglStartLbrCheck[1];
                        $thnCheckLbr = $pecahTglStartLbrCheck[0];

                        $tanggal = date("w", mktime(0, 0, 0,$blnCheckLbr, $tglCheckLbr+$hitung, $thnCheckLbr));
                        if ($tanggal == 5)
                        {
                          $tglAkhirLibur = date('Y-m-d', strtotime('+'.($hitung+3).' days', strtotime($tglStartKe3)));
                          $angka = 3;
                          $a= "Jumat";
                          $hitung+=4;
                        }else{
                          $tglAkhirLibur = date('Y-m-d', strtotime('+'.$hitung.' days', strtotime($tglStartKe3)));
                          $angka = 1;
                          $a= " Bukan Jumát";
                          $hitung++;
                        }
                        // $hitung++;
                        $dataInsert['start_date']=$tglAkhirLibur;
                        $dataInsert['end_date']=$tglAkhirLibur;
                        $dataInsert['status_tampil']=1;
                        $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                        if ($data_id){
                          $insertAntriannya = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirLibur,'jml_bidang'=>$data['qty_berkas'],'jml_jam'=>$totalJam,'jam_start'=>$jamStart,'jam_end'=>$jamEnd,'status_antrian'=>1));
                           // $insertAntrianLibur = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirLibur,'jml_bidang'=>60,'jml_jam'=>6,'jam_start'=>1,'jam_end'=>6,'status_antrian'=>1));
                        }
                        $hitung2++;
                        $angka2 =$angka+$hitung;
                      }
                      while ($hitung2 != $totalHariTmp);
                    }
                      if(!$insertAntriannya){
                        $this->response( array('status'=>FALSE,'notif'=>'Server wrong, please save again','token'=>''));
                      }else {
                        $this->response(array('status'=>TRUE,'notif'=>'Sukses Insert Data','token'=>$data['kode_enc']));
                      }
                  // }
                  }else
                  {
                    $tglStartOk =  date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirTmp2)));
                    $totalHariTmp = 1;
                    $tglAkhirTmp = date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirTmp2)));
                    $hitung = 0;
                    $hitung2 = 0;
                    $cekJam = $this->ModelBooking->checkJam($tglStartOk,$data['id_loket']);
                    $JamKe = json_decode(json_encode($cekJam))[0]->dataJam;
                    $jamStart = $JamKe+1;
                    $jamEnd = $JamKe+$data['ttl_jamFix'];
                    $totalJam = $data['ttl_jamFix'];
                    // counter untuk jumlah hari jumat
                    $sum = 0;
                    $angka = 0;
                    $jumlahLibur =0;
                    do
                    {
                      $pecahTglStartLbrCheck = explode("-", $tglStartOk);
                      $tglCheckLbr = $pecahTglStartLbrCheck[2];
                      $blnCheckLbr = $pecahTglStartLbrCheck[1];
                      $thnCheckLbr = $pecahTglStartLbrCheck[0];

                      $tanggal = date("w", mktime(0, 0, 0,$blnCheckLbr, $tglCheckLbr+$hitung, $thnCheckLbr));
                      if ($tanggal == 5)
                      {
                        $tglAkhirLibur = date('Y-m-d', strtotime('+'.($hitung+3).' days', strtotime($tglStartOk)));
                        $angka = 3;
                        $a= "Jumat";
                        $hitung+=4;
                      }else{
                        $tglAkhirLibur = date('Y-m-d', strtotime('+'.$hitung.' days', strtotime($tglStartOk)));
                        $angka = 1;
                        $a= " Bukan Jumát";
                        $hitung++;
                      }
                      // $hitung++;
                      $dataInsert['start_date']=$tglAkhirLibur;
                      $dataInsert['end_date']=$tglAkhirLibur;
                      $dataInsert['status_tampil']=1;

                      // $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                      $dataCheck = $this->ModelBooking->checkLibur($tglAkhirLibur);
                      if($dataCheck>0){
                        $jumlahLibur++;
                      }else{
                        $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                        if ($data_id){
                           // $insertAntrian = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirTmp2,'jml_bidang'=>60,'jml_jam'=>6,'jam_start'=>1,'jam_end'=>6,'status_antrian'=>1));
                           $insertAntriannya = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirLibur,'jml_bidang'=>$data['qty_berkas'],'jml_jam'=>$totalJam,'jam_start'=>$jamStart,'jam_end'=>$jamEnd,'status_antrian'=>1));
                        }
                      }
                      $hitung2++;
                      $angka2 =$angka+$hitung;
                    }
                    while ($hitung2 != $totalHariTmp);
                    // print_r($tglAkhirLibur);die();

                    if($jumlahLibur>0)
                    {
                        $tglStart2 =  date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirTmp2)));;
                        $totalHariTmp = $jumlahLibur;
                        $tglAkhirTmp = date('Y-m-d', strtotime('+'.$totalHariTmp.' days', strtotime($tglAkhirLibur)));
                        // $tglStartOk =  date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirLibur)));;
                        $cekJam = $this->ModelBooking->checkJam($tglAkhirTmp,$data['id_loket']);
                        $JamKe = json_decode(json_encode($cekJam))[0]->dataJam;
                        $jamStart = $JamKe+1;
                        $jamEnd = $JamKe+$data['ttl_jamFix'];
                        $totalJam = $data['ttl_jamFix'];
                        $hitung = 0;
                        $hitung2 = 0;
                        // counter untuk jumlah hari jumat
                        $sum = 0;
                        $angka = 0;
                        $jumlahLibur =0;
                        do
                        {
                          $pecahTglStartLbrCheck = explode("-", $tglStart2);
                          $tglCheckLbr = $pecahTglStartLbrCheck[2];
                          $blnCheckLbr = $pecahTglStartLbrCheck[1];
                          $thnCheckLbr = $pecahTglStartLbrCheck[0];

                          $tanggal = date("w", mktime(0, 0, 0,$blnCheckLbr, $tglCheckLbr+$hitung, $thnCheckLbr));
                          if ($tanggal == 5)
                          {
                            $tglAkhirLibur = date('Y-m-d', strtotime('+'.($hitung+3).' days', strtotime($tglAkhirTmp)));
                            $angka = 3;
                            $a= "Jumat";
                            $hitung+=4;
                          }else{
                            $tglAkhirLibur = date('Y-m-d', strtotime('+'.$hitung.' days', strtotime($tglAkhirTmp)));
                            $angka = 1;
                            $a= " Bukan Jumát";
                            $hitung++;
                          }
                          // $hitung++;
                          $dataInsert['start_date']=$tglAkhirLibur;
                          $dataInsert['end_date']=$tglAkhirLibur;
                          $dataInsert['status_tampil']=1;
                          $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                          if ($data_id){
                             $insertAntriannya = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirLibur,'jml_bidang'=>$data['qty_berkas'],'jml_jam'=>$totalJam,'jam_start'=>$jamStart,'jam_end'=>$jamEnd,'status_antrian'=>1));
                             // $insertAntrianLibur = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirLibur,'jml_bidang'=>60,'jml_jam'=>6,'jam_start'=>1,'jam_end'=>6,'status_antrian'=>1));
                          }
                          $hitung2++;
                          $angka2 =$angka+$hitung;
                        }
                        while ($hitung2 != $totalHariTmp);
                      }
                    if(!$insertAntriannya){
                      $this->response( array('status'=>FALSE,'notif'=>'Server wrong, please save again','token'=>''));
                    }else {
                      $this->response(array('status'=>TRUE,'notif'=>'Sukses Insert Data','token'=>$data['kode_enc']));
                    }
                }
                //end if
              }else {
                    //$data['qty_berkas'] != 60
                    $i = 0;
                    $i2 = 0;
                    // counter untuk jumlah hari jumat
                    $sum = 0;
                    $angka = 0;
                    $jumlahLibur =0;
                    $tglStartKe2 =  date('Y-m-d', strtotime('+1 days', strtotime($tglStart)));
                    $totalJam=($data['qty_berkas']/10);
                    $dataInsert['start_date']=$tglStart;
                    $dataInsert['end_date']=$tglStart;
                    $dataInsert['status_tampil']=1;
                    $cekJam = $this->ModelBooking->checkJam($data['start_date'],$data['id_loket']);
                    $JamKe = json_decode(json_encode($cekJam))[0]->dataJam;
                    $jamStart = $JamKe+1;
                    $jamEnd = $JamKe+$totalJam;
                    // print_r($totalJam."SSSSSSS");die();
                    $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                    if ($data_id){
                       $insertAntrian = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglStart,'jml_bidang'=>$data['qty_berkas'],'jml_jam'=>$totalJam,'jam_start'=>$jamStart,'jam_end'=>$jamEnd,'status_antrian'=>1));
                    }
                    $totalHariTmp = ($data['ttl_hariAll']-2);
                    if($insertAntrian){
                      do
                      {
                        $pecahTglStart2 = explode("-", $tglStartKe2);
                        $tgl2 = $pecahTglStart2[2];
                        $bln2 = $pecahTglStart2[1];
                        $thn2 = $pecahTglStart2[0];

                        $tanggal = date("w", mktime(0, 0, 0,$bln2, $tgl2+$i, $thn2));
                        if ($tanggal == 5)
                        {
                          $tglAkhirTmp2 = date('Y-m-d', strtotime('+'.($i+3).' days', strtotime($tglStartKe2)));
                          $angka = 3;
                          $a= "Jumat";
                          $i+=4;
                        }else{
                          $tglAkhirTmp2 = date('Y-m-d', strtotime('+'.$i.' days', strtotime($tglStartKe2)));
                          $a= " Bukan Jumát";
                          $i++;
                        }
                        // $i++;
                        $dataInsert['start_date']=$tglAkhirTmp2;
                        $dataInsert['end_date']=$tglAkhirTmp2;
                        $dataInsert['status_tampil']=1;

                        $dataCheck = $this->ModelBooking->checkLibur($tglAkhirTmp2);
                        if($dataCheck>0){
                          $jumlahLibur++;
                        }else {
                          $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                          if ($data_id){
                            $insertAntrian2 = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirTmp2,'jml_bidang'=>60,'jml_jam'=>6,'jam_start'=>1,'jam_end'=>6,'status_antrian'=>1));
                          }
                        }
                        $i2++;
                        // echo "angka ".$i2." Tanggal -".$tglAkhirTmp2."--- ".$a." Jumlah Libur ".$jumlahLibur."<br>";
                      }
                      while ($i2 != $totalHariTmp);
                      // echo "<p>Hari Terakhir: ".$tglAkhirTmp2." Jumlah Libut ".$jumlahLibur."</p>";
                      // die();
                      if($jumlahLibur>0)
                      {
                        $tglStart2 =  date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirTmp2)));;
                        $totalHariTmp = $jumlahLibur;
                        $tglAkhirTmp = date('Y-m-d', strtotime('+'.$totalHariTmp.' days', strtotime($tglStart2)));
                        $pecahTglStartLbr = explode("-", $tglStart2);
                        $tglLbr = $pecahTglStartLbr[2];
                        $blnLbr = $pecahTglStartLbr[1];
                        $thnLbr = $pecahTglStartLbr[0];
                        $hitung = 0;
                        $hitung2 = 0;
                        // counter untuk jumlah hari jumat
                        $sum = 0;
                        $angka = 0;
                        $jumlahLibur =0;
                        do
                        {
                          $pecahTglStartLbrCheck = explode("-", $tglStart2);
                          $tglCheckLbr = $pecahTglStartLbrCheck[2];
                          $blnCheckLbr = $pecahTglStartLbrCheck[1];
                          $thnCheckLbr = $pecahTglStartLbrCheck[0];

                          $tanggal = date("w", mktime(0, 0, 0,$blnCheckLbr, $tglCheckLbr+$hitung, $thnCheckLbr));
                          if ($tanggal == 5)
                          {
                            $tglAkhirLibur = date('Y-m-d', strtotime('+'.($hitung+3).' days', strtotime($tglStart2)));
                            $angka = 3;
                            $a= "Jumat";
                            $hitung+=4;
                          }else{
                            $tglAkhirLibur = date('Y-m-d', strtotime('+'.$hitung.' days', strtotime($tglStart2)));
                            // $tglAkhirTmp6 = date('Y-m-d', strtotime('+'.$hitung.' days', strtotime($tglStart)));
                            $angka = 1;
                            $a= " Bukan Jumát";
                            $hitung++;
                          }
                          // $hitung++;
                          $dataInsert['start_date']=$tglAkhirLibur;
                          $dataInsert['end_date']=$tglAkhirLibur;
                          $dataInsert['status_tampil']=1;
                          $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                          if ($data_id){
                            $insertAntrian2 = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirLibur,'jml_bidang'=>60,'jml_jam'=>6,'jam_start'=>1,'jam_end'=>6,'status_antrian'=>1));
                          }
                          $hitung2++;
                          $angka2 =$angka+$hitung;
                          // echo "angka ".$hitung2." Tanggal -".$tglAkhirLibur."--- ".$a." Jumlah Libur ".$jumlahLibur."<br>";
                        }
                        while ($hitung2 != $totalHariTmp);
                        if($insertAntrian2)
                        {
                          $tglStartKe3 =  date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirLibur)));
                          // $tglStart2 =  date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirTmp2)));;
                          $totalHariTmp = 1;
                          $tglAkhirTmp = date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirLibur)));
                          // print_r($tglAkhirTmp);die();
                          $cekJam = $this->ModelBooking->checkJam($tglStartKe3,$data['id_loket']);
                          $JamKe = json_decode(json_encode($cekJam))[0]->dataJam;
                          $jamStart = $JamKe+1;
                          $jamEnd = $JamKe+$data['ttl_jamFix'];
                          $totalJam = $data['ttl_jamFix'];
                          $hitung = 0;
                          $hitung2 = 0;
                          // counter untuk jumlah hari jumat
                          $sum = 0;
                          $angka = 0;
                          $jumlahLibur =0;
                          do
                          {
                            $pecahTglStartLbrCheck = explode("-", $tglStartKe3);
                            $tglCheckLbr = $pecahTglStartLbrCheck[2];
                            $blnCheckLbr = $pecahTglStartLbrCheck[1];
                            $thnCheckLbr = $pecahTglStartLbrCheck[0];

                            $tanggal = date("w", mktime(0, 0, 0,$blnCheckLbr, $tglCheckLbr+$hitung, $thnCheckLbr));
                            if ($tanggal == 5)
                            {
                              $tglAkhirLibur = date('Y-m-d', strtotime('+'.($hitung+3).' days', strtotime($tglStartKe3)));
                              $angka = 3;
                              $a= "Jumat";
                              $hitung+=4;
                            }else{
                              $tglAkhirLibur = date('Y-m-d', strtotime('+'.$hitung.' days', strtotime($tglStartKe3)));
                              $angka = 1;
                              $a= " Bukan Jumát";
                              $hitung++;
                            }
                            // $hitung++;
                            $dataInsert['start_date']=$tglAkhirLibur;
                            $dataInsert['end_date']=$tglAkhirLibur;
                            $dataInsert['status_tampil']=1;
                            $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                            if ($data_id){
                              $insertAntriannya = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirLibur,'jml_bidang'=>$data['ttl_jam'],'jml_jam'=>$totalJam,'jam_start'=>$jamStart,'jam_end'=>$jamEnd,'status_antrian'=>1));
                               // $insertAntrianLibur = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirLibur,'jml_bidang'=>60,'jml_jam'=>6,'jam_start'=>1,'jam_end'=>6,'status_antrian'=>1));
                            }
                            $hitung2++;
                            $angka2 =$angka+$hitung;
                          }
                          while ($hitung2 != $totalHariTmp);
                        }
                      }else {
                        $tglStartOk =  date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirTmp2)));;
                        $totalHariTmp = 1;
                        $tglAkhirTmp = date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirTmp2)));
                        $hitung = 0;
                        $hitung2 = 0;
                        $cekJam = $this->ModelBooking->checkJam($tglStartOk,$data['id_loket']);
                        $JamKe = json_decode(json_encode($cekJam))[0]->dataJam;
                        $jamStart = $JamKe+1;
                        $jamEnd = $JamKe+$data['ttl_jamFix'];
                        $totalJam = $data['ttl_jamFix'];
                        // counter untuk jumlah hari jumat
                        $sum = 0;
                        $angka = 0;
                        $jumlahLibur =0;
                        do
                        {
                          $pecahTglStartLbrCheck = explode("-", $tglStartOk);
                          $tglCheckLbr = $pecahTglStartLbrCheck[2];
                          $blnCheckLbr = $pecahTglStartLbrCheck[1];
                          $thnCheckLbr = $pecahTglStartLbrCheck[0];

                          $tanggal = date("w", mktime(0, 0, 0,$blnCheckLbr, $tglCheckLbr+$hitung, $thnCheckLbr));
                          if ($tanggal == 5)
                          {
                            $tglAkhirLibur = date('Y-m-d', strtotime('+'.($hitung+3).' days', strtotime($tglStartOk)));
                            $angka = 3;
                            $a= "Jumat";
                            $hitung+=4;
                          }else{
                            $tglAkhirLibur = date('Y-m-d', strtotime('+'.$hitung.' days', strtotime($tglStartOk)));
                            $angka = 1;
                            $a= " Bukan Jumát";
                            $hitung++;
                          }
                          // $hitung++;
                          $dataInsert['start_date']=$tglAkhirLibur;
                          $dataInsert['end_date']=$tglAkhirLibur;
                          $dataInsert['status_tampil']=1;

                          // $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                          $dataCheck = $this->ModelBooking->checkLibur($tglAkhirLibur);
                          if($dataCheck>0){
                            $jumlahLibur++;
                          }else{
                            $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                            if ($data_id){
                               // $insertAntrian = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirTmp2,'jml_bidang'=>60,'jml_jam'=>6,'jam_start'=>1,'jam_end'=>6,'status_antrian'=>1));
                               $insertAntriannya = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirLibur,'jml_bidang'=>$data['qty_berkas'],'jml_jam'=>$totalJam,'jam_start'=>$jamStart,'jam_end'=>$jamEnd,'status_antrian'=>1));
                            }
                          }
                          $hitung2++;
                          $angka2 =$angka+$hitung;
                        }
                        while ($hitung2 != $totalHariTmp);

                        if($jumlahLibur>0)
                        {
                            $tglStart2 =  date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirTmp2)));;
                            $totalHariTmp = $jumlahLibur;
                            $tglAkhirTmp = date('Y-m-d', strtotime('+'.$totalHariTmp.' days', strtotime($tglAkhirLibur)));
                            // $tglStartOk =  date('Y-m-d', strtotime('+1 days', strtotime($tglAkhirLibur)));;
                            $cekJam = $this->ModelBooking->checkJam($tglAkhirTmp,$data['id_loket']);
                            $JamKe = json_decode(json_encode($cekJam))[0]->dataJam;
                            $jamStart = $JamKe+1;
                            $jamEnd = $JamKe+$data['ttl_jamFix'];
                            $totalJam = $data['ttl_jamFix'];
                            $hitung = 0;
                            $hitung2 = 0;
                            // counter untuk jumlah hari jumat
                            $sum = 0;
                            $angka = 0;
                            $jumlahLibur =0;
                            do
                            {
                              $pecahTglStartLbrCheck = explode("-", $tglStart2);
                              $tglCheckLbr = $pecahTglStartLbrCheck[2];
                              $blnCheckLbr = $pecahTglStartLbrCheck[1];
                              $thnCheckLbr = $pecahTglStartLbrCheck[0];

                              $tanggal = date("w", mktime(0, 0, 0,$blnCheckLbr, $tglCheckLbr+$hitung, $thnCheckLbr));
                              if ($tanggal == 5)
                              {
                                $tglAkhirLibur = date('Y-m-d', strtotime('+'.($hitung+3).' days', strtotime($tglAkhirTmp)));
                                $angka = 3;
                                $a= "Jumat";
                                $hitung+=4;
                              }else{
                                $tglAkhirLibur = date('Y-m-d', strtotime('+'.$hitung.' days', strtotime($tglAkhirTmp)));
                                $angka = 1;
                                $a= " Bukan Jumát";
                                $hitung++;
                              }
                              // $hitung++;
                              $dataInsert['start_date']=$tglAkhirLibur;
                              $dataInsert['end_date']=$tglAkhirLibur;
                              $dataInsert['status_tampil']=1;
                              $data_id = $this->ModelBooking->db_book->insert('kalender',$dataInsert);
                              if ($data_id){
                                 $insertAntriannya = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirLibur,'jml_bidang'=>$data['qty_berkas'],'jml_jam'=>$totalJam,'jam_start'=>$jamStart,'jam_end'=>$jamEnd,'status_antrian'=>1));
                                 // $insertAntrianLibur = $this->ModelBooking->db_book->insert('tbl_antrian',array('id_loket'=>$data['id_loket'],'id_kalender'=>$data['kode'],'tgl_pengajuan'=>$tglAkhirLibur,'jml_bidang'=>60,'jml_jam'=>6,'jam_start'=>1,'jam_end'=>6,'status_antrian'=>1));
                              }
                              $hitung2++;
                              $angka2 =$angka+$hitung;
                            }
                            while ($hitung2 != $totalHariTmp);
                          }
                      }
                      if(!$insertAntriannya){
                        $this->response( array('status'=>FALSE,'notif'=>'Server wrong, please save again','token'=>''));
                      }else {
                        $this->response(array('status'=>TRUE,'notif'=>'Sukses Insert Data','token'=>$data['kode_enc']));
                      }


                      // if(!$insertAntrian2){
                      //   $this->response( array('status'=>FALSE,'notif'=>'Server wrong, please save again','token'=>''));
                      // }else {
                      //   $this->response(array('status'=>TRUE,'notif'=>'Sukses Insert Data','token'=>$data['kode_enc']));
                      // }
                    }
              }
            }
          }
  }
    function UpdateUploadFormB_post()
    {
      $postdata = ($_POST);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      // if($this->form_validation->run('booking_save_post') != false){
          $this->load->model('LfBooking/Booking_model');
          $data = $this->post();
          $dateCreate = date("Y-m-d H:i:s");
          $dataInsert = array(
            'file_form_b' => $postdata['fileName'],
            'reminder_email' =>1
          );
          $data_id = $this->Booking_model->update($dataInsert,array('kd_kalender'=>$postdata['id']));
          if (!$data_id){
              $this->response( array('status'=>FALSE,'notif'=>'Server wrong, please save again'));
              // 'notif'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status'=>TRUE,'notif'=>'Sukses Mengajukan Appoinment'));
          }
    }
    function UpdateUploadSurat_post(){
      $postdata = ($_POST);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      // if($this->form_validation->run('booking_save_post') != false){
          $this->load->model('LfBooking/Booking_model');
          $data = $this->post();
          $dateCreate = date("Y-m-d H:i:s");
          $dataInsert = array(
            'file_surat' => $postdata['fileName'],
            'reminder_email' =>1
          );
          $data_id = $this->Booking_model->update($dataInsert,array('kd_kalender'=>$postdata['id']));
          if (!$data_id){
              $this->response( array('status'=>FALSE,'notif'=>'Server wrong, please save again'));
              // 'notif'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status'=>TRUE,'notif'=>'Sukses Mengajukan Appoinment'));
          }
    }
    function CheckLogin_post()
    {
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $data = $this->post();
      // print_r($data);die();
      $check_username = $this->ModelBooking->checkLoginUser($data);
      // print_r($check_username[0]['password']);die();
      if (!$check_username){
          $this->response( array('status'=>FALSE,'notif'=>'Login Gagal - Username Tidak Terdaftar...!'));
          // 'notif'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      } else {
        $this->response(array('status'=>TRUE,'notif'=>'Login Sukses','id_login'=>$check_username[0]['id_login'],'info'=>$check_username[0]['password'],'username'=>$check_username[0]['nip'],'nama'=>$check_username[0]['nama'],'instansi'=>$check_username[0]['instansi'],'email'=>$check_username[0]['email'],'no_hp'=>$check_username[0]['no_hp'],'akses'=>$check_username[0]['akses']));
          // $this->response(array('status'=>TRUE,'notif'=>'Login Sukses','info'=>$check_username[0]['password'],'username'=>$check_username[0]['nip'],'nama'=>$check_username[0]['nama'],'instansi'=>$check_username[0]['instansi'],'email'=>$check_username[0]['email'],'no_hp'=>$check_username[0]['no_hp'],'akses'=>$check_username[0]['akses']));
      }
    }
    function CheckLoginToken_post()
    {
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $data = $this->post();
      $data_id = $this->ModelBooking->checkLoginToken($data);
      // print_r($data['password']);die();
      if (!$data_id){
        $this->response( array('status'=>FALSE,'notif'=>'Login Gagal - Password Salah...!'));
          // 'notif'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      } else {
        // $this->response(array('status'=>TRUE,'notif'=>'Login Sukses','id_login'=>$data_id[0]['id_login'],'info'=>$data_id[0]['password'],'username'=>$data_id[0]['nip'],'nama'=>$data_id[0]['nama'],'instansi'=>$data_id[0]['instansi'],'email'=>$data_id[0]['email'],'no_hp'=>$data_id[0]['no_hp'],'akses'=>$data_id[0]['akses']));
        $this->response(array('status'=>TRUE,'notif'=>'Login Sukses'));
      }
    }

    function index_post() {
      $postdata = ($_POST);
      $JnsBooking =$postdata['jns_booking'];
      // print_r($postdata);die();
      $this->load->model('LfBooking/Booking_model');
      //SELECT * FROM `kalender` where start_date BETWEEN'2019-05-07' and '2019-05-07'
      if (isset($postdata)) {
        // $result= $this->Booking_model->getDataKalender($postdata);
        $result= $this->Booking_model->get_all(array('jns_booking'=>$JnsBooking,'status_delete'=>0));
        // $result= $this->Booking_model->get_all(array('jns_booking'=>$JnsBooking,'status_libur'=>0));
      } else {
        $result= $this->Booking_model->get_all(array('jns_booking'=>$JnsBooking,'status_delete'=>0));
      }
      $this->response($result, 200);
    }
    function getDataTable_post() {
      $postdata = ($_POST);
      // print_r($postdata);die();
      $this->load->model('LfBooking/Booking_model');
      //SELECT * FROM `kalender` where start_date BETWEEN'2019-05-07' and '2019-05-07'
      if (isset($postdata)) {
        $result= $this->Booking_model->getDataKalender($postdata);
        // $result= $this->Booking_model->get_all(array('jns_booking'=>$JnsBooking,'start_date'=>(>=$startDate),'start_date'=> (<=$endDate)));
      } else {
        $result= $this->Booking_model->getDataKalender($postdata);
      }
      $this->response($result, 200);
    }
    function getDataTableAll_post(){
      $postdata = ($_POST);
      // print_r($postdata);die();
      $this->load->model('LfBooking/Booking_model');
      //SELECT * FROM `kalender` where start_date BETWEEN'2019-05-07' and '2019-05-07'
      if (isset($postdata)) {
        $result= $this->Booking_model->getDataKalenderAll($postdata);
        // $result= $this->Booking_model->get_all(array('jns_booking'=>$JnsBooking,'start_date'=>(>=$startDate),'start_date'=> (<=$endDate)));
      } else {
        $result= $this->Booking_model->getDataKalenderAll($postdata);
      }
      $this->response($result, 200);
    }
    function getTtlHari_post(){
      $postdata = ($_POST);
      $this->load->model('LfBooking/Booking_model');
      if (isset($postdata)) {
        $result= $this->Booking_model->getJumlahHari($postdata);
      } else {
        $result= $this->Booking_model->getJumlahHari($postdata);
      }
      $this->response($result, 200);
    }
    function UpdateApproval_post(){
      $postdata = ($_POST);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      // if($this->form_validation->run('booking_save_post') != false){
          $this->load->model('LfBooking/Booking_model');
          $data = $this->post();
          $dateCreate = date("Y-m-d H:i:s");
          $dataInsert = array(
            'status_approval' => $postdata['status_approval'],
            'modified_at' => $dateCreate,
            'modified_by' => $postdata['session_nip'],
            'catatan_akhir' => $postdata['catatan_akhir']
          );
          $data_id = $this->Booking_model->update($dataInsert,array('id_kalender'=>$postdata['id_kalender']));
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status'=>'success','message'=>'Sukses updated'));
          }
    }
    function getDataTableUser_post() {
      $postdata = ($_POST);
      $akses =$postdata['akses'];
      // print_r($postdata);die();
      $this->load->model('LfBooking/Booking_model');
      if (isset($postdata)) {
        $result= $this->Booking_model->getdataUser($postdata);
      } else {
        $result= $this->Booking_model->getdataUser($postdata);
      }
      $this->response($result, 200);
    }
    //get data id User 
    function getDataUser_get(){
      $token = $this->uri->segment(4);
      // print_r($token);die();
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      if($token == '')
      {
        $result=$this->ModelBooking->getDetailUser($token);
      }else {
        // print_r($token."sdhsbd");die();
        $result=$this->ModelBooking->getDetailUser($token);
      }
      $this->response($result,200);
    }
    //getDataTableLibur
    function getDataTableLibur_post() {
      $postdata = ($_POST);
      $akses =$postdata['akses'];
      // print_r($postdata);die();
      $this->load->model('LfBooking/Booking_model');
      if (isset($postdata)) {
        $result= $this->Booking_model->get_all(array('status_libur'=>1));
      } else {
        $result= $this->Booking_model->get_all(array('status_libur'=>1));
      }
      $this->response($result, 200);
    }
    function getDataTableUserProfile_post() {
      $postdata = ($_POST);
      $akses =$postdata['akses'];
      $login =$postdata['login'];
      // print_r($postdata);die();
      $this->load->model('LfBooking/Booking_model');
      if (isset($postdata)) {
        $result= $this->Booking_model->getdataUserProfile($postdata);
      } else {
        $result= $this->Booking_model->getdataUserProfile($postdata);
      }
      $this->response($result, 200);
    }
    function saveDataUser_post(){
      $this->db_book = $this->load->database('db_lfbooking',true);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      // if($this->form_validation->run('booking_save_post') != false){
          $this->load->model('LfBooking/Booking_model');
          $data = $this->post();
          $dateCreate = date("Y-m-d H:i:s");
          $dataInsert = array(
            'nip' => $this->input->post('nip'),
            'password' => $this->input->post('password'),
            'nama' => $this->input->post('nama'),
            'instansi' => $this->input->post('instansi'),
            'no_hp' => $this->input->post('no_hp'),
            'email' => $this->input->post('email'),
            'akses' => $this->input->post('status'),
            'created_date' => $dateCreate,
            'created_by' => $this->input->post('session_nip'),
            'status' => 1
          );
          $check_nip = $this->Booking_model->checkNipUser();
          if (count($check_nip)>0){
            // print_r($check_nip);die();
            $this->response( array('status'=>'failures',
            'message'=>"Data NIP atau Email Sudah Terdaftar"),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          }
          else{
            $data_id = $this->Booking_model->db_book->insert('user_login',$dataInsert);
            if (!$data_id){
              $this->response( array('status'=>'failure',
              'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->response(array('status'=>'success','message'=>'Sukses Tambah Data User'));
            }
          }

          
    }
    function updateDataUser_post(){
      // print_r("jsdbhsbfjd");die();
      $this->db_book = $this->load->database('db_lfbooking',true);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      // if($this->form_validation->run('booking_save_post') != false){
          $this->load->model('LfBooking/Booking_model');
          $data = $this->post();
          $dateCreate = date("Y-m-d H:i:s");
          $dataInsert = array(
            'nip' => $this->input->post('nip'),
            'nama' => $this->input->post('nama'),
            'instansi' => $this->input->post('instansi'),
            'no_hp' => $this->input->post('no_hp'),
            'email' => $this->input->post('email'),
            'akses' => $this->input->post('status'),
            'date_update' => $dateCreate,
            'update_by' => $this->input->post('session_nip')
          );
          if(!empty($this->input->post('password')) || ($this->input->post('password') != "")){
            $dataInsert['password'] = $this->input->post('password');
          }
          // print_r($dataInsert);die();
          $data_id = $this->Booking_model->db_book->update('user_login',$dataInsert,array('id_login'=>$this->input->post('token')));
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status'=>'success','message'=>'Sukses Update Data User'));
          }
    }
    function deleteDataUser_post(){
      // print_r("jsdbhsbfjd");die();
      $this->db_book = $this->load->database('db_lfbooking',true);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      // if($this->form_validation->run('booking_save_post') != false){
          $this->load->model('LfBooking/Booking_model');
          $data = $this->post();
          $dateCreate = date("Y-m-d H:i:s");
          $dataInsert = array(
            'date_update' => $dateCreate,
            'update_by' => $this->input->post('session_nip'),
            'status' => 0
          );
          $data_id = $this->Booking_model->db_book->update('user_login',$dataInsert,array('id_login'=>$this->input->post('token')));
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status'=>'success','message'=>'Sukses Hapus Data User'));
          }
    }
    function saveDataLibur_post(){
      // print_r("jsdbhsbfjd");die();
      $this->db_book = $this->load->database('db_lfbooking',true);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      // if($this->form_validation->run('booking_save_post') != false){
          $this->load->model('LfBooking/Booking_model');
          $data = $this->post();
          $dateCreate = date("Y-m-d H:i:s");
          $dataInsert = array(
            'kd_kalender' => "-",
            'jns_booking' => 0,
            'jns_sektor' => 0,
            'title' => $this->input->post('keterangan'),
            'jml_ugr' => 0,
            'no_surat' => "-",
            'jml_bidang' => 0,
            'description' => "-",
            'color' => "#e46d6d",
            'start_date' => $this->input->post('tgl_libur'),
            'end_date' => $this->input->post('tgl_libur'),
            'instansi' => $this->input->post('instansi'),
            'status_approval' => 1,
            'status_tampil' => 1,
            'status_libur' => 1,
            'create_at' => $dateCreate,
            'create_by' => $this->input->post('sess_usr'),
            'modified_at' => $this->input->post(''),
            'modified_by' => $this->input->post('')
          );
          $data_id = $this->Booking_model->db_book->insert('kalender',$dataInsert);
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status'=>'success','message'=>'Sukses Tambah Data Libur'));
          }
    }
    function UpdateDataLibur_post(){
      // print_r("jsdbhsbfjd");die();
      $this->db_book = $this->load->database('db_lfbooking',true);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      // if($this->form_validation->run('booking_save_post') != false){
          $this->load->model('LfBooking/Booking_model');
          $data = $this->post();
          $dateCreate = date("Y-m-d H:i:s");
          $dataInsert = array(
            'title' => $this->input->post('keterangan'),
            'start_date' => $this->input->post('tgl_libur'),
            'end_date' => $this->input->post('tgl_libur'),
            'instansi' => $this->input->post('instansi'),
            'modified_at' =>$dateCreate,
            'modified_by' => $this->input->post('sess_usr')
          );
          $data_id = $this->Booking_model->db_book->update("kalender",$dataInsert,array('id_kalender'=>$this->input->post('token')));
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status'=>'success','message'=>'Sukses Update Data Libur Tanggal '.$this->input->post('tgl_libur').'.'));
          }
    }
    function deleteDataLibur_delete(){
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $deleted = $this->ModelBooking->force_delete(array('id_kalender'=>$this->delete('token')));
      if (!$deleted){
          $this->response( array('status'=>'failure',
          'message'=>'an expected error trying to delete '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      } else {
          $this->response(array('status'=>'success','message'=>'deleted success'));
      }
    }
    function getDataLoket_post(){
      $postdata = ($_POST);
      // print_r($postdata);die();
      $this->load->model('LfBooking/Booking_model');
      if (isset($postdata)) {
        $result= $this->Booking_model->getdataLoket($postdata);
      } else {
        $result= $this->Booking_model->getdataLoket($postdata);
      }
      $this->response($result, 200);
    }
    //get data detail loket
    function getDataDetailLoket_post(){
      $postdata = ($_POST);
      $this->load->model('LfBooking/Booking_model');
      if (isset($postdata)) {
        $result= $this->Booking_model->getdataDetailLoket();
      } else {
        $result= $this->Booking_model->getdataDetailLoket();
      }
      $this->response($result, 200);
    }
    //end data detail loket
    function getDataCekTgl_post(){
      $postdata = ($_POST);
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      if (isset($postdata)) {
        $result= $this->ModelBooking->cekTanggal();
      } else {
        $result= $this->ModelBooking->cekTanggal();
      }
      $this->response($result, 200);
    }
    function getId_get(){
      $id = $this->uri->segment(4);
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      if($id == '')
      {
        $result=$this->ModelBooking->getDataId($id);
      }else {
        // print_r($id."sdhsbd");die();
        $result=$this->ModelBooking->getDataId($id);
      }
      $this->response($result,200);
    }
    //2 Juli ,Add function get data Pengajuuan pembayaran langsung;
    function getDataKalender_get(){
      $id = $this->uri->segment(4);
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      if($id == '')
      {
        $result=$this->ModelBooking->get();
      }else {
        $result=$this->ModelBooking->get(array('id_kalender'=>$id));
      }
      $this->response($result,200);
    }
    function getdataDetailLogin_get(){
      $id = $this->uri->segment(4);
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      if($id == '')
      {
        $result=$this->ModelBooking->getDetailUser($id);
      }else {
        $result=$this->ModelBooking->getDetailUser($id);
      }
      $this->response($result,200);
    }

    //Untuk Mengambil Data Setting Pengajuan Libur
    function getDataSettingHari_post() {
      $postdata = ($_POST);
      $akses =$postdata['akses'];
      // print_r($postdata);die();
      $this->load->model('LfBooking/Booking_model');
      if (isset($postdata)) {
        $result= $this->Booking_model->getDataSettingHariPengajuan();
      } else {
        $result= $this->Booking_model->getDataSettingHariPengajuan();
      }
      $this->response($result, 200);
    }
    //update data setting lama hari pengajuan
    function updateSettingPengajuanHari_post(){
      // print_r("jsdbhsbfjd");die();
      $this->db_book = $this->load->database('db_lfbooking',true);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      // if($this->form_validation->run('booking_save_post') != false){
          $this->load->model('LfBooking/Booking_model');
          $data = $this->post();
          $dateCreate = date("Y-m-d H:i:s");
          $dataUpdate = array(
            'lama_hari' => $this->input->post('lama_pengajuan'),
            'jumlah_per_jam' => $this->input->post('jumlah_berkas'),
            'jumlah_jam_kerja' => $this->input->post('jam_kerja')
          );
          $data_id = $this->Booking_model->db_book->update("mst_setting_hari",$dataUpdate,array('id'=>$this->input->post('token')));
          if (!$data_id){
            $this->response( array('status_proses'=>false,'status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status_proses'=>true,'status'=>'success','message'=>'Sukses Update Lama Hari Pengajuan'.$this->input->post('jenis_pengajuan').'.'));
          }
    }

    // Fungsi Untuk Loket
    function get_data_loket_post()
    {
      $postdata = ($_POST);
      $akses =$postdata['akses'];
      // print_r($postdata);die();
      $this->load->model('LfBooking/Booking_model');
      if (isset($postdata)) {
        $result= $this->Booking_model->get_data_loket();
      } else {
        $result= $this->Booking_model->get_data_loket();
      }
      $this->response($result, 200);
    }
    function save_data_loket_post(){
      // print_r("jsdbhsbfjd");die();
      $this->db_book = $this->load->database('db_lfbooking',true);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      // if($this->form_validation->run('booking_save_post') != false){
          $this->load->model('LfBooking/Booking_model');
          $data = $this->post();
          $dateCreate = date("Y-m-d H:i:s");
          $dataCheck = $this->input->post('cek');
          $dataUpdate = array(
            'nm_loket' => $this->input->post('nm_loket'),
            'status' => $this->input->post('status_loket')
          );
          if($dataCheck == 1)
          {
            $data_id = $this->Booking_model->db_book->update("tbl_loket",$dataUpdate,array('id_loket'=>$this->input->post('token')));
          }else{
            $data_id = $this->Booking_model->db_book->insert("tbl_loket",$dataUpdate);
          }
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status'=>'success','message'=>'Sukses Simpan Data Loket'.$this->input->post('jenis_pengajuan').'.'));
          }
    }
    // END Loket
    // Fungsi Untuk PPK
    function get_data_ppk_post()
    {
      $postdata = ($_POST);
      $akses =$postdata['akses'];
      // print_r($postdata);die();
      $this->load->model('LfBooking/Booking_model');
      if (isset($postdata)) {
        $result= $this->Booking_model->get_data_ppk();
      } else {
        $result= $this->Booking_model->get_data_ppk();
      }
      $this->response($result, 200);
    }
    function get_data_ppk_select_get()
    {
      $this->load->model('LfBooking/Booking_model');
      if (isset($postdata)) {
        $result= $this->Booking_model->get_data_ppk_select();
      } else {
        $result= $this->Booking_model->get_data_ppk_select();
      }
      $this->response($result, 200);
    }
    // Fungsi Untuk PPK
    function save_data_ppk_post(){
      // print_r("jsdbhsbfjd");die();
      $this->db_book = $this->load->database('db_lfbooking',true);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
      // if($this->form_validation->run('booking_save_post') != false){
          $this->load->model('LfBooking/Booking_model');
          $data = $this->post();
          $dateCreate = date("Y-m-d H:i:s");
          $dataCheck = $this->input->post('cek');
          $dataUpdate = array(
            'nm_ppk' => $this->input->post('nm_ppk'),
            'keterangan' => $this->input->post('keterangan'),
            'status' => $this->input->post('status_ppk')
          );
          if($dataCheck == 1)
          {
            $data_id = $this->Booking_model->db_book->update("tbl_ppk",$dataUpdate,array('id_ppk'=>$this->input->post('token')));
          }else{
            $data_id = $this->Booking_model->db_book->insert("tbl_ppk",$dataUpdate);
          }
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status'=>'success','message'=>'Sukses Simpan Data PPK.'));
          }
    }
    // end PPK
    function Update_date_langsung_post()
    {
      $lama_hari_berkas = $this->input->post('lama_hari_berkas');
      $lama_hari_langsung = $this->input->post('lama_hari_langsung');
      $id_booking_berkas = $this->input->post('id_booking_berkas');
      $id_booking_langsung = $this->input->post('id_booking_langsung');
      $this->db_book = $this->load->database('db_lfbooking',true);
      $this->load->model('LfBooking/Booking_model');
      $data = $this->post();
      $date_setting = date('Y-m-d', strtotime('+'.$lama_hari_langsung.' days', strtotime($this->input->post('dateNow')))); //operasi penjumlahan tanggal sebanyak x hari;
      $dataCheck = $this->input->post('cek');
      $dataUpdate = array(
        'tgl_setting' => $date_setting
      );
      $data_id = $this->Booking_model->db_book->update("tbl_cek_tgl",$dataUpdate,array('id_jns_booking'=>$id_booking_langsung));
      if (!$data_id)
      {
        $this->response( array('status'=>'failure',
        'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else
      {
          $this->response(array('status'=>'success','message'=>'Sukses Simpan'.$this->input->post('jenis_pengajuan').'.'));
      }
    }
    function Update_date_berkas_post()
    {
      $lama_hari_berkas = $this->input->post('lama_hari_berkas');
      $lama_hari_langsung = $this->input->post('lama_hari_langsung');
      $id_booking_berkas = $this->input->post('id_booking_berkas');
      $id_booking_langsung = $this->input->post('id_booking_langsung');
      $this->db_book = $this->load->database('db_lfbooking',true);
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $data = $this->post();
      $tglStart = date('Y-m-d', strtotime('+'.$lama_hari_berkas.' days', strtotime($data['dateNow']))); //operasi penjumlahan tanggal sebanyak 7 hari;
      // print_r($data['dateNow']);die();
      // print_r($data);print_r("-<br>-");
      // print_r($tglStart);die();
      // $tglStart = date('Y-m-d', strtotime('+1 days', strtotime($data['start_date'])));;
      $totalHariTmp = 1;
      $i = 0;
      $i2 = 0;
      $sum = 0;
      $angka = 0;
      $jumlahLibur =0;
      //hitung Jumlah Libur
      do
      {
        $pecahTglStart2 = explode("-",$tglStart);
        $tgl2 = $pecahTglStart2[2];
        $bln2 = $pecahTglStart2[1];
        $thn2 = $pecahTglStart2[0];

        $tanggal = date("w", mktime(0, 0, 0,$bln2, $tgl2+$i, $thn2));
        //jika hari jumat pindah ke senen
        if ($tanggal == 5)
        {
          $tglAkhirTmp2 = date('Y-m-d', strtotime('+'.($i+3).' days', strtotime($tglStart)));
          $angka = 3;
          $a= "Jumat";
          $i+=4;
        }else{
          //jika bukan lanjut
          $tglAkhirTmp2 = date('Y-m-d', strtotime('+'.$i.' days', strtotime($tglStart)));
          $a= " Bukan Jumát";
          $i++;
        }
        // $i++;
        
        $dataCheck = $this->ModelBooking->checkLibur($tglAkhirTmp2);
        if($dataCheck>0){
          $totalHariTmp++;
          $jumlahLibur++;
        }else {
          $data['start'] = $tglAkhirTmp2;
          $check_ttl_jam = $this->ModelBooking->getTanggalBerkasAntrian($data);
          if($check_ttl_jam[0]['dataJam'] < $data['jumlah_Loket_total'] ){
            $updateAvailable = $this->ModelBooking->db_book->update('tbl_cek_tgl',array('tgl_setting'=>$tglAkhirTmp2),array('id_cek'=>2));
          }else {
            $totalHariTmp++;
            $jumlahLibur++;
          }

        }
        $i2++;
      }
      while ($i2 != $totalHariTmp);
      if (!$updateAvailable)
      {
        $this->response( array('status'=>'failure',
        'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }else
      {
          $this->response(array('status'=>'success','message'=>'Sukses Simpan'.$this->input->post('jenis_pengajuan').'.'));
      }
    }
    function Data_konfigurasi_get()
    {
      $getdata = $this->uri->segment(4);
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $result= $this->ModelBooking->get_data_konfigurasi($getdata);
      $this->response($result,200);
    }
    function jumlah_loket_get()
    {
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $result= $this->ModelBooking->get_jumlah_loket();
      $this->response($result,200);
    }
    function check_data_loket_old_post()
    {
      $this->db_book = $this->load->database('db_lfbooking',true);
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $data = $this->post();
      $result= $this->ModelBooking->cari_data_loket_1();
      $this->response($result, 200);
    }
    function check_data_loket_post()
    {
      $this->db_book = $this->load->database('db_lfbooking',true);
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $data = $this->post();
      $i=1;
      $hitung = TRUE;
      $check = FALSE;
      do
        {
          $data['id_loket'] = $i;
          $result = $this->ModelBooking->cari_data_loket_1($data);
          if(empty($result)){
            $result['id_loket'] = $i;
            $check = TRUE;    
          }else{
            $check = FALSE;  
          }
          $i++;
        }
        while ($hitung != $check);
      // die();
      $this->response($result, 200);
    }
    function check_data_loket_isi_post()
    {
      $this->db_book = $this->load->database('db_lfbooking',true);
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $data = $this->post();
      $result= $this->ModelBooking->cari_data_loket_2();
      $this->response($result, 200);
    }
    function check_data_loket_isi_old_post()
    {
      $this->db_book = $this->load->database('db_lfbooking',true);
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $data = $this->post();
      $i=1;
      $hitung = TRUE;
      $check = FALSE;
      do
        {
          $data['id_loket'] = $i;
          $checkGerai = $this->ModelBooking->cari_data_loket_2($data);
          if(empty($checkGerai)){
            print_r("__".$i."=");
            print_r("Kosong");
            echo "<br>";         
          }else{
            print_r("++".$i."="); 
            print_r($checkGerai);
            echo "<br>";
          }
          if($i == 10){
            $check = TRUE;
          }
          // print_r($data);
          // print_r('\r\n+++');
          $i++;
        }
        while ($hitung != $check);
      die();
      $result= $this->ModelBooking->cari_data_loket_2();
      $this->response($result, 200);
    }
    function check_data_loket_isi_2_post()
    {
      $this->db_book = $this->load->database('db_lfbooking',true);
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $data = $this->post();
      $result= $this->ModelBooking->cari_data_loket_3();
      $this->response($result, 200);
    }
    function get_data_loket_get()
    {
      $getdata =$this->uri->segment(4);
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $result= $this->ModelBooking->get_nama_loket($getdata);
      $this->response($result,200);
    }
    function getDataDetailJam_get()
    {
      $getdata =$this->uri->segment(4);
      $result=array();
      $Detail_jam = $getdata+7;
      if($Detail_jam >= 12)
      {
        $Detail_jam =$Detail_jam+1;
      }
      if($Detail_jam <10)
      {
        $Detail_jam ="0".$Detail_jam;
      }
      $result['detail_jam'] =$Detail_jam.":00";
      $this->response($result,200);
    }
    function get_detail_ppk_get()
    {
      $id_ppk = $this->uri->segment(4);
      // print_r($id_ppk);die();
      $this->db_book = $this->load->database('db_lfbooking',true);
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $data = $this->post();
      $result = $this->ModelBooking->get_data_ppk_detail($id_ppk);
      $this->response($result, 200);
    }
    function UpdateReminderEmail_post(){
      $postdata = ($_POST);
      $this->load->library('form_validation');
      $this->form_validation->set_data($this->put());
          $this->load->model('LfBooking/Booking_model');
          $data = $this->post();
          $dateCreate = date("Y-m-d H:i:s");
          $dataInsert = array(
            'reminder_email' => 1
          );
          $data_id = $this->Booking_model->update($dataInsert,array('id_kalender'=>$postdata['id_kalender']));
          if (!$data_id){
            $this->response( array('status'=>'failure',
            'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
          } else {
              $this->response(array('status'=>'success','message'=>'Sukses updated'));
          }
    }
    function checkBookingLangsung_post()
    {
      $this->load->model('LfBooking/Booking_model','bookingModel');
      $result = $this->bookingModel->checkTglBooking();
      $this->response($result,200);
    }
    function rollbackData_post()
    {
      $data = $_POST;
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $deleted = $this->ModelBooking->db->delete($data['table'],array($data['field']=>$data['kode']));
      if (!$deleted){
          $this->response(array('status'=>'failure',
          'message'=>'an expected error trying to delete '),REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      } else {
          $this->response(array('status'=>'success','message'=>'Rollback success'));
      }
    }
    function checkDoublePsn_post()
    {
      $data = $_POST;
      $this->load->model('LfBooking/Booking_model','ModelBooking');
      $checkDataPsnDouble = $this->ModelBooking->CheckStatusPsnDouble();
      $this->response($checkDataPsnDouble, 200);
    }
    function checkBookingBerkas_post()
    {
      $this->load->model('LfBooking/Booking_model','bookingModel');
      $result = $this->bookingModel->checkTglBookingBerkas();
      $this->response($result,200);
    }
    function checkNomorSurat_post()
    {
      $this->load->model('LfBooking/Booking_model','bookingModel');
      $result = $this->bookingModel->checkNomorSuratBerkas();
      $this->response($result,200);
    }
}
