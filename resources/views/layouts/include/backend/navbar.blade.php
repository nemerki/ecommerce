
<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li class="dropdown" id="profile-messages"><a title="" href="#" data-toggle="dropdown"
                                                      data-target="#profile-messages" class="dropdown-toggle"><i
                    class="icon icon-user"></i> <span class="text">Mehabe {{Auth::guard('admin')->user()->name}}</span><b
                    class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{{--{{route("backend.auth.edit",Auth::auth()->id)}}--}}"><i class="icon-user"></i>Profilim</a>
                </li>
                <li class="divider"></li>
                <li><a href="#"><i class="icon-check"></i> My Tasks</a></li>
                <li class="divider"></li>
                <li><a href="{{route("backend.auth.logout")}}"><i class="icon-key"></i> Log Out</a></li>
            </ul>
        </li>

    </ul>
</div>
<!--close-top-Header-menu-->
