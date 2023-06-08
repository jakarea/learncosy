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
        
        @can('admin')
            <!-- Content only visible to users with the 'admin' role -->
            <p>Welcome, admin!</p>
        @endcan

        @can('instructor')
            <!-- Content only visible to users with the 'instructor' role -->
            <p>Welcome, instructor!</p>
        @endcan

        @can('student')
            <!-- Content only visible to users with the 'user' role -->
            <p>Welcome, Student!</p>
        @endcan


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
                        <a href="{{ route('instructor.subscription.create', $package->id) }}" class="btn btn-primary btn-block">Subscribe</a>
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