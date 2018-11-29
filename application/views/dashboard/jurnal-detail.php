<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h3>
	<?=$form_title;?>
	<a class="btn btn-success btn-sm add" href="<?=site_url('jurnal')?>" title="Kembali"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Kembali</a>
</h3>

<div class="row">
	<div class="col-sm-5">
		<table id="tabel-data" class="display table table-striped table-hover table-responsive">
			<thead>
				<tr>
					<th width="5%">No.</th>
					<th>No. Reg.</th>
					<th width="20%">Tindakan</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0;
				foreach ($get_jurnal as $row) { ?>
					<tr>
						<td><?=++$i?></td>
						<td><?=dekrip($row['jur_name']).'<br>('.$row['jur_id'].')'?></td>
						<td><a class="btn btn-info btn-sm mb" href="<?=site_url("jurnal/detail/".$row['jur_id'])?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Lihat Detail</a></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="col-md-7">
		<table class="table table-striped table-hover table-responsive">
			<thead>
				<tr>
					<td colspan="3" align="center">Detail Jurnal <?=$jurnal['jur_name']?></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>No. Regristrasi</td>
					<td>:</td>
					<td><?=$jurnal['jur_id']?></td>
				</tr>
				<tr>
					<td>Nama Jurnal</td>
					<td>:</td>
					<td><?=dekrip($jurnal['jur_name'])?></td>
				</tr>
				<tr>
					<td>Tanggal Transaksi</td>
					<td>:</td>
					<td><?=longdaydate_indo($jurnal['jur_dot'])?></td>
				</tr>
				<tr>
					<td>Nominal Kredit</td>
					<td>:</td>
					<td><?=nominal($jurnal['jur_kredit'])?></td>
				</tr>
				<tr>
					<td>Nominal Debit</td>
					<td>:</td>
					<td><?=nominal($jurnal['jur_debit'])?></td>
				</tr>
				<tr>
					<td>Dibuat Oleh</td>
					<td>:</td>
					<td><?=$jurnal['u_fname']?></td>
				</tr>
				<tr>
					<td>Dibuat Pada</td>
					<td>:</td>
					<td><?=longdate_indo($jurnal['jur_created_at'])?></td>
				</tr>
				<tr>
					<td>Telah Diperbarui pada</td>
					<td>:</td>
					<td><?=longdate_indo($jurnal['jur_updated_at'])?></td>
				</tr>
				<tr>
					<td>Riwayat Dihapus</td>
					<td>:</td>
					<td><?=longdate_indo($jurnal['jur_deleted_at'])?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>