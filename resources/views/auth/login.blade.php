@extends('layouts.auth')

@section('title')
Login
@endsection

@section('content')
<!-- ====== login page content start ====== -->
<section class="login-section">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
        <div class="login-form-wrap">
            <h1>Login</h1> 
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input type="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-field">{{ __('Password') }}</label> 
                    <input id="password-field" placeholder="*******" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                    <i class="fa-regular fa-eye" onclick="changeType()" id="eye-click"></i>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
    
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif 
                </div>
                <div class="form-bttn">
                    <button type="submit" class="btn btn-submit"> {{ __('LOGIN') }}</button>
                </div>
                </form>
                <div class="login-logo-wrap text-center mt-3"> 
                    <p>Don't have an account? <a href="{{ url('/register') }}" class="registerr">Register</a></p>
                </div>
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