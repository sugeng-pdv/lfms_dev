<?php

/*
 * Created on Sat Jun 13 2020 2:19:57 AM
 *
 * Filename Cron_model.php
 * Author Sugeng Riyadi
 * Email sugeng.riyadi10@gmail.com
 * Copyright (c) 2020 Lembaga Manajemen Aset Negara
 */



class Cron_model extends MY_Model {
    public function __construct()
	{
        $this->db = $this->load->database('db_eproc',true);
        $this->table = 'email_sent';
        // $this->primary_key = 'id';
        parent::__construct();
    }


}
