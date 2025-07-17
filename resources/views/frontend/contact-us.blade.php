@extends('frontend.layouts.master')
@section('title', 'Contact US')

@section('content')

     <!--page-title-two-->
     <section class="page-title-two">
        <div class="title-box centred bg-color-2">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url('{{asset('assets/frontend/images/shape/shape-70.png')}}');"></div>
                <div class="pattern-2" style="background-image: url('{{asset('assets/frontend/images/shape/shape-71.png')}}');"></div>
            </div>
            <div class="auto-container">
                <div class="title">
                    <h1>Contact</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <div class="auto-container">
                <ul class="bread-crumb clearfix">
                    <li><a href="index-2.html">Home</a></li>
                    <li>Contact</li>
                </ul>
            </div>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- information-section -->
    <section class="information-section sec-pad centred bg-color-3">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url('{{asset('assets/frontend/images/shape/shape-88.png')}}');"></div>
            <div class="pattern-2" style="background-image: url('{{asset('assets/frontend/images/shape/shape-89.png')}}');"></div>
        </div>
        <div class="auto-container">
            <div class="sec-title centred">
                <p>Information</p>
                <h2>Get In Touch</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12 information-column">
                    <div class="single-information-block wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="pattern" style="background-image: url('{{asset('assets/frontend/images/shape/shape-87.png')}}');"></div>
                            <figure class="icon-box"><img src="{{ asset('assets/frontend/images/icons/icon-20.png') }}" alt=""></figure>
                            <h3>Email Address</h3>
                            <p>
                                <a href="mailto:support@healthcare.lk">support@healthcare.lk</a><br />
                                <a href="mailto:support@healthcare.lk">support@healthcare.lk</a>
                               
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 information-column">
                    <div class="single-information-block wow fadeInUp animated animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="pattern" style="background-image: url('{{asset('assets/frontend/images/shape/shape-87.png')}}');"></div>
                            <figure class="icon-box"><img src="{{ asset('assets/frontend/images/icons/icon-21.png') }}" alt=""></figure>
                            <h3>Phone Number</h3>
                            <p>
                                <a href="tel:+9476 123 4561">+9476 123 4561</a><br />
                                <a href="tel:+9476 123 4561">+9476 123 4561</a>
                             
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 information-column">
                    <div class="single-information-block wow fadeInUp animated animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="pattern" style="background-image: url('{{asset('assets/frontend/images/shape/shape-87.png')}}');"></div>
                            <figure class="icon-box"><img src="{{ asset('assets/frontend/images/icons/icon-22.png') }}" alt=""></figure>
                            <h3>Office Address</h3>
                            <p>
                                Hirimbura Cross Road, <br />Galle 80000
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- information-section end -->


    <!-- contact-section -->
    <section class="contact-section">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 form-column">
                    <div class="form-inner">
                        <div class="sec-title">
                            <p>Contact</p>
                            <h2>Contact Us</h2>
                        </div>
                        <livewire:frontend.contact-us.create />
                       
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 map-column">
                    <div class="map-inner">
                        <div class="pattern" style="background-image: url('{{asset('assets/frontend/images/shape/shape-90.png')}}');"></div>
                        <div
                            class="google-map"
                            id="contact-google-map"
                            data-map-lat=" 6.927079"
                            data-map-lng="79.861244"
                            data-icon-path="assets/frontend/images/icons/map-marker.png"
                            data-map-title="Colombo, Sri Lamka"
                            data-map-zoom="12"
                            data-markers='{
                                "marker-1": [6.927079, 79.861244, "<h4>Branch Office</h4><p>Colombo</p>","assets/frontend/images/icons/map-marker.png"]
                            }'>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-section end -->
@endsection

@section('scripts')
<!-- map script -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-CE0deH3Jhj6GN4YvdCFZS7DpbXexzGU"></script>
<script src="{{ asset('assets/frontend/js/gmaps.js') }}"></script>
<script src="{{ asset('assets/frontend/js/map-helper.js') }}"></script>
@endsection
