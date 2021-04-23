<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->

        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src={{ asset('img/user.png') }} class="user-image img-circle elevation-2 cc_pointer"
                    alt="User Image">
                <span class="d-none d-md-inline cc_pointer">User</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <!-- User image -->
                <li class="user-header bg-primary cc_cursor">
                    <img src={{ asset('img/user.png') }} class="img-circle elevation-2" alt="User Image">

                    <p>
                        User - Administrator
                    </p>
                </li>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer cc_cursor">
                    <a href="/profile" class="btn btn-default btn-flat cc_pointer">Profile</a>
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out
                    </a>
                    {{-- <a href="#" class="btn btn-default btn-flat float-right">Sign out</a> --}}
                </li>
            </ul>
        </li>
    </ul>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</nav>
<!-- /.navbar -->
