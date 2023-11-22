@extends('layouts.latest.admin')
@section('title')
Course Update - Final Step
@endsection
{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="course-create-step-page-wrap">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                {{-- course step --}} 
                <div class="course-create-step-wrap">
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="icon"
                                class="img-fluid">
                        </span>
                        <p>Contents</p>
                    </div>
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="icon"
                            class="img-fluid">
                        </span>
                        <p>Facts</p>
                    </div>
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="icon"
                            class="img-fluid">
                        </span>
                        <p>Objects</p>
                    </div>
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="icon"
                            class="img-fluid">
                        </span>
                        <p>Price</p>
                    </div>
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="icon"
                            class="img-fluid">
                        </span>
                        <p>Design</p>
                    </div>
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="icon"
                            class="img-fluid">
                        </span>
                        <p>Certificate</p>
                    </div>
                    <div class="step-box active">
                        <span class="circle">
                            <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="icon"
                            class="img-fluid">
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
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('admin/courses/overview',$course->slug)}}"
                            target="_blank">
                            <img src="{{asset('latest/assets/images/icons/fb.svg')}}" alt="FB" class="img-fluid">
                            <span>Facebook</span>
                        </a>
                        <a href="#">
                            <img src="{{asset('latest/assets/images/icons/tg.svg')}}" alt="TG" class="img-fluid">
                            <span>Telegram</span>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?url={{ url('admin/courses/overview',$course->slug)}}" target="_blank">
                            <img src="{{asset('latest/assets/images/icons/linkedin-ic.svg')}}" alt="FB"
                                class="img-fluid">
                            <span>LinkedIn</span>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ url('admin/courses/overview',$course->slug)}}&text={{ $course->title }}"
                            target="_blank"> <img src="{{asset('latest/assets/images/icons/twt.svg')}}" alt="FB"
                                class="img-fluid">
                            <span>Twitter</span>
                        </a>
                    </div>

                    <h6>As a message</h6>

                    <div class="d-flex">

                        <a href="https://www.messenger.com/share.php?text={{ url('admin/courses/overview',$course->slug) }}">
                            <img src="{{asset('latest/assets/images/icons/messenger.svg')}}" alt="FB" class="img-fluid">
                            <span>Messenger</span>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ url('admin/courses/overview',$course->slug) }}">
                            <img src="{{asset('latest/assets/images/icons/wapp.svg')}}" alt="FB" class="img-fluid">
                            <span>Whatsapp</span>
                        </a>
                        <a href="https://telegram.me/share/url?url={{ url('admin/courses/overview',$course->slug) }}">
                            <img src="{{asset('latest/assets/images/icons/teleg.svg')}}" alt="FB" class="img-fluid">
                            <span>Telegram</span>
                        </a>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-0">
                        <h6>Or copy link</h6>
                        <span id="notify" style="color: green; font-size: 14px;"></span>
                    </div>
                    
                    <div class="copy-link">
                        <input type="text" placeholder="Link" value="{{ url('admin/courses/overview', $course->slug)}}"
                            class="form-control" id="linkToCopy">
                        <a href="#" id="copyButton">Copy</a>
                    </div>
                </div>
                
                {{-- step next bttns --}}
                <div class="back-next-bttns">
                    <a href="{{ url('admin/courses/create/'.$course->id.'/visibility')}}">Back</a>
                    <a href="{{ url('admin/courses')}}">Finish</a> 
                </div>
                {{-- step next bttns --}}
            </div>
        </div>
</main>
@endsection
{{-- page content @E --}}

@section('script')
<script>
    const copyButton = document.getElementById("copyButton");
    const linkToCopy = document.getElementById("linkToCopy");
    const notify = document.getElementById("notify");

    copyButton.addEventListener("click", (e) => {
        e.preventDefault();
        linkToCopy.select();
        document.execCommand("copy"); 
        notify.innerText = 'Copied!';

        setTimeout(() => {
            notify.innerText = '';
        }, 1000);

    });

</script>
@endsection