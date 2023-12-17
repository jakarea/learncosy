@extends('layouts/latest/instructor')
@section('title','Course Overview')


{{-- style section @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/student-dash.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- style section @E --}}

@section('seo')
<meta name="keywords" content="{{ $course->categories .', '.$course->meta_keyword }}" />
<meta name="description" content="{{ $course->meta_description }}" itemprop="description">
@endsection

@section('content')
<main class="course-overview-page">
    <div class="overview-banner-box"
        style="background-image: url({{asset('assets/images/courseds/'.$course->banner)}});">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="banner-title">
                        <h1>{{$course->title}}</h1>
                        <p>{{$course->sub_title}}</p>

                        @if($course->user)
                        <div class="media">
                            <img src="{{asset($course->user->avatar)}}" alt="Place" class="img-fluid">
                            <div class="media-body">
                                <h5>{{ $course->user->name }}</h5>
                                <h6 class="text-capitalize">{{ $course->user->user_role }}</h6>
                            </div>
                        </div>
                        @endif

                        {{-- course lesson duration calculation --}}
                        @php
                        $totalDurationMinutes = 0;
                        @endphp
                        @foreach($course->modules as $module)
                        @foreach($module->lessons as $lesson)
                        @php
                        $totalDurationMinutes += $lesson->duration;
                        @endphp
                        @endforeach
                        @endforeach
                        {{-- course lesson duration calculation --}}

                        <h4>{{ $totalDurationMinutes }} Minutes to Complete . {{ count($course->modules) }} Moduls in Course
                            . {{ count($course_reviews) }} Reviews</h4>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-12 order-2 order-lg-1">
                <div class="what-you-learn-box">
                    <h3>What You'll Learn</h3>
                    @php
                    $objectives = explode("[objective]", $course->objective);
                    @endphp

                    <ul>
                        @foreach ($objectives as $object)
                        <li><i class="fas fa-check"></i> {{$object}} </li>
                        @endforeach
                    </ul>
                </div>
                <div class="common-header">
                    <h3 class="mb-0">Course Content</h3>
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
                                {{-- lessons total minutes --}}
                                @php
                                    $totalDuration = 0;

                                    foreach ($module->lessons as $lesson) {
                                        if (isset($lesson->duration) && is_numeric($lesson->duration)) {
                                            $totalDuration += $lesson->duration;
                                        }
                                    }
                                @endphp

                                <p class="common-para mb-4">{{ $totalDuration }} Min . 0 Curriculum</p>
                                {{-- lessons total minutes --}}
                            </div>
                            <div id="collapse_{{$module->id}}" class="accordion-collapse collapse "
                                aria-labelledby="heading_{{$module->id}}" data-bs-parent="#accordionExample">
                                <div class="accordion-body p-0">
                                    <ul class="lesson-wrap">
                                        @foreach($module->lessons as $lesson)
                                        <li>
                                            @if ( !isEnrolled($course->id))
                                            <a href="{{route('students.checkout', ['slug' => $course->slug, 'subdomain' => config('app.subdomain')])}}"
                                                class="video_list_play d-flex">
                                                <div>
                                                    <img src="{{asset('latest/assets/images/icons/lok.svg')}}" alt="a" class="img-fluid me-2">
                                                    {{$lesson->title}}
                                                </div>
                                                <p class="common-para">{{$lesson->duration}}</p>
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
                    <h3 class="mb-0">Student Review's</h3>
                    <span>Total {{ count($course_reviews) }} Reviews</span>
                </div>
                <div class="row">
                    @if(count($course_reviews) > 0)
                    @foreach($course_reviews as $course_review)
                    <div class="col-lg-6">
                        <div class="course-rev-box">
                            <div class="media">
                                <img src="{{ asset($course_review->user->avatar) }}" alt="Avatar" class="img-fluid">
                                <div class="media-body">
                                    <h5>{{$course_review->user->name}}</h5>
                                    <h6>{{$course_review->created_at}}</h6>
                                </div>
                            </div>
                            <p>{{$course_review->comment}}</p>
                            <ul>
                                @for ($i = 0; $i < $course_review->star; $i++)
                                    <li><i class="fas fa-star"></i></li>
                                    @endfor
                            </ul>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="text-center">
                        <p>No Review Found!</p>
                    </div>
                    @endif
                </div>
                <div class="common-header">
                    <h3 class="mb-0">Similar Course</h3>
                </div>
                <div class="row">

                    @foreach ($related_course as $course)
                    @php
                    $review_sum = 0;
                    $review_avg = 0;
                    $total = 0;
                    foreach($course->reviews as $review){
                    $total++;
                    $review_sum += $review->star;
                    }
                    if($total)
                    $review_avg = $review_sum / $total;
                    @endphp
                    {{-- course single box start --}}

                    <div class="col-lg-5 col-sm-6">
                        <div class="course-single-item">
                            <div class="course-thumb-box">
                                <img src="{{asset($course->thumbnail)}}" alt="Course Thumbanil" class="img-fluid">
                            </div>

                            <div class="course-txt-box">
                                <a href="{{url('admin/courses/'.$course->slug)}}">{{ Str::limit($course->title, $limit =
                                    40, $end = '..') }}</a>
                                <p>{{ $course->user->subdomain }}</p>
                                <ul>
                                    <li><span>{{ $review_avg }}</span></li>
                                    @for ($i = 0; $i<$review_avg; $i++) <li><i class="fas fa-star"></i></li>
                                        @endfor
                                        <li><span>({{ $total }})</span></li>
                                </ul>
                                @if($course->offer_price)
                                <h5>€ {{ $course->offer_price }} <span>€ {{ $course->price }}</span></h5>
                                @else
                                <h5> {{ $course->price > 0 ? '€ '.$course->price: 'Free' }} </h5>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- course single box end --}}
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 col-12 order-1 order-lg-2 col-md-6">
                <div class="course-overview-right-part">
                    <div class="course-main-thumb">
                        @if ($promo_video_link != '')
                            <iframe style="border-radius: 1rem" width="300" height="220" src="https://www.youtube.com/embed/{{$promo_video_link}}"></iframe>
                        @else
                        <img src="{{ asset($course->thumbnail) }}" alt="" class="img-fluid">
                        @endif
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @if ($course->offer_price)
                                <h2>€ {{ $course->offer_price }}</h2>
                                @elseif(!$course->offer_price && $course->price)
                                <h2>€ {{ $course->price }}</h2>
                                @else
                                <h2>Free</h2>
                                @endif
                            </div>
                            <button type="button" class="btn btn-preview" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Preview</button>
                        </div>

                        <button type="button" class="btn enrol-bttn btn-share" data-bs-toggle="modal" data-bs-target="#exampleModal2"><img src="{{ asset('latest/assets/images/icons/share.svg') }}" alt="a" class="img-fluid me-2" style="width: 1.5rem"> Share this course</button>

                    </div>
                    <div class="course-desc-txt">
                        <h4>Course Description</h4>
                        <p>{{ $course->short_description }}</p>
                    </div>
                    <div class="course-details-txt">
                        <h4>Course Details</h4>

                        <p><img src="{{asset('latest/assets/images/icons/users.svg')}}" alt="users"
                            class="img-fluid"> {{ $courseEnrolledNumber }} Enrolled</p>
                        <p><img src="{{asset('latest/assets/images/icons/alerm.svg')}}" alt="users"
                            class="img-fluid"> {{ $totalDurationMinutes }} Minutes to Completed</p>

                        <p><img src="{{asset('latest/assets/images/icons/carriculam.svg')}}" alt="users"
                                class="img-fluid"> {{ $course->curriculum ? $course->curriculum : 0 }} Curriculum</p>
                        @if ($course->language)
                        <p><img src="{{asset('latest/assets/images/icons/english.svg')}}" alt="users" class="img-fluid">
                            {{ $course->language }}</p>
                        @endif
                        @if ($course->platform)
                        <p><img src="{{asset('latest/assets/images/icons/platform.svg')}}" alt="platform" class="img-fluid">
                            {{ $course->platform }}</p>
                        @endif
                        <p><img src="{{asset('latest/assets/images/icons/loop.svg')}}" alt="users"
                            class="img-fluid">  Full Lifetime Access</p>
                        @if ($course->hascertificate)
                        <p><img src="{{asset('latest/assets/images/icons/trophy.svg')}}" alt="users" class="img-fluid">
                            Certificate of Completion</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- overview tab modal start --}}
