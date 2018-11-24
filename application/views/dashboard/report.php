<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Rekap Keuangan</h2>
<hr>
<?=form_open('report', 'class="form-inline hp" id="report"')?>
	<div class="form-group">
		<select name="bulan" class="form-control" id="bulan">
			<option>-Pilih Bulan-</option>
			<?php 
			$bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"); 
			for($i=1; $i<=12; $i++){?>
				<option value="<?=$i;?>"><?=$bulan[$i]?></option>
			<?php } ?>
		</select>

		<select name="tahun" class="form-control" id="tahun">
			<option>-Pilih Tahun-</option>
			<?php
			$now=date('Y');
			for($x=$now-3; $x<=$now; $x++){ ?>
				<option value="<?=$x?>"><?=$x?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary hp" name="tampilkan" id="tampilkan"><span id="tampil">Tampilkan</span></button>
		</div>
	</div>
<?=form_close()?>
<div id="result"></div>
