@extends('layouts.latest.instructor')
@section('title', 'Instructor Dashboard')
{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/student-dash.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <main class="instructor-dashboard-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="welcome-back-box">
                        <h1>Welcome back, {{ auth::user()->name }}</h1>
                        <h6>Your progress this week is Awesome, let's keep it up.</h6>
                        <h5>Complete your profile</h5>

                        <div class="d_flex">
                            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 75%"></div>
                            </div>
                            <span>75%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mt-15">
                    <div class="my-courses-box">
                        <h3>My Courses</h3> 
                        <div class="course-box-overflown liked-courses">
                            @if (count($courses) > 0)
                            @foreach ($courses as $myCourses) 
                            @php
                             $totalLessons = 0;
                                foreach ($myCourses->modules as $module) {
                                    $totalLessons = count($module->lessons);
                                }
                            @endphp  
                            <div class="media">
                                @if ($myCourses->thumbnail)
                                <img src="{{ asset($myCourses->thumbnail) }}" alt="Thumbnail" class="img-fluid me-3 thumab">
                                @else
                                <img src="{{ asset('latest/assets/images/course-small.svg') }}" alt="a"
                                    class="img-fluid me-3 thumab">
                                @endif
                                <div class="media-body">
                                    <h5>{{ $myCourses->title }}</h5>
                                    <p class="user">{{ $myCourses->platform }}</p>  
                                    <p class="lessons">
                                        <img src="{{ asset('latest/assets/images/icons/modules.svg') }}" alt="a" class="img-fluid">
                                         {{ count($myCourses->modules) }} Modules &nbsp;&nbsp; 
                                         <img src="{{ asset('latest/assets/images/icons/modules.svg') }}" alt="a" class="img-fluid"> {{ $totalLessons }} Lessons
                                    </p>
                                </div>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-filter" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i
                                        class="fa-solid fa-ellipsis-vertical"></i></button>
            
                                    <ul class="dropdown-menu">
                                        <li>
                                            <form action="{{ route('course.destroy',$myCourses->id) }}" method="POST" class="d-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn p-0 dropdown-item">Delete</button>
                                            </form> 
                                        </li>
                                        <li><a class="dropdown-item" href="{{ url('instructor/courses/'.$myCourses->slug) }}">View</a></li> 
                                    </ul>
                                </div> 
                            </div>
                            @endforeach
                            @else
                                @include('partials/no-data')
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-15">
                    <div class="recent-payment-box">
                        <h3>Recent Payment</h3>
                        @if (count($payments) > 0) 
                        @foreach ($payments->slice(0, 5) as $payment)
                            <div class="payment-box">
                                <h5><img src="{{ asset($payment->user->avatar) }}" alt="Avatar"
                                        class="img-fluid"> {{ $payment->user->name }}</h5>

                                <p>
                                    @if ($payment->status == 'completed')
                                        <span style="color: #2A920B;">{{ $payment->status }}</span>
                                    @else
                                        <span
                                            style="color: #ED5763; background: transparent;">{{ $payment->status }}</span>
                                    @endif
                                </p>
                                <p>€ {{ $payment->amount }}</p>

                                <a href="{{ url('instructor/payments', encrypt($payment->payment_id)) }}">View</a>
                            </div>
                        @endforeach
                        @if (count($payments) > 5)
                        <div class="text-center mt-3">
                            <a href="{{ url('instructor/payments') }}" class="common-bttn">View All Payment</a>
                        </div>
                        @endif 
                        @else 
                        @include('partials/no-data')
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mt-15">
                    <div class="my-courses-box recent-update-box">
                        <h3>Recent Updates</h3>

                        <div class="media">
                            <img src="{{ asset('latest/assets/images/susmita-bahar.png') }}" alt="icon"
                                class="img-fluid me-3 user">
                            <div class="media-body">
                                <h5>Susmita Bahar- Enrolled to UX Foundation Course</h5>
                                <p>Evelyn Gaylord</p>

                                <ul>
                                    <li><img src="{{ asset('latest/assets/images/clock.svg') }}" alt="icon"
                                            class="img-fluid"> 1 min ago</li>
                                </ul>
                            </div>
                            <a href="#"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                        <div class="media">
                            <img src="{{ asset('latest/assets/images/update-2.png') }}" alt="icon"
                                class="img-fluid me-3 user">
                            <div class="media-body">
                                <h5>Susmita Bahar- Enrolled to UX Foundation Course</h5>
                                <p>Evelyn Gaylord</p>

                                <ul>
                                    <li><img src="{{ asset('latest/assets/images/clock.svg') }}" alt="icon"
                                            class="img-fluid"> 1 min ago</li>
                                </ul>
                            </div>
                            <a href="#"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                        <div class="media">
                            <img src="{{ asset('latest/assets/images/update-3.png') }}" alt="icon"
                                class="img-fluid me-3 user">
                            <div class="media-body">
                                <h5>Susmita Bahar- Enrolled to UX Foundation Course</h5>
                                <p>Evelyn Gaylord</p>

                                <ul>
                                    <li><img src="{{ asset('latest/assets/images/clock.svg') }}" alt="icon"
                                            class="img-fluid"> 1 min ago</li>
                                </ul>
                            </div>
                            <a href="#"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                        <div class="media">
                            <img src="{{ asset('latest/assets/images/update-5.png') }}" alt="icon"
                                class="img-fluid me-3 user">
                            <div class="media-body">
                                <h5>Susmita Bahar- Enrolled to UX Foundation Course</h5>
                                <p>Evelyn Gaylord</p>

                                <ul>
                                    <li><img src="{{ asset('latest/assets/images/clock.svg') }}" alt="icon"
                                            class="img-fluid"> 1 min ago</li>
                                </ul>
                            </div>
                            <a href="#"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                        <div class="media">
                            <img src="{{ asset('latest/assets/images/update-4.png') }}" alt="icon"
                                class="img-fluid me-3 user">
                            <div class="media-body">
                                <h5>Susmita Bahar- Enrolled to UX Foundation Course</h5>
                                <p>Evelyn Gaylord</p>

                                <ul>
                                    <li><img src="{{ asset('latest/assets/images/clock.svg') }}" alt="icon"
                                            class="img-fluid"> 1 min ago</li>
                                </ul>
                            </div>
                            <a href="#"><i class="fa-solid fa-trash-can"></i></a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 mt-15">
                    <div class="my-courses-box recent-update-box">
                        <h3>System Updates</h3>

                        <div class="media">
                            <div class="media-body">
                                <h5>Complete your certificate for Ux design course </h5>
                                <p>Evelyn Gaylord</p>

                                <ul>
                                    <li><img src="{{ asset('latest/assets/images/clock.svg') }}" alt="icon"
                                            class="img-fluid"> 1 min ago</li>
                                </ul>
                            </div>
                            <a href="#"><img src="{{ asset('latest/assets/images/circle-q.svg') }}" alt="icon"
                                    class="img-fluid light-ele">
                                <img src="{{ asset('latest/assets/images/cir-2.svg') }}" alt="icon"
                                    class="img-fluid dark-ele"></a>
                        </div>
                        <div class="media">
                            <div class="media-body">
                                <h5>Complete your certificate for Ux design course </h5>
                                <p>Evelyn Gaylord</p>

                                <ul>
                                    <li><img src="{{ asset('latest/assets/images/clock.svg') }}" alt="icon"
                                            class="img-fluid"> 1 min ago</li>
                                </ul>
                            </div>
                            <a href="#"><img src="{{ asset('latest/assets/images/circle-q.svg') }}" alt="icon"
                                    class="img-fluid light-ele">
                                <img src="{{ asset('latest/assets/images/cir-2.svg') }}" alt="icon"
                                    class="img-fluid dark-ele"></a>
                        </div>
                        <div class="media">
                            <div class="media-body">
                                <h5>Complete your certificate for Ux design course </h5>
                                <p>Evelyn Gaylord</p>

                                <ul>
                                    <li><img src="{{ asset('latest/assets/images/clock.svg') }}" alt="icon"
                                            class="img-fluid"> 1 min ago</li>
                                </ul>
                            </div>
                            <a href="#"><img src="{{ asset('latest/assets/images/circle-q.svg') }}" alt="icon"
                                    class="img-fluid light-ele">
                                <img src="{{ asset('latest/assets/images/cir-2.svg') }}" alt="icon"
                                    class="img-fluid dark-ele"></a>
                        </div>
                        <div class="media">
                            <div class="media-body">
                                <h5>Complete your certificate for Ux design course </h5>
                                <p>Evelyn Gaylord</p>

                                <ul>
                                    <li><img src="{{ asset('latest/assets/images/clock.svg') }}" alt="icon"
                                            class="img-fluid"> 1 min ago</li>
                                </ul>
                            </div>
                            <a href="#"><img src="{{ asset('latest/assets/images/circle-q.svg') }}" alt="icon"
                                    class="img-fluid light-ele">
                                <img src="{{ asset('latest/assets/images/cir-2.svg') }}" alt="icon"
                                    class="img-fluid dark-ele"></a>
                        </div>
                        <div class="media">
                            <div class="media-body">
                                <h5>Complete your certificate for Ux design course </h5>
                                <p>Evelyn Gaylord</p>

                                <ul>
                                    <li><img src="{{ asset('latest/assets/images/clock.svg') }}" alt="icon"
                                            class="img-fluid"> 1 min ago</li>
                                </ul>
                            </div>
                            <a href="#">
                                <img src="{{ asset('latest/assets/images/circle-q.svg') }}" alt="icon"
                                    class="img-fluid light-ele">
                                <img src="{{ asset('latest/assets/images/cir-2.svg') }}" alt="icon"
                                    class="img-fluid dark-ele">
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


@section('script')
@endsection
