@extends('layouts.latest.instructor')
@section('title')
My Profile Details
@endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/user.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/ins-dashboard.css') }}" rel="stylesheet" type="text/css" />
<link rel='stylesheet' href='https://foliotek.github.io/Croppie/croppie.css'>
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="user-profile-view-page">
    <div class="container-fluid">
        {{-- profile information @S --}}
        <div class="row">
            <div class="col-lg-8">
                <div class="user-profile-picture">
                    {{-- user cover photo --}}
                    <div class="cover-img" id="coverImgContainer">
                        @if ($user->cover_photo)
                        <img src="{{ asset($user->cover_photo) }}" alt="Cover Photo" class="img-fluid cover-img"
                            id="item-img-output">
                        @else
                        <img src="{{ asset('latest/assets/images/cover.svg') }}" class="img-fluid cover-img"
                            id="item-img-output" />
                        @endif

                        <input type="file" class="d-none item-img file center-block" id="coverImage"
                            accept="image/png, image/jpeg, image/svg+xml" name="cover_photo">
                        <input type="hidden" name="coverImgBase64" id="coverImgBase64">

                        <div class="ol-upload">
                            <label class="cabinet center-block icons" for="coverImage">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </label>
                        </div>
                        <div class="upload-form">
                            <button id="cancelBtn" class="d-none btn common-bttn" type="button">Cancel</button>
                            <button id="uploadBtn" class="d-none btn common-bttn" type="button">Save</button>
                        </div>
                    </div>
                    {{-- user cover photo --}}
                    <div class="media">
                        @if ($user->avatar)
                        <img src="{{ asset($user->avatar) }}" alt="{{ $user->name }}" class="img-fluid">

                        @else
                        <span class="avatar-box">{!! strtoupper($user->name[0]) !!}</span>
                        @endif
                        <div class="media-body">
                            <h3>{{ $user->name }}</h3>
                            <p class="text-capitalize">{{ $user->user_role }}</p>
                        </div>
                        <a href="{{ url('/instructor/profile/account-settings') }}" class="edit-profile">Edit
                            Profile</a>
                    </div>
                </div>
                <div class="user-details-box">
                    <h5>About Me</h5>
                    {!! $user->description !!}
                </div>

                <div class="user-expperience-box">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Experiences</h4>
                        <div>
                            <a
                                href="{{ route('account.settings', ['tab' => 'experience', 'subdomain' => config('app.subdomain') ]) }}"><img
                                    src="{{ asset('latest/assets/images/icons/plus.svg') }}" alt="img"
                                    class="img-fluid"></a>
                        </div>
                    </div>
                    @if (count($experiences) > 0)
                    @foreach ($experiences as $experience)
                    <div class="media brdr-bttm">
                        <img src="{{ asset('latest/assets/images/experience-img.svg') }}" alt="experience-img"
                            class="img-fluid">
                        <div class="media-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5>{{ $experience->profession }}</h5>
                                <div>
                                    <a href="{{ url('instructor/profile/edit?id=' . $experience->id) }}"><img
                                            src=" {{ asset('latest/assets/images/icons/pen.svg') }}" alt="img"
                                            class="img-fluid"></a>
                                </div>
                            </div>

                            <h6>{{ $experience->company_name }} <i class="fas fa-circle"></i>
                                {{ $experience->job_type }} <i class="fas fa-circle"></i>
                                {{ $experience->experience }}</h6>
                            <p>{{ $experience->short_description }}</p>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div>
                        @include('partials/no-data')
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-info-box">
                    <h4>Contact</h4>
                    <div class="media">
                        <img src="{{ asset('latest/assets/images/icons/email.svg') }}" alt="email" class="img-fluid">
                        <div class="media-body">
                            <h6>Email</h6>
                            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                        </div>
                    </div>
                    @if ($user->phone)
                    <div class="media">
                        <img src="{{ asset('latest/assets/images/icons/phone.svg') }}" alt="email" class="img-fluid">
                        <div class="media-body">
                            <h6>Phone</h6>
                            <a href="#">{{ $user->phone ? $user->phone : '--' }}</a>
                        </div>
                    </div>
                    @endif
                    @if ($user->short_bio)
                    <div class="media">
                        <img src="{{ asset('latest/assets/images/icons/globe.svg') }}" alt="email" class="img-fluid">
                        <div class="media-body">
                            <h6>Website</h6>
                            <a href="#">{{ $user->short_bio ? $user->short_bio : '--' }}</a>
                        </div>
                    </div>
                    @endif
                    @php
                    $social_links = explode(",", $user->social_links);
                    use Illuminate\Support\Str;
                    @endphp

                    @foreach ($social_links as $social_link)
                    @php
                    $url = $social_link;
                    $host = parse_url($url, PHP_URL_HOST);
                    $domain = Str::after($host, 'www.');
                    $domain = Str::before($domain, '.');
                    @endphp

                    <div class="media">
                        @if ($domain == 'linkedin')
                        <img src="{{ asset('latest/assets/images/icons/linkedin.svg') }}" alt="linkedin"
                            class="img-fluid">
                        @elseif ($domain == 'instagram')
                        <img src="{{ asset('latest/assets/images/icons/insta.svg') }}" alt="insta" class="img-fluid">
                        @elseif ($domain == 'twitter')
                        <img src="{{ asset('latest/assets/images/icons/x.svg') }}" alt="twitter" class="img-fluid"
                            style="width: 1.1rem;">
                        @elseif ($domain == 'facebook')
                        <i class="fa-brands fa-facebook-square" style="color: rgba(28, 28, 28, 0.626); font-size: 1.3rem; margin-right: 1rem; width: 24px;
                            height: 24px;
                            margin-top: 0.5rem;"></i>
                        @else
                        <img src="{{ asset('latest/assets/images/icons/globe.svg') }}" alt="linkedin" class="img-fluid">
                        @endif

                        <div class="media-body">
                            <h6 class="text-capitalize">{{ $domain ? $domain : '' }}</h6>
                            <a href="{{ $social_link ? $social_link : '#' }}">{{ $social_link ? $social_link : '' }}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- profile information @E --}}
    </div>
