<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<footer class="footer">
	<div class="container">
		<p><a href="#">ALFATH MEDIA V1.0 &copy;2018</a> &minus; Dikembangkan oleh <a href="#" id="#modal-login">polimerilize</a></p>
	</div>
	
</footer>
<script src="<?=base_url('assets/js/jquery.min.js?ver=3.2.0')?>"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js?ver=3.3.7')?>"></script>
<script src="<?=base_url('assets/js/jquery.dataTables.min.js?ver=1.10.13')?>"></script>
<script src="<?=base_url('assets/js/dataTables.bootstrap.min.js?ver=1.10.13')?>"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#tabel-data').DataTable();
	});
</script>

<!-- setting js login -->
<script type="text/javascript">
	$(document).ready(function() {
		
		// Notification alert
		$("#notif").delay(350).slideDown('slow');
		$("#notif").alert().delay(3000).slideUp('slow');

		// Live search
		$("#search").keyup(function() {
			var str =  $("#search").val();
			if (str == "") {
				$("#hint" ).html("<p class='help-block'>Masukkan No. Regristrasi / Nama Transaksi / Tanggal Transaksi dan hasil akan otomatis ditampilkan disini. <br><small>Contoh format tanggal 1998-11-20.</small></p>");
			} else {
				$.get("<?=site_url()?>home/result?keyword="+str, function(data) {
					$("#hint").html(data);
				});
			}
		});

		// Report
		$("#tampilkan").click(function() {
			var action = $("#report").attr('action');
			var report = {
				bulan: $("#bulan").val(),
				tahun: $("#tahun").val(),
			};

			$.ajax({
				type: "GET",
				url: action,
				data: report,
				beforeSend: function() {
					$('#tampil').html('Sedang memuat.....');
					$('.btn').addClass('disabled');
				},
				success: function(result) {
					$("#result").html(result);
					$('#tampil').html('Tampilkan');
					$('.btn').removeClass('disabled');
				}
			});
			return false;
		});

		// Is data complete
		$('select#a_jid').change(function() {
			if ($(this).val() != '') {
				$('.hint').hide('slow');
				$('#submit').removeClass('hide');
			} else {
				$('.hint').show('slow');
				$('#submit').addClass('hide');
			}
		});

		// Show hide password
		$('#pass').on('click', function() {
			if ($('#password').attr('pass-shown') == 'false') {
				$('#password').removeAttr('type');
				$('#password').attr('type', 'text');
				$('#password').removeAttr('pass-shown');
				$('#password').attr('pass-shown', 'true');
				$('#pass').html('<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>');
			} else {
				$('#password').removeAttr('type');
				$('#password').attr('type', 'password');
				$('#password').removeAttr('pass-shown');
				$('#password').attr('pass-shown', 'false');
				$('#pass').html('<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>');
			}
		});

		// Ajax login
		$("#btn-login").click(function() {
			var formAction = $("#login").attr('action');
			var datalogin = {
				u_name: $("#username").val(),
				u_pass: $("#password").val(),
				csrf_token: $.cookie('csrf_cookie')
			};

			$.ajax({
				type: "POST",
				url: formAction,
				data: datalogin,
				beforeSend: function() {
					$('#status').html('Sedang memproses.....');
					$('.btn-block').addClass('disabled');
				},
				success: function(data) {
					if (data == 1) {
						$("#success").slideDown('slow');
						$("#success").alert().delay(6000).slideUp('slow');
						setTimeout(function() {
							window.location = '<?=site_url('dashboard')?>';
						}, 2000);
					} else {
						$('#status').html('Login');
						$('.btn-block').removeClass('disabled');
						$("#failed").slideDown('slow');
						$("#failed").alert().delay(3000).slideUp('slow');
						return false;
					}
				}
			});
			return false;
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function () {
		$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings)
		{
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};

		

		// view data jenis
		var jenis = $('#jenis').DataTable({
			"processing": true,
			"language": {
				"processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
			},
			"serverSide": true,
			"ajax": "<?=site_url('jenis/get_data')?>",
			"columns": [
				{
					"data": null,
					"orderable": true
				},
				{"data": "j_id"},
				{"data": "j_name"},
				{"data": "t_name"},
				{"data": "j_created_at"},
				{"data": "j_updated_at"},
				{"data": "tindakan"}
			],
			"order": [[1, 'desc']],
			"rowCallback": function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});

		// View data jenia_deleted
		var jenis_deleted = $('#jenis-deleted').DataTable({
			"processing": true,
			"language": {
				"processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
			},
			"serverSide": true,
			"ajax": "<?=site_url('jenis/get_deleted')?>",
			"columns": [
				{
					"data": null,
					"orderable": true
				},
				{"data": "j_id"},
				{"data": "j_name"},
				{"data": "j_created_at"},
				{"data": "j_deleted_at"},
				{"data": "tindakan"}
			],
			"order": [[1, 'asc']],
			"rowCallback": function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});

		// view data akun
		var akun = $('#akun').DataTable({
			"processing": true,
			"language": {
				"processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
			},
			"serverSide": true,
			"ajax": "<?=site_url('akun/get_data')?>",
			"columns": [
				{
					"data": null,
					"orderable": true
				},
				{"data": "a_id"},
				{"data": "a_name"},
				{"data": "j_name"},
				{"data": "t_name"},
				{"data": "a_created_at"},
				{"data": "a_updated_at"},
				{"data": "tindakan"}
			],
			"order": [[1, 'desc']],
			"rowCallback": function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});

		// View data akun_deleted
		var akun_deleted = $('#akun-deleted').DataTable({
			"processing": true,
			"language": {
				"processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
			},
			"serverSide": true,
			"ajax": "<?=site_url('akun/get_deleted')?>",
			"columns": [
				{
					"data": null,
					"orderable": true
				},
				{"data": "a_fid"},
				{"data": "a_name"},
				{"data": "a_created_at"},
				{"data": "a_deleted_at"},
				{"data": "tindakan"}
			],
			"order": [[1, 'asc']],
			"rowCallback": function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});

		// view data jurnal
		var jurnal = $('#jurnal').DataTable({
			"processing": true,
			"language": {
				"processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
			},
			"serverSide": true,
			"ajax": "<?=site_url('jurnal/get_data')?>",
			"columns": [
				{
					"data": null,
					"orderable": true
				},
				{"data": "jur_id", render: $.fn.dataTable.render.rc5('jur_id')},
				{"data": "jur_name"},
				{"data": "jur_kredit", render: $.fn.dataTable.render.number( '.', ',', 2,'Rp' )},
				{"data": "jur_debit", render: $.fn.dataTable.render.number( '.', ',', 2,'Rp' )},
				{"data": "jur_sisa"},
				{"data": "a_name"},
				{"data": "jur_dot", 
					render: function ( data, type, row ) {
						// If display or filter data is requested, format the date
						if ( type === 'display' || type === 'filter' ) {
							var d = new Date(data);
							return d.getDate() +'-'+ (d.getMonth()+1) +'-'+ d.getFullYear();
						}
						return data;
					}
				},
				{"data": "tindakan"}

			],
		
			"order": [[1, 'desc']],
			"rowCallback": function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});

		// view data jurnal
		var jurnal_detail = $('#jurnal-detail').DataTable({
			"processing": true,
			"language": {
				"processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
			},
			"serverSide": true,
			"ajax": "<?=site_url('jurnal/detail')?>",
			"columns": [
				{
					"data": null,
					"orderable": true
				},
				{"data": "jur_id"},
				{"data": "tindakan"}

			],
		
			"order": [[1, 'desc']],
			"rowCallback": function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});

		// View data jurnal_deleted
		var jurnal_deleted = $('#jurnal-deleted').DataTable({
			"processing": true,
			"language": {
				"processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
			},
			"serverSide": true,
			"ajax": "<?=site_url('jurnal/get_deleted')?>",
			"columns": [
				{
					"data": null,
					"orderable": true
				},
				{"data": "jur_id"},
				{"data": "jur_name"},
				{"data": "jur_dot"},
				{"data": "jur_deleted_at"},
				{"data": "tindakan"}
			],
			"order": [[1, 'asc']],
			"rowCallback": function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});

		// View data user
		var user = $('#user').DataTable({
			"processing": true,
			"language": {
				"processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
			},
			"serverSide": true,
			"ajax": "<?=site_url('user/get_data')?>",
			"columns": [
				{
					"data": null,
					"orderable": true
				},
				{"data": "u_fname"},
				{"data": "u_level"},
				{"data": "u_name"},
				{"data": "u_fpass"},
				{"data": "u_is_active"},
				{"data": "u_last_logged_in"},
				{"data": "tindakan"}
			],
			"order": [[1, 'asc']],
			"rowCallback": function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});

		// View data student_deleted
		var student_deleted = $('#student-deleted').DataTable({
			"processing": true,
			"language": {
				"processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
			},
			"serverSide": true,
			"ajax": "<?=site_url('student/get_deleted')?>",
			"columns": [
				{
					"data": null,
					"orderable": true
				},
				{"data": "a_nisn"},
				{"data": "a_name"},
				{"data": "a_dob"},
				{"data": "a_gender"},
				{"data": "a_grade"},
				{"data": "m_id"},
				{"data": "a_deleted_at"},
				{"data": "tindakan"}
			],
			"order": [[1, 'asc']],
			"rowCallback": function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});

		// View data student_archived
		var student_archived = $('#student-archived').DataTable({
			"processing": true,
			"language": {
				"processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
			},
			"serverSide": true,
			"ajax": "<?=site_url('student/get_archived')?>",
			"columns": [
				{
					"data": null,
					"orderable": true
				},
				{"data": "a_nisn"},
				{"data": "a_name"},
				{"data": "a_gender"},
				{"data": "a_grade"},
				{"data": "m_id"},
				{"data": "a_yi"},
				{"data": "a_yo"},
				{"data": "a_ia_active"},
				{"data": "tindakan"}
			],
			"order": [[1, 'asc']],
			"rowCallback": function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});

		// View data sof
		var sof = $('#sof').DataTable({
			"processing": true,
			"language": {
				"processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
			},
			"serverSide": true,
			"ajax": "<?=site_url('sof/get_data')?>",
			"columns": [
				{
					"data": null,
					"orderable": true
				},
				{"data": "s_id"},
				{"data": "s_name"},
				{"data": "s_inisial"},
				{"data": "s_created_at"},
				{"data": "s_updated_at"},
				{"data": "tindakan"}
			],
			"order": [[1, 'desc']],
			"rowCallback": function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});

		// View data sof_deleted
		var sof_deleted = $('#sof-deleted').DataTable({
			"processing": true,
			"language": {
				"processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
			},
			"serverSide": true,
			"ajax": "<?=site_url('sof/get_deleted')?>",
			"columns": [
				{
					"data": null,
					"orderable": true
				},
				{"data": "s_id"},
				{"data": "s_name"},
				{"data": "s_inisial"},
				{"data": "s_created_at"},
				{"data": "s_deleted_at"},
				{"data": "tindakan"}
			],
			"order": [[1, 'asc']],
			"rowCallback": function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});
	});
</script>