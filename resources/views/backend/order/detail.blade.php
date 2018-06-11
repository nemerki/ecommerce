@extends("layouts.backend")
@section("content")

    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"><span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Sipariş Detay</h5>
                </div>
                <div class="widget-content nopadding">
                    <form id="orderForm" class="form-horizontal">


                        <div class="control-group">
                            <label class="control-label">Ad Soyad</label>
                            <div class="controls">
                                <input disabled="" type="text" value="{{$order->name}}" name="name" class="span11"
                                       required/>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label">Telefon</label>
                            <div class="controls">
                                <input disabled="" type="text" value="{{$order->phone}}" name="name" class="span11"
                                       required/>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label">Cep Telefonu</label>
                            <div class="controls">
                                <input disabled="" type="text" value="{{$order->mobile}}" name="name" class="span11"
                                       required/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Adres</label>
                            <div class="controls">
                                <input disabled="" type="text" value="{{$order->adress}}" name="name" class="span11"
                                       required/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Durum</label>
                            <div class="controls">
                                <select class="span11" name="status">


                                    <option
                                        {{$order->status =='Odeme Onaylandı'?'selected':''}} value="Odeme Onaylandı">
                                        Odeme Onaylandı
                                    </option>
                                    <option
                                        {{$order->status =='Kargoya Verildi'?'selected':''}} value="Kargoya Verildi">
                                        Kargoya Verildi
                                    </option>
                                    <option
                                        {{$order->status =='Sipariş Tamamlandı'?'selected':''}} value="Sipariş Tamamlandı">
                                        Sipariş Tamamlandı
                                    </option>
                                    <option
                                        {{$order->status =='Siparişiniz Alındı'?'selected':''}} value="Siparişiniz Alındı">
                                        Siparişiniz Alındı
                                    </option>
                                    <option
                                        {{$order->status =='Kargo Bekleniyor'?'selected':''}} value="Kargo Bekleniyor">
                                        Kargo Bekleniyor
                                    </option>
                                </select>
                            </div>
                        </div>


                        <div class="form-actions text-right">
                            <button type="button" id="orderStatusUpdate" class="btn btn-success">Durum Güncelle</button>
                        </div>

                    </form>
                    <h2 style="text-align: center;">Sipariş (SP-{{$order->id}})</h2>
                    <table class="table table-bordererd table-hover ">
                        <tr>
                            <th colspan="2">Ürün</th>
                            <th>Tutar</th>
                            <th>Adet</th>
                            <th>Ara Toplam</th>
                            <th>Durum</th>
                        </tr>
                        @foreach($order->basket->basket_product as $sepetdeki_urun)
                            <tr>
                                <td style="width: 120px;">
                                    <a href="{{route('frontend.product.index',['id'=>$sepetdeki_urun->product->id,'slug'=>$sepetdeki_urun->product->slug])}}">
                                        <img src="@if($sepetdeki_urun->product->detail->product_img ==null)
                                            https://loremflickr.com/260/300/car?random={{rand(1,100)}}
                                        @else
                                        {{asset($sepetdeki_urun->product->detail->product_img)}}
                                        @endif"
                                             alt="...">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('frontend.product.index',['id'=>$sepetdeki_urun->product->id,'slug'=>$sepetdeki_urun->product->slug])}}">
                                        {{$sepetdeki_urun->product->tittle}}
                                    </a>
                                </td>
                                <td>{{$sepetdeki_urun->price}}</td>
                                <td>{{$sepetdeki_urun->qty}}</td>
                                <td>{{$sepetdeki_urun->price*$sepetdeki_urun->qty}}</td>
                                <td>{{$sepetdeki_urun->status}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="5" style="text-align: right">Tutar</th>
                            <th colspan="1">{{$order->amount}}</th>
                            <th></th>
                        </tr>

                        <tr>
                            <th colspan="5" style="text-align: right">KDV</th>
                            <th colspan="1">{{$order->amount*((config('cart.tax'))/100)}}</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th colspan="5" style="text-align: right">Toplam Tutar</th>
                            <th colspan="1">{{$order->amount+$order->amount*((config('cart.tax'))/100)}}</th>
                            <th></th>
                        </tr>

                        {{--<tr>--}}
                        {{--<th colspan="5" style="text-align: right">Toplam Tutar</th>--}}
                        {{--<th colspan="1">{{$order->amount*((100+config('cart.tax'))/100)}}</th>--}}
                        {{--<th></th>--}}
                        {{--</tr>--}}

                        <tr>
                            <th colspan="5" style="text-align: right">Sipariş Durum</th>
                            <th colspan="1">{{$order->status}}</th>
                            <th></th>
                        </tr>


                    </table>


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

        $("#orderStatusUpdate").on("click", function () {

            var form = new FormData($("#orderForm")[0]);

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
                url: "{{route("backend.order.update",["id"=>$order->id])}}",
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


    </script>

@endpush
@push("customCss")



@endpush
