@extends('layouts.latest.instructor')
@section('title') All Courses @endsection

{{-- style section @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
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
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="user-title-box">
                    <h1>Total: <span>{{ count($courses) }} Courses</span></h1>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="user-title-box justify-content-end">
                    <a href="{{ url('instructor/courses/create/step-1') }}"><i class="fas fa-plus me-2"></i> Add New Course</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="" method="GET">
                    <div class="user-search-box-wrap" style="grid-template-columns: 88% 12%">
                        <div class="form-group">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search Courses" class="form-control" name="title"
                                value="{{ isset($_GET['title']) ? $_GET['title'] : '' }}">

                        </div>

                        <div class="user-title-box justify-content-end">
                            <button type="submit" class="btn btn-search"><i class="fas fa-search text-white me-2"></i>
                                Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row"> 
            @if (count($courses) > 0)
            @foreach ($courses as $course) 
            {{-- course single box start --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="course-single-item"> 
                    <div class="course-thumb-box">
                        @if ($course->status == 'pending')
                        <span class="badge text-bg-danger">Pending</span>
                        @elseif ($course->status == 'draft')
                            <span class="badge text-bg-warning">Draft</span>
                        @elseif ($course->status == 'published')
                            <span class="badge text-bg-primary">Publish</span>
                        @endif
                        <div class="header-action">
                            <div class="dropdown">
                                <button class="btn btn-ellipse" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="{{url('instructor/courses/'.$course->slug)}}">View</a></li> 
                                  <li><a class="dropdown-item" href="{{url('instructor/courses/'.$course->slug.'/edit')}}">Edit</a></li> 
                                  <li> 
                                    <form method="post" class="d-inline" action="{{ url('instructor/courses/'.$course->slug.'/destroy') }}">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item btn text-danger">Delete </button>
                                    </form>
                                </li> 
                                </ul>
                              </div> 
                        </div> 
                        <img src="{{asset('assets/images/courses/'.$course->thumbnail)}}" alt="Course Thumbanil" class="img-fluid"> 
                    </div> 
                    <div class="course-txt-box">
                        <a href="{{url('instructor/courses/'.$course->slug)}}">{{ Str::limit($course->title, $limit = 30, $end = '..') }}</a>
                        <p>{{ Str::limit($course->short_description, $limit = 26, $end = '...') }}</p>
                        <ul>
                            <li><span>4.0</span></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><span>(145)</span></li>
                        </ul>
                        <h5>€ {{ $course->offer_price }} <span>€ {{ $course->price }}</span></h5> 
                    </div>
                </div>
            </div>
            {{-- course single box end --}}
            @endforeach
            @else
            <div class="col-12">
                <div class="no-result-found">
                    <h6>No Course Found!</h6>
                </div>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-12">
                {{-- pagginate --}}
                <div class="paggination-wrap">
                    {{ $courses->links('pagination::bootstrap-5') }}
                </div>
                {{-- pagginate --}}
            </div>
        </div>
    </div>
</main>
@endsection