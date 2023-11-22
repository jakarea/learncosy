@extends('layouts.latest.admin')
@section('title')
Course Create - Step 7
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
                    <div class="step-box current">
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
            <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                <form action="" method="POST" >
                    @csrf
                    <div class="content-settings-form-wrap"> 
                        <h4>Select Price</h4>
                        <div class="form-group">
                            <input id="price" class="form-control" name="price" value="{{ $course->price ? $course->price : old('price')  }}" type="text" >
                            <label for="price">Regular Price</label>
                            <img src="{{asset('latest/assets/images/icons/euro.svg')}}" alt="a" class="img-fluid euro">
                            <span class="invalid-feedback d-block">@error('price'){{ $message }} @enderror</span>
                        </div>
                        <div class="form-group">
                            <input id="offer_price" class="form-control" name="offer_price" value="{{ $course->offer_price ? $course->offer_price : old('offer_price')  }}" type="text" >
                            <label for="offer_price">Sales Price</label>
                            {{-- <span>€</span> --}}
                            <img src="{{asset('latest/assets/images/icons/euro.svg')}}" alt="a" class="img-fluid euro">
                            <span class="invalid-feedback d-block">@error('offer_price'){{ $message }}
                                        @enderror</span>
                        </div>    
                    </div>

                    {{-- step next bttns --}}
                    <div class="back-next-bttns">
                        <a href="{{ url('admin/courses/create/'.request()->route('id').'/objects') }}">Back</a>
                        <button class="btn btn-primary" type="submit">Next</button>
                    </div>
                    {{-- step next bttns --}}
                </form>
            </div>
        </div>
</main>
@endsection
{{-- page content @E --}}

@section('script')
 
@endsection