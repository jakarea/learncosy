@extends('layouts.latest.instructor')
@section('title')
Course Create - Step 2
@endsection
{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="course-create-step-page-wrap">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-4 col-xl-3">
                {{-- course step --}}
                {{-- add class "active" to "step-box" for the done step and add a checkmark image icon inside "circle"
                class --}}
                {{-- add class "current" to "step-box" for the current step --}}
                <div class="course-create-step-wrap page-create-step">
                    <div class="step-box current">
                        <span class="circle">
                            {{-- <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="icon"
                                class="img-fluid"> --}}
                        </span>
                        <p>Content</p>
                    </div>
                    <div class="step-box">
                        <span class="circle"></span>
                        <p>Institutions</p>
                    </div>
                </div>
                {{-- course step --}}
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                <div class="lesson-edit-form-wrap">
                    <h4>Description</h4>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" id="description" name="description"> {{ $course->description ? $course->description : old('description')}}</textarea>
                            <span class="invalid-feedback">@error('description'){{ $message }} @enderror</span>
                        </div>
                        <div class="form-group form-upload">
                            <label for="file" class="txt">Course Thumbail</label>
                            <input type="file" id="file" class="d-none" name="thumbnail">
                            <label for="file" id="upload-box">
                                <img src="{{asset('latest/assets/images/icons/upload.svg')}}" alt="Bar" class="img-fluid"> Upload
                            </label>
                            <span>*.png, *.jpeg, *.webp file (max 5 mb)</span>
                            <span class="invalid-feedback">@error('thumbnail'){{ $message }} @enderror</span>
                        </div>
                    {{-- course page file box start --}}
                    <!-- <div class="course-content-box course-page-edit-box">
                        <div class="title"> 
                            <div class="media">
                                <img src="{{asset('latest/assets/images/icons/file.svg')}}" alt="Bar" class="img-fluid">
                                <div class="media-body">
                                    <h5>user-journey-01.doc</h5>
                                    <p>2m ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown">
                            <span>809KB</span>
                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Remove file</a></li>
                                <li><a class="dropdown-item" href="#">Replace file</a></li>
                            </ul>
                        </div>
                    </div> -->
                    {{-- course page file box end --}}
                    {{-- course page file box start --}}
                    <!-- <div class="course-content-box course-page-edit-box">
                        <div class="title"> 
                            <div class="media">
                                <img src="{{asset('latest/assets/images/icons/file.svg')}}" alt="Bar" class="img-fluid">
                                <div class="media-body">
                                    <h5>user-journey-01.doc</h5>
                                    <p>2m ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown">
                            <span>809KB</span>
                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Remove file</a></li>
                                <li><a class="dropdown-item" href="#">Replace file</a></li>
                            </ul>
                        </div>
                    </div> -->
                    {{-- course page file box end --}}{{-- course page file box start --}}
                    <!-- <div class="course-content-box course-page-edit-box">
                        <div class="title">
                            <div class="media">
                                <img src="{{asset('latest/assets/images/icons/file.svg')}}" alt="Bar" class="img-fluid">
                                <div class="media-body">
                                    <h5>user-journey-01.doc</h5>
                                    <p>2m ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown">
                            <span>809KB</span>
                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Remove file</a></li>
                                <li><a class="dropdown-item" href="#">Replace file</a></li>
                            </ul>
                        </div>
                    </div> -->
                    {{-- course page file box end --}}
                    
                </div>

                {{-- step next bttns --}}
                <div class="back-next-bttns">
                    <a href="#">Back</a>
                    <button class="btn btn-primary" type="submit">Next</button>
                </div>

                {{-- step next bttns --}}
            </form>
            </div>
        </div>
</main>
@endsection
{{-- page content @E --}}

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
<script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js" type="text/javascript"></script>
<script src="{{asset('assets/js/tinymce.js')}}" type="text/javascript"></script>
@endsection