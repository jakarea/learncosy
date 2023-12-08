@extends('layouts.latest.instructor')
@section('title') Student Add Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/user.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<!-- === Student add page @S === -->
<main class="profile-create-page">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-6">
                <div class="user-header">
                    <h2>Add new Student</h2>
                </div>
            </div>
            <div class="col-6">
                <div class="user-header-bttn">
                    <a href="{{url('instructor/students')}}"><img src="{{asset('latest/assets/images/icons/user.svg')}}"
                            alt="user" class="img-fluid"> All Student </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="user-add-form-wrap">
                        <form action="{{route('student.add', config('app.subdomain'))}}" method="POST" class="profile-form create-form-box" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group form-error">
                                    <label for="name">Name <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="text" placeholder="Enter Name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" id="name">
                                    <span class="invalid-feedback">@error('name'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group form-error">
                                    <label for="phone">Phone <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="text" placeholder="Enter Phone Number" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone') }}" id="phone">

                                    <span class="invalid-feedback">@error('phone'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group form-error">
                                    <label for="email">Email <sup class="text-danger">*</sup>
                                    </label>

                                    <input type="email" placeholder="Enter email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" id="email">

                                    <span class="invalid-feedback">@error('email'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="custom-hr">
                                    <hr>
                                    <h5>Other Information </h5>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group form-error">
                                    <label for="company_name">Company name </label>

                                    <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}"
                                        class="form-control @error('company_name') is-invalid @enderror"
                                        placeholder="Company Name">

                                    <span class="invalid-feedback">@error('company_name'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group form-error">
                                    <label for="website">Website </label>

                                    <input type="url" name="website" id="website" value="{{ old('website') }}"
                                        class="form-control @error('website') is-invalid @enderror"
                                        placeholder="Enter Web address">

                                    <span class="invalid-feedback">@error('website'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="features" class="mb-1">Social Media </label>

                                    <input type="url" placeholder="Enter Social Link" name="social_links[]"
                                        class="form-control w-100 @error('social_links') is-invalid @enderror"
                                        id="features" multiple value="">

                                    <div class="url-extra-field">
                                    </div>

                                    <span class="invalid-feedback">@error('social_links'){{ $message }}
                                        @enderror</span>
                                    <a href="javascript:void(0)" id="url_increment"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="description" class="mb-2">About </label>

                                    <textarea name="description" id="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Type here..">{{ old('description') }}</textarea>

                                    <span class="invalid-feedback">@error('description'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group mb-0">
                                    <label for="avatar">Avatar</label>
                                </div>
                                <div id="image-container" class="drop-container">
                                    <label for="avatar" class="upload-box">
                                        <span>
                                            <img src="{{asset('latest/assets/images/icons/camera-plus.svg')}}"
                                                alt="Upload" class="img-fluid">
                                            <p>Upload photo</p>
                                        </span>
                                    </label>
                                    <input type="file" name="avatar" accept="image/*" id="avatar" class="d-none">
                                    <span class="invalid-feedback">@error('avatar'){{ $message }}@enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group mb-2">
                                    <label for="avatar">Uploaded Image</label>
                                </div>
                                <div id="imageContainer" class="drop-container">
                                    <span id="closeIcon" onclick="removeImage()" style="display: none;">&#10006;</span>
                                    <img src="" alt="" class="img-fluid d-block" id="uploadedImage">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recivingMessage">Receiving Messages: </label>
                                    <div class="row mt-2">
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="recivingMessage"
                                                    id="flexRadioDefault1" value="1" checked>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Enable
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="recivingMessage"
                                                    id="flexRadioDefault2" value="0">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Disable
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="invalid-feedback">@error('recivingMessage'){{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="form-group form-error">
                                    <label for="password">Password </label>
                                    <input type="password" name="password" placeholder="*********"
                                        class="form-control @error('password') is-invalid @enderror" id="password">
                                    <span class="invalid-feedback">@error('password'){{ $message }} @enderror</span>
                                    <div class="pass-icon">
                                        <i class="fa-regular fa-eye" onclick="changeType()" id="eye-click"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-submit-bttns">
                                    <button type="button" onclick="history.go(-1)" class="btn btn-cancel">Cancel</button>
                                    <button type="submit" class="btn btn-submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

{{-- form save js --}}
<script src="{{ asset('latest/assets/js/form-change.js') }}"></script>
<script src="{{ asset('latest/assets/js/password-toggle.js') }}"></script>

{{-- drag & drop image upload js --}}
<script>
    function handleFileSelect(evt) {
        evt.stopPropagation();
        evt.preventDefault();
        const files = evt.dataTransfer ? evt.dataTransfer.files : evt.target.files;

        if (files.length > 0) {
        const file = files[0];

        if (!file.type.match('image.*')) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {
            const imageContainer = document.getElementById('imageContainer');
            imageContainer.innerHTML = '';

            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('img-fluid', 'd-block');
            img.id = 'uploadedImage';

            imageContainer.appendChild(img);

            const closeIcon = document.createElement('span');
            closeIcon.innerHTML = '&#10006;';
            closeIcon.id = 'closeIcon';
            closeIcon.onclick = removeImage;

            imageContainer.appendChild(closeIcon);

            // Show the close icon
            closeIcon.style.display = 'inline';
        };

        reader.readAsDataURL(file);
        }
        }

        document.getElementById('avatar').addEventListener('change', handleFileSelect);

        function removeImage() {
        const imageContainer = document.getElementById('imageContainer');
        imageContainer.innerHTML = '';
        document.getElementById('avatar').value = '';

        const closeIcon = document.getElementById('closeIcon');
        closeIcon.style.display = 'none'; // Hide the close icon
        }

        const dropContainers = document.querySelectorAll('.drop-container');
        dropContainers.forEach(function (dropContainer) {
        dropContainer.addEventListener('dragover', function (e) {
        e.preventDefault();
        e.stopPropagation();
        });

        dropContainer.addEventListener('drop', handleFileSelect);
        });

</script>
<script>
    // JavaScript
    const urlBttn = document.querySelector('#url_increment');
    let extraFields = document.querySelector('.url-extra-field');

    const createField = () => {
    let div = document.createElement("div");
    let node = document.createElement("input");
    node.setAttribute("class", "form-control w-100 @error('social_links') is-invalid @enderror");
    node.setAttribute("multiple", "");
    node.setAttribute("type", "url");
    node.setAttribute("placeholder", "Enter Social Link");
    node.setAttribute("name", "social_links[]");
    let link = document.createElement("a");
    link.innerHTML = "<i class='fas fa-minus'></i>";
    link.addEventListener("click", () => removeField(div));

    div.appendChild(node);
    div.appendChild(link);
    extraFields.appendChild(div);
    }

    const removeField = (field) => {
    // Remove the input field from the form
    field.remove();
    }

    urlBttn.addEventListener('click', createField, true);

</script>
@endsection

{{-- page script @E --}}
