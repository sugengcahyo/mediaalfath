<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<h2>
	Data Akun Transaksi
	<a class="btn btn-success btn-sm add" href="<?=site_url('akun/add')?>" title="Tambah Data Akun Transaksi"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a><a class="btn btn-success btn-sm add" href="<?=site_url('akun/print_data')?>" title="Cetak Data Akun Transaksi"><span class="glyphicon glyphicon-print"></span> Cetak</a>
</h2>

<div class="table-responsive">
	<table id="akun" class="display table table-bordered table-hover table-responsive">
		<thead>
			<tr>
				<th rowspan="2">No</th>
				<th rowspan="2">Kode</th>
				<th rowspan="2">Nama Akun</th>
				<th colspan="2">Jenis Akun</th>
				<th rowspan="2">Dibuat</th>
				<th rowspan="2">Diperbarui</th>
				<th rowspan="2">Tindakan</th>
			</tr>

			<tr>
				<th>Nama</th>
				<th>Transaksi</th>
			</tr>
		</thead>
	</table>
	<script type="text/javascript">
		function confirmDialog(){
			return confirm("Apakah anda yakin menghapus data ini?");
		}
	</script>
</div>