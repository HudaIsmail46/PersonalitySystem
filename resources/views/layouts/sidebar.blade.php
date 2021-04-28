<aside class="main-sidebar sidebar-dark-purple elevation-4">
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
                <a href="/profile" class="d-block">User </a>
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
            <li class="nav-item has-treeview menu-{{ request()->is('user*') ? 'open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                    <i class="fas fa-user nav-icon"></i>
                    <p>
                        Users
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview bg-secondary rounded-lg">
                    <li class="nav-item">
                        <a href={{ route('user.index') }}
                            class="nav-link {{ request()->is('user/index') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All users</p>
                        </a>
                        <a href={{ route('user.create') }}
                            class="nav-link {{ request()->is('user/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>

                            <p>Register Users</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview menu-{{ request()->is('student*') ? 'open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('student*') ? 'active' : '' }}">
                    <i class="fas fa-users nav-icon"></i>
                    <p>
                        students
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview bg-secondary rounded-lg">
                    <li class="nav-item">
                        <a href={{ route('student.index') }}
                            class="nav-link {{ request()->is('student/index') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Students</p>
                        </a>
                        <a href={{ route('student.create') }}
                            class="nav-link {{ request()->is('student/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>

                            <p>Register Students</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview menu-{{ request()->is('question*') ? 'open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('question*') ? 'active' : '' }}">
                    <i class="fas fa-question nav-icon"></i>
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

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview menu-{{ request()->is('report*') ? 'open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('report*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt nav-icon"></i>
                    <p>
                        Reports
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview bg-secondary rounded-lg">
                    <li class="nav-item">
                        <a href={{ route('report.index') }}
                            class="nav-link {{ request()->is('report/index') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Reports</p>
                        </a>
                        <a href={{ route('report.create') }}
                            class="nav-link {{ request()->is('report/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>

                            <p>Generate reports</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column">
            <li class="nav-item">
                <a href="{{ route('result.index') }}"
                    class="nav-link {{ request()->is('result/index') ? 'active' : '' }}">
                    <i class=" fas fa-file nav-icon"></i>
                    <p>
                        Students Results
                    </p>
                </a>
            </li>
        </ul>
    </div>
</aside>
