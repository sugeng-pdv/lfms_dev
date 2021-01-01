<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class General_library
{

	
    function format_rupiah($nilai)
	{
		$result = "Rp " . number_format($nilai,0,',','.')." ,00";
		return $result;

    }
    
    function format_ribuan($nilai)
	{
		$result = number_format($nilai,0,',','.');
		return $result;

    }
    

}

