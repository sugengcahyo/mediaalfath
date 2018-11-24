<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Data Jenis Objek Terhapus</h2>
<div class="table-responsive">
	<table id="akun-deleted" class="display table table-bordered table-hover table-responsive">
		<thead>
			<tr>
				<th width="5%">No</th>
				<th width="12%">Kode</th>
				<th width="29%">Nama Jenis Objek</th>
				<th width="21%">Dibuat Pada</th>
				<th width="21%">Diperbarui Pada</th>
				<th width="12%">Tindakan</th>
		</thead>
	</table>
	<script>
		function confirmDialog() {
			return confirm("Apakah Anda yakin akan merestore data ini?")
		}
	</script>
</div>
