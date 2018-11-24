<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2><?=$form_title?></h2>
<hr>
<?=form_open($action, 'class="form-horizontal"')?>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Kode Unik</label>
        <input type="hidden" name='j_id' class="form-control" value="<?= $kodeunik; ?>" readonly>
        <div class="col-sm-3">
            <input type="text" name='j_id' class="form-control" value="<?= $kodeunik; ?>" readonly>
            <small class="text-danger"><?=form_error('j_id')?></small>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Nama Jenis Objek</label>
        <div class="col-sm-6">
            <input type="text" name="j_name" class="form-control" value="<?=(set_value('j_name')) ? set_value('j_name') : $jenis['j_name']?>" placeholder="Nama Jenis Objek" minlength="5" maxlength="50" required>
            <small class="text-danger"><?=form_error('j_name')?></small>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Jenis Transaksi</label>
        <div class="col-sm-3">
            <select name="j_transaksi" class="form-control" required>
                <option value="<?=isset($jenis['j_transaksi']) ? $jenis['j_transaksi'] : set_value('j_transaksi')?>"><?=isset($jenis['j_transaksi']) ? $jenis['j_transaksi'] : set_value('j_transaksi')?></option>
                <?php foreach (array_reverse($transaksi) as $row) {?>  
                    <option value="<?=$row['t_id']?>"><?=$row['t_name']?></option>
                <?php } ?>
            </select>
            <small class="text-danger"><?=form_error('j_transaksi')?></small>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="submit" class="btn btn-success">Simpan</button>&nbsp;
            <a class="btn btn-default" href="<?=site_url('jenis')?>">Kembali</a>
        </div>
    </div>
<?=form_close()?>
