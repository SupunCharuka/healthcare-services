@extends('frontend.layouts.master')
@section('title', 'About Us')

@section('content')

    <!--Page Title-->
    <section class="page-title centred bg-color-1">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url('{{ asset('assets/frontend/images/shape/shape-70.png') }}');">
            </div>
            <div class="pattern-2" style="background-image: url('{{ asset('assets/frontend/images/shape/shape-71.png') }}');">
            </div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>About Us</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('') }}">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- about-section -->
    <section class="about-style-two">
        <div class="auto-container">
            <div class="row align-items-center clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="sec-title about-title">
                        <h2>ABOUT healthcare.LK</h2>
                    </div>
                    <div class="content_block_1 user-guide-content-block-1">
                        <div class="icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <div class="content-box user-guide-box">
                            <div class="content mt-0">
                                
                                <h4 class="title">
                                    Redefining Healthcare Accessibility and Convenience
                                </h4>
                                <p style="color: black">
                                    Welcome to healthcare.lk, your trusted partner in modern healthcare solutions Powered By Synotec Holdings Pvt Ltd. Our journey
                                    began with a vision to bridge the gap between medical services and your well-being, all
                                    within the comfort of your own space. We're committed to revolutionizing the way you
                                    experience healthcare, offering a comprehensive suite of services that cater to your
                                    unique needs.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 image-column image-about">
                    <div class="image_block_3">
                        <div class="image-box">
                            <div class="pattern">
                                <div class="pattern-1"
                                    style="background-image: url('{{ asset('assets/frontend/images/shape/shape-49.png') }}');">
                                </div>
                                <div class="pattern-2"
                                    style="background-image: url('{{ asset('assets/frontend/images/shape/shape-50.png') }}');">
                                </div>
                                <div class="pattern-3"></div>
                            </div>
                            <figure class="image image-1 paroller"><img
                                    src="{{ asset('assets/frontend/images/resource/about-4.jpg') }}" alt="">
                            </figure>
                            <figure class="image image-2 paroller-2"><img
                                    src="{{ asset('assets/frontend/images/resource/about-3.jpg') }}" alt="">
                            </figure>
                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                    <div class="content_block_1 about_content_block">
                        <div class="content-box about-content-box">
                            <div class="content_block_1 user-guide-content-block-1">
                                <div class="icon">
                                    <i class="fas fa-stethoscope"></i>
                                </div>
                                <div class="content-box user-guide-box">
                                    <div class="content mt-0">
                                        <h4 class="title">
                                            What Sets Us Apart
                                        </h4>
                                        <span class="d-flex"><span>❖</span>
                                            <p><strong>Doctor Home Visits : </strong> Our commitment to your convenience
                                                means that you don't have to step out to receive medical care. Our
                                                experienced doctors come to you, offering personalized treatments in an
                                                environment where you feel most comfortable.</p>
                                        </span>
                                        <span class="d-flex"><span>❖</span>
                                            <p><strong>Audio and Video Consultations : </strong> Modern times call for
                                                modern solutions. Our secure and reliable audio/video consultation platform
                                                connects you with experienced medical professionals, ensuring you can access
                                                expert advice without leaving your home.</p>
                                        </span>
                                        <span class="d-flex"><span>❖</span>
                                            <p><strong>Channel a Specialist : </strong> Your health concerns are unique, and
                                                so are your medical needs. With our service, you can easily connect with
                                                specialist doctors who provide targeted solutions tailored to your
                                                condition.</p>
                                        </span>
                                       
                                        <span class="d-flex"><span>❖</span>
                                            <p><strong>Ambulance Service : </strong> During emergencies, time is of the
                                                essence. Our prompt ambulance service is just a call away, providing swift
                                                medical transportation when you need it most.</p>
                                        </span>
                                        <span class="d-flex"><span>❖</span>
                                            <p><strong>Home Nursing : </strong> For those requiring ongoing care, our
                                                compassionate home nursing professionals provide support and medical
                                                assistance in the comfort of your home.</p>
                                        </span>

                                    </div>
                                </div>
                            </div>
                            <div class="content_block_1 user-guide-content-block-1">
                                <div class="icon">
                                    <i class="fas fa-stethoscope"></i>
                                </div>
                                <div class="content-box user-guide-box">
                                    <div class="content mt-0">
                                        <h4 class="title">
                                            Our Vision
                                        </h4>
                                        <p class="text-justify">
                                            “We envision a world where healthcare is truly patient-centric, where medical
                                            attention is easily accessible, and where well-being is nurtured with the utmost
                                            care. Our dedication to this vision drives us to continually innovate and
                                            improve our services.”
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="content_block_1 user-guide-content-block-1">
                                <div class="icon">
                                    <i class="fas fa-stethoscope"></i>
                                </div>
                                <div class="content-box user-guide-box">
                                    <div class="content mt-0">
                                        <h4 class="title">
                                            Our Mission
                                        </h4>
                                        <p class="text-justify">
                                            “At healthcare.lk, our mission is simple yet profound – to ensure that quality
                                            healthcare is never out of reach. We believe that every individual deserves
                                            timely and accessible medical attention, regardless of their circumstances. Our
                                            diverse range of services is carefully designed to bring the doctor's clinic to
                                            your doorstep, making healthcare a seamless part of your life.”
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="content_block_1 user-guide-content-block-1">
                                <div class="icon">
                                    <i class="fas fa-stethoscope"></i>
                                </div>
                                <div class="content-box user-guide-box">
                                    <div class="content mt-0">
                                        <h4 class="title">
                                            Your Health, Our Priority
                                        </h4>
                                        <p class="text-justify">
                                            At healthcare.lk, your health and satisfaction are at the forefront of everything we
                                            do. Our team of dedicated healthcare professionals is committed to providing you
                                            with the best possible care, backed by technology, expertise, and empathy.
                                        </p>
                                        <p class="text-justify">
                                            Explore our services, experience healthcare like never before, and join us on
                                            our mission to redefine healthcare accessibility. Your journey to better health
                                            starts here.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-section end -->
@endsection

@section('scripts')
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/frontend/js/jquery.paroller.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            if ($('.paroller').length) {
                $('.paroller').paroller({
                    factor: 0.1,
                    factorLg: 0.1,
                    type: 'foreground',
                    direction: 'vertical'
                });
            }

            if ($('.paroller-2').length) {
                $('.paroller-2').paroller({
                    factor: -0.1,
                    factorLg: -0.1,
                    type: 'foreground',
                    direction: 'vertical'
                });
            }

        });
    </script>
@endsection
