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
							<th rowspan="2">Nama Akun</th>
							<th colspan="2">Jenis Akun</th>
							<th rowspan="2">Tanggal Dibuat</th>
						</tr>
						<tr>
							<th>Nama</th>
							<th>Transaksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						foreach($akun as $row){?>
							<tr>
								<td><?=$i++;?></td>
								<td><?=$row['a_id'];?></td>
								<td><?=$row['a_name'];?></td>
								<td><?=$row['j_name'];?></td>
								<td><?=$row['t_name'];?></td>
								<td><?=shortdate_indo($row['a_created_at']);?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>
