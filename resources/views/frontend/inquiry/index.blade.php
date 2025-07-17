@extends('frontend.layouts.master')
@section('title', 'Inquiry - ' . $servicecategory->name)
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/intlTelInput.css') }}">
    <style>
        .toast-dark {
            background-color: #00800f;
            color: #fff;
        }
    </style>
@endsection
@section('content')
    <!--page-title-two-->
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
                    <h1> {{ $servicecategory->name }}
                    </h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('') }}">Home</a></li>
                    <li>Inquiry</li>
                </ul>
            </div>
        </div>
    </section>
    <!--page-title-two end-->

    <!-- contact-section -->
    <section class="contact-section inquirySection">
        <div class="auto-container">
            <div class="row clearfix">
                <livewire:frontend.inquiry.inquiry :servicecategory="$servicecategory" />
            </div>

        </div>
    </section>
    <!-- contact-section end -->

@endsection

@section('scripts')
    <script src="{{ mix('js/app.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@endsection
