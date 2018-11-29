<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>
	Data Jurnal
	<a class="btn btn-success btn-sm add" href="<?=site_url('jurnal/add')?>" title="Tambah Data Jurnal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a><a class="btn btn-success btn-sm add" href="<?=site_url('jurnal/print_data')?>" title="Cetak Data"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</a>
</h2>
<div class="table-responsive">
	<table id="tabel-data" class="display table table-bordered table-hover table-responsive">
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
		<tbody>
			<?php
			$i = 1;
			foreach($jurnal as $row){?>
				<tr>
					<td><?=$i++;?></td>
					<td><?=$row['jur_id'];?></td>
					<!-- <td><?//=rc4($row['jur_name']);?></td> -->
					<td><?=dekrip($row['jur_name']);?></td>
					<td><?=nominal($row['jur_kredit']);?></td>
					<td><?=nominal($row['jur_debit']);?></td>
					<td><?=$row['s_name'];?></td>
					<td><?=$row['a_name'];?></td>
					<td><?=shortdate_indo($row['jur_dot']);?></td>
					<td>
						<a class="btn btn-success btn-sm mb" href="<?=site_url('jurnal/detail/'.$row['jur_id'])?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
						<a class="btn btn-info btn-sm mb" href="<?=site_url('jurnal/edit/'.$row['jur_id'])?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
						<a class="btn btn-danger btn-sm mb" href="<?=site_url('jurnal/delete/'.$row['jur_id'])?>" title="Hapus"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
					</td>
				</tr>
			<?php } ?>
			
		</tbody>
		<!-- <tfoot>
			<tr>
				<td colspan="3">Sub Total</td>
				<td><?//=$this->m_jurnals->jumKredit()?></td>
				<td><?//=$this->m_jurnals->jumDebit()?></td>
				<td colspan="4"></td>
			</tr>
			<tr>
				<td colspan="3">Sisa Anggaran (Kredit-Debit)</td>
				<td colspan="2"><?//=$this->m_jurnals->jumTotal()?></td>
				<td colspan="3"></td>
			</tr>
		</tfoot> -->
	</table>

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

<script type="text/javascript">
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>

