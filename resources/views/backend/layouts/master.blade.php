<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="endless admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities. Laravel version 8, 08-02-2021 (update)">
    <meta name="keywords"
        content="admin template, endless admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/backend/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/backend/images/favicon.png') }}" type="image/x-icon">
    <title>healthcare.lk | @yield('title') </title>
    <!-- Google font-->
    {{-- @include('backend.admin.layouts.style') --}}
    @include('backend.layouts.styles')
</head>

<body main-theme-layout="ltr" x-data="{ overflow_y: true }" :class="[!overflow_y ? 'overflow-hidden' : '']">
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="loader">
            <div class="whirly-loader"></div>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <!-- Page Header Start-->
        @include('backend.layouts.header')
        <!-- Page Header Ends -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->


            @include('backend.' . authUserFolder() . '.sidebar')

            <!-- Right sidebar Ends-->
            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col col-md-10">
                                <div class="page-header-left">
                                    <h3>@yield('breadcrumb-title')</h3>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="">
                                                <i data-feather="home"></i>
                                            </a>
                                        </li>
                                        @yield('breadcrumb-items')
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
                <div class="container-fluid">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('info'))
                        <div class="alert alert-info">
                            {{ session('info') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif
                </div>
                @yield('content')
            </div>
            <!-- footer start-->
            @include('backend.layouts.footer')
        </div>
    </div>
    <!-- latest jquery-->
    {{-- @include('backend.layouts.script') --}}
    @include('backend.layouts.scripts')
    <!-- sweetalert -->
    @include('sweetalert::alert')
    <!-- Plugin used-->
</body>

</html>
