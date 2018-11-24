<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_dashboards');
	}

	public function index(){
		$wt = "jur_is_deleted = 'false' ";
		$data['total'] = count($this->m_dashboards->total($wt));
		
		// Persentasi debit ada data
		$debit = $this->m_dashboards->debit()->result();
		$data['totald'] = count($debit);

		if ($data['totald'] < 1) {
			$data['persend'] = 0;
		} else {
			$data['persend'] = substr(($data['totald'] / $data['total'] * 100), 0, 5);
		}

		$kredit = $this->m_dashboards->kredit()->result();
		$data['totalk'] = count($kredit);

		if ($data['totalk'] < 1) {
			$data['persenk'] = 0;
		} else {
			$data['persenk'] = substr(($data['totalk'] / $data['total'] * 100), 0, 5);
		}

		//memanggil data keuangan
		$data['title']="Arsip Keuangan Masjid Al-Fath";
		$data['content']='dashboard/home';
		$this->load->view('dashboard/index', $data);
	}
}
?>