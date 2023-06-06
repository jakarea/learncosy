@extends('layouts/instructor')
@section('title') Home Page @endsection

{{-- page style @S --}}
@section('style')

@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="d-flex justify-content-center align-items-center">
    <!-- <h1>Welcome To LearnCosy</h1> -->
    <div class="subscription-package col-12">
        @include('partials.session-message')
        <div class="row">
            @foreach( getSubscriptionPackage() as $package )
            @php 
                $package_featurelist = json_decode($package->features);
            @endphp
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-header text-center">
                        <h3>{{ $package->name }}</h3>
                    </div>
                    <div class="card-body text-center">
                        <h2>{{ $package->amount }}<small><sup>$</sup></small></h2>
                        @if($package_featurelist)
                            @foreach($package_featurelist as $feature)
                                <p>{{ $feature }}</p>
                            @endforeach
                        @endif
                    </div>
                    <div class="card-footer text-center">
                    @if (!isSubscribed($package->id))
                        <a href="{{ route('subscription.create', $package->id) }}" class="btn btn-primary btn-block">Subscribe</a>
                    @else
                    <a href="#" class="btn btn-secondary btn-block" disabled>Subscribed</a>
                    @endif

                    </div>
                </div>
            </div>
            @endforeach
            <!-- <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-header text-center">
                        <h3>Standard</h3>
                    </div>
                    <div class="card-body text-center">
                        <h2>100<small><sup>$</sup></small></h2>
                        <p>per month</p>
                        <p>10 course</p>
                        <p>10 instructor</p>
                        <p>10 student</p>
                        <p>10 GB storage</p>
                        <p>10 GB bandwidth</p>
                        <p>10 admin</p>
                        <p>10 support</p>
                        <p>10 certificate</p>
                        <p>10 quiz</p>
                        <p>10 assignment</p>
                        <p>10 discussion</p>
                        <p>10 announc ement</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('subscription.create', auth()->user()->id) }}" class="btn btn-primary">Subscribe</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger text-white">
                    <div class="card-header text-center">
                        <h3>Premium</h3>
                    </div>
                    <div class="card-body text-center">
                        <h2>200<small><sup>$</sup></small></h2>
                        <p>per month</p>
                        <p>20 course</p>
                        <p>20 instructor</p>
                        <p>20 student</p>
                        <p>20 GB storage</p>
                        <p>20 GB bandwidth</p>
                        <p>20 admin</p>
                        <p>20 support</p>
                        <p>20 certificate</p>
                        <p>20 quiz</p>
                        <p>20 assignment</p>
                        <p>20 discussion</p>
                        <p>20 announc ement</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('subscription.create', auth()->user()->id) }}" class="btn btn-primary">Subscribe</a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</main>
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}