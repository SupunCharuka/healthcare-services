<!-- Page Sidebar Start-->
<div class="page-sidebar color2-sidebar" sidebar-layout="border-sidebar">
    <div class="main-header-left d-none d-lg-block bg-white">
        <div class="logo-wrapper">
            <a href="{{route('/')}}" target="_blank">
                <img src="{{ asset('img/logo3.png') }}" alt="" class="mydoc-logo">
            </a>
        </div>
    </div>
    <div class="sidebar custom-scrollbar">
        <div class="sidebar-user text-center">
            <div>
                <img class="rounded-circle" src="{{ asset(Auth::user()->profile_photo_url) }}" referrerpolicy="no-referrer" style="width:60px; height:60px;" alt="#">
                <div class="profile-edit">
                    <a href="" target="_blank"><i data-feather="edit"></i></a>
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
            <li class="{{ Route::currentRouteName() === 'admin.manage-user' ? 'active' : '' }}">
                <a class="sidebar-header" href="{{ route('admin.manage-user') }}"><i data-feather="users"></i>
                    <span>{{ trans('Manage Users') }}</span></a>
            </li>
            <li class="{{ Str::contains(Route::currentRouteName(), ['admin.role','admin.permission']) ? 'active' : '' }}">
                <a class="sidebar-header" href="javascript:void(0)"><i data-feather="sliders"></i>
                    <span> Roles/Permissions </span>
                    <i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.role') }}" class="{{ Str::contains(Route::currentRouteName(), 'admin.role') ? 'active' : '' }}">
                            <i class="fa fa-circle"></i> Roles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.permission') }} " class="{{ Str::contains(Route::currentRouteName(), 'admin.permission') ? 'active' : '' }}">
                            <i class="fa fa-circle"></i> Permissions
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::url() === url('super-admin/user-activity') ? 'active' : '' }}">
                <a class="sidebar-header" href="{{ url('super-admin/user-activity') }}">
                    <i data-feather="folder-plus"></i>
                    <span>{{ trans('User Activity') }}</span>
                </a>
            </li>
            
            {{-- @include('navigation-menu') --}}
        </ul>
    </div>
</div>
<!-- Page Sidebar Ends-->
