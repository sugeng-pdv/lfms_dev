<?php

/*
 * Created on Fri Aug 07 2020 10:42:19 AM
 *
 * Filename SideMenu_model.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */


class SideMenu_model extends MY_Model {
    public function __construct()
	{
        $this->db = $this->load->database('db_eproc',true);
        $this->table = 'menu_side';
        // $this->primary_key = 'id';
        parent::__construct();
    }
    

    function index()
    {

    }

    function getDataNestable()
    {
        $postdata = $_POST;
        $this->db->select('id,parent_id,nama_modul,param,param_link,icon');
        $this->db->from('menu_side');
        $this->db->where("status" ,1);
        $this->db->where("parent_id",0);
        $query = $this->db->get();
        // $result = $query->result_array();
        if ( $result = $query->result() ){ return $result; }
        // return $result;
    }
    function child_data($id)
    {
        $postdata = $_POST;
        $this->db->select('id,parent_id,nama_modul,param,param_link,icon');
        $this->db->from('menu_side');
        $this->db->where("status",1);
        $this->db->where("parent_id",$id);
        $query = $this->db->get();
        $result = $query->result();
        // if ( $result = $query->result() ){ return $result; }
        return $result;
    }
    


}
