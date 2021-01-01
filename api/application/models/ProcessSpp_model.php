<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProcessSpp_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'timeline_spp';
        $this->primary_key = 'id';
        parent::__construct();
	}



}
