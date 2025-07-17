@extends('backend.layouts.master')
@section('title', 'Edit Bank Name')
@section('styles')

@endsection
@section('breadcrumb-title', 'Edit Bank Name')

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.bank') }}">Bank Name</a></li>
    <li class="breadcrumb-item active">Edit Bank Name</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div>
            <div class="row">
                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    <livewire:admin.bank.edit :bank="$bank"/>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

@endsection
