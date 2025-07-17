@extends('backend.customer.layouts.master')

@section('title', 'Messages')

@section('styles')
    <link href="{{ asset('assets/backend/css/customer/live-chat.css') }}" rel="stylesheet">
    <style>
        /* Style for the file input */
        .file-upload {
            position: relative;
            cursor: pointer;
            color: #fff;

            border: none;
            border-radius: 5px;
            font-weight: bold;
            margin-bottom: 0px !important
        }

        .file-upload i {
            font-size: 26px;
        }

        .file-upload input[type="file"] {
            position: absolute !important;
            top: -30px !important;
            left: -95px !important;
            font-size: 100px !important;
            opacity: 0 !important;
            cursor: pointer;
        }

        .chat-img {
            width: 100% !important;
            height: 100% !important;
            top: 0px !important;
            position: relative !important;
            border-radius: 0% !important;

        }
    </style>
@endsection

@section('content')
    <div class="content-container">
        <div class="outer-container">
            <div class="message-box">
                <div class="title-box">
                    <h3>Messages</h3>

                </div>
                <div class="chat-room">
                    <div id="frame">
                        <livewire:customer.message.index :inquiries="$inquiries" />
                        <livewire:customer.message.chat-body />


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
