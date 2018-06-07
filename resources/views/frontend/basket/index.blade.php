@extends("layouts.frontend")
@section("tittle","Sepet")
@section("content")
    <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            @if(count(Cart::content())>0)
                <table class="table table-bordererd table-hover">
                    <tr>
                        <th colspan="2">Ürün</th>
                        <th>Adet Fiyat</th>
                        <th>Adet</th>
                        <th>Tutar</th>
                        <th>İşlem</th>

                    </tr>

                    @foreach(Cart::content() as $product)
                        <tr>
                            <td style="width: 120px">
                                <a href="{{route("frontend.product.index",["id"=>$product->id,'slug'=>$product->options->slug])}}">
                                    <img src="https://loremflickr.com/120/100/product?random={{rand(1,100)}}" alt="...">
                                </a>
                            </td>

                            <td>
                                <a href="{{route("frontend.product.index",["id"=>$product->id,'slug'=>$product->options->slug])}}">
                                    {{$product->name}}
                                </a>
                            </td>
                            <td>{{$product->price}}</td>
                            <td>
                                <a href="#" data-id="{{$product->rowId}}" data-qty="{{$product->qty-1}}"
                                   class="btn btn-xs btn-default productDecrease">-</a>
                                <span style="padding: 10px 20px">{{$product->qty}}</span>
                                <a href="#" data-id="{{$product->rowId}}" data-qty="{{$product->qty+1}}"
                                class="btn btn-xs btn-default productIncrease">+</a>
                            </td>
                            <td>{{$product->subtotal}}</td>
                            <td>
                                <form action="javascript:void(0);">
                                    <button class="btn btn-danger basketItemDelete" data-id="{{$product->rowId}}">
                                        Sil
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="4">Alt Toplam</th>
                        <th>{{Cart::subtotal()}}</th>
                    </tr>
                    <tr>
                        <th colspan="4">KDV</th>
                        <th>{{Cart::tax()}}</th>
                    </tr>
                    <tr>
                        <th colspan="4">Genel Toplam</th>
                        <th>{{Cart::total()}}</th>
                    </tr>
                </table>

                <div>
                    <form action="javascript:void(0);">
                        <button class="btn btn-info pull-left" id="basketDestroy">
                            Sepeti Boşalt
                        </button>
                    </form>

                    <a href="{{route("frontend.payment.index")}}" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
                </div>

            @else
                <p>Sepetinizde Ürün Yok</p>
            @endif
        </div>
    </div>

@endsection
@push("customJs")
    <script>

        $(".productIncrease, .productDecrease").on("click", function () {
            var button = $(this);
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
                url:"{{route("frontend.basket.qtyUpdate")}}",
                data: {
                    _token: "{{csrf_token()}}",
                    id: button.data("id"),
                    qty: button.data("qty"),
                },
                success: function (response) {
                    swal.close();

                    swal({
                        type: response.status,
                        title: response.title,
                        text: response.message,
                        timer: 2000
                    });
                    location.reload();
                },
                error: function (response) {
                    swal.close();
                }
            })
        })

        $(".basketItemDelete").on("click", function () {
            var button = $(this);

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
                url: "{{route("frontend.basket.delete")}}",
                data: {
                    _token: "{{csrf_token()}}",
                    id: button.data("id")
                },
                success: function (response) {
                    if (response.status == "success") {
                        button.closest("tr").remove();
                    }
                    swal.close();
                    swal({
                        type: response.status,
                        title: response.title,
                        text: response.message,
                        timer: 2000
                    });
                    location.reload();
                },
                error: function (response) {
                    swal.close();
                    console.log(response);
                }
            })
        })


        $("#basketDestroy").on("click", function () {

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
                url: "{{route("frontend.basket.destroy")}}",
                data: {
                    _token: "{{csrf_token()}}"

                },
                success: function (response) {

                    swal.close();
                    swal({
                        type: response.status,
                        title: response.title,
                        text: response.message,
                        timer: 2000
                    });
                    location.reload();
                },
                error: function (response) {
                    swal.close();
                    console.log(response);
                }
            })
        })
    </script>



@endpush
@push("customCss")



@endpush

