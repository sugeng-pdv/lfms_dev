<?php

class Vms_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'pegawai';
        $this->primary_key = 'nip';
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
    public function getData($data){
      // print_r($data['nip']."-------------");die();

        $where = array();
        if(isset($data['nip'])){
            if($data['nip']!=''){
                $where['UPPER(nip)']= $this->db->escape_like_str(strtoupper($data['nip']));
                //$inv_entity_code = $this->db->escape_like_str(strtoupper($data['INV_ENTITY_CODE']));
            }
        }
        // print_r($where);die();
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('direktorat','pegawai.id_dir = direktorat.id_dir',"LEFT");
        $this->db->where("pegawai.akses_iku" ,"1");
        $this->db->like($where);
        $this->db->order_by("pegawai.nama","asc");
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }
    public function getDataUsulan($data){
        $nip = $data['nip'];//197602011999031001
        $jabatan = $data['jabatan'];
        $divisi  = $data['divisi'];
        $direktorat = $data['direktorat'];
        $where = array();
        if(isset($data['nip'])){
            if($data['nip']!=''){
                $where['UPPER(nip)']= $this->db->escape_like_str(strtoupper($data['nip']));
                //$inv_entity_code = $this->db->escape_like_str(strtoupper($data['INV_ENTITY_CODE']));
            }
        }
        // print_r($where);die();
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('direktorat','pegawai.id_dir = direktorat.id_dir',"LEFT");
        $this->db->join('jabatan','pegawai.id_jab = jabatan.id_jab',"LEFT");
        // $this->db->where("pegawai.akses_iku" ,"1");
        if($nip == 197602011999031001){

        }else{
          if($jabatan == "DIRUT"){
            $this->db->where("pegawai.id_jab","DIR");
            // $this->db->where("pegawai.id_jab","KADIV");
          }
          if($jabatan == "DIR"){
            $this->db->where("pegawai.id_jab","KADIV");
            $this->db->where("pegawai.id_dir",$direktorat);
            // $this->db->where("pegawai.id_jab","KADIV");
          }
          if($jabatan == "KADIV" || $jabatan == "ADM"){
            $this->db->where("pegawai.id_jab != 'DIRUT'");
            $this->db->where("pegawai.id_jab != 'DIR'");
            $this->db->where("pegawai.id_jab != 'KADIV'");
            // $this->db->where("pegawai.id_jab != 'KADIV'");
            $this->db->where("pegawai.id_bag",$divisi);
          }
          $this->db->where("pegawai.nip != $nip");
        }
        // $this->db->where("pegawai.nip != $nip_usulan");
        $this->db->where("jabatan.k_jab","Pegawai");

        // $this->db->like($where);
        $this->db->order_by("pegawai.nama","asc");
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

    public function getDataPenilaian($data){
        $nip = $data['nip'];
        // $jabatan = $data['jabatan'];
        // $divisi  = $data['divisi'];
        // $direktorat = $data['direktorat'];
        $where = array();
        if(isset($data['nip'])){
            if($data['nip']!=''){
                $where['UPPER(nip)']= $this->db->escape_like_str(strtoupper($data['nip']));
            }
        }
        // print_r($where);die();
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('direktorat','pegawai.id_dir = direktorat.id_dir',"LEFT");
        $this->db->join('jabatan','pegawai.id_jab = jabatan.id_jab',"LEFT");
        $this->db->join('tbl_usulan_pegawai','pegawai.nip = tbl_usulan_pegawai.nip_usulan',"LEFT");
        $this->db->where("jabatan.k_jab","Pegawai");
        $this->db->where("tbl_usulan_pegawai.nip_usulan",$nip);
        // $this->db->like($where);
        $this->db->order_by("pegawai.nama","asc");
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

    public function getDataUsulanPegawai($data){
        //   print_r($data);die();
        $nip_usulan = $data['nip_usulan'];
        $nip = $data['nip_atasan'];
        $jabatan = $data['jabatan'];
        $jabatan_usulan = $data['jabatan_usulan'];
        $divisi  = $data['divisi'];
        $divisi_usulan = $data['divisi_usulan'];
        $direktorat = $data['direktorat'];
        $direktorat_usulan = $data['direktorat_usulan'];
        $where = array();
        if(isset($data['nip'])){
            if($data['nip']!=''){
                $where['UPPER(nip)']= $this->db->escape_like_str(strtoupper($data['nip']));
                //$inv_entity_code = $this->db->escape_like_str(strtoupper($data['INV_ENTITY_CODE']));
            }
        }
        // print_r($where);die();
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('direktorat','pegawai.id_dir = direktorat.id_dir',"LEFT");
        $this->db->join('jabatan','pegawai.id_jab = jabatan.id_jab',"LEFT");
        // $this->db->join('tbl_usulan_pegawai','pegawai.nip = tbl_usulan_pegawai.id_jab',"LEFT");
        // $this->db->where("pegawai.akses_iku" ,"1");
        if($jabatan == "DIRUT"){
          $this->db->where("pegawai.id_jab","DIR");
          // $this->db->where("pegawai.id_jab","KADIV");
        }
        if($jabatan == "DIR"){
          $this->db->where("pegawai.id_jab","KADIV");
          $this->db->where("pegawai.id_dir",$direktorat);
          // $this->db->where("pegawai.id_jab","KADIV");
        }elseif($jabatan == "KADIV" || $jabatan == "ADM"){
          $this->db->where("pegawai.id_jab != 'DIRUT'");
          $this->db->where("pegawai.id_jab != 'DIR'");
          $this->db->where("pegawai.id_jab != 'KADIV'");
          // $this->db->where("pegawai.id_jab != 'KADIV'");
          $this->db->where("pegawai.id_bag",$divisi);
        }else{

        }
        // $this->db->where("pegawai.nip != $nip");
        $this->db->where("pegawai.nip != $nip_usulan");
        $this->db->where("jabatan.k_jab","Pegawai");

        // $this->db->like($where);
        $this->db->order_by("pegawai.nama","asc");
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }
    public function getDataUsulanPegawaiAtasan($data){
      //   print_r($data);die();
      $nip_usulan = $data['nip_usulan'];
      $nip = $data['nip_atasan'];
      $jabatan = $data['jabatan'];
      $jabatan_usulan = $data['jabatan_usulan'];
      $divisi  = $data['divisi'];
      $divisi_usulan = $data['divisi_usulan'];
      $direktorat = $data['direktorat'];
      $direktorat_usulan = $data['direktorat_usulan'];
      $where = array();
      if(isset($data['nip'])){
          if($data['nip']!=''){
              $where['UPPER(nip)']= $this->db->escape_like_str(strtoupper($data['nip']));
              //$inv_entity_code = $this->db->escape_like_str(strtoupper($data['INV_ENTITY_CODE']));
          }
      }
      // print_r($where);die();
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->join('direktorat','pegawai.id_dir = direktorat.id_dir',"LEFT");
      $this->db->join('jabatan','pegawai.id_jab = jabatan.id_jab',"LEFT");
      // $this->db->join('tbl_usulan_pegawai','pegawai.nip = tbl_usulan_pegawai.id_jab',"LEFT");
      // $this->db->where("pegawai.akses_iku" ,"1");
      // if($jabatan_usulan == "DIRUT"){
      //   $this->db->where("pegawai.id_jab","KADIV");
      //   $this->db->where("pegawai.id_dir",$direktorat_usulan);
      //
      //   // $this->db->where("pegawai.id_jab","KADIV");
      // }
      if($jabatan_usulan == "DIR"){
        $this->db->where("pegawai.id_jab",'DIRUT');
        // $this->db->where("pegawai.id_jab != 'DIR'");
        // $this->db->where("pegawai.id_jab != 'KADIV'");
        // $this->db->where("pegawai.id_dir",$direktorat);
        // $this->db->where("pegawai.id_bag",$divisi_usulan);
        // $this->db->where("pegawai.id_jab","KADIV");
      }elseif($jabatan_usulan == "KADIV" || $divisi_usulan == "LMAN.4.1"){
        $this->db->where("pegawai.id_jab",'DIR');
        // $this->db->where("pegawai.id_jab != 'DIR'");
        // $this->db->where("pegawai.id_jab != 'KADIV'");
        if($divisi_usulan == "LMAN.4.1" || $direktorat_usulan =="LMAN.4"){
          $this->db->where("pegawai.id_dir","LMAN.2");
          // echo "string";
        }else{
          $this->db->where("pegawai.id_dir",$direktorat_usulan);
        }
        // $this->db->where("pegawai.id_bag",$divisi_usulan);
        // $this->db->where("pegawai.id_jab","KADIV");
      }else{
        $this->db->where("pegawai.id_jab",'KADIV');
        $this->db->where("pegawai.id_jab != 'DIRUT'");
        $this->db->where("pegawai.id_jab != 'DIR'");
        // $this->db->where("pegawai.id_jab != 'DIR'");
        // $this->db->where("pegawai.id_jab != 'KADIV'");
        $this->db->where("pegawai.id_bag",$divisi_usulan);
        // $this->db->where("pegawai.id_dir",$direktorat);
      }
      // $this->db->where("pegawai.nip != $nip");
      // $this->db->where("pegawai.nip != $nip_usulan");
      $this->db->where("jabatan.k_jab","Pegawai");

      // $this->db->like($where);
      $this->db->where("pegawai.id_jab != 'DIRUT'");
      $this->db->order_by("pegawai.nama","asc");
      $query = $this->db->get();
      $result = $query->result_array();

      return $result;
    }
    public function getDataUsulanPegawaiBawahan($data){
        //   print_r($data);die();
        $nip_usulan = $data['nip_usulan'];
        $nip = $data['nip_atasan'];
        $jabatan = $data['jabatan'];
        $divisi  = $data['divisi'];
        $divisi_usulan = $data['divisi_usulan'];
        $direktorat = $data['direktorat'];
        $direktorat_usulan = $data['direktorat_usulan'];
        $where = array();
        if(isset($data['nip'])){
            if($data['nip']!=''){
                $where['UPPER(nip)']= $this->db->escape_like_str(strtoupper($data['nip']));
                //$inv_entity_code = $this->db->escape_like_str(strtoupper($data['INV_ENTITY_CODE']));
            }
        }
        // print_r($where);die();
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('direktorat','pegawai.id_dir = direktorat.id_dir',"LEFT");
        $this->db->join('jabatan','pegawai.id_jab = jabatan.id_jab',"LEFT");
        // $this->db->join('tbl_usulan_pegawai','pegawai.nip = tbl_usulan_pegawai.id_jab',"LEFT");
        // $this->db->where("pegawai.akses_iku" ,"1");
        if($jabatan == "DIRUT"){
          $this->db->where("pegawai.id_jab","KADIV");
          $this->db->where("pegawai.id_dir",$direktorat_usulan);

          // $this->db->where("pegawai.id_jab","KADIV");
        }
        if($jabatan == "DIR"){
          // $this->db->where("pegawai.id_jab","KADIV");
          $this->db->where("pegawai.id_jab != 'DIRUT'");
          $this->db->where("pegawai.id_jab != 'DIR'");
          $this->db->where("pegawai.id_jab != 'KADIV'");
          $this->db->where("pegawai.id_dir",$direktorat);
          $this->db->where("pegawai.id_bag",$divisi_usulan);
          // $this->db->where("pegawai.id_jab","KADIV");
        }
        $this->db->where("pegawai.nip != $nip");
        $this->db->where("pegawai.nip != $nip_usulan");
        $this->db->where("jabatan.k_jab","Pegawai");

        // $this->db->like($where);
        $this->db->order_by("pegawai.nama","asc");
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }
    // getDataCheckPegawai
    //status nip_usulan/nip_atasan/nip_penilai
    public function getDataCheckPegawai($nip_usulan,$nip_atasan,$nip_penilai){
        // echo "string".$nip_usulan."-".$nip_atasan."....".$nip_penilai;
        $this->db->select('pegawai.nip');
        $this->db->select('tbl_usulan_pegawai.*');
        $this->db->from($this->table);
        $this->db->join('tbl_usulan_pegawai','pegawai.nip = tbl_usulan_pegawai.nip_penilai',"LEFT");
        // $this->db->join('jabatan','pegawai.id_jab = jabatan.id_jab',"LEFT");
        // $this->db->join('tbl_usulan_pegawai','pegawai.nip = tbl_usulan_pegawai.id_jab',"LEFT");
        // $this->db->where("pegawai.akses_iku" ,"1");

        $this->db->where("tbl_usulan_pegawai.nip_usulan",$nip_usulan);
        $this->db->where("tbl_usulan_pegawai.nip_penilai",$nip_penilai);
        // $this->db->order_by("pegawai.nama","asc");
        $query = $this->db->get();
        $result = $query->result_array();
        // echo "string".$query->result_array()->nip;die();
        return $result;
    }

    public function getDataProfile($data){
      // print_r($data['nip']."-------------");die();
        $where = array();
        if(isset($data['nip'])){
            if($data['nip']!=''){
                $where['UPPER(pegawai.nip)']= $this->db->escape_like_str(strtoupper($data['nip']));
                //$inv_entity_code = $this->db->escape_like_str(strtoupper($data['INV_ENTITY_CODE']));
            }
        }
        // print_r($where);die();
        $this->db->select('pegawai.nip,pegawai.nama,pegawai.jenis_kelamin,pegawai.tgl_masuk,direktorat.n_dir,d_jabatan.d_jabatan,bagian.n_bag');
        $this->db->from($this->table);
        $this->db->join('direktorat','pegawai.id_dir = direktorat.id_dir',"LEFT");
        $this->db->join('d_jabatan','pegawai.id_det =  d_jabatan.id_det',"LEFT");
        $this->db->join('bagian','pegawai.id_bag = bagian.id_bag',"LEFT");
        $this->db->where("pegawai.akses_iku" ,"1");
        $this->db->like($where);
        $this->db->order_by("pegawai.nama","asc");
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }
    public function getDataIku($data){
      // print_r($data['nip']."-------------");die();

        $where = array();
        if(isset($data['nip'])){
            if($data['nip']!=''){
                $where['UPPER(nip)']= $this->db->escape_like_str(strtoupper($data['nip']));
                //$inv_entity_code = $this->db->escape_like_str(strtoupper($data['INV_ENTITY_CODE']));
            }
        }
        // print_r($where);die();
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('direktorat','pegawai.id_dir = direktorat.id_dir',"LEFT");
        $this->db->join('d_jabatan','pegawai.id_det = d_jabatan.id_det',"LEFT");
        $this->db->join('bagian','pegawai.id_bag = bagian.id_bag',"LEFT");
        $this->db->join('jabatan','pegawai.id_jab = jabatan.id_jab',"LEFT");
        $this->db->where("jabatan.k_jab" ,"Pegawai");
        // $this->db->where("pegawai.akses_iku" ,"1");
        $this->db->like($where);
        $this->db->order_by("pegawai.nama","asc");
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }
    public function getDataPegawai($nip){
      // print_r($data['nip']."-------------");die();

        $where = array();
        if(isset($data['nip'])){
            if($data['nip']!=''){
                $where['UPPER(nip)']= $this->db->escape_like_str(strtoupper($data['nip']));
                //$inv_entity_code = $this->db->escape_like_str(strtoupper($data['INV_ENTITY_CODE']));
            }
        }
        // print_r($where);die();
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('direktorat','pegawai.id_dir = direktorat.id_dir',"LEFT");
        $this->db->join('d_jabatan','pegawai.id_det = d_jabatan.id_det',"LEFT");
        $this->db->join('bagian','pegawai.id_bag = bagian.id_bag',"LEFT");
        $this->db->join('jabatan','pegawai.id_jab = jabatan.id_jab',"LEFT");
        $this->db->where("pegawai.nip" ,$nip);
        // $this->db->where("pegawai.akses_iku" ,"1");
        // $this->db->like($where);
        // $this->db->order_by("pegawai.nama","asc");
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

}
