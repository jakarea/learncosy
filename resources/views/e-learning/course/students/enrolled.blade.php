@extends('layouts/instructor')
@section('title') enrolled Page @endsection

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
        <h1>Enrolled Courses</h1>
    </div> 
 
    {{-- notification @S --}}
    <div class="alert alert-success alert-dismissible fade show" role="alert">
       A New Course Available from Today
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    {{-- notification @E --}}

    {{-- course listing @S --}}
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
            tabindex="0">
            {{-- featured course @S --}}
            <div class="row">
                <!-- item @S -->
                @foreach($enrolments as $enrolment)
 
                <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="course-box-wrap">
                        <div class="course-content-box">
                            <div class="course-thumbnail">
                                <img src="{{asset('assets/images/courses/'. $enrolment->course->thumbnail)}}"
                                    alt="{{ $enrolment->course->slug}}" class="img-fluid">
                            </div>
                            <div class="course-txt-box course-txt-box-2">
                                <h3> <a href="{{url('students/courses/'.$enrolment->course->slug )}}">{{ $enrolment->course->title }} </a>  </h3> 
                                <h6>25%</h6>
                            </div>
                        </div>
                        <div class="course-ftr">   
                            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 25%"></div>
                              </div> 
                            <a href="{{url('students/courses/'.$enrolment->course->slug )}}" class="btn btn-exprec enroll__btn">Go to Course Page</a> 
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