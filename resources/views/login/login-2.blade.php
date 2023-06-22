@extends('layouts.auth-option')

@section('title')
Login
@endsection

@section('style')
<link href="{{ asset('assets/css/login/login.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- ====== login page content start ====== -->
<section class="login-option-wrap">
    <div class="cosy-login-page">
        <div class="container-fluid px-0">
            <div class="row g-0 min-vh-100">
                <div class="col-md-6">
                    <div class="hero-wrap d-flex align-items-center h-100">
                        <div class="hero-mask opacity-8 bg-primary"></div>
                        <div class="hero-bg hero-bg-scroll"
                            style="background-image:url({{asset('assets/images/girls-model.jpg')}});">
                        </div>
                        <div class="hero-content w-100 min-vh-100 d-flex flex-column">
                            <div class="row g-0">
                                <div class="col-10 col-lg-9 mx-auto">
                                    <div class="logo mt-5 mb-5 mb-md-0"> <a class="d-flex" href="index.html"
                                            title="Cosy"><img src="{{asset('assets/images/learncosy-logo.png')}}"
                                                alt="Logo" width="180"></a> </div>
                                </div>
                            </div>
                            <div class="row g-0 my-auto">
                                <div class="col-10 col-lg-9 mx-auto">
                                    <h1 class="text-11 text-white mb-4">Welcome back!</h1>
                                    <p class="text-4 text-white lh-base mb-5">We are glad to see you again! Get access
                                        to your Orders, Wishlist and Recommendations.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="container my-auto py-5">
                        <div class="row g-0">
                            <div class="col-10 col-lg-9 col-xl-8 mx-auto">
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
                                                <label class="form-check-label" for="remember-me">Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="col text-end"><a href="forgot-password.html">Forgot Password ?</a>
                                        </div>
                                    </div>
                                    <div class="d-grid my-4">
                                        <button class="btn btn-primary" type="submit">Login</button>
                                    </div>
                                </form>
                                <p class="text-center text-muted mb-0">Don't have an account? <a class="link-primary"
                                        href="register.html">Sign Up</a></p>
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

@endsection