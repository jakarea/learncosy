@extends('layouts/instructor')
@section('title') Pacakge Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="subscription page">
    <div class="subscription-package col-12">
        @include('partials.session-message')
        <div class="row justify-content-center">
            @foreach( getSubscriptionPackage() as $package )
            @php
            $package_featurelist = json_decode($package->features);
            @endphp
            <div class="col-lg-5 col-xl-4 col-12 col-sm-9 col-md-6">
                <div class="price-package-box">
                    @if (isSubscribed($package->id))
                    <div class="current-package">
                        <span>Current Package</span>
                    </div>
                    @endif
                    <div class="package-title">
                        @if ($package->id == 1)
                        <h4><i class="fa-regular fa-star"></i> Lite </h4>
                        @elseif ($package->id == 2)
                        <h4><i class="fas fa-star"></i> Premium </h4>
                        @endif

                        @if ($package->id == 2)
                        <p>This is a large package</p>
                        @else
                        <p>This is a lite package</p>
                        @endif

                    </div>
                    <div class="package-price pb-0">
                        <h3><span>€</span>{{ $package->amount }}<u> /per month</u></h3>
                    </div>
                    <div class="package-features">
                        <h6>Features includes:</h6>
                        @if($package_featurelist)
                        <ul>
                            @foreach($package_featurelist as $feature)
                            <li><i class="fas fa-check"></i>
                                <p> {{ $feature }}</p>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    <div class="package-price">
                        @if (!isSubscribed($package->id))
                        <a href="{{ route('instructor.subscription.create', $package->id) }}" class="will-subscribe">Get
                            started</a>
                        @else
                        <a href="#" class="subscribed">Subscribed</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}