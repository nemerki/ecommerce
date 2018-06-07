<!DOCTYPE html>
<html lang="{{config('app.locale')}}">

<head>
    <title>@yield('tittle', config('app.name'))</title>
    @include("layouts.include.frontend.head")
    @stack("customCss")
</head>

<body id="commerce">
@include("layouts.include.frontend.navbar")
@yield("content")
@include("layouts.include.frontend.footer")

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert2@7.21.0/dist/sweetalert2.all.js"></script>
@stack("customJs")
</body>

</html>
