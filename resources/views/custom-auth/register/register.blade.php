@extends('layouts.latest.auth')

@section('title')
    Register Page
@endsection

@section('content')
    <!-- ====== register page content @S ====== -->
    <section class="auth-part-sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 px-md-0">
                    <!-- login form start -->
                    <div class="auth-form-wrap">
                        <a href="#">
                            <img src="{{ asset('latest/assets/images/logo.svg') }}" alt="Logo" class="img-fluid">
                        </a>
                        <h1>Create an account</h1>
                        <p>Start your 30-day free trial.</p>
                        <form method="POST" action="{{ route('register',['subdomain' => config('app.subdomain')] ) }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email">{{ __('Name') }}</label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" placeholder="Enter your Name" autocomplete="name"
                                            autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="company_name">Company Name (Optional)</label>
                                        <input type="text" placeholder="Company Name" class="form-control"
                                            value="{{ old('company_name') }}" id="company_name" name="company_name">

                                        @error('company_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email">{{ __('Email Address') }}</label>
                                        <input type="email" placeholder="Enter Email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="user_role" value="instructor">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="password-field">{{ __('Password') }}</label>
                                        <input id="password-field" placeholder="••••••••" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <i class="fa-regular fa-eye" onclick="changeType()" id="eye-click"></i>
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">{{ __('Confirm Password') }}</label>

                                        <input id="password-confirm" type="password" placeholder="••••••••"
                                            class="form-control" name="password_confirmation" autocomplete="new-password">

                                        <i class="fa-regular fa-eye" onclick="changeType2()" id="eye-click2"></i>
                                    </div>
                                </div>

                            </div>

                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="aggred" required>
                                    <label class="form-check-label" for="aggred">
                                        By creating an account means you agree to the <a href="#"> Terms of
                                            Service</a>, and
                                        our <a href="#">Privacy Policy</a>
                                    </label>
                                </div>
                            </div>
                            <div class="form-submit">
                                <button class="btn btn-submit" type="submit">Register</button>
                            </div>
                            <div class="optional-txt">
                                <p>Already have an account? <a href="{{ url('/login') }}">Log in</a></p>
                            </div>
                        </form>
                    </div>
                    <!-- login form end -->
                </div>
                <div class="col-lg-6 px-md-0">
                    <div class="auth-side-img d-none d-lg-block">
                        <img src="{{ asset('latest/assets/images/auth/auth.png') }}" alt="Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== register page content @E ====== -->
@endsection

@section('script')
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
@endsection
