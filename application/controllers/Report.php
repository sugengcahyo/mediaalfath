<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->auth->restrict();
		$this->load->model('m_reports');
	}

	public function index(){
		$bulan = $this->input->get('bulan', TRUE);
		$tahun = $this->input->get('tahun', TRUE);

		if ($_GET) {
			sleep(1);

			// $where = "jur_dot LIKE '%$tahun%' AND jur_is_deleted = 'FALSE'";
			$where = "month(jur_dot)='$bulan' AND year(jur_dot)='$tahun' AND jur_is_deleted = 'FALSE'";

			$data['result'] = $this->m_reports->get_result($where);
			$data['bulan'] = $this->input->get('bulan', TRUE);
			$data['tahun'] = $this->input->get('tahun', TRUE);
			$data['title'] = "Rekap Laporan &minus; Arsip Keuagan Masjid Al-Fath";
			$this->load->view('dashboard/report-result', $data);
		} else {
			$this->load->helper('form');
			$data['title'] = "Rekap Laporan &minus; Arsip Keuagan Masjid Al-Fath";
			$data['content'] = "dashboard/report";
			$this->load->view('dashboard/index', $data);
		}
	}

	private function validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('bulan', 'Bulan', 'trim|required');
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required');
		return $this->form_validation->run();
	}
}
