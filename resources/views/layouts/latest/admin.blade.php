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
    {{-- jquery ui css --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    @yield('style')
    <link href="{{ asset('latest/assets/admin-css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <!-- all css end -->

    @yield('seo')
</head>

<body class="{{ session('darkModePreference') == 'dark-mode' ? 'dark-mode' : '' }}">

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
    {{-- jquery ui --}}
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


    {{-- dark mode js --}}
    <script>
        const htmlBody = document.querySelector("body");
        const modeBttn = document.getElementById("darkModeBttn");

        function toggleMode() {
            htmlBody.classList.toggle('dark-mode');
            const mode = htmlBody.classList.contains('dark-mode') ? 'dark-mode' : '';

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


<script>

    // Module resorting
    $(function() {
        $("#moduleResort").sortable({
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
        $(".lessonResort").sortable({
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
            url: "/admin/courses/create/module/sortable",
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
            url: "/admin/courses/create/lesson/sortable",
            type: "POST",
            data: {
                lessonOrder: moduleLessonOrder,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log("Module lession reorder updated successfully");
            },
            error: function(xhr, status, error) {
                console.error("Error updating module order:", error);
            }
        });
    }


</script>

    @yield('script')
</body>

</html>
