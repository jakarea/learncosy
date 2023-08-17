@extends('layouts.latest.instructor')
@section('title')
Course Create - Step 11
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
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="a" class="img-fluid">
                        </span>
                        <p>Facts</p>
                    </div>
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="a" class="img-fluid">
                        </span>
                        <p>Price</p>
                    </div>
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="a" class="img-fluid">
                        </span>
                        <p>Design</p>
                    </div>
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="a" class="img-fluid">
                        </span>
                        <p>Certificate</p>
                    </div>
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="a" class="img-fluid">
                        </span>
                        <p>Visibility</p>
                    </div>
                    <div class="step-box current">
                        <span class="circle"></span>
                        <p>Share</p>
                    </div>
                </div>
                {{-- course step --}}
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-7 col-xl-6">
                <div class="share-on-social-wrap">
                    <h4>Share</h4> 

                    <h6>As a post</h6>

                    <div class="d-flex">
                        <a href="#">
                            <img src="{{asset('latest/assets/images/icons/fb.svg')}}" alt="FB" class="img-fluid">
                            <span>Facebook</span>
                        </a>
                        <a href="#">
                            <img src="{{asset('latest/assets/images/icons/ins.svg')}}" alt="FB" class="img-fluid">
                            <span>Instagram</span>
                        </a>
                        <a href="#">
                            <img src="{{asset('latest/assets/images/icons/tkt.svg')}}" alt="FB" class="img-fluid">
                            <span>Tiktok</span>
                        </a>
                        <a href="#">
                            <img src="{{asset('latest/assets/images/icons/twt.svg')}}" alt="FB" class="img-fluid">
                            <span>Twitter</span>
                        </a>
                    </div>

                    <h6>As a message</h6>

                    <div class="d-flex">
                        <a href="#">
                            <img src="{{asset('latest/assets/images/icons/messenger.svg')}}" alt="FB" class="img-fluid">
                            <span>Messenger</span>
                        </a>
                        <a href="#">
                            <img src="{{asset('latest/assets/images/icons/wapp.svg')}}" alt="FB" class="img-fluid">
                            <span>Whatsapp</span>
                        </a>
                        <a href="#">
                            <img src="{{asset('latest/assets/images/icons/teleg.svg')}}" alt="FB" class="img-fluid">
                            <span>Telegram</span>
                        </a>
                        <a href="#">
                            <img src="{{asset('latest/assets/images/icons/twec.svg')}}" alt="FB" class="img-fluid">
                            <span>Wechat</span>
                        </a>
                    </div>

                    <h6>Or copy link</h6>

                    <div class="copy-link">
                        <input type="text" placeholder="Link" value="https://73cd2de3/f139-4813-b1ab/4ccc9fd9a4f0/course/newcoursecoure" class="form-control">
                        <a href="#">Copy</a>
                    </div>

                </div>
            </div>
        </div>
</main>
@endsection
{{-- page content @E --}}

@section('script')

@endsection