<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_jeniss extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	private static $table = "jenis";
	private static $pk = "j_id";

	public function is_exist($where){
		return $this->db->where($where)->get(self::$table)->row_array();
	}

	public function get_data($where){
		return $this->db->where($where)->get(self::$table)->row_array();
	}

	public function buat_kode()   {
		$this->db->select('RIGHT(jenis.j_id, 3) as kode', FALSE)->order_by('j_id','DESC')->limit(1);    
		$query = $this->db->get('jenis');      //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      
			//jika kode ternyata sudah ada.      
			$data = $query->row();      
			$kode = intval($data->kode) + 1;    
		}else {
			$kode = 1;    
		}
		$kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		$kodejadi = "JE".$kodemax;    // hasilnya ODJ-9921-0001 dst.
		return $kodejadi;
	}

	public function get_transaksi(){
		return $this->db->get('transaksi')->result_array();
	}

	public function add($data){
		return $this->db->insert(self::$table, $data);
	}

	public function edit($data, $j_id){
		return $this->db->set($data)->where(self::$pk, $j_id)->update(self::$table);
	}

	public function delete($data, $j_id){
		return $this->db->set($data)->where(self::$pk, $j_id)->update(self::$table);
	}

	public function restore($data, $j_id){
		return $this->db->set($data)->where(self::$pk, $j_id)->update(self::$table);
	}
}
?>