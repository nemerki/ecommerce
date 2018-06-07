<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route("frontend.home.index")}}">
                <img src="{{asset("assets/frontend/img/logo.png")}}">
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form navbar-left" action="{{route("frontend.search.index")}}" method="POST">
                {{csrf_field()}}
                <div class="input-group">
                    <input type="text" id="navbar-search" name="search" class="form-control" placeholder="Ara">
                    <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{route("frontend.basket.index")}}"><i class="fa fa-shopping-cart"></i> Sepet <span class="badge badge-theme">{{Cart::count()}}</span></a>
                </li>
                @guest()
                    <li><a href="{{route("frontend.auth.signin")}}">Oturum Aç</a></li>
                    <li><a href="{{route("frontend.auth.signup")}}">Kaydol</a></li>
                @endguest
                @auth()
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false"> Profil <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route("frontend.order.index")}}">Siparişlerim</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Çıkış</a>

                                {{--<form id="logout-form" action="{{route("frontend.user.logout")}}"authhod="post"--}}
                                      {{--style="display: none;">--}}
                                    {{--{{csrf_field()}}--}}
                                {{--</form>--}}

                                <form id="logout-form" action="{{ route('frontend.auth.logout') }}" method="post" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>