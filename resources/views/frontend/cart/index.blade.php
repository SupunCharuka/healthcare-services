@extends('frontend.layouts.master')
@section('title', 'Online Shopping')
@section('styles')
    <link href="{{ asset('assets/frontend/css/cart.css') }}" rel="stylesheet">
@endsection
@section('content')

    <!--Page Title-->
    <section class="page-title bg-color-1 background top-link">
        <div class="auto-container">
            <div class="lower-content">
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('') }}">Home</a></li>
                    <li><a href="{{ route('public.product') }}">Healthcare Products</a></li>
                    <li>Cart</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->




    <!-- team-style-two -->
    <section class="team-style-two bg-color-3 product-listing">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="content-container" style="width: 100%">
                    <div class="outer-container">
                        <div class="doctors-appointment my-patients">
                            <div class="title-box clearfix">
                                <div class="text pull-left">
                                    <h3>View Cart Item List</h3>
                                </div>
                            </div>
                            <livewire:frontend.product.view-cart-item />

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <!-- team-style-two -->


@endsection

@section('scripts')


@endsection
