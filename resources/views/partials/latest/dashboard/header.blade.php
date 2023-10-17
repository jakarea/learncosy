<nav class="navbar navbar-expand-xl header-area">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('latest/assets/images/black-logo.svg') }}" alt="Logo" class="img-fluid light-ele">
            <img src="{{ asset('latest/assets/images/dark-logo.svg') }}" alt="Logo" class="img-fluid dark-ele">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @can('admin')
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a href="{{ url('admin/dashboard') }}"
                            class="{{ Request::is('admin/dashboard*') ? ' active' : '' }} nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::is('admin/alladmin*') ? ' active' : '' }} nav-link"
                            href="{{ url('admin/alladmin') }}">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::is('admin/instructor*') ? ' active' : '' }} nav-link"
                            href="{{ url('admin/instructor') }}">Instructor</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::is('admin/students*') ? ' active' : '' }} nav-link"
                            href="{{ url('admin/students') }}">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::is('admin/manage/subscriptionpackage*') ? ' active' : '' }} nav-link"
                            href="{{ route('admin.subscription') }}">Memberships</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::is('admin/courses*') || Request::is('admin/bundle/courses*') ? ' active' : '' }} nav-link" href="#">E-Learning <i class="fas fa-angle-down"></i></a>
                        <ul class="submenu-box">
                            <li><a href="{{ url('admin/courses') }}">All Courses</a></li>
                            <li><a href="{{ url('admin/bundle/courses') }}">All Bundle Courses</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="{{ Request::is('admin/profile/platform-fee*') ? ' active' : '' }} nav-link"
                            href="{{ url('/admin/profile/platform-fee') }}">Platform Fee</a>
                    </li>
                </ul>
            @endcan
            <div class="d-flex">
                <a href="#" class="bttn">
                    <img src="{{ asset('latest/assets/images/icons/search.svg') }}" alt="Search icon"
                        class="img-fluid">
                </a>
                <a href="#" class="bttn">
                    <img src="{{ asset('latest/assets/images/icons/notification.svg') }}" alt="Notification icon"
                        class="img-fluid">
                    <span>0</span>
                </a>
                <div class="dropdown">
                    <button class="btn avatar" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if (auth()->user()->avatar)
                            <img src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                                class="img-fluid">
                        @else
                            <span class="avatar-user">{!! strtoupper(auth()->user()->name[0]) !!}</span>
                        @endif
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('admin/profile/myprofile') }}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ url('admin/profile/edit') }}">Account Settings</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }} </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</nav>
