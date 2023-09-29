{{-- <div class="row">
    <div class="col-12 col-sm-12 col-md-5 col-lg-4">
        <div class="mylearning-txt-box mt-4">
            <h5>Course's Outline</h5>
        </div>
        <div class="course-outline-box">
            <div class="accordion" id="accordionExample">
                @foreach ($course->modules as $module)
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
                                @foreach ($module->lessons as $lesson)
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
                                <a href="{{ url('instructor/courses/create',$course->id) }}"
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
                @if (getFirstLesson($course->id))
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
                    <a href="{{url('course/messages')}}" class="min_width">Message</a>
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
                    @if ($course_reviews)         
                        <div class="col-lg-12">
                            @foreach ($course_reviews as $course_review)
                                <div class="attached-file-box review-box">
                                    <div class="d_flex">
                                    <h4><img src="{{ asset('assets/images/users/'.$course_review->user->avatar) }}" alt="{{$course_review->user->name}}"
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
 --}}


@extends('layouts.latest.instructor')
@section('title')
    Course Details
@endsection

{{-- style section @S --}}
@section('style')
    <link href="{{ asset('latest/assets/admin-css/elearning.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
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
                            @if (getFirstLesson($course->id))
                                <div class="video-iframe-vox">
                                    <div class="vimeo-player w-100"
                                        data-vimeo-url="{{ getFirstLesson($course->id)->video_url }}"
                                        data-vimeo-width="1000" data-vimeo-height="360"></div>
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
                                <h1>{{ $course->title }}</h1>
                                <p>{{ $course->user->name }} . {{ $course->user->user_role }}</p>
                            </div>
                            <a href="#">
                                <img src="{{ asset('latest/assets/images/icons/favorit.svg') }}" alt="clock"
                                    title="12:00" class="img-fluid">
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

                            @if (count($course_reviews) > 0)
                                @foreach ($course_reviews as $course_review)
                                    <div class="media">
                                        <img src="{{ asset('assets/images/users/' . $course_review->user->avatar) }}"
                                            alt="Avatar" class="img-fluid">
                                        <div class="media-body">
                                            <h5>{{ $course_review->user->name }}</h5>
                                            <ul>
                                                @for ($i = 0; $i < $course_review->star; $i++)
                                                    <li><i class="fas fa-star"></i></li>
                                                @endfor
                                            </ul>
                                            <p>{{ $course_review->comment }}</p>
                                            <small>{{ $course_review->created_at->diffForHumans() }}</small>

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
                            @foreach ($course->modules as $module)
                                <div class="accordion-item">
                                    <div class="accordion-header" id="heading_{{ $module->id }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse_{{ $module->id }}" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <div class="d-flex">
                                                <p>{{ $module->title }}</p>
                                                @can('instructor')
                                                    <a href="{{ url('instructor/courses/create', $course->id) }}"
                                                        class="ms-2"><i
                                                            class="fa-regular fa-pen-to-square text-primary"></i></a>
                                                @endcan
                                            </div>
                                        </button>
                                    </div>
                                    <div id="collapse_{{ $module->id }}" class="accordion-collapse collapse "
                                        aria-labelledby="heading_{{ $module->id }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body p-0">
                                            <ul class="lesson-wrap">
                                                @foreach ($module->lessons as $lesson)
                                                    <li>
                                                        <div class="d-flex">
                                                            <a href="{{ $lesson->video_link }}"
                                                                class="video_list_play d-inline-block"
                                                                data-video-id="{{ $lesson->id }}"
                                                                data-lesson-id="{{ $lesson->id }}"
                                                                data-course-id="{{ $course->id }}"
                                                                data-modules-id="{{ $module->id }}">
                                                                <i class="fas fa-play text-primary me-2"></i>
                                                                {{ $lesson->title }}
                                                            </a>
                                                            @can('instructor')
                                                                <a href="{{ url('instructor/courses/create', $course->id) }}"><i
                                                                        class="fa-regular fa-pen-to-square text-primary ms-2"></i></a>
                                                            @endcan
                                                        </div>

                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="text-center add-lesson-bttn">
                                                <a href="{{ url('instructor/courses/create', $course->id) }}"
                                                    class="add_lesson_bttn">Add Lesson</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-center add-lesson-bttn mt-2">
                                <a href="{{ url('instructor/courses/create/', $course->id) }}" class="add_lesson_bttn">Add
                                    Module</a>
                            </div>
                        </div>
                    </div>
                    {{-- course outline --}}

                    {{-- related course --}}
                    <div class="related-course-box">
                        <h3>Related Courses</h3>

                        <div class="row">
                            @if (count($relatedCourses))
                                @foreach ($relatedCourses as $course)
                                    <div class="col-md-6 col-12 col-lg-12 col-xl-12">
                                        {{-- item --}}
                                        <div class="course-single-item">
                                            <div class="course-thumb-box">
                                                <img src="{{ asset($course->thumbnail) }}" alt="{{ $course->title }}"
                                                    class="img-fluid">
                                            </div>
                                            <div class="course-txt-box">
                                                <a
                                                    href="{{ url('instructor/courses', $course->id) }}">{{ $course->title }}</a>
                                                <p>{{ $course->user->name }}</p>
                                                <ul>
                                                    <li><span>4.0</span></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><span>(145)</span></li>
                                                </ul>
                                                <h5>€ {{ $course->price }} <span>€ {{ $course->offer_price }}</span></h5>
                                            </div>
                                        </div>
                                        {{-- item --}}
                                    </div>
                                @endforeach
                            @else
                                @include('partials/no-data')
                            @endif

                        </div>
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
        $(document).ready(function() {

            var options = {
                id: '{{ 305108069 }}',
                // access_token: '{{ '64ac29221733a4e2943345bf6c079948' }}',
                autoplay: true,
                loop: true,
                width: 500,
            };
            var player = new Vimeo.Player(document.querySelector('.vimeo-player'), options);
            // play video on load
            player.on('ended', function() {
                player.setCurrentTime(0); // Set current time to 0 seconds
                player.play();
            });


            $('a.video_list_play').click(function(e) {
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
