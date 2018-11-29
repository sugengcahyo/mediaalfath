<?php defined('BASEPATH') OR exit('No direct script access allowed');
class RC4{
    public function krip($data_str){
        $key_str = 'janganlupasholat';
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

?>