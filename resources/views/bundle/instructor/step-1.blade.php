@extends('layouts.latest.instructor')
@section('title')
    Bundle Course Select
@endsection

{{-- style section @S --}}
@section('style')
    <link href="{{ asset('latest/assets/admin-css/elearning.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('latest/assets/admin-css/user.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- style section @E --}}

@section('content')
    <main class="courses-lists-pages">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    {{-- session message @S --}}
                    @include('partials/session-message')
                    {{-- session message @E --}}
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="user-search-box-wrap bundle-select-grid d-grid" style="grid-auto-columns: 60% 40%;">
                        <div class="form-group me-lg-3">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search course" class="form-control">
                        </div>
                        <div class="form-filter">
                            <select class="form-control">
                                <option value="">All </option>
                                <option value="">Best Rated Bundle</option>
                                <option value="">Most Purchased Bundle</option>
                                <option value="">Newest Bundle</option>
                                <option value="">Oldest Bundle</option>
                            </select>
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="select-bundle-title">
                        <h1>Select courses to create a bundle</h1>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="select-bundle-title ">
                        <button type="button" class="btn">
                            <span>0</span>
                            <img src="{{ asset('latest/assets/images/icons/cart.svg') }}" alt="Course Thumbanil"
                                class="img-fluid"> 0 Course Selected</button>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (count($bundleCourses) > 0)
                    @foreach ($bundleCourses as $course)
                        {{-- course single box start --}}
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                            <div class="course-single-item">
                                <div class="course-thumb-box">
                                    <img src="{{ asset('assets/images/courses/' . $course->thumbnail) }}"
                                        alt="Course Thumbanil" class="img-fluid">
                                </div>
                                <div class="course-txt-box">
                                    <a
                                        href="{{ url('instructor/bundle/courses/' . $course->slug) }}">{{ Str::limit($course->title, $limit = 45, $end = '..') }}</a>
                                    <p>{{ Str::limit($course->short_description, $limit = 36, $end = '...') }}</p>
                                    <ul>
                                        <li><span>4.0</span></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><span>(145)</span></li>
                                    </ul>
                                    <h5>€ {{ $course->price }} </h5>

                                    <div class="bundle-create-bttn">
                                        <button type="button" class="btn"><i class="fas fa-plus"></i> Add to
                                            bundle</button>
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
                        {{ $bundleCourses->links('pagination::bootstrap-5') }}
                    </div>
                    {{-- pagginate --}}
                </div>
            </div>
        </div>
    </main>

@endsection
