<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('tittle',config('app.name')." | Admin")</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="{{asset("assets/backend/css/bootstrap.min.css")}}"/>
    <link rel="stylesheet" href="{{asset("assets/backend/css/bootstrap-responsive.min.css")}}"/>
    <link rel="stylesheet" href="{{asset("assets/backend/css/fullcalendar.css")}}"/>
    <link rel="stylesheet" href="{{asset("assets/backend/css/matrix-style.css")}}"/>
    <link rel="stylesheet" href="{{asset("assets/backend/css/matrix-media.css")}}"/>
    <link href="{{asset("assets/backend/font-awesome/css/font-awesome.css")}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset("assets/backend/css/jquery.gritter.css")}}"/>
    <link rel="stylesheet" href="{{asset("assets/backend/css/admin.css")}}">
    @stack("customCss")
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!--Header-part-->
<div id="header">
    <h1><a href="dashboard.html">Matrix Admin</a></h1>
</div>
<!--close-Header-part-->

@include("layouts.include.backend.navbar")
@include("layouts.include.backend.sidebar")

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
                Home</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        @yield("content")
    </div>
    <!--End-Action boxes-->


</div>
</div>

<!--end-main-container-part-->

<!--Footer-part-->

<div class="row-fluid">
    <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a>
    </div>
</div>

<!--end-Footer-part-->

<script src="{{asset("assets/backend/js/excanvas.min.js")}}"></script>
<script src="{{asset("assets/backend/js/jquery.min.js")}}"></script>
<script src="{{asset("assets/backend/js/jquery.ui.custom.js")}}"></script>
<script src="{{asset("assets/backend/js/bootstrap.min.js")}}"></script>
<script src="{{asset("assets/backend/js/jquery.flot.min.js")}}"></script>
<script src="{{asset("assets/backend/js/jquery.flot.resize.min.js")}}"></script>
<script src="{{asset("assets/backend/js/jquery.peity.min.js")}}"></script>
{{--<script src="{{asset("assets/backend/js/matrix.js")}}"></script>--}}
{{--<script src="{{asset("assets/backend/js/matrix.dashboard.js")}}"></script>--}}
<script src="{{asset("assets/backend/js/jquery.gritter.min.js")}}"></script>
{{--<script src="{{asset("assets/backend/js/matrix.interface.js")}}"></script>--}}
{{--<script src="{{asset("assets/backend/js/jquery.validate.js")}}"></script>--}}
{{--<script src="{{asset("assets/backend/js/matrix.form_validation.js")}}"></script>--}}
<script src="{{asset("assets/backend/js/jquery.uniform.js")}}"></script>
<script src="{{asset("assets/backend/js/select2.min.js")}}"></script>
{{--<script src="{{asset("assets/backend/js/jquery.dataTables.min.js")}}"></script>--}}
{{--<script src="{{asset("assets/backend/js/matrix.tables.js")}}"></script>--}}
<script src="https://unpkg.com/sweetalert2@7.21.0/dist/sweetalert2.all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@stack("customJs")

</body>
</html>
