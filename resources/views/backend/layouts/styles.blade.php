 <script type="text/javascript">
    let APP_URL = {!! json_encode(url('/')) !!}
    let DISK_URL = {!! json_encode(storage('/')) !!}
    let _TOKEN = "{!! csrf_token() !!}"
 </script> 
 <link rel="stylesheet" type="text/css" href="{{ asset('css/app-jetstream.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
 <style>
    .page-wrapper .page-body-wrapper .page-body {
       background-color: #ebebeb !important;
    }
 
    img,
    svg,
    video,
    canvas,
    audio,
    iframe,
    embed,
    object {
       display: unset
    }
 
    table.dataTable>tbody>tr.child span.dtr-title::after {
       content: ' : '
    }
 </style>
 <!-- Google font-->
 <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
 <!-- Font Awesome-->
 <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/fontawesome.css') }}">
 <!-- ico-font-->
 <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/icofont.css') }}">
 <!-- Themify icon-->
 <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/themify.css') }}">
 <!-- Flag icon-->
 <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/flag-icon.css') }}">
 <!-- Feather icon-->
 <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/feather-icon.css') }}">
 @yield('styles')
 <!-- Bootstrap css-->
 <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/bootstrap.css') }}" defer>
 <link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap/bootstrap.min.css') }}">
 <link id="bootstrap-file" rel="stylesheet" type="text/css">
 <!-- App css-->
 <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/style.css') }}">
 <link rel="stylesheet" type="text/css" id="color" href="{{ asset('assets/backend/css/color-1.css') }}" media="screen">
 <!-- Responsive css-->
 <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/responsive.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/owlcarousel.css') }}">

 <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/custom.css') }}">
 
 <!-- Livewire -->
 @livewireStyles
 @powerGridStyles
 @yield('high_priority_scripts')
 @livewireScripts
 