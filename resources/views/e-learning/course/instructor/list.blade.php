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
        <div class="row">
            <div class="col-12">
                <form action="" method="GET" id="myForm">
                    <div class="row">
                        <div class="col-xl-7 col-md-8">
                            <div class="user-search-box-wrap">
                                <div class="form-group">
                                    <i class="fas fa-search"></i>
                                    <input type="text" placeholder="Search Course" class="form-control" name="title"
                                        value="{{ isset($_GET['title']) ? $_GET['title'] : '' }}">
                                </div>
                                <input type="hidden" name="status" id="inputField">
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-4">
                            <div class="filter-dropdown-box">
                                <div class="dropdown">
                                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                        id="dropdownBttn">
                                        All
                                    </button> 
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item filterItem" href="#">All</a></li>
                                        <li><a class="dropdown-item filterItem" href="#" data-value="best_rated">Best Rated</a></li>
                                        <li><a class="dropdown-item filterItem" href="#" data-value="most_purchased">Most Purchased</a></li>
                                        <li><a class="dropdown-item filterItem" href="#" data-value="newest">Newest</a></li>
                                        <li><a class="dropdown-item filterItem" href="#" data-value="oldest">Oldest</a></li>
                                    </ul>
                                </div>
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="col-xl-2 ps-0 col-md-5">
                            <div class="user-add-box text-xl-end mb-lg-3 mb-xl-0">
                                <a href="{{ url('instructor/courses/create/step-1') }}"><i class="fas fa-plus me-2"></i> Add New Course</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div> 
        <div class="row"> 
            @if (count($courses) > 0)
            @foreach ($courses as $course) 
            {{-- course single box start --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3 mb-3">
                <div class="course-single-item"> 
                    <div>
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
                                        <li><a class="dropdown-item" href="{{url('instructor/courses/create/'.$course->id)}}">Edit</a></li> 
                                        <li> 
                                            <form method="post" class="d-inline" action="{{ url('instructor/courses/'.$course->id.'/destroy') }}">
                                                @csrf 
                                                @method("DELETE")
                                                <button type="submit" class="dropdown-item btn text-danger">Delete </button>
                                            </form>
                                        </li> 
                                    </ul>
                                </div> 
                            </div> 
                            <img src="{{ asset($course->thumbnail) }}" alt="Course Thumbanil" class="img-fluid"> 
                        </div> 
                        <div class="course-txt-box">
                            <a href="{{url('instructor/courses/'.$course->slug)}}">{{ Str::limit($course->title?$course->title:'Untitled course', $limit = 30, $end = '..') }}</a>
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
                        </div>
                    </div>
                    <div class="course-txt-box">
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

        if(status == "best_rated"){
            dropbtn.innerText = 'Best Rated';
        }
        if(status == "most_purchased"){
            dropbtn.innerText = 'Most Purchased';
        }
        if(status == "newest"){
            dropbtn.innerText = 'Newest';
        }
        if(status == "oldest"){
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