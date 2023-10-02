@extends('layouts/guest')
@section('title')
    {{ $course->title }} - Details
@endsection

{{-- page style @S --}}
@section('style')
    <link href="{{ asset('assets/css/course.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .enroll-bttns a {
            background: {{ modulesetting('secondary_color') }};
        }

        .course-details-banner-box .course-title h6 {
            color: {{ modulesetting('primary_color') }};
        }

        .course-outline-box .accordion .accordion-item span.numbering.active {
            border-color: {{ modulesetting('primary_color') }};
            color: {{ modulesetting('primary_color') }};
        }
    </style>
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
    {{-- course details @s --}}
    <div class="course-details-banner-box">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 ordr_2">
                    <div class="breadcumb">
                        <ul>
                            <li><a href="{{ url($instructor->subdomain) }}" class="text-info">Home</a></li>
                            <li><i class="fas fa-angle-right"></i></li>
                            <li><a href="{{ url($instructor->subdomain . '/#course_sec') }}">Course</a></li>
                            <li><i class="fas fa-angle-right"></i></li>
                            <li><a href="#">Details</a></li>
                        </ul>
                    </div>
                    <div class="course-title">
                        <h1>{{ $course->title }}</h1>
                        <p>{{ $course->short_description }}</p>

                        @php $courseCategories = explode(",",$course->categories) @endphp

                        <div class="categories">
                            @foreach ($courseCategories as $courseCategory)
                                <span class="badge text-bg-info">{{ $courseCategory }}</span>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="enroll-bttns">
                                    <a href="{{ url('students/dashboard/enrolled') }}">Enroll Now</a>
                                </div>
                            </div>
                            <div class="col-lg-6 ">
                                <h6> <i class="fas fa-star"></i>
                                    @if (count($courses_review) > 1)
                                        {{ count($courses_review) }} Ratings
                                    @elseif(count($courses_review) == 1)
                                        {{ count($courses_review) }} Rating
                                    @elseif(count($courses_review) <= 0)
                                        No Rating
                                    @endif
                                </h6>
                                <h5>Price: € {{ $course->price }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 ordr_1">
                    <div class="course-thumbnail">
                        <img src="{{ asset($course->thumbnail) }}" alt="mannheim" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- course details @e --}}

    {{-- course module lesson wrapper @s --}}
    <section class="course-modules-lesson-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    {{-- course module lessons @s --}}
                    <div class="mylearning-txt-box">
                        <h5>Course's Outline</h5>
                    </div>
                    <div class="course-outline-box">
                        <div class="accordion" id="accordionExample">
                            @foreach ($course->modules as $key => $module)
                                <div class="accordion-item">
                                    <span class="numbering active"> {{ $key + 1 }} </span>
                                    <div class="accordion-header" id="heading_{{ $module->id }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse_{{ $module->id }}" aria-expanded="true"
                                            aria-controls="collapse_{{ $module->id }}">
                                            <div class="d-flex">
                                                <p>{{ $module->title }}</p>
                                                <i class="fas fa-caret-down"></i>
                                            </div>
                                        </button>
                                    </div>
                                    <div id="collapse_{{ $module->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading_{{ $module->id }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                @foreach ($module->lessons as $key => $lesson)
                                                    <li>
                                                        <a href="#" class="disabled-link">
                                                            <i class="fas fa-lock"></i> {{ $lesson->title }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- course module lessons @e --}}
                </div>
                <div class="col-lg-3">
                    <div class="mylearning-txt-box">
                        <h5>Course Instructor</h5>
                    </div>
                    {{-- course instructor @s --}}
                    <div class="course-instructor">
                        <div class="thumbnail">
                            @if ($instructor->avatar)
                                <img src="{{ asset($instructor->avatar) }}" alt="Avatar" class="img-fluid">
                            @else
                                <span class="avatar-ins">{!! strtoupper($instructor->name[0]) !!}</span>
                            @endif
                        </div>
                        <div class="txt p-1">
                            <h4>{{ $instructor->name }}</h4>
                            <h5>{{ $instructor->short_bio }}</h5>
                            <h5 class="text-info">Social Links: </h5>

                            @php $socialLinks = explode(",",$instructor->social_links) @endphp

                            @foreach ($socialLinks as $social)
                                <a href="{{ $social }}">{{ $social }}</a>
                            @endforeach
                        </div>
                    </div>
                    {{-- course instructor @e --}}
                </div>
            </div>
        </div>
    </section>
    {{-- course module lesson wrapper @e --}}


    {{-- course details @s --}}
    <div class="course-detailss">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="course-details-box">
                        <h2>Details: </h2>
                        {!! $course->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- course details @e --}}

    {{-- this course review @s --}}
    <div class="related-courses">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="related-head">
                        <h3>This Course Review</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="feedback-slider">
                        @foreach ($courses_review as $review)
                            <div class="student-feeback-box">
                                <div class="media">
                                    <img src="{{ asset($review->user->avatar) }}" alt="a" class="img-fluid">
                                    <div class="media-body">
                                        <p>{{ $review->comment }}</p>

                                        <h6>{{ $review->user->name }}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- this course review @e --}}

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
