<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<h2>
	Data Jenis Objek
	<a class="btn btn-success btn-sm add" href="<?=site_url('jenis/add')?>" title="Tambah Data Jenis Objek"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a><a class="btn btn-success btn-sm add" href="<?=site_url('jenis/#')?>" title="Cetak Data Jenis Objek"><span class="glyphicon glyphicon-print"></span> Cetak</a>
</h2>

<div class="table-responsive">
	<table id="jenis" class="display table table-bordered table-hover table-responsive">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode</th>
				<th>Nama Jenis Objek</th>
				<th>Transaksi</th>
				<th>Dibuat</th>
				<th>Diperbarui</th>
				<th>Tindakan</th>
			</tr>
		</thead>
	</table>
	<script type="text/javascript">
		function confirmDialog(){
			return confirm("Apakah anda yakin menghapus data ini?");
		}
	</script>
</div>