@extends('backend.customer.layouts.master')

@section('title', 'Write a review')
@section('link', 'Write a review')
@section('content')
    <div class="content-container">
        <div class="outer-container">

            <!-- submit-review -->
            <section class="submit-review p-0 bg-color-3">
                <div class="pattern">
                    <div class="pattern-1"
                        style="background-image: url('{{ asset('assets/frontend/images/shape/shape-85.png') }}');"></div>
                    <div class="pattern-2"
                        style="background-image: url('{{ asset('assets/frontend/images/shape/shape-86.png') }}');"></div>
                </div>
                <div class="auto-container">
                    <livewire:customer.inquiry.review :inquiryreviews="$inquiryreviews" />

                </div>
            </section>
        </div>
    </div>
@endsection




<!-- submit-review end -->
