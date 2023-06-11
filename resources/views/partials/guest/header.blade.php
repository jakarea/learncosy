<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            <img src="{{asset('assets/images/learncosy-logo.png')}}" alt="Logo" class="-img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Bundle Courses</a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="#">Feedback</a>
                </li> 
            </ul>
            <div class="d-flex">
                <a href="{{url('/login')}}">Login</a>
                <a href="{{url('/register')}}">Register</a>
            </div>
        </div>
    </div>
</nav>