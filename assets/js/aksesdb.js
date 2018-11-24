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

        // View data major
        var major = $('#major').DataTable({
            "processing": true,
            "language": {
                "processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('major/get_data')?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "m_kode"},
                {"data": "m_name"},
                {"data": "m_inisial"},
                {"data": "m_created_at"},
                {"data": "m_updated_at"},
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
                {"data": "j_fid"},
                {"data": "j_name"},
                {"data": "t_name"},
                {"data": "j_created_at"},
                {"data": "j_updated_at"},
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
                {"data": "j_fid"},
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
                {"data": "a_fid"},
                {"data": "a_name"},
                {"data": "j_name"},
                {"data": "a_created_at"},
                {"data": "a_updated_at"},
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
                {"data": "jur_id"},
                {"data": "jur_name"},
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
                {"data": "a_name"},
                {"data": "jur_debit", render: $.fn.dataTable.render.number( '.', ',', 2,'Rp' )},
                {"data": "a_name"},
                {"data": "jur_kredit", render: $.fn.dataTable.render.number( '.', ',', 2,'Rp' )},
                {"data": "jur_sisa", render: $.fn.dataTable.render.number( '.', ',', 2,'Rp' )},
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
                {"data": "u_name"},
                {"data": "u_fname"},
                {"data": "u_level"},
                {"data": "u_ia_active"},
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

        // View data major_deleted
        var major_deleted = $('#major-deleted').DataTable({
            "processing": true,
            "language": {
                "processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('major/get_deleted')?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "m_kode"},
                {"data": "m_name"},
                {"data": "m_inisial"},
                {"data": "m_created_at"},
                {"data": "m_deleted_at"},
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