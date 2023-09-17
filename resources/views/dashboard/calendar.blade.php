@extends('layouts/dashboard')
@section('title')Calendar @endsection

{{-- page style @S --}}
@section('style')
<link rel="stylesheet" href="{{asset('dashboard-assets/css/calendar.css')}}">
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('contents')
 <!-- calendar page wrapper @s -->
 <section class="common-page-wrap calendar-page-wrap">
    <div class="card-box">
      <h1>Calendar Plugin here...(comming soon)</h1>
    </div>
  </section>
  <!-- calendar page wrapper @e -->
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
<script src="{{asset('dashboard-assets/js/config.js')}}"></script>
@endsection
{{-- page script @E --}}