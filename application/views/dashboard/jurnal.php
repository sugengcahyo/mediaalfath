<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>
	Data Jurnal
	<a class="btn btn-success btn-sm add" href="<?=site_url('jurnal/add')?>" title="Tambah Data Jurnal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a><a class="btn btn-success btn-sm add" href="<?=site_url('jurnal/print_data')?>" title="Cetak Data"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</a>
</h2>
<div class="table-responsive">
	<table id="jurnal" class="display table table-bordered table-hover table-responsive">
		<thead>
			<tr>
				<th rowspan="2">No.</th>
				<th rowspan="2" width="10%">No. Reg.</th>
				<th rowspan="2">Keterangan</th>
				<th colspan="2">Nominal</th>
				<th rowspan="2">Sumber Dana</th>
				<th rowspan="2">ID Akun</th>
				<th rowspan="2">Tanggal</th>
				<th rowspan="2" width="12%">Tindakan</th>
			</tr>
			<tr>
				<th>Kredit</th>
				<th>Debit</th>
			</tr>
		</thead>
	</table>

	<script>
		function confirmDialog() {
			return confirm("Apakah Anda yakin akan menghapus data ini?")
		}

		function confirmDialogStatus() {
			<?php if ($this->session->userdata['u_level'] == "Administrator") { ?>
				return confirm("Apakah Anda yakin akan mengubah status data ini menjadi tidak aktif?")
			<?php } else { ?>
				window.alert("Hanya Administrator yang boleh mengubah status data!")
			<?php } ?>
		}
	</script>

	<div class="row form-horizontal col-sm-6" id="jurnal">
	<label class="control-label">Rincian Jurnal</label>
		<hr>
		<div class="form-group">
			<label class="col-sm-2 control-label">Kredit</label>
			<div class="col-sm-10">
				<input type="text" name="jumDebit" class="form-control" value="<?=$this->m_jurnals->jumKredit();?>" disabled="">
				
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">Debit</label>
			<div class="col-sm-10">
				<input type="text" name="jumDebit" class="form-control" value="<?=$this->m_jurnals->jumDebit();?>" disabled="">
			</div>
		</div>

		<hr>
		<div class="form-group">
			<label class="col-sm-2 control-label">Jumlah</label>
			<label class="col-sm-10">
				<input type="text" name="jumTotal" class="form-control" value="<?=$this->m_jurnals->jumTotal();?>" disabled="">
			</label>
		</div>

	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Detail jurnal</h4>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

