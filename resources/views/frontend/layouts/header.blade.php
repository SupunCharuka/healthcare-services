       <!-- main header -->
       <header class="main-header style-two">
           <div class="header-top">
               <!-- header-top -->
               <div class="auto-container">
                   <div class="top-inner">
                       <div class="row">

                           <div class="col-lg-6  ">

                               <ul class="info clearfix top-icon mt-1">

                                   <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                   <li><a href=""><i class="fab fa-whatsapp"></i></a></li>
                                   <li><a href=""><i class="fab fa-instagram"></i></a></li>
                                   <li><a href=""><i class=" fab fa-youtube"></i></a></li>
                               </ul>
                           </div>

                           <div class="col-lg-6  ">
                               <div class="top-right pull-right">
                                   <ul class="info clearfix top">
                                       <li class="top-nav-bar">
                                           <i class="fas fa-phone  top1"></i> &nbsp;<a href="tel:+9471 234 5678">+9471
                                               234 5678</a>
                                       </li>
                                       <li class="top-nav-bar">
                                           <i class="fas fa-envelope top1 ">
                                           </i> &nbsp;<a href="mailto:support@healthcare.lk">support@healthcare.lk</a>
                                       </li>
                                       {{-- <li>
                                           <div class="d-flex">
                                               <!-- Code provided by Google -->
                                               <div id="google_translate_element"></div>
                                           </div>
                                       </li> --}}

                                   </ul>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <!-- header-lower -->
           <div class="header-lower" style="background: white">
               <div class="auto-container">
                   <div class="outer-box">
                       <div class="logo-box">
                           <figure class="logo"><a href="{{ url('') }}"><img src="{{ asset('img/logo3.png') }}"
                                       alt=""></a>
                           </figure>
                       </div>
                       <div class="menu-area">
                           <!--Mobile Navigation Toggler-->
                           <div class="mobile-nav-toggler">
                               <i class="icon-bar"></i>
                               <i class="icon-bar"></i>
                               <i class="icon-bar"></i>
                           </div>
                           <nav class="main-menu navbar-expand-md navbar-light">
                               <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                   <ul class="navigation clearfix">
                                       <li class="{{ Route::currentRouteName() === '/' ? 'current' : '' }}"><a
                                               href="{{ url('') }}">Home</a>
                                       </li>
                                       <li
                                           class="{{ Route::currentRouteName() === 'public.serviceCategory' ? 'current' : '' }}">
                                           <a href="{{ route('public.serviceCategory') }}">Services</a>
                                       </li>
                                       <li
                                           class="{{ Route::currentRouteName() === 'public.product' ? 'current' : '' }}">
                                           <a href="{{ route('public.product') }}">Healthcare Products</a>
                                       </li>
                                       <li
                                           class="{{ Route::currentRouteName() === 'public.userGuide' ? 'current' : '' }}">
                                           <a href="{{ route('public.userGuide') }}">User Guide</a>
                                       </li>
                                       <li
                                           class="{{ Route::currentRouteName() === 'public.aboutUs' ? 'current' : '' }}">
                                           <a href="{{ route('public.aboutUs') }}">About Us</a>
                                       </li>
                                       <div class="mobile-menu-new">
                                           @guest
                                               <li class=""><a href="{{ route('login') }}">My Account</a></li>
                                           @endguest
                                           @auth
                                               <li class=""><a
                                                       href="{{ route(authUserFolder() . '.dashboard') }}">Dashboard</a>
                                               </li>
                                           @endauth
                                       </div>
                                   </ul>
                               </div>
                           </nav>
                       </div>
                       @guest
                           <div class="btn-box">
                               <a href="{{ route('login') }}" class="theme-btn-one">
                                   <i class="fas fa-user"></i>My Account
                               </a>
                           </div>
                       @endguest

                       @auth
                           <div class="btn-box">
                               <a href="{{ route(authUserFolder() . '.dashboard') }}" class="theme-btn-one">
                                   <i class="fas fa-tv"></i>Dashboard
                               </a>
                           </div>
                       @endauth
                   </div>
               </div>
           </div>
           <!--sticky Header-->
           <div class="sticky-header">
               <div class="auto-container">
                   <div class="outer-box">
                       <div class="logo-box">
                           <figure class="logo"><a href="{{ url('') }}"><img
                                       src="{{ asset('img/logo3.png') }}" alt=""></a>
                           </figure>
                       </div>
                       <div class="menu-area">
                           <nav class="main-menu clearfix">
                               <!--Keep This Empty / Menu will come through Javascript-->
                           </nav>
                       </div>
                       @guest
                           <div class="btn-box">
                               <a href="{{ route('login') }}" class="theme-btn-one">
                                   <i class="fas fa-user"></i>My Account
                               </a>
                           </div>
                       @endguest

                       @auth
                           <div class="btn-box">
                               <a href="{{ route(authUserFolder() . '.dashboard') }}" class="theme-btn-one">
                                   <i class="fas fa-tv"></i>Dashboard
                               </a>
                           </div>
                       @endauth

                   </div>
               </div>
           </div>
       </header>
       <!-- Mobile Menu -->
       <div class="mobile-menu">
           <div class="menu-backdrop"></div>
           <div class="close-btn"><i class="fas fa-times"></i></div>
           <nav class="menu-box">
               <div class="nav-logo"><a href="{{ url('') }}"><img src="{{ asset('img/footer-logo.png') }}"
                           alt="" title=""></a>
               </div>
               <div class="menu-outer">
                   <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
               </div>
               <div class="contact-info">
                   <h4>Contact Info</h4>
                   <ul>
                       <li>Hirimbura Cross Road, Galle 80000</li>
                       <li><a href="tel:+9470 305 8585">+9470 305 8585</a></li>
                       <li><a href="mailto:support@healthcare.lk">support@healthcare.lk</a></li>
                   </ul>
               </div>
               <div class="social-links">
                   <ul class="clearfix">
                       <li><a href=""><span class="fab fa-twitter"></span></a></li>
                       <li><a href=""><span class="fab fa-facebook-square"></span></a></li>
                       <li><a href=""><span class="fab fa-pinterest-p"></span></a></li>
                       <li><a href=""><span class="fab fa-instagram"></span></a></li>
                       <li><a href=""><span class="fab fa-youtube"></span></a></li>
                   </ul>
               </div>
           </nav>
       </div>
       <!-- End Mobile Menu -->
   