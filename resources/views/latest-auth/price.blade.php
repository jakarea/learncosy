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
        {{-- <div class="row">
            <div class="col-6">
                <div class="top-bttn">
                    <a href="profile/step-1/complete">Back</a>
                </div>
            </div> 
            <div class="col-6">
                <div class="top-bttn text-end">
                    <a href="#" class="skipp_btn">Skip</a>
                </div>
            </div>
        </div> --}}
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
                    @php 
                        $packages = getSubscriptionPackage();
                    @endphp
                @foreach( $packages as $package )
                    @php
                        $package_featurelist = json_decode($package->features);
                    @endphp 
                    @if( $package->type == 'monthly' )
                    <div class="col-xl-4 col-sm-10 col-md-6">
                        <div class="pricing-box">
                            <div class="pricing-icon">
                                <img src="{{asset('latest/assets/images/icons/pricing-01.svg')}}" alt="Prici" class="img-fluid">
                            </div>
                            <div class="txt">
                                <h5>{{$package->name}}</h5>
                                <h3>${{ str_replace('.00', '', $package->amount) }}<span>/{{ $package->type[0] }}</span></h3>
                                <h6>Billed {{ $package->type }}</h6>

                                <ul>
                                    @foreach($package_featurelist as $feature)
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>{{ $feature }}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                            @if (!isSubscribed($package->id))
                            <div class="bttn">
                                <a href="{{ url('instructor/subscription/create/'. $package->id) }}" class="will-subscribe">Subscribe Now</a> 
                            </div>
                            @else
                            <div class="bttn">
                                <a href="#" class="will-subscribe bg-secondary">Subscribed</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                @endforeach
                </div>
            </div>

            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                tabindex="0">
                <div class="row justify-content-center">
                @foreach( getSubscriptionPackage() as $package )
                    @php
                        $package_featurelist = json_decode($package->features);
                    @endphp 
                    @if( $package->type == 'yearly' )
                    <div class="col-xl-4 col-sm-10 col-md-6">
                        <div class="pricing-box">
                            <div class="pricing-icon">
                                <img src="{{asset('latest/assets/images/icons/pricing-01.svg')}}" alt="Prici" class="img-fluid">
                            </div>
                            <div class="txt">
                                <h5>{{$package->name}}</h5>
                                <h3>${{ str_replace('.00', '', $package->amount) }}<span>/{{ $package->type[0] }}</span></h3>
                                <h6>Billed {{ $package->type }}</h6>

                                <ul>
                                    @foreach($package_featurelist as $feature)
                                    <li><img src="{{asset('latest/assets/images/icons/check-circle.svg')}}" alt="Prici" class="img-fluid">
                                        <span>{{ $feature }}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                            @if (!isSubscribed($package->id))
                            <div class="bttn">
                                <a href="{{ route('instructor.subscription.create', $package->id) }}" class="will-subscribe">Subscribe Now</a> 
                            </div>
                            @else
                            <div class="bttn">
                                <a href="#" class="will-subscribe bg-secondary">Subscribed</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- pricing plan page end -->
@endsection

@section('script')
<script>
    // $(document).ready(function(){
    //     $('.skipp_btn').on('click', function() {
    //         alert('ok');
    //     });
    // });
    
</script>
@endsection