@extends('backend.layouts.master')
@section('title', 'Message ')
@section('styles')
    <style>
        /* Style for the file input */
        .file-upload {
            position: relative;
            cursor: pointer;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            margin-bottom: 0px !important
        }

        .file-upload i {
            font-size: 26px;
        }

        .file-upload input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            font-size: 100px;
            opacity: 0;
            cursor: pointer;
        }
    </style>
@endsection

@section('breadcrumb-title', 'Message')
@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('service-provider.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Message</li>
@endsection

@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <livewire:service-provider.message.index :inquiries="$inquiries" />
            <livewire:service-provider.message.chat-body />
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection
@section('scripts')
    <script src="{{ asset('assets/backend/js/fullscreen.js') }}"></script>
@endsection
