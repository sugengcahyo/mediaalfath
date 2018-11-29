<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	 
	//combo dekrip
	if (!function_exists('dekrip')) {
		function dekrip($data_str){
			//===================dekripsi===================
			$dekrip=strrev($data_str);
			
			$jml = strlen($data_str);//menghitung jumlah kata (global)
			$jmlglobal=$jml;
			
			$arrHuruf = str_split($dekrip);
			$dekripsi = "";
			//dekripsi caesar
			foreach ($arrHuruf as $tmp){
				$dekripsi .= chr(ord($tmp)-1);
			}
			
			//dekripsi playfair
			if($jml%3==1){
				$jml=$jml+2;
			}else if($jml%3==2){
				$jml=$jml+1;
			}
			$split = str_split($dekripsi,$jml/3);
			$hasildekrip="";
			for ($y=0;$y<($jml/3);$y++){
				for ($x=0;$x<3;$x++){
					$hasildekrip=$hasildekrip . $split[$x][$y];
				}
			}
			$arrHuruf = str_split($hasildekrip);
			$hasilfix="";
			
			for($x=0; $x<$jmlglobal; $x++){
				$hasilfix=$hasilfix . $arrHuruf[$x];
			}
			$result = ucwords($hasilfix);
			return $result;
		}
	}
	
	//combo enkrip
	if ( ! function_exists('enkrip')){
		function enkrip($data_str){
			$kata = $data_str;
			$jml = strlen($kata);//menghitung jumlah kata (global)
			$jmlglobal=$jml;

			if($jml%3==1){
				$kata=$kata . "zz";
			}else if($jml%3==2){
				$kata=$kata . "z";
			}
			$split = str_split($kata,3);

			//enkripsi playfair
			$enkripsi="";
			for ($y=0;$y<3;$y++){
				for ($x=0;$x<($jml/3);$x++){
					$enkripsi=$enkripsi . $split[$x][$y];
				} 
			}
			
			//enkripsi caesar
			$hasilenkrip="";
			$arrHuruf = str_split($enkripsi);
			foreach ($arrHuruf as $tmp){
				$hasilenkrip .= chr(ord($tmp)+1);
			}
			//membalikkan karakter yg paling awal jadi belakang
			$enkripfix=strrev($hasilenkrip);
			//hasil enkripsi
			return $enkripfix;
		}	
	}

	//rc4 new
	if(!function_exists('newrc4')){
		$s = array();
		$i = 0;
		$j = 0;
		$_key = 'sholatduluguys';

		function crypt_rc4($key = null){
			if ($key != null){
				$this->setKey($key);
			}
		}

		function setKey($key){
			if (strlen($key) > 0){
				$this->_key = $key;
			}
		}

		function keys (&$key){
			$len = strlen ($key);
			
			for  ($this->i = 0;$this->i < 256;$this->i++){ //Inisialisasi array s dengan nilai default
				$this->s[$this->i] = $this->i;
			}

			$this->j = 0;
			$idx = 0;
			for ($this->i = 0; $this->i < 256; $this->i++){     //Proses penukaran / perubahan isi array s sesuai rumus / algoritma
				$this->j = ($this->j + $this->s[$this->i] + $key[$idx]) % 256;
				$t = $this->s[$this->i];                    //Variabel temporary sebagai wadah swapping var s[i] dan s[j]
				$this->s[$this->i] = $this->s[$this->j];
				$this->s[$this->j] = $t;
				$idx = ($idx + 1) % $len;
			}

			$this->i = $this->j = 0; //Kembalikan ke nilai awal yaitu 0. Nilai yang digunakan nantinya array s nya
		}

		function encrypt (&$string){
			
			$this->key($this->_key); //Lakukan inisialisasi awal dan swapping nilai dari array s

			$this->i = 0;
			$this->j = 0;

			$len = strlen($string);
			
			for ($c = 0; $c < $len; $c++){
				$this->i = ($this->i + 1) % 256;
				$this->j = ($this->j + $this->s[$this->i]) % 256;
				$t = $this->s[$this->i];
				$this->s[$this->i] = $this->s[$this->j];
				$this->s[$this->j] = $t;

				$t = ($this->s[$this->i] + $this->s[$this->j]) % 256;

				//$data[$counter] ^= $state[($state[$x] + $state[$y]) % 256];

				//$string[$c] = chr(ord($string[$c]) ^ $this->s[$t]);
				$string[$c] = chr(ord($string[$c]) ^ $this->s[$t]);
			}
		}

		function decrypt (&$string){
			$this->encrypt($string);
		}
	}

	//algo rc4
	if ( ! function_exists('rc4')){
		function rc4 ($data_str){
			$key_str = 'sholatduluguys';
			$key = array();
			$data = array();
			$state = array();

			for ($i = 0; $i < strlen($key_str); $i++){
				$key[] = ord($key_str{$i});
			}
			for ( $i = 0; $i < strlen($data_str); $i++ ) {
				$data[] = ord($data_str{$i});
			}
			for ($i = 0; $i < 256; $i++){
				$state[$i] = $i;
			}

			$len = count($key);
			$index1 = $index2 = 0;

			for ($counter = 0; $counter < 256; $counter++){
				$index2 = ($key[$index1] + $state[$counter] + $index2) % 256;
				$tmp = $state[$counter];
				$state[$counter] = $state[$index2];
				$state[$index2] = $tmp;
				$index1 = ($index1 + 1) % $len;
			}

			$len = count($data);
			$x = $y = 0;
			for ($counter = 0; $counter < $len; $counter++) {
				$x = ($x + 1) % 256;
				$y = ($state[$x] + $y) % 256;
				$tmp = $state[$x];
				$state[$x] = $state[$y];
				$state[$y] = $tmp;
				$data[$counter] ^= $state[($state[$x] + $state[$y]) % 256];
			}
			$data_str = "";
			for ( $i = 0; $i < $len; $i++ ) {
				$data_str .= chr($data[$i]);
			}
			return $data_str;
		}
	}