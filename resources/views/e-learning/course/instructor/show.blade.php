@extends('layouts/instructor')
@section('title') Course Details Page @endsection

{{-- style section @S --}}
@section('style')
<link href="{{ asset('assets/css/course.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/student.css') }}" rel="stylesheet" type="text/css" />
<style>
    .vimeo-player {
        position:relative;
        padding-bottom:56.25%;
        height:0;
        overflow:hidden;
        width:100%;
    }
    .vimeo-player iframe {
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
    }
    span.finsihLesson {
        float: right;
        font-size: 12px;
        color: #111;
        margin-top: 12px;
        cursor: pointer;
    }
    .course-outline-box .accordion .accordion-item ul li a.active {
        font-weight: 700;
    }
</style>
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
                    @foreach($course->modules as $module)
                    @php $i++; @endphp
                    <div class="accordion-item">
                        <span class="numbering active"> {{$i}} </span>
                        <div class="accordion-header" id="heading_{{$module->id}}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_{{$module->id}}" aria-expanded="true" aria-controls="collapseOne">
                                <div class="d-flex">
                                    <p>{{ $module->title }}
                                        @can('instructor') 
                                            <a href="{{url('instructor/modules/'.$module->slug.'/edit')}}" class="ms-2"><i class="fa-regular fa-pen-to-square text-info"></i></a>
                                        @endcan
                                    </p>
                                    <i class="fas fa-caret-down"></i>
                                </div>
                            </button>
                        </div>
                        <div id="collapse_{{$module->id}}" class="accordion-collapse collapse " aria-labelledby="heading_{{$module->id}}"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body"> 
                                <ul class="lesson-wrap">
                                    @foreach($module->lessons as $lesson)
                                    <li>
                                        <a href="{{ $lesson->video_link }}" class="video_list_play d-inline-block" data-video-id="{{ $lesson->id }}" data-lesson-id="{{$lesson->id}}" data-course-id="{{$course->id}}" data-modules-id="{{$module->id}}">
                                            <img src="{{ url('assets/images/course/small-book.svg') }}" alt="Lesson Icon" class="img-fluid"> {{ $lesson->title }}
                                        </a>
                                        @can('instructor') 
                                            <a href="{{url('instructor/lessons/'.$lesson->slug.'/edit')}}"><i class="fa-regular fa-pen-to-square text-info"></i></a>
                                        @endcan
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
                    @if( getFirstLesson($course->id) )
                        <div class="video-iframe-vox">
                            <div class="vimeo-player w-100" data-vimeo-url="{{ getFirstLesson($course->id)->video_url }}" data-vimeo-width="1000" data-vimeo-height="360"></div>
                        </div> 
                    @else
                        <div class="video-iframe-vox">
                            <div class="vimeo-player w-100" data-vimeo-url="https://vimeo.com/305108069" data-vimeo-width="1000" data-vimeo-height="360"></div>
                        </div>
                    @endif
                </div>
                <div class="content-txt-box">
                    <div class="d-flex">
                        <h3>{{$course->title}}</h3>
                        <a href="{{url('instructor1/course/messages')}}" class="min_width">Message</a>
                    </div>
                    <div class="course-dessc-txt">
                        {!! $course->description !!} 
                    </div>
                   
                </div> 
                <div class="course-content-box">
                    <div class="d-flex">
                        <h5>Course's reviews</h5> 
                    </div>
                    <div class="row">
                        @if($course_reviews)         
                            <div class="col-lg-12">
                                @foreach($course_reviews as $course_review)
                                    <div class="attached-file-box review-box">
                                        <div class="d_flex">
                                        <h4><img src="{{ asset('assets/images/students/'.$course_review->user->avatar) }}" alt="{{$course_review->user->name}}"
                                                class="img-fluid me-1"> {{$course_review->user->name}}</h4>
                                            <ul class="review-box-icon">
                                                @for ($i = 0; $i < $course_review->star; $i++)
                                                    <li><i class="fas fa-star"></i></li>
                                                @endfor
                                            </ul>
                                        </div>

                                        <p>{{$course_review->comment}}</p>
                                    </div>
                                @endforeach
                            </div>        
                        @else
                            <div class="col-lg-12">
                                <div class="attached-file-box">
                                    <p>No Review Found</p>
                                </div>
                            </div>        
                        @endif
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