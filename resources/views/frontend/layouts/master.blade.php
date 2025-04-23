<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title') - HealthCare</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png">


    <!-- Styles -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @include('frontend.layouts.styles')
    @livewireStyles
</head>

<body>
    <div class="layout-theme animated-css" data-header="sticky" data-header-top="200">

        <!-- Loader Landing Page -->
        <div id="ip-container" class="ip-container">
            <!-- initial header -->
            <header class="ip-header">
                <div class="ip-loader">

                    <svg class="ip-inner" width="60px" height="60px" viewbox="0 0 80 80">
                        <path class="ip-loader-circlebg"
                            d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,39.3,10z">
                        </path>
                        <path id="ip-loader-circle" class="ip-loader-circle"
                            d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z">
                        </path>
                    </svg>
                </div>
            </header>
        </div>
        <!-- Loader end -->
        @include('frontend.layouts.header')

        @yield('content')

        @include('frontend.layouts.footer')
    </div>

    <span class="scroll-top bg-color_second"> <i class="fa fa-angle-up"> </i></span>
    @include('frontend.layouts.scripts')
    @livewireScripts

</body>

</html>
