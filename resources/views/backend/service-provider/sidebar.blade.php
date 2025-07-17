<!-- Page Sidebar Start-->
<div class="page-sidebar color2-sidebar" sidebar-layout="border-sidebar">
    <div class="main-header-left d-none d-lg-block bg-white">
        <div class="logo-wrapper">
            <a href="{{ url('') }}">
                <img src="{{ asset('img/logo3.png') }}" alt="" class="mydoc-logo">
            </a>
        </div>
    </div>
    <div class="sidebar custom-scrollbar">
        <div class="sidebar-user text-center">
            <div>
                <img class="rounded-circle" src="{{ asset(Auth::user()->profile_photo_url) }}"
                    referrerpolicy="no-referrer" style="width:60px;" alt="#">
                <div class="profile-edit">
                    <a href="{{ url('user/profile') }}" target="_blank"><i data-feather="edit"></i></a>
                </div>
            </div>
            <h6 class="mt-3 f-14">{{ Auth::user()->name }}</h6>
            <p>{{ Auth::user()->getRoleNames()->first() }}</p>
        </div>
        <ul class="sidebar-menu">

            <li class="{{ Route::currentRouteName() === 'service-provider.dashboard' ? 'active' : '' }}">
                <a class="sidebar-header" href="{{ route('service-provider.dashboard') }}"><i data-feather="home"></i>
                    <span>{{ trans('Dashboard') }}</span></a>
            </li>

            @can('doctor')
                @if (auth()->user()->memberRegister && auth()->user()->memberRegister->status != 1)
                    <li class="{{ Route::currentRouteName() === 'service-provider.bioData' ? 'active' : '' }}">
                        <a class="sidebar-header" href="{{ route('service-provider.bioData') }}"><i
                                data-feather="book"></i>
                            <span>{{ trans('Bio data') }}</span></a>
                    </li>
                @endif
            @endcan
            @can('doctor.access')
                <li class="{{ Route::currentRouteName() === 'service-provider.messages' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('service-provider.messages') }}"><i
                            data-feather="message-square"></i>
                        <span>{{ trans('Messages') }}</span></a>
                </li>

                <li class="{{ Route::currentRouteName() === 'service-provider.service' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('service-provider.service') }}"><i
                            data-feather="bar-chart"></i>
                        <span>{{ trans('My Service') }}</span></a>
                </li>

                <li class="{{ Route::currentRouteName() === 'service-provider.inquiry' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('service-provider.inquiry') }}"><i data-feather="mail"></i>
                        <span>{{ trans('My Inquiry') }}</span></a>
                </li>

                <li class="{{ Route::currentRouteName() === 'service-provider.availability.index' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('service-provider.availability.index') }}"><i
                            data-feather="calendar"></i>
                        <span>{{ trans('My Availability') }}</span></a>
                </li>

                <li class="{{ Route::currentRouteName() === 'service-provider.reviews' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('service-provider.reviews') }}"><i data-feather="folder"></i>
                        <span>{{ trans('My Reviews') }}</span></a>
                </li>

                {{-- <li
                    class="{{ in_array(Route::currentRouteName(), ['service-provider.commission.payout', 'service-provider.commission.payout.paid', 'service-provider.commission.payout.unpaid']) ? 'active' : '' }}">
                    <a class="sidebar-header" href="#"><i data-feather="percent"></i><span>Commission Payout</span><i
                            class="fa fa-angle-right pull-right"></i></a>
                    <ul class="sidebar-submenu">

                        <li><a href="{{ route('service-provider.commission.payout') }}"
                                class="{{ Route::currentRouteName() == 'service-provider.commission.payout' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>All</a></li>
                        <li><a href="{{ route('service-provider.commission.payout.paid') }}"
                                class="{{ Route::currentRouteName() == 'service-provider.commission.payout.paid' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Paid</a></li>
                        <li><a href="{{ route('service-provider.commission.payout.unpaid') }}"
                                class="{{ Route::currentRouteName() == 'service-provider.commission.payout.unpaid' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Unpaid</a></li>


                    </ul>

                </li> --}}
            @endcan


            @can('service-provider')
                <li class="{{ Route::currentRouteName() === 'service-provider.profile' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('service-provider.profile') }}"><i data-feather="user"></i>
                        <span>{{ trans('Business Profile') }}</span></a>
                </li>
            @endcan

            @can('service-provider.access')
                <li class="{{ Route::currentRouteName() === 'service-provider.inquiry' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('service-provider.inquiry') }}"><i data-feather="mail"></i>
                        <span>{{ trans('My Enquiries') }}</span></a>
                </li>
                <li class="{{ Route::currentRouteName() === 'service-provider.messages' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('service-provider.messages') }}"><i
                            data-feather="message-square"></i>
                        <span>{{ trans('Messages') }}</span></a>
                </li>

                <li class="{{ Route::currentRouteName() === 'service-provider.service' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('service-provider.service') }}"><i
                            data-feather="bar-chart"></i>
                        <span>{{ trans('My Services') }}</span></a>
                </li>

                <li class="{{ Route::currentRouteName() === 'service-provider.availability.index' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('service-provider.availability.index') }}"><i
                            data-feather="calendar"></i>
                        <span>{{ trans('My Availability') }}</span></a>
                </li>

                <li
                class="{{ in_array(Route::currentRouteName(), ['service-provider.commission.payout', 'service-provider.commission.payout.paid', 'service-provider.commission.payout.unpaid']) ? 'active' : '' }}">
                <a class="sidebar-header" href="#"><i data-feather="percent"></i><span>Commission Payout</span><i
                        class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">

                    <li><a href="{{ route('service-provider.commission.payout') }}"
                            class="{{ Route::currentRouteName() == 'service-provider.commission.payout' ? 'active' : '' }}"><i
                                class="fa fa-circle"></i>All</a></li>
                    <li><a href="{{ route('service-provider.commission.payout.paid') }}"
                            class="{{ Route::currentRouteName() == 'service-provider.commission.payout.paid' ? 'active' : '' }}"><i
                                class="fa fa-circle"></i>Paid</a></li>
                    <li><a href="{{ route('service-provider.commission.payout.unpaid') }}"
                            class="{{ Route::currentRouteName() == 'service-provider.commission.payout.unpaid' ? 'active' : '' }}"><i
                                class="fa fa-circle"></i>Unpaid</a></li>


                </ul>

            </li>
            @endcan

            <li class="{{ Route::currentRouteName() === 'service-provider.orders' ? 'active' : '' }}">
                <a class="sidebar-header" href="{{ route('service-provider.orders') }}"><i
                        data-feather="shopping-bag"></i>
                    <span>{{ trans('My Orders') }}</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'service-provider.tickets.index' ? 'active' : '' }}">
                <a class="sidebar-header" href="{{ route('service-provider.tickets.index') }}"><i
                        data-feather="help-circle"></i>
                    <span>{{ trans('Support Ticket') }}</span></a>
            </li>


            {{-- @include('navigation-menu') --}}
        </ul>
    </div>
</div>
<!-- Page Sidebar Ends-->
