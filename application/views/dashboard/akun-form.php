<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2><?=$form_title?></h2>
<hr>
<?=form_open($action, 'class="form-horizontal"')?>

<div class="form-group">
	<label class="col-sm-2 control-label">Kode Unik</label>
	<div class="col-sm-3">
		<input type="text" name='a_id' class="form-control" value="<?= $kodeunik; ?>" readonly>
		<small class="text-danger"><?=form_error('a_id')?></small>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Nama Akun Objek</label>
	<div class="col-sm-6">
		<input type="text" name="a_name" class="form-control" value="<?=(set_value('a_name')) ? set_value('a_name') : $akun['a_name']?>" placeholder="Nama akun Objek" minlength="5" maxlength="50" required>
		<small class="text-danger"><?=form_error('a_name')?></small>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Jenis Akun</label>
	<div class="col-sm-3">
		<select name="a_jid" class="form-control" required>
			<option value="<?=isset($akun['a_jid']) ? $akun['a_jid'] : set_value('a_jid')?>"><?=isset($akun['a_name']) ? $akun['a_name'] : set_value('a_jid')?></option>
			<?php foreach (array_reverse($jenis) as $row) {?>  
				<option value="<?=$row['j_id']?>"><?=$row['j_name']?></option>
			<?php } ?>
		</select>
		<small class="text-danger"><?=form_error('a_jid')?></small>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<button type="submit" name="submit" class="btn btn-success">Simpan</button>&nbsp;
		<a class="btn btn-default" href="<?=site_url('akun')?>">Kembali</a>
	</div>
</div>
<?=form_close()?>
