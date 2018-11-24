<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<h2>
	<?=$form_title;?>
	<a class="btn btn-success btn-sm add" href="<?=site_url('sof/add')?>" title="Tambah Data Sumber Dana"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a><a class="btn btn-success btn-sm add" href="<?=site_url('sof/#')?>" title="Cetak Data Sumber Dana"><span class="glyphicon glyphicon-print"></span> Cetak</a>
</h2>

<div class="table-responsive">
	<table id="sof" class="display table table-bordered table-hover table-responsive">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode</th>
				<th>Nama Sumber Dana</th>
				<th>Inisial</th>
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