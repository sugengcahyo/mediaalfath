<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_homes extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	private static $table = 'jurnal';

	public function get_result($keyword)
	{
		$query = $this
					->db
					->select('*')
	                ->from(self::$table)
					->join('akun.a_id', 'akun.a_id = jurnal.jur_akun', 'left')
					->join('sof.s_id', 'akun.s_id = jurnal.jur_sof', 'left')
					->join('jenis.j_id', 'jenis.j_id = akun.a_jid', 'left')
					->join('transaksi.t_id', 'transaksi.t_id = jenis.j_transaksi', 'left')
	                ->like('jur_id', $keyword)
	                ->or_like('jur_name', $keyword)
					->or_like('a_name', $keyword)
					->or_like('s_name', $keyword)
					->or_like('j_name', $keyword)
					->or_like('t_name', $keyword)
					->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
	}

	public function get_data($jur_id)
	{
		$where = "jurnal.jur_id = '$jur_id'";

		$query = $this
					->db
					->select('*')
					->from(self::$table)
					->join('akun', 'akun.a_id = jurnal.jur_akun', 'left')
					->where($where)
					->get();

		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return NULL;
		}
	}
}
