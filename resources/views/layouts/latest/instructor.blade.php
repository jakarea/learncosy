<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <title>{{ modulesetting('meta_title') ? modulesetting('meta_title') : 'Learncosy' }} | @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Admin Template For Filter Developers" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="{{ modulesetting('meta_desc') ? modulesetting('meta_desc') : '' }}">
        <meta property="og:title" content="">
        <meta property="og:type" content="">
        <meta property="og:url" content="">
        <meta property="og:image" content="">
        <meta name="theme-color" content="#fafafa">
        <meta name="csrf-token" content=" {{ csrf_token() }} ">

        <!-- App favicon -->
        @if (modulesetting('favicon')) 
            <link rel="shortcut icon" href="{{ asset(modulesetting('favicon')) }}">
        @else
            <link rel="shortcut icon" href="{{ asset('latest/assets/images/favicon.png') }}">
        @endif

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
            integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- all css start -->
        {{-- jquery ui css --}}
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <!-- App css -->
        <link href="{{ asset('latest/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('latest/assets/admin-css/style.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('latest/assets/admin-css/header.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('latest/assets/admin-css/dashboard.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('latest/assets/admin-css/ins-dashboard.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('latest/assets/admin-css/admin-dark.css') }}" rel="stylesheet" type="text/css" />

        {{-- Light box image popup --}}
        <link href="{{ asset('magnify-popup/css/lightbox.min.css') }}" rel="stylesheet" type="text/css" />
        {{-- Emoji --}}
        <link href="{{ asset('emoji/emojionearea.min.css') }}" rel="stylesheet" type="text/css" />

        {{-- Toaster notification css --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

        <script src="https://js.pusher.com/5.0/pusher.min.js"></script>

        {{-- jquery ui --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <style>
            .user-name-avatar{
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 3rem;
                height: 3rem;
                border-radius: 50%;
                background: var(--transparent-grey-24, rgba(145, 158, 171, 0.24));
                color: var(--neutral-color-neutral-60, #66768E);
                font-size: 0.875rem;
                font-style: normal;
                font-weight: 600;
                line-height: 1.375rem;
            }
            .header-area .navbar-nav .nav-item .submenu-box li a:hover,
            .header-area .navbar-nav .nav-item .submenu-box,
            .header-area{
                background: {{ modulesetting('primary_color') }}
            }

            .header-area .navbar-nav .nav-item .submenu-box li a.active{
                background: {{ modulesetting('menu_color') }};
                color: {{ modulesetting('primary_color') }}
            }

            .header-area .navbar-nav .nav-item .nav-link,
            .header-area .navbar-nav .nav-item .submenu-box li a{
                color: {{ modulesetting('menu_color') }}
            }
 
        </style>

        @yield('style')
        <link href="{{ asset('latest/assets/admin-css/ins-responsive.css') }}" rel="stylesheet" type="text/css">
        <!-- all css end -->

        @yield('seo')

    </head>

    <body class="{{ session('darkModePreference') == 'dark-mode' ? 'dark-mode' : '' }}">
        {{-- Main Root Wrapper @S --}} 

        {{-- header start --}}
        {{-- @include('partials/latest/instructor/header') --}}
        @if (Auth::user()->user_role == 'instructor')
            @include('partials/latest/instructor/header')
        @elseif(Auth::user()->user_role == 'admin')
            @include('partials/latest/dashboard/header')
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
        <script src="https://cdn.tiny.cloud/1/24z531gtj4tkxagq9eshg386rnnrwmmo91drwhvc19g5szrb/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script src="{{ asset('latest/assets/js/tinymce.js') }}"></script>

        {{-- Emoji area --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"
            integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        {{-- Lightbox --}}
        <script src="{{ asset('magnify-popup/js/lightbox.min.js') }}"></script>

        {{--  Toaster js --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

        {{-- dark mode js --}}
        
        <script>
            const htmlBody = document.querySelector("body");
            const modeBttn = document.getElementById("darkModeBttn");

            function modeCall(mode){
            let currentURLs = window.location.href;
            const baseUrls = currentURLs.split('/').slice(0, 3).join('/');

            // Update the dark mode preference using session
            fetch(`${baseUrls}/preference/mode/setting`, { 
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ preferenceMode: mode }),
            });
        }

            function toggleMode() {
                htmlBody.classList.toggle('dark-mode');
                const mode = htmlBody.classList.contains('dark-mode') ? 'dark-mode' : '';

                modeCall(mode);

                localStorage.setItem('dark-mode', mode);

                if (htmlBody.classList.contains('dark-mode')) {
                    tinymce.remove('#description');
                    darkFunction();
                } else {
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

        <script>
            // Module resorting
            $(function() {
                $("#moduleResorting").sortable({
                    update: function(event, ui) {
                        var moduleOrder = $(this).sortable("toArray", { attribute: "data-module-id" });
                        moduleOrder = moduleOrder.filter(function(item) {
                            return item !== '';
                        });
                        updateModuleOrder( moduleOrder );
                    }
                });
            });


            // Lession resorting
            $(function() {
                $(".lessonResorting").sortable({
                    update: function(event, ui) {
                        var moduleLessonOrder = $(this).sortable("toArray", { attribute: "data-module-lession-id" });
                        moduleLessonOrder = moduleLessonOrder.filter(function(item) {
                            return item !== '';
                        });

                        updateModuleLessionOrder( moduleLessonOrder );
                    }
                });
            });


            function updateModuleOrder(moduleOrder) {
                $.ajax({
                    url: "/instructor/module/sortable",
                    type: "POST",
                    data: {
                        moduleOrder: moduleOrder,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log("Module reorder updated successfully");
                    },
                    error: function(xhr, status, error) {
                        console.error("Error updating module order:", error);
                    }
                });
            }

            function updateModuleLessionOrder(moduleLessonOrder){
                $.ajax({
                    url: "/instructor/module/lesson/sortable",
                    type: "POST",
                    data: {
                        lessonOrder: moduleLessonOrder,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // console.log("Module lession reorder updated successfully");
                    },
                    error: function(xhr, status, error) {
                        // console.error("Error updating module order:", error);
                    }
                });
            }


        </script>

        @yield('script')

    </body>
</html>
