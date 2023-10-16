<nav class="navbar navbar-expand-xl header-area">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{url('students/dashboard')}}">
            @if ( modulesetting('logo') )
                    <img src="{{asset(modulesetting('logo'))}}" alt="Logo" class="img-fluid">
            @else
                    <img src="{{asset('latest/assets/images/logo-d.svg')}}" alt="Logo" class="img-fluid">
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @can('student')
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a href="{{ url('students/dashboard') }}" class="{{ Request::is('students/dashboard')  ? ' active' : '' }} nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('students/home*') || Request::is('students/courses*')  ? ' active' : '' }} nav-link" href="{{ url('students/home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('students/dashboard/enrolled*')  ? ' active' : '' }} nav-link" href="{{ url('students/dashboard/enrolled') }}">My Courses</a>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('students/courses-certificate*')  ? ' active' : '' }} nav-link" href="{{ url('students/courses-certificate') }}">Certificate</a>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('course/messages*')  ? ' active' : '' }} nav-link" href="{{ url('course/messages') }}">Message</a>
                </li>
            </ul>
            @endcan
            <div class="d-flex">
                <a href="#" class="bttn">
                    <img src="{{asset('latest/assets/images/icons/search.svg')}}" alt="S" class="img-fluid">
                </a>
                <a href="{{ route('cart.index') }}" class="bttn">
                    <img src="{{asset('latest/assets/images/icons/cart-icon.svg')}}" alt="Cart" class="img-fluid">

                    @if (cartCount() >= 1)
                    <span id="cart-count">{{ cartCount() }}</span>
                    @endif
                </a>
                <a href="{{ url('students/notification-details') }}" class="bttn">
                    <img src="{{asset('latest/assets/images/icons/notification.svg')}}" alt="S" class="img-fluid">
                   
                    @if (unseenNotification() >= 1)
                    <span>{{ unseenNotification() }}</span>
                    @endif
                     
                </a>
                <div class="dropdown">
                    <button class="btn avatar" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(auth()->user()->avatar)
                            @if(auth()->user()->user_role == 'student')
                                <img src="{{ asset(auth()->user()->avatar) }}" alt="{{auth()->user()->name}}"
                                class="img-fluid">
                            @endif
                        @else
                            <span class="avatar-user">{!! strtoupper(auth()->user()->name[0]) !!}</span>
                        @endif

                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{url('students/profile/myprofile')}}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ url('students/profile/edit') }}">Account Setting</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout
                            </a>
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
