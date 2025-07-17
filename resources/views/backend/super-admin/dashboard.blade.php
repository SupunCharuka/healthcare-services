@extends('backend.layouts.master')
@section('title', 'Dashboard')
@section('styles')
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/owlcarousel.css') }}">
@endsection

@section('breadcrumb-title', 'Dashboard')
@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
@endsection
@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 xl-100">
                <div class="row">
                    <div class="owl-carousel owl-theme" id="owl-carousel-14">
                        <div class="item">
                            <div class="card">
                                <div class="card-body ecommerce-icons text-center">
                                    <i data-feather="dollar-sign"></i>
                                    <div><span>Total Earning</span></div>
                                    <h4 class="font-primary mb-0 counter">72</h4>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card">
                                <div class="card-body ecommerce-icons text-center">
                                    <i data-feather="map-pin"></i>
                                    <div><span>Total Web Visitor</span></div>
                                    <h4 class="font-primary mb-0 counter">65</h4>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card">
                                <div class="card-body ecommerce-icons text-center">
                                    <i data-feather="shopping-cart"></i>
                                    <div><span>Total Sale Product</span></div>
                                    <h4 class="font-primary mb-0 counter">96</h4>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card">
                                <div class="card-body ecommerce-icons text-center">
                                    <i data-feather="trending-down"></i>
                                    <div><span>Company Loss</span></div>
                                    <h4 class="font-primary mb-0 counter">89</h4>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card">
                                <div class="card-body ecommerce-icons text-center">
                                    <i data-feather="dollar-sign"></i>
                                    <div><span>Total Earning</span></div>
                                    <h4 class="font-primary mb-0 counter">72</h4>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card">
                                <div class="card-body ecommerce-icons text-center">
                                    <i data-feather="map-pin"></i>
                                    <div><span>Total Web Visitor</span></div>
                                    <h4 class="font-primary mb-0 counter">65</h4>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card">
                                <div class="card-body ecommerce-icons text-center">
                                    <i data-feather="shopping-cart"></i>
                                    <div><span>Total Sale Product</span></div>
                                    <h4 class="font-primary mb-0 counter">96</h4>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card">
                                <div class="card-body ecommerce-icons text-center">
                                    <i data-feather="trending-down"></i>
                                    <div><span>Company Loss</span></div>
                                    <h4 class="font-primary mb-0 counter">89</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 xl-50 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="number-widgets">
                            <div class="media">
                                <div class="media-body align-self-center">
                                    <h6 class="mb-0">Payment Status</h6>
                                </div>
                                <div class="radial-bar radial-bar-95 radial-bar-primary" data-label="95%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 xl-50 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="number-widgets">
                            <div class="media">
                                <div class="media-body align-self-center">
                                    <h6 class="mb-0">Work Process</h6>
                                </div>
                                <div class="radial-bar radial-bar-75 radial-bar-primary" data-label="75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 xl-50 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="number-widgets">
                            <div class="media">
                                <div class="media-body align-self-center">
                                    <h6 class="mb-0">Sale Completed</h6>
                                </div>
                                <div class="radial-bar radial-bar-90 radial-bar-primary" data-label="90%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 xl-50 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="number-widgets">
                            <div class="media">
                                <div class="media-body align-self-center">
                                    <h6 class="mb-0">Payment Done</h6>
                                </div>
                                <div class="radial-bar radial-bar-80 radial-bar-primary" data-label="80%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection
@section('scripts')
    <script src="{{ asset('assets/backend/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/backend/js/counter/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('assets/backend/js/dashboard/dashboard-ecommerce/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets/backend/js/height-equal.js') }}"></script>
@endsection
