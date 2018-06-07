@extends("layouts.frontend")
{{--@section("tittle")--}}
@section("content")
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Anasayfa</a></li>
            @foreach($categories as $category)
                <li><a href="{{route("frontend.category.index",["slug"=>$category->slug])}}">{{$category->name}}</a>
                </li>
            @endforeach
            <li class="active">Kategori</li>
        </ol>
        <div class="bg-content">
            <div class="row">
                <div class="col-md-5">
                    <img src="https://loremflickr.com/450/300/product?random={{rand(1,100)}}" alt="...">
                    <hr>
                    <div class="row">
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"> <img src="https://loremflickr.com/150/150/product?random={{rand(1,100)}}" alt="..."></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"><img src="https://loremflickr.com/150/150/product?random={{rand(1,100)}}" alt="..."></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"><img src="https://loremflickr.com/150/150/product?random={{rand(1,100)}}" alt="..."></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <h1>{{$product->tittle}}</h1>
                    <p class="price">{{$product->price}}</p>
                    <form action="javascript:void(0);">
                        <p>
                            <button type="btn" data-id="{{$product->id}}" id="addToBasket" class="btn btn-theme">Sepete
                                Ekle
                            </button>
                        </p>
                    </form>
                </div>
            </div>

            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#t1" data-toggle="tab">Ürün Açıklaması</a></li>
                    <li role="presentation"><a href="#t2" data-toggle="tab">Yorumlar</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="t1">{{$product->description}}</div>
                    <div role="tabpanel" class="tab-pane" id="t2">t2</div>
                </div>
            </div>

        </div>
    </div>

@endsection
@push("customJs")
    <script>
        $("#addToBasket").on("click", function () {
            var button = $(this);

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
                url: "{{route("frontend.basket.add")}}",
                data: {
                    _token: "{{csrf_token()}}",
                    id: button.data("id"),

                },
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

@endpush
@push("customCss")



@endpush

