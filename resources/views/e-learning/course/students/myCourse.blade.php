@extends('layouts/latest/students')
@section('title')
    My Course Details
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
    <main class="course-overview-page">
        <div class="overview-banner-box"
            style="background-image: url({{ asset('assets/images/courseds/' . $course->banner) }});">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-8">
                        <div class="banner-title">
                            <h1>{{ $course->title }}</h1>
                            <p>{{ $course->sub_title }}</p>

                            @if ($course->user)
                                <div class="media">
                                    <img src="{{ asset('assets/images/users/' . $course->user->avatar) }}" alt="Place"
                                        class="img-fluid">
                                    <div class="media-body">
                                        <h5>{{ $course->user->name }}</h5>
                                        <h6>{{ $course->user->user_role }}</h6>
                                    </div>
                                </div>
                            @endif
                            <h4>{{ $course->duration }} Minutes to Complete . {{ count($course->modules) }} Moduls in
                                Course
                                . {{ $totalReviews }} Reviews</h4>

                            <a href="{{ url('students/courses/' . $course->slug) }}" class="common-bttn"
                                style="border-radius: 6.25rem; margin-top: 2rem">Start Course</a>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="overall-progress">
                            <h6>Overall Progress</h6>
                            {{ StudentActitviesProgress(auth()->user()->id, $course->id) }}
                            <div class="circle-prog-big">
                                <div class="cards">
                                    <div class="percent">
                                        <svg>
                                            <circle cx="73" cy="73" r="65"></circle>
                                            <circle cx="73" cy="73" r="65"
                                                style="--percent: {{ StudentActitviesProgress(auth()->user()->id, $course->id) }}">
                                            </circle>
                                        </svg>

                                        @php
                                            $totalLessons = 0;
                                            $completedLessons = 0;
                                        @endphp
                                        @foreach ($course->modules as $module)
                                            @php
                                                $totalLessons += count($module->lessons);
                                                $completedLessons += $module->lessons->where('completed', 1)->count();
                                            @endphp
                                        @endforeach

                                        <div class="number">
                                            <h5>{{ StudentActitviesProgress(auth()->user()->id, $course->id) }}<span>%</span>
                                            </h5>
                                            <p>{{ $completedLessons }}/{{ $totalLessons }}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>

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
                                    <p><img src="{{ asset('latest/assets/images/icons/carriculam.svg') }}" alt="users"
                                            class="img-fluid"> Total {{ $course->curriculum }} curriculum</p>
                                @endif
                                @if ($course->platform)
                                    <p><img src="{{ asset('latest/assets/images/icons/english.svg') }}" alt="users"
                                            class="img-fluid"> {{ $course->platform }}</p>
                                @endif
                                @if ($course->language)
                                    <p><img src="{{ asset('latest/assets/images/icons/english.svg') }}" alt="users"
                                            class="img-fluid"> {{ $course->language }}</p>
                                @endif
                                @if ($course->duration)
                                    <p><img src="{{ asset('latest/assets/images/icons/clock-2.svg') }}" alt="users"
                                            class="img-fluid"> {{ $course->duration }} Minutes to Completed</p>
                                @endif
                                @if ($course->number_of_module)
                                    <p><img src="{{ asset('latest/assets/images/icons/carriculam.svg') }}" alt="users"
                                            class="img-fluid"> {{ $course->number_of_module }} Modules</p>
                                @endif
                            </div>
                            <div class="col-lg-6">
                                @if ($course->number_of_lesson)
                                    <p><img src="{{ asset('latest/assets/images/icons/carriculam.svg') }}" alt="users"
                                            class="img-fluid"> {{ $course->number_of_lesson }} Lessons</p>
                                @endif
                                @if ($course->number_of_attachment)
                                    <p><img src="{{ asset('latest/assets/images/icons/carriculam.svg') }}" alt="users"
                                            class="img-fluid"> {{ $course->number_of_attachment }} Attachemnt</p>
                                @endif
                                @if ($course->number_of_video)
                                    <p><img src="{{ asset('latest/assets/images/icons/carriculam.svg') }}" alt="users"
                                            class="img-fluid"> {{ $course->number_of_video }} Videos</p>
                                @endif
                                @if ($course->hascertificate)
                                    <p><img src="{{ asset('latest/assets/images/icons/trophy.svg') }}" alt="users"
                                            class="img-fluid"> Certificate of Completion</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="all-modules-box">
                        <h3>Modules ({{ count($course->modules) }})</h3>
                    </div>
                </div>
                @foreach ($course->modules as $module)
                    @php
                        $totalLessons = count($module->lessons);
                        $completedLessons = $module->lessons->where('completed', 1)->count();
                        $percentage = $totalLessons > 0 ? ($completedLessons / $totalLessons) * 100 : 0;
                    @endphp
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="course-modules-boxx">
                            <div class="media">
                                <div class="media-body">
                                    <h5>{{ $module->title }}</h5>
                                    <p>{{ count($module->lessons) }} Lessons - {{ $completedLessons }} Completed</p>
                                </div>

                                <div class="circle-prog">
                                    <div class="cards">
                                        <div class="percent">
                                            <svg>
                                                <circle cx="27" cy="30" r="25"></circle>
                                                <circle cx="27" cy="30" r="25"
                                                    style="--percent: {{ $percentage }}"></circle>
                                            </svg>
                                            <div class="number">
                                                <h6>{{ $percentage }}<span>%</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <ul>
                                @foreach ($module->lessons->slice(0, 3) as $lesson)
                                    <li>
                                        <span>{{ Str::limit($lesson->title, 30) }}</span>
                                        <div>
                                            @if ($lesson->completed == 1)
                                                <img src="{{ asset('latest/assets/images/icons/chk.svg') }}" alt="icon"
                                                    class="img-fluid ms-2">
                                            @else
                                                @if ($lesson->type == 'text')
                                                    <i class="fa-regular fa-file-lines text-dark ms-2"></i>
                                                @elseif($lesson->type == 'audio')
                                                    <i class="fa-solid fa-headphones text-dark ms-2"></i>
                                                @elseif($lesson->type == 'video')
                                                    <i class="fa-solid fa-play text-dark ms-2"></i>
                                                @endif
                                            @endif
                                        </div>
                                    </li>
                                @endforeach

                                {{-- @php print_r($course_activities) @endphp --}}
                            </ul>

                            @if (count($module->lessons) > 3)
                                <div class="text-center">
                                    <a href="{{ url('students/home') }}">Show More <i class="fas fa-angle-down"></i></a>
                                </div>
                            @endif

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </main>
@endsection
