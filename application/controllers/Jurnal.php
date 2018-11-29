<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_jurnals');
		$this->load->helper('nominal');
		$this->load->helper('tgl_indo');
		$this->load->helper('krip');
		$this->auth->restrict();
	}

	private static $title = "Jurnal Transaksi &minus; Arsip Keuagan Masjid Al-Fath";
	private static $table = 'jurnal';
	private static $primaryKey = 'jur_id';
	private static $where = 'jur_is_deleted = "FALSE"';	

	public function index(){
		$data['title'] = "Data ".self::$title;
		$data['content'] = "dashboard/jurnal";
		$data['jurnal'] = $this->m_jurnals->get_jurnal(self::$where)->result_array();
		$this->load->view('dashboard/index', $data);
	}

	// public function get_data()
	// {
	// 	if (!$this->input->is_ajax_request()) {
	// 		exit('No direct script access allowed');
	// 	} else {
	// 		$this->load->library('datatables_ssp');
	// 		$columns = array(
	// 			array('db' => 'jur_id', 'dt' => 'jur_id'),
	// 			array('db' => 'jur_name', 'dt' => 'jur_name'),
	// 			array('db' => 'jur_kredit', 'dt' => 'jur_kredit'),
	// 			array('db' => 'jur_debit', 'dt' => 'jur_debit'),
	// 			array('db' => 's_name', 'dt' => 'jur_sisa'),
	// 			array('db' => 'a_name', 'dt' => 'a_name'),
	// 			array('db' => 'jur_dot', 'dt' => 'jur_dot'),
	// 			array(
	// 				'db' => 'jur_id',
	// 				'dt' => 'tindakan',
	// 				'formatter' => function($jur_id) {
	// 					return '
	// 					<a class="btn btn-success btn-sm mb" href="'.site_url('jurnal/detail/'.$jur_id).'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>

	// 					<a class="btn btn-info btn-sm mb" href="'.site_url('jurnal/edit/'.$jur_id).'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
						
	// 					<a class="btn btn-danger btn-sm mb" onclick="return confirmDialog();" href="'.site_url('jurnal/delete/'.$jur_id).'" title="Hapus"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
	// 				}
	// 			),
	// 		);

	// 		$sql_details = [
	// 			'user' => $this->db->username,
	// 			'pass' => $this->db->password,
	// 			'db' => $this->db->database,
	// 			'host' => $this->db->hostname
	// 		];

	// 		$qjoin = "JOIN akun ON akun.a_id = jurnal.jur_akun 
	// 		JOIN sof ON sof.s_id = jurnal.jur_sof
	// 		JOIN jenis ON jenis.j_id=akun.a_jid 
	// 		JOIN transaksi ON transaksi.t_id = jenis.j_transaksi";

	// 		echo json_encode(
	// 			Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "jur_is_deleted = 'FALSE'", $qjoin )
	// 		);

	// 		$this->load->library("format");
	// 		$jumDebit = $this->m_jurnals->jumDebit();
	// 	}
	// }

	private function validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('jur_id', 'No. Regristrasi', 'trim|required');
		$this->form_validation->set_rules('jur_name', 'Nama Transaksi', 'trim|required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('jur_dot', 'Tanggal Transaksi', 'trim|required');
		$this->form_validation->set_rules('jur_akun', 'Debit Akun', 'trim|required');
		return $this->form_validation->run();
	}

	public function add(){
		$this->load->helper(['form', 'string', 'notification']);

		if ($this->validation()) {
			$jur_id = $this->input->post('jur_id', TRUE);
			$where = "jur_id = '$jur_id'";

			$data = $this->m_jurnals->is_exist($where);

			if ($data['jur_id'] === $this->input->post('jur_id', TRUE)) {
				$this->session->set_flashdata('alert', error('No. Regristasi sudah ada sudah ada!'));
				$data['title'] = "Tambah ".self::$title;
				$data['form_title'] = "Tambah jurnal Transaksi";
				$data['action'] = site_url(uri_string());
				$data['content'] = 'dashboard/jurnal-form';
				$this->load->view('dashboard/index', $data);

			} else {
				$transaksi = $this->input->post('jur_transaksi');

				$debit = $data['jur_debit'];
				$kredit = $data['jur_kredit'];

				if ($transaksi == 1) {
					$debit = $this->input->post('jur_nominal');
					$kredit = 0;
				} else {
					$debit = 0;
					$kredit = $this->input->post('jur_nominal');
				}
				// $this->load->library('rc5');
				$data = [
					'jur_id' => $this->input->post('jur_id', TRUE),
					// 'jur_name' => rc4($this->input->post('jur_name', TRUE)),
					'jur_name' => enkrip($this->input->post('jur_name', TRUE)),
					'jur_dot' => $this->input->post('jur_dot', TRUE),
					'jur_debit' => $debit,
					'jur_kredit' => $kredit,
					'jur_nominal' => $this->input->post('jur_nominal', TRUE),
					'jur_akun' => $this->input->post('jur_akun', TRUE),
					'jur_sof' => $this->input->post('jur_sof', TRUE),
					'jur_sisa' => $this->input->post('jur_kredit')-$this->input->post('jur_debit'),
					'jur_is_deleted' => 'FALSE',
					'jur_created_by' => $this->session->userdata['u_id']
				];

				$this->m_jurnals->add($data);
				$this->session->set_flashdata('alert', success('Data jurnal Transaksi berhasil ditambahkan.'));
				$data['title'] = "Data ".self::$title;
				$data['content'] = "dashboard/jurnal";
				redirect('jurnal');
			}

		} else {
			$whereAkun = "a_is_deleted = 'FALSE'";
			$whereSof = "s_is_deleted = 'FALSE'";
			$data['akun'] = $this->m_jurnals->get_akun($whereAkun);
			$data['sof'] = $this->m_jurnals->get_sof($whereSof);
			$data['transaksi'] = $this->m_jurnals->get_transaksi();
			$data['kodeunik'] = $this->m_jurnals->buat_kode();
			$data['title'] = "Tambah ".self::$title;
			$data['form_title'] = "Tambah jurnal Transaksi";
			$data['jur_name'] = ""; 
			$data['action'] = site_url(uri_string());
			$data['content'] = 'dashboard/jurnal-form';
			$this->load->view('dashboard/index', $data);
		}
	}

	public function edit(){
		$this->load->helper(['form', 'notification']);
		$jur_id = $this->uri->segment(3);
		$where = "jur_id = '$jur_id'";
		$data['jurnal'] = $this->m_jurnals->get_jurnal($where)->row_array();

		if ($this->validation()) {

			$this->load->library('upload');
			$transaksi = $this->input->post('jur_transaksi');
			if ($transaksi == 1) {
				$debit = $this->input->post('jur_nominal');
				$kredit = 0;
			} else {
				$debit = 0;
				$kredit = $this->input->post('jur_nominal');
			}
			$data = [
				'jur_id' => $this->input->post('jur_id', TRUE),
				'jur_name' => ucwords($this->input->post('jur_name', TRUE)),
				'jur_dot' => $this->input->post('jur_dot', TRUE),
				'jur_debit' => $debit,
				'jur_kredit' => $kredit,
				'jur_akun' => $this->input->post('jur_akun', TRUE),
				'jur_sof' => $this->input->post('jur_sof', TRUE),
				'jur_updated_at' => date('Y-m-d H:i:s'),
				'jur_updated_by' => $this->session->userdata['u_id'],
			];

			$this->m_jurnals->edit($data, $jur_id);
			$this->session->set_flashdata('alert', success('Data jurnal Transaksi berhasil diperbarui.'));
			$data['title'] = "Data ".self::$title;
			$data['content'] = "dashboard/jurnal";
			redirect(site_url('jurnal'));

		} else {
			$whereAkun = "a_is_deleted = 'FALSE'";
			$whereSof = "s_is_deleted = 'FALSE'";
			$data['transaksi'] = $this->m_jurnals->get_transaksi();
			$data['akun'] = $this->m_jurnals->get_akun($whereAkun);
			$data['sof'] = $this->m_jurnals->get_sof($whereSof);
			if ($data['jurnal']['jur_kredit'] != 0) {
				$data['jurnal']['jur_nominal'] = $data['jurnal']['jur_kredit'];
				$data['jurnal']['jur_transaksi'] = "2";
			} else {
				$data['jurnal']['jur_nominal'] = $data['jurnal']['jur_debit'];
				$data['jurnal']['jur_transaksi'] = "1";
			}
			$data['kodeunik'] = $jur_id;
			$data['title'] = "Edit ".self::$title;
			$data['form_title'] = "Edit Data ".$data['jurnal']['jur_name'] ;
			$data['action'] = site_url(uri_string());
			$data['content'] = 'dashboard/jurnal-form';
			if (!$jur_id) {
				redirect(site_url('jurnal'));
			} else {
				$this->load->view('dashboard/index', $data);
			}
		}
	}

	public function view(){
		$jur_id = $this->uri->segment(3);

		$where = "jur_id = '$jur_id'";

		$data['jurnal'] = $this->m_jurnals->get_jurnals($where)->result_array();
		$data['title'] = $data['jurnal']['jur_name']." &minus; Arsip Keuagan Masjid Al-Fath";
		$data['attachment'] = 'Lampiran';
		$data['content'] = 'dashboard/jurnal-view';
		if (!$jur_id) {
			redirect(site_url('jurnal'));
		} else {
			$this->load->view('dashboard/index', $data);
		}
	}

	public function print_data(){
		$where = "jurnal.jur_is_deleted = 'FALSE' ";
		$data['jurnal'] = $this->m_jurnals->get_jurnal($where)->result_array();
		$data['get_jurnal'] = $this->m_jurnals->get_jurnal($where)->row_array();
		$data['title'] = "Data Jurnal &minus; Arsip Keuagan Masjid Al-Fath";
		$data['attachment'] = 'Lampiran Jurnal Lengkap';
		$this->load->view('dashboard/jurnal-print', $data);
	}

	public function delete($jur_id){
		$this->load->helper('notification');

		$data = [
			'jur_deleted_at' => date('Y-m-d H:i:s'),
			'jur_deleted_by' => $this->session->userdata['u_id'],
			'jur_is_deleted' => TRUE
		];

		$this->m_jurnals->delete($data, $jur_id);
		$this->session->set_flashdata('alert', success('Data jurnal Transaksi berhasil dihapus.'));
		$data['title'] = "Data ".self::$title;
		$data['content'] = "dashboard/jurnal";
		$this->load->view('dashboard/index', $data);
		redirect(site_url('jurnal'));
	}

	public function deleted(){
		$data['title'] = "jurnal Transaksi &minus; Arsip Keuagan Masjid Al-Fath";
		$data['content'] = "dashboard/jurnal-deleted";
		$this->load->view('dashboard/index', $data);
	}

	public function get_deleted(){
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$this->load->library('datatables_ssp');
			$columns = array(
				array('db' => 'jur_id', 'dt' => 'jur_id'),
				array('db' => 'jur_name', 'dt' => 'jur_name'),
				array('db' => 'jur_dot', 'dt' => 'jur_dot'),
				array('db' => 'jur_deleted_at', 'dt' => 'jur_deleted_at'),
				array(
					'db' => 'jur_id',
					'dt' => 'tindakan',
					'formatter' => function($jur_id) {
						return '<a class="btn btn-success btn-sm" onclick="return confirmDialog();" href="'.site_url('jurnal/restore/'.$jur_id).'"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Restore</a>';
					}
				),
			);

			$sql_details = [
				'user' => $this->db->username,
				'pass' => $this->db->password,
				'db' => $this->db->database,
				'host' => $this->db->hostname
			];

			$qjoin = "JOIN akun ON akun.a_id = jurnal.jur_akun";

			echo json_encode(
				Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "jur_is_deleted = 'TRUE'", $qjoin)
			);
		}
	}

	public function restore(){
		$this->load->helper(['form', 'notification']);
		$jur_id = $this->uri->segment(3);

		$data = [
			'jur_restored_at' => date('Y-m-d H:i:s'),
			'jur_restored_by' => $this->session->userdata['u_id'],
			'jur_is_deleted' => 'FALSE'
		];

		$this->m_jurnals->restore($data ,$jur_id);
		$this->session->set_flashdata('alert', success('Data jurnal Transaksi berhasil direstore.'));
		$data['title'] = "Data ".self::$title;
		$data['content'] = "dashboard/jurnal-deleted";
		redirect(site_url('jurnal/deleted'));
	}

	public function detail($jur_id){
		$data['jurnal']=$this->m_jurnals->get_jurnal("jur_id = '$jur_id'")->row_array();
		$data['get_jurnal']=$this->m_jurnals->get_jurnal("jur_is_deleted = 'FALSE'")->result_array();

		$data['transaksi'] = $this->m_jurnals->get_transaksi();
		$data['title'] = "Detail ".self::$title;
		$data['form_title'] = "Detail jurnal '".strtoupper(dekrip($data['jurnal']['jur_name']))."'";
		$data['action'] = site_url(uri_string());
		$data['content'] = 'dashboard/jurnal-detail';
		$this->load->view('dashboard/index',$data);	
	}
}
