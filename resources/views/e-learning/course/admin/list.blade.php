@extends('layouts.latest.admin')
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
        <div class="row">
            <div class="col-12">
                <div class="user-search-box-wrap">
                    <form action="" method="GET">
                        <div class="form-group">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search Courses" class="form-control" name="title" value="{{ isset($_GET['title']) ? $_GET['title'] : '' }}"> 
                            <button type="submit" class="btn btn-search">Search</button>
                        </div>
                    </form> 
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
                        <a href="{{ url('admin/courses/create') }}"><i class="fas fa-plus me-2"></i> Add New Course</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"> 
            @if (count($courses) > 0)
            @foreach ($courses as $course) 
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
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="course-single-item"> 
                    <div class="course-thumb-box">
                        <div class="header-action">
                            <div class="dropdown">
                                <button class="btn btn-ellipse" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="{{url('admin/courses/'.$course->slug)}}">View</a></li> 
                                  <li> 
                                    <form method="post" class="d-inline" action="{{ url('admin/courses/'.$course->slug.'/destroy') }}">
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
                        <a href="{{url('admin/courses/'.$course->slug)}}">{{ Str::limit($course->title, $limit = 40, $end = '..') }}</a>
                        <p>{{ $course->user->username }}</p>
                        <ul>
                            <li><span>{{ $review_avg }}</span></li>
                            @for ($i = 0; $i<$review_avg; $i++)
                            <li><i class="fas fa-star"></i></li>
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