
@extends('layouts.latest.admin')
@section('title') Course Details @endsection

{{-- style section @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- style section @E --}}

@section('content')
@php
$i = 0;
@endphp
<main class="course-show-page-wrap">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                <div class="course-left">
                    {{-- video player --}}
                    <div class="video-iframe-vox">
                        @if( getFirstLesson($course->id) )
                        <div class="video-iframe-vox">
                            <div class="vimeo-player w-100"
                                data-vimeo-url="{{ getFirstLesson($course->id)->video_url }}" data-vimeo-width="1000"
                                data-vimeo-height="360"></div>
                        </div>
                        @else
                        <div class="video-iframe-vox">
                            <div class="vimeo-player w-100" data-vimeo-url="https://vimeo.com/305108069"
                                data-vimeo-width="1000" data-vimeo-height="360"></div>
                        </div>
                        @endif
                    </div>
                    {{-- video player --}}

                    {{-- course title --}}
                    <div class="media course-title">
                        <div class="media-body">
                            <h1>{{$course->title}}</h1>
                            <p>{{$course->user->name}} . {{$course->user->user_role}}</p>
                        </div>
                        <a href="#">
                            <img src="{{ asset('latest/assets/images/icons/clock.svg') }}" alt="clock" title="12:00"
                                class="img-fluid">
                        </a>
                    </div>
                    {{-- course title --}}
                    <hr>
                    <div class="content-txt-box">
                        <h3>About Course</h3>
                        <div class="course-desc-txt">
                            {!! $course->description !!}
                        </div>
                    </div> 
                    <div class="download-files-box">
                        <h4>Download Files</h4>
                        <div class="files">
                            <a href="#">Excel <img src="{{ asset('latest/assets/images/icons/download.svg') }}"
                                    alt="clock" title="120MB" class="img-fluid"></a>
                            <a href="#">Word <img src="{{ asset('latest/assets/images/icons/download.svg') }}"
                                    alt="clock" title="120MB" class="img-fluid"></a>
                            <a href="#">PDF <img src="{{ asset('latest/assets/images/icons/download.svg') }}"
                                    alt="clock" title="120MB" class="img-fluid"></a>
                        </div>
                    </div> 
                    {{-- course review --}}
                    <div class="course-review-wrap">
                        <h3>{{ count($course_reviews) }} Reviews</h3>

                        @if(count($course_reviews) > 0)
                            @foreach($course_reviews as $course_review)
                            <div class="media">
                                <img src="{{ asset('assets/images/students/'.$course_review->user->avatar) }}" alt="Avatar" class="img-fluid">
                                <div class="media-body">
                                    <h5>{{$course_review->user->name}}</h5>
                                    <ul>
                                        @for ($i = 0; $i < $course_review->star; $i++)
                                            <li><i class="fas fa-star"></i></li>
                                        @endfor
                                    </ul>
                                    <p>{{$course_review->comment}}</p>
                                    <small>{{$course_review->created_at->diffForHumans()}}</small>
                                    
                                </div>
                            </div>
                            @endforeach
                        @else
                        <div class="media">
                            <div class="media-body">
                                <p>No Review Found!</p>
                            </div>
                        </div>
                        @endif 
                    </div>
                    {{-- course review --}}

                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                {{-- course outline --}}
                <div class="course-outline-wrap">
                    <div class="header">
                        <h3>Modules</h3>
                        <h6>{{ count($course->modules) }} Modules . 23 Lessons</h6>
                    </div>
                    <div class="accordion" id="accordionExample">
                        @foreach($course->modules as $module) 
                        <div class="accordion-item"> 
                            <div class="accordion-header" id="heading_{{$module->id}}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_{{$module->id}}" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    <div class="d-flex"> 
                                        <p><i class="fas fa-check-circle"></i> {{ $module->title }}</p> 
                                    </div>
                                </button>
                            </div>
                            <div id="collapse_{{$module->id}}" class="accordion-collapse collapse "
                                aria-labelledby="heading_{{$module->id}}" data-bs-parent="#accordionExample">
                                <div class="accordion-body p-0">
                                    <ul class="lesson-wrap">
                                        @foreach($module->lessons as $lesson) 
                                        <li>
                                            <a href="{{ $lesson->video_link }}" class="video_list_play d-inline-block"
                                                data-video-id="{{ $lesson->id }}" data-lesson-id="{{$lesson->id}}"
                                                data-course-id="{{$course->id}}" data-modules-id="{{$module->id}}">
                                                <i class="fas fa-check-circle"></i> <i class="fas fa-play"></i>
                                                 {{ $lesson->title }}
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
                {{-- course outline --}}

                {{-- related course --}}
                <div class="related-course-box">
                    <h3>Related Courses</h3>

                    {{-- item --}}
                    <div class="course-single-item"> 
                        <div class="course-thumb-box"> 
                            <img src="{{asset('latest/assets/images/thumbnail.png')}}" alt="Course Thumbanil" class="img-fluid"> 
                        </div> 
                        <div class="course-txt-box">
                            <a href="#">Figma UI UX Design Essentials</a>
                            <p>Chris Converse</p>
                            <ul>
                                <li><span>4.0</span></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><span>(145)</span></li>
                            </ul>
                            <h5>€ $17.99 <span>€ 20.13</span></h5> 
                        </div>
                    </div>
                    {{-- item --}}
                    {{-- item --}}
                    <div class="course-single-item mt-4"> 
                        <div class="course-thumb-box"> 
                            <img src="{{asset('latest/assets/images/thumbnail.png')}}" alt="Course Thumbanil" class="img-fluid"> 
                        </div> 
                        <div class="course-txt-box">
                            <a href="#">Figma UI UX Design Essentials</a>
                            <p>Chris Converse</p>
                            <ul>
                                <li><span>4.0</span></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><span>(145)</span></li>
                            </ul>
                            <h5>€ $17.99 <span>€ 20.13</span></h5> 
                        </div>
                    </div>
                    {{-- item --}}
                </div>
                {{-- related course --}}
            </div>
        </div>
    </div> 
</main>
<!-- course details page @E -->
@endsection


{{-- script section @S --}}
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
<script src="https://player.vimeo.com/api/player.js"></script>
<script>
    $(document).ready(function () {

        var options = {
            id: '{{ 305108069 }}',
            // access_token: '{{ "64ac29221733a4e2943345bf6c079948" }}',
            autoplay: true,
            loop: true,
            width:  500,
        };
        var player = new Vimeo.Player(document.querySelector('.vimeo-player'), options);
        // play video on load
        player.on('ended', function() {
            player.setCurrentTime(0); // Set current time to 0 seconds
            player.play();
        });


        $('a.video_list_play').click(function(e){
            e.preventDefault();
            var videoId = $(this).data('video-id');
            var videoUrl = $(this).attr('href');
            videoUrl = videoUrl.replace('/videos/', '');
            player.loadVideo(videoUrl);
            // add bold class to current lesson
            $('a.video_list_play').removeClass('active');
            $(this).addClass('active');
        });
        
    });
</script>
@endsection
{{-- script section @E --}}