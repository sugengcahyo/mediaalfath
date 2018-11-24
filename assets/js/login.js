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
            a_grade: $("#a_grade").val(),
            m_id: $("#m_id").val(),
            a_status: $("#a_status").val()
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
            // failed: function(result){
            //     $("#result").html(result);
            //     $('#tampil').html('Tampilkan..');
            //     $('.btn').removeClass('enal');
            // }
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