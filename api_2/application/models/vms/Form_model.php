<?php

/*
 * Created on Wed Jun 17 2020 9:46:52 AM
 *
 * Filename Form_model.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */

class Form_model extends MY_Model {
    public function __construct()
	{
        $this->db = $this->load->database('db_eproc',true);
        $this->table = 'accounts';
        // $this->primary_key = 'id';
        parent::__construct();
    }


}
