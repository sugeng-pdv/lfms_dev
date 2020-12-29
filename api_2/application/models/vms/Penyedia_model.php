
<?php

/*
 * Created on Tue Jun 16 2020 1:37:38 PM
 *
 * Filename Perusahaan_model.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */




class Penyedia_model extends MY_Model {
    public function __construct()
	{
        $this->db = $this->load->database('db_eproc',true);
        $this->table = 'perusahaan';
        // $this->primary_key = 'id';
        parent::__construct();
    }

    function getDataPerusahaan()
    {
        $postdata = $_POST;
        $this->db->select('perusahaan.id_account,perusahaan.nama,perusahaan.tahun_pendirian,perusahaan.siup_siujk_nib,perusahaan.npwp,perusahaan.alamat,perusahaan.id_provinsi,perusahaan.id_kota,perusahaan.telepon,perusahaan.handpone,perusahaan.whatapps,perusahaan.fax,perusahaan.website');
        $this->db->select('accounts.email');
        $this->db->select('ref_jenis_perusahaan.nama as jenis_perusahaan');
        $this->db->from('perusahaan');
        $this->db->join('accounts','accounts.id = perusahaan.id_account','LEFT');
        $this->db->join('ref_jenis_perusahaan','ref_jenis_perusahaan.id = perusahaan.id_jenis_perusahaan','LEFT');
        $this->db->where("perusahaan.id" ,$this->mx_encryption->decrypt($postdata['token']));
        $query = $this->db->get();
        $result = $query->result_array()[0];
        return $result;
    }

    function getDataIzinUsaha()
    {
        $postdata = $_POST;
        $where = array();
        if(isset($postdata['lman'])){
            if($postdata['lman']!=''){
                $where['UPPER(lisensi_perusahaan.id)']= $this->db->escape_like_str(strtoupper($this->mx_encryption->decrypt($postdata['lman'])));
            }
        }
        $this->db->select('lisensi_perusahaan.id,lisensi_perusahaan.id_perusahaan,lisensi_perusahaan.id_jenis,lisensi_perusahaan.nomor,lisensi_perusahaan.penerbit,lisensi_perusahaan.telp_penerbit,lisensi_perusahaan.tanggal_terbit,lisensi_perusahaan.berlaku_sampai,lisensi_perusahaan.terverifikasi');
        $this->db->select('ref_jenis_dokumen.nama as izin_usaha');
        $this->db->from('lisensi_perusahaan');
        // $this->db->join('accounts','accounts.id = perusahaan.id_account','LEFT');
        $this->db->join('ref_jenis_dokumen','ref_jenis_dokumen.id = lisensi_perusahaan.id_jenis','LEFT');
        $this->db->where("lisensi_perusahaan.id_perusahaan" ,$this->mx_encryption->decrypt($postdata['token']));
        // $this->db->like($where);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    
    


}
