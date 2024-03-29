<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>LearnCosy Authintication | Password Reset Page</title>
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
    <link href="{{url('latest/assets/auth-css/custom-login-2.css')}}" rel="stylesheet" type="text/css" />

</head>

<body>

    <header class="login-header">
        <div class="container">
            <div class="logo">
                <a href="{{url('/')}}">
                    @if (modulesetting('logo'))
                    <img src="{{ asset(modulesetting('logo')) }}" alt="Logo" class="img-fluid" style="max-width: 10rem">
                    @else
                    <img src="{{ asset('latest/assets/images/logo.svg') }}" alt="logo" title="learncosy logo">
                    @endif
                </a>
            </div>
        </div>
    </header>

    <section class="login-page-wrapper login-four-page-wrap login-four-page-wrap-dark" style="background-image: url({{ asset(modulesetting('lp_bg_image') ? modulesetting('lp_bg_image') : 'latest/assets/images/login-left.svg') }});">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-6 col-md-8">
                    <div class="login-box-wrap">
                        <div class="login-heading">
                            {{-- session alert --}}
                         @include('custom-auth/session-alert')
                         {{-- session alert --}}
                            <h6>Welcome to <span>Learn Cosy</span></h6>
                            <div>
                                <p>No Account ?</p>
                                <a href="{{url('/auth-register')}}">Sign up</a>
                            </div>
                        </div>
                        <h1>Password Update</h1>

                        <form method="POST" action="{{ route('password.update',['subdomain' => config('app.subdomain')] ) }}" class="login-from">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">

                            <div class="form-group">
                                <label for="password-field">{{ __('New Password') }}</label>
                                <input id="password-field" placeholder="••••••••" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i class="fa-regular fa-eye eye-click" onclick="changeType()"></i>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm">{{ __('Re-enter Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control" placeholder="••••••••"
                                    name="password_confirmation" required autocomplete="new-password">

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i class="fa-regular fa-eye eye-click2" onclick="changeType2()"></i>
                            </div>

                            <div class="submit-button">
                                <button class="btn btn-submit" type="submit">{{ __('Save') }}</button>
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

<script>
    function changeType() {
        let field = document.getElementById("password-field");
        let clickk = document.getElementById("eye-click");

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

    function changeType2() {
        let field = document.getElementById("password-confirm");
        let clickk = document.getElementById("eye-click2");

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


</body>

</html>
