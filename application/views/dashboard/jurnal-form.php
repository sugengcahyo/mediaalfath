<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2><?=$form_title?></h2>
<hr>
<?=form_open($action, 'class="form-horizontal"')?>
	<div class="form-group">
		<label class="col-sm-2 control-label">No. Regristrasi</label>
		<div class="col-sm-4">
			<input type="text" name="jur_id" class="form-control" value="<?= $kodeunik; ?>" placeholder="Nominal" required readonly>
			<small class="text-danger"><?=form_error('jur_id')?></small>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label">Nama Transaksi</label>
		<div class="col-sm-6">
			<input type="text" name="jur_name" class="form-control" value="<?=isset($jurnal['jur_name']) ? $jurnal['jur_name'] : set_value('jur_name')?>" placeholder="Nama" required>
			<small class="text-danger"><?=form_error('jur_name')?></small>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label">Tanggal Transaksi</label>
		<div class="col-sm-3">
			<input type="date" name="jur_dot" class="form-control" value="<?=isset($jurnal['jur_dot']) ? $jurnal['jur_dot'] : set_value('jur_dot')?>" placeholder="Tanggal Transaksi" required>
			<small class="text-danger"><?=form_error('jur_dot')?></small>
		</div>
	</div>

	<hr>
	<h3>Detail Transaksi</h3>
	<div class="form-group">
		<label class="col-sm-2 control-label">Nominal</label>
		<div class="col-sm-4">
			<input type="number" name="jur_nominal" class="form-control" value="<?=isset($jurnal['jur_nominal']) ? $jurnal['jur_nominal'] : set_value('jur_nominal')?>" placeholder="Nominal Transaksi" required>
			<small class="text-danger"><?=form_error('jur_nominal')?></small>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label">Jenis Transaksi</label>
		<div class="col-sm-3">
			<select name="jur_transaksi" class="form-control" required>
				<option value="<?=isset($jurnal['jur_transaksi']) ? $jurnal['jur_transaksi'] : set_value('jur_transaksi')?>"><?=isset($jurnal['t_id']) ? $jurnal['t_name'] : set_value('jur_transaksi')?></option>
				<?php foreach (array_reverse($transaksi) as $row) {     ?>
					<option value="<?=$row['t_id']?>"><?=$row['t_name']?></option>
				<?php } ?>
			</select>
			<small class="text-danger"><?=form_error('jur_akun')?></small>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label">Jenis Akun</label>
		<div class="col-sm-4">
			<select name="jur_akun" class="form-control" required>
				<option value="<?=isset($jurnal['jur_akun']) ? $jurnal['jur_akun'] : set_value('jur_akun')?>"><?=isset($jurnal['a_name']) ? $jurnal['a_name'] : set_value('jur_akun')?></option>
				<?php foreach (array_reverse($akun) as $row) {     ?>
					<option value="<?=$row['a_id']?>"><?=$row['a_name']."(".$row['a_jid'].")"?></option>
				<?php } ?>
			</select>
			<small class="text-danger"><?=form_error('jur_akun')?></small>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label">Sumber Dana</label>
		<div class="col-sm-4">
			<select name="jur_sof" class="form-control" required>
				<option value="<?=isset($jurnal['jur_sof']) ? $jurnal['jur_sof'] : set_value('jur_sof')?>"><?=isset($jurnal['s_name']) ? $jurnal['s_name'] : set_value('jur_sof')?></option>
				<?php foreach (array_reverse($sof) as $row) {     ?>
					<option value="<?=$row['s_id']?>"><?=$row['s_name']."(".$row['s_id'].")"?></option>
				<?php } ?>
			</select>
			<small class="text-danger"><?=form_error('jur_sof')?></small>
		</div>
	</div>

	<hr>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-success" id="submit">Simpan</button>&nbsp;
			<a class="btn btn-default" href="<?=site_url('jurnal')?>">Kembali</a>
		</div>
	</div>
<?=form_close()?>
