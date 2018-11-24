<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_reports extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	private static $table = 'jurnal';

	public function get_result($where)
	{
		$query = $this
					->db
					->select('*')
					->from(self::$table)
					->join('akun', 'akun.a_id = jurnal.jur_id', 'left')
					->where($where)
					->order_by('jur_id', 'DESC')
					->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return NULL;
		}
	}
}
