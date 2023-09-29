@extends('layouts.latest.instructor')
@section('title', 'Instructor Dashboard')
{{-- page style @S --}}
@section('style')

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
                <div class="col-lg-6">
                    <div class="my-courses-box mt-15">
                        <h3>My Courses</h3>

                        <div class="course-box-overflown">
                            @foreach ($courses as $course)
                                <div class="media">
                                    <img src="{{ asset('latest/assets/images/coureses.svg') }}" alt="icon"
                                        class="img-fluid me-3">
                                    <div class="media-body">
                                        <h5>{{ $course->title }}</h5>

                                        <ul class="mt-1">
                                            <li><img src="{{ asset('latest/assets/images/icons/stack.svg') }}"
                                                    alt="icon" class="img-fluid"> {{ $course->number_of_module }}
                                                modules</li>
                                        </ul>
                                    </div>
                                    <a href="{{ url('instructor/courses/' . $course->slug) }}"><i
                                            class="fa-solid fa-ellipsis-vertical"></i></a>
                                </div>
                            @endforeach
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ url('instructor/courses/create') }}" class="common-bttn">Create New Course</a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="recent-payment-box mt-15">
                        <h3>Recent Payment</h3>
                        @foreach ($payments->slice(0, 4) as $payment)
                            <div class="payment-box">
                                <h5><img src="{{ asset('assets/images/users/' . $payment->user->avatar) }}" alt="a"
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

                        <div class="text-center mt-3">
                            <a href="{{ url('instructor/payments') }}" class="common-bttn">View All Payment</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="my-courses-box mt-15 recent-update-box">
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
                <div class="col-lg-6">
                    <div class="my-courses-box mt-15 recent-update-box">
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
