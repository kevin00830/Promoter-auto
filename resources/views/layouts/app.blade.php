<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" theme="wi5-v1">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Title -->
    <title>{{ $title }} - {{ env('APP_NAME') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Social tags -->
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.ico') }}" />

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!-- Theme Styles -->
    <link href="{{ asset('plugins/global') }}/plugins.bundle.css?v=1.0.0" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins') }}/prismjs/prismjs.bundle.css?v=1.0.0" rel="stylesheet" type="text/css" />
	<link href="{{ asset('css') }}/style.bundle.css?v=1.0.0" rel="stylesheet" type="text/css" />

    <!-- Custom Style -->
	<link href="{{ asset('css') }}/custom.css" rel="stylesheet" type="text/css" />

    @stack('css')
<style>
      .header-tabs .nav-item .nav-link {
 
        padding:12px !important;
        font-size:15px;
        
      }
</style>
    <script>var csrfToken = '{{ csrf_token() }}';</script>
    <!-- /. -->
</head>
<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">
    <div id="loader" style="display: block;">
        <div><img src="{{ asset('images/bars.svg') }}"><br><span></span></div>
    </div>

    <!-- Mobile Header -->
    @include('layouts.mobile_header')
    <!-- /. Mobile Header -->

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">
            <!-- Wrapper -->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!-- Header -->
                @include('layouts.header')
                <!-- End Header -->

                <!-- Main content -->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    @yield('content')
                </div>
                <!-- /. Main content -->

                <!-- Footer -->
                @include('layouts.footer')
                <!-- /. Footer -->
            </div>
            <!-- End Wrapper -->
        </div>
    </div>

    <!-- Quick User Side Panel -->
    @include('layouts.components.quick_user_panel')
    <!-- /. -->

    @auth()
        <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
            @csrf
        </form>
    @endauth

    <!-- Global Config(global config for global JS scripts) -->
    <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
    <!-- Global Config -->
    <!-- Theme Bundle -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('plugins/global') }}/plugins.bundle.js?v=1.0.0"></script>
    <script src="{{ asset('plugins') }}/prismjs/prismjs.bundle.js?v=1.0.0"></script>
    <script src="{{ asset('js') }}/scripts.bundle.js?v=1.0.0"></script>
    <script src="{{ asset('js/init.js') }}"></script>

    <script>
        window.onload = function () {
            // preloader fadeout onload
            var preloader = document.querySelector('#loader');
            if (preloader) {
                document.querySelector('#loader').style.display = 'none';
            }
        }
    </script>

    @stack('js')
</body>
</html>