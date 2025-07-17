<!-- main header -->
<header class="main-header customer-header style-three">

    <!-- header-lower -->
    <div class="header-lower" style="background: white">
        <div class="auto-container">
            <div class="outer-box mobile-menu-display">
                <div class="logo-box ">
                    <figure class="logo mb-0"><a href="{{ url('') }}"><img src="{{ asset('img/logo3.png') }}"
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
                        <div class="collapse navbar-collapse show clearfix mobile-display" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="{{ Route::currentRouteName() === '/' ? 'current' : '' }}"><a
                                        href="{{ url('') }}">Home</a>
                                </li>
                                <li
                                    class="{{ Route::currentRouteName() === 'public.serviceCategory' ? 'current' : '' }}">
                                    <a href="{{ route('public.serviceCategory') }}">Services</a>
                                </li>
                                <li class="{{ Route::currentRouteName() === 'public.product' ? 'current' : '' }}">
                                    <a href="{{ route('public.product') }}">Healthcare Products</a>
                                </li>
                                <li class="{{ Route::currentRouteName() === 'public.userGuide' ? 'current' : '' }}">
                                    <a href="{{ route('public.userGuide') }}">User Guide</a>
                                </li>
                                <li class="{{ Route::currentRouteName() === 'public.aboutUs' ? 'current' : '' }}">
                                    <a href="{{ route('public.aboutUs') }}">About Us</a>
                                </li>
                            </ul>


                        </div>
                    </nav>
                </div>
                <div class="btn-box"><a href="{{ url('') }}" class="theme-btn-one"><i
                            class="icon-image"></i>Home</a></div>
            </div>
        </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="auto-container">
            <div class="outer-box">
                <div class="logo-box">
                    <figure class="logo mb-0"><a href="{{ url('') }}"><img src="{{ asset('img/logo3.png') }}"
                                alt=""></a></figure>
                </div>
                <div class="menu-area">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
                <div class="btn-box"><a href="{{ url('') }}" class="theme-btn-one"><i
                            class="icon-image"></i>Home</a></div>
            </div>
        </div>
    </div>
</header>
<!-- main-header end -->

@if (!Route::is('guest.invoice'))
    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><i class="fas fa-times"></i></div>

        <nav class="menu-box">
            <div class="menu-outer">
                <div class="profile-box patient-profile">
                    <div class="upper-box mb-4">
                        <div class="cover-image">
                            <img src="{{ asset('img/logo3.png') }}" alt="Cover Image">
                        </div>
                        <figure class="profile-image mb-4">
                            @if (Auth::user()->provider_name === 'facebook')
                                <img src="{{ Auth::user()->facebook_avatar }}" alt="Facebook Profile Photo">
                            @elseif (Auth::user()->provider_name === 'google')
                                <img src="{{ Auth::user()->google_avatar }}" alt="Google Profile Photo">
                            @else
                                <img src="{{ asset(Auth::user()->profile_photo_url) }}" alt="Default Profile Photo">
                            @endif
                        </figure>
                        <div class="title-box centred m-0">
                            <div class="inner p-0">
                                <h3>{{ Auth::user()->name }}</h3>
                                <p><i class="fas fa-mail-bulk"></i>{{ Auth::user()->email }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="profile-info">
                        <ul class="list clearfix">
                            <li><a href="{{ route('customer.dashboard') }}"
                                    class="{{ Route::currentRouteName() === 'customer.dashboard' ? 'current' : '' }}"><i
                                        class="fas fa-tv"></i>Dashboard</a></li>

                            <li><a href="{{ route('customer.myOrders') }}"
                                    class="{{ Route::currentRouteName() === 'customer.myOrders' ? 'current' : '' }}"><i
                                        class="fas fa-comments"></i>My Orders</a></li>

                            <li><a href="{{ route('customer.invoice.list') }}"
                                    class="{{ Route::currentRouteName() === 'customer.invoice.list' ? 'current' : '' }}"><i
                                        class="fas fa-file ml-1"></i>My Invoice</a></li>

                            <li><a href="{{ route('customer.myInquiry') }}"
                                    class="{{ Route::currentRouteName() === 'customer.myInquiry' ? 'current' : '' }}"><i
                                        class="fas fa-folder"></i>My Inquiries</a></li>

                            <li><a href="{{ route('customer.myReviews') }}"
                                    class="{{ Route::currentRouteName() === 'customer.myReviews' ? 'current' : '' }}"><i
                                        class="fas fa-comments"></i>My Reviews</a></li>

                            <li><a href="{{ route('customer.healthProfile') }}"
                                    class="{{ Route::currentRouteName() === 'customer.healthProfile' ? 'current' : '' }}"><i
                                        class="fas fa-folder"></i>My Health Profile</a></li>

                            <li><a href="{{ route('profile.show') }}"
                                    class="{{ Route::currentRouteName() === 'profile.show' ? 'current' : '' }}"><i
                                        class="fas fa-user"></i>My Profile</a></li>

                            <li><a href="{{ route('customer.messages') }}"
                                    class="{{ Route::currentRouteName() === 'customer.messages' ? 'current' : '' }}"><i
                                        class="fas fa-comments"></i>Messages</a></li>

                            <li><a href="{{ route('customer.supportTicket') }}"
                                    class="{{ Route::currentRouteName() === 'customer.supportTicket' ? 'current' : '' }}"><i
                                        class="fas fa-question-circle"></i>Suppot Ticket</a></li>

                            <li>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                   this.closest('form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                </form>

                        </ul>
                    </div>
                </div>
            </div>

        </nav>
    </div><!-- End Mobile Menu -->
@endif
