<aside class="sidebar-wrapper new-sidebar-wrap">

    <div class="header-user-box">
        <div class="media">
            @if(Auth()->user()->avatar)
            @if(Auth()->user()->user_role == 'student')
            <img src="{{ asset('assets/images/students/'.Auth()->user()->avatar) }}" alt="{{Auth()->user()->name}}"
                class="img-fluid">
            @elseif(Auth()->user()->user_role == 'instructor')
            <img src="{{ asset('assets/images/instructor/'.Auth()->user()->avatar) }}" alt="{{Auth()->user()->name}}"
                class="img-fluid">
            @elseif(Auth()->user()->user_role == 'admin')
            <img src="{{ asset('assets/images/admin/'.Auth()->user()->avatar) }}" alt="{{Auth()->user()->name}}"
                class="img-fluid">
            @endif
            @else
            <span class="avatar-user">{!! strtoupper(Auth()->user()->name[0]) !!}</span>
            @endif
            <div class="media-body">
                <h5>{{Auth()->user()->name}}</h5>
                <p>{{Auth()->user()->user_role}} &nbsp;
                    @if(Auth::user()->user_role == 'instructor')
                    @can('subscription.check')
                    <span class="badge badge-success bg-success upgrade-text position-absolute left-0">Premium</span>
                    @else
                    <a href="{{ route('instructor.subscription') }}">
                        <span class="badge badge-danger bg-danger upgrade-text position-absolute left-0" style="right: 30%;bottom: 45px;
                        ">Upgrade</span>
                    </a>
                    @endcan
                    @endif
                </p>
            </div>
        </div>

    </div>
    <!-- main menu @s -->
    <div class="main-sidebar-menu ">
        <h5>Main Menu</h5>
        <ul class="top-menu-box">
            @if(Auth::user()->user_role == 'admin')
            <li class="menu-item">
                <a href="{{ url('admin/dashboard') }}" class="{{ Request::is('admin/dashboard*')  ? ' active' : '' }} menu-link">
                    <img src="{{asset('dashboard-assets/images/sidebar-icon/dashboard.svg')}}" alt="Dashboard"
                        class="img-fluid">
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('admin/instructor') }}"
                    class="{{ Request::is('admin/instructor*')  ? ' active' : '' }}  menu-link">
                    <i class="fa-solid fa-user-group left-icon"></i>
                    <span>Instructor</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('admin/students') }}" class="{{ Request::is('admin/students*')  ? ' active' : '' }}  menu-link">
                    <i class="fa-solid fa-user-group left-icon"></i>
                    <span>Students</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('admin.subscription') }}"
                    class="{{ Request::is('admin/manage/subscriptionpackage*')  ? ' active' : '' }}  menu-link">
                    <i class="fa-solid fa-box left-icon"></i>
                    <span>Memberships</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <img src="{{asset('dashboard-assets/images/sidebar-icon/graph.svg')}}" alt="Dashboard"
                        class="img-fluid">
                    <span>E-Learning</span>
                    <i class="fas fa-caret-right"></i>
                </a>
                <ul class="new-submenu-wrapper">
                    <li>
                        <a href="{{ url('admin/courses') }}"
                            class="{{ Request::is('admin/courses')  ? ' active' : '' }}">
                            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2">
                            All Courses </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/bundle/courses') }}"
                            class="{{ Request::is('admin/bundle/courses*')  ? ' active' : '' }}">
                            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2">
                            All Bundle Courses </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/modules') }}"
                            class="{{ Request::is('admin/modules')  ? ' active' : '' }}">
                            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2">
                            All Modules </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/lessons') }}"
                            class="{{ Request::is('admin/lessons')  ? ' active' : '' }}">
                            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2">
                            All Lessons </a>
                    </li>
                </ul>
            </li>
            @elseif(Auth::user()->user_role == 'instructor')

            @elseif(Auth::user()->user_role == 'students')

            @endif
        </ul>
    </div>
    <!-- main menu @e -->

    <!-- learn more box @s -->
    <div class="learn-more-box">
        <h5>How codebytes control your task?</h5>
        <a href="#">Learn more <i class="fas fa-caret-right"></i></a>
    </div>
    <!-- learn more box @e -->

    <!-- sidebar ftr txt @s -->
    <div class="sidebar-ftr-txt">
        <h6>LearnCosy</h6>
        <p>&copy; 2023 All Rights Reserved</p>
    </div>
    <!-- sidebar ftr txt @e -->
</aside>