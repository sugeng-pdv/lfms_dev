<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruby_model extends MY_Model {
    public function __construct()
	{
        $this->db = $this->load->database('db_ruby',true);
        $this->table = 'entry';
        // $this->primary_key = '';
        parent::__construct();
    }
    
    function getDataRubyEvents()
    {
        $postdata = $_POST;
        // $this->db->select('from_unixtime(start_time,"%Y-%m-%d %h %i %s") as tgl_start');
        $this->db->select('from_unixtime(mrbs_entry.start_time,"%Y-%m-%d") as tgl_start');
        $this->db->select('from_unixtime(mrbs_entry.start_time,"%H %i %s") as jam_start');
        $this->db->select('from_unixtime(mrbs_entry.end_time,"%Y-%m-%d") as tgl_end');
        $this->db->select('from_unixtime(mrbs_entry.end_time,"%H %i %s") as jam_end');
        $this->db->select('entry.*');
        $this->db->select('room.room_name,room.description');
        $this->db->select('area.area_name');
        $this->db->from('entry');
        $this->db->join('room','entry.room_id = room.id','LEFT');
        $this->db->join('area','room.area_id = area.id','LEFT');
        $this->db->where('room.area_id != 4');
        $this->db->where('room.area_id != 2');
        $this->db->where('room.disabled',0);
        $this->db->where('from_unixtime(mrbs_entry.start_time,"%Y-%m-%d")',$postdata['tgl_skr']);
        $this->db->order_by('area.id','ASC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    function getDataRubyDrivers()
    {
        $postdata = $_POST;
        // $this->db->select('from_unixtime(start_time,"%Y-%m-%d %h %i %s") as tgl_start');
        $this->db->select('from_unixtime(mrbs_entry.start_time,"%Y-%m-%d") as tgl_start');
        $this->db->select('from_unixtime(mrbs_entry.start_time,"%H %i %s") as jam_start');
        $this->db->select('from_unixtime(mrbs_entry.end_time,"%Y-%m-%d") as tgl_end');
        $this->db->select('from_unixtime(mrbs_entry.end_time,"%H %i %s") as jam_end');
        $this->db->select('entry.*,entry.description as detail_task');
        $this->db->select('room.room_name,room.description');
        $this->db->select('area.area_name');
        $this->db->from('entry');
        $this->db->join('room','entry.room_id = room.id','LEFT');
        $this->db->join('area','room.area_id = area.id','LEFT');
        $this->db->where('room.area_id',4);
        $this->db->where('room.disabled',0);
        $this->db->where('from_unixtime(mrbs_entry.start_time,"%Y-%m-%d")',$postdata['tgl_skr']);
        $this->db->order_by('jam_start','DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;

    }



    public function getMainMenu($data)
    {
        // print_r($data['mgrupuser']);die();
        $this->db->select('*');
        $this->db->from('menu_side');
        $this->db->where('is_main_menu',0);
        $this->db->where('stat',1);
        $this->db->like("role",$data['mgrupuser']);
        $this->db->order_by('init');
        // $this->db->where("password",$data['password']);
        $query = $this->db->get();
        // $result = $query->num_rows();
        $result = $query->result_array();
        return $result;
    }
    public function getSubMenu($data)
    {
        // print_r($data['mgrupuser']);die();
        $this->db->select('*');
        $this->db->from('menu_side');
        $this->db->where('stat',1);
        $this->db->like("role",$data['mgrupuser']);
        $this->db->like("is_main_menu",$data['id_modul']);
        $this->db->order_by('init');
        // $this->db->where("password",$data['password']);
        $query = $this->db->get();
        // $result = $query->num_rows();
        $result = $query->result_array();
        return $result;
    }
    //untuk tari data pegawai berdasrkan NIP/NPP
    public function getDataPegawaiByNip()
    {
        $data = $_POST;
        $this->db->select('pegawai.id,pegawai.nama,pegawai.nama_panggilan,pegawai.jenis_kelamin');
        $this->db->select('ref_jk.uraian');
        $this->db->join('ref_jk','pegawai.jenis_kelamin = ref_jk.id','LEFT');
        $this->db->from('pegawai');
        $this->db->where('nip_npp',$data['nip_npp']);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    //untuk tari data pegawai berdasrkan NIP/NPP
    public function getDataPegawaiById()
    {
        $data = $_POST;
        $this->db->select('pegawai.nip_npp,pegawai.gelar_sebelum,pegawai.gelar_sesudah,pegawai.nama,pegawai.tmpt_lahir,pegawai.tgl_lahir');
        $this->db->select('pegawai.access_card,pegawai.no_kk,pegawai.nik,pegawai.npwp,pegawai.no_tlp,pegawai.no_hp,pegawai.email_dinas,pegawai.email_pribadi');
        $this->db->select('pegawai.provinsi_ktp,pegawai.kota_ktp,pegawai.alamat_ktp,pegawai.kode_pos_ktp,pegawai.provinsi_tinggal,pegawai.kota_tinggal,pegawai.alamat_tinggal,pegawai.kode_pos_tinggal');
        $this->db->select('pegawai.nm_kontak_darurat,pegawai.hub_kontak_darurat,pegawai.no_kontak_darurat,pegawai.doc_kk,pegawai.doc_nik,pegawai.doc_ttd');
        $this->db->select('pegawai.jenis_kelamin as id_jk,pegawai.agama as id_agama,pegawai.gol_darah as id_gol_drh');

        $this->db->select('ref_jk.uraian as jns_kelamin');
        $this->db->select('ref_keyakinan.uraian as keyakinan');
        $this->db->select('ref_gol_darah.uraian as gol_drh');

        $this->db->from('pegawai');
        $this->db->join('ref_jk','ref_jk.id=pegawai.jenis_kelamin','LEFT');
        $this->db->join('ref_keyakinan','ref_keyakinan.id=pegawai.agama','LEFT');
        $this->db->join('ref_gol_darah','ref_gol_darah.id=pegawai.gol_darah','LEFT');

        $this->db->where('pegawai.id',$data['id']);
        $query = $this->db->get();
        $result = $query->result_array();
        
        return $result;
    }
    public function getProvinsi($id)
    {
        $where = array();
        if(isset($id)){
            if($id!=''){
                $where['UPPER(lman_ref_provinsi.id)']= $this->db->escape_like_str(strtoupper($id));
            }
        }
        $this->db->select('*');
        $this->db->from('ref_provinsi');
        $this->db->like($where);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;

    }
    public function getProvinsiKota($id)
    {
        $where = array();
        if(isset($id)){
            if($id!=''){
                $where['UPPER(lman_ref_kota.id_provinsi)']= $this->db->escape_like_str(strtoupper($id));
            }
        }
        $this->db->select('*');
        $this->db->from('ref_kota');
        $this->db->like($where);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getKota($id)
    {
        $where = array();
        if(isset($id)){
            if($id!=''){
                $where['UPPER(lman_ref_kota.id)']= $this->db->escape_like_str(strtoupper($id));
            }
        }
        $this->db->select('*');
        $this->db->from('ref_kota');
        $this->db->like($where);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getJnsKelamin($id)
    {
        $where = array();
        if(isset($id)){
            if($id!=''){
                $where['UPPER(lman_ref_jk.id)']= $this->db->escape_like_str(strtoupper($id));
            }
        }
        $this->db->select('*');
        $this->db->from('ref_jk');
        $this->db->like($where);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getAgama($id)
    {
        $where = array();
        if(isset($id)){
            if($id!=''){
                $where['UPPER(lman_ref_keyakinan.id)']= $this->db->escape_like_str(strtoupper($id));
            }
        }
        $this->db->select('*');
        $this->db->from('ref_keyakinan');
        $this->db->like($where);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getGolDrh($id)
    {
        $where = array();
        if(isset($id)){
            if($id!=''){
                $where['UPPER(lman_ref_gol_darah.id)']= $this->db->escape_like_str(strtoupper($id));
            }
        }
        $this->db->select('*');
        $this->db->from('ref_gol_darah');
        $this->db->like($where);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function cekPerubahan($table,$id,$uraian)
    {
        $where = array();
        if(isset($id)){
            if($id!=''){
                $where['UPPER('.$table.'.nip_npp)']= $this->db->escape_like_str(strtoupper($id));
            }
        }
        $this->db->select('*');
        $this->db->from($table);
        $this->db->like($where);
        $this->db->where('uraian',$uraian);
        // $this->db->where('nip_npp',$id);
        $this->db->where('status_approval',0);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_jb_organisasi()
    {
        $this->db->select('id as urutane,kode_dir as kodene,nm_dir as jenenge');
        $this->db->from('ref_direktorat');
        $this->db->where('status',1);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_jb_jabatan()
    {
        $this->db->select('id as urutane,kode as kodene,keterangan as jenenge');
        $this->db->from('ref_grup_jabatan');
        $this->db->where('status',1);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_jb_status_jabatan()
    {
        $this->db->select('id as urutane,uraian as jenenge');
        $this->db->from('ref_stat_jabatan');
        $this->db->where('status',1);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_jb_select_divisi()
    {
        $data =$_POST;
        $where = array();
        if(isset($data['urutane'])){
            if($data['urutane'] != ''){
                $where['UPPER(id_direktorat)']= $this->db->escape_like_str(strtoupper('['.$data['urutane'].']'));
            }
        }
        $this->db->select('id as urutane,nm_div as jenenge');
        $this->db->from('ref_divisi');
        $this->db->like($where);
        $this->db->where('status',1);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_jb_select_jabatan()
    {
        $data =$_POST;
        $where = array();
        if($data['urutane2'] == 16){
            if(isset($data['urutane'])){
                if($data['urutane'] != ''){                
                    $where['UPPER(direktorat)']= $this->db->escape_like_str(strtoupper($data['urutane']));
                }
            }
        }else{
            if($data['urutane2'] != ''){
                if(isset($data['urutane2'])){                
                    $where['UPPER(divisi)']= $this->db->escape_like_str(strtoupper($data['urutane2']));
                }
            }
        }
        $this->db->select('id as urutane,nm_jbt as jenenge');
        $this->db->from('ref_nm_jabatan');
        $this->db->where($where);
        $this->db->where('status',1);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_jb_select_jabatan_atasan()
    {
        $data =$_POST;
        // if($data['urutane'] != ''){
        //     if(isset($data['urutane'])){
        //         $data_id = $this->cek_id_nm_jabatan($data['urutane']);
        //     }
        // }
        $data_id = $this->cek_id_nm_jabatan($data['urutane']);
        $this->db->select('id as urutane,nm_jbt as jenenge');
        $this->db->from('ref_nm_jabatan');
        $this->db->where('id',$data_id);
        $this->db->where('is_atasan',1);
        $this->db->where('status',1);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    function cek_id_nm_jabatan($id='')
    {
        $where = array();
        if(isset($id)){
            if($id != ''){          
                $where['UPPER(id)']= $this->db->escape_like_str(strtoupper($id));
            }
        }
        $this->db->select('id as urutane,nm_jbt as jenenge,jbt_atasan');
        $this->db->from('ref_nm_jabatan');
        $this->db->where($where);
        $this->db->where('status',1);
        $query =  $this->db->get();
        $result = $query->result_array();
        $id_jbt = $result[0]['jbt_atasan'];
        return $id_jbt;
    }

    //datatable jabatan
    public function get_data_jabatan()
    {
        $this->db->select('riwayat_jbt.id,riwayat_jbt.id_uniq,ref_stat_jabatan.uraian as stat_jbt,ref_nm_jabatan.nm_jbt,ref_nm_jabatan.uraian,riwayat_jbt.tmt,riwayat_jbt.tgl_selesai_sk,riwayat_jbt.tgl_sk,riwayat_jbt.tgl_pelantikan,riwayat_jbt.no_sk,riwayat_jbt.doc_jbt,riwayat_jbt.status_setuju');
        $this->db->from('riwayat_jbt');
        $this->db->join('ref_stat_jabatan','ref_stat_jabatan.id=riwayat_jbt.status_jbt','LEFT');
        $this->db->join('ref_nm_jabatan','ref_nm_jabatan.id=riwayat_jbt.id_jbt','LEFT');
        $this->db->where('riwayat_jbt.status',1);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_data_jabatan_edit()
    {
        $data = $_POST;
        $where = array();
        if(isset($data['urutane'])){
            if($data['urutane'] != ''){          
                // $where['UPPER(id)']= $this->db->escape_like_str(strtoupper($data['urutane']));
                $where['id']= $data['urutane'];
            }
        }
        $this->db->select('*');
        $this->db->from('riwayat_jbt');
        $this->db->where($where);
        $this->db->where('status',1);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function deleteDataJbt()
    {
        $data=$_POST;
        $this->db->delete('riwayat_jbt');
        $this->db->where('id_uniq',$data['urutane']);
        $query  = $this->db->get();
        $result=$query;
        return $result;
    }
    public function deleteDataRiwayatJbt()
    {
        $data=$_POST;
        $this->db->delete('riwayat_jbt');
        $this->db->where('kd_uniq',$data['urutane']);
        $query  = $this->db->get();
        $result=$query;
        return $result;
    }

    //pangkat
    public function get_data_pangkat()
    {
        $data =$_POST;
        $where = array();
        if(isset($data['urutane'])){
            if($data['urutane'] != ''){
                $where['riwayat_pangkat.id_uniq']= $data['urutane'];
            }
        }
        $this->db->select('riwayat_pangkat.id,riwayat_pangkat.id_pegawai,riwayat_pangkat.id_uniq,ref_pangkat.id as panggol,ref_pangkat.peringkat_jb,ref_pangkat.uraian,riwayat_pangkat.penerbit_sk,riwayat_pangkat.tmt,riwayat_pangkat.masa_kerja_tahun,riwayat_pangkat.masa_kerja_bulan,riwayat_pangkat.tgl_sk,riwayat_pangkat.no_sk,riwayat_pangkat.doc_pangkat,riwayat_pangkat.catatan,riwayat_pangkat.status_setuju');
        $this->db->from('riwayat_pangkat');
        $this->db->join('ref_pangkat','ref_pangkat.id=riwayat_pangkat.id_grade','LEFT');
        $this->db->where($where);
        $this->db->where('riwayat_pangkat.status',1);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_pk_panggol()
    {
        $data =$_POST;
        $where = array();
        if(isset($data['urutane'])){
            if($data['urutane'] != ''){
                $where['id']= $data['urutane'];
            }
        }
        $this->db->select('id as urutane,peringkat_jb as jenenge');
        $this->db->from('ref_pangkat');
        $this->db->where($where);
        $this->db->where('status',1);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }


    //pangkat
    public function get_data_diklat()
    {
        $data =$_POST;
        $where = array();
        if(isset($data['urutane'])){
            if($data['urutane'] != ''){
                $where['riwayat_diklat.id_uniq']= $data['urutane'];
            }
        }
    
        // $this->db->select('riwayat_diklat.id,riwayat_diklat.id_pegawai,riwayat_diklat.id_uniq,riwayat_diklat.id_jns,riwayat_diklat.id_jns_diklat,riwayat_diklat.tgl_diklat,riwayat_diklat.nm_diklat,riwayat_diklat.no_sert_ikut_serta,riwayat_diklat.tgl_sert_ikut_serta,riwayat_diklat.doc_sert_ikut_serta,riwayat_diklat.no_sert_kompetensi,riwayat_diklat.tgl_sert_kompetensi,riwayat_diklat.doc_sert_kompetensi,riwayat_diklat.institusi,riwayat_diklat.instansi,riwayat_diklat.jml_jam,riwayat_diklat.kompetensi,riwayat_diklat.status_setuju,riwayat_diklat.catatan,riwayat_diklat.approve_by,riwayat_diklat.date_approve,riwayat_diklat.status');
        // $this->db->select('riwayat_diklat.id,riwayat_diklat.id_uniq');
        // $this->db->select('riwayat_diklat.id_jns_diklat,riwayat_diklat.id_type_diklat');
        // $this->db->select('riwayat_diklat.tgl_diklat,riwayat_diklat.nm_diklat');
        // $this->db->select('riwayat_diklat.institusi,riwayat_diklat.instansi');
        // $this->db->select('riwayat_diklat.doc_sert_ikut_serta,riwayat_diklat.doc_sert_kompetensi');
        // $this->db->select('riwayat_diklat.status_setuju,riwayat_diklat.is_approve');
        $this->db->select('riwayat_diklat.*');
        $this->db->select('ref_jns_diklat.uraian as jenis_diklat');
        $this->db->select('ref_type_diklat.uraian as type_diklat');
        $this->db->from('riwayat_diklat');
        $this->db->join('ref_jns_diklat','ref_jns_diklat.id=riwayat_diklat.id_jns_diklat','LEFT');
        $this->db->join('ref_type_diklat','ref_type_diklat.id=riwayat_diklat.id_type_diklat','LEFT');
        $this->db->where($where);
        $this->db->where('riwayat_diklat.status',1);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    
    // public function get_pd_select_diklat()
    // {
    //     $data =$_POST;
    //     $where = array();
    //     if(isset($data['urutane'])){
    //         if($data['urutane'] != ''){
    //             $where['id']= $data['urutane'];
    //         }
    //     }
    //     $this->db->select('id as urutane,peringkat_jb as jenenge');
    //     $this->db->from('ref_pangkat');
    //     $this->db->where($where);
    //     $this->db->where('status',1);
    //     $query =  $this->db->get();
    //     $result = $query->result_array();
    //     return $result;
    // }
    public function get_pd_select_jenjang()
    {
        $data =$_POST;
        $where = array();
        if(isset($data['urutane'])){
            if($data['urutane'] != ''){
                $where['id']= $data['urutane'];
            }
        }
        $this->db->select('id as urutane,jenjang as jenenge');
        $this->db->from('ref_jenjang_pendidikan');
        $this->db->where($where);
        $this->db->where('status',1);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_pd_select_lokasi()
    {
        $data =$_POST;
        $where = array();
        if(isset($data['urutane'])){
            if($data['urutane'] != ''){
                $where['id']= $data['urutane'];
            }
        }
        $this->db->select('id as urutane,name as jenenge');
        $this->db->from('ref_negara');
        $this->db->where($where);
        $this->db->where('status',1);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_pd_select_belajar()
    {
        $data =$_POST;
        $where = array();
        if(isset($data['urutane'])){
            if($data['urutane'] != ''){
                $where['id']= $data['urutane'];
            }
        }
        $this->db->select('id as urutane,uraian as jenenge');
        $this->db->from('ref_ijin_belajar');
        $this->db->where($where);
        $this->db->where('status',1);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_data_pendidikan()
    {
        $data =$_POST;
        $where = array();
        if(isset($data['urutane'])){
            if($data['urutane'] != ''){
                $where['riwayat_pendidikan.id_uniq']= $data['urutane'];
            }
        }
        $this->db->select('riwayat_pendidikan.*');
        $this->db->select('ref_negara.name as negara_name');
        $this->db->select('ref_ijin_belajar.uraian as ijin_belajar');
        $this->db->select('ref_jenjang_pendidikan.jenjang as pendidikan');
        $this->db->from('riwayat_pendidikan');
        $this->db->join('ref_negara','ref_negara.id=riwayat_pendidikan.id_negara','LEFT');
        $this->db->join('ref_ijin_belajar','ref_ijin_belajar.id=riwayat_pendidikan.id_ijin_belajar','LEFT');
        $this->db->join('ref_jenjang_pendidikan','ref_jenjang_pendidikan.id=riwayat_pendidikan.id_pendidikan','LEFT');
        $this->db->where($where);
        $this->db->where('riwayat_pendidikan.status',1);
        $query =  $this->db->get();
        $result = $query->result_array();
        return $result;
    }

}