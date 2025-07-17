@extends('backend.layouts.master')
@section('title', 'Edit Branch')
@section('styles')

@endsection
@section('breadcrumb-title', 'Edit Branch')

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.bank') }}">Banks</a></li>
    <li class="breadcrumb-item"><a
            href="{{ route('admin.branch', ['bank' => $branch->bank]) }}">{{ $branch->bank->bank_name }}</a></li>
    <li class="breadcrumb-item active">Edit Branch Name</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div>
            <div class="row">
                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    <livewire:admin.bank.branch.edit :branch="$branch" />
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

@endsection
