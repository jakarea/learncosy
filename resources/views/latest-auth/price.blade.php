@extends('layouts.latest.auth')

@section('title')
Verify Email
@endsection

@section('style')
<link rel="stylesheet" href="{{asset('latest/assets/auth-css/pricing.css')}}">
@endsection

@section('content')

<!-- pricing plan page start -->
<section class="pricing-plan-sec">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="top-bttn">
                    <a href="#">Back</a>
                </div>
            </div> 
            <div class="col-6">
                <div class="top-bttn text-end">
                    <a href="#">Skip</a>
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
            </div>
        </div> 

        <div class="row">
            <div class="col-12">
                <div class="pricing-heading">
                    <h6>Pricing</h6>
                    <h2>Pricing plans</h2>
                    <p>Simple, transparent pricing that grows with you. Try any plan free for 30 days.</p>
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-12">
                <div class="pricing-tab-head">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Monthly billing</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Annual billing</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                tabindex="0">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-sm-10 col-md-6">
                        <div class="pricing-box">
                            <div class="pricing-icon">
                                <img src="{{asset('latest/assets/images/icons/pricing-01.svg')}}" alt="Prici" class="img-fluid">
                            </div>
                            <div class="txt">
                                <h5>Basic plan</h5>
                                <h3>$10/mth</h3>
                                <h6>Billed annually.</h6>

                                <ul>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Access to all basic features</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Basic reporting and analytics</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Up to 10 individual users</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>20GB individual data each user</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Basic chat and email support</span></li>
                                </ul>
                            </div>
                            <div class="bttn">
                                <a href="#">Get started</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-10 col-md-6">
                        <div class="pricing-box">
                            <div class="pricing-icon">
                                <img src="{{asset('latest/assets/images/icons/pricing-02.svg')}}" alt="Prici" class="img-fluid">
                            </div>
                            <div class="txt">
                                <h5>Basic plan</h5>
                                <h3>$10/mth</h3>
                                <h6>Billed annually.</h6>

                                <ul>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Access to all basic features</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Basic reporting and analytics</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Up to 10 individual users</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>20GB individual data each user</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Basic chat and email support</span></li>
                                </ul>
                            </div>
                            <div class="bttn">
                                <a href="#">Get started</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-10 col-md-6">
                        <div class="pricing-box">
                            <div class="pricing-icon">
                                <img src="{{asset('latest/assets/images/icons/pricing-03.svg')}}" alt="Prici" class="img-fluid">
                            </div>
                            <div class="txt">
                                <h5>Basic plan</h5>
                                <h3>$10/mth</h3>
                                <h6>Billed annually.</h6>

                                <ul>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Access to all basic features</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Basic reporting and analytics</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Up to 10 individual users</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>20GB individual data each user</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Basic chat and email support</span></li>
                                </ul>
                            </div>
                            <div class="bttn">
                                <a href="#">Get started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                tabindex="0">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-10">
                        <div class="pricing-box">
                            <div class="pricing-icon">
                                <img src="{{asset('latest/assets/images/icons/pricing-01.svg')}}" alt="Prici" class="img-fluid">
                            </div>
                            <div class="txt">
                                <h5>Basic plan</h5>
                                <h3>$10/mth</h3>
                                <h6>Billed annually.</h6>

                                <ul>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Access to all basic features</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Basic reporting and analytics</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Up to 10 individual users</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>20GB individual data each user</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Basic chat and email support</span></li>
                                </ul>
                            </div>
                            <div class="bttn">
                                <a href="#">Get started</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-10">
                        <div class="pricing-box">
                            <div class="pricing-icon">
                                <img src="{{asset('latest/assets/images/icons/pricing-02.svg')}}" alt="Prici" class="img-fluid">
                            </div>
                            <div class="txt">
                                <h5>Basic plan</h5>
                                <h3>$10/mth</h3>
                                <h6>Billed annually.</h6>

                                <ul>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Access to all basic features</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Basic reporting and analytics</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Up to 10 individual users</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>20GB individual data each user</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Basic chat and email support</span></li>
                                </ul>
                            </div>
                            <div class="bttn">
                                <a href="#">Get started</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-10">
                        <div class="pricing-box">
                            <div class="pricing-icon">
                                <img src="{{asset('latest/assets/images/icons/pricing-03.svg')}}" alt="Prici" class="img-fluid">
                            </div>
                            <div class="txt">
                                <h5>Basic plan</h5>
                                <h3>$10/mth</h3>
                                <h6>Billed annually.</h6>

                                <ul>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Access to all basic features</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Basic reporting and analytics</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Up to 10 individual users</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>20GB individual data each user</span></li>
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>Basic chat and email support</span></li>
                                </ul>
                            </div>
                            <div class="bttn">
                                <a href="#">Get started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- pricing plan page end -->
@endsection

@section('script')

@endsection