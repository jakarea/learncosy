@extends('layouts/instructor')
@section('title') Catalog Course Page @endsection

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
        <h1>Available Courses</h1>
    </div>
    {{-- page tab head area @S --}}
    <div class="student-head-bttn">
        <ul class="nav nav-pills">
            @if($courses)
                @foreach ($courses as $course) 
                    @php $cateogires = explode(",",$course->categories)  @endphp
                    @foreach($cateogires as $key => $category)
                    <li class="nav-item">
                        <button class="nav-link" type="button">{{$category}}</button>
                    </li> 
                    @endforeach
                @endforeach 
            @endif 
            
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
                $max_length = 205;
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
                                    <li><a href="#"><span class="text-dark">RATING: </span> 4.5 <i class="fas fa-star"></i></a></li> 
                                    <li><a href="#"><span class="text-dark">PRICE: </span> {{ $course->price}}$</a></li> 
                                </ul>
                                <ul>
                                    <li><a href="#"><span class="text-dark">Instructor Name</span>: Jhon Doe</a></li> 
                                </ul>
                                <p>{{ $short_description}}</p>
                            </div>
                        </div>
                        <div class="course-ftr"> 
                            <h5><a href="{{$course->promo_video}}"><i class="fas fa-play"></i> Check Intro Video </a></h5> 
                            <a href="{{url('/review')}}" class="btn btn-exprec enroll__btn">See Rating</a> 
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