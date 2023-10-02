@extends('layouts.latest.students')
@section('title')
    {{ $course->title ? $course->title : 'Course Details' }}
@endsection

{{-- style section @S --}}
@section('style')
    <link href="{{ asset('latest/assets/admin-css/elearning.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('latest/assets/admin-css/student-dash.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- style section @E --}}
@section('seo')
    <meta name="keywords" content="{{ $course->categories . ', ' . $course->meta_keyword }}" />
    <meta name="description" content="{{ $course->meta_description }}" itemprop="description">
@endsection
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
                        @if (isEnrolled($course->id))
                            <div class="video-iframe-vox">
                                @if (getFirstLesson($course->id))
                                    <div class="video-iframe-vox">
                                        <div class="vimeo-player w-100" id="firstLesson"
                                            data-vimeo-url="{{ getFirstLesson($course->id)->video_link }}"
                                            data-first-lesson-id="{{ getFirstLesson($course->id)->id }}"
                                            data-first-course-id="{{ getFirstLesson($course->id)->course_id }}"
                                            data-first-modules-id="{{ getFirstLesson($course->id)->module_id }}"
                                            data-vimeo-width="1000" data-vimeo-height="360"></div>
                                    </div>
                                @else
                                    <div class="video-iframe-vox">
                                        <div class="vimeo-player w-100" data-vimeo-url="https://vimeo.com/305108069"
                                            data-vimeo-width="1000" data-vimeo-height="360"></div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <a href="#">
                                <img src="{{ asset( $course->thumbnail) }}" alt="Course"
                                    class="img-fluid">
                            </a>
                            {{-- video player --}}
                        @endif

                        {{-- course title --}}
                        <div class="media course-title">
                            <div class="media-body">
                                <h1>{{ $course->title }}</h1>
                                <p>{{ $course->user->name }}  </p>
                            </div>
                            {{-- liked course button here --}}
                            <div class="liked-course-button">
                                <button class="btn like-btn {{ $liked }}" id="likeBttn">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                            {{-- liked course button here --}}
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
                            <h4>Download Files </h4>
                            <div class="files">
                                <a href="#">Excel <img src="{{ asset('latest/assets/images/icons/download.svg') }}"
                                        alt="clock" title="120MB" class="img-fluid"></a>
                                <a href="#">Word <img src="{{ asset('latest/assets/images/icons/download.svg') }}"
                                        alt="clock" title="120MB" class="img-fluid"></a>
                                <a href="#">PDF <img src="{{ asset('latest/assets/images/icons/download.svg') }}"
                                        alt="clock" title="120MB" class="img-fluid"></a>

                                @php
                                $progress = StudentActitviesProgress(auth()->user()->id, $course->id);
                                @endphp

                                @if ($progress > 90)
                                    <a href="{{ route('students.download.courses-certificate', ['slug' => $course->slug]) }}">Certificate Download <img src="{{ asset('latest/assets/images/icons/download.svg') }}" alt="clock" title="120MB" class="img-fluid"></a>
                                @endif
                            </div>
                        </div>
                        {{-- course review --}}
                        <div class="course-review-wrap">
                            <h3>{{ count($course_reviews) }} Reviews</h3>

                            <div class="media course-review-input-box">
                                @if ($course->user->avatar)
                                    @if ($course->user->user_role == 'student')
                                        <img src="{{ asset( $course->user->avatar) }}"
                                            alt="Place" class="img-fluid">
                                    @endif
                                @else
                                    <span class="avtar">{!! strtoupper($course->user->name[0]) !!}</span>
                                @endif
                                <div class="media-body">
                                    <form action="{{ route('students.review.courses', $course->slug) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="comment" id="review"
                                                placeholder="Write a review">
                                        </div>
                                        <div class="form-rev">
                                            <div id="full-stars">
                                                <div class="rating-group">
                                                    <label aria-label="1 star" class="rating__label" for="rating-1"><i
                                                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                    <input class="rating__input" name="star" id="rating-1"
                                                        value="1" type="radio">
                                                    <label aria-label="2 stars" class="rating__label" for="rating-2"><i
                                                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                    <input class="rating__input" name="star" id="rating-2"
                                                        value="2" type="radio">
                                                    <label aria-label="3 stars" class="rating__label" for="rating-3"><i
                                                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                    <input class="rating__input" name="star" id="rating-3"
                                                        value="3" type="radio" checked>
                                                    <label aria-label="4 stars" class="rating__label" for="rating-4"><i
                                                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                    <input class="rating__input" name="star" id="rating-4"
                                                        value="4" type="radio">
                                                    <label aria-label="5 stars" class="rating__label" for="rating-5"><i
                                                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                    <input class="rating__input" name="star" id="rating-5"
                                                        value="5" type="radio">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn common-bttn">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            @if (count($course_reviews) > 0)
                                @foreach ($course_reviews as $course_review)
                                    <div class="media">
                                        <img src="{{ asset( $course_review->user->avatar) }}"
                                            alt="Avatar" class="img-fluid">
                                        <div class="media-body">
                                            <h5>{{ $course_review->user->name }}</h5>
                                            <ul>
                                                @for ($i = 0; $i < $course_review->star; $i++)
                                                    <li><i class="fas fa-star"></i></li>
                                                @endfor
                                            </ul>
                                            <p>{{ $course_review->comment }}</p>
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
                            <h6>
                                {{ $totalModules }} Module . {{ $totalLessons }} Lessons
                            </h6>
                        </div>
                        <div class="accordion" id="accordionExample">
                            @foreach ($course->modules as $module)
                                <div class="accordion-item">
                                    <div class="accordion-header" id="heading_{{ $module->id }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse_{{ $module->id }}" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <div class="media align-items-center">
                                                <i class="fas fa-check-circle me-2"></i>
                                                <div class="media-body">
                                                    <p>{{ $module->title }}</p>
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                    <div id="collapse_{{ $module->id }}" class="accordion-collapse collapse "
                                        aria-labelledby="heading_{{ $module->id }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body p-0">
                                            <ul class="lesson-wrap">
                                                @foreach ($module->lessons as $lesson)
                                                    <li>
                                                        @if (!isEnrolled($course->id))
                                                            <a href="{{ route('students.checkout', $course->slug) }}"
                                                                class="video_list_play d-inline-block">
                                                                <i class="fas fa-lock"></i>
                                                                {{ $lesson->title }}
                                                            </a>
                                                        @else
                                                            <a href="{{ $lesson->video_link }}"
                                                                class="video_list_play d-inline-block"
                                                                data-video-id="{{ $lesson->id }}"
                                                                data-lesson-id="{{ $lesson->id }}"
                                                                data-course-id="{{ $course->id }}"
                                                                data-modules-id="{{ $module->id }}">

                                                                @if ($lesson->type == 'text')
                                                                    <i class="fa-regular fa-file-lines"></i>
                                                                @elseif($lesson->type == 'audio')
                                                                    <i class="fa-solid fa-headphones"></i>
                                                                @elseif($lesson->type == 'video')
                                                                    <i class="fa-solid fa-video"></i>
                                                                @endif
                                                                {{ $lesson->title }}
                                                                <span class="mt-2 ml-1" style="cursor:pointer;">
                                                                    @if (isLessonCompleted($lesson->id))
                                                                        <i
                                                                            class="fa-regular fa-circle-play text-success"></i>
                                                                    @else
                                                                        <i class="fa-regular fa-circle-play is_complete_lesson"
                                                                            data-course="{{ $course->id }}"
                                                                            data-module="{{ $module->id }}"
                                                                            data-lesson="{{ $lesson->id }}"
                                                                            data-duration="{{ $lesson->duration }}"
                                                                            data-user="{{ Auth::user()->id }}"></i>
                                                                    @endif
                                                                </span>
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

                    @if (isEnrolled($course->id) && $course->user->recivingMessage)
                        <a href="{{ url('course/messages/send/' . $course->id) }}"
                            class="common-bttn d-block w-100 text-center mt-4">Get Support</a>
                    @endif
                    @if (!isEnrolled($course->id))
                        <form action="{{ route('students.checkout', $course->slug) }}" method="GET">
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <input type="hidden" name="price" value="{{ $course->price }}">
                            <input type="hidden" name="instructor_id" value="{{ $course->instructor_id }}">
                            <button type="submit" class="btn common-bttn px-3 w-100 text-center mt-4">Enroll Now <i
                                    class="fas fa-angle-right ms-2"></i></button>
                        </form>
                    @endif

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
            var firstLessonId = $('#firstLesson').data('first-lesson-id');
            var firstCourseId = $('#firstLesson').data('first-course-id');
            var firstModuleId = $('#firstLesson').data('first-modules-id');
            var data = {
                courseId: firstCourseId,
                lessonId: firstLessonId,
                moduleId: firstModuleId
            };
            $.ajax({
                url: '{{ route('students.log.courses') }}',
                method: 'GET',
                data: data,
                success: function(response) {
                    console.log('response', response)
                },
                error: function(xhr, status, error) {
                    // Handle errors, if any
                }
            });

            var options = {
                id: '{{ 870001728 }}',
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
                @if (isEnrolled($course->id))
                    var videoId = $(this).data('video-id');
                    var courseId = $(this).data('course-id');
                    var lessonId = $(this).data('lesson-id');
                    var moduleId = $(this).data('modules-id');
                    var videoUrl = $(this).attr('href');
                    videoUrl = videoUrl.replace('/videos/', '');
                    player.loadVideo(videoUrl);
                    // add bold class to current lesson
                    $('a.video_list_play').removeClass('active');
                    $(this).addClass('active');
                @else
                    alert('Please enroll the course');
                @endif

                var data = {
                    courseId: courseId,
                    lessonId: lessonId,
                    moduleId: moduleId
                };
                $.ajax({
                    url: '{{ route('students.log.courses') }}',
                    method: 'GET',
                    data: data,
                    success: function(response) {
                        console.log('response', response)
                    },
                    error: function(xhr, status, error) {
                        // Handle errors, if any
                    }
                });
            });

            // is_complete_lesson on click check course is purchased or not and then check lesson video is completed or not after send to ajax
            $('.is_complete_lesson').click(function(e) {
                e.preventDefault();
                @if (isEnrolled($course->id))
                    var lessonId = $(this).data('lesson');
                    var courseId = $(this).data('course');
                    var moduleId = $(this).data('module');
                    var duration = $(this).data('duration');
                    var data = {
                        courseId: courseId,
                        lessonId: lessonId,
                        moduleId: moduleId
                        duration: duration
                    };
                    var $element = $(this); // Store reference to $(this) in a variable

                    $.ajax({
                        url: '{{ route('students.complete.lesson') }}',
                        method: 'GET',
                        data: data,
                        beforeSend: function() {
                            // Change class to spinner
                            $element.removeClass('fa-solid fa-circle-play').addClass(
                                'spinner-border spinner-border-sm');
                        },
                        success: function(response) {
                            console.log('response', response);
                            // Change icon to success checkmark
                            $element.removeClass('spinner-border spinner-border-sm').addClass(
                                'fa-solid fa-circle-play text-success');
                        },
                        error: function(xhr, status, error) {
                            // Handle errors, if any
                        }
                    });
                @else
                    alert('Please enroll in the course');
                @endif
            });


        });
    </script>

    <script>
        let currentURL = window.location.href;
        const baseUrl = currentURL.split('/').slice(0, 3).join('/');
        const likeBttn = document.getElementById('likeBttn');

        likeBttn.addEventListener('click', (e) => {

            const course_id = {{ $course->id }};
            const ins_id = {{ $course->user_id }};

            fetch(`${baseUrl}/students/course-like/${course_id}/${ins_id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'liked') {
                        likeBttn.classList.add('active');

                    } else {
                        likeBttn.classList.remove('active');
                    }
                })
                .catch(error => {
                    console.error(error);
                });

        });
    </script>
@endsection
{{-- script section @E --}}
