<script type="text/javascript">
    let APP_URL = {!! json_encode(url('/')) !!}
    let DISK_URL = {!! json_encode(storage('/')) !!}
    let _TOKEN = "{!! csrf_token() !!}"
 </script>
 <!-- Google Fonts -->
 <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">

 <!-- Stylesheets -->
 <link href="{{ asset('assets/frontend/css/font-awesome-all.css') }}" rel="stylesheet">
 <link href="{{ asset('assets/frontend/css/flaticon.css') }}" rel="stylesheet">
 <link href="{{ asset('assets/frontend/css/owl.css') }}" rel="stylesheet">
 <link href="{{ asset('assets/frontend/css/bootstrap.css') }}" rel="stylesheet">
 <link href="{{ asset('assets/frontend/css/jquery.fancybox.min.css') }}" rel="stylesheet">
 <link href="{{ asset('assets/frontend/css/animate.css') }}" rel="stylesheet">
 <link href="{{ asset('assets/frontend/css/color.css') }}" rel="stylesheet">
 <link href="{{ asset('assets/frontend/css/style.css') }}" rel="stylesheet">
 <link href="{{ asset('assets/frontend/css/responsive.css') }}" rel="stylesheet">

 <link href="{{ asset('assets/frontend/css/custom.css') }}" rel="stylesheet">
 <link href="{{ asset('assets/frontend/css/custom-responsive.css') }}" rel="stylesheet">

 @yield('styles')

