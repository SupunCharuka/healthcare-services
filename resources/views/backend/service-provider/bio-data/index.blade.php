@extends('backend.layouts.master')
@section('title', 'Bio data')
@section('styles')
@endsection

@section('breadcrumb-title', 'Bio data')
@section('breadcrumb-items')
    <li class="breadcrumb-item">Service Provider</li>
    <li class="breadcrumb-item active">Bio data</li>
@endsection
@section('content')
    <!-- Container-fluid starts-->
    @php
        $user = Auth::user();
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mb-4 mx-auto">
                <a href="{{ route('service-provider.education') }}"
                    class="{{ $user && $user->education->count() ? 'custom-link link-with-education' : 'custom-link link-without-education' }}">
                    <div class="link-icon">
                        <i class="fa fa-graduation-cap"></i>
                    </div>
                    <div class="link-text">
                        <h4>My Education</h4>
                        <p>Manage your education details</p>
                    </div>
                </a>
            </div>

            <div class="col-md-6 mb-4 mx-auto">
                <a href="{{ route('service-provider.workDetails') }}"
                    class="{{ $user && $user->workDetails->count() ? 'custom-link link-with-work-details' : 'custom-link link-without-work-details' }}">
                    <div class="link-icon">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <div class="link-text">
                        <h4>My Work Experience</h4>
                        <p>Manage your work experience</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection
@section('scripts')

@endsection
