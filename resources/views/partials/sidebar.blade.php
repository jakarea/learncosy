<div class="sidebar-wrapper"> 
    {{-- header user @S --}}
    <div class="header-user-box">
        <div class="media"> 
            @if(Auth()->user()->avatar)
                @if(Auth()->user()->user_role == 'students')
                <img src="{{ asset('assets/images/students/'.Auth()->user()->avatar) }}" alt="{{Auth()->user()->name}}" class="img-fluid">
                @elseif(Auth()->user()->user_role == 'instructor')
                <img src="{{ asset('assets/images/instructor/'.Auth()->user()->avatar) }}" alt="{{Auth()->user()->name}}" class="img-fluid">
                @elseif(Auth()->user()->user_role == 'admin')
                <img src="{{ asset('assets/images/admin/'.Auth()->user()->avatar) }}" alt="{{Auth()->user()->name}}" class="img-fluid">
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
            @can('subscription.check')
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
                <a href="{{ url('instructor/payments') }}" class="{{ Request::is('instructor/payments')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-euro-sign"></i>
                    <span>Payment</span>
                    
                </a> 
                 @include('students/partials/sub-sidebar') 
            </li>
            @endcan  
            <li class="menu-item">
                <a href="{{ url('instructor/payments/platform-fee') }}" class="{{ Request::is('instructor/payments/platform-fee*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-euro-sign"></i>
                    <span>Platform Fee</span>
                    
                </a> 
                 {{-- @include('students/partials/sub-sidebar')  --}}
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
                <a href="{{ url('students/dashboard') }}" class="{{ Request::is('/')  ? ' active' : '' }} menu-link">
                    <img src="{{ asset('assets/images/dashboard-icon.svg') }}" alt="Home" title="Home" class="img-fluid" />
                    <span>Dashboard</span> 
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('students/dashboard/enrolled') }}" class="{{ Request::is('students/dashboard/enrolled*')  ? ' active' : '' }} menu-link">
                    <img src="{{ asset('assets/images/dashboard-icon.svg') }}" alt="dashboard" title="dashboard" class="img-fluid" />
                    <span>Enrolled</span> 
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('students/home') }}" class="{{ Request::is('students/home*')  ? ' active' : '' }} menu-link">
                    <img src="{{ asset('assets/images/dashboard-icon.svg') }}" alt="Home" title="Home" class="img-fluid" />
                    <span>Home</span> 
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('students/catalog/courses') }}" class="{{ Request::is('students/catalog/courses*')  ? ' active' : '' }} menu-link">
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

            {{-- admin menu link @S --}}
            @elseif(Auth::user()->user_role == 'admin')
            <li class="menu-item">
                <a href="{{ url('admin/dashboard') }}" class="{{ Request::is('admin/dashboard*')  ? ' active' : '' }} menu-link">
                    <img src="{{ asset('assets/images/dashboard-icon.svg') }}" alt="dashboard" title="dashboard" class="img-fluid" />
                    <span>Dashboard</span> 
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('admin/instructor') }}" class="{{ Request::is('admin/instructor*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-user-group"></i>
                    <span>Instructor</span> 
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('admin/students') }}" class="{{ Request::is('admin/students*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-user-group"></i>
                    <span>Students</span> 
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('admin.subscription') }}" class="{{ Request::is('admin/manage/subscriptionpackage*')  ? ' active' : '' }} menu-link">
                    <i class="fa-solid fa-box"></i>
                    <span>Package</span> 
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <img src="{{ asset('assets/images/adspy-icon.svg') }}" alt="E-Learning" title="E-Learning" class="img-fluid" />
                    <span>E-Learning</span>
                    <i class="fa-solid fa-angles-right"></i>
                </a> 
                 @include('e-learning/course/admin/partials/sub-sidebar') 
            </li> 
            {{-- admin menu link @E --}}
            @endif
            <li class="menu-item">
                <a class="menu-link bg-white" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <img src="{{ asset('assets/images/logout-icon.svg') }}" alt="Logout" title="Logout" class="img-fluid" />
                    <span>{{ __('Logout') }}</span>
                </a> 
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
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li> 
        </ul>
    </div>
    {{-- sidebar menu @E --}}
</div>