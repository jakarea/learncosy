@extends('layouts.latest.instructor')
@section('title','Subscription List Page')

@section('style')
<link rel="stylesheet" href="{{ asset('latest/assets/auth-css/pricing.css') }}">
@endsection

@section('content')
<!-- pricing plan page start -->
<section class="pricing-plan-sec pt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="pricing-heading mt-0">
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
                    @foreach ($packages as $package)
                    @php
                    $package_featurelist = explode(',', $package->features);
                    @endphp
                    @if ($package->type == 'monthly')
                    <div class="col-xl-4 col-sm-10 col-md-6 mb-3">
                        <div class="pricing-box">
                            @if ($activePackageId == $package->id)
                                <span class="current-plan">
                                    Current Plan
                                </span>
                            @endif
                            <div>
                                <div class="pricing-icon">
                                    <img src="{{ asset('latest/assets/images/icons/pricing-01.svg') }}" alt="Prici" class="img-fluid light-ele">
                                    <img src="{{ asset('latest/assets/images/icons/pricing-01-d.svg') }}" alt="Prici" class="img-fluid dark-ele mx-auto">
                                </div>

                                <div class="txt">
                                    <h5>{{ $package->name }}</h5>
                                    <h3>

                                        @if ($package->sales_price)
                                        €
                                        {{ str_replace('.00', '', $package->sales_price) }}
                                        @else
                                        €
                                            {{ $package->regular_price > 0 ? ' ' . str_replace('.00', '', $package->regular_price) : 'Free' }}
                                        @endif

                                        <span>/{{ $package->type[0] }}</span>
                                    </h3>
                                    <h6>Billed {{ $package->type }}</h6>

                                    <ul>
                                        @foreach ($package_featurelist as $feature)
                                        <li>
                                            <img src="{{ asset('latest/assets/images/icons/check-circle.svg') }}" alt="Prici" class="img-fluid light-ele">
                                            <img src="{{ asset('latest/assets/images/icons/check-circle-d.svg') }}" alt="Prici" class="img-fluid dark-ele">
                                            <span>{{ $feature }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="bttn">
                                @if ($activePackageId == $package->id)
                                <a href="{{ route('instructor.subscription.status', $package->id) }}"
                                    class="will-subscribe current-plan-bttn">Cancel Plan</a>
                                @else
                                <a href="{{ route('instructor.subscription.create', $package->id) }}"
                                    class="will-subscribe">Get started</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>

            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                tabindex="0">
                <div class="row justify-content-center">
                    @foreach (getSubscriptionPackage() as $package)
                    @php
                    $package_featurelist = explode(',', $package->features);
                    @endphp
                    @if ($package->type == 'yearly')

                    <div class="col-xl-4 col-sm-10 col-md-6 mb-3">
                        <div class="pricing-box">
                            @if ($activePackageId == $package->id)
                                <span class="current-plan">
                                    Current Plan
                                </span>
                            @endif
                            <div>
                                <div class="pricing-icon">
                                    <img src="{{ asset('latest/assets/images/icons/pricing-01.svg') }}" alt="Prici" class="img-fluid light-ele">
                                    <img src="{{ asset('latest/assets/images/icons/pricing-01-d.svg') }}" alt="Prici" class="img-fluid dark-ele mx-auto">
                                </div>
                                <div class="txt">
                                    <h5>{{ $package->name }}</h5>
                                    <h3>

                                        @if ($package->sales_price)
                                        €
                                             {{ str_replace('.00', '', $package->sales_price) }}
                                        @else
                                        €
                                            {{ $package->regular_price > 0 ? ' ' . str_replace('.00', '', $package->regular_price) : 'Free' }}
                                        @endif

                                        <span>/{{ $package->type[0] }}</span>
                                    </h3>
                                    <h6>Billed {{ $package->type }}</h6>
                                    <ul>
                                        @foreach ($package_featurelist as $feature)
                                        <li>
                                            <img src="{{ asset('latest/assets/images/icons/check-circle.svg') }}" alt="Prici" class="img-fluid light-ele">
                                            <img src="{{ asset('latest/assets/images/icons/check-circle-d.svg') }}" alt="Prici" class="img-fluid dark-ele">
                                            <span>{{ $feature }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="bttn">
                                @if ($activePackageId == $package->id)
                                <a href="{{ route('instructor.subscription.status', $package->id) }}"
                                    class="will-subscribe current-plan-bttn">Cancel Plan</a>
                                @else
                                <a href="{{ route('instructor.subscription.create', $package->id) }}"
                                    class="will-subscribe">Get started</a>
                                @endif
                            </div>
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
