@extends('layouts.latest.admin')
@section('title') My Profile Details @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="user-profile-view-page">
    <div class="container-fluid"> 
        {{-- profile information @S --}}
        <div class="row">
            <div class="col-lg-8">
                <div class="user-profile-picture">
                    <div class="cover-img">
                        <img src="{{ asset('latest/assets/images/cover.svg') }}" alt="Cover" class="img-fluid">
                    </div>
                    <div class="media">
                        @if($user->avatar)
                        <img src="{{ asset($user->avatar) }}" alt="{{$user->name}}"
                            class="img-fluid">
                        @else
                        <span class="avatar-box">{!! strtoupper($user->name[0]) !!}</span>
                        @endif
                        <div class="media-body">
                            <h3>{{$user->name}}</h3>
                            <p class="text-capitalize">{{$user->user_role}}</p>
                        </div> 
                    </div>
                </div>
                <div class="user-details-box">
                    <h5>About Me</h5>
                    @if (!$user->description)
                        @include('partials/no-data')
                    @else 
                    {!! $user->description !!}
                    @endif
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
                        <img src="{{ asset('latest/assets/images/icons/globe.svg') }}" alt="linkedin" class="img-fluid">
                        <div class="media-body">
                            <h6>Website</h6>
                            <a href="#">{{$user->short_bio ? $user->short_bio : '--'}}</a>
                        </div>
                    </div> 
                </div> 
                <div class="contact-info-box mt-4">
                    <h4>Social Link</h4>
                    
                    @php
                    $social_links = explode(",", $user->social_links);
                    use Illuminate\Support\Str;
                    @endphp 

                    @foreach ($social_links as $social_link)
                    @php
                    $url = $social_link;
                    $host = parse_url($url, PHP_URL_HOST);
                    $domain = Str::after($host, 'www.');
                    $domain = Str::before($domain, '.');
                    @endphp 
                    
                    <div class="media">
                        @if ($domain == 'linkedin')
                        <img src="{{ asset('latest/assets/images/icons/linkedin.svg') }}" alt="linkedin" class="img-fluid">
                        @elseif ($domain == 'instagram')
                        <img src="{{ asset('latest/assets/images/icons/insta.svg') }}" alt="insta" class="img-fluid">
                        @elseif ($domain == 'twitter')
                        <img src="{{ asset('latest/assets/images/icons/twitter.svg') }}" alt="twitter" class="img-fluid">
                        @elseif ($domain == 'facebook')
                        <i class="fa-brands fa-facebook-square" style="color: rgba(28, 28, 28, 0.626); font-size: 1.3rem; margin-right: 1rem; width: 24px;
                        height: 24px;
                        margin-top: 0.5rem;"></i>
                        @else
                        <img src="{{ asset('latest/assets/images/icons/globe.svg') }}" alt="linkedin" class="img-fluid">
                        @endif
                        
                        <div class="media-body">
                            <h6 class="text-capitalize">{{ $domain ? $domain : '' }}</h6>
                            <a href="{{ $social_link ? $social_link : '#' }}">{{ $social_link ? $social_link : '' }}</a>
                        </div>
                    </div>
                    @endforeach
 
                </div>
            </div>
        </div>
        {{-- profile information @E --}}
    </div>
</main>
@endsection
{{-- page content @E --}} 