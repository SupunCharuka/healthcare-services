<!-- latest jquery-->
<script src="{{ asset('assets/backend/js/jquery-3.6/jquery-3.6.0.min.js') }}"></script>


<!-- Bootstrap js-->
<script src="{{ asset('assets/backend/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
    integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
</script>
@powerGridScripts
@if (!str_contains(url()->current(), 'user/profile'))
    <script src="{{ asset('js/app.js') }}"></script>
@endif

<!-- feather icon js-->
<script src="{{ asset('assets/backend/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/icons/feather-icon/feather-icon.js') }}"></script>
<!-- Sidebar jquery-->
<script src="{{ asset('assets/backend/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('assets/backend/js/config.js') }}"></script>
<!-- Plugins JS start-->
<script src="{{ asset('assets/backend/js/owlcarousel/owl.carousel.js') }}"></script>
@yield('scripts')
@stack('scripts')
<script src="{{ asset('assets/backend/js/chat-menu.js') }}"></script>
<script src="{{ asset('assets/backend/js/tooltip-init.js') }}"></script>
<script src="{{ asset('assets/backend/js/script.js') }}"></script>
<script src="{{ asset('assets/backend/js/theme-customizer/customizer.js') }}"></script>

<script src="{{ asset('assets/backend/js/notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/notify/index.js') }}"></script>
<script>
    var bs_rtl_js = "{{ asset('assets/backend/css/bootstrap.rtl.min.css') }}";
</script>
@include('backend.layouts.customize-bar')

