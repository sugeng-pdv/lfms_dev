<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends MY_Model {
    public function __construct()
	{
        $this->db = $this->load->database('db_lfbooking',true);
        $this->table = 'kalender';
        // $this->primary_key = '';
        parent::__construct();
	}
  public function getDataPegawaiPbj(){
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where("jab_pbj" ,"PBJ");
      $query = $this->db->get();
      $result = $query->result_array();

      return $result;
  }
  public function getDataKalender($postdata){
    $where = array();
    if(isset($postdata['jns_booking'])){
        if($postdata['jns_booking']!=''){
            $where['UPPER(kalender.jns_booking)']= $this->db->escape_like_str(strtoupper($postdata['jns_booking']));

        }
    }
    if(isset($postdata['jns_sektor'])){
        if($postdata['jns_sektor']!=''){
            $where['UPPER(kalender.jns_sektor)']=$this->db->escape_like_str(strtoupper($postdata['jns_sektor']));
        }
    }
    if(isset($postdata['akses'])){
        if($postdata['akses'] > 3 && $postdata['akses'] != 5){
          if(isset($postdata['instansi'])){
              if($postdata['instansi']!=''){
                  $where['kalender.instansi'] = $postdata['instansi'];
                  // print_r($this->db->escape_like_str(strtoupper($postdata['jns_booking'])));die();
              }
          }
        }
    }

    // if(isset($postdata['start'])){
    //   // print_r("sdfghfgdjhf");die();
    //     if($postdata['start']!=''){
    //         $where['start_date'] = (>= $postdata['start']);
    //     }
    // }
    // if(isset($postdata['end'])){
    //     if($postdata['end']!=''){
    //         $where['start_date'] = (<= $postdata['end']);
    //     }
    // }
    // print_r($where);die();
      // $JnsBooking =$postdata['jns_booking'];
      // $startDate = $postdata['start'];
      // $endDate = $postdata['end'];
      // $instansi = $postdata['instansi'];
      // $jns_sektor = $postdata['jns_sektor'];

      $this->db->select('kalender.*,tbl_ppk.nm_ppk');
      $this->db->from($this->table);
      $this->db->join('mst_jns_booking','mst_jns_booking.id_booking = kalender.jns_booking','LEFT');
      $this->db->join('mst_jns_sektor','mst_jns_sektor.id_sektor = kalender.jns_sektor','LEFT');
      $this->db->join('tbl_ppk','tbl_ppk.id_ppk = kalender.instansi','LEFT');
      $this->db->like($where);
      // $this->db->where("jns_booking" ,$JnsBooking);
      // $this->db->where("instansi" ,$instansi);
      if(isset($postdata['start'])){
        $this->db->where("kalender.start_date >=", $postdata['start']);
      }
      if(isset($postdata['end'])){
        $this->db->where("kalender.start_date <=",$postdata['end']);
      }
      $this->db->where("kalender.status_delete",0);
      $query = $this->db->ORDER_BY("kalender.start_date","ASC");
      $query = $this->db->get();
      $result = $query->result_array();
      return $result;
  }
  public function getDataKalenderAll($postdata)
  {
    $where = array();
    if(isset($postdata['jns_booking'])){
        if($postdata['jns_booking']!=''){
            $where['UPPER(kalender.jns_booking)']= $this->db->escape_like_str(strtoupper($postdata['jns_booking']));

        }
    }
    if(isset($postdata['jns_sektor'])){
        if($postdata['jns_sektor']!=''){
            $where['UPPER(kalender.jns_sektor)']=$this->db->escape_like_str(strtoupper($postdata['jns_sektor']));
        }
    }
    if(isset($postdata['akses'])){
        if($postdata['akses'] > 3 && $postdata['akses'] != 5){
          if(isset($postdata['instansi'])){
              if($postdata['instansi']!=''){
                  $where['kalender.instansi'] = $postdata['instansi'];
                  // print_r($this->db->escape_like_str(strtoupper($postdata['jns_booking'])));die();
              }
          }
        }
    }
      $this->db->select('*,tbl_ppk.keterangan');
      $this->db->from($this->table);
      $this->db->join('mst_jns_booking','mst_jns_booking.id_booking = kalender.jns_booking','LEFT');
      $this->db->join('mst_jns_sektor','mst_jns_sektor.id_sektor = kalender.jns_sektor','LEFT');
      $this->db->join('tbl_ppk','tbl_ppk.id_ppk = kalender.instansi','LEFT');
      $this->db->where("kalender.status_libur",0);
      $this->db->where("kalender.status_tampil",1);
      $this->db->like($where);
      // $this->db->where("jns_booking" ,$JnsBooking);
      // $this->db->where("instansi" ,$instansi);
      $this->db->GROUP_BY("kalender.kd_kalender");
      if(isset($postdata['start'])){
        $this->db->where("kalender.start_date >=", $postdata['start']);
      }
      if(isset($postdata['end'])){
        $this->db->where("kalender.start_date <=",$postdata['end']);
      }
      $query = $this->db->get();
      $result = $query->result_array();
      return $result;
  }
  public function getJumlahHari($data)
  {
    $this->db->select('count(*) as total');
    $this->db->from($this->table);
    $this->db->where("kd_kalender",$data['kode']);
    $query = $this->db->get();
    // $result = $query->num_rows();
    $result = $query->result_array();
    return $result;
  }
  public function getTanggalLangsung($data){
    // print_r($data['start']);die();
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where("start_date",$data['start']);
      $this->db->where("jns_booking",1);
      $this->db->where("status_libur",0);
      $query = $this->db->get();
      $result = $query->num_rows();
      // $result = $query->result_array();
      return $result;
  }
  //getTanggalLibur
  public function getTanggalLibur($data){
    // print_r($data['start']);die();
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where("start_date",$data['start']);
      // $this->db->where("jns_booking",1);
      $this->db->where("status_libur",1);
      $query = $this->db->get();
      $result = $query->num_rows();
      // $result = $query->result_array();
      return $result;
  }
  //getTanggalLiburList
  public function getTanggalLiburList($data){
    // print_r($data['start']);die();
      $this->db->select('*');
      $this->db->from($this->table);
      // $this->db->where("start_date",$data['start']);
      // $this->db->where("jns_booking",1);
      $this->db->where("status_libur",1);
      $query = $this->db->get();
      // $result = $query->num_rows();
      $result = $query->result_array();
      return $result;
  }
  // getTanggalBerkas
  public function getTanggalBerkas($data){
    // print_r($data['start']);die();
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where("start_date",$data['start']);
      $this->db->where("jns_booking",2);
      // $this->db->where("status_libur",0);
      $query = $this->db->get();
      $result = $query->num_rows();
      // $result = $query->result_array();
      return $result;
  }
  //get total jam per loket dan per tanggal
  public function getTanggalBerkasAntrian($data){
    $this->db->select('sum(jml_jam) as dataJam');
    $this->db->from('tbl_antrian');
    $this->db->where("tgl_pengajuan",$data['start']);
    // $this->db->where("status_libur",0);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
  //get total jam per loket dan per tanggal
  public function getJumlahBerkasHarian($tanggal){
    $this->db->select('sum(jml_bidang) as dataJam');
    $this->db->from('tbl_antrian');
    $this->db->where("tgl_pengajuan",$tanggal);
    // $this->db->where("status_libur",0);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
  function CheckLoginUser($data){
    // print_r($data);
    $this->db->select('*');
    $this->db->from('user_login');
    $this->db->where("nip",$data['username']);
    // $this->db->where("password",$data['password']);
    $query = $this->db->get();
    // $result = $query->num_rows();
    $result = $query->result_array();
    return $result;
  }
  function CheckLoginToken($data){
    // print_r($data);
    $this->db->select('*');
    $this->db->from('user_login');
    // $this->db->where("nip",$data['username']);
    $this->db->where("password",$data['password']);
    $query = $this->db->get();
    // $result = $query->num_rows();
    $result = $query->result_array();
    return $result;
  }
  function getDataId($id)
  {
    // print_r($id."sbdgysbvdfybs");die();
    $this->db->select('max(id_kode) as dataId');
    $this->db->from($this->table);
    $this->db->where("jns_booking",$id);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
  public function getdataUser($data){
    $where = array();
    if(isset($data['akses'])){
        if($data['akses']!=''){
          if($data['akses'] != "1" || $data['akses'] != "2"){
            // $where['UPPER(akses)'] = $this->db->escape_like_str(strtoupper($data['akses']));
          }
        }
    }
      $this->db->select('user_login.id_login,user_login.nip,user_login.nama,user_login.instansi,user_login.no_hp,user_login.email,tbl_ppk.nm_ppk,tbl_user_akses.nm_akses');
      $this->db->from('user_login');
      $this->db->join('tbl_ppk','tbl_ppk.id_ppk = user_login.instansi','LEFT');
      $this->db->join('tbl_user_akses','tbl_user_akses.id = user_login.akses','LEFT');
      // $this->db->like($where);
      if($data['akses'] != "1" && $data['akses'] != "2"){
          $this->db->where("user_login.instansi",$data['instansi']);
        // $where['UPPER(akses)'] = $this->db->escape_like_str(strtoupper($data['akses']));
      }
      // else {
      // }
          $this->db->where("user_login.status",1);
          $this->db->where("user_login.akses != 1");
          $query = $this->db->get();
      // $result = $query->num_rows();
      $result = $query->result_array();
      return $result;
  }
  public function getDetailUser($id){

      $this->db->select('user_login.akses,user_login.nip,user_login.password as token,user_login.nama,user_login.instansi,user_login.no_hp,email,user_login.status as urutan,tbl_ppk.keterangan');
      $this->db->from('user_login');
      $this->db->join('tbl_ppk','tbl_ppk.id_ppk=user_login.instansi','LEFT');
      $this->db->where("user_login.akses != 1");
        if(!empty($id)){
          $this->db->where("id_login",$id);
        }
      $query = $this->db->get();
      $result = $query->result_array();
      return $result;
  }
  public function getdataUserProfile($data){
      $this->db->select('id_login,nip,nama,instansi,no_hp,email');
      $this->db->from('user_login');
      $this->db->where("id_login",$data['login']);
      $query = $this->db->get();
      // $result = $query->num_rows();
      $result = $query->result_array();
      return $result;
  }
  public function getdataLoket($data)
  {
    $this->db->select("(SELECT sum(jml_jam) FROM tbl_antrian where id_loket=1 and tgl_pengajuan='$data[start]') as a,(SELECT sum(jml_jam) FROM tbl_antrian where id_loket=2 and tgl_pengajuan='$data[start]') as b,(SELECT sum(jml_jam) FROM tbl_antrian where id_loket=3 and tgl_pengajuan='$data[start]') as c,(SELECT sum(jml_jam) FROM tbl_antrian where id_loket=4 and tgl_pengajuan='$data[start]') as d,(SELECT least(a,b,c,d)) AS MinJumlah");
    $this->db->from('tbl_antrian');
    $this->db->where("tgl_pengajuan",$data['start']);
    $this->db->GROUP_BY("b");
    $query = $this->db->get();
    // $result = $query->num_rows();
    $result = $query->result_array();
    return $result;
  }
  public function getdataDetailLoket()
  {
    $data=($_POST);
    $this->db->select("tbl_antrian.id_loket,tbl_antrian.jml_bidang,tbl_antrian.jam_start,tbl_antrian.jam_end,tbl_loket.nm_loket");
    $this->db->from('tbl_antrian');
    $this->db->join('tbl_loket','tbl_loket.id_loket = tbl_antrian.id_loket','LEFT');
    $this->db->where("tbl_antrian.id_kalender",$data['kd_kalender']);
    $this->db->where("tbl_antrian.tgl_pengajuan",$data['tgl_pengajuan']);
    // $this->db->GROUP_BY("b");
    $query = $this->db->get();
    // $result = $query->num_rows();
    $result = $query->result_array();
    return $result;
  }
  public function checkJam($tanggal,$loket)
  {
    $this->db->select('max(jam_end) as dataJam');
    $this->db->from('tbl_antrian');
    $this->db->where("id_loket",$loket);
    $this->db->where("tgl_pengajuan",$tanggal);
    $query = $this->db->get();
    $result = $query->result_array();

    return $result;
  }
  public function cekTanggal()
  {
    $this->db->select('tgl_setting');
    $this->db->from('tbl_cek_tgl');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
  public function checkLibur($tanggal)
  {
    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->where("start_date",$tanggal);
    $this->db->where("status_libur",1);
    $query = $this->db->get();
    $result = $query->num_rows();
    // $result = $query->result_array();
    return $result;
  }
  public function getDataSettingHariPengajuan()
  {
    $this->db->select('*');
    $this->db->from('mst_setting_hari');
    $this->db->join('mst_jns_booking','mst_jns_booking.id_booking = mst_setting_hari.id_jns_booking','LEFT');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
  public function get_data_loket()
  {
    $this->db->select('*');
    $this->db->from('tbl_loket');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
  public function get_data_konfigurasi($getdata)
  {
      $this->db->select('*');
      $this->db->from("mst_setting_hari");
      $this->db->where('id_jns_booking',$getdata);
      $query = $this->db->get();
      $result = $query->result_array();
      return $result;
  }
  public function cari_data_loket_1_old()
  {
    $this->db->select('*');
    $this->db->select('tbl_loket.nm_loket');
    $this->db->from('tbl_antrian');
    $this->db->join('tbl_loket','tbl_antrian.id_loket = tbl_loket.id_loket','LEFT');
    $this->db->where('tbl_antrian.tgl_pengajuan',$this->input->post('tanggal'));
    $this->db->where('tbl_loket.status',1);
    $this->db->group_by('tbl_antrian.id_loket');
    $query = $this->db->get();
    // $result = $query->result_array();
    $result = $query->num_rows();
    return $result;
  }
  public function cari_data_loket_1($data)
  {
    // print_r($data['id_loket']);die();
    $this->db->select('id_loket');
    $this->db->from('tbl_antrian');
    $this->db->where('tbl_antrian.tgl_pengajuan',$data['tanggal']);
    $this->db->where('tbl_antrian.id_loket',$data['id_loket']);
    $query = $this->db->get();
    $result = $query->result_array();
    // $result = $query->num_rows();
    return $result;
  }
  public function cari_data_loket_2()
  {
    $this->db->select('max(id_loket) as id_loket_max');
    // $this->db->select('tbl_loket.nm_loket');
    $this->db->from('tbl_antrian');
    // $this->db->join('tbl_loket','tbl_antrian.id_loket = tbl_loket.id_loket','LEFT');
    $this->db->where('tbl_antrian.tgl_pengajuan',$this->input->post('tanggal'));
    $query = $this->db->get();
    $result = $query->result_array();
    // $result = $query->num_rows();
    return $result;
  }
  public function cari_data_loket_3()
  {
    // print_r($this->input->post('jumlah_jam_kerja'));die();
    // print_r($this->input->post('jumlah_jam_kerja'));die();
    $this->db->select('tbl_antrian.*');
    // $this->db->select('max(tbl_antrian.jam_end) as jam_max,min(tbl_antrian.id_loket) as id_loket_min,tbl_antrian.*');
    $this->db->select('tbl_loket.id_loket,tbl_loket.nm_loket');
    $this->db->from('tbl_antrian');
    $this->db->join('tbl_loket','tbl_antrian.id_loket = tbl_loket.id_loket','LEFT');
    $this->db->where('tbl_antrian.tgl_pengajuan',$this->input->post('tanggal'));
    $this->db->where('tbl_antrian.jam_end < '.$this->input->post('jumlah_jam_kerja'));
    $this->db->where('tbl_antrian.status_loket',0);
    $this->db->where('tbl_loket.status',1);
    $this->db->order_by('tbl_antrian.id_loket','asc');
    $this->db->order_by('tbl_antrian.jam_end','desc');
    $this->db->limit(1);
    // $this->db->having('tbl_antrian.jam_end','max(tbl_antrian.jam_end)');
    // $this->db->having('tbl_antrian.jam_end','jam_max');
    $query = $this->db->get();
    $result = $query->result_array();
    // $result = $query->num_rows();
    return $result;
  }
  public function get_nama_loket($getdata)
  {
    $this->db->select('id_loket,nm_loket');
    $this->db->from('tbl_loket');
    $this->db->where('id_loket',$getdata);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
  public function get_jumlah_loket()
  {
    $this->db->select('*');
    $this->db->from('tbl_loket');
    $this->db->where('status',1);
    $query = $this->db->get();
    $result = $query->num_rows();
    return $result;
  }
  public function Save_booking_berkas()
  {
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
    $dataInsert['start_date']=$this->input->post('start_date');
    $dataInsert['end_date']=$this->input->post('start_date');
    $dataInsert['status_tampil']=1;
    $sisa_bulat =$data['ttl_hariAll']-1;
    //deafult sisa hari di Awal
    $sisa_awal = FALSE;
    //deafult sisa hari di akhir
    $sisa_akhir =TRUE;
    if($data['ttl_jamFix']==0)
    {
      $sisa_akhir=FALSE;
    }
    if($data['kode_hitung'] == 3)
    {
      $sisa_awal = TRUE;
    }
    // if($sisa_awal == TRUE)
    // {

    // }
  }
  // PPK
  public function get_data_ppk()
  {
    $this->db->select('*');
    $this->db->from('tbl_ppk');
    $this->db->where('id_ppk != 1');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
  public function get_data_ppk_select()
  {
    $this->db->select('id_ppk,nm_ppk');
    $this->db->from('tbl_ppk');
    $this->db->where('status',1);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
  public function get_data_ppk_detail($idPpk)
  {
    $this->db->select('keterangan');
    $this->db->from('tbl_ppk');
    $this->db->where('id_ppk',$idPpk);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
  public function checkTglBooking()
  {
    $data = $_POST;
    $this->db->select('count(WEEK(kalender.start_date,1)) as jumlah');
    // $this->db->select('*');
    $this->db->from('kalender');
    $this->db->where('WEEK(kalender.start_date,1)',$data['week']);
    $this->db->where('kalender.jns_booking',1);
    $this->db->where('kalender.status_delete',0);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
  public function CheckStatusPsnDouble()
  {
    $data = $_POST;
    $this->db->select('*');
    // $this->db->select('*');
    $this->db->from('kalender');
    // $this->db->where('jns_booking',$data['txtJenis']);
    $this->db->where('kalender.jns_booking',1);
    $this->db->where('kalender.jns_sektor',$data['cmbSektor']);
    $this->db->where('kalender.instansi',$data['instansi']);
    $this->db->like('kalender.title',$data['title']);
    $this->db->where('WEEK(kalender.start_date,1)',$data['week']);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
  public function checkTglBookingBerkas2()
  {
    $data = $_POST;
    $this->db->select('sum(kalender.jml_bidang) as jmlBidang');
    $this->db->select('sum(kalender.jml_non_bidang) as jmlNonBidang');
    $this->db->from('kalender');
    $this->db->where('kalender.start_date',$data['start']);
    $this->db->where('kalender.jns_booking',2);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
  public function checkTglBookingBerkas()
  {
    $data = $_POST;
    $this->db->select('sum(tbl_antrian.jml_jam) as jmlJam');
    // $this->db->select('sum(kalender.jml_non_bidang) as jmlNonBidang');
    $this->db->from('tbl_antrian');
    $this->db->where('tbl_antrian.tgl_pengajuan',$data['start']);
    // $this->db->where('kalender.jns_booking',2);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }
  public function checkNomorSuratBerkas(){
    $data = $_POST;
    // print_r($data);die();
    $this->db->select('kalender.no_surat');
    $this->db->from('kalender');
    $this->db->where('kalender.no_surat',$data['nomor']);
    $this->db->where('kalender.status_delete',0);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  //check user
  public function checkNipUser(){
    $data = $_POST;
    // print_r($data);die();
    $this->db->select('user_login.nip');
    $this->db->from('user_login');
    $this->db->where('user_login.nip',$data['nip']);
    $this->db->where('user_login.email',$data['email']);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

}
