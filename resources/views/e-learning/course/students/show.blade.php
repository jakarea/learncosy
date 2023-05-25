@extends('layouts/instructor')
@section('title') Course Details Page @endsection

{{-- style section @S --}}
@section('style')
<link href="{{ asset('assets/css/course.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/student.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- style section @E --}} 

@section('content')
@php   
    $i = 0; 
@endphp
<main class="course-page-wrap">
    <!-- suggested banner @S -->
    <div class="learning-banners-wrap" @if($course->banner) style="background-image: url('{{asset("assets/images/courses/".$course->banner)}}');" @endif>
        <div class="media">
            <div class="media-body">
                <h1 class="addspy-main-title">{{$course->title}}</h1>
                <p>{{$course->sub_title}}</p>
                <a href="#">Enroll Now</a>
            </div>
        </div>
    </div>
    <!-- suggested banner @E -->

    <div class="row">
        <div class="col-12 col-sm-12 col-md-5 col-lg-4">
            <div class="mylearning-txt-box mt-4">
                <h5>Course's Outline</h5>
            </div>
            <div class="course-outline-box">
                <div class="accordion" id="accordionExample">
                    @foreach($modules as $module)
                    @php $i++; @endphp
                    <div class="accordion-item">
                        <span class="numbering active"> {{$i}} </span>
                        <div class="accordion-header" id="heading_{{$module->id}}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_{{$module->id}}" aria-expanded="true" aria-controls="collapseOne">
                                <div class="d-flex">
                                    <p>{{ $module->title }}</p>
                                    <i class="fas fa-caret-down"></i>
                                </div>
                            </button>
                        </div>
                        <div id="collapse_{{$module->id}}" class="accordion-collapse collapse " aria-labelledby="heading_{{$module->id}}"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body"> 
                                <ul>
                                    @foreach($lessons as $lesson)
                                    <li>
                                        <a href="#">
                                            <img src="http://localhost:8000/assets/images/course/small-book.svg" alt="Lesson Icon" class="img-fluid"> {{ $lesson->title }}
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
        </div>
        <div class="col-12 col-sm-12 col-md-7 col-lg-8">
            <div class="mylearning-video-content-box custom-margin-top">
                <div class="video-iframe-vox">
                    <a href="#">
                        <img src="{{asset('assets/images/courses/'.$course->thumbnail)}}" alt="Course" class="img-fluid">
                    </a>
                </div>
                <div class="content-txt-box">
                    <div class="d-flex">
                        <h3>{{$course->title}}</h3>
                        <a href="#" class="min_width">Enroll Now</a>
                    </div>
                    {!! $course->description !!} 
                </div>
                <div class="profile-box">
                    <div class="media">
                        <img src="{{asset('assets/images/course/avatar.png')}}" alt="Place" class="img-fluid">
                        <div class="media-body">
                            <h5>Esther Howard</h5>
                            <p>Professional English Teacher</p>
                        </div>
                    </div>
                </div>
                <div class="course-content-box">
                    <div class="d-flex">
                        <h5>Course's reviews</h5>
                        <p>Last Updated : 2 hours ago</p>
                    </div>
                    <div class="row border-right-custom"> 
                        <div class="col-lg-12">
                            <div class="attached-file-box">
                                <h4><img src="{{asset('assets/images/avatar.png')}}" alt="Place"
                                        class="img-fluid me-1" width="40"> Jhon Doe</h4>
                                <ul class="review-box-icon">
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                            </div>
                            <div class="attached-file-box">
                                <h4><img src="{{asset('assets/images/avatar.png')}}" alt="Place"
                                        class="img-fluid me-1" width="40"> Steven Smith</h4>
                                <ul class="review-box-icon">
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                            </div>
                        </div> 
                        {{-- <div class="col-lg-12">
                            <div class="attached-file-box">
                                <p>No Review Found</p>
                            </div>
                        </div> --}} 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- my learning page @E -->
</main>
<!-- course details page @E -->
@endsection


{{-- script section @S --}}
@section('script')

@endsection
{{-- script section @E --}}