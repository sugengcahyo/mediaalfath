<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<h2>
	Data Akun User
	<a class="btn btn-success btn-sm add" href="<?=site_url('user/add')?>" title="Tambah Data Akun User"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a><a class="btn btn-success btn-sm add" href="<?=site_url('user/print')?>" title="Cetak Data Akun User"><span class="glyphicon glyphicon-print"></span> Cetak</a>
</h2>

<div class="table-responsive">
	<table id="user" class="display table table-bordered table-hover table-responsive">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Lengkap</th>
				<th>Level</th>
				<th>Username</th>
				<th>Password</th>
				<th>Status</th>
				<th>Terakhir Online</th>
				<th>Tindakan</th>
			</tr>
		</thead>
	</table>
	<script type="text/javascript">
		function confirmDelete(){
			return confirm("Apakah anda yakin menghapus data ini?");
		}

		function confirmReset(){
			return confirm("Apakah anda yakin mereset data akun ini?");
		}
	</script>
</div>