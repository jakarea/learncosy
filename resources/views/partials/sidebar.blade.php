<div class="sidebar-wrapper"> 
    {{-- header user @S --}}
    <div class="header-user-box">
        <div class="media"> 
            @if(Auth()->user()->avatar)
            @if(Auth()->user()->user_role == 'students')
            <img src="{{ asset('assets/images/students/'.Auth()->user()->avatar) }}" alt="{{Auth()->user()->name}}" class="img-fluid">
            @elseif(Auth()->user()->user_role == 'instructor')
            <img src="{{ asset('assets/images/instructor/'.Auth()->user()->avatar) }}" alt="{{Auth()->user()->name}}" class="img-fluid">
            @endif
            @else
            <span>{!! strtoupper(Auth()->user()->name[0]) !!}</span>
            @endif 
            <div class="media-body">
                <h5>{{Auth()->user()->name}}</h5>
                <p>{{Auth()->user()->user_role}}</p>
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
                <a href="{{ url('/') }}" class="{{ Request::is('/')  ? ' active' : '' }} menu-link">
                    <img src="{{ asset('assets/images/dashboard-icon.svg') }}" alt="Dashboard" title="Dashboard" class="img-fluid" />
                    <span>Dashboard</span> 
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('instructor/courses') }}" class="{{ Request::is('instructor/courses*')  ? ' active' : '' }} menu-link">
                    <img src="{{ asset('assets/images/elearning-icon.svg') }}" alt="E Learning" title="E Learning" class="img-fluid" />
                    <span>Courses</span>
                    <i class="fa-solid fa-angles-right"></i>
                </a>
                {{-- inner submenu @S --}}
                 @include('e-learning/course/partials/sub-sidebar')
               {{-- inner submenu @E --}}
            </li>  
            <li class="menu-item">
                <a href="{{ url('instructor/bundle/courses') }}" class="{{ Request::is('instructor/bundle/courses*')  ? ' active' : '' }} menu-link">
                    <img src="{{ asset('assets/images/adspy-icon.svg') }}" alt="Adspy" title="Adspy" class="img-fluid" />
                    <span>Bundle Course</span>
                    <i class="fa-solid fa-angles-right"></i>
                </a> 
                 @include('bundle/partials/sub-sidebar') 
            </li>   
            <li class="menu-item">
                <a href="{{ url('instructor/students') }}" class="{{ Request::is('instructor/students*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-user-group"></i>
                    <span>Students</span>
                    <i class="fa-solid fa-angles-right"></i>
                </a> 
                 @include('students/partials/sub-sidebar') 
            </li>   
            <li class="menu-item">
                <a href="#" class="{{ Request::is('settings*')  ? ' active' : '' }} menu-link"> 
                   <img src="{{ asset('assets/images/settings-icon.svg') }}" alt="Logout" title="Logout" class="img-fluid" />
                    <span>Settings</span>
                    <i class="fa-solid fa-angles-right"></i>
                </a> 
                 @include('settings/partials/sub-sidebar') 
            </li> 
            {{-- instructor menu link @E --}}

            {{-- student menu link @S --}}
            @elseif(Auth::user()->user_role == 'students')
            <li class="menu-item">
                <a href="{{ url('students/dashboard') }}" class="{{ Request::is('students/dashboard*')  ? ' active' : '' }} menu-link">
                    <img src="{{ asset('assets/images/dashboard-icon.svg') }}" alt="dashboard" title="dashboard" class="img-fluid" />
                    <span>Dashboard</span> 
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('students/home') }}" class="{{ Request::is('students/home*')  ? ' active' : '' }} menu-link">
                    <img src="{{ asset('assets/images/dashboard-icon.svg') }}" alt="Home" title="Home" class="img-fluid" />
                    <span>Home</span> 
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('students/courses/catalog') }}" class="{{ Request::is('students/courses/catalog*')  ? ' active' : '' }} menu-link">
                    <img src="{{ asset('assets/images/adspy-icon.svg') }}" alt="Catalog" title="Catalog" class="img-fluid" />
                    <span>Course Catalog </span> 
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('students/account-management') }}" class="{{ Request::is('students/account-management*')  ? ' active' : '' }} menu-link">
                    <img src="{{ asset('assets/images/settings-icon.svg') }}" alt="Logout" title="Logout" class="img-fluid" />
                    <span>Account Management </span> 
                </a>
            </li>
            {{-- student menu link @E --}}
            @endif
            <li class="menu-item">
                <a class="menu-link bg-white" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <img src="{{ asset('assets/images/logout-icon.svg') }}" alt="Logout" title="Logout" class="img-fluid" />
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