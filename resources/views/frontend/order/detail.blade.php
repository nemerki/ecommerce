@extends("layouts.frontend")
@section("tittle")
@section("content")

    <div class="container">
        <div class="bg-content">
            <a href="{{route("frontend.order.index")}}" class="btn btn-primary btn-xs">
                <i class="glyphicon glyphicon-arrow-left"></i>Siparişlere Dön
            </a>
            <h2>Sipariş (SP-{{$order->id}})</h2>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="1">Ürün</th>
                    <th>Tutar</th>
                    <th>Adet</th>
                    <th>Ara Toplam</th>
                    <th>Durum</th>
                </tr>
                @foreach($order->basket->basket_product as $sepetdeki_urun)
                    <tr>
                        <td style="width: 120px;">
                            <a href="{{route('frontend.product.index',['id'=>$sepetdeki_urun->product->id,'slug'=>$sepetdeki_urun->product->slug])}}">
                                <img src="https://loremflickr.com/120/100/product?random={{rand(1,100)}}" alt="...">
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
                    <th colspan="5" class="text-right">Tutar</th>
                    <th colspan="1">{{$order->amount}}</th>
                    <th></th>
                </tr>

                <tr>
                    <th colspan="5" class="text-right">KDV</th>
                    <th colspan="1">{{$order->amount*((config('cart.tax'))/100)}}</th>
                    <th></th>
                </tr>
                <tr>
                    <th colspan="5" class="text-right">Toplam Tutar</th>
                    <th colspan="1">{{$order->amount+$order->amount*((config('cart.tax'))/100)}}</th>
                    <th></th>
                </tr>

                {{--<tr>--}}
                {{--<th colspan="5" class="text-right">Toplam Tutar</th>--}}
                {{--<th colspan="1">{{$order->amount*((100+config('cart.tax'))/100)}}</th>--}}
                {{--<th></th>--}}
                {{--</tr>--}}

                <tr>
                    <th colspan="5" class="text-right">Sipariş Durum</th>
                    <th colspan="1">{{$order->status}}</th>
                    <th></th>
                </tr>


            </table>
        </div>
    </div>
@endsection
@push("customJs")


@endpush
@push("customCss")



@endpush

