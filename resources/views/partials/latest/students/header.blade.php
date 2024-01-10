<nav class="navbar navbar-expand-xl header-area">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('student/dashboard') }}">
            @if (modulesetting('logo'))
                <img src="{{ asset(modulesetting('logo')) }}" alt="Logo" class="img-fluid">
            @else
                <img src="{{ asset('latest/assets/images/logo-d.svg') }}" alt="Logo" class="img-fluid light-ele ">
                <img src="{{ asset('latest/assets/images/logo-w.svg') }}" alt="Logo" class="img-fluid dark-ele">
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @can('student')
                <ul class="navbar-nav m-auto">
                    {{-- check permission --}}
                    @php
                        $host = request()->getHost();
                        $subdomain = explode('.', $host)[0];
                        $instructor = \App\Models\User::where('subdomain', $subdomain)
                            ->where('user_role', 'instructor')
                            ->first();

                        $userPermissions = json_decode('{"dashboard":1,"homePage":1,"messagePage":1,"certificatePage":1}');

                        if ($instructor) {
                            $pageAccess = \App\Models\ManagePage::where('instructor_id', $instructor->id)->first();

                            if ($pageAccess) {
                                $userPermissions = json_decode($pageAccess->pagePermissions);
                            }
                        }

                    @endphp
                    {{-- check permission --}}
                    @if ($userPermissions->dashboard == 1)
                        <li class="nav-item">
                            <a href="{{ url('student/dashboard') }}"
                                class="{{ Request::is('student/dashboard') ? ' active' : '' }} nav-link">Dashboard</a>
                        </li>
                    @endif
                    @if ($userPermissions->homePage == 1)
                        <li class="nav-item">
                            <a class="{{ Request::is('student/home*') || Request::is('student/courses') ? ' active' : '' }} nav-link"
                                href="{{ url('student/home') }}">Home</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="{{ Request::is('student/dashboard/enrolled*') ? ' active' : '' }} nav-link"
                            href="{{ url('student/dashboard/enrolled') }}">My Courses</a>
                    </li>
                    @if ($userPermissions->certificatePage == 1)
                        <li class="nav-item">
                            <a class="{{ Request::is('student/courses-certificate*') ? ' active' : '' }} nav-link"
                                href="{{ url('student/courses-certificate') }}">Certificate</a>
                        </li>
                    @endif
                    @if ($userPermissions->messagePage == 1)
                        <li class="nav-item">
                            <a class="{{ Request::is('/messages') ? ' active' : '' }} nav-link"
                                href="{{ url('/messages') }}">Message</a>
                        </li>
                    @endif

                    @if(session()->has('userId'))
                        <li class="nav-item">
                            <a class="{{ Request::is('back-to-pavilion/') ? ' active' : '' }} nav-link"
                                href="{{ route('backto-pavilion', ['userId' => session('userId')])}}">Back to {{ ucfirst(session('userRole')) }}</a>
                        </li>
                    @endif
                </ul>
            @endcan
            <div class="d-flex">
                <a href="{{ url('student/home') }}" class="bttn">
                    <img src="{{ asset('latest/assets/images/icons/search.svg') }}" alt="S" class="img-fluid">
                </a>
                <a href="{{ route('cart.index', config('app.subdomain')) }}"
                    class="bttn {{ Request::is('student/cart*') ? ' active' : '' }}">

                    <img src="{{ asset('latest/assets/images/icons/cart-icon.svg') }}" alt="Cart"
                        class="img-fluid">

                    @if (cartCount() >= 1)
                        <span id="cart-count">{{ cartCount() }}</span>
                    @endif
                </a>
                <a href="{{ url('student/notification-details') }}"
                    class="bttn {{ Request::is('student/notification-details*') ? ' active' : '' }}">
                    <img src="{{ asset('latest/assets/images/icons/notification.svg') }}" alt="S"
                        class="img-fluid">

                    @if (unseenNotification() >= 1)
                        <span>{{ unseenNotification() }}</span>
                    @endif

                </a>
                <div class="dropdown">
                    <button class="btn avatar" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if (auth()->user()->avatar)
                            @if (auth()->user()->user_role == 'student')
                                <img src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                                    class="img-fluid">
                            @endif
                        @else
                            <span class="avatar-user">{!! strtoupper(auth()->user()->name[0]) !!}</span>
                        @endif

                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item {{ Request::is('student/profile/myprofile*') ? ' active' : '' }}"
                                href="{{ url('student/profile/myprofile') }}">Profile</a></li>
                        <li><a class="dropdown-item {{ Request::is('student/profile/edit*') ? ' active' : '' }}"
                                href="{{ url('student/profile/edit') }}">Account Setting</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
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
