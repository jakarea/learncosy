@extends('layouts.auth-option')

@section('title')
Password Email Page
@endsection

@section('style')
<link href="{{ asset('assets/css/login/login.css') }}" rel="stylesheet" type="text/css" />
@if ( modulesetting('lp_bg_image') )
<style>
    .login-bg-img{ 
        background-image:url({{asset('assets/images/setting/'.modulesetting('lp_bg_image'))}});; 
    }
</style>
@endif
@endsection

@section('content')
<!-- ====== login page content start ====== -->
<section class="login-option-wrap {{ modulesetting('lp_layout') == 'fullwidth' ? 'login-bg-img' : '' }}">
    <div class="cosy-login-page">
        <div class="container-fluid px-0">
            <div class="row g-0 min-vh-100 {{ modulesetting('lp_layout') == 'fullwidth' || modulesetting('lp_layout') == 'default' ? 'justify-content-center' : '' }}">
                <div class="col-md-6 d-flex {{ modulesetting('lp_layout') == 'leftsidebar' ? 'order-2' : 'order-1' }}">
                    <div class="container my-auto py-5">
                        @if ( modulesetting('lp_layout') == 'fullwidth' || modulesetting('lp_layout') == 'default' )
                        <div class="row g-0 took-top">
                            <div class="col-12 mb-5">
                                <div class="logo mb-5 mb-md-0 text-center">
                                    <a class="d-flex justify-content-center" href="#"  title="Cosy">
                                        @if ( modulesetting('logo') )
                                            <img src="{{asset('assets/images/setting/'.modulesetting('logo'))}}" alt="Logo" width="180">
                                            @else 
                                            <img src="{{asset('assets/images/learncosy-logo.png')}}" alt="Logo" width="180">
                                            @endif 
                                        </a> 
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row g-0">
                            <div class="col-10 col-lg-9 col-xl-8 mx-auto {{ modulesetting('lp_layout') == 'fullwidth' || modulesetting('lp_layout') == 'default' ? 'third-bg-primary px-5 py-4' : '' }} {{ modulesetting('lp_layout') == 'default' ? 'bg-white' : '' }}">
                                <h3 class="fw-600 mb-4">Reset Password</h3>
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif
                               {{-- ============ main form start ========= --}}
                               <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form--group mb-3">
                                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                    <input type="email" placeholder="Enter Email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="d-grid my-4">
                                    <button class="btn btn-primary" style="background: {{ modulesetting('secondary_color') }}; border-color: {{ modulesetting('secondary_color') }};" type="submit">{{ modulesetting('lp_button_text')
                                        ?? 'Send!' }}</button>
                                </div>
                            </form>
                               {{-- ============ main form end ========= --}} 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 {{ modulesetting('lp_layout') == 'leftsidebar' ? 'order-1' : 'order-2' }} {{ modulesetting('lp_layout') == 'fullwidth' || modulesetting('lp_layout') == 'default' ? 'd-none' : '' }}">
                    <div class="hero-wrap d-flex align-items-center h-100">
                        @if ( modulesetting('primary_color') )
                        <div class="hero-mask opacity-8" style="background: {{ modulesetting('primary_color') }}"></div>
                        @else
                        <div class="hero-mask opacity-8 bg-primary"></div>
                        @endif
                        <div class="hero-bg hero-bg-scroll" @if ( modulesetting('lp_bg_image') )
                            style="background-image:url({{asset('assets/images/setting/'.modulesetting('lp_bg_image'))}});"
                            @else style="background-image:url({{asset('assets/images/girls-model.jpg')}});" @endif>
                        </div>
                        <div class="hero-content w-100 min-vh-100 d-flex flex-column">
                            <div class="row g-0">
                                <div class="col-10 col-lg-9 mx-auto">
                                    <div class="logo mt-5 mb-5 mb-md-0">
                                        <a class="d-flex" href="#" title="Cosy">
                                            @if ( modulesetting('logo') )
                                            <img src="{{asset('assets/images/setting/'.modulesetting('logo'))}}" alt="Logo" width="180">
                                            @else 
                                            <img src="{{asset('assets/images/learncosy-logo.png')}}" alt="Logo" width="180">
                                            @endif
                                            
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0 my-auto">
                                <div class="col-10 col-lg-9 mx-auto">
                                    <h1 class="text-11 text-white mb-4">{{ modulesetting('lp_title') ?? 'Welcome Back!'
                                        }}</h1>
                                    <p class="text-4 text-white lh-base mb-5">{{ modulesetting('lp_banner_text') ?? 'We
                                        are glad to see you again! Get access to your Orders, Wishlist and
                                        Recommendations.' }}</p>
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