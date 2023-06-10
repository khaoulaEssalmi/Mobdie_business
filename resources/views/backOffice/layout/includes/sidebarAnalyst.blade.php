<nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: #85c5ce">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route("analyst.dashboard", ['name' => auth()->user()->name]) }}"  >
                <i class="mdi mdi-monitor-dashboard" style="font-size: 23px;"></i>
                &nbsp;&nbsp;&nbsp;
                <span class="menu-title"><b style="font-size: 14px;">Dashboard</b></span>
            </a>
        </li>

        {{--        <li class="nav-item">--}}
        {{--            <a class="nav-link" href="{{route("superAdmin.managers.display")}}" >--}}
        {{--                <i class="icon-layout menu-icon"></i>--}}
        {{--                <span class="menu-title">Managers</span>--}}
        {{--            </a>--}}
        {{--        </li>--}}
        {{--                <li class="nav-item">--}}
        {{--                    <a class="nav-link" href="#" >--}}
        {{--                        <i class="menu-icon fas fa-mail-bulk"></i>--}}
        {{--                        <span class="menu-title">Orders</span>--}}
        {{--                    </a>--}}
        {{--                </li>--}}
        <li class="nav-item">
            <a class="nav-link"   href="{{ route("analyst.managers") }}">
                <i class="fas fa-users" style="font-size: 23px;"></i>
                &nbsp;&nbsp;&nbsp;
                <span class="menu-title"><b style="font-size: 14px;">Managers</b></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route("general.logout")}}" style="padding-top: 520px;">
                <i class="fas fa-sign-out-alt" style="font-size: 23px;"></i>
                &nbsp;&nbsp;&nbsp;
                <span class="menu-title"><b style="font-size: 14px;">Logout</b></span>
            </a>
        </li>
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{{route("general.inbox")}}">--}}
{{--                <i class="fas fa-inbox" style="font-size: 20px;"></i>--}}
{{--                &nbsp;&nbsp;&nbsp;--}}
{{--                <span class="menu-title">Inbox</span>--}}
{{--                <span class="num-messages">{{ $count }}</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="#" >--}}
{{--                <i class="menu-icon fas fa-mail-bulk" style="font-size: 20px;"></i>--}}
{{--                <span class="menu-title">Newsletter</span>--}}
{{--            </a>--}}
{{--        </li>--}}
    </ul>
</nav>
