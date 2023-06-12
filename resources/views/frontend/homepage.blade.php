@extends('layouts/guest')
@section('title') Guest Home Page @endsection

{{-- page style @S --}}
@section('style') 

@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')

{{-- hero section @s --}}
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6  ">
                <div class="hero-txt-wrap">
                    <h1>Online Instructor for Computer Courses</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima accusamus doloremque et hic sed
                        alias, accusantium quod cum aspernatur eligendi!</p>
                    <div class="hero-bttn">
                        <a href="{{url('/login')}}">Get Started</a>
                    </div>
                    @if (count($students) > 1)
                    <h6>Already {{ count($students) }} Students are joined!</h6>
                    @elseif(count($students) == 1)
                    <h6>Already {{ count($students) }} Student are joined!</h6>
                    @elseif(count($students) <= 0) <h6>Join Now!</h6>
                        @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-img-box">
                    <img src="{{asset('assets/images/desk-vector.png') }}" alt="desk-vector" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
{{-- hero section @e --}}

{{-- course filter box @s --}}
<div class="course-filter-wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="" method="GET">
                    <div class="course-filter-box">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" placeholder="Search with title" name="title" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="categories">Category</label>  
                            @php 
                                $categoriesg = isset($_GET['categories']) ? $_GET['categories'] : '';
                            @endphp
                            <select name="categories" id="categories" class="form-control">
                                <option value="">Select Below</option> 
                                @foreach ($instructors->courses as $course)   
                                    @foreach (explode(",",$course->categories) as $categ)
                                        <option value="{{$categ}}" {{ $categoriesg == $categ ? 'selected' : ''}}>{{$categ}}</option> 
                                    @endforeach
                                @endforeach
                            </select>
                            <i class="fas fa-angle-down"></i>
                        </div>
                        <div class="form-group">
                            <label for="subscription_status">Subscription</label> 
                            @php 
                                $subscriptionStatus = isset($_GET['subscription_status']) ? $_GET['subscription_status'] : '';
                            @endphp 
                            <select name="subscription_status" id="subscription_status" class="form-control">
                                <option value="">Select Below</option> 
                                <option value="one_time" {{ $subscriptionStatus == 'one_time' ? 'selected' : ''}}>One Time</option>
                                <option value="monthly" {{ $subscriptionStatus == 'monthly' ? 'selected' : ''}}>Monthly</option>
                                <option value="anully" {{ $subscriptionStatus == 'anully' ? 'selected' : ''}}>Anully</option>
                                <option value="free" {{ $subscriptionStatus == 'free' ? 'selected' : ''}}>Free</option>
                            </select>
                            <i class="fas fa-angle-down"></i>
                        </div>
                        <div class="form-group me-0">
                            <label for="price">Review</label>
                            <input type="number" placeholder="Enter your budget" name="price" id="price" class="form-control" min="1">
                        </div>
                        <div class="filter-bttn">
                            <button type="reset" class="btn btn-reset">Clear</button>
                            <button type="submit" class="btn btn-submit">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- course filter box @e --}}

