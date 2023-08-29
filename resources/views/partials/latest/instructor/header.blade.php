<nav class="navbar navbar-expand-xl header-area">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{url('/')}}">
            @if ( modulesetting('logo') )
                <img src="{{asset('assets/images/setting/'.modulesetting('logo'))}}" alt="Logo" class="img-fluid">
            @else
                <img src="{{asset('latest/assets/images/black-logo.png')}}" alt="Logo" class="img-fluid">
            @endif
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
                    <a href="{{ url('instructor/dashboard') }}" class="{{ Request::is('instructor/dashboard*')  ? ' active' : '' }} nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('instructor/analytics*')  ? ' active' : '' }} nav-link" href="{{ url('instructor/analytics') }}">Analytics</a>
                </li>  
                <li class="nav-item">
                    <a class="{{ Request::is('instructor/courses*')  ? ' active' : '' }} nav-link" href="#">Courses <i class="fas fa-angle-down"></i></a>
                    <ul class="submenu-box">
                        <li><a href="{{ url('instructor/courses') }}" class="{{ Request::is('instructor/courses')  ? ' active' : '' }}">All Courses</a></li>
                        <li><a href="{{ url('instructor/courses/create/step-1') }}" class="{{ Request::is('instructor/courses/create')  ? ' active' : '' }}">Add New Course</a></li> 
                    </ul>
                </li> 
                <li class="nav-item">
                    <a class="{{ Request::is('instructor/bundle/courses*')  ? ' active' : '' }} nav-link" href="#">Bundle Course <i class="fas fa-angle-down"></i></a>
                    <ul class="submenu-box">
                        <li><a href="{{ url('instructor/bundle/courses') }}" class="{{ Request::is('instructor/bundle/courses')  ? ' active' : '' }}"> All Bundle Courses</a></li>
                        <li><a href="{{ url('instructor/bundle/courses/select/course/2') }}" class="{{ Request::is('instructor/bundle/courses/create')  ? ' active' : '' }}">Add New Bundle Course</a></li> 
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('instructor/students*')  ? ' active' : '' }} nav-link" href="#">Students <i class="fas fa-angle-down"></i></a>
                    <ul class="submenu-box">
                        <li><a href="{{ url('instructor/students') }}">All Students</a></li> 
                        <li><a href="{{ url('instructor/students/create') }}">Add New Students</a></li> 
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('instructor/payments*')  ? ' active' : '' }} nav-link" href="{{ url('instructor/payments') }}">Earning</a>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('course/messages*')  ? ' active' : '' }} nav-link" href="{{ url('course/messages') }}">Messaging</a>
                </li>
            </ul>
            @endcan
            <div class="d-flex"> 
                <a href="#" class="bttn">
                    <img src="{{asset('latest/assets/images/icons/search.svg')}}" alt="S" class="img-fluid">
                </a>
                <a href="#" class="bttn">
                    <img src="{{asset('latest/assets/images/icons/notification.svg')}}" alt="S" class="img-fluid">
                    <span>5</span>
                </a>
                <div class="dropdown">
                    <button class="btn avatar" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(auth()->user()->avatar)
                            @if(auth()->user()->user_role == 'instructor')
                            <img src="{{ asset('assets/images/users/'.auth()->user()->avatar) }}" alt="{{auth()->user()->name}}" class="img-fluid"> 
                            @endif
                        @else
                            <span class="avatar-user">{!! strtoupper(auth()->user()->name[0]) !!}</span>
                        @endif 
                    </button> 
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{url('/instructor/profile/myprofile')}}">Profile</a></li>  
                        <li><a class="dropdown-item" href="{{url('/instructor/profile/edit')}}">Account Settings</a></li>  
                        <li><a class="dropdown-item" href="{{ url('/instructor/theme/setting/dns/'.auth::user()->id) }}">Theme Setting</a></li>
                        <li><a class="dropdown-item" href="{{ url('/instructor/theme/setting/dns/'.auth::user()->id) }}">DNS</a></li>
                        <li> <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a> 
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