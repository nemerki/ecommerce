<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>E-Ticaret Projesi - Yönetim Paneli</title>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="{{asset("assets/backend/css/login.css")}}">
</head>

<body>
<div class="container">
    <form class="form-signin" >
        <img src="{{asset("assets/backend/img/logo.png")}}" class="logo">

        <div class="control-group">
            <label for="email" class="sr-only">Email adresi</label>
            <div class="controls">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
            </div>
        </div>
        <div class="control-group">
            <label for="password" class="sr-only">Şifre</label>
            <div class="controls">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required aut>
            </div>
        </div>
        {{--
        <label for="email" class="sr-only">Email adresi</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
        <label for="password" class="sr-only">Şifre</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required aut>--}}
        <div class="checkbox">
            <label>
                <input type="checkbox" name="rememberme" value="1" checked>Beni Hatırla
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" id="loginBtn" type="button">Giriş</button>
        <div class="links">
            <a href="{{route("frontend.home.index")}}">&larr; Siteye Dön</a>
        </div>
    </form>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src="https://unpkg.com/sweetalert2@7.21.0/dist/sweetalert2.all.js"></script>
<script>

    $("#loginBtn").on("click", function () {


        $(".has-error").removeClass("has-error");
        $(".label-danger").remove();

        swal({
            title: 'Yükleniyor...',
            html:
            '<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>' +
            ' <span class="sr-only">Loading...</span>',
            showCloseButton: false,
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false
        });

        $.ajax({
            type: "post",
            url: "{{route("backend.auth.signin")}}",
            data: {
                _token: "{{csrf_token()}}",
                email: $("[name=email]").val(),
                password: $("[name=password]").val(),
                rememberme: $("[name=rememberme]").val(),

            },
            success: function (response) {
                swal.close();
                window.location.href = response;


            },
            error: function (response) {
                swal.close();

                $.each(response.responseJSON.errors, function (k, v) {
                    $.each(v, function (kk, vv) {
                        $("[name='" + k + "']").parent().addClass("has-error");
                        $("[name='" + k + "']").parent().append(" <span class=\"label label-danger\">" + vv + "</span>");
                    })
                });

            }
        })
    })



</script>
</body>

</html>
