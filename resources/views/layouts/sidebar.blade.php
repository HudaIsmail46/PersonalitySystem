<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/home" class="brand-link">
        <img src={{ asset('img/cleanherologo100.png') }} alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">CleanHero</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src={{ asset('img/cleanherologo100.png') }} class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth()->user()->name}}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul>
                <a href="{{route('home')}}"><i class="fa fa-home"></i> <span>Home</span></a>
            </ul>
            @can('list bookings')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview menu-{{ (request()->is('booking*')) ? 'open' : '' }}">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-briefcase"></i>
                            <p>
                                Bookings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href={{route('booking.index')}} class="nav-link {{ (request()->is('booking')) ? 'active' : '' }}">
                                <i class="fas fa-briefcase"></i>
                                    <p>All Bookings</p>
                                </a>
                                @can('create bookings')
                                    <a href={{route('booking.create')}} class="nav-link {{ (request()->is('booking/create')) ? 'active' : '' }}">
                                    <i class="fas fa-briefcase"></i>
                                        <p>Create Bookings</p>
                                    </a>
                                @endcan
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan
            @can('list customers')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview menu-{{ (request()->is('customer*')) ? 'open' : '' }}">
                    <a href="#" class="nav-link active">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                Customers
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href={{route('customer.index')}} class="nav-link {{ (request()->is('customer')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Customers</p>
                                </a>
                                @can('create customers')
                                    <a href={{route('customer.create')}} class="nav-link {{ (request()->is('customer/create')) ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create Customers</p>
                                    </a>
                                @endcan
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan
            @can('list users')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview menu-{{ (request()->is('user*')) ? 'open' : '' }}">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-users"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href={{route('user.index')}} class="nav-link {{ (request()->is('user/index')) ? 'active' : '' }}">
                                    <i class="fas fa-users"></i>
                                    <p>All Users</p>
                                </a>
                                @can('create users')
                                    <a href={{route('user.create')}} class="nav-link {{ (request()->is('user/create')) ? 'active' : '' }}">
                                        <i class="fas fa-user"></i>
                                        <p>Create User</p>
                                    </a>
                                @endcan
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan
        </nav>
    </div>
</aside>