<div class="overview-modal-box">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="overview-box-wrap">
                        {{-- header --}}
                        <div class="media">
                            <div class="media-body">
                                <h5>Course Preview</h5>
                                <h4>{{$course->title}}</h4>
                            </div>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn">
                                <i class="fas fa-close"></i>
                            </button>
                        </div>
                        {{-- header --}}

                        {{-- intro video --}}
                        <div class="intro-video-box">
                            @if ($promo_video_link != '')
                            <iframe style="border-radius: 1rem" width="100%" height="320" src="https://www.youtube.com/embed/{{$promo_video_link}}"></iframe>
                            @else
                            <img src="{{ asset($course->thumbnail) }}" alt="Thumbnail" class="img-fluid d-block w-100">
                            @endif
                        </div>
                        {{-- intro video --}}

                        {{-- free sample video --}}
                        <div class="free-sample-video-list">
                            <h5 class="mb-4">Course Videos:</h5>
                            @foreach ($course->modules as $module)
                                @foreach ($module->lessons as $lesson)
                                    @if ($lesson->type == 'video')
                                        {{-- item --}}
                                        <div class="media d-flex py-2">
                                            <img src="{{ asset('latest/assets/images/icons/icon-play.svg') }}" alt="video-thumb" class="img-fluid icon">
                                            <div class="media-body">
                                                <h4 class="mt-0">{{$lesson->title}}</h4>
                                            </div>
                                            <img src="{{ asset('latest/assets/images/icons/lok.svg') }}" alt="video-thumb" class="img-fluid icon">
                                        </div>
                                    {{-- item --}}
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                        {{-- free sample video --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- overview tab modal end --}}

