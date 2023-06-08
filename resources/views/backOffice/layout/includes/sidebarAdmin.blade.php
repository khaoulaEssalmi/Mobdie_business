
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route("superAdmin.dashboard", ['name' => auth()->user()->name]) }}"  >
                <i class= "mdi mdi-monitor-dashboard" style="font-size: 20px;"></i>
                &nbsp;&nbsp;&nbsp;
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
                <li class="nav-item">
                    <a class="nav-link"  href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                        <i class="fas fa-tasks" style="font-size: 20px;"></i>
                        &nbsp;&nbsp;&nbsp;
                        <span class="menu-title">Projects</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="form-elements">
                        <ul class="nav flex-column sub-menu">
                            <li ><a class="custom-link" href="{{ route('admin.import') }}"><i class="fas fa-file-import" style="font-size: 17px"></i> &nbsp;&nbsp;Import new projects</a></li>
                            <br>
                            <li ><a class="custom-link" href="{{ route('admin.projects') }}"><i class="fas fa-list" style="font-size: 17px"></i> &nbsp;&nbsp; List of projects </a></li>
                        </ul>
                    </div>

                </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.managers') }}"  >
                <i class= "fas fa-user-tie" style="font-size: 20px;"></i>
                &nbsp;&nbsp;&nbsp;
                <span class="menu-title">Managers</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.analysts') }}"  >
                <i class= "fas fa-user-chart" style="font-size: 20px;"></i>
                &nbsp;&nbsp;&nbsp;
                <span class="menu-title">Analysts</span>
            </a>
        </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("general.logout")}}" style="padding-top: 380px;">
                        <i class="fas fa-sign-out-alt" style="font-size: 20px;"></i>
                        &nbsp;&nbsp;&nbsp;
                        <span class="menu-title">Logout</span>
                    </a>
                </li>
    </ul>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var projectsLink = document.querySelector('.nav-item .nav-link[href="#form-elements"]');
        var subMenu = document.querySelector('.nav-item #form-elements');
        var menuArrow = document.querySelector('.nav-item .menu-arrow');

        projectsLink.addEventListener('click', function(e) {
            e.preventDefault();
            subMenu.classList.toggle('show');
            menuArrow.classList.toggle('rotate');
        });
    });
</script>

<style>
    .menu-arrow {
        transition: transform 0.4s;
    }

    .rotate {
        transform: rotate(90deg);
    }
</style>
