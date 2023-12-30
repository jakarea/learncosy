<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ modulesetting('meta_title') ? modulesetting('meta_title') : 'Learncosy' }}  | @yield('title')</title>
    <meta name="description" content="{{ modulesetting('meta_desc') ? modulesetting('meta_desc') : '' }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Admin Template For Filter Developers" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta name="theme-color" content="#fafafa">

    <!-- App favicon -->
    @if (modulesetting('favicon'))
    <link rel="shortcut icon" href="{{ asset(modulesetting('favicon')) }}">
@else
    <link rel="shortcut icon" href="{{ asset('latest/assets/images/favicon.png') }}">
@endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- all css start -->
    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{url('latest/assets/auth-css/custom-login-3.css')}}" rel="stylesheet" type="text/css" />

</head>

<body>

    <header class="login-header">
        <div class="container">
            <div class="logo">
                <a href="{{url('/')}}">
                    <img src="{{ asset('latest/assets/images/login2-logo.svg') }}" alt="logo" class="img-fluid light-ele">
                    <img src="{{ asset('latest/assets/images/logo-d.svg') }}" alt="logo" class="img-fluid dark-ele">
                </a>
                <a href="{{url('/register')}}" class="signup-bttn">
                    SIGN UP
                </a>
            </div>
        </div>
    </header>

    <section class="login-page-wrapper login-four-page-wrap">
        <div class="bg-olg">
            <img src="{{asset('latest/assets/images/learncosy-bg.svg')}}" alt="" class="img-fluid light-ele">
            <img src="{{asset('latest/assets/images/learncosy-bg-2.svg')}}" alt="" class="img-fluid dark-ele">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7 col-xl-6 col-sm-9">
                    <div class="login-box-wrap">

                        <h1>Sign in to Learn Cosy</h1>
                        <p>Welcome back! Please enter your details.</p>

                        <form method="POST" action="{{ route('login') }}" class="login-from">
                            @csrf
                            <div class="form-group">
                                <label>Enter your username or email address</label>
                                <input autocomplete="off" type="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" name="email"  id="emailAddress" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label>Enter your Password</label>
                                <input id="password-field" placeholder="••••••••" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <i class="fa-regular fa-eye" onclick="changeType()" id="eye-click"></i>
                            </div>
                            <div class="checbox-wrap">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember me for 30 days') }}
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ __('Forgot Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="submit-button">
                                <button class="btn btn-submit" type="submit">Next</button>
                            </div>
                        </form>

                        <h6 class="or">or</h6>

                        <div class="buttons-group">
                            <a href="#"><img src="{{ asset('latest/assets/images/google.svg') }}" alt="google"
                                    class="img-fluid"></a>
                            <a href="#"><img src="{{ asset('latest/assets/images/facebook.svg') }}" alt="google"
                                    class="img-fluid"></a>
                        </div>

                    </div>
                </div>
                <div class="col-12">
                    <div class="login-ftr">
                        <p>All Rights Reserved. <a href="{{url('/')}}">Learn Cosy</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

     {{-- dark mode button start --}}
     <input type="checkbox" id="darkModeBttn" class="d-none">

     <div class="dark-mode-bttn">
         <label for="darkModeBttn" class="active">
             <i class="fa-solid fa-sun"></i>
         </label>
         <label for="darkModeBttn">
             <i class="fa-solid fa-moon"></i>
         </label>
     </div>
     {{-- dark mode button end --}}

     <script>
        function changeType() {
          var field = document.getElementById("password-field");
          var clickk = document.getElementById("eye-click");

          if (field.type === "password") {
            field.type = "text";
            clickk.classList.add('fa-eye-slash');
            clickk.classList.remove('fa-eye');
          } else {
            field.type = "password";
            clickk.classList.remove('fa-eye-slash');
            clickk.classList.add('fa-eye');
          }

        }
    </script>

<script>
    // darkMode.js
    const modeBttn = document.getElementById("darkModeBttn");
    const htmlBody = document.querySelector("body");

    // Function to toggle between dark and light mode
    function toggleMode() {
        htmlBody.classList.toggle('dark-mode');

        // Store user preference in local storage
        const mode = htmlBody.classList.contains('dark-mode') ? 'dark-mode' : '';
        localStorage.setItem('dark-mode', mode);
    }

    // Check the initial state from local storage
    const storedMode = localStorage.getItem('dark-mode');
    if (storedMode === 'dark-mode') {
        htmlBody.classList.add('dark-mode');
    }

    // Attach event listener to the checkbox
    modeBttn.addEventListener('change', toggleMode);


</script>

</body>

</html>
