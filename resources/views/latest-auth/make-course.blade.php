@extends('layouts.latest.auth')

@section('title')
Make Course
@endsection

@section('style')
<link href="{{ asset('latest/assets/admin-css/user.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/admin-dark.css') }}" rel="stylesheet" type="text/css" />
<style>
    .custom-margin-top {
        margin-top: 8rem;
    }
</style>
@endsection

@section('content')

<!-- pricing plan page start -->
<section class="auth-part-secs custom-margin-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                {{-- verify step start --}}
                <div class="verify-step-wrap">
                    <div class="step-item active">
                        <h6><i class="fas fa-check"></i></h6>
                        <p>Step 1</p>
                    </div>
                    <div class="step-item active">
                        <h6><i class="fas fa-check"></i></h6>
                        <p>Step 2</p>
                    </div>
                    <div class="step-item active">
                        <h6><i class="fas fa-check"></i></h6>
                        <p>Step 3</p>
                    </div>
                    <div class="step-item active">
                        <h6><i class="fas fa-check"></i></h6>
                        <p>Step 4</p>
                    </div>
                    <div class="step-item active">
                        <h6><i class="fas fa-check"></i></h6>
                        <p>Step 5</p>
                    </div>
                    <div class="step-item active">
                        <h6>6</h6>
                        <p>Step 6</p>
                    </div>
                </div>
                {{-- verify step end --}}
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
                <!-- login form start -->
                <div class="goto-course-box">
                    <h1>Go to your Account</h1>
                    <p>Start create your first course click next. </p>
                    <a class="go-to-account-course" role="button"
                        href="{{ url('instructor/dashboard') }}">Go to your account</a>
                </div>
                <!-- login form end -->
            </div>
        </div>
    </div>
</section>
<!-- pricing plan page end -->
@endsection

@section('script')

@endsection