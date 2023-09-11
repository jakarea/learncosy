@extends('layouts.latest.auth')

@section('title')
Theme Settings
@endsection

@section('style')

<link href="{{ asset('latest/assets/admin-css/admin-dark.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/auth.css?v='.time() ) }}" rel="stylesheet" type="text/css" />

<style>
    .custom-margin-top {
        padding-top: 6rem !important;
    }

    .feat-box .media input {
        width: 100% !important;
    }
</style>
@endsection

@section('content')
@if ( Auth::check() )
@php
$module_settings = App\Models\InstructorModuleSetting::where('instructor_id', auth()->user()->id)->first();
if ( $module_settings ) {
$module_settings->value = json_decode($module_settings->value);
}
@endphp
@endif
<!-- pricing plan page start -->
<section class="auth-part-secs custom-margin-top">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="back-bttn w-100 mt-0">
                    <a href="{{ url('instructor/profile/step-4/complete') }}">Back</a>
                    @if ( $module_settings )
                    <a href="/instructor/profile/step-6/complete">Final Step</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                {{-- verify step start --}}
                <div class="verify-step-wrap">
                    <div class="step-item active">
                        <h6><i class="fas fa-check"></i></h6>
                        <p>Step 1</p>
                    </div>
                    <div class="step-item active">
                        <h6><i class="fas fa-check"></i></h6>
                        <p>Step 2</p>
                    </div>
                    <div class="step-item active">
                        <h6><i class="fas fa-check"></i></h6>
                        <p>Step 3</p>
                    </div>
                    <div class="step-item active">
                        <h6><i class="fas fa-check"></i></h6>
                        <p>Step 4</p>
                    </div>
                    <div class="step-item active">
                        <h6>5</h6>
                        <p>Step 5</p>
                    </div>
                    <div class="step-item">
                        <h6>6</h6>
                        <p>Step 6</p>
                    </div>
                </div>
                {{-- verify step end --}}
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="theme-settings-wrap">
                    <h4>Update theme Settings</h4>
                    <form action="{{ route('module.setting.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="theme-settings-box theme-dns-settings-box" style="padding: 2rem!important; margtin-top: 2rem!important;">
                            <div class="row">
                                <div class="col-lg-12 col-12 col-xl-8">
                                    <div class="logo-box-view">
                                        <h6>Logo</h6>
                                        <p>The logo visible within your Learn Cosy App.</p>

                                        <label for="imageInput" class="file-upload-area pb-2" id="file-upload-area"> 
                                            
                                            @if(isset($module_settings->logo))
                                            <img src="{{ asset('assets/images/setting/'.$module_settings->logo) }}"
                                                alt="logo" class="img-fluid rounded mt-2">
                                                @else 
                                                <img src="{{asset('latest/assets/images/logo-view.svg')}}"
                                                alt="a" class="img-fluid">
                                            @endif
                                            <img src="" alt="" class="img-fluid rounded mt-2" id="preview">

                                        </label>

                                        <input type="file" name="logo" id="imageInput"
                                            accept="image/*" onchange="previewImage()"
                                            class="form-control d-none  @error('logo') is-invalid @enderror">
                                        <span class="invalid-feedback">@error('logo'){{ $message }}
                                            @enderror</span>

                                        <h6 class="mt-3">App Logo</h6>
                                        <p>The logo visible within your Learn Cosy App.</p>

                                        <div class="media align-items-center flex-column flex-lg-row">
                                            <label for="app_logo"
                                                class="file-upload-area file-upload-2 mt-1">

                                                <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}"
                                                    alt="a" class="img-fluid me-0 light-ele">

                                                <img src="{{asset('latest/assets/images/icons/upload-5.svg')}}"
                                                    alt="a" class="img-fluid me-0 dark-ele">
                                                <p class="mt-2"><span>Click to upload</span> SVG, PNG, JPG, or GIF <br> (max. 300x300px)</p>
                                            </label>

                                            @if(isset($module_settings->app_logo))
                                            <img src="{{ asset('assets/images/setting/'.$module_settings->app_logo) }}"
                                                alt="logo" class="img-fluid rounded mt-2 preview-img">
                                            @endif

                                            <input type="file" name="app_logo" id="app_logo"
                                                accept="image/*" onchange="previewImage5()"
                                                class="form-control d-none  ">
                                            <span class="invalid-feedback"></span> 
                                        </div>

                                        <img src="" id="preview5" alt="" class="img-fluid rounded mt-2">

                                    </div>
                                    <div class="feat-box">
                                        <div class="media">
                                            <img src="{{asset('latest/assets/images/icons/color.svg')}}"
                                                alt="Color" class="img-fluid">
                                            <div class="media-body">
                                                <h5>Menu Background Color</h5>
                                                <p>This is the color of your menu bar. Your logo
                                                    should look good on this.</p>
                                            </div>

                                            <div class="color-position">
                                                <input type="color" class="form-control p-0"
                                                name="primary_color" id="primary_color"
                                                value="{{ old('primary_color', $module_settings->value->primary_color ?? '')}}" style="width: 30px!important;">

                                            <label for="primary_color">
                                                <img src="{{asset('latest/assets/images/icons/pen-ic.svg')}}"
                                                    alt="Color" class="img-fluid me-0">
                                            </label>
                                            </div> 
                                        </div>
                                        <div class="media">
                                            <img src="{{asset('latest/assets/images/icons/color-2.svg')}}"
                                                alt="Color" class="img-fluid">
                                            <div class="media-body">
                                                <h5>Accent Color</h5>
                                                <p>The accent color is used to accentuate visual
                                                    elements.</p>
                                            </div>
                                            <div class="color-position">
                                                <input type="color" class="form-control"
                                                name="secondary_color" id="secondary_color"
                                                value="{{ old('secondary_color', $module_settings->value->secondary_color ?? '')}}" style="width: 30px!important;">
                                                <label for="secondary_color">
                                                <img src="{{asset('latest/assets/images/icons/pen-ic.svg')}}"
                                                    alt="Color" class="img-fluid me-0">
                                            </label>
                                            </div> 
                                        </div>
                                    </div>
                                    <div
                                        class="certificate-style-box login-page-theme-box border-0">
                                        <h6>Select Login Page Theme</h6>
                                        <input type="radio" class="d-none" id="default"
                                            name="lp_layout" value="default">
                                        <input type="radio" class="d-none" id="fullwidth"
                                            name="lp_layout" value="fullwidth">
                                        <input type="radio" class="d-none" id="leftsidebar"
                                            name="lp_layout" value="leftsidebar">
                                        <input type="radio" class="d-none" id="rightsidebar"
                                            name="lp_layout" value="rightsidebar">

                                        <label for="default">
                                            <div class="media">
                                                <img src="{{asset('latest/assets/images/login-01.png')}}"
                                                    alt="Color" class="img-fluid">
                                                <div class="media-body">
                                                    <div class="d-flex">
                                                        <h6>Raouls Choice</h6>
                                                        @if (old('lp_layout',
                                                        $module_settings->value->lp_layout ?? '') ==
                                                        'default')
                                                        <span>Active Theme</span>
                                                        @endif

                                                    </div>
                                                    <p>Raouls Choice is een simple en elegant thema
                                                        zonder extra opties, mokkeljk te gebruken en
                                                        geoptimaliseerd voor conversie.</p>
                                                </div>
                                            </div>
                                        </label>

                                        <label for="fullwidth">
                                            <div class="media">
                                                <img src="{{asset('latest/assets/images/login-02.png')}}"
                                                    alt="Color" class="img-fluid">
                                                <div class="media-body">
                                                    <div class="d-flex">
                                                        <h6>Volledige Breedte Afbeelding</h6>
                                                        @if (old('lp_layout',
                                                        $module_settings->value->lp_layout ?? '') ==
                                                        'fullwidth')
                                                        <span>Active Theme</span>
                                                        @endif
                                                    </div>
                                                    <p>In dit thema kon je een valledige breedte
                                                        afbeeliding uplioden en heb je toegang tot
                                                        nog
                                                        aartal extra optes.</p>
                                                </div>
                                            </div>
                                        </label>
                                        <label for="leftsidebar">
                                            <div class="media">
                                                <img src="{{asset('latest/assets/images/login-03.png')}}"
                                                    alt="Color" class="img-fluid">
                                                <div class="media-body">
                                                    <div class="d-flex">
                                                        <h6>Zijbalk &amp; Achtergrond</h6>
                                                        @if (old('lp_layout',
                                                        $module_settings->value->lp_layout ?? '') ==
                                                        'leftsidebar')
                                                        <span>Active Theme</span>
                                                        @endif
                                                    </div>
                                                    <p>Raouls Choice is een simple en elegant thema
                                                        zonder extra opties, mokkeljk te gebruken en
                                                        geoptimaliseerd voor conversie.</p>
                                                </div>
                                            </div>
                                        </label>
                                        <label for="rightsidebar">
                                            <div class="media">
                                                <img src="{{asset('latest/assets/images/login-04.png')}}"
                                                    alt="Color" class="img-fluid">
                                                <div class="media-body">
                                                    <div class="d-flex">
                                                        <h6>Zijbalk & Achtergrond</h6>
                                                        @if (old('lp_layout',
                                                        $module_settings->value->lp_layout ?? '') ==
                                                        'rightsidebar')
                                                        <span>Active Theme</span>
                                                        @endif
                                                    </div>
                                                    <p>Raouls Choice is een simple en elegant thema
                                                        zonder extra opties, mokkeljk te gebruken en
                                                        geoptimaliseerd voor conversie.</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <div
                                        class="certificate-style-box login-page-theme-box border-0">
                                        <div class="media mt-0">
                                            <label for="lp_bg_image"
                                                class="file-upload-area file-upload-2">

                                                <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}"
                                                    alt="a" class="img-fluid me-0 light-ele">

                                                <img src="{{asset('latest/assets/images/icons/upload-5.svg')}}"
                                                    alt="a" class="img-fluid me-0 dark-ele">
                                                    
                                                <p class="mt-2"><span>Click to upload</span> or drag
                                                    and drop</p>
                                            </label>

                                            <input type="file" name="lp_bg_image" id="lp_bg_image"
                                                accept="image/*" onchange="previewImage2()"
                                                class="form-control d-none  @error('lp_bg_image') is-invalid @enderror">
                                            
                                            <div class="media-body">
                                                <div class="d-flex">
                                                    <h6>Upload Login Page Background Image</h6>
                                                </div>
                                                <p>SVG, PNG, JPG or GIF (max. 1200x900px)</p>
                                            </div>

                                        </div>

                                        <img src="" id="preview2" alt=""
                                            class="img-fluid rounded mt-2">

                                        @if(isset($module_settings->lp_bg_image))
                                        <img src="{{ asset('assets/images/setting/'.$module_settings->lp_bg_image) }}"
                                            alt="" class="img-fluid rounded mt-2">

                                        @endif

                                        
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12 col-xl-4">
                                    <div class="meta-box">
                                        <h5>Meta</h5>
                                        <p>Metadata is used to improve your position in search
                                            engines.</p>

                                        <h6>Meta Title</h6>
                                        <input type="text" class="form-control" name="meta_title"
                                            id="meta_title"
                                            value="{{ old('meta_title', $module_settings->value->meta_title ?? '')}}"
                                            class="form-control @error('meta_title') is-invalid @enderror">
                                        <span class="invalid-feedback">@error('meta_title'){{
                                            $message }}
                                            @enderror</span>

                                        <h6>Meta Description</h6>
                                        <textarea placeholder="Enter your description"
                                            name="meta_desc"
                                            class="form-control @error('meta_desc') is-invalid @enderror">{{ old('meta_desc', $module_settings->value->meta_desc ?? '')}}</textarea>

                                        <span class="invalid-feedback">@error('meta_desc'){{
                                            $message }}
                                            @enderror</span>
                                    </div>
                                    <div class="favicon-box">
                                        <h6>Favicon</h6>
                                        <p>Your favicon will be shown in browsers and in search
                                            results.</p>

                                        <label for="favicon" class="file-upload-area">
                                            <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}"
                                                    alt="a" class="img-fluid me-0 light-ele">

                                                <img src="{{asset('latest/assets/images/icons/upload-3.svg')}}"
                                                    alt="a" class="img-fluid me-0 dark-ele">
                                            <p><span>Click to upload</span> z <br>
                                                SVG, PNG, JPG, or GIF
                                                (max. 300x300px)</p>
                                        </label>

                                        <input type="file" name="favicon" id="favicon"
                                            accept="image/*" onchange="previewImage3()"
                                            class="form-control d-none  @error('favicon') is-invalid @enderror">
                                        <span class="invalid-feedback">@error('favicon'){{ $message
                                            }}
                                            @enderror</span>

                                        <img src="" alt="" class="img-fluid rounded mt-2"
                                            id="preview3">

                                        @if(isset($module_settings->favicon))
                                        <img src="{{ asset('assets/images/setting/'.$module_settings->favicon) }}"
                                            alt="" class="img-fluid rounded mt-2"> @endif

                                    </div>
                                    <div class="favicon-box">
                                        <h6>Apple Icon</h6>
                                        <p>Also known as Apple touch icon. This is the icon that is
                                            displayed to
                                            navigate to
                                            your Huddie when a user has saved your Huddies as a
                                            favourite in their Apple
                                            device.</p>


                                        <label for="apple_icon" class="file-upload-area">
                                            <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}"
                                                    alt="a" class="img-fluid me-0 light-ele">

                                                <img src="{{asset('latest/assets/images/icons/upload-5.svg')}}"
                                                    alt="a" class="img-fluid me-0 dark-ele">
                                            <p><span>Click to upload</span> z <br>
                                                SVG, PNG, JPG, or GIF
                                                (max. 300x300px)</p>
                                        </label>

                                        <input type="file" name="apple_icon" id="apple_icon"
                                            accept="image/*" onchange="previewImage4()"
                                            class="form-control d-none  @error('apple_icon') is-invalid @enderror">
                                        <span class="invalid-feedback">@error('apple_icon'){{
                                            $message }}
                                            @enderror</span>

                                        <img src="" alt="" class="img-fluid rounded mt-2"
                                            id="preview4">

                                        @if(isset($module_settings->apple_icon))
                                        <img id="nweImg" src="{{ asset('assets/images/setting/'.$module_settings->apple_icon) }}"
                                            alt="" class="img-fluid rounded mt-2"> @endif

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="save-bttns pb-5">
                                        <button type="button" class="btn btn-cancel">Reset</button>
                                        <button type="submit" class="btn btn-submit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- pricing plan page end -->
