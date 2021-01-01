<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Helper untuk merubah ke tanggal Indonesia
 *
*/
if ( ! function_exists('iddate_months'))
{
    function iddate_months($months='')
    {
		switch($months){     
			case 1 : {
				return 'Januari';
			}
			break;  
			case 2 : {
				return 'Februari';
			}
			break;        
			case 3 : {
				return 'Maret';
			}
			break;        
			case 4 : {
				return 'April';
			}
			break;        
			case 5 : {
				return 'Mei';
			}
			break;        
			case 6 : {
				return 'Juni';
			}
			break;        
			case 7 : {
				return 'Juli';
			}
			break;        
			case 8 : {
				return 'Agustus';
			}
			break;        
			case 9 : {
				return 'September';
			}
			break;        
			case 10 : {
				return 'Oktober';
			}
			break;        
			case 11 : {
				return 'November';
			}
			break;        
			case 12 : {
				return 'Desember';
			}
			break;        
		}
    }
}

if ( ! function_exists('iddate_getmonths'))
{
    function iddate_getmonths($strmonths='')
    {
		$months = strtolower($strmonths);
		switch($months){     
			case 'januari' : 
				return 1;
			break;  
			case 'februari' : 
				return 2;
			break;        
			case 'maret' : 
				return 3;
			break;        
			case 'april' : 
				return 4;
			break;        
			case 'mei' : 
				return 5;
			break;        
			case 'juni' : 
				return 6;
			break;        
			case 'juli' : 
				return 7;
			break;        
			case 'agustus' : 
				return 8;
			break;        
			case 'september' : 
				return 9;
			break;        
			case 'oktober' : 
				return 10;
			break;        
			case 'november' : 
				return 11;
			break;        
			case 'desember' : 
				return 12;
			break;
			case '' : 
				return 0;
			break;
			default :
				return 13;
		}
    }
}

if ( ! function_exists('iddate_days'))
{
    function iddate_days($days='')
    {
		switch($days){     
			case 'Sunday' : {
				return 'Minggu';
			}
			break;  
			case 'Monday' : {
				return 'Senin';
			}
			break;        
			case 'Tuesday' : {
				return 'Selasa';
			}
			break;        
			case 'Wednesday' : {
				return 'Rabu';
			}
			break;        
			case 'Thursday' : {
				return 'Kamis';
			}
			break;        
			case 'Friday' : {
				return "Jum'at";
			}
			break;        
			case 'Saturday' : {
				return 'Sabtu';
			}
			break;        
		}
    }
}

function convert_date($date){
    return date('j', strtotime($date)) . ' ' . iddate_months(date('m', strtotime($date))) . ' ' . date('Y', strtotime($date));
}

function convert_month($date){
    return iddate_months(date('m', strtotime($date))) . ' ' . date('Y', strtotime($date));
}

function convert_datetime($date){
    return date('j', strtotime($date)) . ' ' . iddate_months(date('m', strtotime($date))) . ' ' . date('Y', strtotime($date)) . ' jam ' . date('H\:i', strtotime($date));
}