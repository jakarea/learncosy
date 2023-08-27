@extends('layouts/latest/students')
@section('title') Course Overview @endsection

{{-- style section @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/student-dash.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- style section @E --}}

@section('seo')
<meta name="keywords" content="{{ $course->categories .', '.$course->meta_keyword }}" />
<meta name="description" content="{{ $course->meta_description }}" itemprop="description">
@endsection

@section('content')
<main class="course-overview-page">
    <div class="overview-banner-box" style="background-image: url({{asset('assets/images/courseds/'.$course->banner)}});">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="banner-title">
                        <h1>{{$course->title}}</h1>
                        <p>{{$course->sub_title}}</p>

                        @if($course->user)
                        <div class="media">
                            <img src="{{asset('assets/images/users/'.$course->user->avatar)}}" alt="Place"
                                class="img-fluid">
                            <div class="media-body">
                                <h5>{{ $course->user->name }}</h5>
                                <h6>{{ $course->user->user_role }}</h6>
                            </div>
                        </div>
                        @endif
                        <h4>{{ $course->duration }} Minutes to Complete . {{ count($course->modules) }} Moduls in Course . {{
                            count($course_reviews) }} Reviews</h4>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-12 order-2 order-lg-1">
                <div class="what-you-learn-box">
                    <h3>What You'll Learn</h3>
                    @php $features = explode(",", $course->features); @endphp

                    <ul>
                        @foreach ($features as $feature)
                        <li><i class="fas fa-check"></i> {{$feature}} </li>
                        @endforeach
                    </ul>
                </div>
                <div class="common-header">
                    <h3>Course Content</h3>
                </div> 
                {{-- course outline --}}
                <div class="course-outline-wrap course-content">
                    <div class="accordion" id="accordionExample">
                        @foreach($course->modules as $module)
                        <div class="accordion-item">
                            <div class="accordion-header" id="heading_{{$module->id}}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_{{$module->id}}" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    <div class="d-flex">
                                        <p>{{ $module->title }}</p>
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </button>
                            </div>
                            <div id="collapse_{{$module->id}}" class="accordion-collapse collapse "
                                aria-labelledby="heading_{{$module->id}}" data-bs-parent="#accordionExample">
                                <div class="accordion-body p-0">
                                    <ul class="lesson-wrap">
                                        @foreach($module->lessons as $lesson)
                                        <li>
                                            @if ( !isEnrolled($course->id) )
                                            <a href="{{route('students.checkout', $course->slug)}}"
                                                class="video_list_play d-inline-block">
                                                <i class="fas fa-lock"></i>
                                                {{$lesson->title}}
                                            </a>
                                            @else
                                            <a href="{{ $lesson->video_link }}" class="video_list_play d-inline-block"
                                                data-video-id="{{ $lesson->id }}" data-lesson-id="{{$lesson->id}}"
                                                data-course-id="{{$course->id}}" data-modules-id="{{$module->id}}">
                                                <i class="fas fa-play-circle"></i>
                                                {{ $lesson->title }}
                                            </a>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                {{-- course outline --}} 
                <div class="common-header">
                    <h3>Student Review's</h3>
                    <span>Total {{ count($course_reviews) }} Reviews</span>
                </div> 
                <div class="row">
                    @if(count($course_reviews) > 0)
                    @foreach($course_reviews as $course_review)
                    <div class="col-lg-6">
                        <div class="course-rev-box">
                            <div class="media">
                                <img src="{{ asset('assets/images/users/'.$course_review->user->avatar) }}"
                                    alt="Avatar" class="img-fluid">
                                <div class="media-body">
                                    <h5>{{$course_review->user->name}}</h5>
                                    <h6>{{$course_review->created_at}}</h6>
                                </div>
                            </div>
                            <p>{{$course_review->comment}}</p>
                            <ul>
                                @for ($i = 0; $i < $course_review->star; $i++)
                                    <li><i class="fas fa-star"></i></li>
                                    @endfor
                            </ul>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="text-center">
                        <p>No Review Found!</p>
                    </div>
                    @endif
                </div> 
                <div class="common-header">
                    <h3>Similar Course</h3>
                </div> 
                <div class="row">

                    
                    @foreach ($related_course as $course) 
                        @php 
                            $review_sum = 0;
                            $review_avg = 0;
                            $total = 0;
                            foreach($course->reviews as $review){
                                $total++;
                                $review_sum += $review->star;
                            }
                            if($total)
                                $review_avg = $review_sum / $total;
                        @endphp
                        {{-- course single box start --}}
            
                    <div class="col-lg-5 col-sm-6">
                        <div class="course-single-item"> 
                            <div class="course-thumb-box">
                            <img src="{{asset('assets/images/courses/'.$course->thumbnail)}}" alt="Course Thumbanil" class="img-fluid">
                            </div>

                            
                            <div class="course-txt-box">
                                <a href="{{url('admin/courses/'.$course->slug)}}">{{ Str::limit($course->title, $limit = 40, $end = '..') }}</a>
                                <p>{{ $course->user->username }}</p>
                                <ul>
                                    <li><span>{{ $review_avg }}</span></li>
                                    @for ($i = 0; $i<$review_avg; $i++)
                                    <li><i class="fas fa-star"></i></li>
                                    @endfor
                                    <li><span>({{ $total }})</span></li>
                                </ul>
                                @if($course->offer_price)
                                    <h5>€ {{ $course->offer_price }} <span>€ {{ $course->price }}</span></h5> 
                                    @else
                                    <h5> {{ $course->price > 0 ? '€ '.$course->price: 'Free' }} </h5> 
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- course single box end --}}
                    @endforeach
                </div> 
            </div>
            <div class="col-lg-4 col-12 order-1 order-lg-2 col-md-6">
                <div class="course-overview-right-part">
                    <div class="course-main-thumb">
                        <img src="{{asset('assets/images/courses/'.$course->thumbnail)}}" alt="Course" class="img-fluid">
                        <h2>€ {{ $course->offer_price }}</h2> 
                        @if ( !isEnrolled($course->id) )
                        <form action="{{route('students.checkout', $course->slug)}}" method="GET">
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                            <input type="hidden" name="price" value="{{$course->price}}">
                            <input type="hidden" name="instructor_id" value="{{$course->instructor_id}}">
                            <button type="submit" class="btn enrol-bttn">Buy Course Now</button>
                        </form> 
                        <a href="#" class="add-cart-bttn">Add to Chart</a>
                        @endif 
                    </div>
                    <div class="course-desc-txt">
                        <h4>Course Description</h4> 
                        <p>{{ $course->short_description }}</p>
                    </div>
                    <div class="course-details-txt">
                        <h4>Course Details</h4> 
                        <p><img src="{{asset('latest/assets/images/icons/users.svg')}}" alt="users" class="img-fluid"> 200 Enrolled</p>
                        <p><img src="{{asset('latest/assets/images/icons/english.svg')}}" alt="users" class="img-fluid"> English</p>
                        <p><img src="{{asset('latest/assets/images/icons/clock-2.svg')}}" alt="users" class="img-fluid"> {{ $course->duration }} Minutes to Completed</p>
                        <p><img src="{{asset('latest/assets/images/icons/carriculam.svg')}}" alt="users" class="img-fluid"> {{ $course->number_of_module}} Modules</p>
                        <p><img src="{{asset('latest/assets/images/icons/carriculam.svg')}}" alt="users" class="img-fluid"> {{ $course->number_of_lesson}} Lessons</p>
                        <p><img src="{{asset('latest/assets/images/icons/users.svg')}}" alt="users" class="img-fluid"> {{ $course->number_of_attachment}} Attachemnt</p>
                        <p><img src="{{asset('latest/assets/images/icons/users.svg')}}" alt="users" class="img-fluid"> {{ $course->number_of_video}} Videos</p>
                        @if ($course->hascertificate)
                            <p><img src="{{asset('latest/assets/images/icons/trophy.svg')}}" alt="users" class="img-fluid"> Certificate of Completion</p> 
                        @endif 
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection