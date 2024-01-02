@php 
    $path = auth()->user()->user_role;
    if ($path == 'student') {
        $path = 'students';
    }
@endphp

@extends('layouts.latest.' . $path)
@section('title') 404 - Eror Page @endsection

{{-- page style @S --}}
@section('style')

@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="user-profile-view-page">
     <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="error-page-txt">
                    <img src="{{ asset('latest/assets/images/404.png') }}" alt="error" class="img-fluid">
                    <h1>404 Not Found</h1>
                    <p>The page you are looking for doesn't exist or has been moved.</p>

                    <a href="#">Back to the homepage <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
     </div>
</main> 

@endsection
{{-- page content @E --}}

{{-- script --}}
@section('script')

@endsection
{{-- script --}}