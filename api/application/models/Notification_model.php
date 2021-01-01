<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends MY_Model {
    public function __construct()
	{
        $this->table = 'notification';
        $this->primary_key = 'id';
        parent::__construct();
	}



}
