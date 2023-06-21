@extends('layouts/instructor')
@section('title') Theme Settings Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<!-- === Theme Settings page @S === -->
<main class="product-research-form">
    <div class="product-research-create-wrap">
        <div class="row">
            <div class="col-lg-12">
                <div class="create-form-head">
                    <h6>Update Theme Settings</h6>
                    <a href="{{url('/')}}">
                        <i class="fa-solid fa-list"></i> Dashboard </a>
                </div>
                <div class="create-form-wrap">
                   @include('partials.session-message')
                    <!-- Theme Settings form @S -->
                    <form action="{{ route('module.setting.update') }}" method="POST" class="create-form-box" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">  
                                    <div class="col-md-12">
                                        <div class="custom-hr">
                                            <h5>Theme Hero Settings </h5>
                                            <hr>
                                        </div>
                                        <div class="form-group form-error">
                                            <label for="banner_title">Banner title <sup class="text-danger">*</sup>
                                            </label>
                                            <input type="text" placeholder="Enter Banner title" name="banner_title"
                                                class="form-control @error('banner_title') is-invalid @enderror"
                                                value="{{ old('banner_title', $module_settings->value->banner_title ?? '')}}" id="banner_title">
                                            <span class="invalid-feedback">@error('banner_title'){{ $message }}
                                                @enderror</span>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group form-error">
                                                <label for="button_text">Button text <sup class="text-danger">*</sup>
                                                </label>
                                                <input type="text" placeholder="Button text" name="button_text"
                                                    class="form-control @error('button_text') is-invalid @enderror"
                                                    value="{{ old('button_text', $module_settings->value->button_text ?? '')}}" id="button_text">
                                                <span class="invalid-feedback">@error('button_text'){{ $message }}
                                                    @enderror</span>
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="banner_text">Banner text  </label>
                                            <textarea name="banner_text" id="banner_text"
                                                class="form-control @error('banner_text') is-invalid @enderror"
                                                placeholder="Enter Banner text">{{ old('banner_text', $module_settings->value->banner_text ?? '')}}</textarea>
                                            <span class="invalid-feedback">@error('banner_text'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="file-upload">Logo <sup class="text-danger">*</sup></label>
                                            <input type="file" name="logo" id="file-upload"
                                                class="form-control  @error('logo') is-invalid @enderror">
                                            <span class="invalid-feedback">@error('logo'){{ $message }}
                                                @enderror</span>
                                        </div> 
                                    </div>
                                    <div class="col-md-2">
                                        {{-- img preview @S --}}
                                        <div class="file-prev">
                                            <div id="file-previews">
                                                @if(isset($module_settings->logo))
                                                <img src="{{ asset('assets/images/setting/'.$module_settings->logo) }}" alt="">
                                                @endif
                                            </div>
                                            <button type="button" class="btn" id="close-button"><i
                                                    class="fas fa-close"></i></button>
                                        </div>
                                        {{-- img preview @E --}}
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="file-upload-2">Image </label>
                                            <input type="file" name="image" id="file-upload-2" 
                                                class="form-control  @error('image') is-invalid @enderror">
                                            <span class="invalid-feedback">@error('image'){{ $message }}
                                                @enderror</span>
                                        </div> 
                                    </div>
                                    <div class="col-md-2">
                                        {{-- img preview @S --}}
                                        <div class="file-prev">
                                            <div id="file-previews-2">
                                                @if(isset($module_settings->image))
                                                <img src="{{ asset('assets/images/setting/'.$module_settings->image) }}" alt="">
                                                @endif
                                            </div>
                                            <button type="button" class="btn" id="close-button-2"><i
                                                    class="fas fa-close"></i></button>
                                        </div>
                                        {{-- img preview @E --}}
                                    </div> 
                                    <div class="col-12">
                                        <div class="custom-hr">
                                            <hr>
                                            <h5>Theme Colors Settings</h5>
                                        </div>
                                    </div>  
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="primary_color">Primary Color</label>

                                            <input type="color" class="form-control"  name="primary_color" id="primary_color" value="{{ old('primary_color', $module_settings->value->primary_color ?? '')}}"
                                            class="form-control @error('primary_color') is-invalid @enderror">
                                         
                                            <span class="invalid-feedback">@error('primary_color'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div> 
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="secondary_color">Secondary Color</label>

                                            <input type="color" class="form-control"  name="secondary_color" id="secondary_color" value="{{ old('secondary_color', $module_settings->value->secondary_color ?? '')}}"
                                            class="form-control @error('secondary_color') is-invalid @enderror">
                                         
                                            <span class="invalid-feedback">@error('secondary_color'){{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div> 

                                    <div class="col-12">
                                        <div class="custom-hr">
                                            <hr>
                                            <h5>Theme Footer Settings </h5>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="footer_promote_text">Footer Promote Text</label>
                                            <input type="text" class="form-control"  name="footer_promote_text" id="footer_promote_text" placeholder="Enter Text here" value="{{ old('footer_promote_text', $module_settings->value->footer_promote_text ?? '')}}" class="form-control @error('footer_promote_text') is-invalid @enderror">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="footer_promote_btn_text">Footer Promote Button Text</label>
                                            <input type="text" class="form-control"  name="footer_promote_btn_text" id="footer_promote_btn_text" placeholder="Enter Text here" value="{{ old('footer_promote_btn_text', $module_settings->value->footer_promote_btn_text ?? '')}}" class="form-control @error('footer_promote_btn_text') is-invalid @enderror">
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
                    <!-- Theme Settings form @E -->
                </div>
            </div>
        </div>
    </div>
</main>
<!-- === Theme Settings page @E === -->
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script') 
<script src="{{asset('assets/js/file-upload.js')}}" type="text/javascript"></script>
@endsection

{{-- page script @E --}}