@extends('layouts.latest.admin')
@section('title') Top Perform Courses @endsection

{{-- style section @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- style section @E --}}

@section('content')
<main class="top-perform-courses-lists-pages">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {{-- session message @S --}}
                @include('partials/session-message')
                {{-- session message @E --}}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-12 col-sm-8 col-md-8">
                <div class="user-title-box">
                    <h1>Top Performing Courses</h1>
                </div>
            </div>
            <div class="col-lg-3 col-12 col-sm-4 col-md-4">
                <div class="user-search-box-wrap text-end" style="grid-template-columns: 100%;"> 
                    <div class="form-filter">
                        <select class="form-control">
                            <option value="">All </option>
                            <option value="">Last 7 days</option>  
                            <option value="">Last 30 days</option>  
                            <option value="">Last 1 year</option>  
                        </select>
                        <i class="fas fa-angle-down"></i>
                    </div> 
                </div>
            </div>
        </div> 
        <div class="row"> 
            
            {{-- course single box start --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="course-single-item"> 
                    <div class="course-thumb-box">
                        <div class="header-action">
                            <div class="dropdown">
                                <button class="btn btn-ellipse" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="£">View</a></li> 
                                  <li> 
                                    <form method="post" class="d-inline" action="">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item btn text-danger">Delete </button>
                                    </form>
                                </li> 
                                </ul>
                              </div> 
                        </div> 
                        <img src="{{asset('latest/assets/images/top-perfomr.png')}}" alt="Course Thumbanil" class="img-fluid"> 
                    </div> 
                    <div class="course-txt-box">
                        <a href="#">Figma UI UX Design Essentials</a>
                        <p>Chris Converse</p>
                        <ul>
                            <li><span>4.0</span></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><span>(145)</span></li>
                        </ul>
                        <h5>€ 200 <span>€ 360</span></h5> 
                    </div>
                </div>
            </div>
            {{-- course single box end --}}
            
            {{-- course single box start --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="course-single-item"> 
                    <div class="course-thumb-box">
                        <div class="header-action">
                            <div class="dropdown">
                                <button class="btn btn-ellipse" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="£">View</a></li> 
                                  <li> 
                                    <form method="post" class="d-inline" action="">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item btn text-danger">Delete </button>
                                    </form>
                                </li> 
                                </ul>
                              </div> 
                        </div> 
                        <img src="{{asset('latest/assets/images/top-perfomr.png')}}" alt="Course Thumbanil" class="img-fluid"> 
                    </div> 
                    <div class="course-txt-box">
                        <a href="#">Figma UI UX Design Essentials</a>
                        <p>Chris Converse</p>
                        <ul>
                            <li><span>4.0</span></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><span>(145)</span></li>
                        </ul>
                        <h5>€ 200 <span>€ 360</span></h5> 
                    </div>
                </div>
            </div>
            {{-- course single box end --}}
            
            {{-- course single box start --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="course-single-item"> 
                    <div class="course-thumb-box">
                        <div class="header-action">
                            <div class="dropdown">
                                <button class="btn btn-ellipse" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="£">View</a></li> 
                                  <li> 
                                    <form method="post" class="d-inline" action="">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item btn text-danger">Delete </button>
                                    </form>
                                </li> 
                                </ul>
                              </div> 
                        </div> 
                        <img src="{{asset('latest/assets/images/top-perfomr.png')}}" alt="Course Thumbanil" class="img-fluid"> 
                    </div> 
                    <div class="course-txt-box">
                        <a href="#">Figma UI UX Design Essentials</a>
                        <p>Chris Converse</p>
                        <ul>
                            <li><span>4.0</span></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><span>(145)</span></li>
                        </ul>
                        <h5>€ 200 <span>€ 360</span></h5> 
                    </div>
                </div>
            </div>
            {{-- course single box end --}}
            
            {{-- course single box start --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="course-single-item"> 
                    <div class="course-thumb-box">
                        <div class="header-action">
                            <div class="dropdown">
                                <button class="btn btn-ellipse" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="£">View</a></li> 
                                  <li> 
                                    <form method="post" class="d-inline" action="">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item btn text-danger">Delete </button>
                                    </form>
                                </li> 
                                </ul>
                              </div> 
                        </div> 
                        <img src="{{asset('latest/assets/images/top-perfomr.png')}}" alt="Course Thumbanil" class="img-fluid"> 
                    </div> 
                    <div class="course-txt-box">
                        <a href="#">Figma UI UX Design Essentials</a>
                        <p>Chris Converse</p>
                        <ul>
                            <li><span>4.0</span></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><span>(145)</span></li>
                        </ul>
                        <h5>€ 200 <span>€ 360</span></h5> 
                    </div>
                </div>
            </div>
            {{-- course single box end --}}
            
            {{-- course single box start --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="course-single-item"> 
                    <div class="course-thumb-box">
                        <div class="header-action">
                            <div class="dropdown">
                                <button class="btn btn-ellipse" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="£">View</a></li> 
                                  <li> 
                                    <form method="post" class="d-inline" action="">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item btn text-danger">Delete </button>
                                    </form>
                                </li> 
                                </ul>
                              </div> 
                        </div> 
                        <img src="{{asset('latest/assets/images/top-perfomr.png')}}" alt="Course Thumbanil" class="img-fluid"> 
                    </div> 
                    <div class="course-txt-box">
                        <a href="#">Figma UI UX Design Essentials</a>
                        <p>Chris Converse</p>
                        <ul>
                            <li><span>4.0</span></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><span>(145)</span></li>
                        </ul>
                        <h5>€ 200 <span>€ 360</span></h5> 
                    </div>
                </div>
            </div>
            {{-- course single box end --}}
            
            {{-- course single box start --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="course-single-item"> 
                    <div class="course-thumb-box">
                        <div class="header-action">
                            <div class="dropdown">
                                <button class="btn btn-ellipse" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="£">View</a></li> 
                                  <li> 
                                    <form method="post" class="d-inline" action="">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item btn text-danger">Delete </button>
                                    </form>
                                </li> 
                                </ul>
                              </div> 
                        </div> 
                        <img src="{{asset('latest/assets/images/top-perfomr.png')}}" alt="Course Thumbanil" class="img-fluid"> 
                    </div> 
                    <div class="course-txt-box">
                        <a href="#">Figma UI UX Design Essentials</a>
                        <p>Chris Converse</p>
                        <ul>
                            <li><span>4.0</span></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><span>(145)</span></li>
                        </ul>
                        <h5>€ 200 <span>€ 360</span></h5> 
                    </div>
                </div>
            </div>
            {{-- course single box end --}}
            
            {{-- course single box start --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="course-single-item"> 
                    <div class="course-thumb-box">
                        <div class="header-action">
                            <div class="dropdown">
                                <button class="btn btn-ellipse" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="£">View</a></li> 
                                  <li> 
                                    <form method="post" class="d-inline" action="">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item btn text-danger">Delete </button>
                                    </form>
                                </li> 
                                </ul>
                              </div> 
                        </div> 
                        <img src="{{asset('latest/assets/images/top-perfomr.png')}}" alt="Course Thumbanil" class="img-fluid"> 
                    </div> 
                    <div class="course-txt-box">
                        <a href="#">Figma UI UX Design Essentials</a>
                        <p>Chris Converse</p>
                        <ul>
                            <li><span>4.0</span></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><span>(145)</span></li>
                        </ul>
                        <h5>€ 200 <span>€ 360</span></h5> 
                    </div>
                </div>
            </div>
            {{-- course single box end --}}
            
            {{-- course single box start --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="course-single-item"> 
                    <div class="course-thumb-box">
                        <div class="header-action">
                            <div class="dropdown">
                                <button class="btn btn-ellipse" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="£">View</a></li> 
                                  <li> 
                                    <form method="post" class="d-inline" action="">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item btn text-danger">Delete </button>
                                    </form>
                                </li> 
                                </ul>
                              </div> 
                        </div> 
                        <img src="{{asset('latest/assets/images/top-perfomr.png')}}" alt="Course Thumbanil" class="img-fluid"> 
                    </div> 
                    <div class="course-txt-box">
                        <a href="#">Figma UI UX Design Essentials</a>
                        <p>Chris Converse</p>
                        <ul>
                            <li><span>4.0</span></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><span>(145)</span></li>
                        </ul>
                        <h5>€ 200 <span>€ 360</span></h5> 
                    </div>
                </div>
            </div>
            {{-- course single box end --}}
            
            {{-- course single box start --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="course-single-item"> 
                    <div class="course-thumb-box">
                        <div class="header-action">
                            <div class="dropdown">
                                <button class="btn btn-ellipse" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="£">View</a></li> 
                                  <li> 
                                    <form method="post" class="d-inline" action="">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item btn text-danger">Delete </button>
                                    </form>
                                </li> 
                                </ul>
                              </div> 
                        </div> 
                        <img src="{{asset('latest/assets/images/top-perfomr.png')}}" alt="Course Thumbanil" class="img-fluid"> 
                    </div> 
                    <div class="course-txt-box">
                        <a href="#">Figma UI UX Design Essentials</a>
                        <p>Chris Converse</p>
                        <ul>
                            <li><span>4.0</span></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><span>(145)</span></li>
                        </ul>
                        <h5>€ 200 <span>€ 360</span></h5> 
                    </div>
                </div>
            </div>
            {{-- course single box end --}}
            
            {{-- course single box start --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="course-single-item"> 
                    <div class="course-thumb-box">
                        <div class="header-action">
                            <div class="dropdown">
                                <button class="btn btn-ellipse" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="£">View</a></li> 
                                  <li> 
                                    <form method="post" class="d-inline" action="">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item btn text-danger">Delete </button>
                                    </form>
                                </li> 
                                </ul>
                              </div> 
                        </div> 
                        <img src="{{asset('latest/assets/images/top-perfomr.png')}}" alt="Course Thumbanil" class="img-fluid"> 
                    </div> 
                    <div class="course-txt-box">
                        <a href="#">Figma UI UX Design Essentials</a>
                        <p>Chris Converse</p>
                        <ul>
                            <li><span>4.0</span></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><span>(145)</span></li>
                        </ul>
                        <h5>€ 200 <span>€ 360</span></h5> 
                    </div>
                </div>
            </div>
            {{-- course single box end --}}
            
        </div>
        <div class="row">
            <div class="col-12">
                {{-- pagginate --}}
                <div class="paggination-wrap">
                    {{-- {{ $courses->links('pagination::bootstrap-5') }} --}}
                </div>
                {{-- pagginate --}}
            </div>
        </div>
    </div>
</main>
@endsection