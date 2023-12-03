@extends('layouts.latest.auth')
@section('title')
    Login Page
@endsection

@section('content')
    <!-- ====== login page content start ====== -->
    <section class="auth-part-sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 px-0">
                    <div class="auth-form-wrap">
                         {{-- session alert --}}
                         @include('custom-auth/session-alert')
                         {{-- session alert --}}
                        <a href="#">
                            <img src="{{ asset('latest/assets/images/logo.svg') }}" alt="Logo" class="img-fluid">
                        </a>
                        <h1>Password Reset</h1>
                        <p>Welcome back! Please enter your details.</p>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="email" placeholder="Enter Email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-submit">
                                <button class="btn btn-submit" type="submit">{{ __('Send Password Reset Link') }}</button>
                            </div>
                            <div class="optional-txt">
                                <p>Back to <a href="{{ url('/login') }}">Login</a></p>
                            </div>
                        </form>
                    </div>
                    <!-- login form end -->
                </div>
                <div class="col-lg-6 px-0">
                    <div class="auth-side-img d-none d-lg-block">
                        <img src="{{ asset('latest/assets/images/auth/auth.png') }}" alt="Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== login page content end ====== -->
@endsection

@section('script')
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
@endsection
