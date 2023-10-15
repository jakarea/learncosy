@extends('layouts.latest.admin')
@section('title') Bundle Course List @endsection

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
                <form action="" method="GET" id="myForm">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-7 col-xl-8">
                            <div class="user-search-box-wrap">
                                <div class="form-group">
                                    <i class="fas fa-search"></i>
                                    <input type="text" placeholder="Search Course" class="form-control" name="title"
                                        value="{{ isset($_GET['title']) ? $_GET['title'] : '' }}">
                                </div>
                            </div>
                            <input type="hidden" name="status" id="inputField">
                        </div>
                        <div class="col-12 col-lg-5 col-xl-4">
                            <div class="d-flex course-filter-header">
                                <div class="filter-dropdown-box">
                                    <div class="dropdown">
                                        <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                            id="dropdownBttn">
                                            All Bundle
                                        </button> 
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item filterItem" href="#">All Bundle</a></li>
                                            <li><a class="dropdown-item filterItem" href="#" data-value="best_rated">Best Rated Bundle</a></li>
                                            <li><a class="dropdown-item filterItem" href="#" data-value="most_purchased">Most Purchased Bundle</a></li>
                                            <li><a class="dropdown-item filterItem" href="#" data-value="newest">Newest Bundle</a></li>
                                            <li><a class="dropdown-item filterItem" href="#" data-value="oldest">Oldest Bundle</a></li>
                                        </ul>
                                    </div>
                                    <i class="fas fa-angle-down"></i>
                                </div>
                                <div class="user-add-box">
                                    <button type="submit" class="btn text-white"><i
                                            class="fas fa-search text-white me-2"></i> Search</button>
                                </div>
                            </div>
                            
                        </div> 
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @if (count($bundleCourses) > 0)
            @foreach ($bundleCourses as $bundleCourse)
            {{-- course single box start --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3 mb-4">
                <div class="course-single-item">
                    <div>
                        <div class="course-thumb-box">
                            @if ($bundleCourse->status == 'pending')
                            <span class="badge text-bg-danger">Pending</span>
                            @elseif ($bundleCourse->status == 'draft')
                            <span class="badge text-bg-warning">Draft</span>
                            @elseif ($bundleCourse->status == 'published')
                            <span class="badge text-bg-primary">Publish</span>
                            @endif
    
                            <div class="header-action">
                                <div class="dropdown">
                                    <button class="btn btn-ellipse" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item"
                                                href="{{url('admin/bundle/courses/'.$bundleCourse->slug)}}">View</a></li>
                                        <li>
                                            <form method="post" class="d-inline"
                                                action="{{ url('admin/bundle/courses/'.$bundleCourse->slug.'/destroy') }}">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="dropdown-item btn text-danger">Delete </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <img src="{{asset('assets/images/courses/'.$bundleCourse->thumbnail)}}" alt="Course Thumbanil"
                                class="img-fluid">
                        </div>
                        <div class="course-txt-box">
                            <a href="{{url('admin/bundle/courses/'.$bundleCourse->slug.'/view')}}">{{ Str::limit($bundleCourse->title, $limit =
                                45, $end = '..') }}</a>
                            <p>{{ Str::limit($bundleCourse->short_description, $limit = 36, $end = '...') }}</p>
                            <ul>
                                <li><span>4.0</span></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><span>(15)</span></li>
                            </ul> 
                        </div>
                    </div>
                    <div class="course-txt-box">
                        <h5>€ {{ $bundleCourse->price }} </h5>
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
            dropbtn.innerText = 'Best Rated Bundle';
        }
        if(status == "most_purchased"){
            dropbtn.innerText = 'Most Purchased Bundle';
        }
        if(status == "newest"){
            dropbtn.innerText = 'Newest Bundle';
        }
        if(status == "oldest"){
            dropbtn.innerText = 'Oldest Bundle';
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