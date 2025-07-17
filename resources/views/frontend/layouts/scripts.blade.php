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

 <script src="{{ asset('assets/frontend/js/pagenav.js') }}"></script>
 <script src="{{ asset('assets/frontend/js/product-filter.js') }}"></script>

 <!-- main-js -->
 <script src="{{ asset('assets/frontend/js/script.js') }}"></script>
 
 <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript">
 </script>
 <script src="{{ asset('js/frontend/home/update-language.js') }}"></script>


 @yield('scripts')
 @stack('scripts')