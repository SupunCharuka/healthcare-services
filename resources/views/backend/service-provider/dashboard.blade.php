@extends('backend.layouts.master')
@section('title', 'Welcome, ' . auth()->user()->name . ' - Dashboard')
@section('styles')
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/prism.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/whether-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/status-tag.css') }}">
    <style>
        .col-xl-6 .cal-datepicker .datepicker-here .datepicker {
            width: 100%;
        }

        #greeting {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding: 20px;
            border: 2px solid #3498db;
            border-radius: 10px;
            background-color: #f0f0f0;
            color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin: 0 auto;
        }

        #greeting::before {
            display: block;
            font-size: 36px;
            margin: 10px 0;
        }
    </style>
@endsection

@section('breadcrumb-title', 'Dashboard')
@section('breadcrumb-items')
    <li class="breadcrumb-item">Service Provider</li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            @php
                $user = Auth::user();
            @endphp
            <div class="col-md-12 mb-4">
                <div class="greeting" id="greeting">
                </div>
            </div>
            @if ($user->member_type == 'doctor')
                @if (session('incompleteProfile') || $user->memberRegister->status != 1)
                    @if ($user && (!$user->education->count() && !$user->workDetails->count()))
                        <div class="col-md-12 mb-4">
                            <div class="status-tag informative-medium">
                                <p class="title mb-0">Please fill out your education
                                    and
                                    work experience to complete your profile.</p>
                            </div>
                        </div>
                    @elseif ($user && !$user->education->count())
                        <div class="col-md-12 mb-4">
                            <div class="status-tag informative-medium">
                                <p class="title mb-0">Please fill out your education to complete your profile.</p>
                            </div>
                        </div>
                    @elseif ($user && !$user->workDetails->count())
                        <div class="col-md-12 mb-4">
                            <div class="status-tag informative-medium">
                                <p class="title mb-0">Please fill out your work experience to complete your profile.</p>
                            </div>
                        </div>
                    @endif

                    <div class="col-md-6 mb-4">
                        <a href="{{ route('service-provider.education') }}"
                            class="{{ $user && $user->education->count() ? 'custom-link link-with-education' : 'custom-link link-without-education' }}">
                            <div class="link-icon">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                            <div class="link-text">
                                <h4>My Education</h4>
                                <p>Manage your education details</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 mb-4">
                        <a href="{{ route('service-provider.workDetails') }}"
                            class="{{ $user && $user->workDetails->count() ? 'custom-link link-with-work-details' : 'custom-link link-without-work-details' }}">
                            <div class="link-icon">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            <div class="link-text">
                                <h4>My Work Experience</h4>
                                <p>Manage your work experience</p>
                            </div>
                        </a>
                    </div>

                @endif
            @endif
            @if ($user->memberRegister->status === 1)
                <div class="col-sm-4 col-xl-4 col-lg-4">
                    <div class="card o-hidden">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="bell"></i></div>
                                <div class="media-body"><span class="m-0">Today's Booking</span>
                                    <h4 class="mb-0 counter">{{ $todayBookings }}</h4><i class="icon-bg"
                                        data-feather="bell"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-xl-4 col-lg-4">
                    <div class="card o-hidden">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="box"></i></div>
                                <div class="media-body"><span class="m-0">All Bookings</span>
                                    <h4 class="mb-0 counter">{{ $allBookings }}</h4><i class="icon-bg"
                                        data-feather="box"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-xl-4 col-lg-4">
                    <div class="card o-hidden">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="dollar-sign"></i></div>
                                <div class="media-body"><span class="m-0">Today Payout</span>
                                    <h4 class="mb-0 counter">{{ $todayPayouts }}</h4><i class="icon-bg"
                                        data-feather="dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-xl-4 col-lg-4">
                    <div class="card o-hidden">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="gift"></i></div>
                                <div class="media-body"><span class="m-0">Latest Payout</span>
                                    <h4 class="mb-0 counter">{{ $latestPayouts }}</h4><i class="icon-bg"
                                        data-feather="gift"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-xl-4 col-lg-4">
                    <div class="card o-hidden">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="message-square"></i></div>
                                <div class="media-body"><span class="m-0">Messages</span>
                                    <h4 class="mb-0 counter">{{ $messages }}</h4><i class="icon-bg"
                                        data-feather="message-square"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-xl-4 col-lg-4">
                    <div class="card o-hidden">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="archive"></i></div>
                                <div class="media-body"><span class="m-0">My Services</span>
                                    <h4 class="mb-0 counter">{{ $services }}</h4><i class="icon-bg"
                                        data-feather="archive"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                <div class="col-xl-6 xl-100">
                    <div class="card">
                        <div class="cal-date-widget card-body">
                            <div class="cal-datepicker mr-5">
                                <div class="datepicker-here" data-language="en"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 xl-50 col-sm-6">
                    <div class="card">
                        <div class="mobile-clock-widget">
                            <div class="bg-svg">
                                <svg class="climacon climacon_cloudLightningMoon" id="cloudLightningMoon" version="1.1"
                                    viewBox="15 15 70 70">
                                    <clippath id="moonCloudFillClipfill11">
                                        <path
                                            d="M0,0v100h100V0H0z M60.943,46.641c-4.418,0-7.999-3.582-7.999-7.999c0-3.803,2.655-6.979,6.211-7.792c0.903,4.854,4.726,8.676,9.579,9.58C67.922,43.986,64.745,46.641,60.943,46.641z">
                                        </path>
                                    </clippath>
                                    <clippath id="cloudFillClipfill19">
                                        <path
                                            d="M15,15v70h70V15H15z M59.943,61.639c-3.02,0-12.381,0-15.999,0c-6.626,0-11.998-5.371-11.998-11.998c0-6.627,5.372-11.999,11.998-11.999c5.691,0,10.434,3.974,11.665,9.29c1.252-0.81,2.733-1.291,4.334-1.291c4.418,0,8,3.582,8,8C67.943,58.057,64.361,61.639,59.943,61.639z">
                                        </path>
                                    </clippath>
                                    <g class="climacon_iconWrap climacon_iconWrap-cloudLightningMoon">
                                        <g clip-path="url(#cloudFillClip)">
                                            <g class="climacon_wrapperComponent climacon_wrapperComponent-moon climacon_componentWrap-moon_cloud"
                                                clip-path="url(#moonCloudFillClip)">
                                                <path
                                                    class="climacon_component climacon_component-stroke climacon_component-stroke_sunBody"
                                                    d="M61.023,50.641c-6.627,0-11.999-5.372-11.999-11.998c0-6.627,5.372-11.999,11.999-11.999c0.755,0,1.491,0.078,2.207,0.212c-0.132,0.576-0.208,1.173-0.208,1.788c0,4.418,3.582,7.999,8,7.999c0.614,0,1.212-0.076,1.788-0.208c0.133,0.717,0.211,1.452,0.211,2.208C73.021,45.269,67.649,50.641,61.023,50.641z">
                                                </path>
                                            </g>
                                        </g>
                                        <g class="climacon_wrapperComponent climacon_wrapperComponent-lightning">
                                            <polygon
                                                class="climacon_component climacon_component-stroke climacon_component-stroke_lightning"
                                                points="48.001,51.641 57.999,51.641 52,61.641 58.999,61.641 46.001,77.639 49.601,65.641 43.001,65.641 ">
                                            </polygon>
                                        </g>
                                        <g class="climacon_wrapperComponent climacon_wrapperComponent-cloud">
                                            <path
                                                class="climacon_component climacon_component-stroke climacon_component-stroke_cloud"
                                                d="M59.999,65.641c-0.28,0-0.649,0-1.062,0l3.584-4.412c3.182-1.057,5.478-4.053,5.478-7.588c0-4.417-3.581-7.998-7.999-7.998c-1.602,0-3.083,0.48-4.333,1.29c-1.231-5.316-5.974-9.29-11.665-9.29c-6.626,0-11.998,5.372-11.998,12c0,5.446,3.632,10.039,8.604,11.503l-1.349,3.777c-6.52-2.021-11.255-8.098-11.255-15.282c0-8.835,7.163-15.999,15.998-15.999c6.004,0,11.229,3.312,13.965,8.204c0.664-0.114,1.338-0.205,2.033-0.205c6.627,0,11.999,5.371,11.999,11.999C71.999,60.268,66.626,65.641,59.999,65.641z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div>
                                <ul class="clock" id="clock">
                                    <li class="hour" id="hour"></li>
                                    <li class="min" id="min"></li>
                                    <li class="sec" id="sec"></li>
                                </ul>
                                <div class="date f-24 mb-2" id="date"><span id="monthDay"></span><span
                                        id="year">, </span></div>
                                <div>
                                    <p class="m-0 f-14 text-light">Colombo, Sri Lanka</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection
