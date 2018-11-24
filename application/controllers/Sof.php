<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sof extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_sofs');
		$this->auth->restrict();
		$this->auth->admin();
	}

	private static $title = "Sumber Dana | Arsip Keuangan Masjid Al-Fath";
	private static $subtitle = "Sumber Dana";
	private static $table = 'sof';
	private static $primaryKey = 's_id';

	public function index()
	{
		$data['title'] = "Data ".self::$title;
		$data['form_title'] = "Data ".self::$subtitle;
		$data['content'] = "dashboard/sof";
		$this->load->view('dashboard/index', $data);
	}

	public function get_data()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$this->load->library('datatables_ssp');
			$columns = array(
				array('db' => 's_id', 'dt' => 's_id'),
				array('db' => 's_inisial', 'dt' => 's_inisial'),
				array('db' => 's_name', 'dt' => 's_name'),
				array('db' => 's_created_at', 'dt' => 's_created_at'),
				array('db' => 's_updated_at', 'dt' => 's_updated_at'),
				array(
					'db' => 's_id',
					'dt' => 'tindakan',
					'formatter' => function($s_id) {
						return '
						<a class="btn btn-info btn-sm mb" href="'.site_url('sof/edit/'.$s_id).'"title="Edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>

						<a class="btn btn-danger btn-sm mb" onclick="return confirmDialog();" href="'.site_url('sof/delete/'.$s_id).'" title="Hapus"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
					}
				),
			);

			$sql_details = [
				'user' => $this->db->username,
				'pass' => $this->db->password,
				'db' => $this->db->database,
				'host' => $this->db->hostname
			];

			$qjoin = NULL;

			echo json_encode(
				Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "s_is_deleted = 'FALSE'", $qjoin)
			);
		}
	}

	public function add()
	{
		$this->load->helper(['form', 'notification']);

		if ($this->validation()) {

			$s_id = $this->input->post('s_id', TRUE);
			$s_name = $this->input->post('s_name', TRUE);
			$where = "s_id = '$s_id' OR s_name = '$s_name'";

			$data = $this->m_sofs->is_exist($where);
			if (strtolower($data['s_name']) === strtolower($this->input->post('s_name', TRUE))) {
				$this->session->set_flashdata('alert', error("Nama Sumber Dana $data[s_name] sudah ada!"));
				$data['title'] = "Tambah ".self::$title;
				$data['kodeunik'] = $this->m_sofs->buat_kode();
				$data['form_title'] = "Tambah ".self::$subtitle;
				$data['action'] = site_url(uri_string());
				$data['content'] = 'dashboard/sof-form';
				$this->load->view('dashboard/index', $data);

			} else if (strtolower($data['s_inisial']) === strtolower($this->input->post('s_inisial', TRUE))) {
				$this->session->set_flashdata('alert', error("Kode Inisial $data[s_name] tidak boleh ganda!"));
				$data['title'] = "Tambah ".self::$title;
				$data['kodeunik'] = $this->m_sofs->buat_kode();
				$data['form_title'] = "Tambah ".self::$subtitle;
				$data['action'] = site_url(uri_string());
				$data['content'] = 'dashboard/sof-form';
				$this->load->view('dashboard/index', $data);

			} else {
				$data = [
					's_id' => strtoupper($s_id),
					's_inisial' => strtoupper($this->input->post('s_inisial', TRUE)),
					's_name' => ucfirst($this->input->post('s_name', TRUE)),
					's_created_by' => $this->session->userdata['u_id'],
					's_is_deleted' => 'FALSE'
				];

				$this->m_sofs->add($data);
				$this->session->set_flashdata('alert', success("Data program keahlian $data[s_name] berhasil ditambahkan."));
				$data['title'] = "Data ".self::$title;
				$data['content'] = "dashboard/sof";
				redirect('sof');
			}

		} else {
			$data['sof'] = FALSE;
			$data['kodeunik'] = $this->m_sofs->buat_kode();
			$data['title'] = "Tambah ".self::$title;
			$data['form_title'] = "Tambah ".self::$subtitle;
			$data['action'] = site_url(uri_string());
			$data['content'] = 'dashboard/sof-form';
			$this->load->view('dashboard/index', $data);
		}
	}

	public function edit(){
		$this->load->helper(['form', 'notification']);
		$s_id = $this->uri->segment(3);
		if ($this->validation()) {
			$data = [
				's_id' => strtoupper($this->input->post('s_id', TRUE)),
				's_inisial' => strtoupper($this->input->post('s_inisial', TRUE)),
				's_name' => ucfirst($this->input->post('s_name', TRUE)),
				's_updated_at' => date('Y-m-d H:i:s'),
				's_updated_by' => $this->session->userdata['u_id']
			];

			$this->m_sofs->edit($data, $s_id);
			$this->session->set_flashdata('alert', success('Data Sumber Dana berhasil diperbarui.'));
			$data['title'] = "Data ".self::$title;
			$data['content'] = "dashboard/sof";
			redirect('sof');

		} else {
			$where = "s_id = '$s_id'";

			$data['sof'] = $this->m_sofs->get_sofs($where);
			$data['form_title'] = "Edit Sumber Dana";
			$data['kodeunik'] = $this->db->where($where)->get('sof')->row('s_id');
			$data['title'] = "Edit ".self::$title;
			$data['action'] = site_url(uri_string());
			$data['content'] = 'dashboard/sof-form';
			if (!$s_id) {
				redirect('sof');
			} else {
				$this->load->view('dashboard/index', $data);
			}
		}
	}

	public function delete($s_id){
		$this->load->helper('notification');

		$data = [
			's_deleted_at' => date('Y-m-d H:i:s'),
			's_deleted_by' => $this->session->userdata['u_id'],
			's_is_deleted' => 'TRUE'
		];

		$this->m_sofs->delete($data, $s_id);
		$this->session->set_flashdata('alert', success('Data Sumber Dana berhasil dihapus.'));
		$data['title'] = "Data ".self::$title;
		$data['content'] = "dashboard/sof";
		$this->load->view('dashboard/index', $data);
		redirect('sof');
	}

	public function deleted()
	{
		$data['title'] = "Data ".self::$title;
		$data['content'] = "dashboard/sof-deleted";
		$this->load->view('dashboard/index', $data);
	}

	public function get_deleted()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$this->load->library('datatables_ssp');
			$columns = array(
				array('db' => 's_id', 'dt' => 's_id'),
				array('db' => 's_inisial', 'dt' => 's_inisial'),
				array('db' => 's_name', 'dt' => 's_name'),
				array('db' => 's_created_at', 'dt' => 's_created_at'),
				array('db' => 's_deleted_at', 'dt' => 's_deleted_at'),
				array(
					'db' => 's_id',
					'dt' => 'tindakan',
					'formatter' => function($s_id) {
						return '<a class="btn btn-success btn-sm" onclick="return confirmDialog();" href="'.site_url('sof/restore/'.$s_id).'"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Restore</a>';
					}
				),
			);

			$sql_details = [
				'user' => $this->db->username,
				'pass' => $this->db->password,
				'db' => $this->db->database,
				'host' => $this->db->hostname
			];

			$qjoin = NULL;

			echo json_encode(
				Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "s_is_deleted = 'TRUE'", $qjoin)
			);
		}
	}

	public function restore(){
		$this->load->helper('notification');
		$s_id = $this->uri->segment(3);

		$data = [
			's_restored_at' => date('Y-m-d H:i:s'),
			's_restored_by' => $this->session->userdata['u_id'],
			's_is_deleted' => 'FALSE'
		];

		$this->m_sofs->restore($data, $s_id);
		$this->session->set_flashdata('alert', success('Data Sumber Dana berhasil direstore.'));
		$data['title'] = "Data ".self::$title;
		$data['content'] = "dashboard/sof-deleted";
		redirect('sof/deleted');
	}

	private function validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('s_id', 'Kode Unik', 'trim|required|min_length[5]|max_length[5]');
		$this->form_validation->set_rules('s_name', 'Nama Sumber Dana', 'trim|required|min_length[5]|max_length[50]');
		$this->form_validation->set_rules('s_id', 'Inisial Sumber Dana', 'trim|required|max_length[5]');
		return $this->form_validation->run();
	}

}
