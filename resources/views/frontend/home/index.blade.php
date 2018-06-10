@extends("layouts.frontend")
@section("content")


    <div class="container">


        @if (session()->has('mesaj'))
            <div class="alert alert-{{ session('mesaj_tur') }}">{{ session('mesaj') }}</div>
        @endif

        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Kategoriler</div>
                    <div class="list-group categories">
                        @foreach($categories as $category)
                            <a href="{{route("frontend.category.index",["slug"=>$category->slug])}}"
                               class="list-group-item"><i class="fa fa-television"></i> {{$category->name}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($slider as $index=>$product)
                            <li data-target="#carousel-example-generic" data-slide-to="{{$index}}"
                                class=" {{$index==0 ? 'active':''}}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach($slider as $index=>$product)
                            <div class="item {{$index==0 ? 'active':''}}">
                                <a href="{{route("frontend.product.index",["id"=>$product->id,"slug"=>$product->slug])}}">
                                    <img src="
                                    @if($product->detail->product_img ==null)
                                        https://loremflickr.com/640/400/product?random={{rand(1,100)}}
                                    @else
                                    {{$product->detail->product_img}}
                                    @endif
                                        " alt="..."></a>
                                <div class="carousel-caption">
                                    {{$product->tittle}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default" id="sidebar-product">
                    <div class="panel-heading">Günün Fırsatı</div>
                    <div class="panel-body">
                        <a href="{{route("frontend.product.index",["id"=>$gunun_firsati->id,"slug"=>$gunun_firsati->slug])}}">
                            <img src="
                             @if($product->detail->product_img ==null)
                                https://loremflickr.com/260/300/product?random={{rand(1,100)}}
                            @else
                            {{$product->detail->product_img}}
                            @endif
                                " class="img-responsive">
                            {{$gunun_firsati->tittle}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Öne Çıkan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($one_cikan as $product)
                            <div class="col-md-3 product">
                                <a href="{{route("frontend.product.index",["id"=>$product->id,"slug"=>$product->slug])}}"><img
                                        src="
                                         @if($product->detail->product_img ==null)
                                            https://loremflickr.com/260/300/product?random={{rand(1,100)}}
                                        @else
                                        {{$product->detail->product_img}}
                                        @endif
                                            "></a>
                                <p>
                                    <a href="{{route("frontend.product.index",["id"=>$product->id,"slug"=>$product->slug])}}">{{$product->tittle}}</a>
                                </p>
                                <p class="price">{{$product->price}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Çok Satan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($cok_satan as $product)
                            <div class="col-md-3 product">
                                <a href="{{route("frontend.product.index",["id"=>$product->id,"slug"=>$product->slug])}}"><img
                                        src="
                                         @if($product->detail->product_img ==null)
                                            https://loremflickr.com/260/300/product?random={{rand(1,100)}}
                                        @else
                                        {{$product->detail->product_img}}
                                        @endif
                                            "></a>
                                <p>
                                    <a href="{{route("frontend.product.index",["id"=>$product->id,"slug"=>$product->slug])}}">{{$product->tittle}}</a>
                                </p>
                                <p class="price">{{$product->price}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">İndirimli Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($indirimli as $product)
                            <div class="col-md-3 product">
                                <a href="{{route("frontend.product.index",["id"=>$product->id,"slug"=>$product->slug])}}"><img
                                        src="
                                         @if($product->detail->product_img ==null)
                                            https://loremflickr.com/260/300/car?random={{rand(1,100)}}
                                        @else
                                        {{$product->detail->product_img}}
                                        @endif
                                      "></a>
                                <p>
                                    <a href="{{route("frontend.product.index",["id"=>$product->id,"slug"=>$product->slug])}}">{{$product->tittle}}</a>
                                </p>
                                <p class="price">{{$product->price}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("customJs")

    <script>
        setTimeout(function () {
            $(".alert").slideUp(500);
        }, 3000)
    </script>

@endpush
@push("customCss")



@endpush

