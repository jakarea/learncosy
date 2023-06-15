@extends('layouts.auth')

@section('title')
Register
@endsection

@section('content') 

<!-- ====== register page content @S ====== -->
<section class="login-section">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
        <div class="login-form-wrap">
            <h1>{{ __('Register') }}</h1> 
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                <label for="email">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter your Name" autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input type="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="user_role">{{ __('User Role') }}</label>
                    <select name="user_role" id="" class="form-control @error('user_role') is-invalid @enderror">
                        <option value="admin">Admin</option>
                        <option value="instructor">Instructor</option>
                        <option value="students">StudentS</option> 
                    </select> 
                    <i class="fas fa-angle-down"></i>
                    @error('user_role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-field">{{ __('Password') }}</label> 
                    <input id="password-field" placeholder="********" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                    <i class="fa-regular fa-eye" onclick="changeType()" id="eye-click"></i>
                </div>
                <div class="form-group">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>

                    <input id="password-confirm" type="password" placeholder="********" class="form-control" name="password_confirmation" autocomplete="new-password">
                  
                    <i class="fa-regular fa-eye" onclick="changeType2()" id="eye-click2"></i>
                </div> 
               
                <div class="form-bttn">
                    <button type="submit" class="btn btn-submit"> {{ __('Register') }} </button>
                </div>
                </form>
                <div class="login-logo-wrap text-center mt-3"> 
                    <p>Already have an account? <a href="{{url('/login')}}" class="registerr">Login</a></p>
                </div>
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