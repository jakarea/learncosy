@extends('layouts.latest.admin')
@section('title') Bundle Course List @endsection

{{-- style section @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time()) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time()) }}" rel="stylesheet" type="text/css" />
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
                <div class="user-search-box-wrap bundle-search-grid">
                    <div class="form-group">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search course" class="form-control">
                    </div>
                    <div class="form-filter">
                        <select class="form-control">
                            <option value="">All </option>
                            <option value="">Most Purchased</option>
                            <option value="">Newest</option>
                            <option value="">Oldest</option>
                        </select>
                        <i class="fas fa-angle-down"></i>
                    </div>
                    <div class="user-title-box">
                        <a href="{{url('admin/bundle/courses/create')}}"><i class="fas fa-plus me-2"></i> Add New Bundle Course</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"> 
            @foreach ($bundleCourses as $course) 
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
                                  <li><a class="dropdown-item" href="{{url('admin/bundle/courses/'.$course->slug)}}">View</a></li> 
                                  <li> 
                                    <form method="post" class="d-inline" action="{{ url('admin/bundle/courses/'.$course->slug.'/destroy') }}">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item btn text-danger">Delete </button>
                                    </form> 
                                    </li> 
                                </ul>
                              </div> 
                        </div> 
                        <img src="{{asset('assets/images/bundle-courses/'.$course->thumbnail)}}" alt="Course Thumbanil" class="img-fluid"> 
                    </div> 
                    <div class="course-txt-box">
                        <a href="{{url('admin/bundle/courses/'.$course->slug)}}">{{ Str::limit($course->title, $limit = 45, $end = '..') }}</a>
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
                    </div>
                </div>
            </div>
            {{-- course single box end --}}
            @endforeach 
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