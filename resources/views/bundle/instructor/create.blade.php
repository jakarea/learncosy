@extends('layouts/instructor')
@section('title') Bundle Course Create Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"
    rel="stylesheet" type="text/css">

@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<!-- === course create page @S === -->
<main class="product-research-form">
    <div class="product-research-create-wrap">
        <div class="row">
            <div class="col-lg-12">
                <div class="create-form-wrap">
                    <div class="create-form-head">
                        <h6>Create a new Bundle Course</h6>
                        <a href="{{url('bundle/course')}}">
                            <i class="fa-solid fa-list"></i> All Bundle Courses </a>
                    </div>
                    <!-- course create form @S -->
                    <form action="{{route('course.bundle.store')}}" method="POST" class="create-form-box custom-select" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
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
                                    <div class="col-md-10">
                                        <div class="form-group form-error">
                                            <label for="selected_course">Select Courses <sup class="text-danger">*</sup>
                                            </label>
                                            <select multiple aria-label="Default select example"
                                                data-live-search="true" class="form-control selectpicker @error('selected_course') is-invalid @enderror" name="selected_course[]">
                                                @foreach($courses as $course)
                                                    <option value="{{$course->id}}">{{$course->title}}</option>
                                                @endforeach 
                                            </select>
                                            <span class="invalid-feedback">@error('selected_course'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group form-error">
                                            <label for="price">Set Price <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="text" placeholder="Enter Price" name="price"
                                                class="form-control @error('price') is-invalid @enderror"
                                                value="{{ old('price')}}" id="price">
                                            <span class="invalid-feedback">@error('price'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="file-upload">Thumbnail <sup class="text-danger">*</sup></label>
                                            <input type="file" name="thumbnail" id="file-upload"
                                                class="form-control  @error('thumbnail') is-invalid @enderror">
                                            <span class="invalid-feedback">@error('thumbnail'){{ $message }}
                                                @enderror</span>
                                        </div> 
                                    </div>
                                    <div class="col-md-2">
                                        {{-- img preview @S --}}
                                        <div class="file-prev">
                                            <div id="file-previews"></div>
                                            <button type="button" class="btn" id="close-button"><i
                                                    class="fas fa-close"></i></button>
                                        </div>
                                        {{-- img preview @E --}}
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="file-upload-2">Banner <sup class="text-danger">*</sup></label>
                                            <input type="file" name="banner" id="file-upload-2"
                                                class="form-control  @error('banner') is-invalid @enderror">
                                            <span class="invalid-feedback">@error('banner'){{ $message }}
                                                @enderror</span>
                                        </div> 
                                    </div> 
                                    <div class="col-md-2">
                                        {{-- img preview @S --}}
                                        <div class="file-prev">
                                            <div id="file-previews-2"></div>
                                            <button type="button" class="btn" id="close-button-2"><i
                                                    class="fas fa-close"></i></button>
                                        </div>
                                        {{-- img preview @E --}}
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="short_description">Short Description <sup
                                                    class="text-danger">*</sup></label>
                                            <textarea name="short_description" id="short_description"
                                                class="form-control @error('short_description') is-invalid @enderror"
                                                placeholder="Enter Short Description">{{ old('short_description')}}</textarea>
                                            <span class="invalid-feedback">@error('short_description'){{ $message }}
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
<script src="{{asset('assets/js/file-upload.js')}}" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"
    type="text/javascript"></script>
@endsection

{{-- page script @E --}}