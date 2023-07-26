@extends('layouts.latest.auth')

@section('title')
Make Course
@endsection

@section('style')
<style>
    .custom-margin-top {
        padding-top: 8rem !important;
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
                <div class="username-box-wrap custom-margins"> 
                    <h1>Make your first course</h1>
                    <p>Start create your first course click next. </p>
                    <form action="" class="ms-0 username-form">    
                        <div class="form-submit">
                            <button class="btn btn-submit mx-auto" type="submit">Create a new course</button>
                        </div>
                    </form>
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