@extends('layouts.latest.students')
@section('title')
    My Profile Details
@endsection

{{-- page style @S --}}
@section('style')
    <link href="{{ asset('latest/assets/admin-css/user.css') }}" rel="stylesheet" type="text/css" />
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
                                id="coverImg">
                            @else
                            <img src="{{ asset('latest/assets/images/cover.svg') }}" alt="Cover Photo"
                                class="img-fluid cover-img" id="coverImg">
                            @endif

                            <input type="file" class="d-none" id="coverImage" accept="image/png, image/jpeg, image/svg+xml"
                                name="cover_photo">
                            <div class="ol-upload">
                                <label for="coverImage" class="icons" id="uploadLabel">
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
                            <a href="{{url('students/profile/edit')}}" class="edit-profile">Edit Profile</a>
                        </div>
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
                        <div class="media">
                            <img src="{{ asset('latest/assets/images/icons/phone.svg') }}" alt="email" class="img-fluid">
                            <div class="media-body">
                                <h6>Phone</h6>
                                <a href="#">{{ $user->phone ? $user->phone : '--' }}</a>
                            </div>
                        </div>
                        <div class="media">
                            <img src="{{ asset('latest/assets/images/icons/globe.svg') }}" alt="email" class="img-fluid">
                            <div class="media-body">
                                <h6>Website</h6>
                                <a href="#">{{ $user->short_bio ? $user->short_bio : '--' }}</a>
                            </div>
                        </div>

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
                            <img src="{{ asset('latest/assets/images/icons/linkedin.svg') }}" alt="linkedin" class="img-fluid">
                            @elseif ($domain == 'instagram')
                            <img src="{{ asset('latest/assets/images/icons/insta.svg') }}" alt="insta" class="img-fluid">
                            @elseif ($domain == 'twitter')
                            <img src="{{ asset('latest/assets/images/icons/x.svg') }}" alt="twitter" class="img-fluid" style="width: 1.1rem;">
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
                <div class="col-lg-12">
                    <div class="user-details-box">
                        <h5>About Me</h5> 
                        {!! $user->description !!}
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="enroll-course-list">
                        <h4>Enrolled Course List : </h4>
                        <div class="list-wrap">
                            <table>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Payment ID</th>
                                    <th>Course Name</th>
                                    <th>Course Instructor</th>
                                    <th>Payment Date</th>
                                    <th>Payment Amount</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                                {{-- item @S --}}
                                @foreach ($checkout as $key => $value)
                                @if ($value->course) 
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->payment_id }}</td>
                                        <td>{{ $value->course->title }}</td>
                                        <td>{{ $value->course->user->name }}</td>
                                        <td>{{ $value->created_at }}</td>
                                        <td>€ {{ $value->amount }}</td>
                                        <td>
                                            @if ($value->status == 'completed')
                                                <span>Success</span>
                                            @else
                                                <span class="bg-danger">Failed</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('students/courses/my-courses/details/'.$value->course->slug) }}">View Course</a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                {{-- item @E --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- profile information @E --}}
        </div>
    </main>
@endsection
{{-- page content @E --}}



{{-- script --}}
@section('script')
{{-- set user cover photo js --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const coverImgContainer = document.getElementById('coverImgContainer');
    const coverImg = document.getElementById('coverImg');
    const bannerInput = document.getElementById('coverImage');
    const uploadLabel = document.getElementById('uploadLabel');
    const uploadBtn = document.getElementById('uploadBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    // Handle file input change
    bannerInput.addEventListener('change', handleFileSelect);

    // Handle label click (trigger file input click)
    uploadLabel.addEventListener('click', function (e) {
        e.preventDefault();
        bannerInput.click();
    });

    // Handle drag and drop
    coverImgContainer.addEventListener('dragover', function (e) {
        e.preventDefault();
        coverImgContainer.classList.add('drag-over');
    });

    coverImgContainer.addEventListener('dragleave', function () {
        coverImgContainer.classList.remove('drag-over');
    });

    coverImgContainer.addEventListener('drop', function (e) {
        e.preventDefault();
        coverImgContainer.classList.remove('drag-over');
        const file = e.dataTransfer.files[0];
        handleFile(file);
    });

    // Handle upload button click
    uploadBtn.addEventListener('click', function () {
        const file = bannerInput.files[0]; 
        uploadFile(file); 

    });

    // Handle cancel button click
    cancelBtn.addEventListener('click', function () {
        cancelUpload();
    });

    // Function to handle file input change
    function handleFileSelect() {
        const file = bannerInput.files[0];
        handleFile(file);
    }

    // Function to handle file (update image preview)
    function handleFile(file) {
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                coverImg.src = e.target.result;
                uploadBtn.classList.remove('d-none');
                cancelBtn.classList.remove('d-none');
            };

            reader.readAsDataURL(file);
        }
    }

    // Function to handle file upload
    function uploadFile(file) {

        let currentURL = window.location.href;
        const baseUrl = currentURL.split('/').slice(0, 3).join('/');

        if (file) { 

            const formData = new FormData();
            formData.append('cover_photo', file); 
            
            cancelBtn.classList.add('d-none');
            uploadBtn.innerHTML = `<i class="fa-solid fa-spinner fa-spin-pulse"></i> Uploading`;
 
            fetch(`${baseUrl}/students/profile/cover/upload`, {
                    method: 'POST', 
                    body: formData,
                    headers: {
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
    coverImg.src = userCoverPhoto
        ? "{{ asset('') }}" + userCoverPhoto
        : "{{ asset('latest/assets/images/cover.svg') }}";

    // Clear the file input value
    bannerInput.value = '';

    // Hide the upload and cancel buttons
    uploadBtn.classList.add('d-none');
    cancelBtn.classList.add('d-none');
} 
});
</script>
@endsection
{{-- script --}}