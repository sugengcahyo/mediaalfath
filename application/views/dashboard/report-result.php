<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($result)) {
$output = '';
$outputdata = '';
$outputtail ='';

$output .= '
<div class="pull-right">
	<button class="btn btn-info hp" onclick="window.print()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</button>
</div>
<br>
<div>
	<h3>Laporan Bulan '.$bulan.' Tahun '.$tahun.'</h3>
</div>
<div class="left-text">
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th rowspan="2">No.</th>
					<th rowspan="2" width="10%">No. Reg.</th>
					<th rowspan="2">Keterangan</th>
					<th colspan="2">Nominal</th>
					<th rowspan="2">Sumber Dana</th>
					<th rowspan="2">ID Akun</th>
					<th rowspan="2">Tanggal</th>
				</tr>
				<tr>
					<th>Kredit</th>
					<th>Debit</th>
				</tr>
			</thead>
			<tbody>';
			$i=1;

			foreach ($result as $row) {
				$outputdata .= '
				<tr>
					<td>'.$i++.'</td>
					<td>'.$row->jur_id.'</td>
					<td>'.$row->jur_name.'</td>
					<td>'.$row->jur_kredit.'</td>
					<td>'.$row->jur_debit.'</td>
					<td>'.$row->jur_sof.'</td>
					<td>'.$row->jur_akun.'</td>
					<td>'.$row->jur_dot.'</td>
				</tr>';
			}

$outputtail .= '
			</tbody>
		</table>
	</div>
</div> ';

	echo $output;
	echo $outputdata;
	echo $outputtail;
} else {
	echo '<div class="err_notif"><h3 class="text-danger"><span><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Tidak ditemukan data</span></div>';
}
