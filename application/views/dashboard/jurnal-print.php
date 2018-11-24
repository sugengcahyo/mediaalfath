<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!doctype html>
<html lang="id">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="shortcut icon" href="<?=site_url('assets/img/logo.png')?>">
		<meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1">
		<title><?=$title?></title>
		<?=link_tag('assets/css/bootstrap.css?ver=3.3.7')?>
		<?=link_tag('assets/css/style.css?ver=1.0.0')?>
	</head>
	<body onload="window.print()">
		<div class="container isi">
			<div class="tc">
				<h3><?=$attachment?></h3>

				<hr><width="100" height="75"></hr>
				<h1>
					<center><font size="11" face="Times New Roman"><b>TAKMIR MASJID AL-FATH</b></font></center>
				</h1>
				<small>
					<center><b>PERUM APH Blok EII/16.05.95 Seturan Caturtunggal Depok Sleman D.I.Yogyakarta<b></center><br>
				</small>
				<hr><width="100" height="75"></hr>
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							<th rowspan="2">No.</th>
							<th rowspan="2" width="10%">No. Reg.</th>
							<th rowspan="2">Keterangan</th>
							<th colspan="2">Nominal</th>
							<th rowspan="2">Sisa</th>
							<th rowspan="2">ID Akun</th>
							<th rowspan="2">Tanggal</th>
						</tr>
						<tr>
							<th>Kredit</th>
							<th>Debit</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						foreach($jurnal as $row){?>
							<tr>
								<td><?=$i++;?></td>
								<td><?=$row['jur_id'];?></td>
								<td><?=$row['jur_name'];?></td>
								<td><?=nominal($row['jur_kredit']);?></td>
								<td><?=nominal($row['jur_debit']);?></td>
								<td><?=$row['s_name'];?></td>
								<td><?=$row['a_name'];?></td>
								<td><?=shortdate_indo($row['jur_dot']);?></td>
							</tr>
						<?php } ?>
						
					</tbody>
					<tfoot>
						<tr>
							<td colspan="3">Sub Total</td>
							<td><?=$this->m_jurnals->jumKredit()?></td>
							<td><?=$this->m_jurnals->jumDebit()?></td>
							<td colspan="3"></td>
						</tr>
						<tr>
							<td colspan="3">Sisa Anggaran (Kredit-Debit)</td>
							<td colspan="5"><?=$this->m_jurnals->jumTotal()?></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</body>
</html>
