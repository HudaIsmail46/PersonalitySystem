<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/home" class="brand-link">
        <img src={{ asset('img/cleanherologo100.png') }} alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link">
                        <i class=" fas fa-home nav-icon"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
            </ul>
            @can('list bookings')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview menu-{{ (request()->is('booking*')) ? 'open' : '' }}">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                Bookings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href={{route('booking.index')}} class="nav-link {{ (request()->is('booking/index')) ? 'active' : '' }}">
                                    <i class=" fa fa-calendar-o nav-icon"></i>
                                    <p>All Bookings</p>
                                </a>
                                @can('create bookings')
                                    <a href={{route('booking.create')}} class="nav-link {{ (request()->is('booking/create')) ? 'active' : '' }}">
                                        <i class="fas fa-calendar-plus nav-icon"></i>

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

                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Customers
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href={{route('customer.index')}} class="nav-link {{ (request()->is('customer/index')) ? 'active' : '' }}">
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

                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href={{route('user.index')}} class="nav-link {{ (request()->is('user/index')) ? 'active' : '' }}">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>All Users</p>
                                </a>
                                @can('create users')
                                    <a href={{route('user.create')}} class="nav-link {{ (request()->is('user/create')) ? 'active' : '' }}">
                                        <i class="fas fa-user-plus nav-icon"></i>
                                        <p>Create User</p>
                                    </a>
                                @endcan
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan
            @can('list orders')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview menu-{{ (request()->is('order*')) ? 'open' : '' }}">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                Orders
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href={{route('order.index')}} class="nav-link {{ (request()->is('order/index')) ? 'active' : '' }}">
                                    <i class=" fa fa-shopping-cart nav-icon"></i>
                                    <p>All Orders</p>
                                </a>
                                @can('create orders')
                                    <a href={{route('order.create')}} class="nav-link {{ (request()->is('order/create')) ? 'active' : '' }}">
                                        <i class="fas fa-cart-plus nav-icon"></i>
                                        <p>Create Orders</p>
                                    </a>
                                @endcan
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan
            @can('list runnerSchedules')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview menu-{{ (request()->is('runner*')) ? 'open' : '' }}">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-running "></i>
                            <p>
                                Runner Schedule
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                @can('create runnerSchedules')
                                    <a href={{route('runner_schedule.index')}} class="nav-link {{ (request()->is('runner_schedule/index')) ? 'active' : '' }}">
                                        <i class=" fa fa-user nav-icon"></i>
                                        <p>All Runner Schedule</p>
                                    </a>
                                    <a href={{route('runner_schedule.create')}} class="nav-link {{ (request()->is('runner_schedule/create')) ? 'active' : '' }}">
                                        <i class="fas fa-user-plus nav-icon"></i>
                                        <p>Create Runner Schedule</p>
                                    </a>
                                @endcan
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan
            @can('list assignedRunnerSchedule')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview menu-{{ (request()->is('runner*')) ? 'open' : '' }}">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-running "></i>
                            <p>
                                Runner Schedule
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href={{route('runner.index')}} class="nav-link {{ (request()->is('runner/index')) ? 'active' : '' }}">
                                    <i class=" fa fa-user nav-icon"></i>
                                    <p>All Runner Schedule</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan
        </nav>
    </div>
</aside>