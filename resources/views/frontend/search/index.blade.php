@extends("layouts.frontend")
@section("tittle")
@section("content")

    <div class="container">

        <ol class="breadcrumb">
            <li><a href="{{ route('frontend.home.index') }}">Anasayfa</a></li>
            <li class="active">Arama Sonucu</li>
            <li class="active">{{$search}}</li>
        </ol>

        <div class="products bg-content">
            <div class="row">
                @if (count($products)==0)
                    <div class="col-md-12 text-center">
                        Bir ürün bulunamadı!
                    </div>
                @endif
                @foreach($products as $product)
                    <div class="col-md-3 product">
                        <a href="{{ route("frontend.product.index",["id"=>$product->id,"slug"=>$product->slug]) }}">
                            <img src="https://loremflickr.com/260/300/aliexpress?random={{rand(1,100)}}"
                                 alt="{{ $product->tittle }}">
                        </a>
                        <p>
                            <a href="{{ route("frontend.product.index",["id"=>$product->id,"slug"=>$product->slug]) }}">
                                {{ $product->tittle }}
                            </a>
                        </p>
                        <p class="price">{{ $product->price }} ₺</p>
                    </div>
                @endforeach
            </div>
            {{$products->appends(["search"=>old("search")])->links()}}
        </div>

    </div>

@endsection
@push("customJs")


@endpush
@push("customCss")



@endpush

