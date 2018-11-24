<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h3>
	<?=$form_title;?>
	<a class="btn btn-success btn-sm add" href="<?=site_url('akun')?>" title="Kembali"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Kembali</a>
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
				foreach ($get_akun as $row) { ?>
					<tr>
						<td><?=++$i?></td>
						<td><?=$row['a_name'].'<br>('.$row['a_id'].')'?></td>
						<td><a class="btn btn-info btn-sm mb" href="<?=site_url("akun/detail/".$row['a_id'])?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Lihat Detail</a></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="col-md-7">
		<table class="table table-striped table-hover table-responsive">
			<thead>
				<tr>
					<td colspan="3" align="center">Detail Akun <?=$akun['a_name']?></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>No. Regristrasi</td>
					<td>:</td>
					<td><?=$akun['a_id']?></td>
				</tr>
				<tr>
					<td>Nama Akun</td>
					<td>:</td>
					<td><?=$akun['a_name']?></td>
				</tr>
				<tr>
					<td>Golongan Jenis</td>
					<td>:</td>
					<td><?=$akun['j_name']?></td>
				</tr>
				<tr>
					<td>Dibuat Oleh</td>
					<td>:</td>
					<td><?=$akun['u_fname']?></td>
				</tr>
				<tr>
					<td>Dibuat Pada</td>
					<td>:</td>
					<td><?=longdate_indo($akun['a_created_at'])?></td>
				</tr>
				<tr>
					<td>Telah Diperbarui pada</td>
					<td>:</td>
					<td><?=longdate_indo($akun['a_updated_at'])?></td>
				</tr>
				<tr>
					<td>Riwayat Dihapus</td>
					<td>:</td>
					<td><?=longdate_indo($akun['a_deleted_at'])?></td>
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