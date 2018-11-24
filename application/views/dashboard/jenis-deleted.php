<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Data Jenis Objek Terhapus</h2>
<div class="table-responsive">
	<table id="jenis-deleted" class="display table table-bordered table-hover table-responsive">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode</th>
				<th>Nama Jenis Objek</th>
				<th>Dibuat Pada</th>
				<th>Diperbarui Pada</th>
				<th>Tindakan</th>
		</thead>
	</table>
	<script>
		function confirmDialog() {
			return confirm("Apakah Anda yakin akan merestore data ini?")
		}
	</script>
</div>
