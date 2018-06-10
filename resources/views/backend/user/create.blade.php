@extends("layouts.backend")
@section("content")

    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"><span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Site Ayarları</h5>
                </div>
                <div class="widget-content nopadding">
                    <form id="userForm" class="form-horizontal">

                        <div class="control-group">
                            <label class="control-label">Durum</label>
                            <div class="controls">
                                <select class="span11" name="active" >
                                    <option value="0">Passiv</option>
                                    <option value="1">Aktiv</option>

                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Ad Soyad </label>
                            <div class="controls">
                                <input type="text" name="name" class="span11"
                                       required/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">E-Mail Adresi</label>
                            <div class="controls">
                                <input type="email" name="email" class="span11"
                                       required/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Yetki</label>
                            <div class="controls">
                                <select class="span11" name="yetki" >
                                    <option value="0">Standart Kullanıcı</option>
                                    <option value="1">Satıcı</option>
                                    <option value=2>Admin</option>
                                </select>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label">Şifre</label>
                            <div class="controls">
                                <input type="password" name="password" class="span11"/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Şifre Tekrar</label>
                            <div class="controls">
                                <input type="password" name="password_confirmation" class="span11"/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Adres </label>
                            <div class="controls">
                                <input type="text" name="adress" class="span11"
                                       required/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Telefon </label>
                            <div class="controls">
                                <input type="text" name="phone" class="span11"
                                       required/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Mobil </label>
                            <div class="controls">
                                <input type="text" name="mobile" class="span11"
                                       required/>
                            </div>
                        </div>

                        <div class="form-actions text-right">
                            <button type="button" id="userCreate" class="btn btn-success">Kullanıcı Ekle</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
@endsection
@push("customJs")

    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
        });

        $("#userCreate").on("click", function () {

            var form = new FormData($("#userForm")[0]);

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
                url: "{{route("backend.user.store")}}",
                data: form,
                processData: false,
                contentType: false,
                success: function (response) {
                    swal.close();
                    swal({
                        type: response.status,
                        title: response.title,
                        text: response.message,
                        timer: 2000
                    });


                },
                error: function (response) {
                    swal.close();
                    console.log(response);
                    $.each(response.responseJSON.errors, function (k, v) {
                        $.each(v, function (kk, vv) {
                            $("[name='" + k + "']").parent().addClass("has-error");
                            $("[name='" + k + "']").parent().append(" <span class=\"label label-danger\">" + vv + "</span>");
                        })
                    });

                }
            })
        })

        /* Yüklenen resmi anlık olarak görmek için */
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#logoImageShow').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#logoImage").change(function () {
            readURL(this);
        });
        /* /Yüklenen resmi anlık olarak görmek için */
    </script>

@endpush
@push("customCss")



@endpush
