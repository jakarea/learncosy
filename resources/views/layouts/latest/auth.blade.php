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

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{ asset('latest/assets/images/favicon.png') }}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- all css start -->
  <!-- App css -->
  <link href="{{ asset('latest/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('latest/assets/auth-css/style.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('latest/assets/auth-css/header.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('latest/assets/auth-css/auth.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('latest/assets/auth-css/auth-dark.css') }}" rel="stylesheet" type="text/css" />
  @yield('style')
  <link href="{{ asset('latest/assets/auth-css/responsive.css') }}" rel="stylesheet" type="text/css" />
  <!-- all css end -->

</head>

<body>

  {{-- full page wrapper @s --}}
  <div class="full-page-wrapper">
    {{-- header start --}}
    <header class="header-section">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="header-logo ps-md-3">
              <a href="{{url('/')}}">
                <img src="{{ asset('latest/assets/images/logo-d.svg') }}" alt="Main logo" class="img-fluid light-ele">
                <img src="{{ asset('latest/assets/images/logo-w.svg') }}" alt="Main logo" class="img-fluid dark-ele">
              </a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="dark-mode-bttn">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="darkLightMode">
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    {{-- header end --}}

    {{-- auth part start --}}
    @yield('content')
    {{-- auth part end --}}

  </div>
  {{-- full page wrapper @e --}}

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
  <script>
    // darkMode.js
    const modeBttn = document.getElementById("darkModeBttn");
    const htmlBody = document.querySelector("body");

    // Function to toggle between dark and light mode
    function toggleMode() {
        htmlBody.classList.toggle('dark-mode');

        // Store user preference in local storage
        const mode = htmlBody.classList.contains('dark-mode') ? 'dark-mode' : '';
        localStorage.setItem('dark-mode', mode);
    }

    // Check the initial state from local storage
    const storedMode = localStorage.getItem('dark-mode');
    if (storedMode === 'dark-mode') {
        htmlBody.classList.add('dark-mode');
    }

    // Attach event listener to the checkbox
    modeBttn.addEventListener('change', toggleMode);


</script>

  @yield('script')

</body>

</html>
