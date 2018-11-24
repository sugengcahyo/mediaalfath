<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_jurnals extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("format");
	}

	private static $table = 'jurnal'
	;
	private static $pk = 'jur_id';

	public function is_exist($where){
		return $this->db->where($where)->get(self::$table)->row_array();
	}

	public function get_jurnal($where){
		$query = $this
					->db
					->select('*')
					->from(self::$table)
					->join('akun', 'akun.a_id = jurnal.jur_akun', 'left')
					->join('sof', 'sof.s_id = jurnal.jur_sof', 'left')
					->join('jenis', 'jenis.j_id = akun.a_jid', 'left')
					->join('transaksi', 'transaksi.t_id = jenis.j_transaksi', 'left')
					->join('users', 'users.u_id = jurnal.jur_created_by', 'left')
					->where($where)
					->get();

		if ($query->num_rows() > 0) {
			return $query;
		} else {
			return NULL;
		}
	}

	public function get_akun($where){
		$this->db->order_by('a_name','DESC'); 
		return $this->db->where($where)->get('akun')->result_array();
	}

	public function get_jenis($where){
		$this->db->order_by('j_name', 'DESC');
		return $this->db->where($where)->get('jenis')->result_array();
	}

	public function get_sof($where){
		$this->db->order_by('s_name', 'DESC');
		return $this->db->where($where)->get('sof')->result_array();
	}

	public function get_transaksi()	{
		return $this->db->get('transaksi')->result_array();
	}

	public function add($data)
	{
		return $this->db->insert(self::$table, $data);
	}

	public function edit($data, $jur_id)
	{
		return $this->db->set($data)->where(self::$pk, $jur_id)->update(self::$table);
	}

	public function delete($data, $jur_id)
	{
		return $this->db->set($data)->where(self::$pk, $jur_id)->update(self::$table);
	}

	public function restore($data, $jur_id)
	{
		return $this->db->set($data)->where(self::$pk, $jur_id)->update(self::$table);
	}

	public function buat_kode()   {
		$date = new DateTime('now');
		
		$tahun = $date->format('y');
		$bulan = $date->format('m');
		$tanggal = $date->format('d');

		$this->db->select('RIGHT(jurnal.jur_id, 3) as kode', FALSE);
		$this->db->order_by('jur_id','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('jurnal');      //cek dulu apakah ada sudah ada kode di tabel.    
		
		if($query->num_rows() <> 0){      
			//jika kode ternyata sudah ada.      
			$data = $query->row();      
			$kode = intval($data->kode) + 1;    
		}else{
			$kode = 1;    
		}

		$kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		$kodejadi = $tahun.$bulan.$tanggal.$kodemax;    // hasilnya ODJ-9921-0001 dst.
		return $kodejadi;  
	} 

	//set debit dan kredit
	function setKredit(){
		$this->db->select("SUM(jur_kredit) as total");
		$this->db->from("jurnal")->where("jur_is_deleted = 'FALSE'");
		$jumlah = $this->db->get()->row()->total;
		return $jumlah;
	}

	function setDebit(){
		$this->db->select("SUM(jur_debit) as total");
		$this->db->from("jurnal")->where("jur_is_deleted = 'FALSE'");
		$jumlah = $this->db->get()->row()->total;
		return $jumlah;
	}

	public function jumKredit(){
		$kredit = $this->setKredit();
		return $this->format->rupiah($kredit);
	}

	public function jumDebit(){
		$debit = $this->setDebit();
		return $this->format->rupiah($debit);

	}

	public function jumTotal(){
		$debit = $this->setDebit();
		$kredit = $this->setKredit();

		$jumlah = $this->format->rupiah($kredit-$debit);
		return $jumlah;
	}
}
