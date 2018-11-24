<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if (!function_exists('nominal')) {
	function nominal($angka){
		$jd = 'Rp'.number_format($angka, 2, ',', '.');
		return $jd;
	}
}