{{-- course wrap @s --}}
<div class="course-section-wrap" id="course_sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="course-list-wrap">
                    @foreach ($instructors->courses as $course)
                    {{-- course item @s --}}
                    <div class="course-item-box">
                        <div class="row">
                            <div class="col-lg-9 col-md-8">
                                <div class="media">
                                    <div class="course-thumbnail">
                                        <img src="{{asset('assets/images/courses/'.$course->thumbnail)}}"
                                            alt="Course thumbnaik" class="img-fluid">
                                    </div>
                                    <div class="media-body">
                                        <h4>{{$course->title}}</h4>

                                        @php $courseCategories = explode(",",$course->categories) @endphp

                                        <div class="course-categories">
                                            @foreach ($courseCategories as $courseCategory)
                                            <span class="badge text-bg-info">{{$courseCategory}}</span>
                                            @endforeach
                                        </div>

                                        <p>{{ Str::limit($course->short_description, $limit = 158, $end = '...') }}</p>

                                        <a href="{{url($instructors->username.'/courses/'.$course->slug) }}">Read
                                            More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="course-actions">
                                    <div class="review">
                                        <h5><i class="fas fa-star"></i></h5>
                                        <p>
                                            @if (count($course->reviews) > 1)
                                            {{ count($course->reviews) }} reviews
                                            @elseif(count($course->reviews) == 1)
                                            {{ count($course->reviews) }} review
                                            @elseif(count($course->reviews) <= 0)
                                            No review yet!
                                            @endif
                                        </p> 
                                    </div>
                                    <div class="bttns"> 
                                        <a href="{{url($instructors->username.'/courses/'.$course->slug) }}">More
                                            Details</a>
                                        <a href="{{url('/students/dashboard/enrolled')}}">Enroll Now!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- course item @e --}}
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="course-instructor me-md-2 me-lg-0">
                    <div class="thumbnail">
                        <img src="{{asset('assets/images/instructor/'.$instructors->avatar)}}" alt="Avatar"
                            class="img-fluid">
                    </div>
                    <div class="txt">
                        <h4>{{$instructors->name}}</h4>
                        <h5>{{ Str::limit($instructors->short_bio, $limit = 58, $end = '...') }}</h5>
                        <a href="{{url('/students/dashboard')}}">Get more details!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- course wrap @e --}}

{{-- bundle course @s --}}
<div class="bundle-course-wrap" id="b_course_sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="bundle-course-head">
                    <h2>Bundle Courses</h2>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Incidunt, similique.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="browse-all">
                    <a href="{{url('/students/dashboard')}}">Browse all <i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($bundle_courses as $bundle_course)
            <div class="col-lg-4 col-md-6">
                <div class="bundle-course-box">
                    <div class="thumbnail">
                        <img src="{{asset('assets/images/courses/'.$bundle_course->thumbnail) }}" alt="a"
                            class="img-fluid">
                    </div>
                    <div class="txt">
                        <h4>bundle Course title will be here!</h4>
                        <div class="categories">
                            <span class="text-secondary" style="font-size: .8rem">Subscription Status: </span>
                            @if ($bundle_course->subscription_status == 'one_time')
                            <span class="badge text-bg-success">One Time</span>
                            @elseif($bundle_course->subscription_status == 'monthly')
                            <span class="badge text-bg-info">Monthly</span>
                            @elseif($bundle_course->subscription_status == 'anully')
                            <span class="badge text-bg-primary">Anully</span>
                            @elseif($bundle_course->subscription_status == 'free')
                            <span class="badge text-bg-danger">Free</span>
                            @endif

                        </div>
                        <p>{{$bundle_course->short_description}}</p>
                    </div>
                    <div class="bttns">
                        <h6>€ {{$bundle_course->price}}/ <span>included {{count($bundle_course->courses)}}
                                courses</span></h6>
                        <a href="{{url('/students/dashboard/enrolled')}}">Buy now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
{{-- bundle course @e --}}

{{-- review section @s --}}
<section class="review-section" id="feedback_sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="bundle-course-head">
                    <h2>Our Student Feedback</h2>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Incidunt, similique.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="browse-all">
                    <a href="{{url('/students/dashboard')}}">Browse all <i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="feedback-slider">
                    @foreach ($courses_review as $review)
                    <div class="student-feeback-box">
                        <div class="media">
                            <img src="{{asset('assets/images/students/'.$review->user->avatar)}}" alt="a" class="img-fluid">
                            <div class="media-body">
                                <p>{{$review->comment}}</p>

                                <h6>{{$review->user->name}}</h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
{{-- review section @e --}}

{{-- get start @s --}}
@include('partials/guest/get-start')
{{-- get start @e --}}

{{-- footer @s --}}
@include('partials/guest/footer')
{{-- footer @e --}}


@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script') 
@endsection
{{-- page script @E --}}