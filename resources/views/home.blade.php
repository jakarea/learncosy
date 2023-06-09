@extends('layouts/instructor')
@section('title') Home Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class=""> 
    <div class="subscription-package col-12">
        @include('partials.session-message')
        <div class="header-title">
            @can('admin')
            <!-- Content only visible to users with the 'admin' role -->
            <h2>Welcome, admin!</h2>
            @endcan

            @can('instructor')
                <!-- Content only visible to users with the 'instructor' role -->
                <h2>Welcome, instructor!</h2>
            @endcan

            @can('student')
                <!-- Content only visible to users with the 'user' role -->
                <h2>Welcome, Student!</h2>
            @endcan
        </div>

        <div class="row justify-content-center">
            @foreach( getSubscriptionPackage() as $package )
            @php 
                $package_featurelist = json_decode($package->features);
            @endphp
            <div class="col-md-4">
                <div class="card ">
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
                        <a href="{{ route('instructor.subscription.create', $package->id) }}" class="btn btn-block">Subscribe</a>
                    @else
                    <a href="#" class="btn btn-secondary btn-block" disabled>Subscribed</a>
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