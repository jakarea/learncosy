@extends('layouts/instructor')
@section('title') Course Page @endsection
@section('seo')
<meta name="description" content="Explore a diverse course list on LearnCosy. Boost your skills with engaging lessons in technology, business, arts, and more. Begin your educational journey today and unlock your full potential. Discover now!" itemprop="description">
@endsection
{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/course.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/student.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="students-home-page-wrap">
    <div class="email-camping-head">
        <h1>Available Courses</h1>
    </div>
    {{-- page tab head area @S --}}
    <div class="student-head-bttn">
        <ul class="nav nav-pills">
           
            @foreach($categories as $category)
            <li class="nav-item">
                <a href="{{ url('students/home?cat='.$category)}}" class="nav-link" type="button">{{$category}}</a>
            </li> 
            @endforeach
                
           
        </ul>
    </div>
    {{-- page tab head area @E --}}

    {{-- course search area @S --}}
    <form action="" method="GET">
        <div class="student-search-wrap">
            <div class="student-search-box">
                <img src="{{ asset('assets/images/search-icon.svg') }}" alt="Search icon" class="img-fluid">
                <input type="text" name="title" class="form-control" placeholder="Enter course title.."
                    value="{{ isset($_GET['title']) ? $_GET['title'] : '' }}">
            </div>
            <div class="student-bttn-box">
                <button class="btn btn-search" type="submit">Search</button> 
            </div>
        </div>
    </form>
    {{-- course search area @E --}}

    {{-- course listing @S --}}
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
            tabindex="0">
            {{-- featured course @S --}}
            <div class="row">
                <!-- item @S -->
                @foreach($courses as $course)

                @php
                $desc = $course->short_description;
                $max_length = 205;
                if (strlen($desc) > $max_length) {
                $short_description = substr($desc, 0, $max_length);
                $last_space = strrpos($short_description, ' ');
                $short_description = substr($short_description, 0, $last_space) . " ...";
                } else {
                $short_description = $desc;
                }

                @endphp
                <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="course-box-wrap"> 
                        <div class="course-content-box">
                            <div class="course-thumbnail">
                                <img src="{{asset('assets/images/courses/'. $course->thumbnail)}}"
                                    alt="{{ $course->slug}}" class="img-fluid">
                            </div>
                            <div class="course-txt-box">
                                <h3 class="mb-2"> <a href="{{url('students/courses/'.$course->slug )}}">{{ $course->title }} </a>
                                </h3>
                                <!-- @php $features = explode(",",$course->features)  @endphp
                                @foreach($features as $key => $feature)
                                <span class="badge text-bg-primary">{{$feature}}</span> 
                                @endforeach  -->
                                <ul>   
                                    <li><a href="javascript:void(0)" class="text-dark"> <span class="badge text-bg-secondary"> Rating: <i class="fa-solid fa-star"></i> {{$course->price}} </span></a></li>     
                                    <li><a href="javascript:void(0)" class="text-dark"> <span class="badge text-bg-info"> Price: <i class="fa-solid fa-dollar-sign"></i> {{$course->price}} </span></a></li>   
                                    <li><a href="javascript:void(0)" class="text-dark"> <span class="badge text-bg-success"> Offer: <i class="fa-solid fa-dollar-sign"></i> {{$course->offer_price}} </span></a></li>  
                                </ul> 
                                <ul> 
                                    <li><a href="javascript:void(0)" class="text-dark"> <span class="badge text-bg-warning"> Certificate:  {{$course->hascertificate}} </span></a></li>  
                                    <li><a href="javascript:void(0)" class="text-dark"> <span class="badge text-bg-dark"> Duration:  {{$course->duration}} </span></a></li>  
                                </ul> 
                            </div>
                        </div>
                        <div class="course-ftr"> 
                            <h5><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-play text-info"></i> Check Promo Video </a></h5> 
                            <a href="{{url('/students/courses/'.$course->slug)}}" class="btn btn-exprec enroll__btn">Details</a> 
                        </div> 
                        {{-- promo video modal @S --}} 
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Promo Video</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="promo-video-box">
                                        <iframe width="100%" height="315" src="{{$course->promo_video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                    </div>
                                </div> 
                            </div>
                            </div>
                        </div>
                        {{-- promo video modal @E --}}

                    </div>
                </div>
                @endforeach
                <!-- item @E -->
            </div>
            <div class="row">
                @if(count($courses) == 0)
                <div class="col-12">
                    <div class="no-result-found">
                        <h6>No Course Found !</h6>
                    </div>
                </div>
                <div class="col-12">
                    <div class="text-center mt-4">
                      @if ($courses->hasPages())
                        <div class="pagination-wrapper text-center">
                            {{ $courses->links('pagination::bootstrap-5') }}
                        </div>
                     @endif
                    </div>
                 </div>
                @endif
            </div>
            {{-- featured course @E --}}
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
            {{-- popular course @S --}}
            {{-- popular course @E --}}
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
            {{-- recomended course @S --}}
            {{-- recomended course @E --}}
        </div>
    </div>
    {{-- course listing @E --}}
</main>
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}