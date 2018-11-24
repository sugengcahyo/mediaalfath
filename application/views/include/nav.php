<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
	if ($this->session->flashdata('alert')) {
		echo $this->session->flashdata('alert');
} ?>
<nav class="navbar navbar-default">
	<div class="container-fluid navbar-default navbar-fixed-top">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<!-- <span class="sr-only">Toggle navigation</span> -->
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<a class="navbar-brand" href="<?=site_url('dashboard')?>"><img class="brand-logo" src="<?=site_url('assets/img/logos/logowhite.png')?>" alt=""><b>AL-FATH</b></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="<?=site_url('dashboard')?>">Beranda</a></li>
				<li><a href="<?=site_url('jurnal')?>">Jurnal Transaksi</a></li>
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laporan<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?=site_url('report/#')?>">Laporan Bulanan</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="<?=site_url('report/#')?>">Laporan Tahunan</a></li>
					</ul>
				</li>

				<!-- Menu Session Admin -->
				<?php if ($this->session->userdata['u_level'] == "Administrator")  { ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data Master<span class="caret"></span></a>
					<ul class="dropdown-menu">
							<li><a href="<?=site_url('akun')?>">Akun</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?=site_url('sof')?>">Sumber Dana</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?=site_url('jenis')?>">Jenis Objek</a></li>
					</ul>
				</li>
				<?php } ?>
				<!-- Batas -->
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php if ($this->session->userdata['u_level'] == "Administrator") { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Data User"><span class="lg glyphicon glyphicon-cog"><span></a>
						<ul class="dropdown-menu">
							<li><a href="<?=site_url('user')?>">Manajemen User</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Berkas Terhapus"><span class="lg glyphicon glyphicon-trash"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?=site_url('jurnal/deleted')?>">Data Jurnal Transaksi</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?=site_url('akun/deleted')?>">Data Akun</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?=site_url('sof/deleted')?>">Sumber Dana</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?=site_url('jenis/deleted')?>">Jenis Objek</a></li>
						</ul>
					</li>
				<?php }?>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?=$this->session->userdata['u_fname']?> <span class="caret"></span>
					</a>
					
					<ul class="dropdown-menu">
						<li><a href="<?=site_url('user/profile')?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Ubah Password</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="<?=site_url('logout')?>"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
