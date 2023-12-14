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
    <link href="{{ asset('latest/assets/admin-css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('latest/assets/admin-css/header.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('latest/assets/admin-css/dashboard.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('latest/assets/admin-css/admin-dark.css') }}" rel="stylesheet" type="text/css" />

    @yield('style')
    <link href="{{ asset('latest/assets/admin-css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <!-- all css end -->

    @yield('seo')
</head>

<body>

    {{-- ========= Main Root Wrapper @S ========= --}}
    <div class="main-page-wrapper">
        {{-- header start --}}
        @include('partials/latest/dashboard/header')
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/24z531gtj4tkxagq9eshg386rnnrwmmo91drwhvc19g5szrb/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ asset('latest/assets/js/tinymce.js') }}"></script>

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

    @yield('script')
</body>

</html>
