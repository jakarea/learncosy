@extends('layouts.auth-option')

@section('title')
Login
@endsection

@section('style')
<link href="{{ asset('assets/css/login/login.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- ====== login page content start ====== -->
<section class="login-option-wrap login-bg-img" style="background: url({{asset('assets/images/girls-model.jpg')}}); ">
    <div class="bg-ol">
        <div class="cosy-login-page">
            <div class="container-fluid px-0">
                <div class="row g-0 min-vh-100 justify-content-center">
                    <div class="col-md-4 d-flex third-bg-primary">
                        <div class="container my-auto py-5">
                            <div class="row g-0">
                                <div class="col-12 mb-5">
                                    <div class="logo mb-5 mb-md-0 text-center"> <a class="d-flex justify-content-center" href="index.html"
                                            title="Cosy"><img src="{{asset('assets/images/learncosy-logo.png')}}"
                                                alt="Logo" width="180"></a> </div>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-11 mx-auto">
                                    <h3 class="fw-600 mb-4">Log In</h3>
                                    <form method="post">
                                        <div class="mb-3">
                                            <label for="emailAddress" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="emailAddress" required
                                                placeholder="Enter Your Email">
                                        </div>
                                        <div class="mb-3">
                                            <label for="loginPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="loginPassword" required
                                                placeholder="Enter Password">
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col">
                                                <div class="form-check">
                                                    <input id="remember-me" name="remember" class="form-check-input"
                                                        type="checkbox">
                                                    <label class="form-check-label" for="remember-me">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                            <div class="col text-end"><a href="forgot-password.html">Forgot Password
                                                    ?</a>
                                            </div>
                                        </div>
                                        <div class="d-grid my-4">
                                            <button class="btn btn-primary" type="submit">Login</button>
                                        </div>
                                    </form>
                                    <p class="text-center text-muted mb-0">Don't have an account? <a
                                            class="link-primary" href="register.html">Sign Up</a></p>
                                </div>
                            </div>
                        </div>
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