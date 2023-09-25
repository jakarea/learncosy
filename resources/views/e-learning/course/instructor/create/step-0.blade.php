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
            <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                {{-- course step --}}
                <div class="course-create-step-wrap">
                    <div class="step-box">
                        <span class="circle">
                        </span>
                        <p>Contents</p>
                    </div>
                    <div class="step-box">
                        <span class="circle">
                        </span>
                        <p>Facts</p>
                    </div>
                    <div class="step-box">
                        <span class="circle"></span>
                        <p>Objects</p>
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
                    <form action="{{ route('course.create.start') }}" method="POST" id="myForm">
                        @csrf
                        {{-- course content add box start --}}
                        <div class="add-content-box">
                            <button type="submit" class="btn"><i class="fas fa-plus"></i> Add Content</button>
                        </div>
                        {{-- course content add box end --}}

                        {{-- step next bttns --}}
                        <div class="back-next-bttns">
                            <button type="submit" class="btn btn-submit">Next</button>
                            {{-- <a href="{{ url('instructor/courses/create/'.request()->route('id').'/facts') }}"
                                id="submitForm">Next</a> --}}
                        </div>
                        {{-- step next bttns --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
{{-- page content @E --}}

@section('script')

{{-- <script>
    let myForm = document.getElementById('myForm');
    let submitForm = document.getElementById('submitForm');

    submitForm.addEventListener("click", function(e) {
    e.preventDefault();
    myForm.submit();
    });

</script> --}}
@endsection