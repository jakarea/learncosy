@extends('layouts/guest')
@section('title') Guest Home Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/slick.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')

{{-- hero section @s --}}
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6  ">
                <div class="hero-txt-wrap">
                    <h1>Online Instructor for Computer Courses</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima accusamus doloremque et hic sed
                        alias, accusantium quod cum aspernatur eligendi!</p>
                    <div class="hero-bttn">
                        <a href="{{url('/login')}}">Get Started</a>
                    </div>

                    <h6>Already 234 Students are joined!</h6>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-img-box">
                    <img src="{{asset('assets/images/desk-vector-2.png') }}" alt="desk-vector" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
{{-- hero section @e --}}

{{-- course filter box @s --}}
<div class="course-filter-wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="">
                    <div class="course-filter-box">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" placeholder="Search with title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="" id="" class="form-control">
                                <option value="" disabled>Select Below</option>
                                <option value="">Categ 01</option>
                                <option value="">Categ 02</option>
                                <option value="">Categ 03</option>
                                <option value="">Categ 04</option>
                            </select>
                            <i class="fas fa-angle-down"></i>
                        </div>
                        <div class="form-group">
                            <label for="">Subscription</label>
                            <select name="" id="" class="form-control">
                                <option value="" disabled>Select Below</option>
                                <option value="OneTime">One Time</option>
                                <option value="Anually">Anually</option>
                                <option value="Yearly">Yearly</option>
                            </select>
                            <i class="fas fa-angle-down"></i>
                        </div>
                        <div class="form-group me-0">
                            <label for="">Price Range</label>
                            <input type="range" class="form-control">
                        </div>
                        <div class="filter-bttn form-group">
                            <button type="submit" class="btn btn-submit">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- course filter box @e --}}

{{-- course wrap @s --}}
<div class="course-section-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="course-list-wrap">
                    {{-- course item @s --}}
                    <div class="course-item-box">
                        <div class="row">
                            <div class="col-lg-9 col-md-8">
                                <div class="media">
                                    <div class="course-thumbnail">
                                        <img src="{{asset('assets/images/course/mannheim-g5e079855c_1920.jpg')}}"
                                            alt="Course thumbnaik" class="img-fluid">
                                    </div>
                                    <div class="media-body">
                                        <h4>Course title will be here</h4>

                                        <div class="course-categories">
                                            <span class="badge text-bg-info">Categ 01</span>
                                            <span class="badge text-bg-success">Categ 02</span>
                                            <span class="badge text-bg-primary">Categ 03</span>
                                            <span class="badge text-bg-info">Categ 04</span>
                                        </div>

                                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem cupiditate
                                            numquam veniam nemo voluptates, voluptatibus, a </p>

                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="course-actions">
                                    <div class="review">
                                        <h5><i class="fas fa-star"></i> 5 </h5>
                                        <p>10 reviews</p>
                                    </div>
                                    <div class="bttns">
                                        <a href="#">Enroll Now!</a>
                                        <a href="#">More Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- course item @e --}}
                    {{-- course item @s --}}
                    <div class="course-item-box">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="media">
                                    <div class="course-thumbnail">
                                        <img src="{{asset('assets/images/course/quos-amet-eius-quas-2.png')}}"
                                            alt="Course thumbnaik" class="img-fluid">
                                    </div>
                                    <div class="media-body">
                                        <h4>Course title will be here</h4>

                                        <div class="course-categories">
                                            <span class="badge text-bg-info">Categ 01</span>
                                            <span class="badge text-bg-success">Categ 02</span>
                                            <span class="badge text-bg-primary">Categ 03</span>
                                            <span class="badge text-bg-info">Categ 04</span>
                                        </div>

                                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem cupiditate
                                            numquam veniam nemo voluptates, voluptatibus, a </p>

                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="course-actions">
                                    <div class="review">
                                        <h5><i class="fas fa-star"></i> 5 </h5>
                                        <p>10 reviews</p>
                                    </div>
                                    <div class="bttns">
                                        <a href="#">Enroll Now!</a>
                                        <a href="#">More Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- course item @e --}}
                    {{-- course item @s --}}
                    <div class="course-item-box">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="media">
                                    <div class="course-thumbnail">
                                        <img src="{{asset('assets/images/course/course-thumbnai-02.png')}}"
                                            alt="Course thumbnaik" class="img-fluid">
                                    </div>
                                    <div class="media-body">
                                        <h4>Course title will be here</h4>

                                        <div class="course-categories">
                                            <span class="badge text-bg-info">Categ 01</span>
                                            <span class="badge text-bg-success">Categ 02</span>
                                            <span class="badge text-bg-primary">Categ 03</span>
                                            <span class="badge text-bg-info">Categ 04</span>
                                        </div>

                                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem cupiditate
                                            numquam veniam nemo voluptates, voluptatibus, a </p>

                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="course-actions">
                                    <div class="review">
                                        <h5><i class="fas fa-star"></i> 5 </h5>
                                        <p>10 reviews</p>
                                    </div>
                                    <div class="bttns">
                                        <a href="#">Enroll Now!</a>
                                        <a href="#">More Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- course item @e --}}
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="d-ins-flex">
                    <div class="course-instructor me-md-2 me-lg-0">
                        <div class="thumbnail">
                            <img src="{{asset('assets/images/course/reiciendis-error-sed-1.png')}}" alt="Avatar"
                                class="img-fluid">
                        </div>
                        <div class="txt">
                            <h4>Jhon Doe</h4>
                            <h5>Short Bio ! will be appear here, nothing else.</h5>
                            <a href="#">View full Profile</a>
                        </div>
                    </div>
                    <div class="course-instructor">
                        <div class="thumbnail">
                            <img src="{{asset('assets/images/course/reiciendis-error-sed-1.png')}}" alt="Avatar"
                                class="img-fluid">
                        </div>
                        <div class="txt">
                            <h4>Jhon Doe</h4>
                            <h5>Short Bio ! will be appear here, nothing else.</h5>
                            <a href="#">View full Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- course wrap @e --}}

