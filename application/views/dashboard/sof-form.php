<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2><?=$form_title?></h2>
<hr>
<?=form_open($action, 'class="form-horizontal"')?>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Kode Unik</label>
        <div class="col-sm-3">
            <input type="text" name="s_id" class="form-control" value="<?= $kodeunik; ?>" readonly>
            <small class="text-danger"><?=form_error('s_id')?></small>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Nama Sumber Dana</label>
        <div class="col-sm-6">
            <input type="text" name="s_name" class="form-control" value="<?=(set_value('s_name')) ? set_value('s_name') : $sof['s_name']?>" placeholder="Nama Sumber Dana" minlength="5" maxlength="50" required>
            <small class="text-danger"><?=form_error('s_name')?></small>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Inisial Sumber Dana</label>
        <div class="col-sm-3">
            <input type="text" name="s_inisial" class="form-control" value="<?=(set_value('s_inisial')) ? set_value('s_inisial') : $sof['s_inisial']?>" placeholder="Inisial Sumber Dana" maxlength="5" required>
            <small class="text-danger"><?=form_error('s_inisial')?></small>
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="submit" class="btn btn-success">Simpan</button>&nbsp;
            <a class="btn btn-default" href="<?=site_url('sof')?>">Kembali</a>
        </div>
    </div>
<?=form_close()?>
