@extends('layouts.latest.instructor')
@section('title','Subscription List Page')

@section('style')
<link rel="stylesheet" href="{{ asset('latest/assets/auth-css/pricing.css') }}">
@endsection

@section('content')
<!-- pricing plan page start -->

<section class="pricing-plan-sec pt-5">
    <div class="container">
        {{ Auth::id() }}
    </div>
</section>
<!-- pricing plan page end -->
@endsection
