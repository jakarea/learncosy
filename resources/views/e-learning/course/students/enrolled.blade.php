@extends('layouts/latest/student')
@section('title') enrolled Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/course.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/student.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time()) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="courses-lists-pages">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="user-search-box-wrap">
                    <div class="form-group">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search course" class="form-control">
                    </div>
                    <div class="form-filter">
                        <select class="form-control">
                            <option value="">All </option>
                            <option value="">Most Purchased</option>
                            <option value="">Newest</option>
                            <option value="">Oldest</option>
                        </select>
                        <i class="fas fa-angle-down"></i>
                    </div>
                    <div class="user-title-box">
                        <a href="#"><i class="fas fa-search me-2"></i> Search Course</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($enrolments as $enrolment)
            <!-- <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="course-box-wrap">
                    <div class="course-content-box">
                        <div class="course-thumbnail">
                            @if ( ! empty( $enrolment->course->thumbnail ) )
                            <img src="{{asset('assets/images/courses/'.$enrolment->course->thumbnail)}}" alt="Course Thumbanil" class="img-fluid"> 
                            @else
                            <img src="{{ asset('latest/assets/images/thumbnail.png') }}" alt="Course Thumbanil" class="img-fluid w-100">
                            @endif
                        </div>
                        <div class="course-txt-box course-txt-box-2">
                            <h3> <a href="{{url('students/courses/'.$enrolment->course->slug )}}">{{ $enrolment->course->title }} </a>  </h3> 
                            
                            <h6>{{ StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) }}%</h6>
                        </div>
                    </div>
                    <div class="course-ftr">   
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{ StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) }}" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: {{ StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) }}%"></div>
                        </div> 
                        <a href="{{url('students/courses/'.$enrolment->course->slug )}}" class="btn btn-exprec enroll__btn">Go to Course Page</a> 
                    </div>
                </div>
            </div> -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="course-single-item"> 
                    <div class="course-thumb-box">
                        @if ( ! empty( $enrolment->thumbnail ) )
                        <img src="{{asset('assets/images/courses/'.$enrolment->course->thumbnail)}}" alt="Course Thumbanil" class="img-fluid"> 
                        @else
                        <img src="{{ asset('latest/assets/images/thumbnail.png') }}" alt="Course Thumbanil" class="img-fluid w-100">
                        @endif
                    </div> 
                    <div class="course-txt-box">
                        <a href="{{url('students/courses/'.$enrolment->course->slug )}}">{{ Str::limit($enrolment->course->title, $limit = 45, $end = '..') }}</a>
                        <p>{{ Str::limit($enrolment->course->short_description, $limit = 36, $end = '...') }}</p>
                        <ul>
                            <li><span>4.0</span></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><span>(145)</span></li>
                        </ul>
                        <h5>€ {{ $enrolment->course->price }}</h5> 
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{ StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) }}" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: {{ StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) }}%"></div>
                        </div> 
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}