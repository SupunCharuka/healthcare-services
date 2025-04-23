  <!--HOME SLIDER-->
  <script src="{{ asset('assets/frontend/plugins/iview/js/iview.js') }}"></script>
  <script src="{{ asset('assets/frontend/plugins/rendro-easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>

  <!-- SCRIPTS -->
  <script type="text/javascript" src="{{ asset('assets/frontend/plugins/isotope/jquery.isotope.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/js/waypoints.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/plugins/bxslider/jquery.bxslider.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/plugins/prettyphoto/js/jquery.prettyPhoto.js') }}"></script>
  <script src="{{ asset('assets/frontend/ajax/libs/jquery-easing/1.3/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/plugins/datetimepicker/jquery.datetimepicker.js') }}"></script>
  <script src="{{ asset('assets/frontend/plugins/jelect/jquery.jelect.js') }}"></script>
  <script src="{{ asset('assets/frontend/plugins/nouislider/jquery.nouislider.all.min.js') }}"></script>

  <!-- Loader -->
  <script src="{{ asset('assets/frontend/plugins/loader/js/classie.js') }}"></script>
  <script src="{{ asset('assets/frontend/plugins/loader/js/pathLoader.js') }}"></script>
  <script src="{{ asset('assets/frontend/plugins/loader/js/main.js') }}"></script>
  <script src="{{ asset('assets/frontend/js/classie.js') }}"></script>
  <!--THEME-->
  <script src="{{ asset('assets/frontend/js/cssua.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/js/wow.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/js/custom.js') }}"></script>

  @yield('scripts')
  @stack('scripts')