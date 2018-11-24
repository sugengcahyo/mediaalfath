<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		// $this->load->model('m_homes');
		// $this->auth->auth();
	}

	private static $title="Transaksi Keuangan | Arsip Keuangan Al-Fath";

	public function index(){
		$this->load->helper('form');
		$data['title'] = "Data ".self::$title;
		$data['content'] = 'dashboard/transaksi';
		$this->load->view('dashboard/index', $data);
	}
}
?>