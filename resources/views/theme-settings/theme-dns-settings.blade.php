@extends('layouts.latest.instructor')
@section('title') Account Management @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/auth-css/auth.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- student update page @S --}}
<main class="student-profile-update-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="own-profile-box account-settings-box">
                    <div class="header">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">Theme Setting</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-experience" type="button" role="tab"
                                    aria-controls="pills-experience" aria-selected="false">DNS</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane active-bg fade " id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">
                            <div class="row justify-content-center">
                                <div class="col-lg-10 col-xl-9">
                                    <div class="theme-settings-wrap">
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="theme-settings-box theme-dns-settings-box">
                                                <div class="row">
                                                    <div class="col-lg-12 col-12 col-xl-8">
                                                        <div class="logo-box-view">
                                                            <h6>Logo</h6>
                                                            <p>The logo visible within your Learn Cosy App.</p>

                                                            <label for="favicon3" class="file-upload-area p-0"
                                                                id="file-upload-area3">
                                                                <img src="{{asset('latest/assets/images/logo-view.svg')}}"
                                                                    alt="a" class="img-fluid">
                                                            </label>

                                                            <div id="uploadedFileContainer3"
                                                                class="uploaded-file-container"></div>
                                                            <div class="view">
                                                                <input type="file" name="logo" id="favicon3"
                                                                    class="form-control d-none @error('logo') is-invalid @enderror"
                                                                    onchange="handleFileUpload(this, 'uploadedFileContainer3', 'file-upload-area3')">
                                                                <span class="invalid-feedback">@error('logo'){{ $message
                                                                    }} @enderror</span>
                                                            </div>

                                                            <h6>App Logo</h6>
                                                            <p>The logo visible within your Learn Cosy App.</p>
                                                            <div class="small-view">
                                                                <img src="{{asset('latest/assets/images/small-logo.png')}}"
                                                                    alt="a" class="img-fluid">
                                                            </div>
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
                                                                <a href="#"><img
                                                                        src="{{asset('latest/assets/images/icons/pen-3.svg')}}"
                                                                        alt="Color" class="img-fluid"></a>
                                                            </div>
                                                            <div class="media">
                                                                <img src="{{asset('latest/assets/images/icons/color-2.svg')}}"
                                                                    alt="Color" class="img-fluid">
                                                                <div class="media-body">
                                                                    <h5>Accent Color</h5>
                                                                    <p>The accent color is used to accentuate visual
                                                                        elements.</p>
                                                                </div>
                                                                <a href="#"><img
                                                                        src="{{asset('latest/assets/images/icons/pen-3.svg')}}"
                                                                        alt="Color" class="img-fluid"></a>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="certificate-style-box login-page-theme-box border-0">
                                                            <h6>Select Login Page Theme</h6>
                                                            <div class="media">
                                                                <img src="{{asset('latest/assets/images/login-01.png')}}"
                                                                    alt="Color" class="img-fluid">
                                                                <div class="media-body">
                                                                    <div class="d-flex">
                                                                        <h6>Raouls Choice</h6>
                                                                    </div>
                                                                    <p>Raouls Choice is een simple en elegant thema
                                                                        zonder extra opties, mokkeljk te gebruken en
                                                                        geoptimaliseerd voor conversie.</p>
                                                                </div>
                                                            </div>
                                                            <div class="media">
                                                                <img src="{{asset('latest/assets/images/login-02.png')}}"
                                                                    alt="Color" class="img-fluid">
                                                                <div class="media-body">
                                                                    <div class="d-flex">
                                                                        <h6>Volledige Breedte Afbeelding</h6>
                                                                    </div>
                                                                    <p>In dit thema kon je een valledige breedte
                                                                        afbeeliding uplioden en heb je toegang tot nog
                                                                        aartal extra optes.</p>
                                                                </div>
                                                            </div>
                                                            <div class="media">
                                                                <img src="{{asset('latest/assets/images/login-03.png')}}"
                                                                    alt="Color" class="img-fluid">
                                                                <div class="media-body">
                                                                    <div class="d-flex">
                                                                        <h6>Zijbalk &amp; Achtergrond</h6>
                                                                    </div>
                                                                    <p>Raouls Choice is een simple en elegant thema
                                                                        zonder extra opties, mokkeljk te gebruken en
                                                                        geoptimaliseerd voor conversie.</p>
                                                                </div>
                                                            </div>
                                                            <div class="media">
                                                                <img src="{{asset('latest/assets/images/login-04.png')}}"
                                                                    alt="Color" class="img-fluid">
                                                                <div class="media-body">
                                                                    <div class="d-flex">
                                                                        <h6>Zijbalk & Achtergrond</h6>
                                                                    </div>
                                                                    <p>Raouls Choice is een simple en elegant thema
                                                                        zonder extra opties, mokkeljk te gebruken en
                                                                        geoptimaliseerd voor conversie.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="certificate-style-box login-page-theme-box border-0">
                                                            <div class="media mt-0">
                                                                <label for="favicon1"
                                                                    class="file-upload-area file-upload-2"
                                                                    id="file-upload-area1">
                                                                    <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}"
                                                                        alt="a" class="img-fluid me-0">
                                                                    <p class="mt-2"><span>Click to upload</span> or drag
                                                                        and drop</p>
                                                                </label>
                                                                <div class="media-body">
                                                                    <div class="d-flex">
                                                                        <h6>Upload Login Page Background Image</h6>
                                                                    </div>
                                                                    <p>SVG, PNG, JPG or GIF (max. 1200x900px)</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="save-bttns pb-5">
                                                            <button type="button" class="btn btn-cancel">Cancel</button>
                                                            <button type="submit" class="btn btn-submit">Save</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-12 col-xl-4">
                                                        <div class="meta-box">
                                                            <h5>Meta</h5>
                                                            <p>Metadata is used to improve your position in search
                                                                engines.</p>

                                                            <h6>Meta Title</h6>
                                                            <input type="text" class="form-control" name="meta_title"
                                                                id="meta_title" value=""
                                                                class="form-control @error('meta_title') is-invalid @enderror">
                                                            <span class="invalid-feedback">@error('meta_title'){{
                                                                $message }}
                                                                @enderror</span>

                                                            <h6>Meta Description</h6>
                                                            <textarea placeholder="Enter your description"
                                                                class="form-control @error('meta_title') is-invalid @enderror"></textarea>

                                                            <span class="invalid-feedback">@error('meta_title'){{
                                                                $message }}
                                                                @enderror</span>
                                                        </div>
                                                        <div class="favicon-box">
                                                            <h6>Favicon</h6>
                                                            <p>Your favicon will be shown in browsers and in search
                                                                results.</p>

                                                            <label for="favicon1" class="file-upload-area"
                                                                id="file-upload-area1">
                                                                <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}"
                                                                    alt="a" class="img-fluid">
                                                                <p><span>Click to upload</span> or drag and drop <br>
                                                                    SVG, PNG, JPG, or GIF
                                                                    (max. 300x300px)</p>
                                                            </label>
                                                            <div id="uploadedFileContainer1"
                                                                class="uploaded-file-container"></div>

                                                            <div class="col-md-12 mt-3">
                                                                <div class="form-group">
                                                                    <input type="file" name="favicon" id="favicon1"
                                                                        class="form-control d-none @error('favicon') is-invalid @enderror"
                                                                        onchange="handleFileUpload(this, 'uploadedFileContainer1', 'file-upload-area1')">
                                                                    <span class="invalid-feedback">@error('favicon'){{
                                                                        $message }}
                                                                        @enderror</span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="favicon-box">
                                                            <h6>Apple Icon</h6>
                                                            <p>Also known as Apple touch icon. This is the icon that is
                                                                displayed to
                                                                navigate to
                                                                your Huddie when a user has saved your Huddies as a
                                                                favourite in their Apple
                                                                device.</p>


                                                            <label for="favicon2" class="file-upload-area"
                                                                id="file-upload-area2">
                                                                <img src="{{asset('latest/assets/images/icons/upload-icon.svg')}}"
                                                                    alt="a" class="img-fluid">
                                                                <p><span>Click to upload</span> or drag and drop <br>
                                                                    SVG, PNG, JPG, or GIF
                                                                    (max. 300x300px)</p>
                                                            </label>
                                                            <div id="uploadedFileContainer2"
                                                                class="uploaded-file-container"></div>
                                                            <div class="col-md-12 mt-3">
                                                                <div class="form-group">
                                                                    <input type="file" name="apple_icon" id="favicon2"
                                                                        class="form-control d-none  @error('apple_icon') is-invalid @enderror"
                                                                        onchange="handleFileUpload(this, 'uploadedFileContainer2', 'file-upload-area2')">
                                                                    <span
                                                                        class="invalid-feedback">@error('apple_icon'){{
                                                                        $message }}
                                                                        @enderror</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="pills-experience" role="tabpanel"
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
                                                <img src="{{asset('latest/assets/images/icons/small-ic.svg')}}"
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
                                    {{-- <div class="add-domain-box">
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
                                    </div> --}}
                                    {{-- add domain end --}}

                                    {{-- verification domain start --}}
                                    {{-- <div class="add-domain-box domain-verify-box">
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
                                    </div> --}}
                                    {{-- verification domain end --}}

                                    {{-- connect your domain start --}}
                                    <div class="add-domain-box domain-verify-box">
                                        <form action="">
                                            <h2>Connect your domain</h2>
                                            <h3>Sign in to your DNS hosting provider and add this record to your
                                                learncosy.com domain.</h3>
                                            <p>Don't worry, adding this record won’t affect your existing email or other
                                                services and it can be safely removed at the end of setup.</p>
 
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <button class="nav-link active" id="nav-home-tab"
                                                        data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
                                                        role="tab" aria-controls="nav-home"
                                                        aria-selected="true">TXT Record</button>
                                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                                        data-bs-target="#nav-profile" type="button" role="tab"
                                                        aria-controls="nav-profile"
                                                        aria-selected="false">MX Record</button>
                                                </div> 

                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                                                     {{-- tx record --}}
                                                     <div class="media">
                                                        <div class="media-body">
                                                            <h5>TXT name</h5>
                                                            <h6><img src="{{asset('latest/assets/images/icons/copy-1.svg')}}" alt="copy-1" class="img-fuid"> lab01 (or skip if not supported by provider)</h6>
                                                        </div>
                                                     </div>
                                                     <div class="media">
                                                        <div class="media-body">
                                                            <h5>TXT value</h5>
                                                            <h6><img src="{{asset('latest/assets/images/icons/copy-1.svg')}}" alt="copy-1" class="img-fuid"> MSem58456895</h6>
                                                        </div>
                                                     </div>
                                                     <div class="media">
                                                        <div class="media-body">
                                                            <h5>TTL</h5>
                                                            <h6><img src="{{asset('latest/assets/images/icons/copy-1.svg')}}" alt="copy-1" class="img-fuid"> 3600 (or your provider default)</h6>
                                                        </div>
                                                     </div>
                                                     {{-- tx record --}}
                                                </div>
                                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                                                    {{-- mx record --}}
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <h5>MXT name</h5>
                                                            <h6><img src="{{asset('latest/assets/images/icons/copy-1.svg')}}" alt="copy-1" class="img-fuid"> lab01 (or skip if not supported by provider)</h6>
                                                        </div>
                                                     </div>
                                                     <div class="media">
                                                        <div class="media-body">
                                                            <h5>MXT value</h5>
                                                            <h6><img src="{{asset('latest/assets/images/icons/copy-1.svg')}}" alt="copy-1" class="img-fuid"> MSem58456895</h6>
                                                        </div>
                                                     </div>
                                                     <div class="media">
                                                        <div class="media-body">
                                                            <h5>MTL</h5>
                                                            <h6><img src="{{asset('latest/assets/images/icons/copy-1.svg')}}" alt="copy-1" class="img-fuid"> 3600 (or your provider default)</h6>
                                                        </div>
                                                     </div>
                                                    {{-- mx record --}}
                                                </div>
                                              </div>


                                            <div class="form-submit-bttns">
                                                <button class="btn btn-cancel" type="reset">Back</button>
                                                <button class="btn btn-submit" type="submit">Connect</button>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- connect your domain end --}}
                                </div>
                            </div>
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
@endsection

{{-- page script @E --}}