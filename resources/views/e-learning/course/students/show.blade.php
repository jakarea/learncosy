@extends('layouts/instructor')
@section('title') Course Details Page @endsection

{{-- style section @S --}}
@section('style')
<link href="{{ asset('assets/css/course.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/student.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- style section @E --}}

@section('content')
@php
$i = 0;
@endphp
<main class="course-page-wrap">
    <!-- suggested banner @S -->
    <div class="learning-banners-wrap" @if($course->banner) style="background-image:
        url('{{asset("assets/images/courses/".$course->banner)}}');" @endif>
        <div class="media">
            <div class="media-body">
                <h1 class="addspy-main-title">{{$course->title}}</h1>
                <p>{{$course->sub_title}}</p>
                <form action="{{route('students.checkout', $course->slug)}}" method="GET">
                    <input type="hidden" name="course_id" value="{{$course->id}}">
                    <input type="hidden" name="price" value="{{$course->price}}">
                    <input type="hidden" name="instructor_id" value="{{$course->instructor_id}}">
                    <button type="submit" class="btn btn-primary">Enroll Now</button>
                </form>
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
                    @foreach($modules as $module)
                    @php $i++; @endphp
                    <div class="accordion-item">
                        <span class="numbering active"> {{$i}} </span>
                        <div class="accordion-header" id="heading_{{$module->id}}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_{{$module->id}}" aria-expanded="true"
                                aria-controls="collapseOne">
                                <div class="d-flex">
                                    <p>{{ $module->title }}</p>
                                    <i class="fas fa-caret-down"></i>
                                </div>
                            </button>
                        </div>
                        <div id="collapse_{{$module->id}}" class="accordion-collapse collapse "
                            aria-labelledby="heading_{{$module->id}}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul>
                                    @foreach($lessons as $lesson)
                                    <li>
                                        <a href="#">
                                            <img src="http://localhost:8000/assets/images/course/small-book.svg"
                                                alt="Lesson Icon" class="img-fluid"> {{ $lesson->title }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-7 col-lg-8">
            <div class="mylearning-video-content-box custom-margin-top">
                <div class="video-iframe-vox">
                    <a href="#">
                        <img src="{{asset('assets/images/courses/'.$course->thumbnail)}}" alt="Course"
                            class="img-fluid">
                    </a>
                </div>
                <div class="content-txt-box">
                    <div class="d-flex">
                        <h3>{{$course->title}}</h3>
                        <a href="{{url('course/messages/send/1')}}" class="min_width">Message to Instructor</a>
                    </div>
                    {!! $course->description !!}
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
                        @if($course->number_of_attachment)
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
                        @else
                        <div class="col-lg-12">
                            <div class="attached-file-box me-lg-2">
                                <p>No Resource Found</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="course-content-box">
                    <div class="d-flex border-0">
                        <h5>Course's reviews</h5> 
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- review box @S --}}
                            <div class="attached-file-box review-box">
                                <div class="d_flex">
                                    <h4><img src="{{asset('assets/images/avatar.png')}}" alt="Place"
                                            class="img-fluid me-1"> Jhon Doe</h4>
                                    <ul class="review-box-icon">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>

                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus aperiam, minima
                                    amet omnis impedit delectus voluptatum iusto quaerat suscipit ipsa at? Ratione
                                    assumenda nobis quis voluptas neque earum aspernatur optio!</p>
                            </div>
                            {{-- review box @E --}}
                            {{-- review box @S --}}
                            <div class="attached-file-box review-box">
                                <div class="d_flex">
                                    <h4><img src="{{asset('assets/images/avatar.png')}}" alt="Place"
                                            class="img-fluid me-1"> Sttefen Smith</h4>
                                    <ul class="review-box-icon">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li> 
                                    </ul>
                                </div>

                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus aperiam, minima
                                    amet omnis impedit delectus voluptatum iusto quaerat suscipit ipsa at? Ratione
                                    assumenda nobis quis voluptas neque earum aspernatur optio!</p>
                            </div>
                            {{-- review box @E --}}
                        </div>
                        <div class="col-12">
                            <div class="write-review-box">
                                <form action="">
                                    <div class="form-group">
                                        <label for="review">Write a review</label>
                                        <textarea name="" id="review" cols="30" rows="5" class="form-control"
                                            placeholder="Write a review"> </textarea>
                                    </div>
                                    <div class="form-rev"> 
                                        <div id="full-stars">
                                            <div class="rating-group"> 
                                                <label aria-label="1 star" class="rating__label" for="rating-1"><i
                                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                <input class="rating__input" name="rating" id="rating-1" value="1"
                                                    type="radio">
                                                <label aria-label="2 stars" class="rating__label" for="rating-2"><i
                                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                <input class="rating__input" name="rating" id="rating-2" value="2"
                                                    type="radio">
                                                <label aria-label="3 stars" class="rating__label" for="rating-3"><i
                                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                <input class="rating__input" name="rating" id="rating-3" value="3"
                                                    type="radio" checked>
                                                <label aria-label="4 stars" class="rating__label" for="rating-4"><i
                                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                <input class="rating__input" name="rating" id="rating-4" value="4"
                                                    type="radio">
                                                <label aria-label="5 stars" class="rating__label" for="rating-5"><i
                                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                <input class="rating__input" name="rating" id="rating-5" value="5"
                                                    type="radio">
                                            </div>
                                        </div> 
                                        <button type="submit" class="btn btn-submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="attached-file-box">
                                <p>No Review Found</p>
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