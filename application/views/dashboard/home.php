<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<h1>Selamat Datang <small><?=$this->session->userdata['u_fname']?> (<?=$this->session->userdata['u_level']?>)</small></h1>
<h3>Berikut ini adalah statistik data keuangan&nbsp;<a class="btn btn-success btn-sm" href="<?=site_url('report')?>">Lihat Laporan Lengkap</a></h3>
<br>
<div class="row">
	<div class="col-sm-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"> <b>Status Persentase Transaksi</b></h3>
			</div>

			<div class="panel-body row">
				<div class="col-sm-6">
					<div class="panel panel-default">
						<div class="panel-body red">
							<h1 class="ttl"><?=$persend?>%</h1>
							<h3><?=$totald?> Transaksi</h3>
						</div>
						<div class="panel-footer red">DEBIT</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="panel panel-default">
						<div class="panel-body green">
							<h1 class="ttl"><?=$persenk?>%</h1>
							<h3><?=$totalk?> Transaksi</h3>
						</div>
						<div class="panel-footer green">KREDIT</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Jumlah Transaksi</h3>
			</div>
			<div class="panel-body blue">
				<h1 class="total"><?=$total?></h1>
				<h2>Transaksi</h2>
			</div>
		</div>
	</div>
</div>