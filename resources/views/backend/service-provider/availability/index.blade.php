@extends('backend.layouts.master')
@section('title', 'Availability')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/timepicker.css') }}">
    <style>
       
    </style>
@endsection
@section('breadcrumb-title', 'My Schedule')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('service-provider.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">My Availability</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="calendar-wrap">
            <div class="row">
                <div class="col-sm-12">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <livewire:service-provider.availability.create :services="$services" />
                </div>

                <div class="col-sm-12">
                    <livewire:service-provider.availability.view :services="$services" />
                </div>
            </div>
        </div>
    </div>




@endsection
@section('scripts')
    <script src="{{ asset('assets/backend/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/jquery.ui.min.js') }}"></script>

    <script src="{{ asset('assets/backend/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
@endsection
