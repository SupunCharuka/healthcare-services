@extends('frontend.layouts.master')
@section('title', $product->name)
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/frontend/libs/owl-carousel/owl.carousel.css') }}" />
    <link href="{{ asset('assets/frontend/css/product.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/cart.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection
@section('content')

    <!--Page Title-->
    <section class="page-title bg-color-1 background top-link">
        <div class="auto-container">
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <div class="lower-content">
                        <ul class="bread-crumb clearfix">
                            <li class="ml-1"><a href="{{ url('') }}">Home</a></li>
                            <li class="ml-1"><a href="{{ route('public.product') }}">Healthcare Products</a></li>
                            <li class="ml-1"><a
                                    href="{{ route('public.productSub', ['product' => $product->productCategory]) }}">{{ $product->productCategory->name }}</a>
                            </li>
                            <li class="ml-1"><a
                                    href="{{ route('public.viewSub', ['category' => $product->productSubcategory]) }}">{{ $product->productSubcategory->name }}</a>
                            </li>
                            <li class="ml-1"> {{ $product->name }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <livewire:frontend.product.cart />
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- team-style-two -->
    <section class="team-style-two bg-color-3">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- ================================== Product ================================== -->
                <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                    <div class="detail-block">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="product-details-tab">
                                    <div id="img-1" class="zoomWrapper single-zoom">
                                        <a href="javascript:void(0)">
                                            <img id="zoom1"
                                                src="{{ storage('uploads/admin/product-images/' . $product->productImages->first()->images) }}"
                                                data-zoom-image="{{ storage('uploads/admin/product-images/' . $product->productImages->first()->images) }}"
                                                alt="big-1">
                                        </a>
                                    </div>
                                    <div class="single-zoom-thumb">
                                        <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                                            @foreach ($product->productImages as $photo)
                                                <li>
                                                    <a href="javascript:void(0)" id="color{{ $photo->id }}"
                                                        class="elevatezoom-gallery active" data-update=""
                                                        data-image="{{ storage('uploads/admin/product-images/' . $photo->images) }}"
                                                        data-zoom-image="{{ storage('uploads/admin/product-images/' . $photo->images) }}">
                                                        <img src="{{ storage('uploads/admin/product-images/thumb/' . $photo->images) }}"
                                                            alt="zo-th-1" />
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- /.gallery-holder -->

                            <div class='col-sm-6 col-md-6 product-info-block'>
                                <div class="product-info" id="product-info">
                                    <livewire:frontend.product.info :product="$product" :stock="$stock" />
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class='col-lg-12 col-md-12 col-sm-12 mt-3 clinic-details-content doctor-details-content'>
                    <div class="tabs-box">
                        <div class="tab-btn-box centred">
                            <ul class="tab-btns tab-buttons clearfix">
                                <li class="tab-btn">Overview</li>

                            </ul>
                        </div>
                        <div class="tabs-content">
                            <div class="tab active-tab" id="tab-1">
                                <div class="inner-box">
                                    {!! $product->description !!}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


    </section>
    <!-- team-style-two -->


@endsection

@section('scripts')
    <script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.elevatezoom.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/product.js') }}"></script>

@endsection
