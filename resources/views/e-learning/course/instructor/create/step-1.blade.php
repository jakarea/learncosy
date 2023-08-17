@extends('layouts.latest.instructor')
@section('title')
Course Create - Step 1
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
                    <div class="step-box current">
                        <span class="circle">
                            {{-- <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="icon"
                                class="img-fluid"> --}}
                        </span>
                        <p>Contents</p>
                    </div>
                    <div class="step-box">
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
            <div class="col-12 col-md-10 col-lg-9 col-xl-8">
                <div class="content-step-wrap">
                    {{-- course content box start --}}
                    <div class="course-content-box">
                        <div class="title">
                            <img src="{{asset('latest/assets/images/icons/bars-2.svg')}}" alt="Bar"
                                class="img-fluid me-4">
                            <div class="media">
                                <img src="{{asset('latest/assets/images/icons/plus-box.svg')}}" alt="Bar"
                                    class="img-fluid">
                                <div class="media-body">
                                    <h5>Course 1</h5>
                                    <p>Module with 1 page</p>
                                </div>
                            </div>
                        </div>
                        <div class="actions">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                    class="fa-solid fa-ellipsis"></i></button>
                            <a href="#"><i class="fas fa-angle-down"></i></a>
                        </div>
                    </div>
                    {{-- course content box end --}}
                    {{-- course with page --}}
                    <div class="course-with-page">
                        {{-- course content box start --}}
                        <div class="course-content-box course-content-inside">
                            <div class="title">
                                <div class="media">
                                    <img src="{{asset('latest/assets/images/icons/book.svg')}}" alt="Bar"
                                        class="img-fluid">
                                    <div class="media-body">
                                        <h5>Course 1</h5>
                                        <p>Module with 1 page</p>
                                    </div>
                                </div>
                            </div>
                            <div class="actions">
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal2"><i class="fa-solid fa-ellipsis"></i></button>
                                <a href="#"><i class="fas fa-angle-down"></i></a>
                            </div>
                        </div>
                        {{-- course content box end --}}
                        {{-- course page box start --}}
                        <div class="course-content-box course-page-box">
                            <div class="title">
                                <img src="{{asset('latest/assets/images/icons/bars-2.svg')}}" alt="Bar"
                                    class="img-fluid me-4">
                                <div class="media">
                                    <img src="{{asset('latest/assets/images/icons/file.svg')}}" alt="Bar"
                                        class="img-fluid">
                                    <div class="media-body">
                                        <h5>Page 1</h5>
                                        <p>Text</p>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Remove Lesson</a></li>
                                    <li><a class="dropdown-item" href="#">Edit Lesson</a></li>
                                </ul>
                            </div>
                        </div>
                        {{-- course page box end --}}
                        {{-- course page box start --}}
                        <div class="course-content-box course-page-box">
                            <div class="title">
                                <img src="{{asset('latest/assets/images/icons/bars-2.svg')}}" alt="Bar"
                                    class="img-fluid me-4">
                                <div class="media">
                                    <img src="{{asset('latest/assets/images/icons/audio.svg')}}" alt="Bar"
                                        class="img-fluid">
                                    <div class="media-body">
                                        <h5>Page 2</h5>
                                        <p>Text</p>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Remove Lesson</a></li>
                                    <li><a class="dropdown-item" href="#">Edit Lesson</a></li>
                                </ul>
                            </div>
                        </div>
                        {{-- course page box end --}}
                        {{-- course page box start --}}
                        <div class="course-content-box course-page-box">
                            <div class="title">
                                <img src="{{asset('latest/assets/images/icons/bars-2.svg')}}" alt="Bar"
                                    class="img-fluid me-4">
                                <div class="media">
                                    <img src="{{asset('latest/assets/images/icons/video.svg')}}" alt="Bar"
                                        class="img-fluid">
                                    <div class="media-body">
                                        <h5>Page 3</h5>
                                        <p>Text</p>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Remove Lesson</a></li>
                                    <li><a class="dropdown-item" href="#">Edit Lesson</a></li>
                                </ul>
                            </div>
                        </div>
                        {{-- course page box end --}}

                        {{-- course page add box start --}}
                        <div class="add-content-box mt-3">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                    class="fas fa-plus"></i> Add Page</button>
                        </div>
                        {{-- course page add box end --}}

                    </div>
                    {{-- course with page --}}

                    {{-- course content add box start --}}
                    <div class="add-content-box">
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                class="fas fa-plus"></i> Add Content</button>
                    </div>
                    {{-- course content add box end --}}

                    {{-- step next bttns --}}
                    <div class="back-next-bttns">
                        <a href="#">Back</a>
                        <a href="#">Next</a>
                    </div>
                    {{-- step next bttns --}}
                </div>
            </div>
        </div>
    </div>
</main>

{{-- course name modal --}}
<div class="course-name-modal">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="course-name-txt">
                        <h5>Course name</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" placeholder="Enter Course Name" class="form-control">
                            </div>
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Is a Modual</label>
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="flexSwitchCheckChecked" checked>
                            </div>
                            <p>Disable this if you want a separate content page.</p>
                            <div class="form-submit">
                                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="course-name-txt">
                        <h5>Page Name</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" placeholder="Enter Page Name" class="form-control">
                            </div>
                            <div class="page-type">
                                <h6>Type</h6>

                                <div class="d-flex">
                                    <a href="#" class="active"><img
                                            src="{{asset('latest/assets/images/icons/file.svg')}}" alt="a"
                                            class="img-fluid"> Text</a>
                                    <a href="#"><img src="{{asset('latest/assets/images/icons/audio.svg')}}" alt="a"
                                            class="img-fluid"> Audio</a>
                                    <a href="#"><img src="{{asset('latest/assets/images/icons/video.svg')}}" alt="a"
                                            class="img-fluid"> Video</a>
                                </div>
                            </div>
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Is a Modual</label>
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="flexSwitchCheckChecked" checked>
                            </div>
                            <p>Disable this if you want a separate content page.</p>
                            <div class="form-submit">
                                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- course name modal --}}

@endsection
{{-- page content @E --}}

@section('script')
@endsection