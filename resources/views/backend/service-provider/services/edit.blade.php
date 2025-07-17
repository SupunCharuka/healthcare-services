<x-backend-layout>
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/app-jetstream.css') }}">
    </x-slot>
    <x-slot name="breadcrumb_title">
        Edit Service
    </x-slot>
    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('service-provider.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('service-provider.service',Auth::user()->id) }}">Manage Service</a></li>
        <li class="breadcrumb-item active">Edit Service</li>
    </x-slot>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <livewire:service-provider.service.edit :service="$service" />
                </div>
            </div>
        </div>
    </div>
</x-backend-layout>
