@extends('layouts.latest.auth')

@section('title')
Theme Settings
@endsection

@section('style')
<style>
    .custom-margin-top {
        padding-top: 6rem !important;
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
                    <a href="#">Back</a>
                    <a href="#">Do it later</a>
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

                    <form action="{{ route('module.setting.update') }}" method="POST" class="create-form-box mt-3"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="theme-settings-box">
                            <div class="row">
                                <div class="col-lg-12 col-12 col-xl-8">
                                    <div class="logo-box-view">
                                        <h6>Logo</h6>
                                        <p>The logo visible within your Learn Cosy App.</p>
 
                                            <label for="favicon3" class="file-upload-area p-0" id="file-upload-area3">
                                                @if(isset($module_settings->logo))
                                                <img src="{{ asset('assets/images/setting/'.$module_settings->logo) }}"
                                                    alt="">
                                                @else
                                                <img src="{{asset('latest/assets/images/logo-view.svg')}}" alt="a"
                                                    class="img-fluid">
                                                @endif
                                            </label>
                                            <div id="uploadedFileContainer3" class="uploaded-file-container"></div>

                                        <div class="view"> 
                                            <input type="file" name="logo" id="favicon3"
                                                class="form-control d-none @error('logo') is-invalid @enderror" onchange="handleFileUpload(this, 'uploadedFileContainer3', 'file-upload-area3')">
                                            <span class="invalid-feedback">@error('logo'){{ $message }} @enderror</span>
                                        </div>
                                        <h6>App Logo</h6>
                                        <p>The logo visible within your Learn Cosy App.</p>
                                        <div class="small-view">
                                            <img src="{{asset('latest/assets/images/small-logo.png')}}" alt="a"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="feat-box">
                                        <div class="media">
                                            <img src="{{asset('latest/assets/images/icons/feat-01.svg')}}" alt="a"
                                                class="img-fluid">
                                            <div class="media-body">
                                                <h5>Send Messages on Enter</h5>
                                                <p>Send messages as soon as enter is pressed when this option is off, a
                                                    new
                                                    line is added on enter.</p>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked" name="send_message_by_enter" value="1"
                                                    {{ old('send_message_by_enter',
                                                    $module_settings->value->send_message_by_enter ?? '') == 1 ?
                                                'checked' : '' }}>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="feat-box">
                                        <div class="media">
                                            <img src="{{asset('latest/assets/images/icons/feat-02.svg')}}" alt="a"
                                                class="img-fluid">
                                            <div class="media-body">
                                                <h5>Menu Background Color</h5>
                                                <p>This is the color of your menu bar. Your logo should look good on
                                                    this.
                                                </p>
                                                <input type="color" class="form-control" name="primary_color"
                                                    id="primary_color"
                                                    value="{{ old('primary_color', $module_settings->value->primary_color ?? '')}}"
                                                    class="form-control @error('primary_color') is-invalid @enderror">

                                                <span class="invalid-feedback">@error('primary_color'){{ $message }}
                                                    @enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="feat-box">
                                        <div class="media">
                                            <img src="{{asset('latest/assets/images/icons/feat-03.svg')}}" alt="a"
                                                class="img-fluid">
                                            <div class="media-body">
                                                <h5>Accent Color</h5>
                                                <p>The accent color is used to accentuate visual elements.</p>
                                                <input type="color" class="form-control" name="secondary_color"
                                                    id="secondary_color"
                                                    value="{{ old('secondary_color', $module_settings->value->secondary_color ?? '')}}"
                                                    class="form-control @error('secondary_color') is-invalid @enderror">

                                                <span class="invalid-feedback">@error('secondary_color'){{ $message }}
                                                    @enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="save-bttns">
                                        <button type="button" class="btn btn-cancel">Cancel</button>
                                        <button type="submit" class="btn btn-submit">Save</button>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12 col-xl-4">
                                    <div class="meta-box">
                                        <h5>Meta</h5>
                                        <p>Metadata is used to improve your position in search engines.</p>

                                        <h6>Meta Title</h6>
                                        <input type="text" class="form-control" name="meta_title" id="meta_title"
                                            value="{{ old('meta_title', $module_settings->value->meta_title ?? '')}}"
                                            class="form-control @error('meta_title') is-invalid @enderror">
                                        <span class="invalid-feedback">@error('meta_title'){{ $message }}
                                            @enderror</span>

                                        <h6>Meta Description</h6>
                                        <textarea name="meta_desc" id="meta_desc" cols="5" rows="3"
                                            class="form-control @error('meta_desc') is-invalid @enderror">{{ old('meta_desc', $module_settings->value->meta_desc ?? '')}}</textarea>
                                        <span class="invalid-feedback">@error('meta_desc'){{ $message }}
                                            @enderror</span>
                                    </div>
                                    <div class="favicon-box">
                                        <h6>Favicon</h6>
                                        <p>Your favicon will be shown in browsers and in search results.</p>

                                         
                                        <label for="favicon1" class="file-upload-area" id="file-upload-area1">
                                            <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}" alt="a"
                                                class="img-fluid">
                                            <p><span>Click to upload</span> or drag and drop <br> SVG, PNG, JPG, or GIF
                                                (max. 300x300px)</p>
                                        </label>
                                        <div id="uploadedFileContainer1" class="uploaded-file-container"></div>

                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <input type="file" name="favicon" id="favicon1"
                                                    class="form-control d-none @error('favicon') is-invalid @enderror"
                                                    onchange="handleFileUpload(this, 'uploadedFileContainer1', 'file-upload-area1')">
                                                <span class="invalid-feedback">@error('favicon'){{ $message }}
                                                    @enderror</span>
                                            </div>
                                        </div>
                                        @if(isset($module_settings->favicon))
                                        <div class="col-md-12">
                                            <div class="file-prev">
                                                <div id="file-previews">
                                                    <img src="{{ asset('assets/images/setting/'.$module_settings->favicon) }}"
                                                        alt="" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                    <div class="favicon-box">
                                        <h6>Apple Icon</h6>
                                        <p>Also known as Apple touch icon. This is the icon that is displayed to
                                            navigate to
                                            your Huddie when a user has saved your Huddies as a favourite in their Apple
                                            device.</p>


                                        <label for="favicon2" class="file-upload-area" id="file-upload-area2">
                                            <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}" alt="a"
                                                class="img-fluid">
                                            <p><span>Click to upload</span> or drag and drop <br> SVG, PNG, JPG, or GIF
                                                (max. 300x300px)</p>
                                        </label>
                                        <div id="uploadedFileContainer2" class="uploaded-file-container"></div>


                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <input type="file" name="apple_icon" id="favicon2"
                                                    class="form-control d-none  @error('apple_icon') is-invalid @enderror"
                                                    onchange="handleFileUpload(this, 'uploadedFileContainer2', 'file-upload-area2')">
                                                <span class="invalid-feedback">@error('apple_icon'){{ $message }}
                                                    @enderror</span>
                                            </div>
                                        </div>
                                        @if(isset($module_settings->apple_icon))
                                        <div class="col-md-12">
                                            <div class="file-prev">
                                                <div id="file-previews">
                                                    <img src="{{ asset('assets/images/setting/'.$module_settings->apple_icon) }}"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                        @endif
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
@endsection