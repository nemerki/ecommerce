@extends("layouts.backend")
@section("content")

    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"><span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Çategori Düzenleme</h5>
                </div>
                <div class="widget-content nopadding">
                    <form id="categoryForm" class="form-horizontal">


                        <div class="control-group">
                            <label class="control-label">Kategori Adı </label>
                            <div class="controls">
                                <input type="text" name="name" class="span11"
                                       required/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Türü</label>
                            <div class="controls">
                                <select class="span11" name="ust_id">
                                    <option value="">Ana Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>




                        <div class="form-actions text-right">
                            <button type="button" id="categoryCreate" class="btn btn-success">Kategori Ekle</button>
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

        $("#categoryCreate").on("click", function () {

            var form = new FormData($("#categoryForm")[0]);

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
                url: "{{route("backend.category.store")}}",
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
