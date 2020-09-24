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
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Bookings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{route('booking.index')}} class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Bookings</p>
                            </a>
                            <a href={{route('booking.create')}} class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Bookings</p>
                            </a>
                        </li>
                    </ul>  
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Customers
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{route('customer.index')}} class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Customers</p>
                            </a>
                            <a href={{route('customer.create')}} class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Customers</p>
                            </a>
                        </li>
                    </ul>  
                </li>
            </ul>
        </nav>
    </div>
</aside>