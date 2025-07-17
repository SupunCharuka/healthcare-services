@php
     $termConditions = App\Models\Page::where('slug', 'term-conditions')->first();
@endphp
@extends('frontend.layouts.master')
@section('title', 'Term & Conditions')

@section('content')

    <!--Page Title-->
    <section class="page-title centred bg-color-1">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url('{{ asset('assets/frontend/images/shape/shape-70.png') }}');"></div>
            <div class="pattern-2" style="background-image: url('{{ asset('assets/frontend/images/shape/shape-71.png') }}');"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Term And Conditions</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('') }}">Home</a></li>
                    <li>Term And Conditions </li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->


    <section class="about-section term-section">
        <div class="auto-container">
            <div class="row align-items-center clearfix">

                <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                    <div class="content_block_1 about_content_block">
                        <div class="content-box about-content-box">
                            {!!  $termConditions->content !!}
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
@endsection
