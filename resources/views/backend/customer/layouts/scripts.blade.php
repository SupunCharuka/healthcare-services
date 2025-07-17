
 <script src="{{ asset('js/app.js') }}"></script>

 <!-- jequery plugins -->
 <script src="{{ asset('assets/frontend/js/jquery.js') }}"></script>
 <script src="{{ asset('assets/frontend/js/popper.min.js') }}"></script>
 <script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('assets/frontend/js/owl.js') }}"></script>
 <script src="{{ asset('assets/frontend/js/wow.js') }}"></script>
 <script src="{{ asset('assets/frontend/js/validation.js') }}"></script>
 <script src="{{ asset('assets/frontend/js/jquery.fancybox.js') }}"></script>
 <script src="{{ asset('assets/frontend/js/appear.js') }}"></script>
 <script src="{{ asset('assets/frontend/js/scrollbar.js') }}"></script>
 <script src="{{ asset('assets/frontend/js/tilt.jquery.js') }}"></script>
 <script src="{{ asset('assets/frontend/js/jquery.nice-select.min.js') }}"></script>


 <!-- main-js -->
 <script src="{{ asset('assets/frontend/js/script.js') }}"></script>

 <script src="{{ asset('assets/frontend/js/jquery.paroller.min.js') }}"></script>
 <script src="{{ asset('assets/frontend/js/product-filter.js') }}"></script>

 <!-- map script -->
 {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-CE0deH3Jhj6GN4YvdCFZS7DpbXexzGU"></script>
 <script src="{{ asset('assets/frontend/js/gmaps.js') }}"></script>
 <script src="{{ asset('assets/frontend/js/map-helper.js') }}"></script> --}}

 @yield('scripts')
 @stack('scripts')
