<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('m_jeniss');
		// $this->load->model('m_umum');
		$this->auth->restrict();
		$this->auth->admin();
	}

	private static $title = "Jenis Transaksi | Arsip Keuangan Al-Fath";
	private static $table = 'jenis';
	private static $primaryKey = 'j_id';

	public function index(){
		$data['title'] = "Data ".self::$title;
		$data['content'] = "dashboard/jenis";
		$this->load->view('dashboard/index', $data);
	}

	public function get_data(){
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$this->load->library('datatables_ssp');
			$columns = array(
				array('db' => 'j_id', 'dt' => 'j_id'),
				array('db' => 'j_name', 'dt' => 'j_name'),
				array('db' => 't_name', 'dt' => 't_name'),
				array('db' => 'j_created_at', 'dt' => 'j_created_at'),
				array('db' => 'j_updated_at', 'dt' => 'j_updated_at'),
				array(
				'db' => 'j_id',
				'dt' => 'tindakan',
				'formatter' => function($j_id) {
						return '
						<a class="btn btn-info btn-sm mb onclick="return confirmDialog();" href="'.site_url('jenis/edit/'.$j_id).'" title="Edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>

						<a class="btn btn-danger btn-sm mb" onclick="return confirmDialog();" href="'.site_url('jenis/delete/'.$j_id).'" title="Hapus"><span class="glyphicon glyphicon-trash"></span></a>';
					}
				),
			);

			$sql_details = [
				'user' => $this->db->username,
				'pass' => $this->db->password,
				'db' => $this->db->database,
				'host' => $this->db->hostname
			];

			$qjoin="JOIN transaksi ON transaksi.t_id=jenis.j_transaksi";
			// $qjoin=NULL;

			echo json_encode(
				Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "j_is_deleted = 'FALSE'", $qjoin)
			);
		}
	}

	public function add(){
		$this->load->helper(['form', 'notification']);

		if ($this->validation()) {
			$j_id = $this->input->post('j_id', TRUE);
			$j_name = $this->input->post('j_name', TRUE);
			$where = "j_id = '$j_id' OR j_name = '$j_name'";

			$data = $this->m_jeniss->is_exist($where);

			if (strtolower($data['j_name']) === strtolower($this->input->post('j_name'))) {
				$this->session->set_flashdata('alert', error("Nama Jenis Transaksi <b>$data[j_name]</b> tidak boleh ganda!"));
				$data['transaksi'] = $this->m_jeniss->get_transaksi();
				$data['title'] = "Tambah ".self::$title;
				$data['kodeunik'] = $this->m_jeniss->buat_kode();
				$data['form_title'] = "Tambah Jenis Transaksi";
				$data['action'] = site_url(uri_string());
				$data['content'] = 'dashboard/jenis-form';
				$this->load->view('dashboard/index', $data);
			} elseif (strtolower($data['j_id']) === strtolower($this->input->post('j_id'))) {
				$this->session->set_flashdata('alert', error("Kode Jenis Transaksi <b>$data[j_name]</b> tidak boleh ganda!"));
				$data['transaksi'] = $this->m_jeniss->get_transaksi();
				$data['title'] = "Tambah ".self::$title;
				$data['kodeunik'] = $this->m_jeniss->buat_kode();
				$data['form_title'] = "Tambah Jenis Transaksi";
				$data['action'] = site_url(uri_string());
				$data['content'] = 'dashboard/jenis-form';
				$this->load->view('dashboard/index', $data);
			} else {
				$data=[
					'j_id'=>$this->input->post('j_id'),
					'j_name' => ucwords($this->input->post('j_name', TRUE)),
					'j_transaksi' => $this->input->post('j_transaksi', TRUE),
					'j_created_by' => $this->session->userdata['j_id'],
					'j_is_deleted' => 'FALSE'
				];

				$this->m_jeniss->add($data);
				$this->session->set_flashdata('alert', success("Data <b>$data[j_name]</b> telah ditambahkan"));
				$data['transaksi'] = $this->m_jeniss->get_transaksi();
 				$data['title'] = "Data".self::$title;
				$data['content'] = "dashboard/jenis";
				redirect('jenis');
			}
			
		} else {
			$data['jenis'] = FALSE;
			$data['kodeunik'] = $this->m_jeniss->buat_kode();
			$data['transaksi'] = $this->m_jeniss->get_transaksi();
			$data['title'] = "Tambah ".self::$title;
			$data['form_title'] = "Tambah Jenis Transaksi";
			$data['action'] = site_url(uri_string());
			$data['content'] = 'dashboard/jenis-form';
			$this->load->view('dashboard/index', $data);
		}
		
	}

	public function edit(){
		$this->load->helper(['form', 'notification']);
        $j_id = $this->uri->segment(3);

        if ($this->validation()) {

            $data = [
                'j_name' => ucwords($this->input->post('j_name', TRUE)),
                'j_transaksi' => ucwords($this->input->post('j_transaksi', TRUE)),
                'j_updated_at' => date('Y-m-d H:i:s'),
                'j_updated_by' => $this->session->userdata['u_id']
            ];

            $this->m_jeniss->edit($data, $j_id);
            $this->session->set_flashdata('alert', success("Data Jenis Transaksi <b>$data[j_name]</b> berhasil diperbarui."));
            $data['kodeunik'] = $j_id;
            $data['title'] = "Data ".self::$title;
            $data['content'] = "dashboard/jenis";
            redirect('jenis');

        } else {
            $where = "j_id = '$j_id'";

			$data['transaksi'] = $this->m_jeniss->get_transaksi();
            $data['jenis'] = $this->m_jeniss->get_data($where);
            $data['form_title'] = "Edit Jenis Transaksi";
            $data['kodeunik'] = $this->db->where($where)->get('jenis')->row('j_id');
            $data['title'] = "Edit ".self::$title;
            $data['action'] = site_url(uri_string());
            $data['content'] = 'dashboard/jenis-form';
            if (!$j_id) {
                redirect('jenis');
            } else {
                $this->load->view('dashboard/index', $data);
            }
        }
	}

	public function delete($j_id){
		$this->load->helper('notification');

		$data = [
			'j_deleted_at' => date('Y-m-d H:i:s'),
			'j_deleted_by' => $this->session->userdata['u_id'],
			'j_is_deleted' => "TRUE"
		];

		$this->m_jeniss->delete($data, $j_id);
		$this->session->set_flashdata('alert', success("Data Jensi Transaksi <b>$data[j_name]</b> berhasil dihapus."));
		$data['title'] = "Data ".self::$title;
		$data['content'] = "dashboard/jenis";
		$this->load->view('dashboard/index', $data);
		redirect('jenis');
	}

	public function deleted(){
		$data['title'] = "Data ".self::$title;
		$data['content'] = "dashboard/jenis-deleted";
		$this->load->view('dashboard/index', $data);
	}

	public function get_deleted(){
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$this->load->library('datatables_ssp');
			$columns = array(
				array('db'=>'j_id', 'dt'=>'j_id'),
				array('db'=>'j_name', 'dt'=>'j_name'),
				array('db'=>'j_created_at', 'dt'=>'j_created_at'),
				array('db'=>'j_deleted_at', 'dt'=>'j_deleted_at'),
				array(
					'db'=>'j_id',
					'dt'=>'tindakan',
					'formatter'=>function($j_id){
						return '<a class="btn btn-success btn-sm" onclick="return confirmDialog();" href="'.site_url('jenis/restore/'.$j_id).'"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Restore</a>';
					}
				)
			);

			$sql_details = [
				'user' => $this->db->username,
				'pass' => $this->db->password,
				'db' => $this->db->database,
				'host' => $this->db->hostname
			];

			$qjoin = NULL;

			echo json_encode(
				Datatables_ssp::complex($_GET, $sql_details, self::$table, self::$primaryKey, $columns, NULL, "j_is_deleted = 'TRUE'", $qjoin)
			);
		}
		
	}

	public function restore(){
		$this->load->helper('notification');
		$j_id = $this->uri->segment(3);

		$data = [
		    'j_restored_at' => date('Y-m-d H:i:s'),
		    'j_restored_by' => $this->session->userdata['u_id'],
		    'j_is_deleted' => 'FALSE'
		];

		$this->m_jeniss->restore($data, $j_id);
		$this->session->set_flashdata('alert', success("Data Jenis Transaksi <b>$data[j_name]</b> berhasil direstore."));
		$data['title'] = "Data ".self::$title;
		$data['content'] = "dashboard/jenis-deleted";
		redirect('jenis/deleted');
	}

	private function validation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('j_id', 'Kode Unik', 'trim|required|max_length[5]');
		$this->form_validation->set_rules('j_name', 'Nama Jenis Transaksi', 'trim|required|min_length[5]|max_length[50]');
		return $this->form_validation->run();
	}
}

?>