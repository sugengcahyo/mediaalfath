<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_akuns extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	private static $table = 'akun';
	private static $pk = 'a_id';
	
	public function is_exist($where){
		return $this->db->where($where)->get(self::$table)->row_array();
	}

	public function add($data){
		return $this->db->insert(self::$table, $data);
	}

	public function get_akun($where){
		// return $this->db->where($where)->get(self::$table)->row_array();
		return $this->db->join("users", "users.u_id=akun.a_created_by", "left")->join("jenis", "jenis.j_id=akun.a_jid", "left")->join("transaksi", "transaksi.t_id=jenis.j_transaksi", "left")->where($where)->get(self::$table);
	}

	public function get_jenis($where){
		$this->db->order_by('j_name','DESC');  
		// return $this->db->where($where)->get('jenis')->result_array();
		return $this->db->where($where)->get('jenis');
	}

	public function edit($data, $a_id){
		return $this->db->set($data)->where(self::$pk, $a_id)->update(self::$table);
	}

	public function delete($data, $a_id){
		return $this->db->set($data)->where(self::$pk, $a_id)->update(self::$table);
	}

	public function restore($data, $a_id){
		return $this->db->set($data)->where(self::$pk, $a_id)->update(self::$table);
	}

	public function ambil_kode() {
		$this->db->select('RIGHT(akun.a_id, 3) as kode', FALSE);
		$this->db->order_by('a_id','DESC');    
		$this->db->limit(1);  
	}
}
