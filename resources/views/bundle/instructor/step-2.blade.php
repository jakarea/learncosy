@extends('layouts.latest.instructor')
@section('title')
    Bundle Course create
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
                <div class="col-lg-7">
                    <div class="select-bundle-title mt-0">
                        <h1>Bundle course details</h1>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="select-bundle-title mt-0">
                        <button type="button" class="btn"> 0 Course Added</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="selected-bundle-courses-wrap">
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
                                                <p>{{ Str::limit($course->short_description, $limit = 36, $end = '...') }}
                                                </p>
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
                    </div>
                    <div class="bundle-create-form-wrap">
                        <form action="">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="basic-info-txt">
                                        <h5>Bundle Course Information</h5>
                                        <p>Quickly introduce your course info to students by filling in course information.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="bundle-create-inputs">
                                        <div class="form-group">
                                            <label for="">Bundle Name</label>
                                            <input type="text" placeholder="Enter Bundle Course Name"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Bundle Subtitle</label>
                                            <input type="text" placeholder="Enter subtitle" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Bundle Description</label>
                                            <textarea placeholder="Enter description" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Course Leaguage</label>
                                            <select class="form-control">
                                                <option value="">Select leaguage</option>
                                                <option value="">Bangla</option>
                                                <option value="">English</option>
                                            </select>
                                        </div>
                                        <div class="input-group">
                                            <label for="">Price</label>
                                            <span class="input-group-text" id="price">€</span>
                                            <input type="text" class="form-control" placeholder="0" aria-label="price"
                                                aria-describedby="price">
                                        </div>
                                        <div class="form-submit-bttns">
                                            <button type="reset" class="btn btn-cancel">Cancel</button>
                                            <button type="submit" class="btn btn-submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
