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
                        <h1>Welcome back</h1>
                        <p>Welcome back! Please enter your details.</p>
                        <form method="POST" action="{{ route('password.update',['subdomain' => config('app.subdomain')] ) }}">
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
                                <label for="password-field">{{ __('Re-enter Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i class="fa-regular fa-eye eye-click" onclick="changeType()"></i>
                            </div>

                            <div class="form-submit">
                                <button class="btn btn-submit" type="submit">Save</button>
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
