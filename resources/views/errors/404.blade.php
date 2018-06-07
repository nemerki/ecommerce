@extends("layouts.frontend")
@section("tittle")
@section("content")

    <div class="container">
        <div class="jumbotron text-center">
            <h1>404</h1>
            <h2>Aradığınız Sayfa Bulunamadı</h2>
            <a href="{{route("frontend.home.index")}}" class="btn btn-success">Anasayfaya Dön</a>
        </div>
    </div>

@endsection
@push("customJs")


@endpush
@push("customCss")



@endpush