@endsection

@section('script')
<script>
    function handleFileUpload(inputElement, containerId, labelId) {
  const containerElement = document.getElementById(containerId);
  const labelElement = document.getElementById(labelId);

  const file = inputElement.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = function () {
    const uploadedFileContainer = containerElement;

    // Remove previously uploaded file (if any)
    const existingUploadedFile = uploadedFileContainer.querySelector(".uploaded-file");
    if (existingUploadedFile) {
      uploadedFileContainer.removeChild(existingUploadedFile);
    }

    const uploadedFile = document.createElement("div");
    uploadedFile.classList.add("uploaded-file");

    const uploadedFileImg = document.createElement("img");
    uploadedFileImg.src = reader.result;
    uploadedFile.appendChild(uploadedFileImg);

    const closeIcon = document.createElement("span");
    closeIcon.innerHTML = "&times;";
    closeIcon.classList.add("uploaded-file-close");
    closeIcon.addEventListener("click", function () {
      uploadedFileContainer.removeChild(uploadedFile);
      inputElement.value = null; // Reset file input value
      labelElement.style.display = "block"; // Show the label again after removing the uploaded image
    });

    uploadedFile.appendChild(closeIcon);
    uploadedFileContainer.appendChild(uploadedFile);

    // Hide the label after an image is uploaded
    labelElement.style.display = "none";
  };

  reader.readAsDataURL(file);
}
</script>

