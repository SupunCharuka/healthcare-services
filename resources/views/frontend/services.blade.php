@extends('frontend.layouts.master')

@section('title', 'Services')

@section('content')
    <div class="ui-title-page bg_title bg_transparent">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>OUR SERVICES</h1>
                    <div class="ui-subtitle-page">Egestas dolor erat vamus suscip ipsum estduin</div>
                </div>
            </div>
        </div>
    </div>
    <!-- end ui-title-page -->

    <div class="border_btm">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="icon icon-home color_primary"></i></a></li>
                        <li class="active">Our Services</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb -->

    <main class="main-content">
        <div class="services">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="ui-title-block text-center">Featured Clinical Services <strong>For Patients</strong></h2>
                        <div class="ui-subtitle-block">Our medical specialists care about you & your family’s health</div>
                    </div>
                </div>
                <i class="decor-brand"></i>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="services__item wow bounceInRight" data-wow-delay="1s">
                            <div class="service__figure">
                                <div class="hover__figure"> <img src="{{ asset('assets/frontend/media/services/1.png') }}"
                                        height="300" width="370" alt="Foto"></div>
                                <span class="icon-round icon-round_small helper"><i
                                        class="icon flaticon-medical109"></i></span>
                            </div>
                            <h3 class="ui-title-inner">Home Visit</h3>
                            <p class="ui-text">Professional medical care delivered to your home — perfect for elderly or immobile patients.</p>
                            <a class="btn btn_small" href="javascript:void(0);">READ MORE</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="services__item wow bounceInRight" data-wow-delay="1s">
                            <div class="service__figure">
                                <div class="hover__figure"> <img src="{{ asset('assets/frontend/media/services/2.png') }}"
                                        height="300" width="370" alt="Foto"></div>
                                <span class="icon-round icon-round_small helper"><i
                                        class="icon flaticon-tooth12"></i></span>
                            </div>
                            <h3 class="ui-title-inner">Video / Audio Consultation</h3>
                            <p class="ui-text">Connect with certified doctors through secure video or audio calls,
                                eliminating the need for physical visits.</p>
                            <a class="btn btn_small" href="javascript:void(0);">READ MORE</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="services__item wow bounceInRight" data-wow-delay="1s">
                            <div class="service__figure">
                                <div class="hover__figure"> <img src="{{ asset('assets/frontend/media/services/3.png') }}"
                                        height="300" width="370" alt="Foto"></div>
                                <span class="icon-round icon-round_small helper"><i class="icon flaticon-lungs4"></i></span>
                            </div>
                            <h3 class="ui-title-inner">Channel a Doctor</h3>
                            <p class="ui-text">Easily schedule appointments with top-rated specialists for in-person or
                                online consultations across multiple fields.</p>
                            <a class="btn btn_small" href="javascript:void(0);">READ MORE</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="services__item wow bounceInRight" data-wow-delay="1s">
                            <div class="service__figure">
                                <div class="hover__figure"> <img src="{{ asset('assets/frontend/media/services/4.png') }}"
                                        height="300" width="370" alt="Foto"></div>
                                <span class="icon-round icon-round_small helper"><i
                                        class="icon flaticon-brain13"></i></span>
                            </div>
                            <h3 class="ui-title-inner">Medicine to your Doorstep</h3>
                            <p class="ui-text">Get your prescriptions delivered fast and safely to your home with our
                                reliable doorstep pharmacy service.</p>
                            <a class="btn btn_small" href="javascript:void(0);">READ MORE</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="services__item wow bounceInRight" data-wow-delay="1s">
                            <div class="service__figure">
                                <div class="hover__figure"> <img src="{{ asset('assets/frontend/media/services/5.png') }}"
                                        height="300" width="370" alt="Foto"></div>
                                <span class="icon-round icon-round_small helper"><i class="icon flaticon-pill"></i></span>
                            </div>
                            <h3 class="ui-title-inner">Emergency Medical Care</h3>
                            <p class="ui-text">24/7 emergency response service providing immediate care and support for
                                urgent medical conditions.</p>
                            <a class="btn btn_small" href="javascript:void(0);">READ MORE</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="services__item wow bounceInRight" data-wow-delay="1s">
                            <div class="service__figure">
                                <div class="hover__figure"> <img src="{{ asset('assets/frontend/media/services/6.png') }}"
                                        height="300" width="370" alt="Foto"></div>
                                <span class="icon-round icon-round_small helper"><i
                                        class="icon flaticon-heart8"></i></span>
                            </div>
                            <h3 class="ui-title-inner">Home Nursing</h3>
                            <p class="ui-text">Skilled nursing care at home — ideal for recovery, elderly care, and chronic conditions.</p>
                            <a class="btn btn_small" href="javascript:void(0);">READ MORE</a>
                        </div>
                    </div>
                    {{-- <div class="col-sm-4">
                        <div class="services__item wow bounceInRight" data-wow-delay="1s">
                            <div class="service__figure">
                                <div class="hover__figure"> <img src="{{ asset('assets/frontend/media/services/7.png') }}"
                                        height="300" width="370" alt="Foto"></div>
                                <span class="icon-round icon-round_small helper"><i
                                        class="icon flaticon-medical14"></i></span>
                            </div>
                            <h3 class="ui-title-inner">Endocrinology</h3>
                            <p class="ui-text">Justo laoreet dignis sim lectus duic etiamd ipsum habitant tristique nam
                                est. Donec venenatis leo eu varius curus da metus nunc placerat cursus [...]</p>
                            <a class="btn btn_small" href="javascript:void(0);">READ MORE</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="services__item wow bounceInRight" data-wow-delay="1s">
                            <div class="service__figure">
                                <div class="hover__figure"> <img src="{{ asset('assets/frontend/media/services/8.png') }}"
                                        height="300" width="370" alt="Foto"></div>
                                <span class="icon-round icon-round_small helper"><i
                                        class="icon flaticon-baby137"></i></span>
                            </div>
                            <h3 class="ui-title-inner">Pregnancy & Births</h3>
                            <p class="ui-text">Justo laoreet dignis sim lectus duic etiamd ipsum habitant tristique nam
                                est. Donec venenatis leo eu varius curus da metus nunc placerat cursus [...]</p>
                            <a class="btn btn_small" href="javascript:void(0);">READ MORE</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="services__item wow bounceInRight" data-wow-delay="1s">
                            <div class="service__figure">
                                <div class="hover__figure"> <img src="{{ asset('assets/frontend/media/services/9.png') }}"
                                        height="300" width="370" alt="Foto"></div>
                                <span class="icon-round icon-round_small helper"><i
                                        class="icon flaticon-pipette1"></i></span>
                            </div>
                            <h3 class="ui-title-inner">Medical Counseling</h3>
                            <p class="ui-text">Justo laoreet dignis sim lectus duic etiamd ipsum habitant tristique nam
                                est. Donec venenatis leo eu varius curus da metus nunc placerat cursus [...]</p>
                            <a class="btn btn_small" href="javascript:void(0);">READ MORE</a>
                        </div>
                    </div> --}}
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end services -->


    </main>
@endsection

@section('scripts')
@endsection