{{-- bundle course @s --}}
<div class="bundle-course-wrap">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="bundle-course-head">
                    <h2>Bundle Courses</h2>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Incidunt, similique.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="browse-all">
                    <a href="#">Browse all <i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="bundle-course-box">
                    <div class="thumbnail">
                        <img src="{{asset('assets/images/course/course-thumbnai-01.png') }}" alt="a" class="img-fluid">
                    </div>
                    <div class="txt">
                        <h4>bundle Course title will be here!</h4>
                        <div class="categories">
                            <span class="badge text-bg-info">Categ 01</span>
                            <span class="badge text-bg-info">Categ 02</span>
                            <span class="badge text-bg-info">Categ 03</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus necessitatibus distinctio corrupti natus! At, cumque harum. Similique.</p>
                    </div>
                    <div class="bttns">
                        <h6>€ 120/ <span>included 3 courses</span></h6>
                        <a href="#">Buy now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="bundle-course-box">
                    <div class="thumbnail">
                        <img src="{{asset('assets/images/course/course-thumbnai-01.png') }}" alt="a" class="img-fluid">
                    </div>
                    <div class="txt">
                        <h4>bundle Course title will be here!</h4>
                        <div class="categories">
                            <span class="badge text-bg-info">Categ 01</span>
                            <span class="badge text-bg-info">Categ 02</span>
                            <span class="badge text-bg-info">Categ 03</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus necessitatibus distinctio corrupti natus! At, cumque harum. Similique.</p>
                    </div>
                    <div class="bttns">
                        <h6>€ 120/ <span>included 3 courses</span></h6>
                        <a href="#">Buy now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="bundle-course-box">
                    <div class="thumbnail">
                        <img src="{{asset('assets/images/course/course-thumbnai-01.png') }}" alt="a" class="img-fluid">
                    </div>
                    <div class="txt">
                        <h4>bundle Course title will be here!</h4>
                        <div class="categories">
                            <span class="badge text-bg-info">Categ 01</span>
                            <span class="badge text-bg-info">Categ 02</span>
                            <span class="badge text-bg-info">Categ 03</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus necessitatibus distinctio corrupti natus! At, cumque harum. Similique.</p>
                    </div>
                    <div class="bttns">
                        <h6>€ 120/ <span>included 3 courses</span></h6>
                        <a href="#">Buy now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- bundle course @e --}}

{{-- review section @s --}}
<section class="review-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="bundle-course-head">
                    <h2>Our Student Feedback</h2>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Incidunt, similique.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="browse-all">
                    <a href="#">Browse all <i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="student-feeback-box">
                    <div class="media">
                        <img src="{{asset('assets/images/avatar.png')}}" alt="a" class="img-fluid">
                        <div class="media-body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, atque quod. Minus quae rem quo ab, vitae tempora excepturi facere consectetur sapiente laboriosam. Tempore, atque!</p>

                            <h6>Jhon Doe</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- review section @e --}}

{{-- get start @s --}}
<section class="get-start">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="get-start-box">
                    <h5>Get the best Instructor and best course <br> over the world!</h5>
                    <a href="#">Get enroll now!</a>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- get start @e --}}

{{-- footer section @s --}}
<footer class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-6">
                <div class="ftr-links">
                    <h5>Information</h5>

                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Course</a></li>
                        <li><a href="#">Bundle Course</a></li>
                        <li><a href="#">Fededback</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-6">
                <div class="ftr-links">
                    <h5>Information</h5>

                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Course</a></li>
                        <li><a href="#">Bundle Course</a></li>
                        <li><a href="#">Fededback</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-6">
                <div class="ftr-links">
                    <h5>Information</h5>

                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Course</a></li>
                        <li><a href="#">Bundle Course</a></li>
                        <li><a href="#">Fededback</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="ftr-copy">
                    <p>All Right Reserved &copy; Learcosy 2023</p>
                </div>
            </div>
        </div>
    </div>
</footer>
{{-- footer section @e --}}

@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
<script src="{{ asset('assets/js/home/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/home/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/home/config.js') }}"></script>
@endsection
{{-- page script @E --}}