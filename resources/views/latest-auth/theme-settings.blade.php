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
                    <div class="theme-settings-box">
                        <div class="row">
                            <div class="col-lg-12 col-12 col-xl-8">
                                <div class="logo-box-view">
                                    <h6>Logo</h6>
                                    <p>The logo visible within your Learn Cosy App.</p>
                                    <div class="view">
                                        <img src="{{asset('latest/assets/images/logo-view.svg')}}" alt="a"
                                            class="img-fluid">
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
                                            <p>Send messages as soon as enter is pressed when this option is off, a new
                                                line is added on enter.</p>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked" checked>
                                        </div>
                                    </div>
                                </div>
                                <div class="feat-box">
                                    <div class="media">
                                        <img src="{{asset('latest/assets/images/icons/feat-02.svg')}}" alt="a"
                                            class="img-fluid">
                                        <div class="media-body">
                                            <h5>Menu Background Color</h5>
                                            <p>This is the color of your menu bar. Your logo should look good on this.
                                            </p>
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
                                    <input type="text" class="form-control">

                                    <h6>Meta Description</h6>
                                    <textarea class="form-control" placeholder="Type your description"></textarea>
                                </div>
                                <div class="favicon-box">
                                    <h6>Favicon</h6>
                                    <p>Your favicon will be shown in browsers and in search results.</p>

                                    <input type="file" class="d-none" id="favicon1">
                                    <label for="favicon1" class="file-upload-area">
                                        <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}" alt="a"
                                            class="img-fluid">
                                        <p><span>Click to upload</span> or drag and drop <br> SVG, PNG, JPG or GIF (max.
                                            300x300px)</p>
                                    </label>
                                    <div id="uploadedFileContainer1" class="uploaded-file-container"></div>

                                </div>
                                <div class="favicon-box">
                                    <h6>Apple Icon</h6>
                                    <p>Also known as Apple touch icon. This is the icon that is displayed to navigate to
                                        your Huddie when a user has saved your Huddies as a favourite in their Apple
                                        device.</p>

                                        <input type="file" class="d-none" id="favicon2">
                                        <label for="favicon2" class="file-upload-area">
                                            <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}" alt="a"
                                                class="img-fluid">
                                            <p><span>Click to upload</span> or drag and drop <br> SVG, PNG, JPG or GIF (max.
                                                300x300px)</p>
                                        </label>
                                        <div id="uploadedFileContainer2" class="uploaded-file-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- pricing plan page end -->
@endsection

@section('script')
<script>
  function handleFileUpload(inputElement, containerElement) {
  inputElement.addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function() {
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
      closeIcon.addEventListener("click", function() {
        uploadedFileContainer.removeChild(uploadedFile);
        inputElement.value = null; // Reset file input value
      });

      uploadedFile.appendChild(closeIcon);
      uploadedFileContainer.appendChild(uploadedFile);
    };

    reader.readAsDataURL(file);
  });
}

const faviconInput1 = document.getElementById("favicon1");
const uploadedFileContainer1 = document.getElementById("uploadedFileContainer1");
handleFileUpload(faviconInput1, uploadedFileContainer1);

const faviconInput2 = document.getElementById("favicon2");
const uploadedFileContainer2 = document.getElementById("uploadedFileContainer2");
handleFileUpload(faviconInput2, uploadedFileContainer2);


</script>
@endsection