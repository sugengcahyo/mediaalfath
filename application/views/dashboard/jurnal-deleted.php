<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Data jurnal Terhapus</h2>
<div class="table-responsive">
	<table id="jurnal-deleted" class="display table table-bordered table-hover table-responsive">
		<thead>
			<tr>
				<th>No.</th>
				<th>No. Regristrasi</th>
				<th>Keterangan</th>
				<th>Dibuat</th>
				<th>Dihapus</th>
				<th>Tindakan</th>
			</tr>
		</thead>
	</table>
	<script>
		function confirmDialog() {
			return confirm("Apakah Anda yakin akan merestore data ini?")
		}
	</script>
</div>
