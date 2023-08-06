@extends('layouts.latest.admin')
@section('title') Bundle Course Details @endsection

{{-- style section @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- style section @E --}}

@section('content')
<main class="course-show-page-wrap">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                <div class="course-left">
                    <div class="learning-banners-wrap">
                        @if($bundleCourse->banner)
                         <img src="{{asset('assets/images/bundle-courses/'.$bundleCourse->banner)}}" alt="" class="img-fluid">
                         @else 
                         <img src="{{asset('latest/assets/images/thumbnail.png')}}" alt="" class="img-fluid">
                         @endif
                    </div>

                    {{-- course title --}}
                    <div class="media course-title">
                        <div class="media-body">
                            <h1>{{$bundleCourse->title}}</h1> 
                        </div> 
                        <h5>€ {{$bundleCourse->price}}</h5>
                    </div>
                    {{-- course title --}}
                    <hr>
                    <div class="content-txt-box">
                        <h3>About Course</h3>
                        <div class="course-desc-txt">
                            {{$bundleCourse->short_description}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-12 col-12"> 

                {{-- related course --}}
                <div class="related-course-box">
                    <h3>Included Courses</h3>
                    @php $selected_courses = explode(",",$bundleCourse->selected_course) @endphp  
                    
                    @foreach($selected_courses as $key => $selected_course)
                    {{-- item --}}
                    <div class="course-single-item mb-4" style="min-height: auto"> 
                        <div class="course-thumb-box"> 
                            <img src="{{asset('latest/assets/images/thumbnail.png')}}" alt="Course Thumbanil" class="img-fluid"> 
                        </div> 
                        <div class="course-txt-box">
                            <a href="#">{{$selected_course}}</a>   
                        </div>
                    </div>
                    {{-- item --}} 
                    @endforeach 

                </div>
                {{-- related course --}}
            </div>
        </div>
    </div> 
</main>
<!-- course details page @E -->
@endsection