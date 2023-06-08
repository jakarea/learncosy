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
    <link rel="shortcut icon" href="{{ asset('assets/images/fav.svg') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- all css start --> 
    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />  
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />  
    <link href="{{ asset('assets/css/header.css') }}" rel="stylesheet" type="text/css" />  
    <link href="{{ asset('assets/css/sidebar.css') }}" rel="stylesheet" type="text/css" />  
    @yield('style')
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">  
    <!-- all css end -->
 
  @yield('seo')
</head>

<body> 

    <!-- ========= Main Root Wrapper @S ========= -->
    <div class="main-body-wrapper">
    <!-- === Sidebar area @S -->
    @include('partials/sidebar')
    <!-- === Sidebar area @E -->

    <!-- ==== Main Body Content @S ==== -->
    <div class="main-page-wrapper">

      <!-- == main header @S == -->
      @include('partials/header')
      <!-- == main header @E == -->

      <!-- main pages @S -->
      @yield('content')
      <!-- main pages @E -->

    </div>
    <!-- ==== Main Body Content @E ==== -->
  </div>
  <!-- ========= Main Root Wrapper @E ========= -->

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/ITool-handler.js') }}"></script>
    @yield('script')
    </body>
</html>