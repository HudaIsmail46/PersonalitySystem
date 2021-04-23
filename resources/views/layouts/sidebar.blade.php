<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href={{ route('home') }} class="brand-link">
        <img src={{ asset('img/logo-um.png') }} alt="University Malaya Logo"
            class="brand-image img-square elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">University Malaya</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src={{ asset('img/user.png') }} class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">User </a>
            </div>
        </div>
        <nav class="mt-2">
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
        </nav>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview menu-{{ request()->is('question*') ? 'open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('question*') ? 'active' : '' }}">
                    <i class="fas fa-user-circle nav-icon"></i>
                    <p>
                        Questions
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview bg-secondary rounded-lg">
                    <li class="nav-item">
                        <a href={{ route('question.index') }}
                            class="nav-link {{ request()->is('question/index') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Questions</p>
                        </a>
                        <a href={{ route('question.create') }}
                            class="nav-link {{ request()->is('question/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>

                            <p>Create Questions</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
