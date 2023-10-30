@extends('layouts.latest.instructor')
@section('title')
Account Management
@endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/user.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/auth-css/auth.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- student update page @S --}}
<main class="student-profile-update-page dns-page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {{-- session message @S --}}
                @include('partials/session-message')
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    Module settings Reset successfully
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    Module settings Reset Failed
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                {{-- session message @E --}}
                <div class="own-profile-box account-settings-box">
                    <div class="header">
                        <ul class="nav nav-pills main-navigator" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active tab-link" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true" data-param="home">Theme Setting</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link tab-link" id="pills-experience-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-experience" type="button" role="tab"
                                    aria-controls="pills-experience" aria-selected="false" data-param="dns">DNS</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane active-bg fade show active tab-con" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">
                            <div class="row justify-content-center">
                                <div class="col-lg-10 col-xl-9">
                                    <div class="theme-settings-wrap">
                                        <form action="{{ route('module.setting.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="theme-settings-box theme-dns-settings-box">
                                                <div class="row">
                                                    <div class="col-lg-12 col-12 col-xl-8">
                                                        <div class="logo-box-view">
                                                            {{-- logo upload part --}}
                                                            <h6>Logo</h6>
                                                            <p>The logo visible within your Learn Cosy App.</p>

                                                            <input type="file" name="logo" id="logo" accept="image/*"
                                                                class="d-none @error('logo') is-invalid @enderror">
                                                            <span class="invalid-feedback">
                                                                @error('logo')
                                                                {{ $message }}
                                                                @enderror
                                                            </span>

                                                            <label for="logo" class="logo-upload-box">
                                                                @if (isset($module_settings->logo) ||
                                                                $module_settings->logo != null)
                                                                <img src="{{ asset($module_settings->logo) }}"
                                                                    alt="Upload Preview"
                                                                    class="img-fluid w-100 d-block rounded"
                                                                    id="logo-preview">
                                                                @else
                                                                <img src="{{ asset('latest/assets/images/logo-view.svg') }}"
                                                                    alt="Upload Preview"
                                                                    class="img-fluid w-100 d-block rounded"
                                                                    id="logo-preview">
                                                                @endif
                                                                <div class="upload-ol-box">
                                                                    <img src="{{ asset('latest/assets/images/icons/camera-plus-w.svg') }}"
                                                                        alt="Upload Preview" class="img-fluid">
                                                                    <span>Change photo</span>
                                                                </div>
                                                                <button class="btn" type="button" id="close-button"><i
                                                                        class="fas fa-close"></i></button>
                                                            </label>
                                                            {{-- logo upload part --}}

                                                            {{-- app logo part --}}
                                                            <h6 class="mt-3">App Logo</h6>
                                                            <p>The logo visible within your Learn Cosy App.</p>

                                                            <input type="file" name="app_logo" id="app_logo"
                                                                accept="image/*"
                                                                class="d-none @error('app_logo') is-invalid @enderror">
                                                            <span class="invalid-feedback">
                                                                @error('app_logo')
                                                                {{ $message }}
                                                                @enderror
                                                            </span>

                                                            <label for="app_logo" class="logo-upload-box mt-2 border-0">
                                                                <img src="{{ asset('latest/assets/images/app_logo.png') }}"
                                                                    alt="Upload Preview" class="img-fluid"
                                                                    id="app_logo-preview">
                                                                <button class="btn" type="button" id="close-button2"><i
                                                                        class="fas fa-close"></i></button>
                                                            </label>

                                                            @if (isset($module_settings->app_logo) ||
                                                            $module_settings->app_logo != null)
                                                            <label for="app_logo" class="logo-upload-box">
                                                                <img src="{{ asset($module_settings->app_logo) }}"
                                                                    alt="Upload Preview" class="img-fluid rounded">
                                                            </label>
                                                            @endif

                                                            {{-- app logo part --}}
                                                            <div class="feat-box no-bg">
                                                                {{-- choice color theme --}}
                                                                <div class="media">
                                                                    <img src="{{ asset('latest/assets/images/icons/color.svg') }}"
                                                                        alt="Color" class="img-fluid">
                                                                    <div class="media-body">
                                                                        <h5>Menu Background Color</h5>
                                                                        <p>This is the color of your menu bar. Your logo
                                                                            should look good on this.</p>
                                                                    </div>

                                                                    <div class="color-position">
                                                                        <input type="color" class="form-control p-0"
                                                                            name="primary_color" id="primary_color"
                                                                            value="{{ old('primary_color', $module_settings->value->primary_color ? $module_settings->value->primary_color : '#ffffff') }}">

                                                                        <label for="primary_color">
                                                                            <img src="{{ asset('latest/assets/images/icons/pen-ic.svg') }}"
                                                                                alt="Color" class="img-fluid me-0">
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="media">
                                                                    <img src="{{ asset('latest/assets/images/icons/color-2.svg') }}"
                                                                        alt="Color" class="img-fluid">
                                                                    <div class="media-body">
                                                                        <h5>Accent Color</h5>
                                                                        <p>The accent color is used to accentuate visual
                                                                            elements.</p>
                                                                    </div>
                                                                    <div class="color-position">
                                                                        <input type="color" class="form-control"
                                                                            name="secondary_color" id="secondary_color"
                                                                            value="{{ old('secondary_color', $module_settings->value->secondary_color ? $module_settings->value->secondary_color : '#66768E') }}">
                                                                        <label for="secondary_color">
                                                                            <img src="{{ asset('latest/assets/images/icons/pen-ic.svg') }}"
                                                                                alt="Color" class="img-fluid me-0">
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                {{-- choice color theme --}}
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="certificate-style-box login-page-theme-box border-0">
                                                            <h6>Select Login Page Theme</h6>

                                                            <input type="radio" class="d-none" id="default"
                                                                name="lp_layout" value="default" {{
                                                                optional($module_settings->value)->lp_layout ==
                                                            'default' || optional($module_settings->value)->lp_layout ==
                                                            '' ? 'checked' : '' }}>
                                                            <input type="radio" class="d-none" id="fullwidth"
                                                                name="lp_layout" value="fullwidth" {{
                                                                optional($module_settings->value)->lp_layout ==
                                                            'fullwidth' ? 'checked' : '' }}>
                                                            <input type="radio" class="d-none" id="leftsidebar"
                                                                name="lp_layout" value="leftsidebar" {{
                                                                optional($module_settings->value)->lp_layout ==
                                                            'leftsidebar' ? 'checked' : '' }}>
                                                            <input type="radio" class="d-none" id="rightsidebar"
                                                                name="lp_layout" value="rightsidebar" {{
                                                                optional($module_settings->value)->lp_layout ==
                                                            'rightsidebar' ? 'checked' : '' }}>

                                                            <label for="default">
                                                                <div class="media">
                                                                    <img src="{{ asset('latest/assets/images/login-01.png') }}"
                                                                        alt="Color" class="img-fluid">
                                                                    <div class="media-body">
                                                                        <div class="d-flex">
                                                                            <h6>Raouls Choice</h6>
                                                                            @if (old('lp_layout',
                                                                            $module_settings->value->lp_layout ?? '') ==
                                                                            'default')
                                                                            <span>Active Theme</span>
                                                                            @elseif (old('lp_layout',
                                                                            $module_settings->value->lp_layout ?? '') ==
                                                                            '')
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
                                                                    <img src="{{ asset('latest/assets/images/login-02.png') }}"
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
                                                                    <img src="{{ asset('latest/assets/images/login-03.png') }}"
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
                                                                <div class="media pb-0">
                                                                    <img src="{{ asset('latest/assets/images/login-04.png') }}"
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
                                                        <div class="certificate-style-box login-page-theme-box border-0"
                                                            style="padding: 1rem 1.5rem 0!important;">
                                                            <div class="media mt-0" style="padding: 0!important;">
                                                                <label for="lp_bg_image"
                                                                    class="file-upload-area file-upload-2">
                                                                    <img src="{{ asset('latest/assets/images/icons/upload-icon.svg') }}"
                                                                        alt="a" class="img-fluid mx-auto light-ele">
                                                                    <img src="{{ asset('latest/assets/images/icons/upload-5.svg') }}"
                                                                        alt="a" class="img-fluid mx-auto dark-ele">
                                                                    <p class="mt-2"><span>Click to upload</span> or drag
                                                                        and drop</p>
                                                                </label>

                                                                <div>
                                                                    <input type="file" name="lp_bg_image" id="lp_bg_image" accept="image/*"
                                                                        class="d-none @error('lp_bg_image') is-invalid @enderror">
                                                                    <span class="invalid-feedback">
                                                                        @error('lp_bg_image')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </span>
                                                                </div>

                                                                <div class="media-body">
                                                                    <div class="d-flex">
                                                                        <h6>Upload Login Page Background Image</h6>
                                                                    </div>
                                                                    <p>SVG, PNG, JPG, or GIF (max. 1200x900px)</p>
                                                                </div>
                                                            </div>

                                                            <label for="lp_bg_image"
                                                                class="logo-upload-box mt-2 border-0">
                                                                <img src="" alt="" class="img-fluid rounded"
                                                                    id="lp_logo-preview">
                                                                <button class="btn" type="button" id="close-button3"><i
                                                                        class="fas fa-close"></i></button>
                                                            </label>

                                                            @if (isset($module_settings->lp_bg_image) ||
                                                            $module_settings->lp_bg_image != null)
                                                            <label for="lp_bg_image" class="logo-upload-box">
                                                                <img src="{{ asset($module_settings->lp_bg_image) }}"
                                                                    alt="Uploaded" class="img-fluid rounded">

                                                            </label>
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
                                                                value="{{ old('meta_title', $module_settings->value->meta_title ?? '') }}"
                                                                class="form-control @error('meta_title') is-invalid @enderror">
                                                            <span class="invalid-feedback">
                                                                @error('meta_title')
                                                                {{ $message }}
                                                                @enderror
                                                            </span>

                                                            <h6>Meta Description</h6>
                                                            <textarea placeholder="Type your description"
                                                                name="meta_desc"
                                                                class="form-control @error('meta_desc') is-invalid @enderror">{{ old('meta_desc', $module_settings->value->meta_desc ?? '') }}</textarea>

                                                            <span class="invalid-feedback">
                                                                @error('meta_desc')
                                                                {{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                        <div class="favicon-box">
                                                            <h6>Favicon</h6>
                                                            <p>Your favicon will be shown in browsers and in search
                                                                results.</p>

                                                            <label for="favicon" class="file-upload-area">
                                                                <img src="{{ asset('latest/assets/images/icons/upload-icon.svg') }}"
                                                                    alt="a" class="img-fluid mx-auto light-ele">

                                                                <img src="{{ asset('latest/assets/images/icons/upload-3.svg') }}"
                                                                    alt="a" class="img-fluid mx-auto dark-ele">
                                                                <p><span>Click to upload</span> <br>
                                                                    SVG, PNG, JPG, or GIF
                                                                    (max. 300x300px)</p>
                                                            </label>

                                                            <input type="file" name="favicon" id="favicon"
                                                                accept="image/*"
                                                                class="d-none @error('favicon') is-invalid @enderror">
                                                            <span class="invalid-feedback">
                                                                @error('favicon')
                                                                {{ $message }}
                                                                @enderror
                                                            </span>

                                                            <label for="favicon" class="logo-upload-box mt-2 border-0">
                                                                <img src="" alt="" class="img-fluid rounded"
                                                                    id="favicon-preview">
                                                                <button class="btn" type="button" id="close-button4"><i
                                                                        class="fas fa-close"></i></button>
                                                            </label>

                                                            @if (isset($module_settings->favicon) ||
                                                            $module_settings->favicon != null)
                                                            <label for="favicon" class="logo-upload-box">
                                                                <img src="{{ asset($module_settings->favicon) }}"
                                                                    alt="Uploaded" class="img-fluid rounded">
                                                            </label>
                                                            @endif

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
                                                                <img src="{{ asset('latest/assets/images/icons/upload-icon.svg') }}"
                                                                    alt="a" class="img-fluid mx-auto light-ele">

                                                                <img src="{{ asset('latest/assets/images/icons/upload-5.svg') }}"
                                                                    alt="a" class="img-fluid mx-auto dark-ele">
                                                                <p><span>Click to upload</span> <br>
                                                                    SVG, PNG, JPG, or GIF
                                                                    (max. 300x300px)</p>
                                                            </label>

                                                            <input type="file" name="apple_icon" id="apple_icon"
                                                                accept="image/*"
                                                                class="d-none @error('apple_icon') is-invalid @enderror">
                                                            <span class="invalid-feedback">
                                                                @error('apple_icon')
                                                                {{ $message }}
                                                                @enderror
                                                            </span>

                                                            <label for="apple_icon"
                                                                class="logo-upload-box mt-2 border-0">
                                                                <img src="" alt="" class="img-fluid rounded"
                                                                    id="apple_icon-preview">
                                                                <button class="btn" type="button" id="close-button5"><i
                                                                        class="fas fa-close"></i></button>
                                                            </label>

                                                            @if (isset($module_settings->apple_icon) ||
                                                            $module_settings->apple_icon != null)
                                                            <label for="apple_icon" class="logo-upload-box">
                                                                <img src="{{ asset($module_settings->apple_icon) }}"
                                                                    alt="Uploaded" class="img-fluid rounded">
                                                            </label>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="save-bttns pb-5">
                                                            <button type="button" class="btn btn-cancel"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#resetThemeModal">Reset</button>
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
                        <div class="tab-pane fade tab-con" id="pills-experience" role="tabpanel"
                            aria-labelledby="pills-experience-tab" tabindex="0">
                            <div class="dns-settings-box-wrapper">
                                <div class="dns-left-sidebar">
                                    <div class="setup-step">
                                        <div class="step-box big active">
                                            <span></span>
                                            <p>Add domain</p>
                                        </div>
                                        <div class="step-box active done">
                                            <span>
                                                <img src="{{ asset('latest/assets/images/icons/small-ic.svg') }}"
                                                    alt="small-ic" class="img-fluid">
                                            </span>
                                            <p>Domain name</p>
                                        </div>
                                        <div class="step-box current">
                                            <span></span>
                                            <p>Domain verification</p>
                                        </div>
                                        <div class="step-box big">
                                            <span></span>
                                            <p>Connect domain</p>
                                        </div>
                                        <div class="step-box">
                                            <span></span>
                                            <p>Connection options</p>
                                        </div>
                                        <div class="step-box">
                                            <span></span>
                                            <p>Add DNS records</p>
                                        </div>
                                        <div class="step-box big">
                                            <span></span>
                                            <p>Finish</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="dns-main-body">
                                    {{-- add domain start --}}
                                    <div class="add-domain-box d-block">
                                        <form action="">
                                            <h1>Add a domain</h1>
                                            <p>If you already own a domain like learncosy.com, you can add it to your
                                                account here.</p>
                                            <h5>Domain name</h5>

                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="ex: learncosy">
                                            </div>

                                            <div class="form-submit-bttns">
                                                <button class="btn btn-cancel" type="reset">Cancel</button>
                                                <button class="btn btn-submit" type="submit">Add Domain</button>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- add domain end --}}

                                    {{-- verification domain start --}}
                                    <div class="add-domain-box domain-verify-box d-none">
                                        <form action="">
                                            <h2>How do you want to verify your domain?</h2>
                                            <p>Before we can set up your domain, we need to verify that you are the
                                                owner of learncosy.com.</p>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                    id="flexRadioDefault2" checked>
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Add a TXT record to the domain's DNS record
                                                </label>
                                                <h6>Recommended if you can create new DNS record at your register or DNS
                                                    hosting provider. </h6>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                    id="flexRadioDefault3" checked>
                                                <label class="form-check-label" for="flexRadioDefault3">
                                                    If you can't TXT record, add an MX record to the domain's DNS
                                                    records
                                                </label>
                                                <h6>Recommended only if TXT records aren't supported by your domain host
                                                    or register.</h6>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                    id="flexRadioDefault3" checked>
                                                <label class="form-check-label" for="flexRadioDefault3">
                                                    Add a text file to the domain’s website
                                                </label>
                                                <h6>Recommended if you’ve already set up a website using this domain,
                                                    for example, www.learncosy.com.</h6>
                                            </div>


                                            <div class="form-submit-bttns">
                                                <button class="btn btn-cancel" type="reset">Back</button>
                                                <button class="btn btn-submit" type="submit">Verify</button>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- verification domain end --}}

                                    {{-- connect your domain start --}}
                                    <div class="add-domain-box domain-verify-box d-none">
                                        <form action="">
                                            <h2>Connect your domain</h2>
                                            <h3>Sign in to your DNS hosting provider and add this record to your
                                                learncosy.com domain.</h3>
                                            <p>Don't worry, adding this record won’t affect your existing email or other
                                                services and it can be safely removed at the end of setup.</p>

                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                                    data-bs-target="#nav-home" type="button" role="tab"
                                                    aria-controls="nav-home" aria-selected="true">TXT
                                                    Record</button>
                                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                                    data-bs-target="#nav-profile" type="button" role="tab"
                                                    aria-controls="nav-profile" aria-selected="false">MX
                                                    Record</button>
                                            </div>

                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                                    aria-labelledby="nav-home-tab" tabindex="0">

                                                    <div class="media">
                                                        <div class="media-body">
                                                            <h5>TXT name</h5>
                                                            <h6><img src="{{ asset('latest/assets/images/icons/copy-1.svg') }}"
                                                                    alt="copy-1" class="img-fuid"> lab01 (or skip if
                                                                not
                                                                supported by provider)</h6>
                                                        </div>
                                                    </div>
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <h5>TXT value</h5>
                                                            <h6><img src="{{ asset('latest/assets/images/icons/copy-1.svg') }}"
                                                                    alt="copy-1" class="img-fuid"> MSem58456895</h6>
                                                        </div>
                                                    </div>
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <h5>TTL</h5>
                                                            <h6><img src="{{ asset('latest/assets/images/icons/copy-1.svg') }}"
                                                                    alt="copy-1" class="img-fuid"> 3600 (or your
                                                                provider default)</h6>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                                    aria-labelledby="nav-profile-tab" tabindex="0">

                                                    <div class="media">
                                                        <div class="media-body">
                                                            <h5>MXT name</h5>
                                                            <h6><img src="{{ asset('latest/assets/images/icons/copy-1.svg') }}"
                                                                    alt="copy-1" class="img-fuid"> lab01 (or skip if
                                                                not
                                                                supported by provider)</h6>
                                                        </div>
                                                    </div>
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <h5>MXT value</h5>
                                                            <h6><img src="{{ asset('latest/assets/images/icons/copy-1.svg') }}"
                                                                    alt="copy-1" class="img-fuid">MSem58456895</h6>
                                                        </div>
                                                    </div>
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <h5>MTL</h5>
                                                            <h6><img src="{{ asset('latest/assets/images/icons/copy-1.svg') }}"
                                                                    alt="copy-1" class="img-fuid"> 3600 (or your
                                                                provider default)</h6>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="form-submit-bttns">
                                                <button class="btn btn-cancel" type="reset">Back</button>
                                                <button class="btn btn-submit" type="submit">Connect</button>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- connect your domain end --}}

                                    {{-- add dns record --}}
                                    <div class="add-domain-box domain-verify-box d-none">
                                        <form action="">
                                            <h2>Add DNS records</h2>
                                            <h3>To add these records for learncosy.com, go to your DNS hosting provider.
                                            </h3>
                                            <p>To start routing email through Learncosy, select Exchange and Exchange
                                                online Protection. Next, sign in to your domain host and new DNS record
                                                that match the record shown here. copy the values below and paste them
                                                into the new record at your domain host, or download or print the DNS
                                                record info to use as a reference. When you’re finished, select
                                                Continue.</p>

                                            <div class="d-flex">
                                                <a href="#"><img
                                                        src="{{ asset('latest/assets/images/icons/download-4.svg') }}"
                                                        alt="download" class="img-fuid"> Download CSV file</a>
                                                <a href="#"><img
                                                        src="{{ asset('latest/assets/images/icons/download-4.svg') }}"
                                                        alt="download" class="img-fuid"> Download Zone file</a>
                                                <a href="#"><img
                                                        src="{{ asset('latest/assets/images/icons/print.svg') }}"
                                                        alt="download" class="img-fuid"> Print</a>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckChecked" checked>
                                                <label class="form-check-label form-check-label-2"
                                                    for="flexCheckChecked">
                                                    Exchange and Exchange online protection
                                                </label>
                                            </div>


                                            <p>Email, contacts, and scheduling are all provided by Exchange. Set up this
                                                service to enable all the functionality of Outlook and other email
                                                clients. Exchange service need 3 records to work right: and MX record
                                                tells where to deliver email messages, a TXT to prevent someone from
                                                spoofing your domain to send spam and a CNAME record for client-side
                                                Auto discover, helping mail clients connect users to their respective
                                                mailboxes.</p>

                                            <div class="form-submit-bttns">
                                                <button class="btn btn-cancel" type="reset">Back</button>
                                                <button class="btn btn-submit" type="submit">Add DNS Record</button>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- add dns record --}}

                                    {{-- domain setup finish --}}
                                    <div class="add-domain-box finish-txt d-none">
                                        <form action="">
                                            <h2><img src="{{ asset('latest/assets/images/icons/gren-chehck.svg') }}"
                                                    alt="gren-chehck" class="img-fluid"> Domain Setup is Complete</h2>
                                            <p>learncosly.com is all set up and you can now view and manage it from your
                                                domains list. <br>
                                                You can now go to Active users to add new user and set up email
                                                addresses or aliases for everyone who needs to use learncosy.com for
                                                email.</p>

                                            <h4>Next Steps</h4>

                                            <div class="finish-bttns">
                                                <a href="#">Go to Active users</a>
                                                <a href="#">View all domains</a>
                                            </div>

                                        </form>
                                    </div>
                                    {{-- domain setup finish --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- popup modal --}}
