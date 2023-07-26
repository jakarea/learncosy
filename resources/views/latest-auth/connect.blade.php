@extends('layouts.latest.auth')

@section('title')
Connect
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
            <div class="col-12">
                <div class="back-bttn w-100 mt-0">
                    <a href="#">Back</a>
                    <a href="#">Do it later</a>
                  </div> 
            </div>
        </div>
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
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-7 col-lg-5 col-xl-4">
                <!-- login form start -->
                <div class="connect-link-wrap mx-auto">
                    <div class="connect-box">
                      <h6>Connect Vimeo</h6>
                      <a href="#" class="bttn"><img src="{{asset('latest/assets/images/auth/vimeo.svg')}}" alt="Vimeo" class="img-fluid"></a>
                    </div>
                    <div class="connect-box">
                      <h6>Connect Stripe</h6>
                      <a href="#" class="bttn bttn-2"><i class="fa-brands fa-stripe"></i></a>
                    </div>
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