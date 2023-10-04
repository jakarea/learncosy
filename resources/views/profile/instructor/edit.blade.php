@extends('layouts.latest.instructor')
@section('title') Account Management @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- student update page @S --}}
<main class="student-profile-update-page instructor-profile-update-page">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-12">
                <div class="own-profile-box account-settings-box">
                    <div class="header">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link tab-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">My Profile</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link tab-link" id="pills-experience-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-experience" type="button" role="tab"
                                    aria-controls="pills-experience" aria-selected="false">Experience</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link tab-link" id="pills-certificate-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-certificate" type="button" role="tab"
                                    aria-controls="pills-certificate" aria-selected="false">Certificate</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link tab-link" id="pills-password-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-password" type="button" role="tab"
                                    aria-controls="pills-password" aria-selected="false">Password</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane tab-con active-bg fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">
                            <form action="{{ route('instructor.profile.update',$user->id) }}" method="POST"
                                class="profile-form create-form-box" enctype="multipart/form-data">
                                @csrf
                                <div class="row custom-padding">
                                    <div class="col-xl-3 col-lg-4">
                                        <div class="profile-picture-box">

                                            <input type="file" name="avatar" id="imageInput" accept="image/*"
                                                onchange="previewImage()"
                                                class="form-control d-none  @error('avatar') is-invalid @enderror">

                                            <label for="imageInput" class="img-upload">
                                                <img src="{{asset('latest/assets/images/icons/camera-plus-w.svg')}}"
                                                    alt="a" class="img-fluid">
                                                <p>Update photo</p>
                                                <div class="ol">
                                                    @if ($user->avatar)
                                                    <img id="preview"
                                                        src="{{asset($user->avatar)}}"
                                                        alt="Avatar" class="img-fluid static-image">
                                                    @else
                                                    <span class="avatar-box">{!! strtoupper($user->name[0]) !!}</span>
                                                    @endif
                                                </div>
                                            </label>

                                            <h6>Allowed *.jpeg, *.jpg, *.png, *.gif <br>
                                                Max size of 3.1 MB</h6>

                                            <div class="form-check form-switch ps-0">
                                                <label class="form-check-label" for="recivingMessage">Receiving
                                                    Messages</label>

                                                <input class="form-check-input" type="checkbox" name="recivingMessage"
                                                    value="1" {{ old('recivingMessage', $user->recivingMessage) == 1 ?
                                                'checked' : '' }}>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-8">
                                        <div class="content-settings-form-wrap profile-text-box-2">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="name" name="name"
                                                            value="{{ $user->name }}" required>
                                                        <label for="name">Name</label>
                                                        <span class="invalid-feedback">@error('name'){{ $message }}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="email" name="email"
                                                            value="{{ $user->email }}" required>
                                                        <label for="email">Email</label>
                                                        <span class="invalid-feedback">@error('email'){{ $message }}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="phone" name="phone"
                                                            value="{{ $user->phone }}" required>
                                                        <label for="phone">Phone Number</label>
                                                        <span class="invalid-feedback">@error('phone'){{ $message }}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="social_links"
                                                            name="social_links[]" value="{{ $user->social_links }}"
                                                            required>
                                                        <label for="social_links">Instagram</label>
                                                        <span class="invalid-feedback">@error('social_links'){{ $message
                                                            }}
                                                            @enderror</span>
                                                    </div>

                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <input type="url" class="form-control" id="website"
                                                            name="website" value="{{ $user->short_bio }}" required>
                                                        <label for="website">Website</label>
                                                        <span class="invalid-feedback">@error('short_bio'){{ $message }}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <textarea name="description" id="description"
                                                            class="form-control @error('description') is-invalid @enderror"
                                                            required>{{ $user->description }}</textarea>

                                                        <label for="description">About</label>
                                                        <span class="invalid-feedback">@error('description'){{ $message
                                                            }}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-submit-bttns mt-5">
                                            <button type="reset" class="btn btn-cancel">Cancel</button>
                                            <button type="submit" class="btn btn-submit">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- profile edit form end --}}
                            </form>
                        </div>
                        <div class="tab-pane tab-con fade" id="pills-experience" role="tabpanel"
                            aria-labelledby="pills-experience-tab" tabindex="0">
                            <div class="row">

                                <div class="col-12">
                                    <div class="add-experience-form" id="experience-form">
                                        <form action="{{ route('instructor.profile.experience',$user->id) }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $editExp ? $editExp->id:''}}" />
                                            <div class="content-settings-form-wrap profile-text-box-2">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="profession"
                                                                value="{{ $editExp ? $editExp->profession: old('profession') }}"
                                                                placeholder="Add skill (e.g ui/ux design)"
                                                                name="profession">
                                                            <label for="profession">Profession</label>
                                                            <span class="invalid-feedback">@error('profession'){{
                                                                $message }}
                                                                @enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="company_name"
                                                                name="company_name"
                                                                value="{{ $editExp ? $editExp->company_name: old('company_name') }}"
                                                                placeholder="Add company (e.g learn cosy)">
                                                            <label for="company_name">Company Name</label>
                                                            <span class="invalid-feedback">@error('company_name'){{
                                                                $message }}
                                                                @enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="job_type"
                                                                value="{{ $editExp ? $editExp->job_type: old('job_type') }}"
                                                                name="job_type"
                                                                placeholder="Add job type (e.g full time/ part time)">
                                                            <label for="job_type">Job Type</label>
                                                            <span class="invalid-feedback">@error('job_type'){{ $message
                                                                }}
                                                                @enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="experience"
                                                                value="{{ $editExp ? $editExp->experience: old('experience') }}"
                                                                name="experience"
                                                                placeholder="Add service time (e.g 5 years)">
                                                            <label for="experience">Experience Time </label>
                                                            <span class="invalid-feedback">@error('experience'){{
                                                                $message }}
                                                                @enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <input type="date" class="form-control" id="join_date"
                                                                value="{{ $editExp ? $editExp->join_date: old('join_date') }}"
                                                                name="join_date"
                                                                placeholder="Add join date (e.g 02 jan 2020)">
                                                            <label for="join_date">Join Date</label>
                                                            <span class="invalid-feedback">@error('join_date'){{
                                                                $message }}
                                                                @enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <input type="date" class="form-control" id="retire_date"
                                                                value="{{ $editExp ? $editExp->retire_date: old('retire_date') }}"
                                                                name="retire_date"
                                                                placeholder="Add Retired date (e.g 02 jan 2022/ Present)">
                                                            <label for="retire_date">Retired Date</label>
                                                            <span class="invalid-feedback"
                                                                id="invalid_retire_date">@error('retire_date'){{
                                                                $message }}
                                                                @enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <textarea name="short_description" id="short_description"
                                                                placeholder="Add short description about this job..."
                                                                class="form-control @error('short_description') is-invalid @enderror">{{ $editExp ? $editExp->short_description: old('short_description') }}</textarea>
                                                            <label for="short_description">Short Description</label>
                                                            <span class="invalid-feedback">@error('description'){{
                                                                $message
                                                                }}
                                                                @enderror</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-submit-bttns mt-5">
                                                            <button type="reset" class="btn btn-cancel">Cancel</button>
                                                            <button type="submit" class="btn btn-submit">Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="user-expperience-box user-expperience-box-2">
                                        @foreach ($experiences as $experience)
                                        <div class="media brdr-bttm">
                                            <img src="{{ asset('latest/assets/images/experience-img.svg') }}"
                                                alt="experience-img" class="img-fluid">
                                            <div class="media-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h5>{{ $experience->profession }}</h5>
                                                    <div>
                                                        <a href="#"><img
                                                                src="{{ asset('latest/assets/images/icons/plus.svg') }}"
                                                                alt="img" class="img-fluid"></a>
                                                        <a
                                                            href="{{ url('instructor/profile/edit?id='.$experience->id )}}"><img
                                                                src=" {{ asset('latest/assets/images/icons/pen.svg')   }}"
                                                                alt="img" class="img-fluid"></a>
                                                    </div>
                                                </div>

                                                <h6>{{ $experience->company_name }} <i class="fas fa-circle"></i> {{
                                                    $experience->job_type }} <i class="fas fa-circle"></i> {{
                                                    $experience->experience }}</h6>
                                                <p>{{ $experience->short_description }}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-submit-bttns my-4 mx-3">
                                        <button type="reset" class="btn btn-cancel">Cancel</button>
                                        <button type="submit" class="btn btn-submit">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane tab-con fade" id="pills-certificate" role="tabpanel"
                            aria-labelledby="pills-certificate-tab" tabindex="0">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <div class="certificate-header-tab">
                                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="pills-add_cert-tab"
                                                    data-bs-toggle="pill" data-bs-target="#pills-add_cert" type="button"
                                                    role="tab" aria-controls="pills-add_cert" aria-selected="true"><i
                                                        class="fas fa-plus"></i> Add Certificate</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-custom_cert-tab"
                                                    data-bs-toggle="pill" data-bs-target="#pills-custom_cert"
                                                    type="button" role="tab" aria-controls="pills-custom_cert"
                                                    aria-selected="false"><i class="fas fa-plus"></i> Custom
                                                    Certificate</button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="cert-body-tab">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-add_cert" role="tabpanel"
                                                aria-labelledby="pills-add_cert-tab" tabindex="0">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="create-certificate-form">
                                                            <form action="">
                                                                <div class="row">
                                                                    <div class="col-lg-9">
                                                                        <div class="certificate-name">
                                                                            <h6>Course/ Certificate Name </h6>
                                                                            <input type="text"
                                                                                placeholder="Professional UI/UX Design Course"
                                                                                class="form-control">
                                                                            <div class="media">
                                                                                <img src="{{asset('latest/assets/images/icons/color.svg')}}"
                                                                                    alt="Color" class="img-fluid">
                                                                                <div class="media-body">
                                                                                    <h5>Certificate Color</h5>
                                                                                    <p>This is the color of your menu
                                                                                        bar. Your logo should look good
                                                                                        on this.</p>
                                                                                </div>
                                                                                <a href="#"><img
                                                                                        src="{{asset('latest/assets/images/icons/pen-3.svg')}}"
                                                                                        alt="Color"
                                                                                        class="img-fluid"></a>
                                                                            </div>
                                                                            <div class="media">
                                                                                <img src="{{asset('latest/assets/images/icons/color-2.svg')}}"
                                                                                    alt="Color" class="img-fluid">
                                                                                <div class="media-body">
                                                                                    <h5>Accent Color</h5>
                                                                                    <p>The accent color is used to
                                                                                        accentuate visual elements.</p>
                                                                                </div>
                                                                                <a href="#"><img
                                                                                        src="{{asset('latest/assets/images/icons/pen-3.svg')}}"
                                                                                        alt="Color"
                                                                                        class="img-fluid"></a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="certificate-style-box">
                                                                            <h6>Select Certificate Style</h6>

                                                                            <div class="media">
                                                                                {{-- full page preview --}}
                                                                                <div class="full-page-preview">
                                                                                    <a href="#" class="close-bttn">
                                                                                        <i class="fas fa-close"></i>
                                                                                    </a>
                                                                                    <img src="{{asset('latest/assets/images/big-c-01.svg')}}"
                                                                                        alt="Cert" class="img-fluid">
                                                                                </div>
                                                                                {{-- full page preview --}}

                                                                                <a href="#" class="cert-bttn">
                                                                                    <img src="{{asset('latest/assets/images/certificate-01.png')}}"
                                                                                        alt="Cert" class="img-fluid">
                                                                                </a>
                                                                                <div class="media-body">
                                                                                    <div class="d-flex">
                                                                                        <h6>Certificate Style 1</h6>
                                                                                        <span>Active Certificate</span>
                                                                                    </div>
                                                                                    <p>Raouls Choice is een simple en
                                                                                        elegant thema zonder extra
                                                                                        opties, mokkeljk te gebruken en
                                                                                        geoptimaliseerd voor conversie.
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="media">
                                                                               {{-- full page preview --}}
                                                                               <div class="full-page-preview">
                                                                                <a href="#" class="close-bttn">
                                                                                    <i class="fas fa-close"></i>
                                                                                </a>
                                                                                <img src="{{asset('latest/assets/images/big-c-02.svg')}}"
                                                                                    alt="Cert" class="img-fluid">
                                                                            </div>
                                                                            {{-- full page preview --}}

                                                                            <a href="#" class="cert-bttn">
                                                                                <img src="{{asset('latest/assets/images/certificate-02.png')}}"
                                                                                    alt="Cert" class="img-fluid">
                                                                            </a>
                                                                                <div class="media-body">
                                                                                    <div class="d-flex">
                                                                                        <h6>Certificate Style 2</h6>
                                                                                    </div>
                                                                                    <p>Raouls Choice is een simple en
                                                                                        elegant thema zonder extra
                                                                                        opties, mokkeljk te gebruken en
                                                                                        geoptimaliseerd voor conversie.
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="media">
                                                                                {{-- full page preview --}}
                                                                                <div class="full-page-preview">
                                                                                    <a href="#" class="close-bttn">
                                                                                        <i class="fas fa-close"></i>
                                                                                    </a>
                                                                                    <img src="{{asset('latest/assets/images/big-c-03.svg')}}"
                                                                                        alt="Cert" class="img-fluid">
                                                                                </div>
                                                                                {{-- full page preview --}}

                                                                                <a href="#" class="cert-bttn">
                                                                                    <img src="{{asset('latest/assets/images/certificate-03.png')}}"
                                                                                        alt="Cert" class="img-fluid">
                                                                                </a>
                                                                                <div class="media-body">
                                                                                    <div class="d-flex">
                                                                                        <h6>Certificate Style 3</h6>
                                                                                    </div>
                                                                                    <p>Raouls Choice is een simple en
                                                                                        elegant thema zonder extra
                                                                                        opties, mokkeljk te gebruken en
                                                                                        geoptimaliseerd voor conversie.
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="certificate-asset-upload">
                                                                            <h5>Logo </h5>
                                                                            <input type="file" name="favicon"
                                                                                id="favicon1"
                                                                                class="form-control d-none @error('favicon') is-invalid @enderror"
                                                                                onchange="handleFileUpload(this, 'uploadedFileContainer1', 'file-upload-area1')">

                                                                            <label for="favicon1"
                                                                                class="upload-media-box"
                                                                                id="file-upload-area1">
                                                                                <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}"
                                                                                    alt="Color"
                                                                                    class="img-fluid light-ele">
                                                                                <img src="{{asset('latest/assets/images/icons/upload-5.svg')}}"
                                                                                    alt="Color"
                                                                                    class="img-fluid dark-ele">
                                                                                <span>Click to upload</span> or drag and
                                                                                drop SVG, PNG or JPG (max. 300x300px)
                                                                            </label>

                                                                            <div id="uploadedFileContainer1"
                                                                                class="uploaded-file-container"></div>

                                                                        </div>
                                                                        <div class="certificate-asset-upload">
                                                                            <h5>Instructor Signature </h5>
                                                                            <input type="file" class="d-none" id="logo">
                                                                            <label for="logo" class="upload-media-box">
                                                                                <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}"
                                                                                    alt="Color"
                                                                                    class="img-fluid light-ele">
                                                                                <img src="{{asset('latest/assets/images/icons/upload-5.svg')}}"
                                                                                    alt="Color"
                                                                                    class="img-fluid dark-ele">
                                                                                <span>Click to upload</span> or drag and
                                                                                drop SVG, PNG or JPG (max. 300x300px)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="text-end mt-4">
                                                                            <a href="#" class="common-bttn">Save</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="user-expperience-box user-expperience-box-2">
                                                            <div class="title">
                                                                <h4>All Certificates</h4>
                                                            </div>
                                                            <div class="media brdr-bttm">
                                                                <img src="{{ asset('latest/assets/images/experience-img.svg') }}"
                                                                    alt="experience-img" class="img-fluid">
                                                                <div class="media-body">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <h5>UI/UX Design</h5>
                                                                        <div>
                                                                            <a href="#"><img
                                                                                    src="{{ asset('latest/assets/images/icons/plus.svg') }}"
                                                                                    alt="img" class="img-fluid"></a>
                                                                            <a href="#"><img
                                                                                    src="{{ asset('latest/assets/images/icons/pen.svg') }}"
                                                                                    alt="img" class="img-fluid"></a>
                                                                        </div>
                                                                    </div>

                                                                    <h6>Learn Cosy <i class="fas fa-circle"></i>
                                                                        Full-Time <i class="fas fa-circle"></i> Jul 2018
                                                                        - Present (5y 3m)</h6>
                                                                    <p>Created and executed website for 10 brands
                                                                        utilizing multiple
                                                                        features and content types to increase brand
                                                                        outreach, engagement,
                                                                        and leads.</p>
                                                                </div>
                                                            </div>
                                                            <div class="media brdr-bttm">
                                                                <img src="{{ asset('latest/assets/images/experience-img.svg') }}"
                                                                    alt="experience-img" class="img-fluid">
                                                                <div class="media-body">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <h5>UI/UX Design</h5>
                                                                        <div>
                                                                            <a href="#"><img
                                                                                    src="{{ asset('latest/assets/images/icons/plus.svg') }}"
                                                                                    alt="img" class="img-fluid"></a>
                                                                            <a href="#"><img
                                                                                    src="{{ asset('latest/assets/images/icons/pen.svg') }}"
                                                                                    alt="img" class="img-fluid"></a>
                                                                        </div>
                                                                    </div>
                                                                    <h6>Learn Cosy <i class="fas fa-circle"></i>
                                                                        Full-Time <i class="fas fa-circle"></i> Jul 2018
                                                                        - Present (5y 3m)</h6>
                                                                    <p>Created and executed website for 10 brands
                                                                        utilizing multiple
                                                                        features and content types to increase brand
                                                                        outreach, engagement,
                                                                        and leads.</p>
                                                                </div>
                                                            </div>
                                                            <div class="media">
                                                                <img src="{{ asset('latest/assets/images/experience-img.svg') }}"
                                                                    alt="experience-img" class="img-fluid">
                                                                <div class="media-body">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <h5>UI/UX Design</h5>
                                                                        <div>
                                                                            <a href="#"><img
                                                                                    src="{{ asset('latest/assets/images/icons/plus.svg') }}"
                                                                                    alt="img" class="img-fluid"></a>
                                                                            <a href="#"><img
                                                                                    src="{{ asset('latest/assets/images/icons/pen.svg') }}"
                                                                                    alt="img" class="img-fluid"></a>
                                                                        </div>
                                                                    </div>
                                                                    <h6>Learn Cosy <i class="fas fa-circle"></i>
                                                                        Full-Time <i class="fas fa-circle"></i> Jul 2018
                                                                        - Present (5y 3m)</h6>
                                                                    <p>Created and executed website for 10 brands
                                                                        utilizing multiple
                                                                        features and content types to increase brand
                                                                        outreach, engagement,
                                                                        and leads.</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-custom_cert" role="tabpanel"
                                                aria-labelledby="pills-custom_cert-tab" tabindex="0">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="create-certificate-form create-certificate-form-2">
                                                            <form action="">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="certificate-name border-0 pe-0">
                                                                            <h6>Student Name </h6>
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control">
                                                                                <label for="">First Name</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="certificate-name border-0 pe-0">
                                                                            <h6>&nbsp;</h6>
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control">
                                                                                <label for="">Last Name</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 my-3">
                                                                        <div class="certificate-name border-0 pe-0">
                                                                            <h6>Certificate/ Course Name</h6>
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control">
                                                                                <label for="">Professional UI/UX Design
                                                                                    Course</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="certificate-name border-0 pe-0">
                                                                            <h6>Course Complete Date </h6>
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control">
                                                                                <label for="">01/08/2023</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="certificate-name border-0 pe-0">
                                                                            <h6>Certificate Issue Date *</h6>
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control">
                                                                                <label for="">01/08/2023</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9 mt-3">
                                                                        <div class="certificate-name">
                                                                            <div class="media">
                                                                                <img src="{{asset('latest/assets/images/icons/color.svg')}}"
                                                                                    alt="Color" class="img-fluid">
                                                                                <div class="media-body">
                                                                                    <h5>Certificate Color</h5>
                                                                                    <p>This is the color of your menu
                                                                                        bar. Your logo should look good
                                                                                        on this.</p>
                                                                                </div>
                                                                                <a href="#"><img
                                                                                        src="{{asset('latest/assets/images/icons/pen-3.svg')}}"
                                                                                        alt="Color"
                                                                                        class="img-fluid"></a>
                                                                            </div>
                                                                            <div class="media">
                                                                                <img src="{{asset('latest/assets/images/icons/color-2.svg')}}"
                                                                                    alt="Color" class="img-fluid">
                                                                                <div class="media-body">
                                                                                    <h5>Accent Color</h5>
                                                                                    <p>The accent color is used to
                                                                                        accentuate visual elements.</p>
                                                                                </div>
                                                                                <a href="#"><img
                                                                                        src="{{asset('latest/assets/images/icons/pen-3.svg')}}"
                                                                                        alt="Color"
                                                                                        class="img-fluid"></a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="certificate-style-box">
                                                                            <h6>Select Certificate Style</h6>
                                                                            <div class="media">
                                                                                {{-- full page preview --}}
                                                                               <div class="full-page-preview">
                                                                                <a href="#" class="close-bttn">
                                                                                    <i class="fas fa-close"></i>
                                                                                </a>
                                                                                <img src="{{asset('latest/assets/images/big-c-01.svg')}}"
                                                                                    alt="Cert" class="img-fluid">
                                                                            </div>
                                                                            {{-- full page preview --}}

                                                                            <a href="#" class="cert-bttn">
                                                                                <img src="{{asset('latest/assets/images/certificate-01.png')}}"
                                                                                    alt="Cert" class="img-fluid">
                                                                            </a>
                                                                                <div class="media-body">
                                                                                    <div class="d-flex">
                                                                                        <h6>Certificate Style 1</h6>
                                                                                        <span>Active Certificate</span>
                                                                                    </div>
                                                                                    <p>Raouls Choice is een simple en
                                                                                        elegant thema zonder extra
                                                                                        opties, mokkeljk te gebruken en
                                                                                        geoptimaliseerd voor conversie.
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="media">
                                                                                {{-- full page preview --}}
                                                                               <div class="full-page-preview">
                                                                                <a href="#" class="close-bttn">
                                                                                    <i class="fas fa-close"></i>
                                                                                </a>
                                                                                <img src="{{asset('latest/assets/images/big-c-02.svg')}}"
                                                                                    alt="Cert" class="img-fluid">
                                                                            </div>
                                                                            {{-- full page preview --}}

                                                                            <a href="#" class="cert-bttn">
                                                                                <img src="{{asset('latest/assets/images/certificate-02.png')}}"
                                                                                    alt="Cert" class="img-fluid">
                                                                            </a>
                                                                                <div class="media-body">
                                                                                    <div class="d-flex">
                                                                                        <h6>Certificate Style 2</h6>
                                                                                    </div>
                                                                                    <p>Raouls Choice is een simple en
                                                                                        elegant thema zonder extra
                                                                                        opties, mokkeljk te gebruken en
                                                                                        geoptimaliseerd voor conversie.
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="media">
                                                                                {{-- full page preview --}}
                                                                               <div class="full-page-preview">
                                                                                <a href="#" class="close-bttn">
                                                                                    <i class="fas fa-close"></i>
                                                                                </a>
                                                                                <img src="{{asset('latest/assets/images/big-c-03.svg')}}"
                                                                                    alt="Cert" class="img-fluid">
                                                                            </div>
                                                                            {{-- full page preview --}}

                                                                            <a href="#" class="cert-bttn">
                                                                                <img src="{{asset('latest/assets/images/certificate-03.png')}}"
                                                                                    alt="Cert" class="img-fluid">
                                                                            </a>
                                                                                <div class="media-body">
                                                                                    <div class="d-flex">
                                                                                        <h6>Certificate Style 3</h6>
                                                                                    </div>
                                                                                    <p>Raouls Choice is een simple en
                                                                                        elegant thema zonder extra
                                                                                        opties, mokkeljk te gebruken en
                                                                                        geoptimaliseerd voor conversie.
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 mt-3">
                                                                        <div class="certificate-asset-upload">
                                                                            <h5>Logo</h5>
                                                                            <input type="file" class="d-none" id="logo">
                                                                            <label for="logo" class="upload-media-box">
                                                                                <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}"
                                                                                    alt="Color"
                                                                                    class="img-fluid light-ele">
                                                                                <img src="{{asset('latest/assets/images/icons/upload-5.svg')}}"
                                                                                    alt="Color"
                                                                                    class="img-fluid dark-ele">
                                                                                <span>Click to upload</span> or drag and
                                                                                drop SVG, PNG or JPG (max. 300x300px)
                                                                            </label>
                                                                        </div>
                                                                        <div class="certificate-asset-upload">
                                                                            <h5>Instructor Signature </h5>
                                                                            <input type="file" class="d-none" id="logo">
                                                                            <label for="logo" class="upload-media-box">
                                                                                <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}"
                                                                                    alt="Color"
                                                                                    class="img-fluid light-ele">
                                                                                <img src="{{asset('latest/assets/images/icons/upload-5.svg')}}"
                                                                                    alt="Color"
                                                                                    class="img-fluid dark-ele">
                                                                                <span>Click to upload</span> or drag and
                                                                                drop SVG, PNG or JPG (max. 300x300px)
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="text-end mt-4">
                                                                            <a href="#" class="common-bttn"><img
                                                                                    src="{{asset('latest/assets/images/icons/download4.svg')}}"
                                                                                    alt="Color" class="img-fluid me-2">
                                                                                Download</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="user-expperience-box user-expperience-box-2">
                                                            <div class="title">
                                                                <h4>All Certificates</h4>
                                                            </div>
                                                            <div class="media brdr-bttm">
                                                                <img src="{{ asset('latest/assets/images/experience-img.svg') }}"
                                                                    alt="experience-img" class="img-fluid">
                                                                <div class="media-body">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <h5>UI/UX Design</h5>
                                                                        <div>
                                                                            <a href="#"><img
                                                                                    src="{{ asset('latest/assets/images/icons/plus.svg') }}"
                                                                                    alt="img" class="img-fluid"></a>
                                                                            <a href="#"><img
                                                                                    src="{{ asset('latest/assets/images/icons/pen.svg') }}"
                                                                                    alt="img" class="img-fluid"></a>
                                                                        </div>
                                                                    </div>

                                                                    <h6>Learn Cosy <i class="fas fa-circle"></i>
                                                                        Full-Time <i class="fas fa-circle"></i> Jul 2018
                                                                        - Present (5y 3m)</h6>
                                                                    <p>Created and executed website for 10 brands
                                                                        utilizing multiple
                                                                        features and content types to increase brand
                                                                        outreach, engagement,
                                                                        and leads.</p>
                                                                </div>
                                                            </div>
                                                            <div class="media brdr-bttm">
                                                                <img src="{{ asset('latest/assets/images/experience-img.svg') }}"
                                                                    alt="experience-img" class="img-fluid">
                                                                <div class="media-body">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <h5>UI/UX Design</h5>
                                                                        <div>
                                                                            <a href="#"><img
                                                                                    src="{{ asset('latest/assets/images/icons/plus.svg') }}"
                                                                                    alt="img" class="img-fluid"></a>
                                                                            <a href="#"><img
                                                                                    src="{{ asset('latest/assets/images/icons/pen.svg') }}"
                                                                                    alt="img" class="img-fluid"></a>
                                                                        </div>
                                                                    </div>
                                                                    <h6>Learn Cosy <i class="fas fa-circle"></i>
                                                                        Full-Time <i class="fas fa-circle"></i> Jul 2018
                                                                        - Present (5y 3m)</h6>
                                                                    <p>Created and executed website for 10 brands
                                                                        utilizing multiple
                                                                        features and content types to increase brand
                                                                        outreach, engagement,
                                                                        and leads.</p>
                                                                </div>
                                                            </div>
                                                            <div class="media">
                                                                <img src="{{ asset('latest/assets/images/experience-img.svg') }}"
                                                                    alt="experience-img" class="img-fluid">
                                                                <div class="media-body">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <h5>UI/UX Design</h5>
                                                                        <div>
                                                                            <a href="#"><img
                                                                                    src="{{ asset('latest/assets/images/icons/plus.svg') }}"
                                                                                    alt="img" class="img-fluid"></a>
                                                                            <a href="#"><img
                                                                                    src="{{ asset('latest/assets/images/icons/pen.svg') }}"
                                                                                    alt="img" class="img-fluid"></a>
                                                                        </div>
                                                                    </div>
                                                                    <h6>Learn Cosy <i class="fas fa-circle"></i>
                                                                        Full-Time <i class="fas fa-circle"></i> Jul 2018
                                                                        - Present (5y 3m)</h6>
                                                                    <p>Created and executed website for 10 brands
                                                                        utilizing multiple
                                                                        features and content types to increase brand
                                                                        outreach, engagement,
                                                                        and leads.</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane tab-con fade active-bg" id="pills-password" role="tabpanel"
                            aria-labelledby="pills-password-tab" tabindex="0">
                            {{-- password tab start --}}
                            <div class="row user-add-form-wrap user-add-form-wrap-2 mt-0">
                                <div class="col-12">
                                    <form action="{{ route('instructor.password.update',$user->id) }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="text" placeholder="Email" class="form-control"
                                                        value="{{ $user->email}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">New Password<sup class="text-danger">*</sup></label>
                                                    <input type="password" name="password" placeholder="*********"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="password">
                                                    <span class="invalid-feedback">@error('password'){{ $message }}
                                                        @enderror</span>
                                                    <i class="fa-regular fa-eye" onclick="changeType()"
                                                        id="eye-click"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Confirm New Password<sup
                                                            class="text-danger">*</sup></label>
                                                    <input type="password" name="password_confirmation"
                                                        placeholder="*********"
                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                        id="password_confirmation">
                                                    <span class="invalid-feedback">@error('password_confirmation'){{
                                                        $message }}
                                                        @enderror</span>
                                                    <i class="fa-regular fa-eye" onclick="changeType2()"
                                                        id="eye-click2"></i>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-submit-bttns">
                                                    <button type="submit" class="btn btn-submit">Save Changes</button>
                                                    <button type="reset" class="btn btn-cancel">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- password tab end --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
{{-- student update page @e --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')
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
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('experience-form');

        form.addEventListener('submit', function (event) {
            var joinDate = new Date(document.getElementById('join_date').value);
            var retireDate = new Date(document.getElementById('retire_date').value);

            if (retireDate <= joinDate) {
                event.preventDefault();
                document.getElementById('invalid_retire_date').innerHTML ="Retire date must be after or equal to join date.";
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll(".cert-bttn");
    const closeButtons = document.querySelectorAll(".close-bttn");
    const mainBody = document.querySelector(".full-page-preview"); 
    
    buttons.forEach(function(button) {
        button.addEventListener("click", function(e) {
            e.preventDefault();
            const certBox = this.parentElement.querySelector(".full-page-preview"); 

            if (certBox) { 
                certBox.classList.toggle('show');
            }
        });
    });

    closeButtons.forEach(function(bttn) {
        bttn.addEventListener("click", function(e) {
            e.preventDefault();
            const certBox = this.parentElement; 

            if (certBox) { 
                certBox.classList.remove('show');
            }
        });
    });
     
});
</script>

{{-- tab open js --}}
<script>
    document.addEventListener('DOMContentLoaded', function () { 
        const urlParams = new URLSearchParams(window.location.search);
        const tabToOpen = urlParams.get('tab');
        const tabPanes = document.querySelectorAll('.tab-con');
        const tabLinks = document.querySelectorAll('.tab-link'); 
        const experienceTabLink = document.getElementById('pills-experience-tab');
        const experienceTabContent = document.getElementById('pills-experience');
        const certificateTabLink = document.getElementById('pills-certificate-tab');
        const certificateTabContent = document.getElementById('pills-certificate');

        // Open the tab if the 'tab' parameter is specified
        if (tabToOpen == 'experience') {
            tabPanes.forEach(tab => tab.classList.remove('show', 'active'));
            tabLinks.forEach(tab => tab.classList.remove('active'));
            experienceTabLink.classList.add('active'); 
            experienceTabContent.classList.add('show', 'active'); 
        }
        else if (tabToOpen == 'certificate') {
            tabPanes.forEach(tab => tab.classList.remove('show', 'active'));
            tabLinks.forEach(tab => tab.classList.remove('active'));
            certificateTabLink.classList.add('active'); 
            certificateTabContent.classList.add('show', 'active'); 
        }
    });
</script>

@endsection

{{-- page script @E --}}