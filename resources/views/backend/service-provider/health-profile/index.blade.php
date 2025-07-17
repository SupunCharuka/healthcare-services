@extends('backend.layouts.master')
@section('title', 'Medical Report')
@section('styles')
    <style>
        
    </style>
@endsection
@section('breadcrumb-title', 'Medical Report')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('service-provider.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Medical Report Detail</li>
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow health-profile-card">

                    @foreach ($healthProfiles as $healthProfile)
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 health-profile-image">
                                    @php
                                        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg'];
                                        $explodeImage = explode('.', $healthProfile->file);
                                        $extension = end($explodeImage);
                                    @endphp
                                    @if (in_array($extension, $imageExtensions, true))
                                        <img class="img-thumbnail mt-2"
                                            src="{{ asset('uploads/customer/health-profile/' . $healthProfile->file) }}"
                                            alt="Health Profile Image">
                                    @else
                                        <b>
                                            <a href="{{ asset('uploads/customer/health-profile/' . $healthProfile->file) }}"
                                                target="_blank">
                                                <img src="https://img.icons8.com/fluency/48/000000/pdf-mail.png"
                                                    alt="PDF Icon" />
                                            </a>
                                        </b>
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <h4 class="card-title health-profile-title">{{ $healthProfile->title }}</h4>
                                    <p class="card-text health-profile-date">Created at:
                                        {{ $healthProfile->created_at->format('M d, Y h:i A') }}</p>
                                    <p class="card-text health-profile-id">Health Profile ID: #{{ $healthProfile->id }}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
