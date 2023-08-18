@extends('layouts.latest.instructor')
@section('title')
Course Create - Step 3
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
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="icon"
                                class="img-fluid">
                        </span>
                        <p>Content</p>
                    </div>
                    <div class="step-box current">
                        <span class="circle"></span>
                        <p>Institutions</p>
                    </div>
                </div>
                {{-- course step --}}
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                <form action="">
                    <div class="content-settings-form-wrap">
                        <h4>Content Settings</h4>
                        <div class="form-group">
                            <input id="name" class="form-control" type="text" required>
                            <label for="name">Name</label>
                        </div>
                        <div class="form-group">
                            <input id="slug" class="form-control" type="text" required>
                            <label for="slug">Slug</label>
                        </div>
                        <div class="content-type">
                            <h5>Type</h5>

                            <div class="d-flex">
                                <a href="#" class="active"><img src="{{asset('latest/assets/images/icons/file.svg')}}" alt="a" class="img-fluid"> Text</a>
                                <a href="#"><img src="{{asset('latest/assets/images/icons/audio.svg')}}" alt="a" class="img-fluid">Audio</a>
                                <a href="#"><img src="{{asset('latest/assets/images/icons/video.svg')}}" alt="a" class="img-fluid">Video</a>
                            </div>
                        </div>

                        <hr>

                        <div class="element-txt">
                            <h6>Element of</h6>
                            <p>Here you can choose whether the page is part of a module of whether it falls under the training as a separate item.</p>
                        </div>

                        <div class="form-group">
                            <input id="cls" class="form-control" type="text" required>
                            <label for="cls">Class</label>
                        </div>
                        
                    </div>

                    {{-- step next bttns --}}
                    <div class="back-next-bttns">
                        <a href="#">Back</a>
                        <a href="#">Next</a>
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
<script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js"
    type="text/javascript"></script>
<script src="{{asset('assets/js/tinymce.js')}}" type="text/javascript"></script>
@endsection