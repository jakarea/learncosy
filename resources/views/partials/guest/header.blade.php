<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{url('/students/dashboard')}}">
            <img src="{{asset('assets/images/learncosy-logo.png')}}" alt="Logo" class="-img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
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
            @if (auth()->user())
                <div class="d-flex">  
                    <a href="{{url('/students/dashboard')}}">Dashboard</a> 
                </div>
            @else  
                <div class="d-flex">  
                    <a href="{{url('/login')}}">Login</a>
                    <a href="{{url('/register')}}">Register</a> 
                </div>
            @endif
        </div>
    </div>
</nav>