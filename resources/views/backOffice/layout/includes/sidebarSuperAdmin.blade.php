<nav class="sidebar sidebar-offcanvas" style="background-color: #F59711;" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route("manager.dashboard", ['name' => auth()->user()->name]) }}"  >
                <i class="mdi mdi-monitor-dashboard" style="font-size: 23px;"></i>
                &nbsp;&nbsp;&nbsp;
                <span class="menu-title"><b style="font-size: 14px;">Dashboard</b></span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route("superAdmin.admins",['cin'=>auth()->user()->CIN]) }}" >
                <i  class="fas fa-list" style="font-size: 23px;"></i>
                &nbsp;&nbsp;&nbsp;
                <span class="menu-title"><b style="font-size: 14px;">Admins</b></span>
            </a>
        </li>
        {{--        <li class="nav-item">--}}
        {{--            <a class="nav-link" href="#" >--}}
        {{--                <i class="menu-icon fas fa-mail-bulk"></i>--}}
        {{--                <span class="menu-title">Orders</span>--}}
        {{--            </a>--}}
        {{--        </li>--}}
        {{--        <li class="nav-item">--}}
        {{--            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">--}}
        {{--                <i class="icon-columns menu-icon"></i>--}}
        {{--                <span class="menu-title">Serveurs</span>--}}
        {{--                <i class="menu-arrow"></i>--}}
        {{--            </a>--}}
        {{--            <div class="collapse" id="form-elements">--}}
        {{--                <ul class="nav flex-column sub-menu">--}}
        {{--                    <li class="nav-item"><a class="nav-link" href="#">Les serveurs</a></li>--}}
        {{--                    <li class="nav-item"><a class="nav-link" href="#">Ajouter serveur</a></li>--}}
        {{--                </ul>--}}
        {{--            </div>--}}

        <li class="nav-item">
            <a class="nav-link" href="{{route("general.logout")}}" style="padding-top: 520px;">
                <i class="fas fa-sign-out-alt" style="font-size: 23px;"></i>
                &nbsp;&nbsp;&nbsp;
                <span class="menu-title"><b style="font-size: 14px;">Logout</b></span>
            </a>
        </li>

        {{--        <li class="nav-item">--}}
        {{--            <a class="nav-link" href="#" >--}}
        {{--                <i class="menu-icon fas fa-mail-bulk"></i>--}}
        {{--                <span class="menu-title">Newsletter</span>--}}
        {{--            </a>--}}
        {{--        </li>--}}

    </ul>
</nav>
