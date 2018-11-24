<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="wrapper">
	<div class="header">
		<div class="logo">
			<img src="<?=site_url('assets/img/logos/logo.png')?>" alt="Logo">
		</div>
		<h1>Arsip Keuangan Masjid</h1>
		<h3>Perum APH Seturan Caturtunggal</h3>
		<p>Cari data Masjid Al-Fath</p>
	</div>
	<div class="center">
		<?=form_open($action, 'class="form-inline"')?>
			<div class="form-group">
				<div class="input-group">
				<div class="input-group-addon md"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></div>
					<input type="text" class="form-control md search" id="search" placeholder="No. Regristrasi / Nama Transaksi / Tanggal Transaksi" autocomplete="off" required>
				</div>
			</div>
			<div id="hint">
				<p class="help-block">Masukkan No. Regristrasi / Nama Transaksi / Tanggal Transaksi dan hasil akan otomatis ditampilkan disini.<br>
				<small>Contoh format tanggal YYYY-MM-DD.</small></p>
			</div>
		<?=form_close()?>
	</div>
</div>