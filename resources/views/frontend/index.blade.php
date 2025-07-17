@extends('frontend.layouts.master')
@section('title', 'Home')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link href="{{ asset('assets/frontend/css/banner.css') }}" rel="stylesheet">
@endsection
@section('content')

    <!-- banner-section -->
    <section id="banner" class="desktop-banner-image">
        <div class="owl-carousel banner-slider">
            @foreach ($banners as $banner)
                <div class="item">
                    <div class="image-wrapper" onClick="window.open( '{{ $banner->link_to }}' ); return false;"
                        style="cursor: pointer;">
                        <img src="{{ storage('uploads/banners/' . $banner->image) }}" alt="Slide">

                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- mobile banner-section -->

    <section id="banner" class="mobile-banner-image">
        <div class="owl-carousel banner-slider">
            @foreach ($banners as $banner)
                <div class="item">
                    <div class="image-wrapper" onClick="window.open( '{{ $banner->link_to }}' ); return false;"
                        style="cursor: pointer;">
                        <img src="{{ storage('uploads/banners/mobile-image/' . $banner->mobile_image) }}" alt="Slide">

                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- banner-section end -->
    <!-- search-doctors -->
    <section class="search-doctors-two">
        <div class="auto-container">
            <div class="inner-container">
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
                                        {{-- {{dd(session('current_language'))}} --}}


                                        <div class="popup-description">
                                            <p style="color: black">{{ $serviceCategory->description }}</p>
                                        </div>
                                        <div class="popup-actions btn-box">
                                            <a href="{{ route('inquiry', ['servicecategory' => $serviceCategory]) }}"
                                                class="theme-btn-one enquire-btn">Online Enquire Now<i
                                                    class="icon-Arrow-Right"></i></a>
                                            <a href="tel:+94703858585" class="emergency-button">
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

                        <div class="col-lg-3 col-md-6 col-sm-6 col-6 feature-block">
                            <div class="imagination_content">
                                <div class="imagination_boxed">
                                    <div onclick="{{ $onClickAction }}" style="cursor: pointer;" class="a-tag">
                                        <img src="{{ asset('uploads/admin/service-category/' . $serviceCategory->image) }}"
                                            alt="img">
                                    </div>
                                    <div class="h3-tag">
                                        <div class="a-tag">
                                            <p class="service-category-name"> {{ $serviceCategory->name }}</p>
                                            <h3>{{ $serviceCategory->caption }} </h3>

                                        </div>
                                        <div class="btn-box">
                                            <button class="theme-btn-one enquire-btn" onclick="{{ $onClickAction }}">
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
    </section>

    <section class="cta-section bg-color-2">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url(assets/frontend/images/shape/shape-17.png);"></div>
            <div class="pattern-2" style="background-image: url(assets/frontend/images/shape/shape-18.png);"></div>
            <div class="pattern-3" style="background-image: url(assets/frontend/images/shape/shape-19.png);"></div>
        </div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image-box wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <figure class="image"><img src="{{ asset('assets/frontend/images/banner/banner-image-1.png') }}"
                                alt=""></figure>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_2">
                        <div class="content-box">
                            <div class="sec-title light">
                                <p style="color: #000;">Access Care</p>
                                <h2>Experience Hassle-Free Healthcare at Your Convenience</h2>
                            </div>
                            <div class="text">
                                <p>Getting the care you need has never been easier. Whether you're at home, at work, or on
                                    the go, our healthcare services are designed to fit your lifestyle. From prompt home
                                    visits by experienced professionals to instant connections with trusted specialists, we
                                    ensure that expert care is always within reach. Need medications? We'll have them
                                    delivered right to your doorstep. It's healthcare that revolves around you—reliable,
                                    efficient, and tailored to your unique needs. Take charge of your well-being with
                                    services that prioritize your comfort, time, and peace of mind.</p>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- about-section -->
    <section class="about-section" id="about">
        <div class="auto-container">
            <div class="row align-items-center clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_1">
                        <div class="content-box" style="margin-left: 0px !important;">
                            <div class="sec-title">
                                <p>About Us</p>
                                <h2>Your health journey is our priority</h2>
                            </div>
                            <div class="text">
                                <p>At healthcare.lk, we believe in making healthcare easily accessible, convenient, and
                                    patient-centred. Our range of exceptional medical services is designed to cater to your
                                    diverse healthcare needs, ensuring you receive the utmost care from the comfort of your
                                    home. With a commitment to excellence, we bring the doctor's office to your doorstep and
                                    connect you with top-notch medical professionals for a seamless healthcare experience.
                                </p>
                            </div>

                            <div class="btn-box"><a href="{{ route('public.aboutUs') }}" class="theme-btn-one">About
                                    Us<i class="icon-Arrow-Right"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_1">
                        <div class="image-box">

                            <figure class="image clearfix"><img
                                    src="{{ asset('assets/frontend/images/resource/about-1.jpg') }}" alt=""
                                    style="float:none;max-width: 100%; border-radius: 15px;box-shadow: 10px 10px #fffdb9;">
                            </figure>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- about-section end -->

    <!-- process-section -->
    <section class="process-section bg-color-2">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url(assets/frontend/images/shape/shape-17.png);"></div>
            <div class="pattern-2" style="background-image: url(assets/frontend/images/shape/shape-18.png);"></div>
            <div class="pattern-3" style="background-image: url(assets/frontend/images/shape/shape-19.png);"></div>
            <div class="pattern-4" style="background-image: url(assets/frontend/images/shape/shape-20.png);"></div>
        </div>
        <div class="auto-container">
            <div class="sec-title light centred">
                <p style="color: #000;">Process</p>
                <h2>Our Specialities</h2>
            </div>
            <div class="inner-content">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                        <div class="processing-block-one">
                            <div class="inner-box">
                                <figure class="icon-box">
                                    <img src="{{ asset('assets/frontend/images/icons/icon-5.png') }}" alt="">
                                    <span>01</span>
                                </figure>
                                <h3>Choose Your Service</h3>
                                <p class="p-font">Select from our range of services, whether it's a doctor home visit, an
                                    audio/video consultation, a specialist appointment, or medication delivery. Our
                                    user-friendly interface makes service selection a breeze.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                        <div class="processing-block-one">
                            <div class="inner-box">
                                <figure class="icon-box">
                                    <img src="{{ asset('assets/frontend/images/icons/icon-6.png') }}" alt="">
                                    <span>02</span>
                                </figure>
                                <h3>Schedule Conveniently</h3>
                                <p class="p-font">Pick a date and time that suits you best. Our flexible scheduling options
                                    allow you to plan appointments around your busy lifestyle. Need urgent care? We're here
                                    for you with rapid response services.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                        <div class="processing-block-one">
                            <div class="inner-box">
                                <figure class="icon-box">
                                    <img src="{{ asset('assets/frontend/images/icons/icon-7.png') }}" alt="">
                                    <span>03</span>
                                </figure>
                                <h3> Health Coverage</h3>
                                <p class="p-font"> Travel with confidence knowing your healthcare needs are supported
                                    across borders. We offer guidance and solutions tailored for global travelers, ensuring
                                    you stay protected wherever life takes you.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- process-section end -->

    <!-- testimonial-section -->
    {{-- <section class="testimonial-section bg-color-3 testimonial-mobile" id="testimonial" style="padding: 0px 0px;">

    </section> --}}
    <!-- testimonial-section end -->



@endsection

@section('scripts')
    <script src="{{ asset('assets/frontend/js/jquery.paroller.min.js') }}"></script>
    {{-- <script src="{{ asset('js/frontend/home/popup.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('js/frontend/home/index.js') }}"></script>
    <script>
        function openPopup(id) {
            // Set the 'position' style to 'initial' for the 'main-header' class
            document.querySelector('.main-header').style.position = 'initial';
            document.querySelector('.sticky-header').style.position = 'absolute';
           
            document.getElementById('popup' + id).style.display = 'block';
        }

        function closePopup(id) {
            // Remove the 'position' style for the 'main-header' class
            document.querySelector('.main-header').style.removeProperty('position');
            document.querySelector('.sticky-header').style.removeProperty('position');
        
            document.getElementById('popup' + id).style.display = 'none';
        }
    </script>

@endsection
