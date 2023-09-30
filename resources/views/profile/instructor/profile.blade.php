@extends('layouts.latest.instructor')
@section('title')
    My Profile Details
@endsection

{{-- page style @S --}}
@section('style')
    <link href="{{ asset('latest/assets/admin-css/user.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('latest/assets/admin-css/ins-dashboard.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
    @php
        $social_links = explode(',', $user->social_links);
    @endphp
    <main class="user-profile-view-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    {{-- session message @S --}}
                    @include('partials/session-message')
                    {{-- session message @E --}}
                </div>
            </div>
            {{-- profile information @S --}}
            <div class="row">
                <div class="col-lg-8">
                    <div class="user-profile-picture">
                        <div class="cover-img">
                            <img src="{{ asset('latest/assets/images/cover.png') }}" alt="Cover" class="img-fluid">
                        </div>
                        <div class="media">
                            @if ($user->avatar)
                                <img src="{{ asset($user->avatar) }}" alt="{{ $user->name }}" class="img-fluid">
                            @else
                                <span class="avatar-box">{!! strtoupper($user->name[0]) !!}</span>
                            @endif
                            <div class="media-body">
                                <h3>{{ $user->name }}</h3>
                                <p>{{ $user->user_role }}</p>
                            </div>
                            <a href="{{ url('/instructor/profile/account-settings') }}" class="edit-profile">Edit
                                Profile</a>
                        </div>
                    </div>
                    @if ($user->short_bio)
                        <div class="user-details-box">
                            <h5>About Me</h5>
                            <p>{{ $user->short_bio }}</p>
                            {!! $user->description !!}
                        </div>
                    @endif

                    <div class="user-expperience-box">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>Experiences</h4>
                            <div>
                                <a href="{{ url('instructor/profile/edit') }}"><img
                                        src="{{ asset('latest/assets/images/icons/plus.svg') }}" alt="img"
                                        class="img-fluid"></a>
                            </div>
                        </div>
                        @if (count($experiences) > 0)
                            @foreach ($experiences as $experience)
                                <div class="media brdr-bttm">
                                    <img src="{{ asset('latest/assets/images/experience-img.svg') }}" alt="experience-img"
                                        class="img-fluid">
                                    <div class="media-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h5>{{ $experience->profession }}</h5>
                                            <div>
                                                <a href="{{ url('instructor/profile/edit?id=' . $experience->id) }}"><img
                                                        src=" {{ asset('latest/assets/images/icons/pen.svg') }}"
                                                        alt="img" class="img-fluid"></a>
                                            </div>
                                        </div>

                                        <h6>{{ $experience->company_name }} <i class="fas fa-circle"></i>
                                            {{ $experience->job_type }} <i class="fas fa-circle"></i>
                                            {{ $experience->experience }}</h6>
                                        <p>{{ $experience->short_description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div>
                                @include('partials/no-data')
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-info-box">
                        <h4>Contact</h4>
                        <div class="media">
                            <img src="{{ asset('latest/assets/images/icons/email.svg') }}" alt="email"
                                class="img-fluid">
                            <div class="media-body">
                                <h6>Email</h6>
                                <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                            </div>
                        </div>
                        @if ($user->phone)
                            <div class="media">
                                <img src="{{ asset('latest/assets/images/icons/phone.svg') }}" alt="email"
                                    class="img-fluid">
                                <div class="media-body">
                                    <h6>Phone</h6>
                                    <a href="#">{{ $user->phone ? $user->phone : '--' }}</a>
                                </div>
                            </div>
                        @endif

                        @if ($user->social_links)
                            <div class="media">
                                <img src="{{ asset('latest/assets/images/icons/insta.svg') }}" alt="insta"
                                    class="img-fluid">
                                <div class="media-body">
                                    <h6>Instagram</h6>
                                    @if ($user->social_links)
                                        <a href="{{ $user->social_links }}">{{ $user->social_links }}</a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- profile information @E --}}
        </div>
    </main>
@endsection
{{-- page content @E --}}
