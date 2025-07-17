<x-backend-layout>
    @section('title', 'Bank Account Details')
    <x-slot name="styles">
    </x-slot>

    <x-slot name="breadcrumb_title">
        My Bank Account Details
    </x-slot>

    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('service-provider.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('service-provider.service') }}">Services</a></li>
        <li class="breadcrumb-item active"> My Bank Account Details</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
                <livewire:service-provider.bank-details.create :service="$service" />
            </div>
        </div>
    </div>
</x-backend-layout>
