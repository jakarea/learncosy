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
    <link rel="shortcut icon" href="{{ asset('assets/images/fav.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- all css start -->
    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> 
    <link href="{{ asset('assets/css/homepage.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/slick.css') }}" rel="stylesheet" type="text/css" />
    @yield('style')
    <!-- all css end -->
</head>

<body>

    {{-- landing page wrap @s --}}
    <section class="landing-page-wrapper">
        {{-- header @s --}}
        @include('partials/guest/header')
        {{-- header @E --}}
 
        @yield('content')
    </section>
    {{-- landing page wrap @e --}}

    <!-- back to top button @S -->
    <a href="#" id="back-to-top">&#8593;</a>
    <!-- back to top button @E -->

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/home/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/home/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/home/config.js') }}"></script>
    <script src="{{ asset('assets/js/home/smooth-navigate.js') }}"></script>
    <script src="{{ asset('assets/js/home/back-to-top.js') }}"></script>
    @yield('script')
</body>

</html>