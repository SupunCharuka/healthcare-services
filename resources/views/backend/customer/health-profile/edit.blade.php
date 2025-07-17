@extends('backend.customer.layouts.master')

@section('title', 'Edit My Health Profle')

@section('styles')


@endsection

@section('content')
    <div class="content-container">
        <div class="outer-container">
            <div class="doctors-appointment">
                <livewire:customer.health-profile.edit :health="$health" />
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
