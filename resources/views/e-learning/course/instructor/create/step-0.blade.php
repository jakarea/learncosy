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

                <div class="course-create-step-wrap">
                    <div class="step-box current">
                        <span class="circle">
                            {{-- <img src="{{asset('latest/assets/images/icons/check-mark.svg')}}" alt="a"
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
                    <form action="{{ route('course.create.start') }}" method="POST">
                        @csrf
                        {{-- course content add box start --}}
                        <div class="add-content-box">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#moduleModal"><i
                                class="fas fa-plus"></i> Add Content</button>
                        </div>
                        {{-- course content add box end --}}

                        {{-- step next bttns --}}
                        <div class="back-next-bttns">  
                            <button type="submit" class="btn btn-submit">Next</button>
                        </div>
                        {{-- step next bttns --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- course name modal --}}
<div class="course-name-modal">
    <div class="modal fade" id="moduleModal" tabindex="-1" aria-labelledby="moduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="course-name-txt">
                        <h5>Module name</h5> 

                        <form action="{{ route('course.create.start') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" placeholder="Enter Module Name" name="module_name"
                                    class="form-control">
                            </div>
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="is_module">Is a Modual</label>
                                <input class="form-check-input" type="checkbox" name="is_module" value="1" role="switch"
                                    id="is_module" checked>
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