</main>

{{-- upload banner modal start --}}
@include('modals/banner-resize')
{{-- upload banner modal end --}}

@endsection
{{-- page content @E --}}

{{-- script --}}
@section('script')
<script src='https://foliotek.github.io/Croppie/croppie.js'></script>
{{-- crop banenr image js --}}
<script src="{{ asset('latest/assets/js/banner-crop.js') }}"></script>
{{-- set user cover photo js --}}
<script>
    document.addEventListener('DOMContentLoaded', function () { 
    const coverImgOutput = document.getElementById('item-img-output'); 
    const uploadBtn = document.getElementById('uploadBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    // Handle upload button click
    const coverImgBase64 = document.getElementById('coverImgBase64');
    uploadBtn.addEventListener('click', function () { 
        let fileBase64 = coverImgBase64.value;
        uploadFile(fileBase64);  
    });

    // Handle cancel button click
    cancelBtn.addEventListener('click', function () {
        cancelUpload();
    }); 

    // Function to handle file upload
    function uploadFile(fileBase64) {

        let currentURL = window.location.href;
        const baseUrl = currentURL.split('/').slice(0, 3).join('/');

        if (fileBase64) {
            const userId = "{{ $user->id }}"; 
            const requestData = {
                cover_photo: fileBase64,
                userId: userId,
            };
            cancelBtn.classList.add('d-none');
            uploadBtn.innerHTML = `<i class="fa-solid fa-spinner fa-spin-pulse"></i> Uploading`;
 
            fetch(`${baseUrl}/instructor/profile/cover/upload`, {
                    method: 'POST', 
                    body: JSON.stringify(requestData),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', 
                    },
                })
                .then(response => response.json())
                .then(data => { 
                    if (data.message === 'UPLOADED') {
                        uploadBtn.innerHTML = `Save`;
                        uploadBtn.classList.add('d-none');
                        cancelBtn.classList.add('d-none');
                    }
                })
                .catch(error => { 
                    uploadBtn.innerHTML = `Failed`;
                });
        }
    }

    // Function to handle cancel button click
        function cancelUpload() { 
            const userCoverPhoto = "{{ $user->cover_photo ?? null }}"; 
            coverImgOutput.src = userCoverPhoto
                ? "{{ asset('') }}" + userCoverPhoto
                : "{{ asset('latest/assets/images/cover.svg') }}";
            coverImgBase64.value = '';
            uploadBtn.classList.add('d-none');
            cancelBtn.classList.add('d-none');
        } 
    });
</script>
@endsection
{{-- script --}}