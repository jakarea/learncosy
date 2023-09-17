@extends('layouts.latest.instructor')

@section('title') All Courses @endsection

{{-- style section @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- style section @E --}}

@section('content')
<main class="courses-lists-pages">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {{-- session message @S --}}
                @include('partials/session-message')
                {{-- session message @E --}}
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xl-9">
                <div class="user-title-box">
                    <h1>Notification </h1>
                </div>
            </div> 
            <div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-3">
                <div class="user-search-box-wrap">
                    <div class="form-filter">
                        <select class="form-control">
                            <option value="">Today</option>
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
            <div class="col-lg-12">
                <hr class="line">
                <div class="notification-box-wrapper">
                    {{-- day --}}
                    <h5>Today</h5>
                    {{-- day --}}

                    {{-- notify item start --}}
                    <div class="notify-item-box">
                        <div class="media">
                            <div class="icon">
                                <img src="{{asset('latest/assets/images/icons/gallery.svg')}}" alt="icon" class="img-fluid">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="media-body">
                                <h5>Leonardi Bernado liked</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>

                        <div class="delete-item">
                            <a href="#"> 
                                <img src="{{asset('latest/assets/images/icons/trash-bin.svg')}}" alt="icon" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    {{-- notify item end --}}

                    {{-- notify item start --}}
                    <div class="notify-item-box">
                        <div class="media">
                            <div class="icon">
                                <img src="{{asset('latest/assets/images/icons/gallery.svg')}}" alt="icon" class="img-fluid">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="media-body">
                                <h5>Leonardi Bernado liked</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>

                        <div class="delete-item">
                            <a href="#"> 
                                <img src="{{asset('latest/assets/images/icons/trash-bin.svg')}}" alt="icon" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    {{-- notify item end --}}

                    {{-- notify item start --}}
                    <div class="notify-item-box">
                        <div class="media">
                            <div class="icon">
                                <img src="{{asset('latest/assets/images/icons/gallery.svg')}}" alt="icon" class="img-fluid">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="media-body">
                                <h5>Leonardi Bernado liked</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>

                        <div class="delete-item">
                            <a href="#"> 
                                <img src="{{asset('latest/assets/images/icons/trash-bin.svg')}}" alt="icon" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    {{-- notify item end --}}

                    {{-- day --}}
                    <h5 class="mt-5">Yesterday</h5>
                    {{-- day --}}

                    {{-- notify item start --}}
                    <div class="notify-item-box">
                        <div class="media">
                            <div class="icon">
                                <img src="{{asset('latest/assets/images/icons/gallery.svg')}}" alt="icon" class="img-fluid">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="media-body">
                                <h5>Leonardi Bernado liked</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>

                        <div class="delete-item">
                            <a href="#"> 
                                <img src="{{asset('latest/assets/images/icons/trash-bin.svg')}}" alt="icon" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    {{-- notify item end --}}

                    {{-- notify item start --}}
                    <div class="notify-item-box">
                        <div class="media">
                            <div class="icon">
                                <img src="{{asset('latest/assets/images/icons/gallery.svg')}}" alt="icon" class="img-fluid">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="media-body">
                                <h5>Leonardi Bernado liked</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>

                        <div class="delete-item">
                            <a href="#"> 
                                <img src="{{asset('latest/assets/images/icons/trash-bin.svg')}}" alt="icon" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    {{-- notify item end --}}

                    {{-- notify item start --}}
                    <div class="notify-item-box">
                        <div class="media">
                            <div class="icon">
                                <img src="{{asset('latest/assets/images/icons/gallery.svg')}}" alt="icon" class="img-fluid">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="media-body">
                                <h5>Leonardi Bernado liked</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>

                        <div class="delete-item">
                            <a href="#"> 
                                <img src="{{asset('latest/assets/images/icons/trash-bin.svg')}}" alt="icon" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    {{-- notify item end --}}

                    {{-- notify item start --}}
                    <div class="notify-item-box">
                        <div class="media">
                            <div class="icon">
                                <img src="{{asset('latest/assets/images/icons/gallery.svg')}}" alt="icon" class="img-fluid">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="media-body">
                                <h5>Leonardi Bernado liked</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>

                        <div class="delete-item">
                            <a href="#"> 
                                <img src="{{asset('latest/assets/images/icons/trash-bin.svg')}}" alt="icon" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    {{-- notify item end --}}
                </div>
            </div>
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