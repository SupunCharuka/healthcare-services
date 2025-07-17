@php
    $privacyPolicy = App\Models\Page::where('slug', 'privacy-policy')->first();
@endphp
@extends('frontend.layouts.master')
@section('title', 'User Guide')

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
                    <h1>User Guide</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('') }}">Home</a></li>
                    <li>User Guide</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->


    <section class="category-section">
        <div class="auto-container">
            <div class="row align-items-center clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 content-column">

                    <div class="content_block_1 user-guide-content-block-1">
                        <div class="icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <div class="content-box user-guide-box">
                            <div class="content mt-0">
                                <h4 class="title">
                                    How to Make an Inquiry
                                </h4>
                                <span class="d-flex"><span>❖</span>
                                    <p> Visit our website and click on the "Service" section.</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p>Select the type of service you need: "Doctor Home Visits", "Audio and Video
                                        Consultations", "Channel a Specialist",
                                        "Ambulance Service", "Home Nursing".</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p> Specify the service you are interested in from the options provided.</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p>Choose the specific service option that suits your needs. You may have various
                                        options, such as consultation types, inquiry times, and service providers.</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p> Fill out the required information, including your personal details and contact
                                        information. This will ensure that the service provider can reach out to you.</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p> Double-check your information and preferences. When you're ready, click the "Submit"
                                        button to send your inquiry to the service provider for further processing.</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p>You will receive a confirmation email with your inquiry details.</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p> On the scheduled day and time, access your chosen service through the provided link
                                        or instructions.</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p>Enjoy convenient and accessible healthcare services from the comfort of your home!
                                    </p>
                                </span>
                            </div>
                        </div>
                    </div>

                    <section class="process-style-two  centred">

                        <div class="auto-container">
                            <div class="sec-title centred">
                                <p>Process</p>
                                <h2 class="process-title" style="font-size: 35px">Inquiry Process</h2>
                            </div>
                            <div class="inner-content">
                                <div class="arrow"
                                    style="background-image: url('{{ asset('assets/frontend/images/icons/arrow-1.png') }}');">
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                                        <div class="processing-block-two">
                                            <div class="inner-box">
                                                <figure class="icon-box"><img
                                                        src="{{ asset('assets/frontend/images/icons/icon-9.png') }}"
                                                        alt=""></figure>
                                                <h3>Submit Your Inquiry</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                                        <div class="processing-block-two">
                                            <div class="inner-box">
                                                <figure class="icon-box"><img
                                                        src="{{ asset('assets/frontend/images/icons/icon-10.png') }}"
                                                        alt=""></figure>
                                                <h3>Receive Recommendations</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                                        <div class="processing-block-two">
                                            <div class="inner-box">
                                                <figure class="icon-box"><img
                                                        src="{{ asset('assets/frontend/images/icons/icon-11.png') }}"
                                                        alt=""></figure>
                                                <h3>Connect with Experts</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="content_block_1 user-guide-content-block-1">
                        <div class="icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <div class="content-box user-guide-box">
                            <div class="content mt-0">
                                <h4 class="title">
                                    How to Register as a Patient
                                </h4>
                                <span class="d-flex"><span>❖</span>
                                    <p> Visit our website and look for the "My Account" option. Click on it to begin the
                                        registration process.</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p>Fill in the required information, including your First Name, Last Name, Mobile
                                        Number, and Email. This information is essential for communication and
                                        identification purposes.</p>

                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p> Review the information you've provided and make any necessary changes. Once you're
                                        satisfied, click the "Register" button to complete the registration process.</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p> If you have medical reports or documents to share with your healthcare provider, you
                                        can upload them in your health profile. Look for the "Upload Medical Reports"
                                        section and follow the instructions.</p>
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
                                    How to Register as a Doctor or Service Provider
                                </h4>
                                <span class="d-flex"><span>❖</span>
                                    <p> Visit our website and look for the "My Account" option. Click on it to begin the
                                        registration process.</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p> Choose the "Register as a Member" option. You will be prompted to select your member
                                        type. Choose "Doctor" or "Service Provider."</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p>Provide your First Name, Last Name, Mobile Number, and Email Address. Click
                                        "Register" to proceed.</p>

                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p> After registration, you will need to provide details about your education and work
                                        experience. Upload your credentials and qualifications for verification.</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p> Our admin team will review your submitted details. This may take some time. You will
                                        be notified of the status of your registration via email.</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p> If your registration is approved, you will gain access to your role as a doctor or
                                        service provider on our platform.</p>
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
                                    How to Buy a Product
                                </h4>
                                <span class="d-flex"><span>❖</span>
                                    <p> If you are a registered user, simply log in to your account. If you are a new user,
                                        you will need to register by providing your personal details.</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p> Once logged in, browse through the available products on our platform. You can use
                                        search filters to find specific products.</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p>Select the product you wish to buy and click "Add to Cart." You can continue shopping
                                        or proceed to checkout.</p>

                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p> Review the items in your cart. Provide shipping and payment details. Confirm your
                                        order and make the payment securely.</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p> After successful payment, you will receive an order confirmation with details of
                                        your purchase. You can view your order details.</p>
                                </span>
                                <span class="d-flex"><span>❖</span>
                                    <p> Your purchased product will be delivered to your provided address within the
                                        specified timeframe.</p>
                                </span>


                            </div>
                        </div>
                    </div>



                    <p class="text-justify" style="color: black">
                        As an online e-channeling platform, we offer you the convenience of finding the most suitable
                        medical professional for your needs based on the information provided by both you and the healthcare
                        providers.
                        However, it is your responsibility to verify the accuracy of all the information provided by the
                        healthcare providers before seeking their services through our website.</p>
                </div>
            </div>
        </div>
    </section>




@endsection

@section('scripts')
@endsection
