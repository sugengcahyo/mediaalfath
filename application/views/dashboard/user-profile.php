<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Edit Profile <?=$this->session->userdata['u_fname']?></h2>
<hr>
<?=$this->session->flashdata('logout')?>
<?=form_open('user/profile', 'class="form-horizontal"');
echo form_hidden('u_id', $this->session->userdata['u_id']);?>
<div class="form-group">
	<label class="col-sm-2 control-label">Username</label>
	<div class="col-sm-4">
		<input class="form-control" type="text" name="u_name" value="<?=$this->session->userdata['u_name']?>" placeholder="Username" minlenght="5" maxlenght="20" title="Username tidak boleh diedit" required disabled></input>
		<small class="text-danger"><?=form_error('u_name')?></small>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Password Baru</label>
	<div class="col-sm-4">
		<input type="password" name="u_pass" class="form-control" placeholder="Password Baru" minlength="5" required>
		<?php if(!empty($user['u_password_updated_at'])){?>
			<small class="help-block">Password diperbarui terakhir pada <?=$user['u_password_updated_at']?></small>
		<?php } ?>
		<small class="text-danger"><?=form_error('u_pass')?></small>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Konfirmasi Password</label>
	<div class="col-sm-4">
		<input type="password" name="u_passconf" class="form-control" placeholder="Konfirmasi Password" minlength="5" required>
		<small class="text-danger"><?=form_error('u_passconf')?></small>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Nama Lengkap</label>
	<div class="col-sm-4">
		<input type="text" name="u_fname" class="form-control" value="<?=$this->session->userdata['u_fname']?>" placeholder="Nama Lengkap" minlength="3" maxlength="50" required>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<small class="help-block">Silahkan memperbarui password, Anda akan diminta melakukan login ulang.</small>
		<button type="submit" name="submit" class="btn btn-success">Simpan</button>
	</div>
</div>
<?=form_close()?>