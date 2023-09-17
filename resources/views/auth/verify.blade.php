@extends('layouts.latest.auth')

@section('title')
Verify Email
@endsection

@section('content')
<!-- ====== verify page content start ====== -->
<section class="auth-part-sec">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 px-md-0">
                <!-- login form start -->
                <div class="auth-form-wrap justify-content-start">
                    <div class="back-bttn">
                        <a href="{{url('/login') }}">
                            Back
                        </a>
                    </div>
                    {{-- verify step start --}}
                    <div class="verify-step-wrap">
                        <div class="step-item active">
                            <h6>1</h6>
                            <p>Step 1</p>
                        </div>
                        <div class="step-item ">
                            <h6>2</h6>
                            <p>Step 2</p>
                        </div>
                        <div class="step-item">
                            <h6>3</h6>
                            <p>Step 3</p>
                        </div>
                        <div class="step-item">
                            <h6>4</h6>
                            <p>Step 4</p>
                        </div>
                        <div class="step-item">
                            <h6>5</h6>
                            <p>Step 5</p>
                        </div>
                        <div class="step-item">
                            <h6>6</h6>
                            <p>Step 6</p>
                        </div>
                    </div>
                    {{-- verify step end --}}
                    <a href="#" class="mt-4">
                        <img src="{{ asset('latest/assets/images/logo.svg') }}" alt="Logo" class="img-fluid">
                    </a>
                    <h1>Verify your mail address</h1>
                    <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>

                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif

                    <form class="ms-0" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <div class="form-submit only-submit">
                            <button class="btn btn-submit mx-auto" type="submit">Verify</button>
                        </div>
                        <div class="optional-txt">
                            <p>Wanna verifed later ? <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout Now</a></p>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </form>
                </div>
                <!-- login form end -->
            </div>
        </div>
    </div>
</section>
<!-- ====== verify page content end ====== -->
@endsection

@section('script')

@endsection