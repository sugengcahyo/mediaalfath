<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('m_akuns');
		$this->load->helper('nominal');
		$this->load->helper('tgl_indo');
		$this->auth->restrict();
		$this->auth->admin();
	}

	private static $title = "akun Transaksi | Arsip Keuagan Masjid Al-Fath";
	private static $table = 'akun';
	private static $primaryKey = 'a_id';
	public function index(){
		$data['title'] = "Data ".self::$title;
		$data['content'] = "dashboard/akun";
		$this->load->view('dashboard/index', $data);
	}

	public function buat_kode(){
		$this->m_akuns->ambil_kode();
		$query = $this->db->get('akun');      //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      
			//jika kode ternyata sudah ada.      
			$data = $query->row();      
			$kode = intval($data->kode) + 1;    
		}else {
			$kode = 1;
		}
		$kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		$kodejadi = "AC".$kodemax;    // hasilnya ODJ-9921-0001 dst.

		return $kodejadi;
	}

	private function validation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('a_id', 'Kode Unik', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('a_name', 'Nama Akun Transaksi', 'trim|required|min_length[5]|max_length[50]');
		$this->form_validation->set_rules('a_jid', 'Jenis Akun', 'trim|required');
		return $this->form_validation->run();
	}

	public function get_data()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$this->load->library('datatables_ssp');
			$columns = array(
				array('db' => 'a_id', 'dt' => 'a_id'),
				array('db' => 'a_name', 'dt' => 'a_name'),
				array('db' => 'j_name', 'dt' => 'j_name'),
				array('db' => 't_name', 'dt' => 't_name'),
				array('db' => 'a_created_at', 'dt' => 'a_created_at'),
				array('db' => 'a_updated_at', 'dt' => 'a_updated_at'),
				array(
					'db' => 'a_id',
					'dt' => 'tindakan',
					'formatter' => function($a_id) {
						return '
						<a class="btn btn-success btn-sm mb" href="'.site_url('akun/detail/'.$a_id).'" title="Lihat"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>

						<a class="btn btn-info btn-sm mb" href="'.site_url('akun/edit/'.$a_id).'" title="Edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>

						<a class="btn btn-danger btn-sm mb" onclick="return confirmDialog();" href="'.site_url('akun/delete/'.$a_id).'" title="Hapus"><span class="glyphicon glyphicon-trash"></span></a>';
					}
				),
			);

			$sql_details = [
				'user' => $this->db->username,
				'pass' => $this->db->password,
				'db' => $this->db->database,
				'host' => $this->db->hostname
			];

			$qjoin = "
			JOIN jenis ON jenis.j_id = akun.a_jid 
			JOIN transaksi ON transaksi.t_id = jenis.j_transaksi";

			echo json_encode(
				Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "a_is_deleted = 'FALSE'", $qjoin)
			);
		}
	}

	// tambah data
	public function add(){
		$this->load->helper(['form', 'notification']);

		if ($this->validation()) {
			$a_id = $this->input->post('a_id', TRUE);
			$a_name = $this->input->post('a_name', TRUE);
			$where = "a_id = '$a_id' OR a_name = '$a_name'";

			$data = $this->m_akuns->is_exist($where);
			
			if (strtolower($data['a_name']) === strtolower($this->input->post('a_name', TRUE))) {
				$this->session->set_flashdata('alert', error("Nama akun $data[a_name] Transaksi sudah ada!"));
				$data['title'] = "Tambah ".self::$title;
				$data['kodeunik'] = $this->buat_kode();
				$data['form_title'] = "Tambah akun Transaksi";
				$data['action'] = site_url(uri_string());
				$data['content'] = 'dashboard/akun-form';
				$this->load->view('dashboard/index', $data);

			} else if (strtolower($data['a_id']) === strtolower($this->input->post('a_id', TRUE))) {
				$this->session->set_flashdata('alert', error("Kode akun Transaksi $data[a_name] tidak boleh ganda!"));
				$data['title'] = "Tambah ".self::$title;
				$data['kodeunik'] = $this->buat_kode();
				$data['form_title'] = "Tambah akun Transaksi";
				$data['action'] = site_url(uri_string());
				$data['content'] = 'dashboard/akun-form';
				$this->load->view('dashboard/index', $data);

			} else {
				//belum selesai
				$this->load->helper('string');
				$a_id = random_string('alnum', 10);
				$data = [
					'a_id' => $a_id,
					'a_id' => strtoupper($this->buat_kode()),
					'a_name' => ucwords($this->input->post('a_name', TRUE)),
					'a_jid' => $this->input->post('a_jid', TRUE),
					'a_created_by' => $this->session->userdata['u_id'],
					'a_is_deleted' => 'FALSE'
				];

				$this->m_akuns->add($data);
				$this->session->set_flashdata('alert', success("Data Akun $data[a_name] berhasil ditambahkan."));
				$data['title'] = "Data ".self::$title;
				$data['content'] = "dashboard/akun";
				redirect('akun');
			}

		} else {
			$whereJenis = "j_is_deleted = 'False'";
			$data['jenis'] = $this->m_akuns->get_jenis($whereJenis)->result_array();
			$data['akun'] = FALSE;
			$data['kodeunik'] = $this->buat_kode();
			$data['title'] = "Tambah ".self::$title;
			$data['form_title'] = "Tambah akun Transaksi";
			$data['action'] = site_url(uri_string());
			$data['content'] = 'dashboard/akun-form';
			$this->load->view('dashboard/index', $data);
		}
	}

	public function edit() {
		$this->load->helper(['form', 'notification']);
		$a_id = $this->uri->segment(3);

		if ($this->validation()) {
			$data = [
				'a_id' => strtoupper($this->input->post('a_id', TRUE)),
				'a_name' => ucwords($this->input->post('a_name', TRUE)),
				'a_jid' => $this->input->post('a_jid', TRUE),
				'a_updated_at' => date('Y-m-d H:i:s'),
				'a_updated_by' => $this->session->userdata['u_id']
			];

			$where = "a_id = '$a_id'";

			$this->m_akuns->edit($data, $a_id);
			$this->session->set_flashdata('alert', success("Data akun Transaksi $data[a_name] berhasil diperbarui."));
			$data['kodeunik'] = $this->db->where($where)->get('akun')->row('a_id');
			$data['title'] = "Data ".self::$title;
			$data['content'] = "dashboard/akun";
			redirect('akun');
		} else {
			$where = "a_id = '$a_id'";
			$whereJenis = "j_is_deleted = 'False'";
			$data['jenis'] = $this->m_akuns->get_jenis($whereJenis)->result_array();
			$data['akun'] = $this->m_akuns->get_akun($where)->row_array();
			$data['a_id'] = $this->buat_kode();
			$data['form_title'] = "Edit akun Transaksi";
			$data['kodeunik'] = $this->db->where($where)->get('akun')->row('a_id');
			$data['title'] = "Edit ".self::$title;
			$data['action'] = site_url(uri_string());
			$data['content'] = 'dashboard/akun-form';
			if (!$a_id) {
				redirect('akun');
			} else {
				$this->load->view('dashboard/index', $data);
			}
		}
	}

	public function delete($a_id)
	{
		$this->load->helper('notification');

		$data = [
			'a_deleted_at' => date('Y-m-d H:i:s'),
			'a_deleted_by' => $this->session->userdata['u_id'],
			'a_is_deleted' => TRUE
		];

		$this->m_akuns->delete($data, $a_id);
		$this->session->set_flashdata('alert', success('Data Jensi Transaksi berhasil dihapus.'));
		$data['title'] = "Data ".self::$title;
		$data['content'] = "dashboard/akun";
		$this->load->view('dashboard/index', $data);
		redirect('akun');
	}

	public function deleted()
	{
		$data['title'] = "Data ".self::$title;
		$data['content'] = "dashboard/akun-deleted";
		$this->load->view('dashboard/index', $data);
	}

	public function get_deleted()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$this->load->library('datatables_ssp');
			$columns = array(
				array('db' => 'a_id', 'dt' => 'a_id'),
				array('db' => 'a_name', 'dt' => 'a_name'),
				array('db' => 'a_created_at', 'dt' => 'a_created_at'),
				array('db' => 'a_deleted_at', 'dt' => 'a_deleted_at'),
				array(
					'db' => 'a_id',
					'dt' => 'tindakan',
					'formatter' => function($a_id) {
						return '<a class="btn btn-success btn-sm" onclick="return confirmDialog();" href="'.site_url('akun/restore/'.$a_id).'"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Restore</a>';
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
				Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "a_is_deleted = 'TRUE'", $qjoin)
			);
		}
	}

	public function restore(){
		$this->load->helper('notification');
		$a_id = $this->uri->segment(3);

		$data = [
			'a_restored_at' => date('Y-m-d H:i:s'),
			'a_restored_by' => $this->session->userdata['u_id'],
			'a_is_deleted' => 'FALSE'
		];

		$sukses = $this->m_akuns->restore($data, $a_id);

		if ($sukses) {
			$this->session->set_flashdata('alert', success('Data akun Transaksi berhasil direstore.'));
		} else {
			$this->session->set_flashdata('alert', failed('Data akun Transaksi gagal direstore.'));
		}

		$data['title'] = "Data ".self::$title;
		$data['content'] = "dashboard/akun-deleted";
		redirect('akun/deleted');
	}

	public function detail($a_id){
		$data['akun']=$this->m_akuns->get_akun("a_id = '$a_id'")->row_array();
		$data['get_akun']=$this->m_akuns->get_akun("a_is_deleted = 'FALSE'")->result_array();

		$data['jenis'] = $this->m_akuns->get_jenis("jenis.j_is_deleted='FALSE'")->row_array();
		$data['title'] = "Detail ".self::$title;
		$data['form_title'] = "Detail Akun '".strtoupper($data['akun']['a_name'])."'";
		$data['action'] = site_url(uri_string());
		$data['content'] = 'dashboard/akun-detail';
		$this->load->view('dashboard/index',$data); 
	}

	public function print_data(){
		$where = "akun.a_is_deleted = 'FALSE' ";
		$data['akun'] = $this->m_akuns->get_akun($where)->result_array();
		$data['get_akun'] = $this->m_akuns->get_akun($where)->row_array();
		$data['title'] = "Data Akun &minus; Arsip Keuagan Masjid Al-Fath";
		$data['attachment'] = 'Lampiran Akun';
		$this->load->view('dashboard/akun-print', $data);
	}
}