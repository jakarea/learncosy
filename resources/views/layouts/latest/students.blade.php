<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>LearnCosy | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Admin Template For Filter Developers" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta name="theme-color" content="#fafafa">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('latest/assets/images/favicon.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- all css start -->
    <!-- App css -->
    <link href="{{ asset('latest/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('latest/assets/admin-css/style.css?v='.time()) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('latest/assets/admin-css/header.css?v='.time()) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('latest/assets/admin-css/dashboard.css?v='.time()) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('latest/assets/admin-css/admin-dark.css?v='.time()) }}" rel="stylesheet" type="text/css" />

    {{-- Light box image popup --}}
    <link href="{{ asset('magnify-popup/css/lightbox.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- Emoji --}}
    <link href="{{ asset('emoji/emojionearea.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- Toaster notification css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> --}}

    @yield('style')
    <link href="{{ asset('latest/assets/admin-css/responsive.css?v='.time()) }}" rel="stylesheet" type="text/css" />
    <!-- all css end -->

    @yield('seo')
</head>

<body>
    {{-- Main Root Wrapper @S --}}
    <div class="main-page-wrapper">

        {{-- header start --}}
        @if (Auth::user()->user_role == 'instructor')
            @include('partials/latest/instructor/header')
        @else
            @include('partials/latest/students/header')
        @endif

        {{-- header end --}}

        @yield('content')
    </div>
    {{-- Main Root Wrapper @E --}}

    {{-- dark mode button start --}}
    <input type="checkbox" id="darkModeBttn" class="d-none">

    <div class="dark-mode-bttn">
        <label for="darkModeBttn" class="active">
            <i class="fa-solid fa-sun"></i>
        </label>
        <label for="darkModeBttn">
            <i class="fa-solid fa-moon"></i>
        </label>
    </div>
    {{-- dark mode button end --}}
    <script src="{{ asset('latest/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('latest/assets/js/custom.js') }}"></script>

    <script src="https://cdn.tiny.cloud/1/your-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ asset('latest/assets/js/tinymce.js') }}"></script>

    {{-- Emoji area --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js" integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Lightbox --}}
    <script src="{{ asset('magnify-popup/js/lightbox.min.js') }}"></script>
    {{--  Toaster js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    {{-- dark mode js --}}
    <script>
        const htmlBody = document.querySelector("body");
        const modeBttn = document.getElementById("darkModeBttn");

        function toggleMode() {
            htmlBody.classList.toggle('dark-mode');
            const mode = htmlBody.classList.contains('dark-mode') ? 'dark-mode' : '';
            localStorage.setItem('dark-mode', mode);

            if (htmlBody.classList.contains('dark-mode')) {
                tinymce.remove('#description');
                darkFunction();
            }else{
                tinymce.remove('#description');
                lightFunction();
            }
        }
        const storedMode = localStorage.getItem('dark-mode');
        if (storedMode === 'dark-mode') {
            htmlBody.classList.add('dark-mode');
        }
        modeBttn.addEventListener('change', toggleMode);
    </script>

    <script>
        if (document.querySelector("body").classList.contains('dark-mode')) {
            tinymce.remove('#description');
            darkFunction();
        } else {
            tinymce.remove('#description');
            lightFunction();
        }
    </script>

        <script src="https://cdn.jsdelivr.net/npm/uuid@8.3.0/dist/umd/uuidv4.min.js"></script>
        <script>
            var userIdentifier = uuidv4();
            var domainParts = window.location.hostname.split('.');
            var topLevelDomain = domainParts.slice(-2).join('.');
            var cookieDomain = '.' + topLevelDomain;
            document.cookie = "userIdentifier=" + userIdentifier + "; path=/; domain=" + cookieDomain + "; secure; samesite=Strict";
        </script>

    @yield('script')
</body>
</html>
