<div class="page-main-header">
    <div class="main-header-right row">
        <div class="main-header-left col-auto px-0 d-lg-none">
            <div class="logo-wrapper">
                <a href="">
                    <img src="{{ asset('img/logo3.png') }}" alt="" class="mydoc-logo">
                </a>
            </div>
        </div>
        <div class="vertical-mobile-sidebar col-auto ps-3 d-none"><i class="fa fa-bars sidebar-bar"></i></div>
        <div class="mobile-sidebar col-auto ps-0 d-block">
            <div class="media-body switch-sm">
                <label class="switch"><a href="#"><i id="sidebar-toggle"
                            data-feather="align-left"></i></a></label>
            </div>
        </div>
        <div class="nav-right col p-0">
            <ul class="nav-menus">
                <li>
                    
                </li>
                <li>
                    <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                        <i data-feather="maximize"></i>
                    </a>
                </li>
                <li class="onhover-dropdown">
                    <div class="media align-items-center">
                        <img class="align-self-center pull-right rounded-circle"
                            src="{{ Auth::user()->profile_photo_url }}" referrerpolicy="no-referrer" alt="header-user"
                            style="width:50px;">
                        <div class="dotted-animation">
                            <span class="animate-circle"></span>
                            <span class="main-circle"></span>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div p-20">

                        <li><a href="{{ url('user/profile') }}"><i data-feather="user"></i> My Account</a></li>
                        @can('doctor')
                            @if (auth()->user()->memberRegister && auth()->user()->memberRegister->status === 1)
                                <li><a href="{{ route('service-provider.education') }}"><i
                                            data-feather="book-open"></i>Education</a></li>
                                <li><a href="{{ route('service-provider.workDetails') }}"><i data-feather="briefcase"></i>Work
                                        Exp.</a></li>
                            @endif
                        @endcan
                        <li class="pb-0">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                         this.closest('form').submit();">
                                    <i data-feather="log-out"></i> {{ __('Logout') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
        </div>
        <script id="result-template" type="text/x-handlebars-template">
             <div class="ProfileCard u-cf">
             <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
             <div class="ProfileCard-details">
             <div class="ProfileCard-realName">@{{ name }}</div>
             </div>
             </div>
           </script>
        <script id="empty-template" type="text/x-handlebars-template">
             <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
           </script>
    </div>
</div>
