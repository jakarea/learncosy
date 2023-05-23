@extends('layouts/instructor')
@section('title') Bundle Course Details Page @endsection

{{-- style section @S --}}
@section('style')
<link href="{{ asset('assets/css/course.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- style section @E --}} 

@section('content')
<main class="course-page-wrap">
    <!-- suggested banner @S -->
    <div class="learning-banners-wrap" @if($bundleCourse->banner) style="background-image: url('{{asset("assets/images/bundle-courses/".$bundleCourse->banner)}}');" @endif>
        <div class="media">
            <div class="media-body">
                <h1 class="addspy-main-title">{{$bundleCourse->title}}</h1>
                <p>{{$bundleCourse->short_description}}</p>
                <a href="#">Continue</a>
            </div>
        </div>
    </div>
    <!-- suggested banner @E -->

    <div class="row"> 
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="mylearning-video-content-box custom-margin-top">
                <div class="video-iframe-vox">
                    <a href="#">
                        <img src="{{asset('assets/images/bundle-courses/'.$bundleCourse->thumbnail)}}" alt="Course" class="img-fluid">
                    </a>
                </div>
                <div class="content-txt-box">
                    <div class="d-flex">
                        <h3>${{$bundleCourse->price}}</h3>
                        <a href="#" class="min_width">Continue</a>
                    </div> 
                </div> 
                <div class="course-content-box">
                    <div class="d-flex">
                        <h5>All Course’s in this Bundle</h5>
                        <p>Last Updated : 2 hours ago</p>
                    </div>
                    <div class="row border-right-custom"> 
                        @php $selected_courses = explode(",",$bundleCourse->selected_course) @endphp 

                        @foreach($selected_courses as $key => $selected_course)
                        <div class="col-lg-12">
                            <div class="attached-file-box me-lg-2">
                                <h4>{{$selected_course}} Course Name</h4>
                                <a href="#"> <i class="fas fa-link"></i> </a>
                            </div>
                        </div>
                        @endforeach 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- my learning page @E -->
</main>
<!-- course details page @E -->
@endsection


{{-- script section @S --}}
@section('script')

@endsection
{{-- script section @E --}}