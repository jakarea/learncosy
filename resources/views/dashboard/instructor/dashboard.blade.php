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
                    <h1>Welcome back, John Smith</h1>
                    <h6>Your progress this week is Awesome, let’s keep it up.</h6>
                    <h5>Complete your profile</h5>

                    <div class="d_flex">
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar" style="width: 25%"></div>
                        </div>
                        <span>25%</span>
                    </div>
                </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-6">
                <div class="my-courses-box mt-15">
                    <h3>My Courses</h3>

                    <div class="media">
                        <img src="{{ asset('latest/assets/images/coureses.svg') }}" alt="icon" class="img-fluid me-3">
                        <div class="media-body">
                            <h5>UX Design Foundations</h5>
                            <p>Evelyn Gaylord</p>

                            <ul>
                                <li><img src="{{ asset('latest/assets/images/icons/stack.svg') }}" alt="icon" class="img-fluid"> 40 modules</li>
                            </ul>
                        </div>
                        <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                    </div>

                    <div class="media">
                        <img src="{{ asset('latest/assets/images/coureses.svg') }}" alt="icon" class="img-fluid me-3">
                        <div class="media-body">
                            <h5>UX Design Foundations</h5>
                            <p>Evelyn Gaylord</p>

                            <ul>
                                <li><img src="{{ asset('latest/assets/images/icons/stack.svg') }}" alt="icon" class="img-fluid"> 40 modules</li>
                            </ul>
                        </div>
                        <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                    </div>

                    <div class="media">
                        <img src="{{ asset('latest/assets/images/coureses.svg') }}" alt="icon" class="img-fluid me-3">
                        <div class="media-body">
                            <h5>UX Design Foundations</h5>
                            <p>Evelyn Gaylord</p>

                            <ul>
                                <li><img src="{{ asset('latest/assets/images/icons/stack.svg') }}" alt="icon" class="img-fluid"> 40 modules</li>
                            </ul>
                        </div>
                        <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                    </div>

                    <div class="text-center mt-4">
                        <a href="#" class="common-bttn">Create New Course</a>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="recent-payment-box mt-15">
                    <h3>Recent Payment</h3>

                    <div class="payment-box"> 
                        <h5><img src="{{ asset('latest/assets/images/avatar-big.png')}}" alt="a" class="img-fluid"> Bradford Kshlerin</h5>

                        <p>05 Aug 2023</p>
                        <p>$10</p>

                        <a href="#">View</a>
                    </div>
                    <div class="payment-box"> 
                        <h5><img src="{{ asset('latest/assets/images/avatar-big.png')}}" alt="a" class="img-fluid"> Bradford Kshlerin</h5>

                        <p>05 Aug 2023</p>
                        <p>$10</p>

                        <a href="#">View</a>
                    </div>
                    <div class="payment-box"> 
                        <h5><img src="{{ asset('latest/assets/images/avatar-big.png')}}" alt="a" class="img-fluid"> Bradford Kshlerin</h5>

                        <p>05 Aug 2023</p>
                        <p>$10</p>

                        <a href="#">View</a>
                    </div>
                    <div class="payment-box"> 
                        <h5><img src="{{ asset('latest/assets/images/avatar-big.png')}}" alt="a" class="img-fluid"> Bradford Kshlerin</h5>

                        <p>05 Aug 2023</p>
                        <p>$10</p>

                        <a href="#">View</a>
                    </div>

                    <div class="text-center mt-3">
                        <a href="#" class="common-bttn">View All Payment</a>
                    </div>
                </div>
            </div>
         </div>
    </div>
   </main>
@endsection


@section('script')
@endsection
