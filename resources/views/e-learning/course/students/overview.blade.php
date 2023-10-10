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
    <div class="overview-banner-box"
        style="background-image: url({{asset('assets/images/courseds/'.$course->banner)}});">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="banner-title">
                        <h1>{{$course->title}}</h1>
                        <p>{{$course->sub_title}}</p>

                        @if($course->user)
                        <div class="media">
                            <img src="{{asset($course->user->avatar)}}" alt="Place" class="img-fluid">
                            <div class="media-body">
                                <h5>{{ $course->user->name }}</h5>
                                <h6 class="text-capitalize">{{ $course->user->user_role }}</h6>
                            </div>
                        </div>
                        @endif

                        {{-- course lesson duration calculation --}}
                        @php
                        $totalDuration = 0;
                        @endphp
                        @foreach($course->modules as $module)
                        @foreach($module->lessons as $lesson)
                        @php
                        $totalDuration += $lesson->duration;
                        @endphp
                        @endforeach
                        @endforeach
                        {{-- course lesson duration calculation --}}

                        <h4>{{ $totalDuration }} Minutes to Complete . {{ count($course->modules) }} Moduls in Course
                            . {{ count($course_reviews) }} Reviews</h4>

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
                    @php
                    $objectives = explode(",", $course->objective);
                    @endphp

                    <ul>
                        @foreach ($objectives as $object) 
                        <li><i class="fas fa-check"></i> {{$object}} </li>
                        @endforeach
                    </ul>
                </div>
                <div class="common-header">
                    <h3 class="mb-0">Course Content</h3>
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
                                {{-- lessons total minutes --}}
                                @php 
                                    $totalDuration = 0;

                                    foreach ($module->lessons as $lesson) {
                                        if (isset($lesson->duration) && is_numeric($lesson->duration)) {
                                            $totalDuration += $lesson->duration;
                                        }
                                    } 
                                @endphp 

                                <p class="common-para mb-4">{{ $totalDuration }} Min . 0 Curriculum</p>
                                {{-- lessons total minutes --}}
                            </div>
                            <div id="collapse_{{$module->id}}" class="accordion-collapse collapse "
                                aria-labelledby="heading_{{$module->id}}" data-bs-parent="#accordionExample">
                                <div class="accordion-body p-0">
                                    <ul class="lesson-wrap">
                                        @foreach($module->lessons as $lesson)
                                        <li>
                                            @if ( !isEnrolled($course->id) )
                                            <a href="{{route('students.checkout', $course->slug)}}"
                                                class="video_list_play d-flex">
                                                <div>
                                                    <img src="{{asset('latest/assets/images/icons/lok.svg')}}" alt="a" class="img-fluid me-2">
                                                    {{$lesson->title}}
                                                </div>
                                                <p class="common-para"> {{$lesson->duration}}</p>
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
                    <h3 class="mb-0">Student Review's</h3>
                    <span>Total {{ count($course_reviews) }} Reviews</span>
                </div>
                <div class="row">
                    @if(count($course_reviews) > 0)
                    @foreach($course_reviews as $course_review)
                    <div class="col-lg-6">
                        <div class="course-rev-box">
                            <div class="media">
                                <img src="{{ asset($course_review->user->avatar) }}" alt="Avatar" class="img-fluid">
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
                    <h3 class="mb-0">Similar Course</h3>
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
                                <img src="{{asset($course->thumbnail)}}" alt="Course Thumbanil" class="img-fluid">
                            </div>

                            <div class="course-txt-box">
                                <a href="{{url('admin/courses/'.$course->slug)}}">{{ Str::limit($course->title, $limit =
                                    40, $end = '..') }}</a>
                                <p>{{ $course->user->subdomain }}</p>
                                <ul>
                                    <li><span>{{ $review_avg }}</span></li>
                                    @for ($i = 0; $i<$review_avg; $i++) <li><i class="fas fa-star"></i></li>
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
                        <img src="{{asset($course->thumbnail)}}" alt="Course" class="img-fluid">

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @if ($course->offer_price)
                                <h2>€ {{ $course->offer_price }}</h2>
                                @elseif(!$course->offer_price && $course->price)
                                <h2>€ {{ $course->price }}</h2>
                                @else
                                <h2>Free</h2>
                                @endif
                            </div>
                            <button type="button" class="btn btn-preview" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Preview</button>
                        </div>

                        @if ( !isEnrolled($course->id) )
                        <form action="{{route('students.checkout', $course->slug)}}" method="GET">
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                            <input type="hidden" name="price" value="{{$course->price}}">
                            <input type="hidden" name="instructor_id" value="{{$course->instructor_id}}">
                            <button type="submit" class="btn enrol-bttn">Buy Course Now</button>
                        </form>

                        <form action="{{ route('cart.add', $course) }}" method="POST">
                            @csrf
                            @if ($cartCourses->pluck('course_id')->contains($course->id))
                            <button type="button" class="btn add-cart-bttn bg-secondary text-white" disabled>
                                Already Added to Cart</button>
                            @else
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn add-cart-bttn">Add to Cart</button>
                                <button type="button" class="btn btn-heart {{ $liked }}" id="likeBttn">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </div>
                            @endif
                        </form>
                        @endif
                    </div>
                    <div class="course-desc-txt">
                        <h4>Course Description</h4>
                        <p>{{ $course->short_description }}</p>
                    </div>
                    <div class="course-details-txt">
                        <h4>Course Details</h4>
                        @if ($course->curriculum)
                        <p><img src="{{asset('latest/assets/images/icons/carriculam.svg')}}" alt="users"
                                class="img-fluid"> Total {{ $course->curriculum }} curriculum</p>
                        @endif
                        @if ($course->platform)
                        <p><img src="{{asset('latest/assets/images/icons/english.svg')}}" alt="users" class="img-fluid">
                            {{ $course->platform }}</p>
                        @endif
                        @if ($course->language)
                        <p><img src="{{asset('latest/assets/images/icons/english.svg')}}" alt="users" class="img-fluid">
                            {{ $course->language }}</p>
                        @endif
                        @if ($course->duration)
                        <p><img src="{{asset('latest/assets/images/icons/clock-2.svg')}}" alt="users" class="img-fluid">
                            {{ $course->duration }} Minutes to Completed</p>
                        @endif
                        @if ($course->number_of_module)
                        <p><img src="{{asset('latest/assets/images/icons/carriculam.svg')}}" alt="users"
                                class="img-fluid"> {{ $course->number_of_module}} Modules</p>
                        @endif
                        @if ($course->number_of_lesson)
                        <p><img src="{{asset('latest/assets/images/icons/carriculam.svg')}}" alt="users"
                                class="img-fluid"> {{ $course->number_of_lesson}} Lessons</p>
                        @endif
                        @if ($course->number_of_attachment)
                        <p><img src="{{asset('latest/assets/images/icons/users.svg')}}" alt="users" class="img-fluid">
                            {{ $course->number_of_attachment}} Attachemnt</p>
                        @endif
                        @if ($course->number_of_video)
                        <p><img src="{{asset('latest/assets/images/icons/users.svg')}}" alt="users" class="img-fluid">
                            {{ $course->number_of_video}} Videos</p>
                        @endif
                        @if ($course->hascertificate)
                        <p><img src="{{asset('latest/assets/images/icons/trophy.svg')}}" alt="users" class="img-fluid">
                            Certificate of Completion</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- overview tab modal start --}}
