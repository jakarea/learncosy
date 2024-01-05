@php
    $path = '';
    if (Auth::check()) {
        $user = auth()->user();
        $path = $user->user_role == 'student' ? 'layouts.latest.students' : '';
    }
@endphp

@extends(!empty($path) ? $path : 'partials.guest.guest')

@section('style')
    <link href="{{ asset('latest/assets/admin-css/style.css') }}" rel="stylesheet" type="text/css" />
@endsection




@section('title') 500 - Eror Page @endsection


{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
    <main class="user-profile-view-page">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="error-page-txt">
                        <img src="{{ asset('latest/assets/images/404.png') }}" alt="error" class="img-fluid">
                        <h1>500 internal server error</h1>
                        <p>500 Internal Server Error. Sorry something went wrong.</p>
                        <a href="{{ url('/')}}">Back to the homepage <i class="fas fa-arrow-right"></i></a>
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
