<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboards extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}

	private static $table='jurnal';

	public function total($wt){
		return $this->db->where($wt)->get(self::$table)->result();
	}

	public function get_data()	{
		return $this->db->query("select * from ".self::$table." where jur_is_deleted = FALSE")->result();		
	}

	public function debit(){
		return $query = $this->db->where("jurnal.jur_debit != 0")->get(self::$table);
	}

	public function kredit(){
		return $query = $this->db->query("SELECT * FROM ".self::$table." where jurnal.jur_kredit != 0");
	}
}
?>