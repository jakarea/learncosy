<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>LearnCosy Authintication | @yield('title')</title>
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
    <link href="{{ asset('latest/assets/auth-css/style.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('latest/assets/auth-css/header.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('latest/assets/auth-css/auth.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
    @yield('style') 
    <link href="{{ asset('latest/assets/auth-css/responsive.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
    <!-- all css end -->

</head>

<body> 

    <!-- full page wrapper @s -->
  <div class="full-page-wrapper">
    <!-- header start -->
    <header class="header-section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="header-logo ps-md-3">
              <a href="{{url('/')}}">
                <img src="{{ asset('latest/assets/images/logo.svg') }}" alt="Main logo" class="img-fluid">
              </a>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- header end -->

    <!-- auth part start -->
    @yield('content')
    <!-- auth part end -->

  </div>
  <!-- full page wrapper @e -->

    <script src="{{ asset('latest/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('latest/assets/js/custom.js') }}"></script> 
    @yield('script')
    </body>
</html>