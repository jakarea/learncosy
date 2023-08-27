@extends('layouts.latest.admin')
@section('title') Student Profile Details Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content') 
@php
    $social_links = explode(",", $student->social_links);
    use Illuminate\Support\Str;
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
                        @if($student->avatar)
                        <img src="{{ asset('assets/images/users/'.$student->avatar) }}" alt="{{$student->name}}"
                            class="img-fluid">
                        @else
                        <span class="avatar-box">{!! strtoupper($student->name[0]) !!}</span>
                        @endif
                        <div class="media-body">
                            <h3>{{$student->name}}</h3>
                            <p>{{$student->user_role}}</p>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="col-lg-4">
                <div class="contact-info-box">
                    <h4>Contact</h4>
                    <div class="media">
                        <img src="{{ asset('latest/assets/images/icons/email.svg') }}" alt="email" class="img-fluid">
                        <div class="media-body">
                            <h6>Email</h6>
                            <a href="mailto:{{$student->email}}">{{$student->email}}</a>
                        </div>
                    </div>
                    <div class="media">
                        <img src="{{ asset('latest/assets/images/icons/phone.svg') }}" alt="email" class="img-fluid">
                        <div class="media-body">
                            <h6>Phone</h6>
                            <a href="#">{{$student->phone ? $student->phone : '--'}}</a>
                        </div>
                    </div> 
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
                            <h6>{{ $domain ? $domain : '--' }}</h6>
                            <a href="{{ $social_link ? $social_link : '#' }}">{{ $social_link ? $social_link : '--' }}</a>
                        </div>
                    </div>
                    @endforeach
                </div> 
            </div>
            <div class="col-lg-12">
                <div class="user-details-box">
                    <h5>About Me</h5>
                    <p>{{ $student->short_bio }}</p>
                    {!! $student->description !!}
                </div>
            </div>
            <div class="col-lg-12">
                <div class="enroll-course-list">
                    <h4>Enrolled Course List :</h4>
                    <div class="list-wrap">
                        <table>
                            <tr>
                                <th width="5%">No</th>
                                <th>Payment ID</th> 
                                <th>Course Name</th>
                                <th>Course Instructor</th>
                                <th>Payment Date</th>
                                <th>Payment Amount</th>
                                <th>Payment Status</th>
                                <th>Action</th>
                            </tr> 
                            {{-- item @S --}} 
                            @foreach($checkout as $key => $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->payment_id}}</td>
                                <td>{{$value->course->title}}</td>
                                <td>{{$value->course->user->name}}</td>
                                <td>{{$value->created_at}}</td>
                                <td>€ {{$value->amount}}</td>
                                <td>
                                    @if($value->status == 'completed')
                                        <span>Success</span>
                                    @else
                                        <span class="bg-danger">Failed</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/courses/'.$value->course->slug)}}" class="common-bttn text-white">View</a>
                                </td>
                            </tr> 
                            @endforeach
                            {{-- item @E --}} 
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- profile information @E --}}
    </div>
</main>
@endsection
{{-- page content @E --}}