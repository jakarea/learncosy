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
                                <div class="text-center">
                                    <a href="{{ url('instructor/lessons/create?course='.$course->id.'&module='.$module->id) }}"
                                        class="add_lesson_bttn">Add Lesson</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                    @endforeach
                </div>
            </div>
            <a href="{{ url('instructor/modules/create?course='.$course->id) }}" class="add_module_bttn">Add Module </a> 
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
                        <a href="{{url('course/messages')}}" class="min_width">Message</a>
                    </div>
                    {!! $course->description !!} 
                </div> 
                <div class="course-content-box">
                    <div class="d-flex">
                        <h5>Course's reviews</h5> 
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- review box @S --}}
                            <div class="attached-file-box review-box">
                                <div class="d_flex">
                                <h4><img src="{{ asset('assets/images/students/'.$course_review->user->avatar) }}" alt="{{$course_review->user->name}}"
                                                class="img-fluid me-1"> {{$course_review->user->name}}</h4>
                                    <ul class="review-box-icon">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>

                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus aperiam, minima
                                    amet omnis impedit delectus voluptatum iusto quaerat suscipit ipsa at? Ratione
                                    assumenda nobis quis voluptas neque earum aspernatur optio!</p>
                            </div>
                            {{-- review box @E --}}
                            {{-- review box @S --}}
                            <div class="attached-file-box review-box">
                                <div class="d_flex">
                                    <h4><img src="{{asset('assets/images/avatar.png')}}" alt="Place"
                                            class="img-fluid me-1"> Sttefen Smith</h4>
                                    <ul class="review-box-icon">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li> 
                                    </ul>
                                </div>

                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus aperiam, minima
                                    amet omnis impedit delectus voluptatum iusto quaerat suscipit ipsa at? Ratione
                                    assumenda nobis quis voluptas neque earum aspernatur optio!</p>
                            </div>
                            {{-- review box @E --}}
                        </div> 
                        <div class="col-lg-12">
                            <div class="attached-file-box">
                                <p>No Review Found</p>
                            </div>
                        </div>
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