@extends('layouts/latest/student')

@section('title') Course Page @endsection
@section('seo')
<meta name="description" content="Explore a diverse course list on LearnCosy. Boost your skills with engaging lessons in technology, business, arts, and more. Begin your educational journey today and unlock your full potential. Discover now!" itemprop="description">
@endsection
{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/course.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/student.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time()) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="courses-lists-pages">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="user-search-box-wrap">
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
                        <a href="#"><i class="fas fa-search me-2"></i> Search Course</a>
                    </div>
                </div>
            </div>
        </div>
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
            <!-- <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="course-box-wrap"> 
                    <div class="course-content-box">
                        <div class="course-thumbnail">
                            <img src="{{asset('assets/images/courses/'. $course->thumbnail)}}"
                                alt="{{ $course->slug}}" class="img-fluid">
                        </div>
                        <div class="course-txt-box">
                            <h3 class="mb-2"> <a href="{{url('students/courses/'.$course->slug )}}">{{ $course->title }} </a>
                            </h3>
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
                </div>
            </div> -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="course-single-item"> 
                    <div class="course-thumb-box">
                        @if ( ! empty( $course->thumbnail ) )
                        <img src="{{asset('assets/images/courses/'.$course->thumbnail)}}" alt="Course Thumbanil" class="img-fluid"> 
                        @else
                        <img src="{{ asset('latest/assets/images/thumbnail.png') }}" alt="Course Thumbanil" class="img-fluid w-100">
                        @endif
                    </div> 
                    <div class="course-txt-box">
                        <a href="{{url('students/courses/'.$course->slug )}}">{{ Str::limit($course->title, $limit = 45, $end = '..') }}</a>
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
                        <h5>€ {{ $course->offer_price }} <span>€ {{ $course->price }}</span></h5> 
                    </div>
                </div>
            </div>
            @endforeach

            @if( count($bundleCourse) > 0 )
                @foreach($bundleCourse as $course)
                <!-- <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="course-box-wrap"> 
                        <div class="course-content-box">
                            <div class="course-thumbnail">
                                <img src="{{asset('assets/images/bundle-courses/'. $course->thumbnail)}}"
                                    alt="{{ $course->slug}}" class="img-fluid">
                            </div>
                        </div>
                        <div class="course-txt-box">
                            <h3 class="mb-2"> <a href="{{url('students/courses/'.$course->slug )}}">{{ $course->title }} </a>
                            </h3>
                            <ul class="d-flex justify-content-between">   
                                <li><a href="javascript:void(0)" class="text-dark"> <span class="badge text-bg-info"> Price: <i class="fa-solid fa-dollar-sign"></i> {{$course->price}} </span></a></li>   
                                <li><a href="javascript:void(0)" class="text-dark"> <span class="badge text-bg-warning"> Bundle Course </span></a></li>   
                            </ul>
                                @php 
                                $selected_courses = explode(",",$course->selected_course);
                                $courses = App\Models\Course::whereIn('id', $selected_courses)->get();
                            @endphp
                            <ul class="mt-3">   
                                @foreach($courses as $key => $inner_course)
                                <li><a href="{{url('students/courses/'.$inner_course->slug )}}" class="text-dark"> <span class="badge text-bg-secondary"> {{$inner_course->title}} </span></a></li>   
                                @endforeach
                            </ul>
                        </div> 
                        <div class="course-ftr"> 
                            @if ( !isEnrolled($courses->pluck('id')->toArray()) )
                            <a href="{{ route('students.bundle.checkout', $course->id)}}" class="btn btn-exprec enroll__btn">Purchase Now ${{$course->price}}</a> 
                            @else
                            <a href="#" class="btn btn-exprec enroll__btn">Purchased Bundle</a>
                            @endif
                        </div>   
                    </div> 
                </div> -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                    <div class="course-single-item"> 
                        <div class="course-thumb-box">
                            @if ( ! empty( $course->thumbnail ) )
                            <img src="{{asset('assets/images/courses/'.$course->thumbnail)}}" alt="Course Thumbanil" class="img-fluid"> 
                            @else
                            <img src="{{ asset('latest/assets/images/thumbnail.png') }}" alt="Course Thumbanil" class="img-fluid w-100">
                            @endif
                        </div> 
                        <div class="course-txt-box">
                            <a href="{{url('students/courses/'.$course->slug )}}">{{ Str::limit($course->title, $limit = 45, $end = '..') }}</a>
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
                            <h5>€ {{ $course->price }}</h5> 
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
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
    </div>
</main>
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}