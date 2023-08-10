@extends('layouts/latest/students')
@section('title') Course Overview @endsection

{{-- style section @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time()) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/student-dash.css?v='.time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- style section @E --}}

@section('seo')
<meta name="keywords" content="{{ $course->categories .', '.$course->meta_keyword }}" />
<meta name="description" content="{{ $course->meta_description }}" itemprop="description">
@endsection

@section('content')
<main class="course-overview-page">
    <div class="overview-banner-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-9">
                    <div class="banner-title">
                        <h1>{{$course->title}}</h1>
                        <p>{{$course->sub_title}}</p>
 
                        @if($course->user)
                        <div class="media">
                            <img src="{{asset('assets/images/instructor/'.$course->user->avatar)}}" alt="Place"
                                    class="img-fluid"> 
                            <div class="media-body">
                                <h5>{{ $course->user->name }}</h5>
                                <h6>{{ $course->user->user_role }}</h6>
                            </div>
                        </div>
                        @endif
                        <h4>40 Minutes to Complete . {{ count($course->modules) }} Moduls in Course . {{ count($course_reviews) }} Reviews</h4>

                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
                <div class="what-you-learn-box">
                    <h3>What You'll Learn</h3> 
                    @php $features = explode(",", $course->features); @endphp 

                    <ul>
                        @foreach ($features as $feature)
                            <li><i class="fas fa-check"></i>  {{$feature}} </li>
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
                    <h3>Student Review’s</h3> 
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="course-rev-box">
                            
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-9"></div>
        </div>
    </div>
</main>
@endsection