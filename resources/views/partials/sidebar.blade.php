<div class="sidebar-wrapper"> 
    {{-- header user @S --}}
    <div class="header-user-box">
        <div class="media"> 
            @if($user->avatar)
            <img src="{{ asset('assets/images/user/'.$user->avatar) }}" alt="{{$user->name}}" class="img-fluid">
            @else
            <span>{!! strtoupper($user->name[0]) !!}</span>
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
            <li class="menu-item">
                <a href="{{ url('/') }}" class="{{ Request::is('/')  ? ' active' : '' }} menu-link">
                    <img src="{{ asset('assets/images/dashboard-icon.svg') }}" alt="Dashboard" title="Dashboard" class="img-fluid" />
                    <span>Dashboard</span> 
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('/course') }}" class="{{ Request::is('course*')  ? ' active' : '' }} menu-link">
                    <img src="{{ asset('assets/images/elearning-icon.svg') }}" alt="E Learning" title="E Learning" class="img-fluid" />
                    <span>Course</span>
                    <i class="fa-solid fa-angles-right"></i>
                </a>
                {{-- inner submenu @S --}}
                 @include('course/partials/sub-sidebar')
               {{-- inner submenu @E --}}
            </li>  
            <li class="menu-item">
                <a href="{{ url('/bundle/course') }}" class="{{ Request::is('bundle/course*')  ? ' active' : '' }} menu-link">
                    <img src="{{ asset('assets/images/adspy-icon.svg') }}" alt="Adspy" title="Adspy" class="img-fluid" />
                    <span>Bundle Course</span>
                    <i class="fa-solid fa-angles-right"></i>
                </a> 
                 @include('bundle/partials/sub-sidebar') 
            </li>  
            {{-- <li class="menu-item">
                <a href="{{ url('/instructors') }}" class="{{ Request::is('instructors*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-user-group"></i>
                    <span>Instructors</span>
                    <i class="fa-solid fa-angles-right"></i>
                </a> 
                 @include('profile/partials/sub-sidebar') 
            </li>    --}}
            <li class="menu-item">
                <a href="{{ url('/students') }}" class="{{ Request::is('students*')  ? ' active' : '' }} menu-link">
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
            @guest
            @else
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
            @endguest
        </ul>
    </div>
    {{-- sidebar menu @E --}}
</div>