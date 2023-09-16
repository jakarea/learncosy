@extends('layouts.latest.instructor')
@section('title') My Profile Details @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/ins-dashboard.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
@php
$social_links = explode(",", $user->social_links);
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
                        @if($user->avatar)
                        <img src="{{ asset('assets/images/users/'.$user->avatar) }}" alt="{{$user->name}}"
                            class="img-fluid">
                        @else
                        <span class="avatar-box">{!! strtoupper($user->name[0]) !!}</span>
                        @endif
                        <div class="media-body">
                            <h3>{{$user->name}}</h3>
                            <p>{{$user->user_role}}</p>
                        </div>
                        <a href="{{url('instructor/profile/edit') }}" class="edit-profile">Edit Profile</a>
                    </div>
                </div>
                <div class="user-details-box">
                    <h5>About Me</h5>
                    <p>{{ $user->short_bio }}</p>
                    {!! $user->description !!}
                </div>

                <div class="user-expperience-box">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Experiences</h4>
                        <div>
                            <a href="{{url('instructor/profile/edit')}}"><img src="{{ asset('latest/assets/images/icons/plus.svg') }}" alt="img"
                                    class="img-fluid"></a>
                        </div>
                    </div>


                    @foreach ($experiences as $experience)
                    <div class="media brdr-bttm">
                        <img src="{{ asset('latest/assets/images/experience-img.svg') }}" alt="experience-img"
                            class="img-fluid">
                        <div class="media-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5>{{ $experience->profession }}</h5>
                                <div> 
                                    <a href="{{ url('instructor/profile/edit?id='.$experience->id )}}"><img
                                            src=" {{ asset('latest/assets/images/icons/pen.svg')   }}" alt="img"
                                            class="img-fluid"></a>
                                </div>
                            </div>

                            <h6>{{ $experience->company_name }} <i class="fas fa-circle"></i> {{ $experience->job_type
                                }} <i class="fas fa-circle"></i> {{ $experience->experience }}</h6>
                            <p>{{ $experience->short_description }}</p>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-info-box">
                    <h4>Contact</h4>
                    <div class="media">
                        <img src="{{ asset('latest/assets/images/icons/email.svg') }}" alt="email" class="img-fluid">
                        <div class="media-body">
                            <h6>Email</h6>
                            <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                        </div>
                    </div>
                    <div class="media">
                        <img src="{{ asset('latest/assets/images/icons/phone.svg') }}" alt="email" class="img-fluid">
                        <div class="media-body">
                            <h6>Phone</h6>
                            <a href="#">{{$user->phone ? $user->phone : '--'}}</a>
                        </div>
                    </div>
                    <div class="media">
                        <img src="{{ asset('latest/assets/images/icons/insta.svg') }}" alt="insta" class="img-fluid">
                        <div class="media-body">
                            <h6>Instagram</h6>
                            @if ($user->social_links)
                            <a href="{{ $user->social_links }}">{{ $user->social_links }}</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- profile information @E --}}
    </div>
</main>
@endsection
{{-- page content @E --}}