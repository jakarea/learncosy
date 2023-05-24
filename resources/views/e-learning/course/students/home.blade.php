@extends('layouts/instructor')
@section('title') Home Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/course.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/student.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="students-home-page-wrap">
    <div class="email-camping-head">
        <h1>All Courses</h1>
    </div>
    {{-- page tab head area @S --}}
    <div class="student-head-bttn">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                    type="button" role="tab" aria-controls="pills-home" aria-selected="true">Featured</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                    type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Popular</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                    type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Recommended</button>
            </li>
        </ul>
    </div>
    {{-- page tab head area @E --}}

    {{-- course search area @S --}}
    <div class="student-search-wrap">
        <div class="student-search-box">
            <img src="{{ asset('assets/images/search-icon.svg') }}" alt="Search icon" class="img-fluid">
            <input type="text" class="form-control" placeholder="Search">
        </div>
        <div class="student-bttn-box">
            <button class="btn btn-search" type="button">Search</button>
            <button class="btn btn-filter" type="button">Filter</button>
        </div>
    </div>
    {{-- course search area @E --}}

    {{-- course listing @S --}}
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
            tabindex="0">
            {{-- featured course @S --}}
            <div class="row">
                <!-- item @S -->
                @foreach($courses as $course)

                @php
                $desc = $course->short_description;
                $max_length = 105;
                if (strlen($desc) > $max_length) {
                $short_description = substr($desc, 0, $max_length);
                $last_space = strrpos($short_description, ' ');
                $short_description = substr($short_description, 0, $last_space) . " ...";
                } else {
                $short_description = $desc;
                }

                @endphp
                <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="course-box-wrap">
                        <div class="course-content-box">
                            <div class="course-thumbnail">
                                <img src="{{asset('assets/images/courses/'. $course->thumbnail)}}"
                                    alt="{{ $course->slug}}" class="img-fluid">
                            </div>
                            <div class="course-txt-box">
                                <h3> <a href="{{url('instructor/courses/'.$course->slug )}}">{{ $course->title }} </a>
                                </h3>
                                <ul>
                                    <li><a href="#">LESSONS: {{ $course->number_of_lesson}}</a></li>
                                    <li><a href="#">MODULES: {{ $course->number_of_module}}</a></li>
                                    <li><a href="#">PRICE: {{ $course->price}}$</a></li> 
                                </ul>
                                <ul>
                                    <li><a href="#">Certificate: {{ $course->sample_certificates == 'yes' ? 'YES' : 'NO'}}</a></li>
                                    <li><a href="#">Duration: {{ $course->duration }}</a></li>
                                </ul>
                                <p>{{ $short_description}}</p>
                            </div>
                        </div>
                        <div class="course-ftr"> 
                            <h5><a href="{{$course->promo_video}}"><i class="fas fa-play"></i> Overview </a></h5>

                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                    style="20%">
                                </div>
                            </div> 
                            <a href="javascript:void(0)" class="btn btn-exprec enroll__btn">Enroll Now</a> 
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- item @E -->
            </div>
            {{-- featured course @E --}}
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
            {{-- popular course @S --}}
            {{-- popular course @E --}}
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
            {{-- recomended course @S --}}
            {{-- recomended course @E --}}
        </div>
    </div>
    {{-- course listing @E --}}
</main>
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}