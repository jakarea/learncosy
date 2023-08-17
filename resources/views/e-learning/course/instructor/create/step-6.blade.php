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
            <div class="col-12 col-md-10 col-lg-7 col-xl-6">
                {{-- course step --}}
                {{-- add class "active" to "step-box" for the done step and add a checkmark image icon inside "circle"
                class --}}
                {{-- add class "current" to "step-box" for the current step --}}
                <div class="course-create-step-wrap">
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="a" class="img-fluid">
                        </span>
                        <p>Contents</p>
                    </div>
                    <div class="step-box current">
                        <span class="circle"></span>
                        <p>Facts</p>
                    </div>
                    <div class="step-box">
                        <span class="circle"></span>
                        <p>Price</p>
                    </div>
                    <div class="step-box">
                        <span class="circle"></span>
                        <p>Design</p>
                    </div>
                    <div class="step-box">
                        <span class="circle"></span>
                        <p>Certificate</p>
                    </div>
                    <div class="step-box">
                        <span class="circle"></span>
                        <p>Visibility</p>
                    </div>
                    <div class="step-box">
                        <span class="circle"></span>
                        <p>Share</p>
                    </div>
                </div>
                {{-- course step --}}
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                <form action="">
                    <div class="content-settings-form-wrap">
                        <h4>Course Information</h4>
                        <div class="form-group">
                            <input id="name" class="form-control" type="text" required>
                            <label for="name">Name</label>
                        </div>
                        <div class="form-group">
                            <input id="slug" class="form-control" type="text" required>
                            <label for="slug">Slug</label>
                        </div>  
                        <div class="form-group">
                            <h6>Description</h6>
                            <textarea class="form-control" id="description"></textarea> 
                        </div>   
                        <div class="form-group d-flex align-items-center justify-content-between">
                            <h6>User must manually tick off each lesson</h6>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked> 
                              </div>
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