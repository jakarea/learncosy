@extends('layouts/instructor')
@section('title') Course Details Page @endsection

{{-- style section @S --}}
@section('style')
<link href="{{ asset('assets/css/course.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- style section @E --}}

@section('content')
<main class="course-page-wrap">
    <!-- suggested banner @S -->
    <div class="learning-banners-wrap">
        <div class="media">
            <div class="media-body">
                <h1 class="addspy-main-title">Molestias eaque maxi</h1>
                <p>Consequatur vitae qu</p>
                <a href="#">Continue</a>
            </div>
        </div>
    </div>
    <!-- suggested banner @E -->

    <div class="row">
        <div class="col-12 col-sm-12 col-md-5 col-lg-4">
            <div class="mylearning-txt-box mt-4">
                <h5>Course's Outline</h5>
            </div>
            <div class="course-outline-box">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <span class="numbering active"> 1 </span>
                        <div class="accordion-header" id="heading_1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_1" aria-expanded="true" aria-controls="collapseOne">
                                <div class="d-flex">
                                    <p>Veniam suscipit mol </p>
                                    <i class="fas fa-caret-down"></i>
                                </div>
                            </button>
                        </div>
                        <div id="collapse_1" class="accordion-collapse collapse " aria-labelledby="heading_1"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul>
                                    <li><a href="#"><img src="http://localhost:8000/assets/images/course/small-book.svg"
                                                alt="" class="img-fluid"> Quibusdam natus tota</a></li>
                                </ul>
                                <div class="text-center">
                                    <a href="{{ url('lesson/create?course=1&module=1') }}"
                                        class="add_lesson_bttn">Add Lesson</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <span class="numbering "> 2 </span>
                        <div class="accordion-header" id="heading_2">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_2" aria-expanded="true" aria-controls="collapseOne">
                                <div class="d-flex">
                                    <p>Consequuntur aut dol </p>
                                    <i class="fas fa-caret-down"></i>
                                </div>
                            </button>
                        </div>
                        <div id="collapse_2" class="accordion-collapse collapse " aria-labelledby="heading_2"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul>
                                </ul>
                                <div class="text-center">
                                    <a href="{{ url('lesson/create?course=1&module=2') }}"
                                        class="add_lesson_bttn">Add Lesson</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ url('module/create?course=1') }}" class="add_module_bttn">Add Module </a> 
        </div>
        <div class="col-12 col-sm-12 col-md-7 col-lg-8">
            <div class="mylearning-video-content-box custom-margin-top">
                <div class="video-iframe-vox">
                    <a href="#">
                        <img src="{{asset('assets/images/course/harum-dolore-fuga-l-1.png')}}" alt="Course" class="img-fluid">
                    </a>
                </div>
                <div class="content-txt-box">
                    <div class="d-flex">
                        <h3>Molestias eaque maxi</h3>
                        <a href="#" class="min_width">Continue</a>
                    </div>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur nemo eveniet omnis. Deleniti non
                    dolore odio, ipsa quidem ullam provident eveniet velit qui architecto quasi rem doloremque tenetur
                    fuga explicabo vitae reprehenderit quos ea laudantium ut repellendus! Id modi ullam possimus
                    exercitationem architecto accusamus aliquam dolorem provident, quia dolores consectetur atque
                    repudiandae est laborum corporis doloremque esse at incidunt excepturi.
                </div>
                <div class="profile-box">
                    <div class="media">
                        <img src="{{asset('assets/images/course/avatar.png')}}" alt="Place" class="img-fluid">
                        <div class="media-body">
                            <h5>Esther Howard</h5>
                            <p>Professional English Teacher</p>
                        </div>
                    </div>
                </div>
                <div class="course-content-box">
                    <div class="d-flex">
                        <h5>Course’s content</h5>
                        <p>Last Updated : 2 hours ago</p>
                    </div>
                    <div class="row border-right-custom">
                        <div class="col-lg-12">
                            <div class="attached-file-box me-lg-2">
                                <h4><img src="{{asset('assets/images/course/pdf-icon.svg')}}" alt="Place"
                                        class="img-fluid me-1" width="40"> Attachment Name</h4>
                                <a href="#">
                                    <img src="{{asset('assets/images/course/download-icon.svg')}}" alt="Place"
                                        class="img-fluid">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="attached-file-box me-lg-2">
                                <p>No Resource Found</p>
                            </div>
                        </div>
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