<script>
    function previewImage() {
        var preview = document.getElementById('preview');
        var fileInput = document.getElementById('imageInput');
        var file = fileInput.files[0];
        
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    } 
    function previewImage2() {
        let preview2 = document.getElementById('preview2');
        let fileInput2 = document.getElementById('lp_bg_image');
        let file2 = fileInput2.files[0];
        
        if (file2) {
            let reader2 = new FileReader();
            reader2.onload = function(e) {
                preview2.src = e.target.result;
                preview2.style.display = 'block';
            };
            reader2.readAsDataURL(file2);
        } else {
            preview2.style.display = 'none';
        }
    } 
    function previewImage3() {
        let preview3 = document.getElementById('preview3');
        let fileInput3 = document.getElementById('favicon');
        let file3 = fileInput3.files[0];
        
        if (file3) {
            let reader3 = new FileReader();
            reader3.onload = function(e) {
                preview3.src = e.target.result;
                preview3.style.display = 'block';
            };
            reader3.readAsDataURL(file3);
        } else {
            preview3.style.display = 'none';
        }
    } 
    function previewImage4() {
        let preview4 = document.getElementById('preview4');
        let fileInput4 = document.getElementById('apple_icon');
        let file4 = fileInput4.files[0];
        
        if (file4) {
            let reader4 = new FileReader();
            reader4.onload = function(e) {
                preview4.src = e.target.result;
                preview4.style.display = 'block';
            };
            reader4.readAsDataURL(file4);
        } else {
            preview4.style.display = 'none';
        }
    }
    function previewImage5() {
        let preview5 = document.getElementById('preview5');
        let fileInput5 = document.getElementById('app_logo');
        let file5 = fileInput5.files[0];
        
        if (file5) {
            let reader5 = new FileReader();
            reader5.onload = function(e) {
                preview5.src = e.target.result;
                preview5.style.display = 'block';
            };
            reader5.readAsDataURL(file5);
        } else {
            preview5.style.display = 'none';
        }
    }
</script>

<script>
    let cards = [...document.querySelectorAll(".login-page-theme-box label .media")];
    cards.forEach(card => {
      card.addEventListener("click", function () {
        cards.forEach(c => c.classList.remove("active"));
        this.classList.add("active")
      })
    });
</script>

@endsection