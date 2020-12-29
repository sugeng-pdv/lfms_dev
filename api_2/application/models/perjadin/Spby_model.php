<?php

class Spby_model extends MY_Model {
    public function __construct()
	{
        $this->db = $this->load->database('db_perjadin',true);
        $this->table = 'tbl_spby';
        // $this->primary_key = 'id_per';
        parent::__construct();
  } 
    function fetch_data_spby($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
    {
      $sql = "
        SELECT 
          (@row:=@row+1) AS nomor, 
          id_spby,
          jns_spby,
          tgl_spby,
          tgl_spby,
          no_spby,
          no_spby2,
          jumlah_spby,
          nip_penerima_spby,
          nm_penerima_spby,
          detail_spby,
          kode_spby  
        FROM 
        $this->table, (SELECT @row := 0) r WHERE 1=1 
          AND status_spby = 1
      ";
      
      $data['totalData'] = $this->db->query($sql)->num_rows();
      
      if( ! empty($like_value))
      {
        $sql .= " AND ( ";    
        $sql .= "
        tgl_spby like '%".$this->db->escape_like_str($like_value)."%'
        OR jns_spby like '%".$this->db->escape_like_str($like_value)."%'
        OR no_spby like '%".$this->db->escape_like_str($like_value)."%'
        OR nm_penerima_spby like '%".$this->db->escape_like_str($like_value)."%'
        OR detail_spby like '%".$this->db->escape_like_str($like_value)."%'
        ";
        $sql .= " ) ";
        // OR jumlah_spby like '%".$this->db->escape_like_str($like_value)."%'
      }
      
      $data['totalFiltered']	= $this->db->query($sql)->num_rows();
      
      $columns_order_by = array( 
        0 => 'nomor',
        1 => 'jns_spby',
        2 => 'tgl_spby',
        3 => 'detail_spby',
        4 => 'no_spby',
        5 => 'nm_penerima_spby'
      );
      
      $sql .= " ORDER BY id_spby desc, ".$columns_order_by[$column_order]." ".$column_dir.", nomor ";
      $sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
      
      $data['query'] = $this->db->query($sql);
      $data['querydata'] = $this->db->query($sql)->result_array();
      return $data;
    }

    function fetch_data_spby2($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
    // public function fetch_data_spby2()
    {
      // like_value = data cari
      // column_order = colom order
      // column_dir = asc /desc
      // limit_start 
      // limit_length
      //data Cari
      $searchArr = array();
      $sql="";
      $this->db->select('id_spby');
      $this->db->select('jns_spby');
      $this->db->select('tgl_spby');
      // $this->db->select('DATE_FORMAT(tgl_spby,%d %M %y)','tgl_spby');
      $this->db->select('tgl_spby');
      $this->db->select('no_spby');
      $this->db->select('no_spby2');
      $this->db->select('jumlah_spby');
      $this->db->select('nip_penerima_spby');
      $this->db->select('nm_penerima_spby');
      $this->db->select('detail_spby');
      $this->db->select('kode_spby');
      $this->db->from($this->table);
      $this->db->from("(SELECT @row :=0) r");
      $this->db->where('status_spby',1);
      $query = $this->db->get();
      
      // $this->db->where("tbl_st.status_delete",0);
      // if(!empty($like_value)){
      //   $sql .=" AND ( ";
      //   $sql .= "
      //   a.tgl_spby like '%".$this->db->escape_like_str($like_value)."%'
      //   OR a.jns_spby like '%".$this->db->escape_like_str($like_value)."%'
      //   OR a.no_spby like '%".$this->db->escape_like_str($like_value)."%'
      //   OR a.jumlah_spby like '%".$this->db->escape_like_str($like_value)."%'
      //   OR a.nm_penerima_spby like '%".$this->db->escape_like_str($like_value)."%'
      //   OR a.detail_spby like '%".$this->db->escape_like_str($like_value)."%'
      //   ";
      //   $sql .= " ) ";
      // }
      // $query = $this->db->get();
      
      // $colums_order_by=array(
        //   0 => 'nomor',
        //   1 => 'tgl_spby',
        //   2 => 'jns_spby',
        //   3 => 'no_spby',
        //   4 => 'jumlah_spby',
        //   5 => 'nm_penerima_spby',
        //   6 => 'detail_spby'
        // );
        // $sql .= " ORDER BY ".$colums_order_by[$column_order]." ".$colum_dir.", nomor ";
        // $sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
        // $query = $this->db->get();
        // $data['resultnya'] = $query->result_array();
        $data['totalData'] = $query->num_rows();
        $data['totalFiltered'] = $query->num_rows();
        $data['query'] =$query;
        $data['querydata'] = $query->result_array();
      return $data;
    }
    public function getCodeSpby()
    {
      $tahun=date("Y");
        $where = array();
        if(isset($tahun)){
          if($tahun != ''){          
              $where['tgl_buat']= $this->db->escape_like_str(strtoupper($tahun));
          }
        }
      $this->db->select('max(no_spby2) as kode_spby');
      $this->db->from($this->table);
      $this->db->like($where);
      $query = $this->db->get();
      $result = $query->result_array();
      return $result;
    }
    public function getDetailSt($token)
    {
      // $this->db_sdm = $this->load->database('db_sdm',true);
      $this->db->select('id_st,no_st,kota_berangkat,kota_tujuan');
      $this->db->from('tbl_st');
      $this->db->where('id_st',$token);
      $query = $this->db->get();
      $result = $query->result_array();
      return $result;
    }
    public function getDataDivisi($data){
      $where = array();
        if(isset($data['id_kegiatan'])){
            if($data['id_kegiatan']!=''){
                $where['UPPER(id_kegiatan)']= $this->db->escape_like_str(strtoupper($data['id_kegiatan']));
            }
        }
      $this->db->select('*');
      $this->db->from('tbl_mst_kegiatan');
      $this->db->where($where);
      $this->db->order_by("kd_divisi","asc");
      $query = $this->db->get();
      $result = $query->result_array();

      return $result;
    } 
    public function getDetailKegiatan($id){
      $this->db->select('id_kode,kd_max,uraian');
      $this->db->from('tbl_mst_kode_kegiatan');
      $this->db->where('kd_kegiatan',$id);
      $this->db->order_by("id_kode","asc");
      $query = $this->db->get();
      $result = $query->result_array();

      return $result;
    }
    public function getDataKdKegiatan($data){
      $where = array();
      if(isset($data['id_kode'])){
          if($data['id_kode']!=''){
              $where['UPPER(id_kode)']= $this->db->escape_like_str(strtoupper($data['id_kode']));
          }
      }
      $this->db->select('kd_max,kd_akun,uraian');
      $this->db->from('tbl_mst_kode_kegiatan');
      $this->db->where($where);
      $this->db->order_by("id_kode","asc");
      $query = $this->db->get();
      $result = $query->result_array();

    return $result;
    }
    public function getDetailSpby($id){
      $this->db->select('tbl_spby.id_spby as tokenData,tbl_spby.tgl_spby,tbl_spby.jns_spby,tbl_spby.id_st,tbl_spby.no_spby,tbl_spby.no_spby2,tbl_spby.jumlah_spby,tbl_spby.nip_penerima_spby,tbl_spby.nm_penerima_spby,tbl_spby.detail_spby,tbl_spby.kd_kegiatan,tbl_mst_kode_kegiatan.id_kode,tbl_mst_kode_kegiatan.kd_kegiatan as dipa');
      $this->db->from($this->table);
      $this->db->join(' tbl_mst_kode_kegiatan','tbl_mst_kode_kegiatan.id_kode = tbl_spby.kd_kegiatan');
      $this->db->where("id_spby",$id);
      $query = $this->db->get();
      $result = $query->result_array();

      return $result;
    }
}