@section('scripts')
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/backend/js/config.js') }}"></script>
    <script src="{{ asset('assets/backend/js/prism/prism.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/counter/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom-card/custom-card.js') }}"></script>
    <script src="{{ asset('assets/backend/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    <script src="{{ asset('assets/backend/js/general-widget.js') }}"></script>
    <script src="{{ asset('assets/backend/js/height-equal.js') }}"></script>
    <script>
        var today = new Date();
        var hour = today.getHours();

        if (hour >= 5 && hour < 12) {
            document.getElementById("greeting").innerHTML = "Good morning, {{$user->name}}!";
            document.getElementById("greeting").style.backgroundColor = "#f1c40f"; // Yellow
        } else if (hour >= 12 && hour < 17) {
            document.getElementById("greeting").innerHTML = "Good afternoon, {{$user->name}}!";
            document.getElementById("greeting").style.backgroundColor = "#27ae60"; // Green
        } else if (hour >= 17 && hour < 22) {
            document.getElementById("greeting").innerHTML = "Good evening, {{$user->name}}!";
            document.getElementById("greeting").style.backgroundColor = "#3498db"; // Blue
        } else {
            document.getElementById("greeting").innerHTML = "Good night, {{$user->name}}!";
            document.getElementById("greeting").style.backgroundColor = "#2c3e50"; // Dark Blue
            document.getElementById("greeting").style.color = "#ecf0f1"; // Light Gray
        }
    </script>
@endsection
