<div class="sidebar-wrapper">
    {{-- header user @S --}}
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
                @if(Auth()->user()->user_role == 'student')
                <a href="{{ url('students/profile/myprofile') }}">
                    <h5>{{Auth()->user()->name}}</h5>
                </a>
                @elseif(Auth()->user()->user_role == 'instructor')
                <a href="{{ url('instructor/profile/myprofile') }}">
                    <h5>{{Auth()->user()->name}}</h5>
                </a>
                @elseif(Auth()->user()->user_role == 'admin')
                <a href="{{ url('admin/profile/myprofile') }}">
                    <h5>{{Auth()->user()->name}}</h5>
                </a>
                @endif
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
    {{-- header user @E --}}

    {{-- sidebar menu @S --}}
    <div class="sidebar-nav-area">
        <ul class="menubar">
            {{-- instructor menu link @S --}}
            @if(Auth::user()->user_role == 'instructor')
            <li class="menu-item">
                <a href="{{ url('/instructor/dashboard') }}"
                    class="{{ Request::is('instructor/dashboard')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @can('subscription.check')
            <li class="menu-item">
                <a href="{{ url('instructor/courses') }}"
                    class="{{ Request::is('instructor/courses*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>Courses</span>
                    <i class="fa-solid fa-caret-right"></i>
                </a>
                {{-- inner submenu @S --}}
                @include('e-learning/course/partials/sub-sidebar')
                {{-- inner submenu @E --}}
            </li>
            <li class="menu-item">
                <a href="{{ url('instructor/bundle/courses') }}"
                    class="{{ Request::is('instructor/bundle/courses*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-cubes"></i>
                    <span>Bundle Course</span>
                    <i class="fa-solid fa-caret-right"></i>
                </a>
                @include('bundle/partials/sub-sidebar')
            </li>
            <li class="menu-item">
                <a href="{{ url('instructor/students') }}"
                    class="{{ Request::is('instructor/students*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-user-group"></i>
                    <span>Students</span>
                    <i class="fa-solid fa-caret-right"></i>
                </a>
                @include('students/partials/sub-sidebar')
            </li>
            <li class="menu-item">
                <a href="{{ url('instructor/payments') }}"
                    class="{{ Request::is('instructor/payments')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-euro-sign"></i>
                    <span>Earning</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('course/messages') }}"
                    class="{{ Request::is('course/messages')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-euro-sign"></i>
                    <span>Messaging</span>
                </a>
            </li>
            @endcan 
            <li class="menu-item">
                <a href="{{ route('module.setting', auth()->user()->id) }}"
                    class="{{ Request::is('instructor/theme/setting*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                    <span>Theme Setting</span>
                </a>
            </li>
            {{-- student menu link @S --}}
            @elseif(Auth::user()->user_role == 'students' || Auth::user()->user_role == 'student')
            <li class="menu-item">
                <a href="{{ url('students/dashboard') }}"
                    class="{{ Request::is('students/dashboard')  ? ' active' : '' }} menu-link"> 
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('students/home') }}"
                    class="{{ Request::is('students/home*') || Request::is('students/courses*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-house-circle-check"></i>
                    <span>Home</span>
                </a>
            </li> 
            <li class="menu-item">
                <a href="{{ url('students/dashboard/enrolled') }}"
                    class="{{ Request::is('students/dashboard/enrolled*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-handshake"></i>
                    <span>Enrolled</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('/course/messages') }}"
                    class="{{ Request::is('/course/messages*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-handshake"></i>
                    <span>Messaging</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('/students/account-management') }}" class="{{ Request::is('students/account-management*')  ? ' active' : '' }} menu-link">
                    <i class="fas fa-gear"></i>
                    <span>Settings</span>
                </a>
            </li>
            {{-- admin menu link @S --}}
            @elseif(Auth::user()->user_role == 'admin')
            <li class="menu-item">
                <a href="{{ url('admin/dashboard') }}"
                    class="{{ Request::is('admin/dashboard*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('admin/alladmin') }}"
                    class="{{ Request::is('admin/alladmin*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-users-viewfinder"></i>
                    <span>Admin</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('admin/instructor') }}"
                    class="{{ Request::is('admin/instructor*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-user-group"></i>
                    <span>Instructor</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('admin/students') }}"
                    class="{{ Request::is('admin/students*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-users"></i>
                    <span>Students</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('admin.subscription') }}"
                    class="{{ Request::is('admin/manage/subscriptionpackage*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-cube"></i>
                    <span>Memberships</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>E-Learning</span>
                    <i class="fa-solid fa-caret-right"></i>
                </a>
                @include('e-learning/course/admin/partials/sub-sidebar')
            </li>
            <li class="menu-item">
                <a href="{{ url('/admin/profile/platform-fee') }}"
                    class="{{ Request::is('admin/profile/platform-fee*')  ? ' active' : '' }} menu-link">
                    <i class="fas fa-euro-sign"></i> <span>Platform Fee</span>
                </a>
            </li>
            {{-- admin menu link @E --}}
            @endif
            <li class="menu-item">
                <a class="menu-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                   <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>{{ __('Logout') }}</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    {{-- sidebar menu @E --}}
</div>