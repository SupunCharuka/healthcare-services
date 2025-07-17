<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>healthcare.lk | @yield('title') </title>
    <!-- Fav Icon -->
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    @include('backend.customer.layouts.styles')

</head>

<body class="cnt-home" x-data="{ overflow_y: true }" :class="[!overflow_y ? 'overflow-hidden' : '']">

    <div class="boxed_wrapper">

        <!-- preloader -->
        <div class="preloader"></div>
        <!-- preloader -->

        <!-- Page Heading -->
        @include('backend.customer.layouts.header')

        <!--page-title-two-->
        <section class="page-title-two">
         
        </section>
        <!--page-title-two end-->

        <!-- patient-dashboard -->
        <section class="patient-dashboard bg-color-3">
            <div class="left-panel">
            @include('backend.customer.layouts.inc.sidebar')
            </div>
            <div class="right-panel">
                @yield('content')
            </div>
        </section>
        <!-- patient-dashboard -->


        <!-- Page footer -->
        @include('backend.customer.layouts.footer')

        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="fa fa-arrow-up"></span>
        </button>


    </div>
    @include('backend.customer.layouts.scripts')
</body>

</html>
