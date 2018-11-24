<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_sofs extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	private static $table = 'sof';
	private static $pk = 's_id';

	public function is_exist($where)
	{
		return $this->db->where($where)->get(self::$table)->row_array();
	}

	public function add($data)
	{
		return $this->db->insert(self::$table, $data);
	}

	public function get_sofs($where)
	{
		return $this->db->where($where)->get(self::$table)->row_array();
	}

	public function edit($data, $s_id)
	{
		return $this->db->set($data)->where(self::$pk, $s_id)->update(self::$table);
	}

	public function delete($data, $s_id)
	{
		return $this->db->set($data)->where(self::$pk, $s_id)->update(self::$table);
	}

	public function restore($data, $s_id)
	{
		return $this->db->set($data)->where(self::$pk, $s_id)->update(self::$table);
	}

	public function buat_kode()   {
		$this->db->select('RIGHT(sof.s_id, 3) as kode', FALSE)->order_by('s_id','DESC')->limit(1);    
		$query = $this->db->get('sof');      //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      
			//jika kode ternyata sudah ada.      
			$data = $query->row();      
			$kode = intval($data->kode) + 1;    
		}else {
			$kode = 1;    
		}
		$kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		$kodejadi = "SD".$kodemax;    // hasilnya ODJ-9921-0001 dst.
		return $kodejadi;  
	} 
}
