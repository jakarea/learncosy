@extends('layouts.latest.admin')
@section('title') Instructor Profile Details @endsection

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
                        <img src="{{ asset('latest/assets/images/cover.png') }}" alt="Cover" class="img-fluid">
                    </div>
                    <div class="media">
                        @if($instructor->avatar)
                        <img src="{{ asset($instructor->avatar) }}" alt="{{$instructor->name}}"
                            class="img-fluid">
                        @else
                        <span class="avatar-box">{!! strtoupper($instructor->name[0]) !!}</span>
                        @endif
                        <div class="media-body">
                            <h3>{{$instructor->name}}</h3>
                            <p>{{$instructor->user_role}}</p>
                        </div>
                    </div>
                </div>
                <div class="user-details-box">
                    <h5>About Me</h5> 
                    {!! $instructor->description !!}
                </div>

                <div class="user-expperience-box">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Experiences</h4> 
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
                        <img src="{{ asset('latest/assets/images/icons/email.svg') }}" alt="email" class="img-fluid">
                        <div class="media-body">
                            <h6>Email</h6>
                            <a href="mailto:{{$instructor->email}}">{{$instructor->email}}</a>
                        </div>
                    </div>
                    <div class="media">
                        <img src="{{ asset('latest/assets/images/icons/phone.svg') }}" alt="email" class="img-fluid">
                        <div class="media-body">
                            <h6>Phone</h6>
                            <a href="#">{{$instructor->phone ? $instructor->phone : '--'}}</a>
                        </div>
                    </div>
                    <div class="media">
                        <img src="{{ asset('latest/assets/images/icons/globe.svg') }}" alt="email" class="img-fluid">
                        <div class="media-body">
                            <h6>Website</h6>
                            <a href="#">{{$instructor->short_bio ? $instructor->short_bio : '--'}}</a>
                        </div>
                    </div>
                </div>
                <div class="contact-info-box mt-4">
                    <h4>Payment Log</h4> 

                    @if (count($subscription) > 0)
                        @foreach($subscription as $key => $payment)
                            <div class="media flex-column"> 
                                <div class="media-body mb-2">
                                    <h6>Payment ID:</h6>
                                    <a href="#" class="color-para">{{$payment->stripe_plan}}</a>
                                </div>
                                <div class="media-body mb-2">
                                    <h6>Instructor  Email:</h6>
                                    <a href="mailto:{{$payment->instructor->email}}" class="color-para">{{$payment->instructor->email}}</a>
                                </div>
                                <div class="media-body mb-2">
                                    <h6>Start At:</h6>
                                    <a href="#" class="color-para">{{ date('D M d Y H:i:s', strtotime($payment->start_at)) }}</a>
                                </div>
                                <div class="media-body mb-2">
                                    <h6>End At:</h6>
                                    <a href="#" class="color-para">{{$payment->end_at ? date('D M d Y H:i:s', strtotime($payment->end_at)) : 'N/A'}}</a>
                                </div>
                                <div class="media-body">
                                    <h6>Duration:</h6>
                                    <a href="#" class="color-para">
                                        @if($payment->end_at)
                                            {{\Carbon\Carbon::parse($payment->start_at)->diffInDays(\Carbon\Carbon::parse($payment->end_at))}} Days
                                        @else
                                            N/A
                                        @endif    
                                    </a>
                                </div>
                            </div> 
                        @endforeach
                    @else
                    <div class="media"> 
                        <div class="media-body"> 
                            <a href="#" class="text-danger">No Log Found!</a>
                        </div>
                    </div> 
                    @endif
                </div>
                <div class="contact-info-box mt-4">
                    <h4>Social Link</h4>
                    @php
                    $social_links = explode(",", $instructor->social_links);
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
                        @else
                        <img src="{{ asset('latest/assets/images/icons/globe.svg') }}" alt="linkedin" class="img-fluid">
                        @endif
                        
                        <div class="media-body">
                            <h6>{{ $domain ? $domain : 'No Social Account Found!' }}</h6>
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