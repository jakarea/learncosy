<aside class="sidebar-wrapper">

    <div class="header-user-box">
        <div class="media"> 
            @if(Auth()->user()->avatar)
                @if(Auth()->user()->user_role == 'student')
                <img src="{{ asset('assets/images/students/'.Auth()->user()->avatar) }}" alt="{{Auth()->user()->name}}" class="img-fluid">
                @elseif(Auth()->user()->user_role == 'instructor')
                <img src="{{ asset('assets/images/instructor/'.Auth()->user()->avatar) }}" alt="{{Auth()->user()->name}}" class="img-fluid">
                @elseif(Auth()->user()->user_role == 'admin')
                <img src="{{ asset('assets/images/admin/'.Auth()->user()->avatar) }}" alt="{{Auth()->user()->name}}" class="img-fluid">
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
    <div class="main-sidebar-menu pt-2">
      <h5>Main Menu</h5>
       
      <ul> 
        {{-- instructor menu link @S --}}
        @if(Auth::user()->user_role == 'instructor')
        <li>
            <a href="{{ url('/') }}" class="{{ Request::is('/')  ? ' active' : '' }}">
                <img src="{{ asset('assets/images/dashboard-icon.svg') }}" alt="Dashboard" title="Dashboard" class="img-fluid" />
                <span class="menu-text">Dashboard</span> 
            </a>
        </li>
        @can('subscription.check')
        <li>
            <a href="{{ url('instructor/courses') }}" class="{{ Request::is('instructor/courses*')  ? ' active' : '' }}">
                <img src="{{ asset('assets/images/elearning-icon.svg') }}" alt="E Learning" title="E Learning" class="img-fluid" />
                <span class="menu-text">Courses</span>
                <i class="fa-solid fa-angles-right"></i>
            </a>
            {{-- inner submenu @S --}}
             @include('e-learning/course/partials/sub-sidebar')
           {{-- inner submenu @E --}}
        </li>  
        <li>
            <a href="{{ url('instructor/bundle/courses') }}" class="{{ Request::is('instructor/bundle/courses*')  ? ' active' : '' }}">
                <img src="{{ asset('assets/images/adspy-icon.svg') }}" alt="Adspy" title="Adspy" class="img-fluid" />
                <span class="menu-text">Bundle Course</span>
                <i class="fa-solid fa-angles-right"></i>
            </a> 
             @include('bundle/partials/sub-sidebar') 
        </li>   
        <li>
            <a href="{{ url('instructor/students') }}" class="{{ Request::is('instructor/students*')  ? ' active' : '' }}">
                <i class="fa-solid fa-user-group"></i>
                <span class="menu-text">Students</span>
                <i class="fa-solid fa-angles-right"></i>
            </a> 
             @include('students/partials/sub-sidebar') 
        </li>  
        
        <li>
            <a href="{{ url('instructor/payments') }}" class="{{ Request::is('instructor/payments')  ? ' active' : '' }}">
                <i class="fa-solid fa-euro-sign"></i>
                <span class="menu-text">Earning</span>
            </a>  
        </li>
        @endcan  

        {{-- student menu link @S --}}
        @elseif(Auth::user()->user_role == 'students' || Auth::user()->user_role == 'student')
        <li>
            <a href="{{ url('students/dashboard') }}" class="{{ Request::is('/')  ? ' active' : '' }}">
                <img src="{{ asset('assets/images/dashboard-icon.svg') }}" alt="Home" title="Home" class="img-fluid" />
                <span class="menu-text">Dashboard</span> 
            </a>
        </li>
        <li>
            <a href="{{ url('students/dashboard/enrolled') }}" class="{{ Request::is('students/dashboard/enrolled*')  ? ' active' : '' }}">
                <img src="{{ asset('assets/images/dashboard-icon.svg') }}" alt="dashboard" title="dashboard" class="img-fluid" />
                <span class="menu-text">Enrolled</span> 
            </a>
        </li>
        <li>
            <a href="{{ url('students/home') }}" class="{{ Request::is('students/home*')  ? ' active' : '' }}">
                <img src="{{ asset('assets/images/dashboard-icon.svg') }}" alt="Home" title="Home" class="img-fluid" />
                <span class="menu-text">Home</span> 
            </a>
        </li>

        {{-- admin menu link @S --}}
        @elseif(Auth::user()->user_role == 'admin')
        <li>
            <a href="{{ url('admin/dashboard') }}" class="{{ Request::is('admin/dashboard*')  ? ' active' : '' }}">
                <img src="{{ asset('assets/images/dashboard-icon.svg') }}" alt="dashboard" title="dashboard" class="img-fluid" />
                <span class="menu-text">Dashboard</span> 
            </a>
        </li>
        <li>
            <a href="{{ url('admin/instructor') }}" class="{{ Request::is('admin/instructor*')  ? ' active' : '' }}">
                <i class="fa-solid fa-user-group"></i>
                <span class="menu-text">Instructor</span> 
            </a>
        </li>
        <li>
            <a href="{{ url('admin/students') }}" class="{{ Request::is('admin/students*')  ? ' active' : '' }}">
                <i class="fa-solid fa-user-group"></i>
                <span class="menu-text">Students</span> 
            </a>
        </li>
        <li>
            <a href="{{ route('admin.subscription') }}" class="{{ Request::is('admin/manage/subscriptionpackage*')  ? ' active' : '' }}">
                <i class="fa-solid fa-box"></i>
                <span class="menu-text">Memberships</span> 
            </a>
        </li>
        <li>
            <a href="#" class="menu-link">
                <img src="{{ asset('assets/images/adspy-icon.svg') }}" alt="E-Learning" title="E-Learning" class="img-fluid" />
                <span class="menu-text">E-Learning</span>
                <i class="fa-solid fa-angles-right"></i>
            </a> 
             @include('e-learning/course/admin/partials/sub-sidebar') 
        </li> 
        {{-- admin menu link @E --}}
        @endif
        <li>
            <a class="menu-link" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <img src="{{ asset('assets/images/logout-icon.svg') }}" alt="Logout" title="Logout" class="img-fluid" />
                <span class="menu-text">{{ __('Logout') }}</span>
            </a> 
    
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li> 
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
      <h6>Giopio Saas Admin</h6>
      <p>&copy; 2023 All Rights Reserved</p>
    </div>
    <!-- sidebar ftr txt @e -->
  </aside>