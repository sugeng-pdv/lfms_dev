<?php

/*
 * Created on Sat Jun 13 2020 12:11:21 PM
 *
 * Filename Auth_model.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */



class Auth_model extends MY_Model {
    public function __construct()
	{
        $this->db = $this->load->database('db_eproc',true);
        $this->table = 'accounts';
        // $this->primary_key = 'id';
        parent::__construct();
    }
    
    


}
