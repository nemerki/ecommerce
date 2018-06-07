@extends("layouts.frontend")
@section("tittle",$category->name)
@section("content")
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route("frontend.home.index")}}">Anasayfa</a></li>
            <li class="active">{{$category->name}}</li>
        </ol>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$category->name}}</div>
                    <div class="panel-body">
                        @if(count($altcategories)!=0)
                            <h3>Alt Kategoriler</h3>
                            <div class="list-group categories">
                                @foreach($altcategories as $altcategory)
                                    <a href="{{route("frontend.category.index",["slug"=>$altcategory->slug])}}"
                                       class="list-group-item"><i class="fa fa-television"></i>{{$altcategory->name}}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                        <h3>Fiyat Aralığı</h3>
                        <form>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> 100-200
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> 200-300
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products bg-content">
                    @if(count($products) !=0)
                        Sırala
                        <a href="?order=coksatan" class="btn btn-default">Çok Satanlar</a>
                        <a href="?order=yeni" class="btn btn-default">Yeni Ürünler</a>
                        <hr>
                    @endif
                    <div class="row">
                        @if(count($products) == 0)
                            <div class="col-md-12">
                                Bu Kategoride Ürün bulunamadı
                            </div>
                        @else
                            @foreach($products as $product)
                                <div class="col-md-3 product">
                                    <a href="{{route("frontend.product.index",["id"=>$product->id,"slug"=>$product->slug])}}"><img
                                            src="http://via.placeholder.com/350x150?text=Ürün Resmi"></a>
                                    <p>
                                        <a href="{{route("frontend.product.index",["id"=>$product->id,"slug"=>$product->slug])}}">{{$product->tittle}}</a>
                                    </p>
                                    <p class="price">{{$product->price}}</p>
                                    <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    {{request()->has("order")? $products->appends(["order"=>request("order")])->links(): $products->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
@push("customJs")


@endpush
@push("customCss")



@endpush

