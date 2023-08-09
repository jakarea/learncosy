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
            <ul class="navbar-nav m-auto"> 
                <li class="nav-item">
                    <a href="{{ url('students/dashboard') }}" class="{{ Request::is('students/dashboard*')  ? ' active' : '' }} nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('students/home*')  ? ' active' : '' }} nav-link" href="{{ url('students/home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('students/dashboard/enrolled*')  ? ' active' : '' }} nav-link" href="{{ url('students/dashboard/enrolled') }}">My Course</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Certificate</a>
                </li>
                <li class="nav-item">
                    <a class="{{ Request::is('course/messages*')  ? ' active' : '' }} nav-link" href="{{ url('course/messages') }}">Message</a>
                </li> 
            </ul>
            <div class="d-flex"> 
                <div class="dropdown">
                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('latest/assets/images/icons/settings.svg')}}" alt="a"
                            class="img-fluid">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{url('/students/profile/myprofile')}}">My Profile</a></li>  
                        <li><a class="dropdown-item" href="{{ url('/students/account-management') }}">Account Setting</a></li>  
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
 
                <a href="#" class="avatar">
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('assets/images/students/'.auth()->user()->avatar) }}" alt="{{auth()->user()->name}}"
                        class="img-fluid">
                    @else
                        <span class="avatar-user">{!! strtoupper(auth()->user()->name[0]) !!}</span>
                    @endif 
                </a>
            </div>
        </div>
    </div>
</nav>