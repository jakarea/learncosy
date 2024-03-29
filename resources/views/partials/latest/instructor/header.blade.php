<nav class="navbar navbar-expand-xl header-area">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/instructor/dashboard') }}">
            @if (modulesetting('logo'))
                <img src="{{ asset(modulesetting('logo')) }}" alt="Logo 23" class="img-fluid">
            @else
                <img src="{{ asset('latest/assets/images/black-logo.svg') }}" alt="Logo" class="img-fluid light-ele">
                <img src="{{ asset('latest/assets/images/dark-logo.svg') }}" alt="Logo" class="img-fluid dark-ele">
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @can('instructor')
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a href="{{ url('instructor/dashboard') }}" class="{{ Request::is('instructor/dashboard*') ? ' active' : '' }} nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::is('instructor/analytics*') ? ' active' : '' }} nav-link"
                            href="{{ url('instructor/analytics') }}">Analytics</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::is('instructor/courses*') ? ' active' : '' }} nav-link" href="#">Courses
                            <i class="fas fa-angle-down"></i></a>
                        <ul class="submenu-box">
                            <li><a href="{{ url('instructor/courses') }}" class="{{ Request::is('instructor/courses') ? ' active' : '' }}">All Courses</a></li>
                            <li><a href="{{ url('instructor/courses/create') }}" class="{{ Request::is('instructor/courses/create') ? ' active' : '' }}">Add New Course</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::is('instructor/bundle/courses*') ? ' active' : '' }} nav-link"
                            href="#">Bundle Course <i class="fas fa-angle-down"></i></a>
                        <ul class="submenu-box">
                            <li><a href="{{ url('instructor/bundle/courses') }}"
                                    class="{{ Request::is('instructor/bundle/courses') ? ' active' : '' }}"> All Bundle
                                    Courses</a></li>
                            <li><a href="{{ url('instructor/bundle/courses/select') }}"
                                    class="{{ Request::is('instructor/bundle/courses/select') ? ' active' : '' }}">Add New
                                    Bundle Course</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::is('instructor/students*') ? ' active' : '' }} nav-link"
                            href="#">Students <i class="fas fa-angle-down"></i></a>
                        <ul class="submenu-box">
                            <li><a href="{{ url('instructor/students') }}" class="{{ Request::is('instructor/students') ? ' active' : '' }}">All Students</a></li>
                            <li><a href="{{ url('instructor/students/create') }}" class="{{ Request::is('instructor/students/create') ? ' active' : '' }}">Add New Students</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::is('instructor/payments*') ? ' active' : '' }} nav-link"
                            href="{{ url('instructor/payments') }}">Earning</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::is('messages*') ? ' active' : '' }} nav-link"
                            href="{{ url('messages') }}">Messaging</a>
                    </li>

                    @if(session()->has('userId'))
                        <li class="nav-item">
                            <a class="{{ Request::is('back-to-pavilion/') ? ' active' : '' }} nav-link"
                                href="{{ route('backto-pavilion', ['userId' => session('userId')])}}">Back to {{ ucfirst(session('userRole')) }}</a>
                        </li>
                    @endif
                </ul>
            @endcan
            <div class="d-flex">
                <a href="{{ url('instructor/courses') }}" class="bttn">
                    <img src="{{ asset('latest/assets/images/icons/search.svg') }}" alt="icon" class="img-fluid">
                </a>
                <a href="{{ url('instructor/notifications') }}" class="bttn {{ Request::is('instructor/notifications') ? ' active' : '' }}">
                    <img src="{{ asset('latest/assets/images/icons/notification.svg') }}" alt="icon"
                        class="img-fluid">
                    {{-- <span>0</span> --}}
                </a>
                <div class="dropdown">
                    <button class="btn avatar" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if (auth()->user()->avatar)
                            @if (auth()->user()->user_role == 'instructor')
                                <img src="{{ asset(auth()->user()->avatar) }}"
                                    alt="{{ auth()->user()->name }}" class="img-fluid">
                            @endif
                        @else
                            <span class="avatar-user">{!! strtoupper(auth()->user()->name[0]) !!}</span>
                        @endif
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item {{ Request::is('instructor/profile/myprofile*') ? ' active' : '' }}" href="{{ url('/instructor/profile/myprofile') }}">Profile</a></li>
                        <li><a class="dropdown-item {{ Request::is('instructor/profile/account-settings*') ? ' active' : '' }}" href="{{ url('/instructor/profile/account-settings') }}">Account Settings</a></li>
                        <li><a class="dropdown-item {{ Request::is('instructor/subscription*') ? ' active' : '' }}" href="{{ url('/instructor/subscription') }}">Subscription Plan</a></li>
                        <li><a class="dropdown-item {{ Request::routeIs('module.setting.dns') ? 'active' : '' }}" href="{{ url('/instructor/theme/setting/dns') }}">Theme Setting</a></li>
                        <li><a class="dropdown-item  {{ Request::is('instructor/manage-access*') ? ' active' : '' }}" href="{{ url('/instructor/manage-access') }}">Manage Pages</a></li>
                        <li><a class="dropdown-item {{ Request::routeIs('module.setting.dns', ['instructor' => 'value', 'tab' => 'dns']) ? 'active' : '' }}" href="{{ route('module.setting.dns', ['subdomain' => config('app.subdomain') ,'instructor' => 'value', 'tab' => 'dns']) }}">DNS</a></li>
                        <li> <a class="dropdown-item" href="{{ url('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }} </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
