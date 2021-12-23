<aside class="main-sidebar sidebar-dark-purple elevation-4">
    <a href={{ route('home') }} class="brand-link">
        <img src={{ asset('img/logo-um.png') }} alt="University Malaya Logo" class="brand-image img-square elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">University Malaya</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src={{ asset('img/user.png') }} class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/profile" class="d-block">{{ Auth()->user()->name }}
                </a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class=" fas fa-home nav-icon"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

        @can('user_management_access')
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li
                class="nav-item has-treeview menu-{{ request()->is('user*') ?  'open' :( request()->is('student*') ?  'open' : '') }}">
                <a href="#"
                    class="nav-link {{ request()->is('user*') ?  'active' : ( request()->is('student*') ?  'active' : '') }}">
                    <i class="fas fa-user nav-icon"></i>
                    <p>
                        User Management
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview bg-secondary rounded-lg">
                    @can('user_access')
                    <li class="nav-item">
                        <a href={{ route('user.index') }}
                            class="nav-link {{ request()->is('user/*') ? 'active' : '' }}">
                            <i class="fas fa-user nav-icon"></i>
                            <p>
                                All Users
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href={{ route('student.index') }}
                            class="nav-link {{ request()->is('student/*') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon"></i>
                            <p>
                                All Students
                            </p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
        </ul>
        @endcan

        @can('question_access')
        <ul class="nav nav-pills nav-sidebar flex-column">
            <li class="nav-item">
                <a href={{ route('question.index') }}
                    class="nav-link {{ request()->is('question/index') ? 'active' : '' }}">
                    <i class="fas fa-question nav-icon"></i>
                    <p>
                        Questions
                    </p>
                </a>
            </li>
        </ul>
        @endcan


        @can('result_access')
        <ul class="nav nav-pills nav-sidebar flex-column">
            <li class="nav-item">
                <a href={{ route('result.index') }}
                    class="nav-link {{ request()->is('result/index') ? 'active' : '' }}">
                    <i class="fas fa-file-alt nav-icon"></i>
                    <p>
                        Results
                    </p>
                </a>
            </li>
        </ul>
        @endcan

        @can('result_show')
        <ul class="nav nav-pills nav-sidebar flex-column">
            <li class="nav-item">
                <a href={{ route('test.result') }} class="nav-link {{ request()->is('test/result') ? 'active' : '' }}">
                    <i class="fas fa-file-alt nav-icon"></i>
                    <p>
                        Results
                    </p>
                </a>
            </li>
        </ul>
        @endcan


        @can('access_test')
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview menu-{{ request()->is('test*') ? 'open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('test*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt nav-icon"></i>
                    <p>
                        Personality Assessment
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview bg-secondary rounded-lg">
                    <li class="nav-item">
                        <a href="{{ route('test.start') }}"
                            class="nav-link {{ request()->is('test/start') ? 'active' : '' }}">
                            <i class=" fas fa-edit nav-icon"></i>
                            <p>
                                Take Test
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('test.result') }}"
                            class="nav-link {{ request()->is('test/result') ? 'active' : '' }}">
                            <i class=" fas fa-file nav-icon"></i>
                            <p>
                                Result
                            </p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        @endcan

    </div>
</aside>