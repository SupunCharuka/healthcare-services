<x-backend-layout>
    @section('title', 'Edit Service')
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/app-jetstream.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/intlTelInput.css') }}">
    </x-slot>
    <x-slot name="breadcrumb_title">
        Edit Service
    </x-slot>
    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('service-provider.dashboard') }}">Dashboard</a></li>
        @if (Auth::user()->getRoleNames()->first() == 'admin')
            <li class="breadcrumb-item active"><a
                    href="{{ route('admin.memberServices', $service->user_id) }}">{{ $service->user->name }}'s'
                    Service</a></li>
        @else
            <li class="breadcrumb-item active"><a
                    href="{{ route('service-provider.service', Auth::user()->id) }}">Manage
                    Service</a></li>
        @endif
        <li class="breadcrumb-item active">Edit Service</li>
    </x-slot>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <livewire:member.service.edit :service="$service" />
                </div>
            </div>
        </div>
    </div>
</x-backend-layout>
