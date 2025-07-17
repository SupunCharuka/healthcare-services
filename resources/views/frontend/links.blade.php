<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>healthcare.lk | Social Links </title>
    <!-- Fav Icon -->
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    @include('frontend.layouts.styles')
    <!-- Styles -->
    @livewireStyles
</head>


<body class="cnt-home" x-data="{ overflow_y: true }" :class="[!overflow_y ? 'overflow-hidden' : '']">

    <div class="boxed_wrapper">
        <div class="preloader"></div>



        <section class="about-style-two social-links-header">
            <div class="auto-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                        <div class="content_block_2 d-flex justify-content-center">
                            <div class="content-box">
                                <div class="sec-title light d-flex justify-content-center" style="margin-bottom: 0px">
                                    <p style="color: #000;">Welcome</p>

                                </div>
                                <div class="btn-box clearfix">
                                    <div class="logo-box">
                                        <figure class="logo"><a href="{{ url('') }}"><img
                                                    src="{{ asset('img/logo3.png') }}" alt=""
                                                    width="550px"></a>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-style-two" style="padding: 40px 0px 0px;">
            <div class="auto-container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-sm-12 content-column">

                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-center d-flex justify-content-center">
                                <a href="{{ url('') }}" target="_blank"
                                    class="whatsapp-button call-left-button visit-button">
                                    Visit Website

                                </a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-style-two" style="padding: 45px 0px 0px;">
            <div class="auto-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 content-column">

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                <a href="https://wa.me/+94702773500" target="_blank"
                                    class="whatsapp-button call-left-button">
                                    <i class="fab fa-whatsapp call-icon pulse"></i>Whatsapp

                                </a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                <a href="tel:+94702773500" class="emergency-button call-button call-right-button">
                                    <i class="fas fa-phone call-icon pulse"></i> Emergency Call

                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-style-two" style="padding: 45px 0px 0px;">
            <div class="auto-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                        <div class="content_block_2 d-flex justify-content-center">
                            <div class="content-box">
                                <div class="sec-title light d-flex justify-content-center" style="margin-bottom: 0px">
                                    <p style="color: #000;">Download apps</p>

                                </div>
                                <div class="btn-box clearfix">

                                    <a href="https://apps.apple.com/lk/app/mydoc-lk/id6472630353"
                                        class="download-btn app-store">
                                        <i class="fab fa-apple"></i>
                                        <span>Download on</span>
                                        <h3>App Store</h3>
                                    </a>
                                    <a href="https://play.google.com/store/apps/details?id=com.mydoc.app.mydoc_app&pcampaignid=web_share"
                                        class="download-btn play-store">
                                        <i class="fab fa-google-play"></i>
                                        <span>Download on</span>
                                        <h3>Google Play</h3>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-style-two testimonial-section" style="padding: 45px 0px 0px;">
            <div class="auto-container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 col-md-6 col-sm-6 content-column">
                        <div class="testimonial-inner link-testimonial-inner">
                            <div class="pattern" style="background-image: url(assets/frontend/images/shape/shape-21.png);"></div>
                            <div class="sec-title">
                                <p style="color: #000;">What client’s say?</p>
                            </div>
                            <div class="single-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">
                                @foreach ($testimonials as $testimonial)
                                    <div class="testimonial-block-one">
                                        <div class="inner-box">
                                            <div class="text">
                                                <p><strong>{{ $testimonial->title }}</strong></p>
                                                <p>{!! $testimonial->description !!}
                                                </p>
                                            </div>
                                            <div class="author-info">
                                                <figure class="author-thumb"><img
                                                        src="{{ storage('uploads/testimonial/' . $testimonial->image) }}"
                                                        alt="">
                                                </figure>
                                                <p class="author-name">{{ $testimonial->name }}</p>
                                                <span class="designation">{{ $testimonial->country }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      
        <section class="about-style-two social-links-footer">
            <div class="auto-container">
                <div class="row">
                    <div class="col-sm-12 justify-content-center d-flex">
                        <div class="social-media-icon social-link">
                            <ul>
                                <li>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fab fa-whatsapp"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class=" fab fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>
    @include('frontend.layouts.scripts')
    @livewireScripts
</body>

</html>