<div class="overview-modal-box">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="overview-box-wrap">
                        {{-- header --}}
                        <div class="media">
                            <div class="media-body">
                                <h5>Course Preview</h5>
                                <h4>Figma UI UX Design Basic to Advance</h4>
                            </div>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn">
                                <i class="fas fa-close"></i>
                            </button>
                        </div>
                        {{-- header --}}

                        {{-- intro video --}}
                        <div class="intro-video-box">
                            <img src="{{ asset('latest/assets/images/video-thumb.png') }}" alt="video-thumb" class="img-fluid thumb">
                        </div>
                        {{-- intro video --}}

                        {{-- free sample video --}}
                        <div class="free-sample-video-list">
                            <h5>Free Sample Videos:</h5>

                            {{-- item --}}
                            <div class="d-flex">
                                <h4><img src="{{asset('latest/assets/images/thumb-big.png')}}" alt="thumb"
                                        class="img-fluid thumb"> <img src="{{ asset('latest/assets/images/icons/icon-play.svg') }}" alt="video-thumb" class="img-fluid icon"> Figma UI UX Design Essentials</h4>
                                <span>2:15</span>
                            </div>
                            {{-- item --}}
                            {{-- item --}}
                            <div class="d-flex">
                                <h4><img src="{{asset('latest/assets/images/thumb-big.png')}}" alt="thumb"
                                        class="img-fluid thumb"> Figma UI UX Design Essentials</h4>
                                <span>2:15</span>
                            </div>
                            {{-- item --}}
                            {{-- item --}}
                            <div class="d-flex">
                                <h4><img src="{{asset('latest/assets/images/thumb-big.png')}}" alt="thumb"
                                        class="img-fluid thumb"> Figma UI UX Design Essentials</h4>
                                <span>2:15</span>
                            </div>
                            {{-- item --}}
                            {{-- item --}}
                            <div class="d-flex">
                                <h4><img src="{{asset('latest/assets/images/thumb-big.png')}}" alt="thumb"
                                        class="img-fluid thumb"> Figma UI UX Design Essentials</h4>
                                <span>2:15</span>
                            </div>
                            {{-- item --}}
                            {{-- item --}}
                            <div class="d-flex">
                                <h4><img src="{{asset('latest/assets/images/thumb-big.png')}}" alt="thumb"
                                        class="img-fluid thumb"> Figma UI UX Design Essentials</h4>
                                <span>2:15</span>
                            </div>
                            {{-- item --}}
                        </div>
                        {{-- free sample video --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- overview tab modal end --}}

@endsection

{{-- js --}}
@section('script')
<script>
    let currentURL = window.location.href;
        const baseUrl = currentURL.split('/').slice(0, 3).join('/');
        const likeBttn = document.getElementById('likeBttn');

        likeBttn.addEventListener('click', (e) => {

            const course_id = {{ $course->id }};
            const ins_id = {{ $course->user_id }};

            fetch(`${baseUrl}/students/course-like/${course_id}/${ins_id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'liked') {
                        likeBttn.classList.add('active');

                    } else {
                        likeBttn.classList.remove('active');
                    }
                })
                .catch(error => {
                    console.error(error);
                });

        });
</script>
@endsection
{{-- js --}}