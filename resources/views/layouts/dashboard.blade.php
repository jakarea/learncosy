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
    <link rel="shortcut icon" href="{{asset('dashboard-assets/images/favicon.png')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- all css start -->
    <!-- App css -->
    <link href="{{ asset('dashboard-assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard-assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard-assets/css/header.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard-assets/css/sidebar.css') }}" rel="stylesheet" type="text/css" />
    @yield('style')
    <link href="{{ asset('dashboard-assets/css/responsive.css') }}" rel="stylesheet">
    <!-- all css end -->
 
</head>

<body>

 {{-- full page wrapper @s --}}
    <div class="full-page-wrapper">
        {{-- sidebar @s --}}
        @include('partials/dashboard/sidebar')
        {{-- sidebar @e --}}

        {{-- page body @s --}}
        <main class="page-body-wrapper" id="page-body">
            {{-- header @s --}}
            @include('partials/dashboard/header')
            {{-- header @e --}}
            @yield('contents')
        </main>
        {{-- page body @e --}}
    </div>
     {{-- full page wrapper @e --}}

    <script src="{{ asset('dashboard-assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/sidebar.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/mobile-sidebar.js') }}"></script>
    @yield('script')
</body>

</html>