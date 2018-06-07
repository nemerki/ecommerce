@extends("layouts.frontend")
@section("tittle","Siparişler")
@section("content")

    <div class="container">
        <div class="bg-content">
            <h2>Siparişler</h2>
            @if(count($orders)==0)
                <p>Henüz siparişiniz yok</p>
            @else
                <table class="table table-bordererd table-hover">
                    <tr>
                        <th>Sipariş Kodu</th>
                        <th>Sipariş Tarihi</th>
                        <th>Tutar</th>
                        <th>Toplam Ürün</th>
                        <th>Durum</th>
                        <th>İşlem</th>
                    </tr>
                    @foreach($orders as $order)
                        <tr>
                            <td>SP-{{$order->id}}</td>
                            <td>{{date("d-M-Y",strtotime($order->created_at))}}</td>
                            <td>{{ $order->amount*((100+config('cart.tax'))/100) }}</td> {{--tabloda fiyatı kdv siz tutuyoruz kdv li fiyatı bulmak için bu işlemi yaptık kdv oranını config içindeki cart içindeki tax dan alıyor--}}
                            <td>{{$order->basket->sepet_urun_adet()}}</td>
                            <td>{{$order->status}}</td>
                            <td><a href="{{route("frontend.order.detail",["id"=>$order->id])}}"
                                   class="btn btn-sm btn-success">Detay</a></td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
@endsection
@push("customJs")


@endpush
@push("customCss")



@endpush

