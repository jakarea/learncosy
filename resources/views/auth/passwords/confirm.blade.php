@extends('layouts.auth')

@section('title')
Confirm Password
@endsection

@section('content')
<!-- ====== login page content start ====== -->
<section class="login-section">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
        <div class="login-form-wrap">
            <h1>Confirm Password</h1> 
            <p>Please confirm your password before continuing.</p>
            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf 
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
                <div class="form-bttn">
                    <button type="submit" class="btn btn-submit"> {{ __('Confirm Password') }}</button>
                </div>
                </form>
                <div class="login-logo-wrap text-center mt-3"> 
                    @if (Route::has('password.request')) 
                    <p><a href="{{ route('password.request') }}" class="registerr">Forgot Your Password?</a></p>
                    @endif
                   
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