@extends("layouts.backend")
@section("content")

    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"><span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Ürün Düzenle : {{$product->tittle}}</h5>
                </div>
                <div class="widget-content nopadding">
                    <form id="productForm" class="form-horizontal">


                        <div class="control-group">
                            <label class="control-label">Ürün Adı </label>
                            <div class="controls">
                                <input type="text" name="tittle" value="{{$product->tittle}}" class="span11"
                                       required/>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label">Slug</label>
                            <div class="controls">
                                <input type="text" value="{{$product->slug}}" name="slug" class="span11"/>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label">Ürün Fiyat </label>
                            <div class="controls">
                                <input type="text" value="{{$product->price}}" name="price" class="span11"
                                       required/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Göster</label>
                            <div class="controls ">

                                <div>
                                    <input type="hidden" value="0" name="slider">
                                    <input value="1" type="checkbox" @if($product->detail->slider==1) checked
                                           @endif value="{{$product->detail->slider}}" name="slider"/> Slider
                                </div>
                                <div>
                                    <input type="hidden" value="0" name="gunun_firsati">
                                    <input value="1" type="checkbox" @if($product->detail->gunun_firsati==1) checked
                                           @endif  name="gunun_firsati"/> Günün Fırsatı
                                </div>
                                <div>
                                    <input type="hidden" value="0" name="one_cikan">
                                    <input value="1" type="checkbox" @if($product->detail->one_cikan==1) checked
                                           @endif  name="one_cikan"/> One Çıkan
                                </div>
                                <div>
                                    <input type="hidden" value="0" name="cok_satan">
                                    <input value="1" type="checkbox" @if($product->detail->cok_satan==1) checked
                                           @endif  name="cok_satan"/> Çok Satan
                                </div>
                                <div>
                                    <input type="hidden" value="0" name="indirimli">
                                    <input value="1" type="checkbox" @if($product->detail->indirimli==1) checked
                                           @endif  name="indirimli"/> İndirimli
                                </div>


                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Kategori</label>
                            <div class="controls">
                                <select class="span11" name="category[]" id="category" multiple>

                                    @foreach($categories as $category)
                                        <option
                                            {{collect($category_product)->contains($category->id)?'selected' : ''}}
                                            value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Yazı İçeriği</label>
                            <div class="controls">
                                <textarea name="description" id="editor" cols="30" class="span11"
                                          rows="10">{{$product->description}}</textarea>

                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Resim</label>
                            <div class="controls">
                                <input id="logoImage" name="product_img" type="file" class="span3"/>
                                <img style="max-height: 100px; " id="logoImageShow" src=""
                                     alt="">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"></label>
                            <div class="controls">
                                <img style="max-height: 200px;" src="{{asset($product->detail->product_img)}}"
                                     alt="">
                            </div>
                        </div>


                        <div class="form-actions text-right">
                            <button type="button" id="productUpdate" class="btn btn-success">Ürün Güncelle</button>
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

        $("#productUpdate").on("click", function () {

            var form = new FormData($("#productForm")[0]);

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
                url: "{{route("backend.product.update",["id"=>$product->id])}}",
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



    <!-- Include external JS libs. -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>

    <!-- Include Editor JS files. -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/js/froala_editor.pkgd.min.js"></script>

    <!-- Initialize the editor. -->
    <script> $(function () {
            $('textarea').froalaEditor()
        }); </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $(function () {
            $("#category").select2({
                placeholder: "Lütfen Bir kategori seçin"
            });
        });
    </script>
@endpush
@push("customCss")
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>


    <!-- Include external CSS. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/css/froala_editor.pkgd.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/css/froala_style.min.css" rel="stylesheet"
          type="text/css"/>

@endpush