{{-- share course modal --}}
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="share-on-social-wrap mt-0">
            <h4>Share</h4>
            <h6>As a post</h6>
            <div class="d-flex">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('courses/overview-courses', $course->slug)}}"
                    target="_blank">
                    <img src="{{asset('latest/assets/images/icons/fb.svg')}}" alt="FB" class="img-fluid">
                    <span>Facebook</span>
                </a>
                <a href="#">
                    <img src="{{asset('latest/assets/images/icons/tg.svg')}}" alt="TG" class="img-fluid">
                    <span>Telegram</span>
                </a>
                <a href="https://www.linkedin.com/shareArticle?url={{ url('courses/overview-courses', $course->slug)}}" target="_blank">
                    <img src="{{asset('latest/assets/images/icons/linkedin-ic.svg')}}" alt="FB"
                        class="img-fluid">
                    <span>LinkedIn</span>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ url('courses/overview-courses', $course->slug)}}&text={{ $course->title }}"
                    target="_blank"> <img src="{{asset('latest/assets/images/icons/twt.svg')}}" alt="FB"
                        class="img-fluid">
                    <span>Twitter</span>
                </a>
            </div>
            <h6>As a message</h6>
            <div class="d-flex">
                <a href="https://www.messenger.com/share.php?text={{ url('courses/overview-courses', $course->slug)}}">
                    <img src="{{asset('latest/assets/images/icons/messenger.svg')}}" alt="FB" class="img-fluid">
                    <span>Messenger</span>
                </a>
                <a href="https://api.whatsapp.com/send?text={{ url('courses/overview-courses', $course->slug)}}">
                    <img src="{{asset('latest/assets/images/icons/wapp.svg')}}" alt="FB" class="img-fluid">
                    <span>Whatsapp</span>
                </a>
                <a href="https://telegram.me/share/url?url={{ url('courses/overview-courses', $course->slug)}}">
                    <img src="{{asset('latest/assets/images/icons/teleg.svg')}}" alt="FB" class="img-fluid">
                    <span>Telegram</span>
                </a>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-0">
                <h6>Or copy link</h6>
                <span id="notify" style="color: green; font-size: 14px;"></span>
            </div>
            <div class="copy-link">
                <input type="text" placeholder="Link" value="{{ url('courses/overview-courses', $course->slug)}}" class="form-control" id="linkToCopy">
                <a href="#" id="copyButton" class="ms-1 px-0">Copy</a>
            </div>
        </div>
      </div>
    </div>
  </div>
{{-- share course modal --}}

@endsection

{{-- js --}}
@section('script')
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

<script>
    const copyButton = document.getElementById("copyButton");
    const linkToCopy = document.getElementById("linkToCopy");
    const notify = document.getElementById("notify");

    copyButton.addEventListener("click", (e) => {
        e.preventDefault();
        linkToCopy.select();
        document.execCommand("copy");
        notify.innerText = 'Copied!';

        setTimeout(() => {
            notify.innerText = '';
        }, 1000);

    });

</script>

@endsection
{{-- js --}}
