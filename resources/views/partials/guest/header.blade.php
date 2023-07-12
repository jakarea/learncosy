<nav class="navbar navbar-expand-lg" style="background: {{modulesetting('primary_color')}}">
    <div class="container">
        @if ( Auth::check() )
            @can('student')
            <a class="navbar-brand" href="{{ route('students.dashboard')}}">
                @if ( modulesetting('logo') )
                    <img src="{{asset('assets/images/setting/'.modulesetting('logo'))}}" alt="Logo" class="-img-fluid">
                @else
                <img src="{{asset('assets/images/learncosy-logo.png')}}" alt="Logo" class="-img-fluid">
                @endif
            @else 
            <a class="navbar-brand" href="{{ route('instructor.dashboard.index') }}">
                @if ( modulesetting('logo') )
                    <img src="{{asset('assets/images/setting/'.modulesetting('logo'))}}" alt="Logo" class="-img-fluid">
                @else
                <img src="{{asset('assets/images/learncosy-logo.png')}}" alt="Logo" class="-img-fluid">
                @endif
            </a>
            @endcan
        </a>
        @else
        <a class="navbar-brand" href="{{ route('tlogin') }}">
            @if ( modulesetting('logo') )
                <img src="{{asset('assets/images/setting/'.modulesetting('logo'))}}" alt="Logo" class="-img-fluid">
            @else
            <img src="{{asset('assets/images/learncosy-logo.png')}}" alt="Logo" class="-img-fluid">
            @endif
        </a>
        @endif
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars-staggered"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto custom_nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{url('/students/dashboard')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#course_sec">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#b_course_sec">Bundle Courses</a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="#feedback_sec">Feedback</a>
                </li> 
            </ul>
            @if (auth()->user() && auth()->user()->user_role == 'instructor')
                <div class="d-flex">  
                    <a href="{{url('/instructor/dashboard')}}">Dashboard</a> 
                </div>
			@elseif (auth()->user() && auth()->user()->user_role == 'student')
                <div class="d-flex">  
                    <a href="{{url('/students/dashboard')}}">Dashboard</a> 
                </div> 
            @else  
                <div class="d-flex">  
                    <a href="{{ route('tlogin') }}">Login</a>
                    <a href="{{ route('tregister') }}">Register</a> 
                </div>
            @endif
        </div>
    </div>
</nav>