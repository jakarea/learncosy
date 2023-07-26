<nav class="navbar navbar-expand-lg header-area">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{asset('latest/assets/images/logo.svg')}}" alt="Logo" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto"> 
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}" class="{{ Request::is('admin/dashboard*')  ? ' active' : '' }} nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('admin/alladmin*')  ? ' active' : '' }} nav-link" href="{{ url('admin/alladmin') }}">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('admin/instructor*')  ? ' active' : '' }} nav-link" href="{{ url('admin/instructor') }}">Instructor</a>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('admin/students*')  ? ' active' : '' }} nav-link" href="{{ url('admin/students') }}">Students</a>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('admin.subscription*')  ? ' active' : '' }} nav-link" href="{{ route('admin.subscription') }}">Memberships</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">E-Learning <i class="fas fa-angle-down"></i></a>
                    <ul class="submenu-box">
                        <li><a href="{{ url('admin/courses') }}">All Courses</a></li>
                        <li><a href="{{ url('admin/bundle/courses') }}">All Bundle Courses</a></li>
                        <li><a href="{{ url('admin/modules') }}">All Modules</a></li>
                        <li><a href="{{ url('admin/lessons') }}">All Lessons</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('admin/profile/platform-fee*')  ? ' active' : '' }} nav-link" href="{{ url('/admin/profile/platform-fee') }}">Platform Fee</a>
                </li>
            </ul>
            <div class="d-flex"> 
                <div class="dropdown">
                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('latest/assets/images/icons/settings.svg')}}" alt="a"
                            class="img-fluid">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{url('/admin/profile/myprofile')}}">My Profile</a></li> 
                        <li><a class="dropdown-item" href="#">Settings</a></li> 
                    </ul>
                </div>

                <a href="#" class="bttn">
                    <span>5</span>
                    <img src="{{asset('latest/assets/images/icons/bell.svg')}}" alt="a" class="img-fluid">
                </a>
                <a href="#" class="avatar">
                    <img src="{{asset('latest/assets/images/avatar.png')}}" alt="a" class="img-fluid">
                </a>
            </div>
        </div>
    </div>
</nav>