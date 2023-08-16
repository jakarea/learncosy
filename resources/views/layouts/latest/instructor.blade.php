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
    <link href="{{ asset('latest/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> 
    <link href="{{ asset('latest/assets/admin-css/style.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('latest/assets/admin-css/header.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('latest/assets/admin-css/ins-dashboard.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
    
    @yield('style') 
    <link href="{{ asset('latest/assets/admin-css/ins-responsive.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
    <!-- all css end -->

    @yield('seo')
</head>

<body> 
    <!-- ========= Main Root Wrapper @S ========= -->
    <div class="main-page-wrapper">

        {{-- header start --}}
        @include('partials/latest/instructor/header')
        {{-- header end --}}

        @yield('content')
    </div>
    <!-- ========= Main Root Wrapper @E ========= -->

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @yield('script')
</body>

</html>