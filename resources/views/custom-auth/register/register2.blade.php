<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>LearnCosy Authintication | Register Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Admin Template For Filter Developers" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta name="theme-color" content="#fafafa">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('latest/assets/images/favicon.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- all css start -->
    <!-- App css -->
    <link href="{{ asset('latest/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{url('latest/assets/auth-css/custom-login-2.css')}}" rel="stylesheet" type="text/css" />

</head>

<body>

    <header class="login-header">
        <div class="container">
            <div class="logo">
                <a href="{{url('/')}}">
                    @if (modulesetting('logo'))
                    <img src="{{ asset(modulesetting('logo')) }}" alt="Logo" class="img-fluid" style="max-width: 10rem; max-height: 5rem;">
                    @else
                    <img src="{{ asset('latest/assets/images/login2-logo.svg') }}" alt="logo" class="img-fluid light-ele">
                    <img src="{{ asset('latest/assets/images/logo-d.svg') }}" alt="logo" class="img-fluid dark-ele">
                    @endif
                </a>
            </div>
        </div>
    </header>

    <section class="login-page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="login-text">
                        <h1>Create an account</h1>
                        <h3>Learn Cosy</h3>
                        <p>Whether you're a student, professional, or lifelong learner, our eLearning website empowers
                            you to pursue your passions, achieve your aspirations, and stay ahead in today's dynamic
                            world. Unlock a world of knowledge and growth with us today!</p>
                    </div>
                    <div class="login-promo-image">
                        @if (modulesetting('lp_bg_image'))
                        <img src="{{ asset(modulesetting('lp_bg_image')) }}" alt="Login BG"
                        title="Login BG" class="login2-logo rounded" style="max-width: 25rem">
                        @else
                            <img src="{{ asset('latest/assets/images/login2-image.png') }}" alt="Leancosy white logo"
                                title="Leancosy white logo" class="login2-logo" />
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="login-box-wrap">
                        <div class="login-heading">
                            <h6>Create an <span>account</span></h6>
                            <div>
                                <p>Have Account ?</p>
                                <a href="{{url('/login')}}">Login</a>
                            </div>
                        </div>
                        <h1>Sign up</h1>
                        <div class="buttons-group">
                            <a href="{{ url('login/google') }}"><img src="{{ asset('latest/assets/images/google.svg') }}" alt="google"
                                    class="img-fluid"> Sign up with Google</a>
                            <a href="{{ url('login/facebook') }}"><img src="{{ asset('latest/assets/images/facebook.svg') }}" alt="google"
                                    class="img-fluid"></a>
                            <a href="javascript:;"><img src="{{ asset('latest/assets/images/apple.svg') }}" alt="google"
                                    class="img-fluid"></a>
                        </div>

                        <form method="POST" action="{{ route('register') }}" class="login-from">
                            @csrf

                            <div class="form-group mt-3">
                                <label for="email" class="form-label">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter your Name" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                    <input type="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <input type="hidden" name="user_role" value="student">

                            <div class="form-group mt-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password-field" placeholder="••••••••" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i class="fa-regular fa-eye" onclick="changeType()" id="eye-click"></i>

                            </div>
                            <div class="form-group mt-3">
                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>

                                    <input id="password-confirm" type="password" placeholder="********" class="form-control" name="password_confirmation" autocomplete="new-password">

                            </div>
                            <div class="submit-button">
                                <button class="btn btn-submit" type="submit">Register</button>
                            </div>
                        </form>
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
