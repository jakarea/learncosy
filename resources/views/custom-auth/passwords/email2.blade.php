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
    <link href="{{ asset('latest/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('latest/assets/auth-css/custom-login-2.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>

    <header class="login-header">
        <div class="container">
            <div class="logo">
                <a href="{{ url('/') }}">
                    @if (modulesetting('logo'))
                    <img src="{{ asset(modulesetting('logo')) }}" alt="Logo" class="img-fluid" style="max-width: 10rem!important;">
                    @else
                    <img src="{{ asset('latest/assets/images/login2-logo.svg') }}" alt="logo" class="img-fluid light-ele" style="max-width: 100px!important;">
                    <img src="{{ asset('latest/assets/images/logo-d.svg') }}" alt="logo" class="img-fluid dark-ele" style="max-width: 100px!important;">
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
                        <h1>Reset Your Password </h1>
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
                        {{-- session alert --}}
                        @include('custom-auth/session-alert')
                        {{-- session alert --}}
                        <div class="login-heading">
                            <h6>Welcome back to <span>Learn Cosy</span></h6>
                            <div>
                                <p>No Account ?</p>
                                <a href="{{ url('/auth-register') }}">Sign up</a>
                            </div>
                        </div>
                        <h1>Password Reset</h1>

                        <form method="POST" action="{{ route('password.email',['subdomain' => config('app.subdomain')] ) }}" class="login-from">
                            @csrf

                            <div class="form-group">
                                <label>Enter your email address</label>
                                <input  autocomplete="off"  type="email" placeholder="Email Address"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                     id="emailAddress" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="submit-button">
                                <button class="btn btn-submit" type="submit">{{ __('Send Password Reset Link') }}</button>
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
