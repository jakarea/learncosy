@extends('layouts/latest/students')
@section('title') My Course Details @endsection

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
            <div class="row align-items-center">
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

                        <a href="{{url('students/courses/'. $course->slug)}}" class="common-bttn" style="border-radius: 6.25rem; margin-top: 2rem">Start Course</a>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="overall-progress">
                        <h6>Overall Progress</h6>
                        <img src="{{asset('latest/assets/images/overall.svg')}}" alt="Place"  class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="course-description-box">
                    <h4>Course Description</h4>
                   {!! $course->description !!}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="course-details">
                    <h4>Course Details</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            @if ($course->curriculum)
                            <p><img src="{{asset('latest/assets/images/icons/carriculam.svg')}}" alt="users" class="img-fluid"> Total {{ $course->curriculum }} curriculum</p>
                            @endif 
                            @if ($course->platform)
                            <p><img src="{{asset('latest/assets/images/icons/english.svg')}}" alt="users" class="img-fluid"> {{ $course->platform }}</p>
                            @endif 
                            @if ($course->language)
                            <p><img src="{{asset('latest/assets/images/icons/english.svg')}}" alt="users" class="img-fluid"> {{ $course->language }}</p>
                            @endif 
                            @if ($course->duration)
                            <p><img src="{{asset('latest/assets/images/icons/clock-2.svg')}}" alt="users" class="img-fluid"> {{ $course->duration }} Minutes to Completed</p>
                            @endif 
                            @if ($course->number_of_module)
                            <p><img src="{{asset('latest/assets/images/icons/carriculam.svg')}}" alt="users" class="img-fluid"> {{ $course->number_of_module}} Modules</p>
                            @endif 
                        </div>
                        <div class="col-lg-6"> 
                            @if ($course->number_of_lesson)
                            <p><img src="{{asset('latest/assets/images/icons/carriculam.svg')}}" alt="users" class="img-fluid"> {{ $course->number_of_lesson}} Lessons</p>
                            @endif 
                            @if ($course->number_of_attachment)
                            <p><img src="{{asset('latest/assets/images/icons/carriculam.svg')}}" alt="users" class="img-fluid"> {{ $course->number_of_attachment}} Attachemnt</p>
                            @endif 
                            @if ($course->number_of_video)
                            <p><img src="{{asset('latest/assets/images/icons/carriculam.svg')}}" alt="users" class="img-fluid"> {{ $course->number_of_video}} Videos</p>
                            @endif 
                            @if ($course->hascertificate)
                                <p><img src="{{asset('latest/assets/images/icons/trophy.svg')}}" alt="users" class="img-fluid"> Certificate of Completion</p> 
                            @endif 
                        </div> 
                    </div>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-12">
                <div class="all-modules-box">
                    <h3>Modules ({{count($course->modules)}})</h3>
                </div>
            </div>
            @foreach ($course->modules as $module) 
            <div class="col-12 col-md-6 col-lg-4">
                <div class="course-modules-boxx">
                    <div class="media">
                        <div class="media-body">
                            <h5>{{$module->title}}</h5>
                            <p>{{$module->number_of_lesson}} Lessons. {{$module->duration}} M. Duration</p>
                        </div>
                        <img src="{{asset('latest/assets/images/full.svg')}}" alt="full"  class="img-fluid light-ele">
                        <img src="{{asset('latest/assets/images/cir-2.svg')}}" alt="full"  class="img-fluid dark-ele">
                    </div>

                    <hr>

                    <ul>
                        <li><span> {{ $module->number_of_attachment }} Total Attachment</span> <img src="{{asset('latest/assets/images/icons/chk.svg')}}" alt="full"  class="img-fluid"></li> 
                        <li><span> {{ $module->number_of_video }} Total Video</span> <img src="{{asset('latest/assets/images/icons/chk.svg')}}" alt="full"  class="img-fluid"></li> 
                    </ul>

                    <div class="text-center">
                        <a href="{{url('students/dashboard')}}">Show More <i class="fas fa-angle-down"></i></a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</main>
@endsection