<div class="reset-modal">
    <div class="modal fade" id="resetThemeModal" tabindex="-1" aria-labelledby="resetThemeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-titles">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5>Are you sure! to reset the theme?</h5>
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-close"></i>
                            </button>
                        </div>
                        <p>Your all preference and settings will be reset and can not be Undo!</p>
                    </div>
                    <div class="modal-bttnss">
                        <button class="btn btn-no" type="button" data-bs-dismiss="modal">No</button>
                        <button class="btn btn-yes" type="button" data-value="yes" id="resetBttn"
                            data-bs-dismiss="modal">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- popup modal --}}

{{-- student update page @e --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

{{-- logo image preview js --}}
<script>
    const logoInput = document.getElementById('logo');
    const logoPreview = document.getElementById('logo-preview');
    const closeButton = document.getElementById('close-button');

    logoInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                logoPreview.src = e.target.result;
                closeButton.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    closeButton.addEventListener('click', function () { 
        logoInput.value = '';
        logoPreview.src = '{{ asset('latest/assets/images/logo-view.svg') }}';
        closeButton.style.display = 'none';
    });
</script>

{{-- app logo image preview js --}}
<script>
    const appLogoInput = document.getElementById('app_logo');
    const appLogoPreview = document.getElementById('app_logo-preview');
    const appCloseButton = document.getElementById('close-button2');

    appLogoInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                appLogoPreview.src = e.target.result;
                appCloseButton.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    appCloseButton.addEventListener('click', function () { 
        appLogoInput.value = '';
        appLogoPreview.src = '{{ asset('latest/assets/images/app-logo.png') }}';
        appCloseButton.style.display = 'none';
    });
</script>

{{-- lp bg image preview --}}
<script>
    const lpBgImageInput = document.getElementById('lp_bg_image');
    const lpLogoPreview = document.getElementById('lp_logo-preview');
    const lpCloseButton = document.getElementById('close-button3');

    lpBgImageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                lpLogoPreview.src = e.target.result;
                lpCloseButton.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    lpCloseButton.addEventListener('click', function () {
        lpBgImageInput.value = '';
        lpLogoPreview.src = ''; // Clear the preview
        lpCloseButton.style.display = 'none';
    });
</script>

{{-- favicon image preview --}}
<script>
    const faviconImageInput = document.getElementById('favicon');
    const faviconPreview = document.getElementById('favicon-preview');
    const faviconCloseButton = document.getElementById('close-button4');

    faviconImageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                faviconPreview.src = e.target.result;
                faviconCloseButton.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    faviconCloseButton.addEventListener('click', function () {
        faviconImageInput.value = '';
        faviconPreview.src = ''; // Clear the preview
        faviconCloseButton.style.display = 'none';
    });
</script>

{{-- apple icon image preview --}}
<script>
    const appleIconImageInput = document.getElementById('apple_icon');
    const appleIconPreview = document.getElementById('apple_icon-preview');
    const appleIconCloseButton = document.getElementById('close-button5');

    appleIconImageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                appleIconPreview.src = e.target.result;
                appleIconCloseButton.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    appleIconCloseButton.addEventListener('click', function () {
        appleIconImageInput.value = '';
        appleIconPreview.src = ''; // Clear the preview
        appleIconCloseButton.style.display = 'none';
    });
</script>

{{-- add active class --}}
<script>
    let cards = [...document.querySelectorAll(".login-page-theme-box label .media")];
        cards.forEach(card => {
            card.addEventListener("click", function() {
                cards.forEach(c => c.classList.remove("active"));
                this.classList.add("active")
            })
        });
</script>

{{-- theme reset ajax request with featch --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

    let currentURL = window.location.href;
        const baseUrl = currentURL.split('/').slice(0, 3).join('/');
        const resetBttn = document.getElementById('resetBttn');

        resetBttn.addEventListener('click', () => {
            const confirmation =  resetBttn.getAttribute('data-value');
            if (confirmation == 'yes') {
                const moduleId = {{ $module_settings->id }};
                fetch(`${baseUrl}/instructor/theme/setting/reset/${moduleId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message === 'Theme Reset') {

                            document.querySelector('.alert-success').style.display = "block";

                            window.scrollTo({
                                top: 0,
                                behavior: "smooth"
                            });

                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);


                        } else {
                            document.querySelector('.alert-danger').style.display = "block";
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        });
    });
</script>

{{-- tab open js --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const tabToOpen = urlParams.get('tab');
            const tabPanes = document.querySelectorAll('.tab-con');
            const tabLinks = document.querySelectorAll('.tab-link');

            const homeTabLink = document.getElementById('pills-home-tab');
            const homeTabContent = document.getElementById('pills-home');

            const profileTabLink = document.getElementById('pills-experience-tab'); 
            const profileTabContent = document.getElementById('pills-experience');
 
            if (tabToOpen == 'dns') {
                tabPanes.forEach(tab => tab.classList.remove('show', 'active'));
                tabLinks.forEach(tab => tab.classList.remove('active'));

                profileTabLink.classList.add('active');
                profileTabContent.classList.add('show', 'active');

            } else if(tabToOpen == 'home') {
               tabPanes.forEach(tab => tab.classList.remove('show', 'active'));
                tabLinks.forEach(tab => tab.classList.remove('active'));

                homeTabLink.classList.add('active');
                homeTabContent.classList.add('show', 'active');
            }
        });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
          var tabLinks = document.querySelectorAll('.main-navigator .nav-link');
          var currentParam = '';  
        
          tabLinks.forEach(function(tabLink) {
            tabLink.addEventListener('click', function(event) {
              event.preventDefault(); 
              var param = tabLink.getAttribute('data-param'); 
              if (param !== currentParam) { 
                var currentURL = window.location.href;
                var newURL = currentURL.replace(/(\?|&)tab=[^&]*/, '') + (currentURL.includes('?') ? '?' : '?') + 'tab=' + param; 
                window.history.pushState(null, '', newURL); 
                currentParam = param; 
              }
            });
          });
        });
</script>

@endsection

{{-- page script @E --}}