<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Tambah Akun User</h2>
<hr>
<?=form_open('user/add', 'class="form-horizontal"')?>
	<div class="form-group">
		<label class="col-sm-2 control-label">Username</label>
		<div class="col-sm-4">
			<input type="text" name="u_name" class="form-control" value="<?=set_value('u_name')?>" placeholder="Username" minlength="5" maxlength="20" title="masukkan username anda" required>
			<small class="text-danger"><?=form_error('u_name')?></small>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label">Password</label>
		<div class="col-sm-4">
			<div class="input-group">
				<input type="password" name="u_pass" class="form-control" id="password" value="<?=set_value('u_pass')?>" placeholder="Password" minlength="5" pass-shown="false" title="Masukkan Password Anda" required>
				<span class="input-group-btn">
					<button class="btn btn-default sh" id="pass" type="button">
						<span id="show_pass">
							<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
						</span>
					</button>
				</span>
			</div>
			<small class="text-danger"><?=form_error('u_pass')?></small>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label">Nama Lengkap</label>
		<div class="col-sm-5">
			<input type="nama" name="u_fname" class="form-control" value="<?=set_value('u_fname')?>" placeholder="Nama Lengkap" minlength="3" maxlength="50" title="Masukkan Nama Lengkap Anda" required>
			<small class="text-danger"><?=form_error('u_fname')?></small>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Level</label>
		<div class="col-sm-3">
			<select class="form-control" name="u_level" placeholder="Level User" required>
				<?php
				if ($isset['users'] == NULL) { ?>
					<option value="">
						-Pilih Level-
					</option>
					<?php foreach(array_reverse($level) as $row) { ?>
						<option value="<?=$row?>"><?=$row?></option>
					<?php } ?>
				<?php }else{ ?>
					<option value="<?=isset($users['u_level']) ? $users['u_level'] : set_value('u_level')?>">
						<?=isset($users['u_level']) ? $users['u_level'] : set_value('u_level')?>
					</option>
				<?php }?>
			</select>
			<small class="text-danger"><?=form_error('u_level')?></small>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Status</label>
		<div class="col-sm-3">
			<select class="form-control" name="u_is_active">
				<option value="Aktif">Aktif</option>
				<option value="Tidak Aktif">Tidak Aktif</option>
			</select>
			<small class="text-danger"><?=form_error('u_is_active')?></small>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>&nbsp;
			<a class="btn btn-default" href="<?=site_url('user')?>">Kembali</a>
		</div>
	</div>
<?=form_close()?>
