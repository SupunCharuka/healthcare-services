@extends('backend.customer.layouts.master')

@section('title', 'Dashboard')
@section('link', 'Dashboard')
@section('styles')
    <link href="{{ asset('assets/backend/css/customer/clock.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/backend/js/jquery-3.6/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/notify/bootstrap-notify.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
@endsection
@section('content')
    <div class="content-container">
        <div class="outer-container">
            @if (Session::has('success'))
                <script>
                    $.notify({
                        icon: 'glyphicon glyphicon-alert',
                        message: '{{ Session::get('success') }}'
                    }, {
                        type: 'success',
                        allow_dismiss: true,
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                        delay: 50000000,
                        animate: {
                            enter: 'animated fadeInDown',
                            exit: 'animated fadeOutUp'
                        }
                    });
                </script>
            @endif
            <div class="feature-content">
                <div class="row clearfix">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-6 feature-block">
                        <div class="feature-block-two">
                            <div class="inner-box customer-inner">
                                <div class="pattern">
                                    <div class="pattern-1"
                                        style="background-image: url('{{ asset('assets/frontend/images/shape/shape-81.png') }}')">
                                    </div>
                                    <div class="pattern-2"
                                        style="background-image: url('{{ asset('assets/frontend/images/shape/shape-82.png') }}')">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-4">
                                        <div class="icon-box"><i class="icon-Dashboard-1"></i></div>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-8">
                                        <h3>{{ $myInquiryCount }}</h3>
                                        <h5>My Inquiry</h5>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-6 feature-block">
                        <div class="feature-block-two">
                            <div class="inner-box customer-inner">
                                <div class="pattern">
                                    <div class="pattern-1"
                                        style="background-image: url('{{ asset('assets/frontend/images/shape/shape-81.png') }}')">
                                    </div>
                                    <div class="pattern-2"
                                        style="background-image: url('{{ asset('assets/frontend/images/shape/shape-82.png') }}')">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-4">
                                        <div class="icon-box"><i class="icon-Dashboard-email-4"></i></div>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-8">
                                        <h3>{{ $myOrderCount }}</h3>
                                        <h5>My Orders</h5>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-6 feature-block">
                        <div class="feature-block-two">
                            <div class="inner-box customer-inner">
                                <div class="pattern">
                                    <div class="pattern-1"
                                        style="background-image: url('{{ asset('assets/frontend/images/shape/shape-81.png') }}')">
                                    </div>
                                    <div class="pattern-2"
                                        style="background-image: url('{{ asset('assets/frontend/images/shape/shape-82.png') }}')">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-4">
                                        <div class="icon-box"><i class="icon-Dashboard-5"></i></div>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-8">
                                        <h3>{{ $myReviewCount }}</h3>
                                        <h5>My Reviews</h5>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-6 feature-block">
                        <div class="feature-block-two">
                            <div class="inner-box customer-inner">
                                <div class="pattern">
                                    <div class="pattern-1"
                                        style="background-image: url('{{ asset('assets/frontend/images/shape/shape-81.png') }}')">
                                    </div>
                                    <div class="pattern-2"
                                        style="background-image: url('{{ asset('assets/frontend/images/shape/shape-82.png') }}')">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-4">
                                        <div class="icon-box"><i class="icon-Dashboard-3"></i></div>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-8">
                                        <h3>{{ $myInvoiceCount }}</h3>
                                        <h5>My Invoice</h5>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="doctors-appointment p-4">
                <div class="row clearfix">
                    @foreach ($serviceCategories as $serviceCategory)
                        @if ($serviceCategory->slug === 'cosmetic')
                            @php
                                $url = route('public.productSub', ['product' => 'cosmetic-care']);
                                $onClickAction = "window.location.href = '{$url}';";
                            @endphp
                        @elseif ($serviceCategory->slug === 'medical-devices-equipment')
                            @php
                                $url = route('public.productSub', ['product' => 'medical-devices']);
                                $onClickAction = "window.location.href = '{$url}';";
                            @endphp
                        @else
                            @php
                                $onClickAction = "openPopup('{$serviceCategory->id}');";
                            @endphp
                            <!-- Custom popup content for this service category -->
                            <div class="custom-popup" id="popup{{ $serviceCategory->id }}">
                                <div class="popup-content">
                                    <div class="popup-header">
                                        <div class="popup-title">
                                            <p> {{ $serviceCategory->name }}</p>
                                        </div>
                                        <div>
                                            <button class="close-popup" onclick="closePopup('{{ $serviceCategory->id }}')">
                                                <div class="close-icon">
                                                    <div class="bar"></div>
                                                    <div class="bar"></div>
                                                </div>
                                            </button>
                                        </div>

                                    </div>
                                    <div class="popup-body">
                                        <div class="video-section">
                                            <iframe width="100%" height="200"
                                                src="https://www.youtube.com/embed/{{ $serviceCategory->video_id }}"
                                                frameborder="0" allowfullscreen></iframe>
                                        </div>
                                        <div class="popup-description">
                                            <p style="color: black">{{ $serviceCategory->description }}</p>
                                        </div>
                                        <div class="popup-actions btn-box">
                                            <a href="{{ route('inquiry', ['servicecategory' => $serviceCategory]) }}"
                                                class="theme-btn-one enquire-btn">Online Enquire Now<i
                                                    class="icon-Arrow-Right"></i></a>
                                            <a href="tel:+94702773500" class="emergency-button">
                                                <i class="fas fa-phone call-icon pulse"></i> Emergency Call
                                                <div class="tooltip">Our Emergency Call service is here for you in critical
                                                    moments. Reach out with a single click to get immediate support when it
                                                    matters most.</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-6 feature-block">
                            <div class="imagination_content">
                                <div class="imagination_boxed">
                                    <div onclick="{{ $onClickAction }}" style="cursor: pointer;"
                                        class="a-tag">
                                        <img src="{{ asset('uploads/admin/service-category/' . $serviceCategory->image) }}"
                                            alt="img">
                                    </div>
                                    <div class="h3-tag">
                                        <div class="a-tag">
                                            <p class="service-category-name"> {{ $serviceCategory->name }}</p>
                                            <h3>{{ $serviceCategory->caption }} </h3>

                                        </div>
                                        <div class="btn-box">
                                            <button class="theme-btn-one enquire-btn"
                                                onclick="{{ $onClickAction }}">
                                                Enquire Now<i class="icon-Arrow-Right"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')

    <script>
        function openPopup(id) {
            document.getElementById('popup' + id).style.display = 'block';
        }

        function closePopup(id) {
            document.getElementById('popup' + id).style.display = 'none';
        }
    </script>
@endsection
