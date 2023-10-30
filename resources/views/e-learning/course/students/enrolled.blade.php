@extends('layouts/latest/students')
@section('title')
    My Courses
@endsection

{{-- page style @S --}}
@section('style')
    <link href="{{ asset('latest/assets/admin-css/student-dash.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('latest/assets/admin-css/elearning.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('latest/assets/admin-css/user.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')

    <main class="student-courses-lists-pages">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-12">
                    <form action="" method="GET" id="myForm">
                        <div class="row">
                            <div class="col-xl-7 col-md-8">
                                <div class="user-search-box-wrap">
                                    <div class="form-group">
                                        <i class="fas fa-search"></i>
                                        <input type="text" placeholder="Search Course" class="form-control"
                                            name="title" value="{{ isset($_GET['title']) ? $_GET['title'] : '' }}">
                                    </div>
                                    <input type="hidden" name="status" id="inputField">
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4">
                                <div class="filter-dropdown-box">
                                    <div class="dropdown">
                                        <button class="btn" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false" id="dropdownBttn">
                                            All
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item filterItem" href="#">All</a></li>
                                            <li><a class="dropdown-item filterItem" href="#"
                                                    data-value="best_rated">Best Rated</a></li>
                                            <li><a class="dropdown-item filterItem" href="#"
                                                    data-value="most_purchased">Most Purchased</a></li>
                                            <li><a class="dropdown-item filterItem" href="#"
                                                    data-value="newest">Newest</a></li>
                                            <li><a class="dropdown-item filterItem" href="#"
                                                    data-value="oldest">Oldest</a></li>
                                        </ul>
                                    </div>
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-5">
                                <div class="user-add-box text-end text-xl-end mb-lg-3 mb-xl-0">
                                    <a href="{{ url('students/courses-activies/list') }}">Course Activity</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                @if (count($enrolments) > 0)
                    @foreach ($enrolments as $enrolment)
                        {{-- course single box start --}}
                        @php
                            $review_sum = 0;
                            $review_avg = 0;
                            $total = 0;
                            foreach ($enrolment->course->reviews as $review) {
                                $total++;
                                $review_sum += $review->star;
                            }
                            if ($total) {
                                $review_avg = $review_sum / $total;
                            }
                        @endphp
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3 mb-4">
                            <div class="course-single-item">
                                <div>
                                    <div class="course-thumb-box">
                                        <img src="{{ asset($enrolment->course->thumbnail) }}"
                                            alt="{{ $enrolment->course->slug }}" class="img-fluid">
                                    </div>
                                    <div class="course-txt-box">
                                        <a href="{{ url('students/courses/' . $enrolment->course->slug) }}">
                                            {{ Str::limit($enrolment->course->title, 45) }}</a>
                                        <p>{{ Str::limit($enrolment->course->short_description, $limit = 26, $end = '...') }}
                                        </p>
                                        <ul>
                                            <li><span>{{ $review_avg }}</span></li>
                                            @for ($i = 0; $i < $review_avg; $i++)
                                                <li><i class="fas fa-star"></i></li>
                                            @endfor
                                            <li><span>({{ $total }})</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="course-txt-box">
                                    <div class="course-progress-bar">
                                        <div class="progress" role="progressbar" aria-label="Basic example"
                                            aria-valuenow="{{ StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                            @if (StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) == 100)
                                                <div class="progress-bar"
                                                    style="width: {{ StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) }}%; background: #32BCA3;">
                                                </div>
                                            @else
                                                <div class="progress-bar"
                                                    style="width: {{ StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) }}%">
                                                </div>
                                            @endif

                                        </div>
                                        <div class="d-flex">
                                            @if (StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) == 100)
                                                <h6 style="color: #32BCA3">Completed</h6>
                                                <h6 style="color: #32BCA3">
                                                    {{ StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) }}
                                                    %</h6>
                                            @else
                                                <h6>Incomplete</h6>
                                                <h6>{{ StudentActitviesProgress(auth()->user()->id, $enrolment->course->id) }}
                                                    %</h6>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- course single box end --}}
                    @endforeach
                @else
                    <div class="col-12">
                        @include('partials/no-data')
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-12">
                    {{-- pagginate --}}
                    <div class="paggination-wrap">
                        {{ $enrolments->links('pagination::bootstrap-5') }}
                    </div>
                    {{-- pagginate --}}
                </div>
            </div>
        </div>
    </main>
@endsection
{{-- page content @E --}}


{{-- page script @S --}}
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let inputField = document.getElementById("inputField");
            let dropbtn = document.getElementById("dropdownBttn");
            let form = document.getElementById("myForm");
            let queryString = window.location.search;
            let urlParams = new URLSearchParams(queryString);
            let title = urlParams.get('title');
            let status = urlParams.get('status');
            let dropdownItems = document.querySelectorAll(".filterItem");

            if (status == "best_rated") {
                dropbtn.innerText = 'Best Rated';
            }
            if (status == "most_purchased") {
                dropbtn.innerText = 'Most Purchased';
            }
            if (status == "newest") {
                dropbtn.innerText = 'Newest';
            }
            if (status == "oldest") {
                dropbtn.innerText = 'Oldest';
            }

            inputField.value = status;

            dropdownItems.forEach(item => {
                item.addEventListener("click", function(e) {
                    e.preventDefault();
                    inputField.value = this.getAttribute("data-value");
                    dropbtn.innerText = item.innerText;
                    form.submit();
                });
            });
        });
    </script>
@endsection
{{-- page script @E --}}
