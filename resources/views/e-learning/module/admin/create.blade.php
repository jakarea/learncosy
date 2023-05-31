@extends('layouts/instructor')
@section('title') Module Create Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- get course id from url @S --}}
@php
  $course_id = isset($_GET['course']) ? $_GET['course'] : ''; 
@endphp
{{-- get course id from url @E --}}

<!-- === course create page @S === -->
<main class="product-research-form">
    <div class="product-research-create-wrap">
        <div class="row">
            <div class="col-lg-12">
                <div class="create-form-wrap">
                    <div class="create-form-head">
                        <h6>Create a new Module</h6>
                        <a href="{{url('admin/modules')}}">
                            <i class="fa-solid fa-list"></i> All Module </a>
                    </div>
                    <!-- course create form @S -->
                    <form action="{{route('admin.module.store')}}" method="POST" class="create-form-box">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-error">
                                            <label for="course_id">Select Course <sup class="text-danger">*</sup>
                                            </label> 
                                            <select name="course_id" id="course_id" class="form-control @error('course_id') is-invalid @enderror">
                                                <option value="" disabled>Select Below</option>
                                                @foreach($courses as $course)
                                                <option value="{{$course->id}}" {{ $course->id == $course_id ? 'selected' : '' }}>{{$course->title}}</option>
                                                @endforeach
                                            </select> 
                                            <span class="invalid-feedback">@error('course_id'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>  
                                    <div class="col-md-12">
                                        <div class="form-group form-error">
                                            <label for="title">Title <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="text" placeholder="Enter Course Title" name="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                value="{{ old('title')}}" id="title">
                                            <span class="invalid-feedback">@error('title'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="number_of_lesson">Total Lesson
                                            </label>
                                            <input type="number" placeholder="Enter total lesson"
                                                name="number_of_lesson"
                                                class="form-control @error('number_of_lesson') is-invalid @enderror"
                                                value="{{ old('number_of_lesson')}}" id="number_of_lesson">
                                            <span class="invalid-feedback">@error('number_of_lesson'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="number_of_attachment">Total File
                                            </label>
                                            <input type="number" placeholder="Enter total File"
                                                name="number_of_attachment"
                                                class="form-control @error('number_of_attachment') is-invalid @enderror"
                                                value="{{ old('number_of_attachment')}}" id="number_of_attachment">
                                            <span class="invalid-feedback">@error('number_of_attachment'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="number_of_video">Total Video
                                            </label>
                                            <input type="number" placeholder="Enter total video"
                                                name="number_of_video"
                                                class="form-control @error('number_of_video') is-invalid @enderror"
                                                value="{{ old('number_of_video')}}" id="number_of_video">
                                            <span class="invalid-feedback">@error('number_of_video'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="duration">Total Duration
                                            </label>
                                            <input type="number" placeholder="Enter duration" name="duration"
                                                class="form-control @error('duration') is-invalid @enderror"
                                                value="{{ old('duration')}}" id="duration">
                                            <span class="invalid-feedback">@error('duration'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>  
                                    <div class="col-12">
                                        <div class="custom-hr">
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status"
                                                class="form-control @error('status') is-invalid @enderror">
                                                <option value="" disabled>Select Below</option>
                                                <option value="draft">Draft</option>
                                                <option value="pending">Pending</option>
                                                <option value="published">Published</option>
                                            </select>
                                            <i class="fa-solid fa-angle-down"></i>
                                            <span class="invalid-feedback">@error('status'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>

                                </div> <!-- row end -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="submit-bttns">
                                    <button type="reset" class="btn btn-reset">Clear</button>
                                    <button type="submit" class="btn btn-submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- course create form @E -->
                </div>
            </div>
        </div>
    </div>
</main>
<!-- === course create page @E === -->
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
 
@endsection

{{-- page script @E --}}