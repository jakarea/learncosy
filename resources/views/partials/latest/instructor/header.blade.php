<nav class="navbar navbar-expand-xl header-area">
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
            @can('instructor')
            <ul class="navbar-nav m-auto"> 
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}" class="{{ Request::is('admin/dashboard*')  ? ' active' : '' }} nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('admin/alladmin*')  ? ' active' : '' }} nav-link" href="{{ url('admin/alladmin') }}">Analytics</a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link" href="#">Courses <i class="fas fa-angle-down"></i></a>
                    <ul class="submenu-box">
                        <li><a href="{{ url('admin/courses') }}">All Courses</a></li>
                        <li><a href="{{ url('admin/bundle/courses') }}">Add New Course</a></li> 
                    </ul>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="#">Bundle Course <i class="fas fa-angle-down"></i></a>
                    <ul class="submenu-box">
                        <li><a href="{{ url('admin/courses') }}">All Bundle Courses</a></li>
                        <li><a href="{{ url('admin/bundle/courses') }}">Create Bundle Course</a></li> 
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Students <i class="fas fa-angle-down"></i></a>
                    <ul class="submenu-box">
                        <li><a href="{{ url('admin/courses') }}">All Students</a></li> 
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('admin/profile/platform-fee*')  ? ' active' : '' }} nav-link" href="#">Earning</a>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('admin/profile/platform-fee*')  ? ' active' : '' }} nav-link" href="#">Messaging</a>
                </li>
            </ul>
            @endcan
            <div class="d-flex"> 
                <div class="dropdown">
                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('latest/assets/images/icons/settings.svg')}}" alt="a"
                            class="img-fluid">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{url('/admin/profile/myprofile')}}">My Profile</a></li>  
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a> 
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </li> 
                    </ul>
                </div> 
                <a href="#" class="avatar">
                    @if(auth()->user()->avatar)
                        @if(auth()->user()->user_role == 'student')
                        <img src="{{ asset('assets/images/students/'.auth()->user()->avatar) }}" alt="{{auth()->user()->name}}"
                            class="img-fluid">
                        @elseif(auth()->user()->user_role == 'instructor')
                        <img src="{{ asset('assets/images/instructor/'.auth()->user()->avatar) }}" alt="{{auth()->user()->name}}"
                            class="img-fluid">
                        @elseif(auth()->user()->user_role == 'admin')
                        <img src="{{ asset('assets/images/admin/'.auth()->user()->avatar) }}" alt="{{auth()->user()->name}}"
                            class="img-fluid">
                        @endif
                    @else
                        <span class="avatar-user">{!! strtoupper(auth()->user()->name[0]) !!}</span>
                    @endif 
                </a>
            </div>
        </div>
    </div>
</nav>