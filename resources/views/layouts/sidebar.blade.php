<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href={{ Auth::user()->hasRole(['Runner', 'Vendor']) ? '#' : route('home') }} class="brand-link">
        <img src={{ asset('img/cleanherologo100.png') }} alt="CleanHero Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">CleanHero</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src={{ asset('img/cleanherologo100.png') }} class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth()->user()->name }}</a>
            </div>
        </div>
        <nav class="mt-2">
            @if (!Auth::user()->hasRole(['Runner', 'Vendor']))
                <ul class="nav nav-pills nav-sidebar flex-column">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class=" fas fa-home nav-icon"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>
                </ul>
            @endif
            @can('create roles')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview menu-{{ request()->is('role*') ? 'open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('role*') ? 'active' : '' }}">
                            <i class="fas fa-user-circle nav-icon"></i>
                            <p>
                                Roles
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview bg-secondary rounded-lg">
                            <li class="nav-item">
                                <a href={{ route('role.index') }}
                                    class="nav-link {{ request()->is('role/index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Roles</p>
                                </a>
                                <a href={{ route('role.create') }}
                                    class="nav-link {{ request()->is('role/create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Create Roles</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan
            @can('list bookings')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview menu-{{ request()->is('booking*') ? 'open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('booking*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                Bookings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview bg-secondary rounded-lg">
                            <li class="nav-item">
                                <a href={{ route('booking.index') }}
                                    class="nav-link {{ request()->is('booking/index') ? 'active' : '' }}">
                                    <i class=" fa fa-calendar-o nav-icon"></i>
                                    <p>All Bookings</p>
                                </a>
                                @can('create bookings')
                                    <a href={{ route('booking.create') }}
                                        class="nav-link {{ request()->is('booking/create') ? 'active' : '' }}">
                                        <i class="fas fa-calendar-plus nav-icon"></i>

                                        <p>Create Bookings</p>
                                    </a>
                                @endcan
                                @can('import bookingProduct')
                                    <a href={{ route('booking_product.import.new') }}
                                        class="nav-link {{ request()->is('booking_products/import-excel') ? 'active' : '' }}">
                                        <i class="fas fa-file-import nav-icon"></i>

                                        <p>Import Booking Products</p>
                                    </a>
                                @endcan
                                @can('follow up')
                                <a href={{route('follow_up.index')}} class="nav-link {{ (request()->is('follow_up/index')) ? 'active' : '' }}">
                                    <i class="fas fa-pen nav-icon"></i>

                                    <p>Follow Up</p>
                                </a>
                            @endcan
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan
            @can('list customers')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview menu-{{ request()->is('customer*') ? 'open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('customer*') ? 'active' : '' }}">

                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Customers
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview bg-secondary rounded-lg">
                            <li class="nav-item">
                                <a href={{ route('customer.index') }}
                                    class="nav-link {{ request()->is('customer/index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Customers</p>
                                </a>
                                @can('create customers')
                                    <a href={{ route('customer.create') }}
                                        class="nav-link {{ request()->is('customer/create') ? 'active' : '' }}">
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
                    <li class="nav-item has-treeview menu-{{ request()->is('user*') ? 'open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">

                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview bg-secondary rounded-lg">
                            <li class="nav-item">
                                <a href={{ route('user.index') }}
                                    class="nav-link {{ request()->is('user/index') ? 'active' : '' }}">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>All Users</p>
                                </a>
                                @can('create users')
                                    <a href={{ route('user.create') }}
                                        class="nav-link {{ request()->is('user/create') ? 'active' : '' }}">
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
                    <li class="nav-item has-treeview menu-{{ request()->is('order*') ? 'open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('order*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                Orders
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview bg-secondary rounded-lg">
                            <li class="nav-item">
                                <a href={{ route('order.index') }}
                                    class="nav-link {{ request()->is('order/index') ? 'active' : '' }}">
                                    <i class=" fa fa-shopping-cart nav-icon"></i>
                                    <p>All Orders</p>
                                </a>
                                @can('create orders')
                                    <a href={{ route('order.create') }}
                                        class="nav-link {{ request()->is('order/create') ? 'active' : '' }}">
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
                    <li class="nav-item has-treeview menu-{{ request()->is('runner_schedule*') ? 'open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('runner_schedule*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-running "></i>
                            <p>
                                Runner Schedule
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview bg-secondary rounded-lg">
                            <li class="nav-item">
                                @can('create runnerSchedules')
                                    <a href={{ route('runner_schedule.index') }}
                                        class="nav-link {{ request()->is('runner_schedule/index') ? 'active' : '' }}">
                                        <i class=" fa fa-user nav-icon"></i>
                                        <p>All Runner Schedule</p>
                                    </a>
                                    <a href={{ route('runner_schedule.create') }}
                                        class="nav-link {{ request()->is('runner_schedule/create') ? 'active' : '' }}">
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
                <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href={{ route('external.runner.index') }}
                            class="nav-link {{ request()->is('external/runner/*') ? 'active' : '' }}">
                            <i class=" fas fa-running nav-icon"></i>
                            <p>
                                Runner Schedule
                            </p>
                        </a>
                    </li>
                </ul>
            @endcan
            @can('list vendorCollected orders')
                <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href={{ route('external.order.index') }}
                            class="nav-link {{ request()->is('vendor_collected/index') ? 'active' : '' }}">
                            <i class=" fas fa-inbox nav-icon"></i>
                            <p>
                                Vendor Collected
                            </p>
                        </a>
                    </li>
                </ul>
            @endcan
            @can('list inhouseCleaning orders')
                <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href={{ route('inhouse_cleaning.index') }}
                            class="nav-link {{ request()->is('inhouse_cleaning/index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-warehouse"></i>
                            <p>
                                In House Cleaning
                            </p>
                        </a>
                    </li>
                </ul>
            @endcan
            @can('list members')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview menu-{{ request()->is('member/*') ? 'open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('member/*') ? 'active' : '' }}">

                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Operation Members
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview bg-secondary rounded-lg">
                            <li class="nav-item">
                                <a href={{ route('member.index') }}
                                    class="nav-link {{ request()->is('member/index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All HQ Members</p>
                                </a>
                                <a href={{ route('member.jb_index') }}
                                    class="nav-link {{ request()->is('member/index/jb') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All JB Members</p>
                                </a>
                                @can('create members')
                                    <a href={{ route('member.create') }}
                                        class="nav-link {{ request()->is('member/create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create members</p>
                                    </a>
                                @endcan
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan
            @can('list teams')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview menu-{{ request()->is('team/*') ? 'open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('team/*') ? 'active' : '' }}">

                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Operation Teams
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview bg-secondary rounded-lg">
                            <li class="nav-item">
                                <a href={{ route('team.index') }}
                                    class="nav-link {{ request()->is('team/index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Teams</p>
                                </a>
                                @can('create teams')
                                    <a href={{ route('team.create') }}
                                        class="nav-link {{ request()->is('team/create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create Teams</p>
                                    </a>
                                @endcan
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan
            @can('list teamMembers')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview menu-{{ request()->is('team_member*') ? 'open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('team_member*') ? 'active' : '' }}">

                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Team Pairings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview bg-secondary rounded-lg">
                            <li class="nav-item">
                                <a href={{ route('team_member.index') }}
                                    class="nav-link {{ request()->is('team_member/index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Team Members</p>
                                </a>
                                @can('create teamMembers')
                                    <a href={{ route('team_member.create') }}
                                        class="nav-link {{ request()->is('team_member/create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create Team Members</p>
                                    </a>
                                @endcan
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan
            @can('list vehicles')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview menu-{{ request()->is('vehicle*') ? 'open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('vehicle*') ? 'active' : '' }}">

                            <i class="nav-icon fas fa-shuttle-van"></i>
                            <p>
                                Operation Vehicles
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview bg-secondary rounded-lg">
                            <li class="nav-item">
                                <a href={{ route('vehicle.index') }}
                                    class="nav-link {{ request()->is('vehicle/index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Vehicles</p>
                                </a>
                                @can('create vehicles')
                                    <a href={{ route('vehicle.create') }}
                                        class="nav-link {{ request()->is('vehicle/create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create Vehicle</p>
                                    </a>
                                @endcan
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan
            @can('schedule members')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview menu-{{ request()->is('member_schedule*') ? 'open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('member_schedule*') ? 'active' : '' }}">

                            <i class="nav-icon fas fa-calendar"></i>
                            <p>
                                Schedules
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview bg-secondary rounded-lg">
                            <li class="nav-item">
                                <a href={{ route('member_schedule.index') }}
                                    class="nav-link {{ request()->is('member_schedule/index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jadual Operasi HQ</p>
                                </a>
                                <a href={{ route('member_schedule.jb_index') }}
                                    class="nav-link {{ request()->is('member_schedule/index/jb') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jadual Operasi JB</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview bg-secondary rounded-lg">
                            <li class="nav-item">
                                <a href={{ route('vehicle_schedule.index') }}
                                    class="nav-link {{ request()->is('vehicle_schedule/index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>  Vehicles</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan
            {{-- @can('list daily reports') --}}

                <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href={{ route('daily_report.index') }}
                            class="nav-link {{ request()->is('daily_report/*') ? 'active' : '' }}">
                            <i class=" fas fa-file nav-icon"></i>
                            <p>
                                Daily Reports
                            </p>
                        </a>
                    </li>
                </ul>

            {{-- @endcan --}}
        </nav>
    </div>
</aside>
