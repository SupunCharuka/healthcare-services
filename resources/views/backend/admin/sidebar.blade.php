<!-- Page Sidebar Start-->
<div class="page-sidebar color2-sidebar" sidebar-layout="border-sidebar">
    <div class="main-header-left d-none d-lg-block bg-white">
        <div class="logo-wrapper">
            <a href="{{ url('') }}" target="_blank">
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
            <li class="{{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : '' }}">
                <a class="sidebar-header" href="{{ route('admin.dashboard') }}"><i data-feather="home"></i>
                    <span>{{ trans('Dashboard') }}</span></a>
            </li>

            @can('inquiry.view')
                <li
                    class="{{ in_array(Route::currentRouteName(), ['admin.getInquiry', 'admin.pendingInquiries', 'admin.completedInquiries', 'admin.rejectedInquiries', 'admin.confirmInquiries', 'admin.unpaidInquiries']) ? 'active' : '' }}">
                    <a class="sidebar-header" href="#"><i data-feather="database"></i><span>Inquiries</span><i
                            class="fa fa-angle-right pull-right"></i></a>
                    <ul class="sidebar-submenu">

                        <li><a href="{{ route('admin.getInquiry') }}"
                                class="{{ Route::currentRouteName() == 'admin.getInquiry' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>All</a></li>
                        <li><a href="{{ route('admin.pendingInquiries') }}"
                                class="{{ Route::currentRouteName() == 'admin.pendingInquiries' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Pending</a></li>
                        <li><a href="{{ route('admin.unpaidInquiries') }}"
                                class="{{ Route::currentRouteName() == 'admin.unpaidInquiries' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Unpaid</a></li>
                        <li><a href="{{ route('admin.confirmInquiries') }}"
                                class="{{ Route::currentRouteName() == 'admin.confirmInquiries' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>confirmed</a></li>
                        <li><a href="{{ route('admin.completedInquiries') }}"
                                class="{{ Route::currentRouteName() == 'admin.completedInquiries' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Completed</a></li>
                        <li><a href="{{ route('admin.rejectedInquiries') }}"
                                class="{{ Route::currentRouteName() == 'admin.rejectedInquiries' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Rejected</a></li>


                    </ul>

                </li>
            @endcan

            @can('manage-doctor.manage')
                <li
                    class="{{ in_array(Route::currentRouteName(), ['admin.getDoctorsList', 'admin.pendingDoctors', 'admin.approvedDoctors', 'admin.rejectedDoctors']) ? 'active' : '' }}">
                    <a class="sidebar-header" href="javascript:void(0)"><i
                            data-feather="user-check"></i><span>{{ trans('Manage Doctors') }}</span><i
                            class="fa fa-angle-right pull-right"></i></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('admin.getDoctorsList') }}"
                                class="{{ Route::currentRouteName() == 'admin.getDoctorsList' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>All Doctors</a></li>
                        <li><a href="{{ route('admin.pendingDoctors') }}"
                                class="{{ Route::currentRouteName() == 'admin.pendingDoctors' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Pending Doctors</a></li>
                        <li><a href="{{ route('admin.approvedDoctors') }}"
                                class="{{ Route::currentRouteName() == 'admin.approvedDoctors' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Approved Doctors</a></li>
                        <li><a href="{{ route('admin.rejectedDoctors') }}"
                                class="{{ Route::currentRouteName() == 'admin.rejectedDoctors' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Rejected Doctors</a></li>
                    </ul>
                </li>
            @endcan

            @can('service-provider.manage')
                <li
                    class="{{ in_array(Route::currentRouteName(), ['admin.serviceProvider', 'admin.pendingServiceProviders', 'admin.approvedServiceProviders', 'admin.rejectedServiceProviders']) ? 'active' : '' }}">
                    <a class="sidebar-header" href="javascript:void(0)"><i
                            data-feather="briefcase"></i><span>{{ trans('Manage Service Provi.') }}</span><i
                            class="fa fa-angle-right pull-right"></i></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('admin.serviceProvider') }}"
                                class="{{ Route::currentRouteName() == 'admin.serviceProvider' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>All Service Provi.</a></li>
                        <li><a href="{{ route('admin.pendingServiceProviders') }}"
                                class="{{ Route::currentRouteName() == 'admin.pendingServiceProviders' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Pending Service Provi.</a></li>
                        <li><a href="{{ route('admin.approvedServiceProviders') }}"
                                class="{{ Route::currentRouteName() == 'admin.approvedServiceProviders' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Approved Service Provi.</a></li>
                        <li><a href="{{ route('admin.rejectedServiceProviders') }}"
                                class="{{ Route::currentRouteName() == 'admin.rejectedServiceProviders' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Rejected Service Provi.</a></li>
                    </ul>
                </li>
            @endcan

            @can('reports.payment')
                <li
                    class="{{ in_array(Route::currentRouteName(), ['admin.paymentInvoice.all', 'admin.paymentInvoice.paid', 'admin.paymentInvoice.pending', 'admin.paymentInvoice.unpaid']) ? 'active' : '' }}">
                    <a class="sidebar-header" href="#"><i data-feather="file-text"></i><span>Payment Invoice</span><i
                            class="fa fa-angle-right pull-right"></i></a>
                    <ul class="sidebar-submenu">

                        <li><a href="{{ route('admin.paymentInvoice.all') }}"
                                class="{{ Route::currentRouteName() == 'admin.paymentInvoice.all' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>All</a></li>
                        <li><a href="{{ route('admin.paymentInvoice.paid') }}"
                                class="{{ Route::currentRouteName() == 'admin.paymentInvoice.paid' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Paid</a></li>
                        <li><a href="{{ route('admin.paymentInvoice.pending') }}"
                                class="{{ Route::currentRouteName() == 'admin.paymentInvoice.pending' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Pending</a></li>
                        <li><a href="{{ route('admin.paymentInvoice.unpaid') }}"
                                class="{{ Route::currentRouteName() == 'admin.paymentInvoice.unpaid' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Unpaid</a></li>


                    </ul>

                </li>

                <li
                    class="{{ in_array(Route::currentRouteName(), ['admin.commission', 'admin.commission.paid', 'admin.commission.notPaid']) ? 'active' : '' }}">
                    <a class="sidebar-header" href="#"><i data-feather="percent"></i><span>Commissions</span><i
                            class="fa fa-angle-right pull-right"></i></a>
                    <ul class="sidebar-submenu">

                        <li><a href="{{ route('admin.commission') }}"
                                class="{{ Route::currentRouteName() == 'admin.commission' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>All</a></li>
                        <li><a href="{{ route('admin.commission.paid') }}"
                                class="{{ Route::currentRouteName() == 'admin.commission.paid' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Paid</a></li>
                        <li><a href="{{ route('admin.commission.notPaid') }}"
                                class="{{ Route::currentRouteName() == 'admin.commission.notPaid' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Unpaid</a></li>


                    </ul>

                </li>
            @endcan

            @can('reports')
                <li
                    class="{{ in_array(Route::currentRouteName(), ['admin.reports.serviceProviders', 'admin.reports.doctors', 'admin.reports.services', 'admin.reports.customers', 'admin.reports.inquiries', 'admin.reports.paymentInvoices']) ? 'active' : '' }}">
                    <a class="sidebar-header" href="#"><i data-feather="file-text"></i><span>Reports</span><i
                            class="fa fa-angle-right pull-right"></i></a>
                    <ul class="sidebar-submenu">

                        <li><a href="{{ route('admin.reports.serviceProviders') }}"
                                class="{{ Route::currentRouteName() == 'admin.reports.serviceProviders' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Service Providers</a></li>

                        <li><a href="{{ route('admin.reports.doctors') }}"
                                class="{{ Route::currentRouteName() == 'admin.reports.doctors' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Doctors</a></li>

                        <li><a href="{{ route('admin.reports.services') }}"
                                class="{{ Route::currentRouteName() == 'admin.reports.services' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Services</a></li>

                        <li><a href="{{ route('admin.reports.customers') }}"
                                class="{{ Route::currentRouteName() == 'admin.reports.customers' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Customers</a></li>

                        <li><a href="{{ route('admin.reports.inquiries') }}"
                                class="{{ Route::currentRouteName() == 'admin.reports.inquiries' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Inquiries</a></li>

                        <li><a href="{{ route('admin.reports.paymentInvoices') }}"
                                class="{{ Route::currentRouteName() == 'admin.reports.paymentInvoices' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Payment Inovices</a></li>
                    </ul>

                </li>
            @endcan


            <li class="{{ Route::currentRouteName() === 'service-provider.adminTickets.index' ? 'active' : '' }}">
                <a class="sidebar-header" href="{{ route('service-provider.adminTickets.index') }}"><i
                        data-feather="help-circle"></i>
                    <span>{{ trans('Support Ticket') }}</span></a>
            </li>

            @can('all-member.view')
                <li class="{{ Route::currentRouteName() === 'admin.getMembers' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('admin.getMembers') }}"><i data-feather="folder-plus"></i>
                        <span>{{ trans('Users') }}</span></a>
                </li>

                <li class="{{ Route::currentRouteName() === 'admin.customers' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('admin.customers') }}"><i data-feather="minimize-2"></i>
                        <span>{{ trans('Customers') }}</span></a>
                </li>
            @endcan

            @can('business.manage')
                <li class="{{ Route::currentRouteName() === 'admin.businessProfile' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('admin.businessProfile') }}"><i
                            data-feather="shopping-bag"></i>
                        <span>{{ trans('Business Profiles') }}</span></a>
                </li>
            @endcan

            @can('users.viewAny')
                <li class="{{ Route::currentRouteName() === 'admin.manage-user' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('admin.manage-user') }}"><i data-feather="users"></i>
                        <span>{{ trans('Manage Users') }}</span></a>
                </li>
            @endcan

            @can('users.manage-role-permissions')
                <li
                    class="{{ Str::contains(Route::currentRouteName(), ['admin.role', 'admin.permission']) ? 'active' : '' }}">
                    <a class="sidebar-header" href="javascript:void(0)"><i data-feather="sliders"></i>
                        <span> Roles/Permissions </span>
                        <i class="fa fa-angle-right pull-right"></i></a>
                    <ul class="sidebar-submenu">
                        @can(['role.manage', 'users.manage-role-permissions'])
                            <li>
                                <a href="{{ route('admin.role') }}"
                                    class="{{ Str::contains(Route::currentRouteName(), 'admin.role') ? 'active' : '' }}">
                                    <i class="fa fa-circle"></i> Roles
                                </a>
                            </li>
                        @endcan
                        @can(['permission.manage', 'users.manage-role-permissions'])
                            <li>
                                <a href="{{ route('admin.permission') }} "
                                    class="{{ Str::contains(Route::currentRouteName(), 'admin.permission') ? 'active' : '' }}">
                                    <i class="fa fa-circle"></i> Permissions
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan
            {{-- @can('doctor.access')
                <li
                    class="{{ Str::contains(Route::currentRouteName(), ['service-provider.service', 'service-provider.inquiry']) ? 'active' : '' }}">
                    <a class="sidebar-header" href="javascript:void(0)"><i data-feather="bar-chart"></i>
                        <span> Service/Inquiry </span>
                        <i class="fa fa-angle-right pull-right"></i></a>
                    <ul class="sidebar-submenu">

                        <li>
                            <a href="{{ route('service-provider.service') }}"
                                class="{{ Str::contains(Route::currentRouteName(), 'service-provider.service') ? 'active' : '' }}">
                                <i class="fa fa-circle"></i> Service
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('service-provider.inquiry') }} "
                                class="{{ Str::contains(Route::currentRouteName(), 'service-provider.inquiry') ? 'active' : '' }}">
                                <i class="fa fa-circle"></i> Inquiry
                            </a>
                        </li>


                    </ul>
                </li>
            @endcan --}}

            @can('province-district-city.manage')
                <li class="{{ Str::contains(Route::currentRouteName(), ['admin.province.districts']) ? 'active' : '' }}">
                    <a class="sidebar-header" href="javascript:void(0)"><i data-feather="map-pin"></i>
                        <span> Districts & City </span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('admin.province.districts') }}"
                                class="{{ Str::contains(Route::currentRouteName(), ['admin.province.districts']) ? 'active' : '' }}">
                                <i class="fa fa-circle"></i>Create / Manage
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan


            @can('bank.view')
                <li class="{{ Route::currentRouteName() === 'admin.bank' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('admin.bank') }}"><i data-feather="git-pull-request"></i>
                        <span>{{ trans('Manage Bank/Brach') }}</span></a>
                </li>
            @endcan


            @can('content.manage')
                <li
                    class="{{ Str::contains(Route::currentRouteName(), ['admin.pages', 'admin.banner']) ? 'active' : '' }}">
                    <a class="sidebar-header" href="javascript:void(0)"><i data-feather="monitor"></i>
                        <span>Content Management </span>
                        <i class="fa fa-angle-right pull-right"></i></a>
                    <ul class="sidebar-submenu">
                        @can('page.manage')
                            <li>
                                <a href="{{ route('admin.pages') }}"
                                    class="{{ Str::contains(Route::currentRouteName(), 'admin.pages') ? 'active' : '' }}">
                                    <i class="fa fa-circle"></i> Pages
                                </a>
                            </li>
                        @endcan
                        @can('banner.manage')
                            <li>
                                <a href="{{ route('admin.banner') }} "
                                    class="{{ Str::contains(Route::currentRouteName(), 'admin.banner') ? 'active' : '' }}">
                                    <i class="fa fa-circle"></i> Banners
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('service-category.manage')
                <li
                    class="{{ in_array(Route::currentRouteName(), ['admin.category', 'admin.category.localOrder', 'admin.category.foreignOrder']) ? 'active' : '' }}">
                    <a class="sidebar-header" href="javascript:void(0)"><i
                            data-feather="edit"></i><span>{{ trans('Service Category') }}</span><i
                            class="fa fa-angle-right pull-right"></i></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('admin.category') }}"
                                class="{{ Route::currentRouteName() == 'admin.category' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Manage</a></li>
                        <li><a href="{{ route('admin.category.localOrder') }}"
                                class="{{ Route::currentRouteName() == 'admin.category.localOrder' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Local Arrange</a></li>
                        
                    </ul>
                </li>
            @endcan

            @can('manage-service.view')
                <li
                    class="{{ in_array(Route::currentRouteName(), ['admin.getServices', 'admin.pendingServices', 'admin.approveServices', 'admin.rejectServices']) ? 'active' : '' }}">
                    <a class="sidebar-header" href="javascript:void(0)"><i
                            data-feather="briefcase"></i><span>{{ trans('Manage Services') }}</span><i
                            class="fa fa-angle-right pull-right"></i></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('admin.getServices') }}"
                                class="{{ Route::currentRouteName() == 'admin.getServices' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>All Services</a></li>
                        <li><a href="{{ route('admin.pendingServices') }}"
                                class="{{ Route::currentRouteName() == 'admin.pendingServices' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Pending Services</a></li>
                        <li><a href="{{ route('admin.approveServices') }}"
                                class="{{ Route::currentRouteName() == 'admin.approveServices' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Approved Services</a></li>
                        <li><a href="{{ route('admin.rejectServices') }}"
                                class="{{ Route::currentRouteName() == 'admin.rejectServices' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Rejected Services</a></li>
                    </ul>
                </li>
            @endcan
            @can('reviews.view')
                <li class="{{ Route::currentRouteName() === 'admin.reviews' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('admin.reviews') }}"><i data-feather="mail"></i>
                        <span>{{ trans('Reviews') }}</span></a>
                </li>
            @endcan

            @can('product-category.view')
                <li class="{{ Route::currentRouteName() === 'admin.manageProduct' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('admin.manageProduct') }}"><i data-feather="folder"></i>
                        <span>{{ trans('Product Category') }}</span></a>
                </li>
            @endcan

            @can('product.manage')
                <li class="{{ Route::currentRouteName() === 'admin.product' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('admin.product') }}"><i data-feather="box"></i>
                        <span>{{ trans('Product') }}</span></a>
                </li>
            @endcan

            @can('orders.view')
                <li class="{{ Route::currentRouteName() === 'admin.orders' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('admin.orders') }}"><i data-feather="shopping-bag"></i>
                        <span>{{ trans('Orders') }}</span></a>
                </li>
            @endcan

        

            @can('contact.view')
                <li class="{{ Route::currentRouteName() === 'admin.contact' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('admin.contact') }}"><i data-feather="heart"></i>
                        <span>{{ trans('Contacts') }}</span></a>
                </li>
            @endcan

            @can('deactivate.view')
                <li class="{{ Route::currentRouteName() === 'admin.manage-user.deactivate' ? 'active' : '' }}">
                    <a class="sidebar-header" href="{{ route('admin.manage-user.deactivate') }}"><i
                            data-feather="users"></i>
                        <span>{{ trans('Deactivate Users') }}</span></a>
                </li>
            @endcan

            {{-- @can('manage-testimonial') --}}
                <li class="{{ in_array(Route::currentRouteName(), ['admin.testimonial.create','admin.testimonials.manage']) ? 'active' : '' }}">
                    <a class="sidebar-header" href="javascript:void(0)"><i
                            data-feather="briefcase"></i><span>{{ trans('Manage Testimonials') }}</span><i
                            class="fa fa-angle-right pull-right"></i></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('admin.testimonial.create') }}"
                                class="{{ Route::currentRouteName() == 'admin.testimonial.create' ? 'active' : '' }}"><i
                                    class="fa fa-circle"></i>Create</a></li>
                        <li><a href="{{ route('admin.testimonials.manage') }}"
                            class="{{ Route::currentRouteName() == 'admin.testimonials.manage' ? 'active' : '' }}"><i
                                class="fa fa-circle"></i>Manage</a></li>

                    </ul>
                </li>
            {{-- @endcan --}}

        </ul>
    </div>
</div>
<audio id="notificationSound" src="{{ asset('assets/backend/audio/ring.mp3') }}" type="audio/mpeg">
</audio>
<!-- Page Sidebar Ends-->
<script src="{{ asset('assets/backend/js/jquery-3.6/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/notify/bootstrap-notify.min.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="{{ asset('js/admin/get-inquiry/inquiry-notify.js') }}"></script>
