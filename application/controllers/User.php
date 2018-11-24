<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('m_users');
		$this->auth->restrict();
	}

	private static $title = "User Accounts | Arsip Keuangan Al-Fath";
	private static $table = "users";
	private static $pk = "u_id";

	public function index(){
		$this->auth->admin();
		$data['title'] = "Data ".self::$title;
		$data['content'] = "dashboard/user";
		$this->load->view('dashboard/index', $data);
	}

	public function get_data(){
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$this->load->library('datatables_ssp');
			$columns = array(
				array('db' => 'u_name', 'dt' => 'u_name'),
				array('db' => 'u_fname', 'dt' => 'u_fname'),
				array('db' => 'u_fpass', 'dt' => 'u_fpass'),
				array('db' => 'u_level', 'dt' => 'u_level'),
				array('db' => 'u_is_active', 'dt' => 'u_is_active'),
				array('db' => 'u_last_logged_in', 'dt' => 'u_last_logged_in'),
				array(
					'db' => 'u_id',
					'dt' => 'tindakan',
					'formatter' => function($u_id){
						return '<a class="btn btn-info btn-sm" href="'.site_url('user/edit/'.$u_id).'" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
						<a class="btn btn-warning btn-sm" onclick="return confirmReset();" href="'.site_url('user/reset/'.$u_id).'" title="Reset Password"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span></a>
						<a class="btn btn-danger btn-sm" onclick="return confirmDelete();" href="'.site_url('user/delete/'.$u_id).'" title="Info detail akun"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
						
					}
				)
			);

			$sql_details = [
				'user' => $this->db->username,
				'pass' => $this->db->password,
				'db' => $this->db->database,
				'host' => $this->db->hostname
			];

			echo json_encode(
				Datatables_ssp::simple($_GET, $sql_details, self::$table, self::$pk, $columns)
			);
		}

	}

	public function add(){
		$this->auth->admin();
        $this->load->helper(['form', 'notification']);

        if ($this->validation()) {

            $u_name = $this->input->post('u_name', TRUE);
            $where = "u_name = '$u_name'";

            $data = $this->m_users->is_exist($where);
            if (strtolower($data['u_name']) === strtolower($this->input->post('u_name', TRUE))) {
                $this->session->set_flashdata('alert', error('Username sudah digunakan!'));
                $data['title'] = "Tambah ".self::$title;
	            $data['level'] = $this->m_users->get_level();
                $data['content'] = 'dashboard/user-add';
                $this->load->view('dashboard/index', $data);

            } else {
                $this->load->helper('string');

        		$data = [
        			'u_id' => random_string('alnum', 5),
        	        'u_name' => $this->input->post('u_name', TRUE),
        	        'u_pass' => password_hash($this->input->post('u_pass', TRUE), PASSWORD_DEFAULT, ['cost' => 5]),
        	        'u_fpass' => $this->input->post('u_pass', TRUE),
        			'u_fname' => $this->input->post('u_fname', TRUE),
        			'u_level' => $this->input->post('u_level', TRUE),
        			'u_is_active' => $this->input->post('u_is_active', TRUE),
        			'u_created_by' => $this->session->userdata['u_id']
        		];

                $this->m_users->add($data);
                $this->session->set_flashdata('alert', success('User baru berhasil ditambahkan.'));
                $data['title'] = "Data ".self::$title;
                $data['content'] = "dashboard/user";
                redirect('user');
            }

        } else {
            $data['title'] = "Tambah ".self::$title;
            $data['level'] = $this->m_users->get_level();
            $data['content'] = 'dashboard/user-add';
            $this->load->view('dashboard/index', $data);
        }
	}

	public function edit(){
		$this->auth->admin();
		$this->load->helper(['form', 'notification']);
		$u_id = $this->uri->segment(3);

		if($u_id == "xB3gG"){
			$this->session->set_flashdata('alert', error('Admin utama tidak bisa diedit pada form ini'));
			redirect('user');
		}
		if ($this->validation_edit()) {
			$u_id = $this->input->post('u_id', TRUE);

			$data = [
				'u_level' => $this->input->post('u_level', TRUE),
				'u_updated_at' => date('Y-m-d H:i:s'),
				'u_updated_by' => $this->session->userdata['u_id'],
				'u_is_active' => $this->input->post('u_is_active', TRUE)
			];

			$this->m_users->edit($data, $u_id);
			$this->session->set_flashdata('alert', success('Data user berhasil diperbarui'));
			$data['title'] = "Data ".self::$title;
			$data['content'] = 'dashboard/user';
			redirect('user');
		} else {
			$where = "u_id = '$u_id'";

			$data['user'] = $this->m_users->get_data($where);
			$data['level'] = $this->m_users->get_level();
			$data['title'] = "Edit ".self::$title;
			$data['content'] = 'dashboard/user-edit';

			if (!$u_id) {
				redirect('user');
			} else {
				$this->load->view('dashboard/index', $data);
			}
			
		}
		
	}

	public function delete(){
		redirect('home');
	}

	public function reset(){
		$this->auth->admin();
		$this->load->helper(['form', 'notification']);
		$u_id = $this->uri->segment(3);

		if($u_id == "xB3gG"){
			$this->session->set_flashdata('alert', error("Admin tidak boleh direset"));
			redirect('user');
		}

		$data=[
			'u_pass' => password_hash("passulang", PASSWORD_DEFAULT, ['cost' => 5]),
			'u_fpass' => "passulang",
			'u_updated_at' => date('Y-m-d H:m:s'),
			'u_updated_by' => $this->session->userdata['u_id'],
			'u_password_updated_at' => date('Y-m-d H:m:s')
		];

		$this->m_users->reset($data, $u_id);
		$this->session->set_flashdata('alert', success('Data password user berhasil direset'));
		$data['title'] = "Data ".self::$title;
		$data['content'] = 'dashboard/user';
		redirect('user');
	}

	public function profile(){
		if ($this->validation_update()) {
			$this->load->helper(['form', 'notification']);
			$u_id = $this->session->userdata['u_id'];

			$data = [
				'u_pass' => password_hash($this->input->post('u_pass', TRUE), PASSWORD_DEFAULT, ['cost' => 5]),
				'u_fname' => $this->input->post('u_fname', TRUE),
				'u_fpass' => $this->input->post('u_pass', TRUE),
				'u_updated_at' => date('Y-m-d H:i:s'),
				'u_password_updated_at' => date('Y-m-d H:i:s')
			];

			$this->m_users->update($data, $u_id);
			$this->session->set_flashdata('alert', success('Data profile berhasil diperbarui.'));
			$this->session->set_flashdata('logout', '<script>setTimeout(function(){window.location.href="'.site_url('logout').'"}, 5000);</script>');
			$data['title'] = "Data ".self::$title;
			$data['content'] = "dashboard/user-profile";
			redirect('user/profile');

		} else {
			$this->load->helper('form');

			$u_id = $this->session->userdata['u_id'];
			$where = "u_id = '$u_id'";

			$data['user'] = $this->m_users->get_data($where);
			$data['title'] = "Update Profil ".self::$title;
			$data['content'] = 'dashboard/user-profile';
			$this->load->view('dashboard/index', $data);
		}
	}

	private function validation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('u_name', 'Username', 'trim|required|min_length[5]|max_length[20]');
		$this->form_validation->set_rules('u_pass', 'Password', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('u_fname', 'Nama Lengkap', 'trim|required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('u_level', 'User Level', 'trim|required');
		return $this->form_validation->run();
	}

	private function validation_edit(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('u_level', 'User Level', 'trim|required');
		$this->form_validation->set_rules('u_is_active', 'Status', 'trim|required');
		return $this->form_validation->run();
	}

	private function validation_update(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('u_pass', 'Password Baru', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('u_passconf', 'Konfirmasi Password', 'trim|required|min_length[5]|matches[u_pass]');
		$this->form_validation->set_rules('u_fname', 'Nama Lengkap', 'trim|required|min_length[3]|max_length[50]');
		return $this->form_validation->run();
	}
}
?>