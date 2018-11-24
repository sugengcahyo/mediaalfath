<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Data Program Keahlian Terhapus</h2>
<div class="table-responsive">
	<table id="sof-deleted" class="display table table-bordered table-hover table-responsive">
		<thead>
			<tr>
				<th width="5%">No</th>
				<th width="12%">Kode</th>
				<th width="27%">Nama Sumber Dana</th>
				<th width="12%">Inisial</th>
				<th width="16%">Dibuat Pada</th>
				<th width="16%">Diperbarui Pada</th>
				<th width="12%">Tindakan</th>
		</thead>
	</table>
	<script>
		function confirmDialog() {
			return confirm("Apakah Anda yakin akan merestore data ini?")
		}
	</script>
</div>
